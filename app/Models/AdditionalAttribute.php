<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_atribut',
        'tipe_data',
        'keterangan',
        'status',
    ];
}