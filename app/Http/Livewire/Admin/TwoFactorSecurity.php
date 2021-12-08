<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TwoFactorSecurity extends Component
{
    protected $listeners = ['isEnabled', 'render'];

    public $enabled;

    public function requestPassword($option, $enable)
    {
        if ($option !== 1)
            return;

        $this->dispatchBrowserEvent('get-password', [
            'title'            => 'Enable 2FA',
            'input'            => 'password',
            'inputLabel'       => 'Please enter current password',
            'option'           => $option,
            'enable'           => $enable,
        ]);
    }

    public function isEnabled($password, $enable)
    {
        if (!Hash::check($password, Auth::user()->password)) {
            return $this->dispatchBrowserEvent('password-incorrect', [
                'icon'  => 'error',
                'title' => 'Error...!',
                'text'  => 'Password Incorrect',
            ]);
        }

        $user = auth()->user();

        if (is_null($user->password_security) && $enable == 1) {
            $user->password_security()->create([
                'is_enabled' => 1,
            ]);

            return $this->emit('render');
        }

        $enable == 1 ? $user->password_security->is_enabled = 1 : $user->password_security->is_enabled = 0;

        $user->password_security->save();
    }

    public function render()
    {
        Auth::user()->password_security?->is_enabled == 1 ? $this->enabled = true : $this->enabled = false;
        return view('livewire.admin.two-factor-security');
    }
}
