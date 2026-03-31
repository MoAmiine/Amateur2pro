<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect('/tournois');
    }
    }
    

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        Auth::login($user); 
        return redirect('/tournois');
    }
}

