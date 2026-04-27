<?php

use App\Http\Controllers\ProfileSerieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;


Route::get('/', [SerieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('Home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('series', SerieController::class);

    Route::get('/series/{serie}/seasons', [SeasonController::class, 'index'])->name('seasons.index');
    Route::post('/series/{serie}/seasons', [SeasonController::class, 'store'])->name('seasons.store');

    Route::get('/profile', [ProfileSerieController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileSerieController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileSerieController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
