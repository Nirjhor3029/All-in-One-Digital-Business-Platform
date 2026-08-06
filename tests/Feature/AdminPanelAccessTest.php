<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminPanelAccessTest extends TestCase
{
    public function test_regular_user_gets_403_on_admin_panel(): void
    {
        $user = User::where('email', 'user@apnarbusiness.com')->first();
        $this->assertNotNull($user);

        $response = $this->actingAs($user, 'web')->get('/admin');
        $response->assertForbidden();
    }

    public function test_admin_can_reach_admin_panel(): void
    {
        $admin = User::where('email', 'admin@apnarbusiness.com')->first();
        $this->assertNotNull($admin);

        $response = $this->actingAs($admin, 'web')->get('/admin');
        $response->assertStatus(200);
    }
}