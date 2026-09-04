<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultUsers = [
            [
                'email' => 'superadmin@lspkimia.com',
                'name' => 'Superadmin LSP',
                'password' => 'password123',
                'role' => 'superadmin',
            ],
            [
                'email' => 'manager@lspkimia.com',
                'name' => 'Manager LSP',
                'password' => 'password123',
                'role' => 'manager',
            ],
            [
                'email' => 'karyawan@lspkimia.com',
                'name' => 'Karyawan LSP',
                'password' => 'password123',
                'role' => 'karyawan',
            ],
        ];

        foreach ($defaultUsers as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'email_verified_at' => now(),
                ]
            );

            User::where('email', $user['email'])
                ->update(['email_verified_at' => now(), 'role' => $user['role']]);
        }
    }
}