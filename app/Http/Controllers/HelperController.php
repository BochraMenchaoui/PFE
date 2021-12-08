<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\CacheUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CollaboratorOnlineOfflineNotification;

class HelperController extends Controller
{
    use CacheUpdate;

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials, (bool)$request->remember_me)) {
            session()->flash('message', '.المايل ولا كلمة السر غالطين');
            return redirect()->route('login');
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        if (Auth::user()->role === 1) {
            $members = User::where('role', 1)->get();
            Notification::send($members, new CollaboratorOnlineOfflineNotification());
        }

        $this->updateCache();

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function validateData(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
            ]
        );

        if ($request->email) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                if ($request->password) {
                    if (strlen($request->password) >= 8) {
                        $data = [
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                        ];
                        Auth::login($user = User::create($data));
                        Notification::send($user, new WelcomeNotification());
                        event(new Registered($user));
                        return redirect(RouteServiceProvider::HOME);
                    }
                    return back()->with('r_password', 'pass.length');
                }
                return back()->with('r_password', 'pass.req');
            }
            return back()->with('r_email', 'email.val');
        }
        return back()->with('r_email', 'email.req');
    }
}
