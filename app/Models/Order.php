<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'postal_code',
        'country',
        'subtotal',
        'discount_amount',
        'coupon_code',
        'total_amount',
        'payment_method',
        'payment_status',
        'status',
        'notes',
        'courier_name',
        'tracking_number',
        'tracking_url',
        'dispatched_at',
        'delivered_at',
        'payment_receipt_path',
        'order_notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'dispatched_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get the order items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Build courier tracking URL based on carrier name and code.
     */
    public static function buildTrackingUrl(?string $courier, ?string $trackingNumber): ?string
    {
        if (empty($trackingNumber)) {
            return null;
        }

        $code = trim($trackingNumber);
        $courierLower = strtolower(trim($courier ?? ''));

        if (str_contains($courierLower, 'dhl')) {
            return "https://www.dhl.de/de/privatkunden/pakete-empfangen/verfolgen.html?piececode={$code}";
        } elseif (str_contains($courierLower, 'hermes')) {
            return "https://www.myhermes.de/empfangen/sendungsverfolgung/sendungsdetails#/{$code}";
        } elseif (str_contains($courierLower, 'dpd')) {
            return "https://tracking.dpd.de/status/de_DE/shipment/{$code}";
        } elseif (str_contains($courierLower, 'ups')) {
            return "https://www.ups.com/track?tracknum={$code}";
        } elseif (str_contains($courierLower, 'gls')) {
            return "https://www.gls-pakete.de/sendungsverfolgung?match={$code}";
        } elseif (str_contains($courierLower, 'fedex')) {
            return "https://www.fedex.com/fedextrack/?trknbr={$code}";
        }

        // Generic universal package tracking fallback
        return "https://parcelsapp.com/en/tracking/{$code}";
    }

    /**
     * Accessor for full tracking URL
     */
    public function getGeneratedTrackingUrlAttribute(): ?string
    {
        if (!empty($this->tracking_url)) {
            return $this->tracking_url;
        }

        return self::buildTrackingUrl($this->courier_name, $this->tracking_number);
    }

    /**
     * Accessor for visual fulfillment step (1 to 5)
     */
    public function getTimelineStepAttribute(): int
    {
        if ($this->status === 'cancelled') {
            return 0;
        }
        if ($this->status === 'delivered' || !empty($this->delivered_at)) {
            return 5;
        }
        if ($this->status === 'shipped' || !empty($this->dispatched_at)) {
            return 3;
        }
        if ($this->payment_status === 'paid' || $this->status === 'processing') {
            return 2;
        }
        return 1; // Placed / Pending
    }
}
