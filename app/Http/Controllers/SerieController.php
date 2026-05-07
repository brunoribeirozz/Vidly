<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Models\Serie;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class SerieController extends Controller
{
    public function index(Request $request)
    {
        // inicie a query //
        $query = Serie::query();

        // diz que ao laravel que a request é uma busca //
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // contagem dos eps e seasons //
        $series = $query->withCount(['seasons', 'seasons as episodes_count' => function ($query) {
            $query->join('episodes', 'seasons.id', '=', 'episodes.season_id')
                ->select(DB::raw('count(episodes.id)'));
        },
            'reviews as reviews_count'
        ])
            ->withAvg('reviews', 'stars')
            ->orderBy('reviews_avg_stars', 'desc')
            ->orderBy('name')
            ->get();

        $messageSuccess = $request->session()->get('message.success');

        return view('series.index', compact('series', 'messageSuccess'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(StoreSerieRequest $request): RedirectResponse
    {
        try {
            // aqui traz apenas os dados validados pelo StoreSerieRequest, se for tudo certo, redireciona com uma mensagem de sucesso //
            Serie::create($request->validated());

            return redirect()->route('series.index')
                ->with('message.success', 'Serie created sucessfully');

            // aqui se der erro, redireciona o usuario pra mesma pag de novo e exibe uma mensagem de erro amigavel //
        } catch (Exception $exception) {
            Log::error("Error creating a serie: " . $exception->getMessage());

            return back()->withErrors('Error creating series:' . $exception->getMessage());
        }
    }

    public function destroy(Serie $series)
    { // tenta deletar a serie, com sucesso, retorna a pag inicial com uma mensagem //
        try {
            $series->delete();

            return redirect()->route('series.index')
                ->with('message.success', "Serie $series->name deleted sucessfully");

        } catch (Exception) { // se cair no catch, ou  seja, erro ao deletar, retorna ao usuario uma mensagem de erro amigavel //
            return back()->withErrors('Error deleting series:');
        }
    }

    public function update(UpdateSerieRequest $request, Serie $series)
    { // mesmo esquema dos anteriores, se der erro, retorna o usuario a mesma pag com um erro amigavel //
        try {

        $series->update($request->validated());

        return redirect()->route('series.index')
            ->with('message.success', 'Serie updated sucessfully');

        } catch (Exception) { // mensagem de erro padrão //
            return back()->withErrors('Error updating series, please try again');
        }
    }

    public function edit(Serie $series) // apenas faz o GET da URL de edição, se não achar, vai dar um erro 404 //
    {
        return view('series.edit', compact('series'));
    }
}

// as mensagens do Log erro, pra poder ver, o laravel registra tudo no laravel.log //
