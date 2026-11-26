<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use App\Models\Wishlist;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Global Currency and Pricing Helpers
if (!function_exists('currency_format')) {
    function currency_format(float $amount, ?string $code = null): string {
        return Currency::format($amount, $code);
    }
}

if (!function_exists('currency_convert')) {
    function currency_convert(float $amount, ?string $code = null): array {
        return Currency::convert($amount, $code);
    }
}

if (!function_exists('current_currency')) {
    function current_currency(): Currency {
        return Currency::getUserCurrency();
    }
}

class CurrencyMiddleware
{
    /**
     * Handle an incoming request, initialize session currency & wishlist data.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Resolve and persist selected currency
        $currencyCode = $request->get('currency')
            ?: $request->cookie('currency')
            ?: session('currency', 'EUR');

        $currencyCode = strtoupper(trim($currencyCode));

        if (!in_array($currencyCode, ['EUR', 'USD', 'GBP', 'CHF'])) {
            $currencyCode = 'EUR';
        }

        session(['currency' => $currencyCode]);

        // 2. Fetch active currencies & current active currency
        try {
            $activeCurrencies = Currency::where('is_active', true)->orderBy('code')->get();
            $currentCurrency = Currency::getUserCurrency();
        } catch (\Throwable $e) {
            $activeCurrencies = collect();
            $currentCurrency = new Currency([
                'code' => 'EUR',
                'symbol' => '€',
                'name' => 'Euro',
                'exchange_rate' => 1.0000,
                'is_default' => true,
                'is_active' => true,
            ]);
        }

        // 3. Wishlist session sync
        $sessionId = session()->getId();
        $customerId = auth('web')->id() ?? session('customer_id');

        try {
            $wishlistCount = Wishlist::countForSession($sessionId, $customerId);
            $wishlistProductIds = Wishlist::where('session_id', $sessionId)
                ->orWhere(function ($q) use ($customerId) {
                    if ($customerId) $q->where('customer_id', $customerId);
                })
                ->pluck('product_id')
                ->toArray();
        } catch (\Throwable $e) {
            $wishlistCount = 0;
            $wishlistProductIds = [];
        }

        // Share globally with all Blade views
        view()->share('activeCurrencies', $activeCurrencies);
        view()->share('currentCurrency', $currentCurrency);
        view()->share('wishlistCount', $wishlistCount);
        view()->share('wishlistProductIds', $wishlistProductIds);

        $response = $next($request);

        // Queue currency cookie for 1 year
        if (method_exists($response, 'withCookie')) {
            $response->withCookie(cookie('currency', $currencyCode, 60 * 24 * 365));
        }

        return $response;
    }
}
