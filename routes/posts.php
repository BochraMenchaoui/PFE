<?php

use App\Http\Livewire\User\ListPosts;
use App\Http\Livewire\Post\PostDetail;


Route::get('/posts', ListPosts::class)
    ->middleware('auth')
    ->name('user.posts');

Route::get('/post/{id}', PostDetail::class)
    ->middleware('auth')
    ->name('article.details');
