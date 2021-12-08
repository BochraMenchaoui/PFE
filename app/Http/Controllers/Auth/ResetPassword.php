<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Controller
{
    public function create(Request $request)
    {
        return view('auth.reset', ['request' => $request]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'token'    => 'required',
                'email'    => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'email.required'     => 'El mail maykounech fera8.',
                'email.email'        => 'Format mta3 mail 8alta.',
                'password.required'  => 'El mdp maykounech feragh.',
                'password.min'       => 'El mdp akther men 8 hrouf.',
                'password.confirmed' => 'El mdp moch kifkif.',
                'token.required'     => 'Token maykounech fera8.',
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        $user = User::where('email', $request->email)->first();

        $user?->resets()->create([
            'email'      => $request->email,
            'token'      => $request->token,
            'created_at' => now(),
        ]);

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'El mdp tbadel.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
