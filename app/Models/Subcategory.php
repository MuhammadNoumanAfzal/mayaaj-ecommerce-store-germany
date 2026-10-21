<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Cache;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
            }
        });

        static::updating(function ($subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
            }
        });

        // Invalidate frontend cache immediately upon any subcategory change
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
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
