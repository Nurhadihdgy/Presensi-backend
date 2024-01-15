<?php

namespace App\Http\Controllers;

class RegisterViewController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }
}
