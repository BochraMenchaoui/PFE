<?php

use App\Http\Livewire\Dict\Detail;
use App\Http\Livewire\Dict\Search;
use App\Http\Livewire\Dict\TranslateWord;

Route::get('/search', Search::class)
    ->middleware('auth')
    ->name('search');

Route::get('/translate', TranslateWord::class)
    ->middleware(['auth'])
    ->name('translate');

Route::get('/word/{id}', Detail::class)
    ->middleware(['auth', 'viewscount'])
    ->name('details');
