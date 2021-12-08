<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\WelcomeNotification;

class CreateUser extends Component
{
    protected $listeners = ['refreshComponent' => 'render'];

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $createdUserId;
    public $role        = 2;
    public $badge       = 2;
    public $passwordSet = false;


    protected $rules = [
        'name'     => 'required|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'role'     => 'required',
    ];

    public function updatedRole()
    {
        $this->dispatchBrowserEvent('name-updated', ['badge' => $this->role]);
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name'              => $this->name,
            'email'             => $this->email,
            'password'          => Hash::make($this->password),
            'role'              => $this->role,
            'email_verified_at' => $this->role === 0 ? now() : null,
        ]);

        if ($this->role !== 0) {
            $user->notify(new WelcomeNotification());
            event(new Registered($user));
        }

        $this->createdUserId = $user->id;

        $this->dispatchBrowserEvent('user-created', [
            'title' => 'User created successfully.',
            'icon'  => 'success',
        ]);
    }

    public function setDefaultPassword()
    {
        if (!$this->passwordSet) {
            $this->password              = 'password';
            $this->password_confirmation = 'password';
            $this->passwordSet = true;
            return;
        }
        $this->reset(['password', 'password_confirmation', 'passwordSet']);
    }

    public function render()
    {
        return view('livewire.admin.create-user')
            ->extends('admin.layout')
            ->section('content');
    }
}
