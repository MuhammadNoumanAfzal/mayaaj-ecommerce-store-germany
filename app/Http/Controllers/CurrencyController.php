<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Switch active currency (EUR, USD, GBP, CHF).
     */
    public function switch(Request $request, string $code)
    {
        $code = strtoupper(trim($code));
        $validCodes = ['EUR', 'USD', 'GBP', 'CHF'];

        if (!in_array($code, $validCodes)) {
            $code = 'EUR';
        }

        $currency = Currency::where('code', $code)->where('is_active', true)->first();
        if (!$currency) {
            $currency = Currency::where('is_default', true)->first();
            $code = $currency ? $currency->code : 'EUR';
        }

        session(['currency' => $code]);

        $cookie = cookie('currency', $code, 60 * 24 * 365);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'currency' => [
                    'code'   => $currency->code,
                    'symbol' => $currency->symbol,
                    'name'   => $currency->name,
                    'rate'   => $currency->exchange_rate,
                ],
                'message'  => "Currency switched to {$currency->code} ({$currency->symbol})",
            ])->withCookie($cookie);
        }

        return redirect()->back()->withCookie($cookie);
    }
}
