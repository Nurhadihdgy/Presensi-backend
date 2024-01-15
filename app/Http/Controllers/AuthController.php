<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = request(['nisn', 'password']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'nisn' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = $request->user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['message' => 'User login berhasil','token' => $token, 'user' => $user]);
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function checkAuthenticationStatus()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            return response()->json(['message' => 'User is authenticated', 'authenticated' => true]);
        }

        return response()->json(['message' => 'User is not authenticated', 'authenticated' => false]);
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }

   
    public function getAuthenticatedUser(Request $request)
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }
}
