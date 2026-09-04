<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipe',
        'tanggal',
        'waktu',
        'status',
        'latitude',
        'longitude',
        'foto',
        'catatan',
        // Kolom kalkulasi & poin disiplin baru
        'clock_in',
        'clock_out',
        'work_duration',
        'late_minutes',
        'early_leave_minutes',
        'discipline_points',
        'action_taken',
        'incentive_penalty_pct',
        'notes',
    ];

    /**
     * Relasi balik ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}