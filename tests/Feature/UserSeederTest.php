<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    public function test_superadmin_user_seeder_is_idempotent(): void
    {
        $this->artisan('db:seed', ['--class' => UserSeeder::class]);
        $this->artisan('db:seed', ['--class' => UserSeeder::class]);

        $this->assertSame(1, User::where('email', 'superadmin@lspkimia.com')->count());
    }

    public function test_demo_accounts_are_seeded_with_expected_roles(): void
    {
        $this->artisan('db:seed', ['--class' => UserSeeder::class]);

        $this->assertDatabaseHas('users', [
            'email' => 'superadmin@lspkimia.com',
            'role' => 'superadmin',
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'manager@lspkimia.com',
            'role' => 'manager',
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'karyawan@lspkimia.com',
            'role' => 'karyawan',
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
        ]);
    }
}
