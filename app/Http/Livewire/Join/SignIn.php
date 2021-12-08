<?php

namespace App\Http\Livewire\Join;

use App\Models\User;
use App\Notifications\CollaboratorOnlineOfflineNotification;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;

class SignIn extends Component
{
    public $email;
    public $password;
    public $remember_me;
    public $show = false;

    /*
        TODO: awed hel cmpt b aabed ekher w shouf ken mazel l ghalta wala le sinn awed shouf lahkia.
    */
    protected $rules = [
        'email'    => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'email.required'    => 'El mail maykounech fera8.',
        'email.email'       => 'Format mta3 mail 8alta.',
        'password.required' => 'El mdp maykounech feragh.',
        'password.min'      => 'El mdp akther men 8 hrouf.',
    ];

    protected $validationAttributes = [
        'email' => 'email address'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showPassword()
    {
        !$this->show ? $this->show = true : $this->show = false;
    }

    /**
     * Handles user login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authUser()
    {
        $validatedData = $this->validate();

        if (!Auth::attempt($validatedData, $this->remember_me)) {
            $user = User::withTrashed()->where('email', $this->email)->first();

            if ($user) {
                if (!is_null($user->deleted_at)) {
                    session()->flash('message', 'El cmpt mteik tfaskh le ' . $user->deleted_at->format('d M, H:i'));
                    return $this->reset(['email', 'password']);
                }

                if (!$user?->resets->isEmpty()) {
                    session()->flash('message', 'El mdp tbadil le ' . $user?->resets->first()->created_at->format('d M, H:i'));
                    return $this->reset('password');
                }
            }

            session()->flash('message', 'El mail wala mdp 8altin.');
            return $this->reset(['email', 'password']);
        }

        if (Auth::user()->role === 1) {
            $members = User::where('role', 1)->get();
            Notification::send($members, new CollaboratorOnlineOfflineNotification());
        }

        Auth::user()->last_login = now();
        Auth::user()->save();

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.join.sign-in')
            ->extends('pixel')
            ->section('content');
    }
}
