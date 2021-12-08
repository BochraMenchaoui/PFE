<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmail extends Controller
{
    /**
     * Displays Verify Email view.
     *
     * @return void
     */
    public function index()
    {
        return view('auth.verify-email');
    }

    /**
     * Validates hash and hash to verify user's email.
     *
     * @param EmailVerificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('search');
    }

    /**
     * Handles email verification resend.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', '3awedna bathnelek mail jdid bara tfakdou!');
    }
}
