<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request for Admin routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (!$user && session('admin_user_id')) {
            $user = \App\Models\User::find(session('admin_user_id'));
            if ($user) {
                \Illuminate\Support\Facades\Auth::login($user);
            }
        } elseif (!$user && session('admin_logged_in') && session('admin_email')) {
            $user = \App\Models\User::where('email', session('admin_email'))->first();
            if ($user) {
                \Illuminate\Support\Facades\Auth::login($user);
            }
        }

        if (!$user || !session('admin_logged_in')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Unauthenticated Admin.'], 401);
            }
            return redirect()->route('admin.login')->with('error', 'Bitte melden Sie sich zuerst im Admin-Portal an.');
        }

        if (!$user->is_active) {
            \Illuminate\Support\Facades\Auth::logout();
            $request->session()->forget(['admin_logged_in', 'admin_user_id', 'admin_role', 'admin_name', 'admin_email']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Account deactivated.'], 403);
            }
            return redirect()->route('admin.login')->with('error', 'Ihr Admin-Konto wurde deaktiviert.');
        }

        return $next($request);
    }
}
