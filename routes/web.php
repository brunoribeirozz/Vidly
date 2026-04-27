<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProfileSerieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;


Route::get('/', [SerieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('Home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [SerieController::class, 'index'])->name('Home');

    // CRUD completo das Séries //
    Route::resource('series', SerieController::class);

    // Nested Resources //
    Route::resource('series.seasons', SeasonController::class)->only(['index', 'store']);
    Route::resource('seasons.episodes', EpisodeController::class)->only(['index', 'store', 'destroy', 'edit', 'update']);

    // Profile //
    Route::get('/profile', [ProfileSerieController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileSerieController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileSerieController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
