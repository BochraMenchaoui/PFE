<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Traits\CacheUpdate;
use App\Http\Controllers\Controller;
use App\Notifications\AdminLoggedInLoggedOutNotification;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    use CacheUpdate, AuthenticatesUsers;

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->password_security?->is_enabled === 1) {
            $user->generateTwoFactorCode(); // make sure to check he has it on;
            $user->notify(new TwoFactorCode());
        }
    }

    /**
     * Handles admin authentication.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 0;

        if (Auth::attempt($credentials, (bool)$request->remember_me)) {
            $this->authenticated($request, Auth::user());
            Auth::user()->last_login = now();
            Auth::user()->save();
            return redirect()->route('admin.profile', ['lang' => app()->getLocale()]);
        }
        return back()->with('status', __('Incorrect Details, Try again!'));
    }

    /**
     * Handles admin logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        auth()->user()->notify(new AdminLoggedInLoggedOutNotification());
        $this->updateCache();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login', ['lang' => app()->getLocale()]);
    }
}
