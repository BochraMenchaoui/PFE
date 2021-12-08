<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Livewire\Admin\AdminProfile;

class ConnectedDevicesTest extends TestCase
{
    const USER_ORIGINAL_PASSWORD = 'admin';

    /**
     * Testing validation when password is incorrect.
     */
    public function test_admin_cannot_logout_other_devices_with_incorrect_password()
    {
        $this->actingAs(User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->call('logoutDevices', 'some-random-password')
            ->assertDispatchedBrowserEvent('password-incorrect', [
                'icon'  => 'error',
                'title' => 'Error...!',
                'text'  => 'Password Incorrect',
            ]);
    }

    /**
     * Testing user is able to force the log out of all other connected devices.
     */
    public function test_admin_can_logout_other_devices_with_correct_password()
    {
        $this->actingAs(User::where('email', 'derja@admin')->first());

        $devices[] = [
            'id'           => Session::getId(),
            'ip'           => '127.0.0.1',
            'browser'      => 'firefox',
            'platform'     => 'linux',
            'country'      => 'Tunis',
            'city'         => 'Tunis',
            'connected_at' => now(),
        ];

        Cache::put('connected-devices', $devices);

        Livewire::test(AdminProfile::class)
            ->call('logoutDevices', self::USER_ORIGINAL_PASSWORD)
            ->assertDispatchedBrowserEvent('success', [
                'title' => 'Successfully done!',
                'icon'  => 'success',
            ]);
    }
}
