<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Buat user baru
        $user = \App\Models\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Login otomatis setelah registrasi
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }
    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Ini bagian pentingnya: arahkan ke halaman welcome (/)
    return redirect('/');
    }
}
