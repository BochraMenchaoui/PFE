<?php

use App\Http\Livewire\Admin\EditWord;
use App\Http\Livewire\Admin\Messages;
use App\Http\Livewire\Admin\CreateUser;
use App\Http\Livewire\Admin\CreateWord;
use App\Http\Livewire\Admin\UserDetail;
use App\Http\Livewire\Admin\TrashedUsers;
use App\Http\Livewire\Admin\PostManagement;
use App\Http\Livewire\Admin\UserManagement;
use App\Http\Livewire\Admin\WordManagement;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Livewire\Admin\CommentManagement;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TwoFactorController;


/*
    TODO:
        ken t7eb traj3ou kima ken faskh partie loutania khali ken prefix, w middleware faskh kol shay khali ken comment l 9dim
*/
// Route::group(['prefix' => '{lang}', 'where' => ['lang' => 'en|fr']], function () {
// });

Route::prefix('admin')->group(function () {
    /*
        1. Auth Routes
    */
    Route::view('/login', 'admin.login')
        ->middleware('guest')
        ->name('admin.login');

    Route::post('/logout', [AdminController::class, 'destroy'])
        ->middleware('auth')
        ->name('admin.logout');

    Route::post('/validate', [AdminController::class, 'authAdmin'])
        ->name('admin.validate');

    /*
        2. Dashboard && Profile Routes
    */
    Route::get('/dashboard', [AdminDashboard::class, 'loadDashboard'])
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.dashboard');

    Route::view('/profile', 'admin.pages.profile')
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.profile');

    /*
        3. Users Management Routes
    */
    Route::get('/users', UserManagement::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.users');

    Route::get('/users/trashed', TrashedUsers::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.user.trashed');

    Route::get('/user/create', CreateUser::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.user.create');

    Route::get('/user/{id}', UserDetail::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.users.detail');

    /*
        4. Comments Management Routes
    */
    Route::get('/comments', CommentManagement::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.comments');

    /*
        5. Words Management Routes
    */
    Route::get('/words', WordManagement::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.words');

    Route::get('/word/create', CreateWord::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.word.create');

    Route::get('/word/edit/{id}', EditWord::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.word.edit');

    /*
        6. Messages Routes
    */
    Route::get('/messages', Messages::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.messages');

    /*
        7. 2FA Routes TODO: maybe add admin.devices maybe not
    */
    Route::get('/code', [TwoFactorController::class, 'index'])
        ->middleware(['admin.auth'])
        ->name('code.index');

    Route::get('/code/resend', [TwoFactorController::class, 'resend'])
        ->middleware(['admin.auth', 'throttle:6,1'])
        ->name('code.resend');

    Route::post('/code/verify', [TwoFactorController::class, 'store'])
        ->middleware(['admin.auth'])
        ->name('code.verify');

    /*
        8. Comments Management Routes
    */
    Route::get('/posts', PostManagement::class)
        ->middleware(['admin.auth', 'admin.devices', '2fa'])
        ->name('admin.posts');
});
