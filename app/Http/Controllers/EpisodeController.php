<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Season $season)
    {
        $episodes = $season->episodes()->orderBy('number')->get();

        return view('episodes.index', compact('season', 'episodes'));
    }

    public function store(Season $season): RedirectResponse
    {
        $nextNumber = ($season->episodes()->max('number') ?? 0) + 1;

        $season->episodes()->create([
            'number' => $nextNumber,
            'title' => "Episode $nextNumber",
            'duration' => '45:00'
        ]);

        return back()->with('message.success', "Episode $nextNumber has been created.");

    }

    public function delete(Episode $episode): RedirectResponse
    {
        try {
            $episode->delete();

            return back()->with('message.success', "Episode has been deleted.");

        } catch (\Exception $e) {

            return back()->withErrors('Error deleting episode' . $e->getMessage());

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
        } catch (\Exception $e) {
            return back()->withErrors('Error updating episode.');
        }
    }

    public function destroy(Season $season, Episode $episode)
    {
        try {
            $episode->delete();

            return redirect()->route('seasons.episodes.index', $season)
                ->with('message.success', 'Episode has been deleted.' . $episode->number . 'removed!');
        } catch (\Exception $e) {
            return back()->withErrors('Error:Could not remove the episode');
        }
    }
}
