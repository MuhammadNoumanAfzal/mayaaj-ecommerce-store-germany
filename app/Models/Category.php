<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'order_index',
    ];

    protected $casts = [
        'order_index' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        // Invalidate frontend cache immediately upon any change
        static::saved(function () {
            Cache::forget('mehaaj_active_categories_tree');
            Cache::forget('mehaaj_featured_products');
            Cache::forget('mehaaj_shop_categories');
        });

        static::deleted(function () {
            Cache::forget('mehaaj_active_categories_tree');
            Cache::forget('mehaaj_featured_products');
            Cache::forget('mehaaj_shop_categories');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->orderBy('name');
    }

    public function activeSubcategories()
    {
        return $this->hasMany(Subcategory::class)->where('status', 'active')->orderBy('name');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc')->orderBy('name', 'asc');
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }
        if (file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return null;
    }
}
