<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    use HasFactory;
    protected $table = 'presensi_harian';

    protected $fillable = [
        'user_id',
        'tanggal_absen',
        'waktu_absen',
        'telat',
        'menit_telat',
        'lokasi',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
