<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Serie;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_series' => Serie::count(),
            'total_reviews' => Review::count(),
            'total_users' => User::count(),
            'avg_rating' => round(Review::avg('stars'), 1) ?: 0,
        ];

        $recentReviews = Review::with(['user', 'serie'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentReviews'));
    }
}
