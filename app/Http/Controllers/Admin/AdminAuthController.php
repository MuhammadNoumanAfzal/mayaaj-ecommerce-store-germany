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

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('admin.welcome_back'),
                    'redirect' => route('admin.dashboard')
                ]);
            }

            return redirect()->route('admin.dashboard')->with('success', __('admin.welcome_back'));
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => __('admin.invalid_credentials')
            ], 422);
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => __('admin.invalid_credentials'),
        ]);
    }

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        $request->session()->regenerateToken();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('admin.logged_out_msg'),
                'redirect' => route('admin.login')
            ]);
        }

        return redirect()->route('admin.login')->with('info', __('admin.logged_out_msg'));
    }
}
