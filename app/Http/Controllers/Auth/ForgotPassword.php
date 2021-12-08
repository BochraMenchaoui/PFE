<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function handler(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.email'    => 'Format mta3 el mail 8alta.',
                'email.required' => 'El mail maykounech fera8.',
            ]
        );

        $user = User::where('email', '=', $request->email)->first();

        if ($user?->provider) {
            return back()->with(['message' => 'Ma3andekech el 7a9 tbadel el mdp.']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __('passwords.sent')])
            : back()->withErrors(['email' => __($status)]);
    }
}
