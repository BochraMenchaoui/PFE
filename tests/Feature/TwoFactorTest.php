<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Admin\TwoFactorSecurity;

class TwoFactorTest extends TestCase
{
    const USER_ORIGINAL_PASSWORD = 'admin';

    /**
     * Testing validation when password is incorrect.
     */
    public function test_admin_cannot_enable_or_disable_2fa_with_incorrect_password()
    {
        $this->actingAs(User::where('email', 'derja@admin')->first());

        Livewire::test(TwoFactorSecurity::class)
            ->call('isEnabled', 'some-random-password', 1)
            ->assertDispatchedBrowserEvent('password-incorrect', [
                'icon'  => 'error',
                'title' => 'Error...!',
                'text'  => 'Password Incorrect',
            ]);
    }

    /**
     * Testing user ability to enable 2fa when password is correct.
     */
    public function test_admin_can_enable_2fa_with_correct_password()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(TwoFactorSecurity::class)
            ->call('isEnabled', self::USER_ORIGINAL_PASSWORD, 1);

        $this->assertDatabaseHas('password_securities', [
            'user_id'    => $user->id,
            'is_enabled' => 1,
        ]);
    }

    /**
     * Testing user ability to disable 2fa when password is correct.
     */
    public function test_admin_can_disable_2fa_with_correct_password()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        if (is_null($user->password_security)) {
            $user->password_security()->create([
                'is_enabled' => 1,
            ]);
            $user->refresh();
        }

        $user->password_security->is_enabled = 1;
        $user->save();
        $user->refresh();

        Livewire::test(TwoFactorSecurity::class)
            ->call('isEnabled', self::USER_ORIGINAL_PASSWORD, 0);

        $this->assertDatabaseHas('password_securities', [
            'user_id'    => $user->id,
            'is_enabled' => 0,
        ]);
    }
}
