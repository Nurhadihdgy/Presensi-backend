<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Pastikan trait HasApiTokens ditambahkan
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $fillable = ['nisn',
    'nama',
    'kelas',
    'no_absen',
    'password',];
    protected $hidden = ['password', 'remember_token'];

    public static function generatePassword($noAbsen, $nisn)
    {
        // Menggunakan substr dari no_absen dan nisn untuk membuat password
        return bcrypt(substr($noAbsen, -2) . $nisn);
    }

    public function dailyAttendances()
    {
        return $this->hasMany(DailyAttendance::class, 'user_id', 'id');
    }

    
}
