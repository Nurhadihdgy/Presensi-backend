<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|unique:users',
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'no_absen' => 'required|string|unique:users',
        ]);

        $password = User::generatePassword($request->no_absen, $request->nisn);

        $user = User::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'no_absen' => $request->no_absen,
            'password' => $password,
        ]);

        $message = 'Registration successfully';

        return response()->json(['message' => $message, 'user' => $user], 201);
        return redirect()->route('login')->with('success', $message);
    }
}
