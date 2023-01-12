<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Disable built in Breeze Registration
    // Route::get('registreer', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('registreer', [RegisteredUserController::class, 'store']);

    Route::get('/', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/', [AuthenticatedSessionController::class, 'store']);

    Route::get('wachtwoord-vergeten', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('wachtwoord-vergeten', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('herstel-wachtwoord/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('herstel-wachtwoord', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verifieer-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verifieer-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verifieer-melding', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('bevestig-wachtwoord', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('bevestig-wachtwoord', [ConfirmablePasswordController::class, 'store']);

    Route::put('wachtwoord', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
