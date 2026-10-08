<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'sku',
        'price',
        'sale_price',
        'cost_price',
        'stock',
        'variations',
        'description',
        'craftsmanship',
        'accordion_tabs',
        'image',
        'gallery_images',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'gallery_images' => 'array',
        'variations' => 'array',
        'accordion_tabs' => 'array',
    ];

    protected $appends = ['image_url'];

    /**
     * Get effective unit cost price (defaults to 45% of retail price if not specified).
     */
    public function getEffectiveCostPriceAttribute(): float
    {
        if ($this->cost_price !== null && (float)$this->cost_price > 0) {
            return (float)$this->cost_price;
        }
        return round((float)$this->price * 0.45, 2);
    }

    /**
     * Gross Profit per piece.
     */
    public function getUnitGrossProfitAttribute(): float
    {
        return round((float)$this->price - $this->effective_cost_price, 2);
    }

    /**
     * Gross Profit Margin percentage.
     */
    public function getGrossMarginPercentAttribute(): float
    {
        if ((float)$this->price <= 0) return 0.0;
        return round(($this->unit_gross_profit / (float)$this->price) * 100, 1);
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Get full image URL or fallback placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset('storage/' . $this->image);
        }

        return 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?q=80&w=400&auto=format&fit=crop';
    }

    /**
     * Get all reviews for this product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get only approved reviews for this product.
     */
    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }
}

