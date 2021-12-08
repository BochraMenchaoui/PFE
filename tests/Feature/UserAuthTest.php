<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class UserAuthTest extends TestCase
{
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/sign-in');
        $response->assertSuccessful();
        $response->assertSeeLivewire('join.sign-in');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/sign-in');
        $response->assertRedirect();
    }

    // * Testing the HelperController
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create();
        $response = $this->post('/validate', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $this->assertGuest();
        $response = $this->from('/validate')->post('/validate', [
            'email'    => 'some_random@email',
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/sign-in');
        $response->assertSessionHas('message');
        $this->assertFalse(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
    }
}
