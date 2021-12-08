<?php

use App\Http\Livewire\Join\SignIn;
use App\Http\Livewire\Join\SignUp;
use App\Http\Livewire\User\Profile;
use App\Http\Livewire\User\Favourite;
use App\Http\Livewire\User\ListWords;
use App\Http\Livewire\User\CreatePost;
use App\Http\Controllers\HelperController;
use App\Http\Livewire\User\EditPost;
use App\Http\Livewire\User\EditWord;
use App\Http\Livewire\User\Messages;
use App\Http\Livewire\User\OwnedPosts;
use App\Http\Livewire\User\SuggestWord;

// TODO: 7ot el verified fil hajet li lezmo verifier + control al admin bsh yetle ken fi dashboard

/*
    1. Auth Routes
*/

Route::get('/sign-in', SignIn::class)
    ->middleware('guest')
    ->name('login');

Route::get('/sign-up', SignUp::class)
    ->middleware('guest')
    ->name('sign-up');

Route::post('/logout', [HelperController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
    2. Profile && Favourite Routes 
*/
Route::get('/profile', Profile::class)
    ->middleware('auth')
    ->name('profile');

Route::get('/favourites', Favourite::class)
    ->middleware('auth')
    ->name('favourite');

/*
    3. Words Management Routes
*/
Route::get('/user/words', ListWords::class)
    ->middleware('auth')
    ->name('user.words');

Route::get('/suggest/word', SuggestWord::class)
    ->middleware('auth')
    ->name('user.suggest.word');

Route::get('/edit/word/{id}', EditWord::class)
    ->middleware('auth')
    ->name('user.edit.word');

/*
    4. Article Management Routes
*/
Route::get('/user/posts', OwnedPosts::class)
    ->middleware('auth')
    ->name('user.owned.posts');

Route::get('/suggest/post', CreatePost::class)
    ->middleware('auth')
    ->name('user.create.post');

Route::get('/edit/post/{id}', EditPost::class)
    ->middleware('auth')
    ->name('user.edit.post');

/*
    5. Messages Routes
*/
Route::get('/messages', Messages::class)
    ->middleware('auth')
    ->name('messages');

/*
    TODO: baad mankaml kol shay maybe remove these routes, w el helper controller yab9a just ll logout.
*/
Route::post('/validate', [HelperController::class, 'authenticate'])
    ->name('validate');

Route::post('/r_validate', [HelperController::class, 'validateData'])
    ->name('r_validate');
