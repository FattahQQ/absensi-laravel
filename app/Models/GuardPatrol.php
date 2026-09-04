<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardPatrol extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_checkpoint',
        'kode_qr',
        'jadwal_patroli',
        'status',
    ];
}