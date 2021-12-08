<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Http\Livewire\Admin\CreateUser;
use App\Http\Livewire\Admin\UserDetail;
use App\Http\Livewire\Admin\TrashedUsers;
use App\Notifications\WelcomeNotification;
use App\Http\Livewire\Admin\UserManagement;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordResetNotification;

class UserManagementTest extends TestCase
{

    public function actingAsAdmin()
    {
        return $this
            ->actingAs(User::where('email', 'derja@admin')->first());
    }

    public function test_user_cannot_see_or_perform_any_action_to_users()
    {
        $this
            ->actingAs(User::find(random_int(2, 15)))
            ->from(route('profile'))
            ->get(route('admin.users'))
            ->assertRedirect(route('profile'));
    }

    public function test_admin_cannnot_perfom_any_action_to_users_when_not_authenticated()
    {
        $this
            ->get(route('admin.users'))
            ->assertRedirect(route('admin.login', ['lang' => app()->getLocale()]));
    }

    public function test_admin_can_create_users_when_authenticated()
    {
        Event::fake();

        $this->assertDatabaseMissing('users', [
            'email' => 'user@example.com',
        ]);

        $this->actingAsAdmin();

        Livewire::test(CreateUser::class)
            ->set('name', 'New User')
            ->set('email', 'user@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 2)
            ->call('store')
            ->assertDispatchedBrowserEvent('user-created', [
                'title' => 'User created successfully.',
                'icon'  => 'success',
            ]);

        Notification::assertSentTo(User::where('email', 'user@example.com')->first(), WelcomeNotification::class);
        Event::assertDispatched(Registered::class);

        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
        ]);
    }

    public function test_admin_can_read_all_users_when_authenticated()
    {
        $this->actingAsAdmin()
            ->get(route('admin.users'))
            ->assertSuccessful()
            ->assertSeeLivewire('admin.user-management');
    }

    public function test_admin_can_update_users_when_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAsAdmin();

        $this->assertDatabaseHas('users', [
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        Livewire::test(UserDetail::class, [
            'id'   => $user->id,
            'data' => [
                'wordsPerYear'    => 10,
                'commentsPerYear' => 10,
                'likesPerYear'    => 10,
                'dislikesPerYear' => 10,
            ]
        ])
            ->set('name', 'John Doe')
            ->set('role', 2)
            ->call('updateUserInfo')
            ->assertHasNoErrors(['name'])
            ->assertDispatchedBrowserEvent('user-updated', [
                'title' => 'User updated successfully!',
                'icon'  => 'success',
            ]);

        $this->assertDatabaseMissing('users', [
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        $this->assertDatabaseHas('users', [
            'name'  => 'John Doe',
            'email' => $user->email,
        ]);
    }

    public function test_admin_can_reset_users_passwords_when_authenticated()
    {

        $user = User::factory()->create([
            'password' => Hash::make('secret'),
        ]);

        $this->assertFalse(Hash::check('password', $user->password));
        $this->actingAsAdmin();
        Livewire::test(UserDetail::class, [
            'id' => $user->id,
        ])
            ->call('resetPassword')
            ->assertDispatchedBrowserEvent('user-updated', [
                'title' => 'User updated successfully!',
                'icon'  => 'success',
            ]);
        Notification::assertSentTo($user, PasswordResetNotification::class);
        $user->refresh();

        $this->assertDatabaseHas('resets', [
            'user_id' => $user->id,
            'email' => $user->email,
        ]);

        $this->assertTrue(Hash::check('password', $user->password));
    }

    public function test_admin_can_delete_users_when_authenticated()
    {
        $this->actingAsAdmin();

        $user = User::factory()->create();

        Livewire::test(UserManagement::class)
            ->set('targetUser', $user->id)
            ->call('delete');

        $this->assertSoftDeleted($user);
    }

    public function test_admin_can_restore_users_when_authenticated()
    {
        $this->actingAsAdmin();

        $user = User::factory()->create();

        $email = $user->email;

        $user->delete();
        $this->assertSoftDeleted($user);

        Livewire::test(TrashedUsers::class)
            ->call('restore', $user->id);

        $this->assertDatabaseHas('users', [
            'email'      => $email,
            'deleted_at' => null,
        ]);
    }
}
