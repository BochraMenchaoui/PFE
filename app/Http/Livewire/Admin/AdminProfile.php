<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\CacheUpdate;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AdminProfile extends Component
{
    use WithFileUploads, CacheUpdate;

    public $name;
    public $email;
    public $password;
    public $current_password;
    public $password_confirmation;
    public $photo;

    /*
        TODO:
            1. Maybe Add ban device.
            2. a9ra hseb el android.
    */

    protected $listeners = ['logoutDevices', 'renderComponent' => 'render'];

    public function updateGeneralInfo()
    {
        $this->validate([
            'name'  => 'required|max:50',
            'email' => 'required|string|email|max:255',
        ]);

        $user        = User::find(Auth::id());
        $user->name  = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->reset(['name', 'email']);

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Profile updated successfully!',
            'icon'  => 'success',
        ]);
    }

    public function updateAdminPassword()
    {
        $this->validate([
            'current_password' => 'required|string|min:4',
            'password'         => 'required|string|confirmed|min:4',
        ]);

        $user  = User::find(Auth::id());

        if (Hash::check($this->current_password, $user->password)) {
            $user->password = Hash::make($this->password);
            $user->save();

            Auth::login($user);

            Cache::forget('connected-devices');

            $this->reset(['password', 'current_password', 'password_confirmation']);

            return $this->dispatchBrowserEvent('success', [
                'title' => 'Password updated successfully!',
                'icon'  => 'success',
            ]);
        }

        return $this->dispatchBrowserEvent('password-incorrect', [
            'icon'  => 'error',
            'title' => 'Incorrect...!',
            'text'  => 'Your old password is incorrect.',
        ]);
    }

    public function updateAdminAvatar()
    {
        $this->validate(['photo' => 'image|max:1024'], ['photo.image' => 'Please upload an image.']);

        $user  = User::find(Auth::id());

        if ($user->avatar !== 'default.png') {
            File::delete(public_path('images/' . $user->avatar));
        }

        $filname      = Str::random(30) . '.' . $this->photo->extension();
        $user->avatar = $filname;
        $this->photo->storeAs('photos', $filname);
        $user->save();

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Avatar updated successfully!',
            'icon'  => 'success',
        ]);
    }

    public function requestPassword($option)
    {
        if ($option !== 0)
            return;

        $this->dispatchBrowserEvent('get-password', [
            'title'            => 'Log out other devices',
            'input'            => 'password',
            'inputLabel'       => 'Please enter current password',
            'option'           => $option,
        ]);
    }

    public function logoutDevices($password)
    {
        if (!Hash::check($password, Auth::user()->password)) {
            return $this->dispatchBrowserEvent('password-incorrect', [
                'icon'  => 'error',
                'title' => 'Error...!',
                'text'  => 'Password Incorrect',
            ]);
        }

        Auth::logoutOtherDevices($password);
        $adminDevice[] = $this->getDevice();

        Cache::forget('connected-devices');
        Cache::put('connected-devices', $adminDevice);

        return $this->dispatchBrowserEvent('success', [
            'title' => 'Successfully done!',
            'icon'  => 'success',
        ]);
    }

    public function render()
    {
        // $agent = new Agent();
        return view('livewire.admin.admin-profile', [
            'devices' => Cache::get('connected-devices'),
            'current' => Session::getId(),
        ]);
    }
}
