<?php

use App\Http\Controllers\ProfileSerieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileSerieController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileSerieController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileSerieController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
