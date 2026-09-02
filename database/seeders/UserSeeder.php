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
            'id'       => 1,
            'name'     => 'Karyawan Test',
            'email'    => 'karyawan@test.com',
            'password' => Hash::make('password123'),
        ]);
    }
}