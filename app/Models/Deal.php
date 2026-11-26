<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_de',
        'slug',
        'description_en',
        'description_de',
        'badge_text',
        'discount_type',
        'discount_value',
        'starts_at',
        'ends_at',
        'is_active',
        'banner_image',
        'sort_order',
    ];

    protected $casts = [
        'discount_value' => 'float',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relationship: Products bundled in this deal.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'deal_product')
            ->withPivot('is_required', 'sort_order')
            ->withTimestamps()
            ->orderBy('deal_product.sort_order', 'asc');
    }

    /**
     * Query scope: Only currently active and unexpired deals.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    /**
     * Localized Title (German or English).
     */
    public function getTitleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'de' && !empty($this->title_de)) {
            return $this->title_de;
        }
        return $this->title_en ?? $this->title_de ?? '';
    }

    /**
     * Localized Description.
     */
    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'de' && !empty($this->description_de)) {
            return $this->description_de;
        }
        return $this->description_en ?? $this->description_de;
    }

    /**
     * Calculate sum of regular product prices in the bundle.
     */
    public function getRegularTotalAttribute(): float
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $effective = ($product->sale_price && $product->sale_price < $product->price) ? (float)$product->sale_price : (float)$product->price;
            $sum += $effective;
        }
        return round($sum, 2);
    }

    /**
     * Calculate effective discounted package price.
     */
    public function getBundlePriceAttribute(): float
    {
        $reg = $this->regular_total;

        if ($this->discount_type === 'percentage_discount') {
            $percent = max(0, min(100, $this->discount_value));
            return round($reg * (1 - ($percent / 100)), 2);
        }

        if ($this->discount_type === 'fixed_discount') {
            return max(0, round($reg - $this->discount_value, 2));
        }

        if ($this->discount_type === 'bundle_fixed_price') {
            return round($this->discount_value, 2);
        }

        return $reg;
    }

    /**
     * Total amount saved in Euros.
     */
    public function getSavingsAmountAttribute(): float
    {
        return max(0, round($this->regular_total - $this->bundle_price, 2));
    }

    /**
     * Percentage saved.
     */
    public function getSavingsPercentageAttribute(): int
    {
        $reg = $this->regular_total;
        if ($reg > 0 && $reg > $this->bundle_price) {
            return (int) round((($reg - $this->bundle_price) / $reg) * 100);
        }
        return 0;
    }

    /**
     * Check if deal has an active countdown timer.
     */
    public function getIsFlashAttribute(): bool
    {
        return !empty($this->ends_at) && $this->ends_at->isFuture();
    }

    /**
     * Check if deal has expired.
     */
    public function getIsExpiredAttribute(): bool
    {
        return !empty($this->ends_at) && $this->ends_at->isPast();
    }

    /**
     * Formatted badge text.
     */
    public function getFormattedBadgeAttribute(): string
    {
        if (!empty($this->badge_text)) {
            return $this->badge_text;
        }
        if ($this->savings_percentage > 0) {
            return 'BUNDLE & SAVE ' . $this->savings_percentage . '%';
        }
        return 'SPECIAL DUO';
    }
}
