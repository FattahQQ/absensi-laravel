<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationSecurityTest extends TestCase
{
    public function test_cannot_register_admin_role_via_public_registration(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Manager Baru',
            'email' => 'manager.new@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'manager',
        ]);

        $response->assertSessionHasErrors('role');
    }

    public function test_authenticated_user_can_access_protected_routes_without_email_verification(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'internal.user@example.com',
            'role' => 'superadmin',
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
    }
}
