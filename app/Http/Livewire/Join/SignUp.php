<?php

namespace App\Http\Livewire\Join;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class SignUp extends Component
{
    public $name;
    public $email;
    public $password;
    public $show = false;

    protected $rules = [
        'name'     => 'required|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'name.required'     => 'El esm maykounech fera8.',
        'email.required'    => 'El mail maykounech fera8.',
        'email.email'       => 'Format mta3 mail 8alta.',
        'email.unique'      => 'El mail hedha mesta3mel deja',
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
     * Handles user registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = Hash::make($validatedData['password']);

        Auth::login($user = User::create($validatedData));
        Notification::send($user, new WelcomeNotification());
        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.join.sign-up')
            ->extends('pixel')
            ->section('content');
    }
}
