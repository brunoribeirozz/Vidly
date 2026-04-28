<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SeasonController extends Controller
{

    public function index(Serie $series)
    {
        $seasons = $series->seasons()->orderBy('number')->get();
        return view('seasons.index', compact('series', 'seasons'));
    }

    public function store(Serie $series): RedirectResponse
    {
        try {

        $nextNumber = ($series->seasons()->max('number') ?? 0) + 1;

        $series->seasons()->create([
            'number' => $nextNumber
        ]);

        return back()->with('message.success', "Season $nextNumber added successfully!");

        } catch (Exception $e) {
            Log::error("Error creating season: " . $e->getMessage());

            return back()->withErrors('Error creating season, please try again.');
        }
    }
}
