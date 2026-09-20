<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Show the Admin Login Form
     */
    public function showLoginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Process Admin Login Request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $adminEmail = env('ADMIN_EMAIL', 'admin@mehaaj.de');
        $adminPassword = env('ADMIN_PASSWORD', 'password123');

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session([
                'admin_logged_in' => true,
                'admin_email' => $request->email,
                'admin_name' => 'MEHAAJ Admin',
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Willkommen im MEHAAJ VIP Admin Portal 👑');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Ungültige Anmeldedaten. Bitte überprüfen Sie E-Mail und Passwort.',
        ]);
    }

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'Sie wurden erfolgreich abgemeldet.');
    }
}
