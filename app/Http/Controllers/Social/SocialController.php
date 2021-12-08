<?php

namespace App\Http\Controllers\Social;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class SocialController extends Controller
{
    public function handleRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider)
    {
        $user   = Socialite::driver($provider)->user();
        $dbuser = User::withTrashed()->where('email', $user->email)->get();
        if ($dbuser->isEmpty()) {
            $data = [
                'name'              => $user->name ?? 'user' . random_int(1000, 9000),
                'email'             => $user->email,
                'email_verified_at' => now(),
                'provider'          => Str::ucfirst($provider),
            ];
            Auth::login($newUser = User::create($data));
            Auth::user()->last_login = now();
            Auth::user()->save();
            Notification::send($newUser, new WelcomeNotification());
            return redirect(RouteServiceProvider::HOME);
        }

        $dbuser = User::withTrashed()->where('email', $user->email)->first();

        if (!is_null($dbuser->deleted_at)) {
            return redirect()->route('login')->with('message', 'El cmpt mteik tfaskh le ' . $dbuser->deleted_at->format('d M, H:i'));
        }

        if (!is_null($dbuser->password)) {
            return redirect()->route('login')->with('message', 'Lezm tekteb el mdp');
        }

        if (Str::lower($dbuser->provider) === $provider) {
            Auth::loginUsingId($dbuser->id);
            Auth::user()->last_login = now();
            Auth::user()->save();
            return redirect(RouteServiceProvider::HOME);
        }
        return redirect()->route('login')->with('message', 'Msh Nafs El Provider');
    }
}
