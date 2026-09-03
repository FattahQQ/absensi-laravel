<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Superadmin LSP',
            'email'    => 'superadmin@lspkimia.com',
            'password' => Hash::make(''),
            'role'     => 'superadmin', // Kunci agar terdeteksi sebagai superadmin
        ]);
    }
}