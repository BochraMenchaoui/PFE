<?php

use App\Http\Controllers\Social\SocialController;

Route::get('/auth/redirect/{provider}', [SocialController::class, 'handleRedirect'])
                ->name('social');

Route::get('/auth/callback/{provider}', [SocialController::class, 'handleCallback']);
