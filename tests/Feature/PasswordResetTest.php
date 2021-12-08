<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class PasswordResetTest extends TestCase
{
    use WithFaker;

    const ROUTE_PASSWORD_EMAIL        = 'password.email';
    const ROUTE_PASSWORD_REQUEST      = 'password.request';
    const ROUTE_PASSWORD_RESET        = 'password.reset';
    const ROUTE_PASSWORD_RESET_SUBMIT = 'password.update';
    const ROUTE_LOGIN                 = 'login';
    const USER_ORIGINAL_PASSWORD      = 'password';

    /**
     * Testing showing the password reset request page.
     */
    public function test_user_can_view_password_reset_form()
    {
        $this
            ->get(route(self::ROUTE_PASSWORD_REQUEST))
            ->assertSuccessful()
            ->assertViewIs('auth.forgot');
    }

    /**
     * Testing submitting the password reset request with an invalid
     * email address.
     */
    public function test_does_not_send_a_link_when_email_does_not_exist()
    {
        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => 'invalid@email.com',
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.user'));
    }

    /**
     * Testing submitting a password reset request.
     */
    public function test_user_receives_an_email_with_a_password_reset_link_when_email_exists()
    {
        $user = User::factory()->create();

        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_REQUEST))
            ->post(route(self::ROUTE_PASSWORD_EMAIL), [
                'email' => $user->email,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.sent'));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * Testing showing the reset password page.
     */
    public function test_user_can_see_password_reset_page()
    {
        $user  = User::factory()->create();
        $token = Password::broker()->createToken($user);

        $this
            ->get(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->assertSuccessful()
            ->assertViewIs('auth.reset');
    }

    /**
     * Testing submitting the password reset page with an invalid
     * email address.
     */
    public function test_user_cannot_update_password_using_invalid_email()
    {
        $user     = User::factory()->create();
        $token    = Password::broker()->createToken($user);
        $password = Str::random(15);

        $this
            ->followingRedirects()
            ->from(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
                'token'                 => $token,
                'email'                 => 'invalid@email.com',
                'password'              => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.user'));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing submitting the password reset page with a password
     * that doesn't match the password confirmation.
     */
    public function test_user_cannot_update_password_when_mismatched()
    {
        $user                  = User::factory()->create();
        $token                 = Password::broker()->createToken($user);
        $password              = Str::random(15);
        $password_confirmation = Str::random(15);

        $this
            ->from(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
                'token'                 => $token,
                'email'                 => $user->email,
                'password'              => $password,
                'password_confirmation' => $password_confirmation,
            ])
            ->assertRedirect(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->assertSessionHasErrors('password');

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));
    }

    /**
     * Testing submitting the password reset page.
     */
    public function test_user_can_upate_password_with_valid_inputs()
    {
        $user     = User::factory()->create();
        $token    = Password::broker()->createToken($user);
        $password = Str::random(15);

        $this
            ->from(route(self::ROUTE_PASSWORD_RESET, [
                'token' => $token,
            ]))
            ->post(route(self::ROUTE_PASSWORD_RESET_SUBMIT), [
                'token'                 => $token,
                'email'                 => $user->email,
                'password'              => $password,
                'password_confirmation' => $password,
            ])
            ->assertRedirect(route(self::ROUTE_LOGIN))
            ->assertSessionHas('success');

        $user->refresh();

        $this->assertFalse(Hash::check(
            self::USER_ORIGINAL_PASSWORD,
            $user->password
        ));

        $this->assertTrue(Hash::check($password, $user->password));
    }
}
