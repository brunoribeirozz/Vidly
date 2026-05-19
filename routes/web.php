<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProfileSerieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;


Route::get('/', [SerieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('Home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/series', [SerieController::class, 'index'])->name('series.index');
    Route::get('/series/{series}/seasons', [SeasonController::class, 'index'])->name('series.seasons.index');
    Route::get('/seasons/{season}/episodes', [EpisodeController::class, 'index'])->name('seasons.episodes.index');

    // barra de progresso, mostra a porcentagem //
    Route::post('/episodes/{episode}/watched', [EpisodeController::class, 'toggleWatched'])
        ->name('episodes.watched');

    Route::get('/profile', [ProfileSerieController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile/photo', [ProfileSerieController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::patch('/profile', [ProfileSerieController::class, 'update'])->name('profile.update');
    Route::patch('profile/photo', [ProfileSerieController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileSerieController::class, 'destroy'])->name('profile.destroy');

    Route::get('/series/{series}/review', [ReviewController::class, 'create'])
        ->name('series.reviews.create');
    Route::post('/series/{series}/review', [ReviewController::class, 'store'])
        ->name('series.reviews.store');
    Route::patch('/series/{series}/review/{review}', [ReviewController::class, 'update'])
        ->name('series.reviews.update');
    Route::delete('/series/{series}/review/{review}', [ReviewController::class, 'destroy'])
        ->name('series.reviews.destroy');
});
    // rotas do adm //
    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::resource('series', SerieController::class)->except(['index']);
    Route::resource('series.seasons', SeasonController::class)->except(['index']);
    Route::resource('seasons.episodes', EpisodeController::class)->except(['index']);
    Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])
            ->name('admin.reviews.destroy');
});

require __DIR__.'/auth.php';

