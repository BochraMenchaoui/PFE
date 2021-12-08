<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Join\SignUp;
use App\Providers\RouteServiceProvider;

class RegistrationTest extends TestCase
{

    public function test_user_can_see_registration_form()
    {
        $this->get('/sign-up')
            ->assertSuccessful()
            ->assertSeeLivewire('join.sign-up');
    }

    public function test_new_users_can_register()
    {
        Livewire::test(SignUp::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->call('saveUser')
            ->assertRedirect(RouteServiceProvider::HOME);
    }
}
