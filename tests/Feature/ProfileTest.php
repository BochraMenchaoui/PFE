<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Livewire\Admin\AdminProfile;

class ProfileTest extends TestCase
{
    const USER_ORIGINAL_PASSWORD = 'admin';

    /**
     * Testing required field validation.
     */
    public function test_user_cannot_update_general_informations_with_empty_input()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        $name  = $user->name;
        $email = $user->email;

        Livewire::test(AdminProfile::class)
            ->set('name', null)
            ->set('email', null)
            ->call('updateGeneralInfo')
            ->assertHasErrors(['name' => 'required', 'email' => 'required']);

        $this->assertTrue($name === $user->name);
        $this->assertTrue($email === $user->email);
    }

    /**
     * Testing multiple validation fields for name and email.
     */
    public function test_user_cannot_update_general_informations_with_invalid_input()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        $name  = $user->name;
        $email = $user->email;

        Livewire::test(AdminProfile::class)
            ->set('name', Str::random(60))
            ->set('email', 'not-an-email')
            ->call('updateGeneralInfo')
            ->assertHasErrors([
                'name'  => ['max'],
                'email' => ['email']
            ]);

        $this->assertTrue($name === $user->name);
        $this->assertTrue($email === $user->email);
    }

    /**
     * Testing users updates on columns name and email.
     */
    public function test_user_can_update_general_informations_with_valid_input()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        $name  = 'Example';
        $email = 'example@email.com';
        $data  = [
            'title' => 'Profile updated successfully!',
            'icon'  => 'success',
        ];

        Livewire::test(AdminProfile::class)
            ->set('name', $name)
            ->set('email', $email)
            ->call('updateGeneralInfo')
            ->assertHasNoErrors(['name', 'email'])
            ->assertSet('name', null)
            ->assertSet('email', null)
            ->assertDispatchedBrowserEvent('success', $data);

        $this->assertTrue($name !== $user->name);
        $this->assertTrue($email !== $user->email);
    }

    /**
     * Testing required field validation.
     */
    public function test_user_cannot_update_password_with_empty_input()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->set('current_password', null)
            ->set('password', null)
            ->call('updateAdminPassword')
            ->assertHasErrors(['current_password' => 'required', 'password' => 'required']);

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing multiple validation fields for password and current password.
     */
    public function test_user_cannot_update_password_with_invalid_input()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->set('current_password', '123')
            ->set('password', '123')
            ->call('updateAdminPassword')
            ->assertHasErrors(['current_password' => 'min', 'password' => 'min']);

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing confirmed field.
     */
    public function test_user_cannot_update_password_when_mismatched()
    {
        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->set('password', 'passwords')
            ->set('password_confirmation', 'not-equals')
            ->call('updateAdminPassword')
            ->assertHasErrors(['password' => 'confirmed']);

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing validation when current password is incorrect.
     */
    public function test_user_cannot_update_password_when_the_old_one_is_incorrect()
    {
        $data = [
            'icon'  => 'error',
            'title' => 'Incorrect...!',
            'text'  => 'Your old password is incorrect.',
        ];

        $new_password = 'my-new-secret-password';

        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->set('current_password', 'incorrect-password')
            ->set('password', $new_password)
            ->set('password_confirmation', $new_password)
            ->call('updateAdminPassword')
            ->assertHasNoErrors(['current_password', 'password'])
            ->assertDispatchedBrowserEvent('password-incorrect', $data);

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing users updates on column password.
     */
    public function test_user_can_update_password_when_everything_is_valid()
    {
        $data = [
            'title' => 'Password updated successfully!',
            'icon'  => 'success',
        ];

        $new_password = 'my-new-secret-password';

        $this->actingAs($user = User::where('email', 'derja@admin')->first());

        Livewire::test(AdminProfile::class)
            ->set('current_password', self::USER_ORIGINAL_PASSWORD)
            ->set('password', $new_password)
            ->set('password_confirmation', $new_password)
            ->call('updateAdminPassword')
            ->assertHasNoErrors(['current_password', 'password'])
            ->assertSet('current_password', null)
            ->assertSet('password', null)
            ->assertDispatchedBrowserEvent('success', $data);

        $user->refresh();

        $this->assertFalse(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));

        $this->assertTrue(Hash::check($new_password, $user->password));
    }
}
