<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Hindari duplikasi email jika pegawai sudah ada di database
        $existingUser = User::where('email', $row['email'])->first();
        if ($existingUser) {
            return null;
        }

        return new User([
            'name'     => $row['nama_pegawai'] ?? $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password'] ?? 'password123'),
            'role'     => strtolower($row['role'] ?? 'pegawai'),
        ]);
    }
}