<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieRequest;
use App\Models\Serie;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::orderBy('name')->get();

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

    public function destroy(Serie $serie)
    {
        try {
            $serie->delete();

            return redirect()->route('series.index')
                ->with('message.success', "Serie $serie->name deleted sucessfully");
        } catch (Exception) {
            return back()->withErrors('Error deleting series:');
        }
    }
}
