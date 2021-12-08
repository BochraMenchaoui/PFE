<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Word;
use App\Models\Comment;
use Jenssegers\Agent\Agent;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');


// Route::get('/location', function () {
//     $agent = new Agent();
//     dd($agent->languages());
// });

// Route::get('/2faa', function () {
//     $user = User::find(1);
//     // dd($user->password_security);
//     $user->password_security()->create([
//         'is_enabled' => 1,
//     ]);
//     dd('success');
// });



// Route::get('/betaview', function () {
//     $chart = (new LarapexChart)->areaChart()
//         ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
//         ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
//         ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

//     $donut = (new LarapexChart)->donutChart()
//         ->addData([20, 24, 30]);

//     $bar = (new LarapexChart)->barChart()
//         ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
//         ->addData('Boston', [7, 3, 8, 2, 6, 4])
//         ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);

//     return view('beta', [
//         'chart' => $chart,
//         'donut' => $donut,
//         'bar'   => $bar,
//     ]);
// });

// Route::get('/online', function () {
//     // $user = User::find(1);
//     // var_dump($user->isOnline());
//     $devices = Cache::get('online-users');
//     dd($devices);
// });

// Route::view('/2fa', 'admin.lock');

// Route::get('/connectedDevices', function () {
//     Cache::flush();
//     // dd(Request::ip());
//     // $devices = Cache::get('connected-devices');
//     // dd($devices);
// })->middleware(['admin.devices']);

// Route::get('/word', function () {
//     // $word = Word::find(3);
//     // dd($word->likedBy->count());
//     // $words = DB::table('words')
//     //     ->where('published', 1)
//     //     ->where(function ($query) {
//     //         $query->where('word_ar', 'like', '%' . 'Mr.')
//     //             ->orWhere('word_lt', 'like', '%' . 'Prof')
//     //             ->orWhere('description', 'like', '%' . 'Ms');
//     //     })
//     //     ->get();

//     $words = Word::where('published', 1)
//         ->where(function ($query) {
//             $query->where('word_ar', 'like', '%' . 'Mr.')
//                 ->orWhere('word_lt', 'like', '%' . 'Prof')
//                 ->orWhere('description', 'like', '%' . 'Ms');
//         })
//         ->get();

//     // $words = Word::all();
//     foreach ($words as $word) {
//         echo $word->likedBy->count() . '<br/>';
//     }
// });

// Route::get('/adminN', function () {

//     $user = new User;
//     $user->name = 'Admin';
//     $user->email = 'derja@admin';
//     $user->role = 0;
//     $user->password = Hash::make('admin');
//     $user->save();
//     dd('success');
// });
// /*
// This is how I will be creating words
// */
// Route::get('/creating', function () {
//     $user = User::find(2);
//     $user->words()->create([
//         'word_ar'     => 'test',
//         'word_lt'     => 'word',
//         'fr'          => 'word',
//         'ar'          => 'word',
//         'en'          => 'word',
//         'description' => 'word',
//         'origin'      => 'word',
//         'region'      => 'word',
//         'vocal'       => 'word',
//         'created_at'  => now(),
//     ]);
//     dd('success');
// });

// Route::get('/syn', function () {
//     $word = Word::find(1);
//     $word->synonyms()->create([
//         'syn' => 3,
//     ]);
//     dd('success');
// });

// Route::get('/createUser', function () {
//     User::create([
//         'name' => 'oussama',
//         'email' => 'example@example',
//         'password' => 'test',
//         'role' => 1,
//     ]);
// });

// Route::get('/restore', function () {
//     $user = User::onlyTrashed()->first();
//     $user->restore();
//     dd('success');
// });

// Route::get('/trashed', function () {
//     $users = User::onlyTrashed()->get();
//     foreach ($users as $user) {
//         echo $user->name . '<br />';
//     }
// });

// // Route::get('/online', function () {
// //     $user = User::find(1);
// //     var_dump($user->isOnline());
// // });

// Route::get('/db', function () {
//     $collabs = count(User::where('created_at', '>', Carbon::today()->subDays(30))->where('role', 1)->get());
//     dd($collabs);
// });

// Route::get('/import', function () {
//     Excel::import(new UsersImport, storage_path('app/imports/users.xlsx'));
//     return redirect('/');
// });

// Route::get('/lang', function () {
//     dd(Request::userAgent());
//     // dd(Request::server('HTTP_ACCEPT_LANGUAGE'));
//     // preg_match('/en|fr/u', Request::server('HTTP_ACCEPT_LANGUAGE'), $match);
//     // dd($match);
//     // dd(Request::server('HTTP_ACCEPT_LANGUAGE'));
//     // dd(Request::server('HTTP_ACCEPT_LANGUAGE'));
// });

// Route::get('/views', function () {
//     // dd(count(auth()->user()->unreadNotifications));
//     $user = User::find(1);
//     $test = $user->unreadNotifications->where('type', 'App\Notifications\MessageNotification')->first();
//     dd($test);
//     // foreach ($user->notifications as $notification) {
//     //     echo $notification->type;
//     // }
// });

// Route::get('/logoutOtherNiggas', function () {
//     // dd(Request::server('HTTP_ACCEPT_LANGUAGE'));
//     // Auth::logoutOtherDevices('admin');
//     $variables = Session::getId();
//     dd($variables['_token']);
// });

// // Route::get('/admin/login', function () {
// //     return view('admin.login');
// // });

// Route::get('/test', function () {
//     dd(Auth::user()->getEmailForVerification());
// });

// Route::get('/comment', function () {
//     $user = User::Find(14);
//     dd($user->owns(11));
// });


// Route::get('/translateAPI', function () {
//     return Http::withHeaders([
//         "Authorization" => "Bearer STA3JGA3FLNAKQXVYR2MH537TLLXNCLB",
//     ])->get('https://api.wit.ai/message?v=20210214&q=chnowa nkoulou 3al mreya bil anglais')->json();
// });

// Route::get('/viewer', function () {
//     // $words = (User::find(3))->words;
//     // return view('syn', ['syn' => $words]);
//     // $word = Word::find(3);
//     // dd($word->user->name);
//     // User::find(8)->delete();
//     //User::find(9)->favourites()->attach(6);
//     // dd(User::find(9)->favourites());
//     // User::find(8)->favourites()->attach(6);
//     // dd(empty(DB::table('favourites')->where('user_id', 9)->get()->toArray()));
//     // $fav = User::find(9)->favourites;
//     // return view('syn', ['syn' => $fav]);
//     // $user = User::find(9);
//     // $fav = $user->favourites;
//     // foreach ($fav as $item) {
//     //     echo $item['pivot']->word_id . '<br>';
//     // }
//     // die('done');
//     // dd($user->hasFavourite(8));
//     // Auth::user()->likes()->detach(1);
//     dd(Cache::get('views-count'));
// });

// Route::get('/liked', function () {
//     // return view('test');
//     $user = User::find(96);
//     foreach ($user->unreadNotifications->take(1) as $notification) {
//         echo $notification . '<br/>';
//     }
// });


// Route::get('/testingEvent', function () {
//     event(new App\Events\RealTimeMessage('Hello World'));
// });

// Route::view('/eventView', 'event');

// Route::get('/home', function () {
//     return 'This will be the dashboard';
// })
//     ->middleware(['auth', 'verified']);



require __DIR__ . '/forgot-password.php';
require __DIR__ . '/email-verification.php';
require __DIR__ . '/social.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/dict.php';
require __DIR__ . '/posts.php';
