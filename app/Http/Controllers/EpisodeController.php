<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EpisodeController extends Controller
{
    public function index(Season $season)
    {
        $episodes = $season->episodes()->orderBy('number')->get();

        return view('episodes.index', compact('season', 'episodes'));
    }

    public function store(Season $season): RedirectResponse
    {
        try {
        $nextNumber = ($season->episodes()->max('number') ?? 0) + 1;

        $season->episodes()->create([
            'number' => $nextNumber,
            'title' => "Episode $nextNumber",
            'duration' => '45:00'
        ]);

        return back()->with('message.success', "Episode $nextNumber has been created.");

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withErrors('message.error', "An error occured while creating the episode.");
        }

    }

    public function edit(Season $season, Episode $episode)
    {
        return view('episodes.edit', compact('season', 'episode'));
    }

    public function update(Request $request, Season $season, Episode $episode)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'duration' => 'nullable|string'
        ]);

        try {
            $episode->update($data);

            return redirect()->route('seasons.episodes.index', $season)
                ->with('message.success', 'Episode has been updated.');
        } catch (Exception) {
            return back()->withErrors('Error updating episode.');
        }
    }

    public function destroy(Season $season, Episode $episode)
    {
        try {
            $episode->delete();

            return redirect()->route('seasons.episodes.index', $season)
                ->with('message.success', "Episode $episode->number has been deleted.");
        } catch (Exception) {
            return back()->withErrors('Error:Could not remove the episode');
        }
    }
}
