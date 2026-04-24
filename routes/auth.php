<?php

use App\Http\Controllers\Auth\AuthenticatedSessionSerieController;
use App\Http\Controllers\Auth\ConfirmablePasswordSerieController;
use App\Http\Controllers\Auth\EmailVerificationNotificationSerieController;
use App\Http\Controllers\Auth\EmailVerificationPromptSerieController;
use App\Http\Controllers\Auth\NewPasswordSerieController;
use App\Http\Controllers\Auth\PasswordSerieController;
use App\Http\Controllers\Auth\PasswordResetLinkSerieController;
use App\Http\Controllers\Auth\RegisteredUserSerieController;
use App\Http\Controllers\Auth\VerifyEmailSerieController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserSerieController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserSerieController::class, 'store']);

    Route::get('login', [AuthenticatedSessionSerieController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionSerieController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkSerieController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkSerieController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordSerieController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordSerieController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptSerieController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailSerieController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationSerieController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordSerieController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordSerieController::class, 'store']);

    Route::put('password', [PasswordSerieController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionSerieController::class, 'destroy'])
        ->name('logout');
});
