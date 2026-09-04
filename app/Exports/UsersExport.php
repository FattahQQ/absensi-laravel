<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::latest()->get();
    }

    // Header Kolom di Excel
    public function headings(): array
    {
        return [
            'ID',
            'Nama Pegawai',
            'Email',
            'Hak Akses (Role)',
            'Tanggal Terdaftar',
        ];
    }

    // Mapping Data Per Baris
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            ucfirst($user->role ?? 'Pegawai'),
            $user->created_at->format('d-m-Y H:i'),
        ];
    }
}