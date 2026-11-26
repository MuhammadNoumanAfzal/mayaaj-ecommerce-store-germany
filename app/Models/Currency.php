<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'symbol',
        'name',
        'exchange_rate',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'exchange_rate' => 'float',
        'is_default'    => 'boolean',
        'is_active'     => 'boolean',
    ];

    /**
     * Get the active user selected currency from session or default.
     */
    public static function getUserCurrency(): self
    {
        $code = session('currency', 'EUR');
        $currency = static::where('code', $code)->where('is_active', true)->first();

        if (!$currency) {
            $currency = static::where('is_default', true)->first()
                ?? static::firstOrCreate(
                    ['code' => 'EUR'],
                    ['symbol' => '€', 'name' => 'Euro', 'exchange_rate' => 1.0000, 'is_default' => true, 'is_active' => true]
                );
        }

        return $currency;
    }

    /**
     * Convert an EUR amount to the active user currency or specified currency.
     */
    public static function convert(float $eurAmount, ?string $targetCode = null): array
    {
        $currency = $targetCode
            ? (static::where('code', $targetCode)->first() ?? static::getUserCurrency())
            : static::getUserCurrency();

        $convertedAmount = round($eurAmount * $currency->exchange_rate, 2);

        // Format symbol position: EUR and CHF usually after or before, USD/GBP before
        $formatted = match ($currency->code) {
            'USD'   => '$' . number_format($convertedAmount, 2, '.', ','),
            'GBP'   => '£' . number_format($convertedAmount, 2, '.', ','),
            'CHF'   => 'CHF ' . number_format($convertedAmount, 2, '.', "'"),
            default => '€' . number_format($convertedAmount, 2, '.', ','),
        };

        return [
            'original_eur'     => $eurAmount,
            'converted_amount' => $convertedAmount,
            'code'             => $currency->code,
            'symbol'           => $currency->symbol,
            'formatted'        => $formatted,
            'rate'             => $currency->exchange_rate,
        ];
    }

    /**
     * Helper string formatter.
     */
    public static function format(float $eurAmount, ?string $targetCode = null): string
    {
        return static::convert($eurAmount, $targetCode)['formatted'];
    }
}
