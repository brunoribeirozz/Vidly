<?php

use App\Http\Controllers\ProfileSerieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SerieController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('Home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('series', SerieController::class);

    Route::get('/profile', [ProfileSerieController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileSerieController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileSerieController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
