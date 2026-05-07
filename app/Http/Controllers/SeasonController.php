<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeasonController extends Controller
{

    public function index(Serie $series)
    {
        $reviews = $series->reviews()->with('user')->latest()->get();

        $seasons = $series->seasons()->orderBy('number')->get();
        return view('seasons.index', compact('series', 'seasons', 'reviews'));
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

    public function edit(Serie $series, Season $season)
    {
        return view('seasons.edit', compact('series', 'season'));
    }

    public function update(Request $request, Serie $series, Season $season)
    {
        $request->validate(['number' => 'required|integer']);

        try {

            $season->update($request->all());
            return redirect()->route('series.seasons.index', $series)
                ->with('message.success', 'Season updated successfully!');

        } catch (Exception $e) {
            Log::error("Error updating season: " . $e->getMessage());
            return back()->withErrors('Error updating season, please try again.');
        }
    }

    public function destroy(Serie $series, Season $season)
    {
        try {
            $season->delete();
            return redirect()->route('series.seasons.index', $series)
                ->with('message.success', 'Season deleted successfully!');
        } catch (Exception $e) {
            Log::error("Error deleting season: " . $e->getMessage());
            return back()->withErrors('Error deleting season, please try again.');
        }
    }
}
