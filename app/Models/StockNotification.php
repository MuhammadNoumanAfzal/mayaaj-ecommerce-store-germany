<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variation_name',
        'customer_email',
        'customer_name',
        'status',
        'notified_at',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
    ];

    /**
     * Associated Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope for pending notifications.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for sent notifications.
     */
    public function scopeNotified($query)
    {
        return $query->where('status', 'notified');
    }

    /**
     * Status badge styling.
     */
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'notified' => [
                'label' => 'Benachrichtigt (Notified)',
                'badge' => 'bg-[#2e683a]/15 text-[#2e683a] border-[#2e683a]/30',
            ],
            default => [
                'label' => 'Wartend (Pending Restock)',
                'badge' => 'bg-[#b45309]/15 text-[#b45309] border-[#b45309]/30',
            ],
        };
    }
}
