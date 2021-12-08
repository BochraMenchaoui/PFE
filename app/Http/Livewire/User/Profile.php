<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $photo;
    public $emailToggled = false;
    public $nameToggled  = false;

    protected $listeners = ['render', 'delete'];

    /*
    TODO:
        1. zid email fil card zeda, bsh yabda yaarf email mteeou ahwka
    */
    protected function rules()
    {
        return [
            'name'                  => 'required|min:4|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'current_password'      => 'required|string|min:8',
            'password'              => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    protected $messages = [
        'name.required'                  => 'El esm maykounesh fera8.',
        'name.min'                       => 'El esm lezem akther men 4 hrouf.',
        'email.required'                 => 'El mail maykounesh fera8.',
        'email.email'                    => 'Format mta el mail 8alta.',
        'email.unique'                   => 'Email hedha mesta3mel',
        'current_password.required'      => 'El mdp maykounech fera8.',
        'current_password.min'           => 'El mdp lezem akther men 8 hrouf.',
        'password.required'              => 'El mdp maykounech fera8.',
        'password.min'                   => 'El mdp lezem akther men 8 hrouf.',
        'password_confirmation.required' => 'El mdp maykounech fera8.',
        'password_confirmation.min'      => 'El mdp lezem akther men 8 hrouf.',
    ];

    public function setDisplayName()
    {
        $this->name == '' ? $this->user->name = Auth::user()->name : $this->user->name = $this->name;
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'email') {
            $this->setDisplayName();
        }
        $this->validateOnly($propertyName);
    }

    public function updatedName()
    {
        $this->setDisplayName();
    }

    public function deleteUser()
    {
        $this->dispatchBrowserEvent('profile-delete', [
            'title'             => '😞😢😭🥺🥺🥺😭😢😞',
            'text'              => 'Met2ked theb tfaskh el compte mteik?',
            'icon'              => 'error',
            'confirmButtonText' => 'Ey, Met2ked',
            'cancelButtonText'  => 'La',
        ]);
    }

    public function delete()
    {
        if ($this->user->avatar !== 'default.png') {
            File::delete(public_path('images/' . $this->user->avatar));
        }
        $this->user->delete();
        return redirect()->route('login');
    }

    public function updateGeneralInfo()
    {
        $rules = [
            'name'  => $this->nameToggled ? '' : 'required|min:4|max:255',
            'email' => $this->emailToggled ? '' : 'required|string|email|max:255|unique:users',
        ];

        $messages = [
            'name.required'                  => 'El esm maykounesh fera8.',
            'name.min'                       => 'El esm lezem akther men 4 hrouf.',
            'email.required'                 => 'El mail maykounesh fera8.',
            'email.email'                    => 'Format mta el mail 8alta.',
            'email.unique'                   => 'Email hedha mesta3mel',
        ];

        $this->validate($rules, $messages);

        if (!$this->nameToggled) {
            $this->user->name = $this->name;
        }

        if (!$this->emailToggled) {
            $this->user->email             = $this->email;
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        $this->reset(['name', 'email']);

        $this->dispatchBrowserEvent('success', [
            'title' => 'Cbn el mail/mdp tbadel(ou)!',
            'icon'  => 'success',
        ]);
    }

    public function updateUserPassword()
    {
        $this->validate(
            [
                'current_password'      => 'required|string|min:8',
                'password'              => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8',
            ],
            [
                'current_password.required'      => 'El mdp maykounech fera8.',
                'current_password.min'           => 'El mdp lezem akther men 8 hrouf.',
                'password.required'              => 'El mdp maykounech fera8.',
                'password.min'                   => 'El mdp lezem akther men 8 hrouf.',
                'password_confirmation.required' => 'El mdp maykounech fera8.',
                'password_confirmation.min'      => 'El mdp lezem akther men 8 hrouf.',
            ]
        );

        if ($this->password !== $this->password_confirmation) {
            $this->reset(['password_confirmation']);
            return $this->addError('password', 'Password msh kif kif');
        }

        if (Hash::check($this->current_password, $this->user->password)) {
            $this->user->resets()->create([
                'email'      => Auth::user()->email,
                'created_at' => now(),
            ]);

            $this->user->password = Hash::make($this->password);
            $this->user->save();

            Auth::login($this->user);

            $this->reset(['password', 'current_password', 'password_confirmation']);

            return $this->dispatchBrowserEvent('success', [
                'title' => 'Mdpassek tbadel!',
                'icon'  => 'success',
            ]);
        }

        return $this->dispatchBrowserEvent('password-incorrect', [
            'icon'  => 'error',
            'title' => '8aleett...!',
            'text'  => 'Mdpassek le9dim 8alet, zid thabet fih!',
        ]);
    }

    public function updateUserAvatar()
    {
        $this->validate(
            [
                'photo' => 'required|image|max:1024' // TODO: zid msg mte max
            ],
            [
                'photo.required' => 'Lezm tuploadi tasiwra!',
                'photo.image'    => 'Thabet f type mta taswira!',
                'photo.max'      => 'Taswira yessr kbira!',
            ]
        );



        if ($this->user->avatar !== 'default.png') {
            File::delete(public_path('images/' . $this->user->avatar));
        }

        $filname            = Str::random(30) . '.' . $this->photo->extension();
        $this->user->avatar = $filname;
        $this->photo->storeAs('photos', $filname);
        $this->user->save();

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Taswira tbadlet sayé!',
            'icon'  => 'success',
        ]);
    }

    public function toggleDisable($input)
    {

        if ($input === 'email') {
            if ($this->emailToggled) {
                $this->emailToggled = false;
                return;
            }
            $this->emailToggled = true;
            $this->email        = null;
            $this->resetValidation('email');
            $this->resetErrorBag('email');
            return;
        }

        if ($input === 'name') {
            if ($this->nameToggled) {
                $this->nameToggled = false;
                return;
            }
            $this->nameToggled = true;
            $this->name        = null;
            $this->resetValidation('name');
            $this->resetErrorBag('name');
            return;
        }
    }

    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->role === 0) {
            return redirect()->route('admin.profile', ['lang' => app()->getLocale()]);
        }
    }

    public function render()
    {
        return view('livewire.user.profile')
            ->extends('user.layout')
            ->section('content');
    }
}
