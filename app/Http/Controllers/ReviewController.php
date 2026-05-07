<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Serie;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ReviewController
{
    public function create(Serie $series)
    {
        return view('reviews.create', compact('series'));
    }

    public function store(Serie $series, Request $request)
    {
        try {
            $request->validate([
                'stars' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
            ]);

            $series->reviews()->create([
                'user_id' => auth()->id(),
                'stars' => $request->stars,
                'comment' => $request->comment,
            ]);

            return to_route('series.index')
                ->with('message.success', 'Your review has been successfully created.');

        } catch (Exception $exception) {
            Log::error("Error while saving your review. " . $exception->getMessage());
            return back()->withErrors(['message.error', 'We were unable to send your review, please try again.' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, Serie $series, Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            return back()->withErrors(['message.error' => 'You are not allowed to edit this review.']);
        }

        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($request->all());

        return back()->with('message.success', 'Your review has been successfully updated.');
    }

    public function destroy(Serie $series, Review $review)
    {
        if (auth()->id() === $review->user_id || auth()->user()->is_admin) {
            $review->delete();
            return back()->with('message.success', 'Your review has been successfully deleted.');
        }

        return back()->withErrors(['message.error' => 'You are not allowed to delete this review.']);
    }
}
