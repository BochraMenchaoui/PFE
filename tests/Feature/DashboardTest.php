<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_user_cannot_see_dashboard()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->from(route('search'))
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('search'));
    }

    public function test_admin_cannot_see_dashboard_when_not_authenticated()
    {
        $this
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login', ['lang' => app()->getLocale()]));
    }

    public function test_admin_can_see_dashboard_when_authenticated()
    {
        $user = User::where('email', 'derja@admin')->first();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertViewIs('admin.pages.dashboard');
    }
}
