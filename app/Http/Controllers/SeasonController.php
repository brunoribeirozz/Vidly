<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\RedirectResponse;

class SeasonController extends Controller
{
    public function index(Serie $series)
    {
        $seasons = $series->seasons()->orderBy('number')->get();
        return view('seasons.index', compact('series', 'seasons'));
    }
    public function store(Serie $series): RedirectResponse
    {
        $nextNumber = ($series->seasons()->max('number') ?? 0) + 1;

        $series->seasons()->create([
            'number' => $nextNumber
        ]);

        return back()->with('message.success', "Season $nextNumber added successfully!");
    }
}
