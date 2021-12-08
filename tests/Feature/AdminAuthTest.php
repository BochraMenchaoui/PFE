<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AdminAuthTest extends TestCase
{
    public function test_admin_can_view_a_login_form()
    {
        $response = $this->get('/admin/login');
        $response->assertSuccessful();
        $response->assertViewIs('admin.login');
    }

    public function test_admin_cannot_view_a_login_form_when_authenticated()
    {
        $response = $this->actingAs(User::where('email', 'derja@admin')->first())->get('/admin/login');
        $response->assertRedirect();
    }

    public function test_admin_can_login_with_correct_credentials()
    {
        $response = $this->post('/admin/validate', [
            'email'    => 'derja@admin',
            'password' => 'admin',
        ]);

        $response->assertRedirect('/admin/profile?lang=' . app()->getLocale());
        $this->assertAuthenticatedAs(User::where('email', 'derja@admin')->first());
    }

    public function test_admin_cannot_login_with_incorrect_credentials()
    {
        $this->assertGuest();
        $response = $this->from('/admin/login')->post('/admin/validate', [
            'email'    => 'some_random@email',
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHas('status');
        $this->assertFalse(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
    }
}
