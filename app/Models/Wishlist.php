<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'session_id',
        'product_id',
    ];

    /**
     * Get the associated product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the associated patron/customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all wishlist items for current patron/session.
     */
    public static function getItemsForSession(string $sessionId, ?int $customerId = null)
    {
        return static::where(function ($q) use ($sessionId, $customerId) {
            $q->where('session_id', $sessionId);
            if ($customerId) {
                $q->orWhere('customer_id', $customerId);
            }
        })
        ->with(['product.category'])
        ->latest()
        ->get();
    }

    /**
     * Get count of saved items.
     */
    public static function countForSession(string $sessionId, ?int $customerId = null): int
    {
        return static::where(function ($q) use ($sessionId, $customerId) {
            $q->where('session_id', $sessionId);
            if ($customerId) {
                $q->orWhere('customer_id', $customerId);
            }
        })->count();
    }

    /**
     * Check if a product is currently in wishlist.
     */
    public static function hasProduct(int $productId, string $sessionId, ?int $customerId = null): bool
    {
        return static::where('product_id', $productId)
            ->where(function ($q) use ($sessionId, $customerId) {
                $q->where('session_id', $sessionId);
                if ($customerId) {
                    $q->orWhere('customer_id', $customerId);
                }
            })
            ->exists();
    }

    /**
     * Toggle a product in wishlist (Add if not present, Remove if present).
     */
    public static function toggle(int $productId, string $sessionId, ?int $customerId = null): array
    {
        $existing = static::where('product_id', $productId)
            ->where(function ($q) use ($sessionId, $customerId) {
                $q->where('session_id', $sessionId);
                if ($customerId) {
                    $q->orWhere('customer_id', $customerId);
                }
            })
            ->first();

        if ($existing) {
            $existing->delete();
            $action = 'removed';
            $isWishlisted = false;
        } else {
            static::create([
                'product_id'  => $productId,
                'session_id'  => $sessionId,
                'customer_id' => $customerId,
            ]);
            $action = 'added';
            $isWishlisted = true;
        }

        $newCount = static::countForSession($sessionId, $customerId);

        return [
            'action'        => $action,
            'is_wishlisted' => $isWishlisted,
            'count'         => $newCount,
        ];
    }
}
