<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAdminLocale
{
    /**
     * Handle an incoming request and set active application locale.
     * Default: 'en' (English).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->get('lang')
            ?? session('locale')
            ?? $request->cookie('mehaaj_lang')
            ?? $request->cookie('locale')
            ?? $request->cookie('mehaaj_admin_lang')
            ?? 'en';

        if (!in_array($locale, ['en', 'de'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        if (!session()->has('locale') || session('locale') !== $locale) {
            session(['locale' => $locale]);
        }

        return $next($request);
    }
}
