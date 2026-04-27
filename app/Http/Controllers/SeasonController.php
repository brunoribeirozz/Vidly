<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\RedirectResponse;

class SeasonController extends Controller
{
    public function index(Serie $serie)
    {
        $seasons = $serie->seasons()->orderBy('number')->get();

        return view('seasons.index', compact('serie', 'seasons'));
    }
    public function store(Serie $serie): RedirectResponse
    {
        $nextNumber = $serie->seasons()->max('number') + 1 ?? 1;

        $serie->seasons()->create([
            'number' => $nextNumber
        ]);

        return back()->with('message.success', "Season $nextNumber added successfully!");
    }
}
