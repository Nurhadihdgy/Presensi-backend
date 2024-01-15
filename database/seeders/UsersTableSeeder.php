<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat beberapa data dummy siswa
        $users = [
            [
                'nisn' => '123',
                'nama' => 'John Doe',
                'kelas' => 'XI IPA',
                'no_absen' => '10',
                'password' => Hash::make('123'),
            ],
            [
                'nisn' => '456',
                'nama' => 'Jane Doe',
                'kelas' => 'XII IPS',
                'no_absen' => '5',
                'password' => Hash::make('456'),
            ],
            // Tambahkan data siswa lainnya sesuai kebutuhan
        ];

        // Insert data ke tabel users
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
