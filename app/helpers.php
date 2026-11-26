<?php

use App\Models\Currency;

if (!function_exists('currency_format')) {
    /**
     * Format a price from EUR to the active user currency.
     */
    function currency_format(float $amount, ?string $code = null): string {
        return Currency::format($amount, $code);
    }
}

if (!function_exists('currency_convert')) {
    /**
     * Convert an EUR price to active user currency with metadata.
     */
    function currency_convert(float $amount, ?string $code = null): array {
        return Currency::convert($amount, $code);
    }
}

if (!function_exists('current_currency')) {
    /**
     * Get active Currency model instance.
     */
    function current_currency(): Currency {
        return Currency::getUserCurrency();
    }
}
