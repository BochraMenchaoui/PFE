<?php

use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\Auth\ForgotPassword;

Route::get('/forgot-password', [ForgotPassword::class, 'index'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [ForgotPassword::class, 'handler'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [ResetPassword::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [ResetPassword::class, 'store'])
                ->middleware('guest')
                ->name('password.update');
