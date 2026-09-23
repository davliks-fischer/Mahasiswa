<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function loginView()
    {
        return view('login');
    }

    // Proses cek username & password
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            // CEK ROLE DAN ARAHKAN KE DASHBOARD MASING-MASING
            if ($role === 'super_admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role === 'dosen') {
                return redirect()->intended('/dosen/dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }

        return back()->with('error', 'Username atau Password salah bro!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}