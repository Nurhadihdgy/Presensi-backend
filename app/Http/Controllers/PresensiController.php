<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyAttendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PresensiController extends Controller
{
    public function presensi(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Cek apakah lokasi dalam radius 200 meter dari lokasi acuan
        $lokasiAcuan = ['latitude_acuan' => -6.198440293371932, 'longitude_acuan' => 106.92559116563115]; // Ganti dengan lokasi acuan sebenarnya
        $radiusMaksimal = 200;

        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $lokasiAcuan['latitude_acuan'],
            $lokasiAcuan['longitude_acuan']
        );

        if ($distance <= $radiusMaksimal) {
            // Lokasi dalam radius, lakukan presensi
            $now = Carbon::now('Asia/Jakarta');
            $waktuAbsen = $now->format('Y-m-d H:i:s');

            // Periksa apakah pengguna sudah absen hari ini
            $user = Auth::user();
            $presensiHariIni = DailyAttendance::where('user_id', $user->id)
                ->whereDate('waktu_absen', $now->toDateString())
                ->first();

            if ($presensiHariIni) {
                // Pengguna sudah absen hari ini
                return response()->json(['message' => 'Anda sudah absen hari ini'], 400);
            }

            // Periksa apakah waktu absen sesuai aturan
            if ($now->gte($now->copy()->setTime(05, 00, 0)) && $now->lte($now->copy()->setTime(15, 00, 0))) {
                // Hitung keterlambatan
                $waktuBatasTelat = $now->copy()->setTime(06, 30, 0);
                $telat = $now->gt($waktuBatasTelat);
                $menitTelat = $telat ? $now->diffInMinutes($waktuBatasTelat) : null;

                // Tentukan nilai 'telat' dan 'menit_telat'
            $telatValue = $telat ? 1 : 0;
            $menitTelatValue = $telat ? $menitTelat : null;

                // Simpan presensi
                $lokasiPresensi = "Presensi berhasil di lokasi: Latitude {$request->latitude}, Longitude {$request->longitude}";
                $presensi = DailyAttendance::create([
                    'user_id' => $user->id,
                    'tanggal_absen' => $now->toDateString(),
                    'waktu_absen' => $waktuAbsen,
                    'telat' => $telatValue,
                    'menit_telat' => $menitTelatValue,
                    'lokasi' => $lokasiPresensi,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]);

                return response()->json(['message' => 'Presensi berhasil', 'presensi' => $presensi], 200);
            } else {
                // Waktu absen di luar aturan
                return response()->json(['message' => 'Waktu absen tidak sesuai aturan'], 400);
            }
        } else {
            // Lokasi diluar radius
            return response()->json(['message' => 'Lokasi diluar radius, presensi tidak dapat dilakukan'], 400);
        }
    }


    public function getUserAttendance()
    {
        $user = Auth::user();

        // Ambil data presensi untuk pengguna tertentu
        $userAttendance = DailyAttendance::where('user_id', $user->id)->get();

        // Ambil informasi pengguna
        $userInfo = [
            'nisn' => $user->nisn,
            'nama' => $user->nama,
            'kelas' => $user->kelas,
            'no_absen' => $user->no_absen,
        ];

        return response()->json(['user_info' => $userInfo, 'presensi' => $userAttendance], 200);
    }
    // Fungsi untuk menghitung jarak antara dua titik koordinat
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers * 1000; // Dalam meter
    }
}
