<?php

use App\Http\Controllers\Auth\VerifyEmail;

Route::get('/email/verify', [VerifyEmail::class, 'index'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmail::class, 'store'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerifyEmail::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
