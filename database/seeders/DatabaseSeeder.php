<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder untuk akun Superadmin dan data dummy absensi 100 karyawan
        $this->call([
            UserSeeder::class,
            AttendanceDummySeeder::class,
        ]);
    }
}