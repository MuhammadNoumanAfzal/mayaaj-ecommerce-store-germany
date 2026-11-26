<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_spend',
        'max_discount',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'value' => 'float',
        'min_spend' => 'float',
        'max_discount' => 'float',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: Usages log
     */
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    /**
     * Scope only active, unexpired, and available coupons.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')->orWhereColumn('used_count', '<', 'usage_limit');
            });
    }

    /**
     * Check if coupon has expired.
     */
    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if usage limit has been exceeded.
     */
    public function getIsLimitReachedAttribute(): bool
    {
        return $this->usage_limit !== null && $this->used_count >= $this->usage_limit;
    }

    /**
     * Formatted discount badge (e.g. "10% OFF" or "25,00 € RABATT").
     */
    public function getBadgeTextAttribute(): string
    {
        if ($this->type === 'percentage') {
            return rtrim(rtrim(number_format($this->value, 1), '0'), '.') . '%';
        }
        return number_format($this->value, 2, ',', '.') . ' €';
    }

    /**
     * Human readable status badge string for admin.
     */
    public function getStatusKeyAttribute(): string
    {
        if (!$this->is_active) {
            return 'inactive';
        }
        if ($this->is_expired) {
            return 'expired';
        }
        if ($this->is_limit_reached) {
            return 'exhausted';
        }
        if ($this->starts_at && $this->starts_at->isFuture()) {
            return 'scheduled';
        }
        return 'active';
    }

    /**
     * Validate coupon against cart subtotal with bilingual error explanation.
     */
    public function validateForCart(float $subtotal, ?string &$error = null, string $locale = 'de'): bool
    {
        $isEn = ($locale === 'en');

        if (!$this->is_active) {
            $error = $isEn 
                ? 'This promotional code is currently inactive.' 
                : 'Dieser Gutscheincode ist derzeit nicht aktiv.';
            return false;
        }

        if ($this->starts_at && $this->starts_at->isFuture()) {
            $dateFormatted = $this->starts_at->format('d.m.Y');
            $error = $isEn 
                ? "This promotion starts on {$dateFormatted}." 
                : "Dieser Gutscheincode ist erst ab dem {$dateFormatted} gültig.";
            return false;
        }

        if ($this->is_expired) {
            $dateFormatted = $this->expires_at ? $this->expires_at->format('d.m.Y') : '';
            $error = $isEn 
                ? "This promo code expired on {$dateFormatted}." 
                : "Dieser Gutscheincode ist am {$dateFormatted} abgelaufen.";
            return false;
        }

        if ($this->is_limit_reached) {
            $error = $isEn 
                ? "This promotion has reached its redemption limit ({$this->usage_limit} uses)." 
                : "Das Einlösungslimit für diesen Gutschein ({$this->usage_limit} Nutzungen) wurde erreicht.";
            return false;
        }

        if ($this->min_spend > 0 && $subtotal < $this->min_spend) {
            $minFormatted = number_format($this->min_spend, 2, ',', '.') . ' €';
            $subFormatted = number_format($subtotal, 2, ',', '.') . ' €';
            $error = $isEn 
                ? "Minimum order subtotal for this voucher is {$minFormatted} (Current subtotal: {$subFormatted})." 
                : "Mindestbestellwert für diesen Gutschein beträgt {$minFormatted} (Ihr Warenkorb: {$subFormatted}).";
            return false;
        }

        return true;
    }

    /**
     * Calculate exact Euro discount for a given subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            $discount = ($subtotal * $this->value) / 100.0;
            if ($this->max_discount !== null && $this->max_discount > 0) {
                $discount = min($discount, $this->max_discount);
            }
            return round($discount, 2);
        }

        // Fixed amount discount cannot exceed subtotal
        return round(min($this->value, $subtotal), 2);
    }
}
