<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Models\Serie;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::withCount(['seasons as episodes_count' => function ($query) {
            $query->join('episodes', 'seasons.id', '=', 'episodes.season_id')
                ->select(DB::raw('count(episodes.id)'));
        }])->orderBy('name')->get();

        return view('series.index', compact('series'));
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
                ->with('success', 'Serie created sucessfully');

            // aqui se der erro, redireciona o usuario pra mesma pag de novo e exibe uma mensagem de erro amigavel //
        } catch (Exception $exception) {
            return back()->withErrors('Error creating series:' . $exception->getMessage());
        }
    }

    public function destroy(Serie $series)
    {
        try {
            $series->delete();

            return redirect()->route('series.index')
                ->with('message.success', "Serie $series->name deleted sucessfully");
        } catch (Exception) {
            return back()->withErrors('Error deleting series:');
        }
    }

    public function update(UpdateSerieRequest $request, Serie $series)
    {
        $series->update($request->validated());

        return redirect()->route('series.index')
            ->with('message.success', 'Serie updated sucessfully');
    }

    public function edit(Serie $series)
    {
        return view('series.edit', compact('series'));
    }
}
