<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request and enforce Role-Based Access Control (RBAC).
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Fallback to session admin user if Auth guard wasn't initialized
        if (!$user && session('admin_user_id')) {
            $user = User::find(session('admin_user_id'));
            if ($user) {
                Auth::login($user);
            }
        }

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('admin.login')->with('error', 'Please log in to continue.');
        }

        // Check if account is active
        if (!$user->is_active) {
            Auth::logout();
            session()->forget(['admin_logged_in', 'admin_user_id', 'admin_role', 'admin_name', 'admin_email']);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Your account has been deactivated.'], 403);
            }
            return redirect()->route('admin.login')->with('error', 'Your staff account has been deactivated by administration.');
        }

        // Super Admin has master access to all modules
        if ($user->role === 'super_admin') {
            return $next($request);
        }

        // If specific roles were provided to the middleware, check against them
        if (!empty($roles)) {
            $allowedRoles = [];
            foreach ($roles as $roleGroup) {
                foreach (explode(',', $roleGroup) as $singleRole) {
                    $allowedRoles[] = trim($singleRole);
                }
            }

            if (!in_array($user->role, $allowedRoles, true)) {
                $errorMsg = __('admin.access_denied_role', [], session('locale', 'en')) 
                    ?: "Access Denied: Your current role ({$user->role_label}) does not have permission to access this module.";

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMsg,
                    ], 403);
                }

                return redirect()->route('admin.dashboard')->with('error', $errorMsg);
            }
        }

        return $next($request);
    }
}
