<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CacheUpdate;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    use CacheUpdate;

    /**
     * Checks if 2FA is enabled.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->password_security?->is_enabled == 1) {
                return redirect()->back();
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.lock');
    }

    /*
    TODO:
        1. ken haka naaml custom middle li fih redirect b flash message mte too many requests
    */
    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        try {
            $user->notify(new TwoFactorCode());
        } catch (\Throwable $th) {
            return 'mail server down';
        }

        return redirect()->back()->with('success', 'The two factor code has been sent again.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = auth()->user();

        if ($user->password_security->two_factor_expires_at?->lt(now())) {
            $user->resetTwoFactorCode();
            $this->updateCache();
            auth()->logout();

            return redirect()->route('admin.login')->with('status', 'Your code has expired, please log in again.');
        }

        if ($request->input('code') == $user->password_security->two_factor_code) {
            $user->resetTwoFactorCode();

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('message', 'The code you have entered does not match.');
    }
}
