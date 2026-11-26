<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AbandonedCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'cart_items',
        'cart_total',
        'recovery_token',
        'recovery_status',
        'recovered_at',
        'last_contacted_at',
        'notes',
    ];

    protected $casts = [
        'cart_items' => 'array',
        'cart_total' => 'decimal:2',
        'recovered_at' => 'datetime',
        'last_contacted_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($cart) {
            if (empty($cart->recovery_token)) {
                $cart->recovery_token = Str::random(40);
            }
        });
    }

    /**
     * Relationship to registered customer if present
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Scope for pending/contacted abandoned carts (lost revenue pipeline)
     */
    public function scopeUnrecovered($query)
    {
        return $query->whereIn('recovery_status', ['pending', 'contacted']);
    }

    /**
     * Scope for recovered carts
     */
    public function scopeRecovered($query)
    {
        return $query->where('recovery_status', 'recovered');
    }

    /**
     * Total item count across all line items
     */
    public function getItemCountAttribute(): int
    {
        if (empty($this->cart_items) || !is_array($this->cart_items)) {
            return 0;
        }

        $count = 0;
        foreach ($this->cart_items as $item) {
            $count += (int)($item['qty'] ?? 1);
        }

        return $count;
    }

    /**
     * 1-Click recovery URL
     */
    public function getRecoveryUrlAttribute(): string
    {
        return url('/cart/recover/' . $this->recovery_token);
    }

    /**
     * Direct WhatsApp Recovery Message link with prefilled German / English message
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if (empty($this->customer_phone)) {
            return null;
        }

        // Clean phone number (strip spaces, dashes, parentheses)
        $cleanPhone = preg_replace('/[^0-9]/', '', $this->customer_phone);
        if (empty($cleanPhone)) {
            return null;
        }

        $greetingName = $this->customer_name ?: 'Geschätzte(r) Kunde/Kundin';
        $itemTitles = [];
        if (is_array($this->cart_items)) {
            foreach (array_slice($this->cart_items, 0, 2) as $item) {
                $itemTitles[] = $item['name'] ?? 'Artikel';
            }
        }
        $itemsStr = implode(', ', $itemTitles);
        if (count($this->cart_items ?? []) > 2) {
            $itemsStr .= ' (+ weitere)';
        }

        $message = "Guten Tag {$greetingName},\n\n";
        $message .= "wir haben bemerkt, dass Sie Ihre exklusive Auswahl im MEHAAJ Atelier ({$itemsStr}) noch nicht abgeschlossen haben.\n\n";
        $message .= "Möchten Sie Ihren Einkauf mit nur einem Klick fortsetzen? Ihr Warenkorb liegt für Sie bereit:\n";
        $message .= $this->recovery_url . "\n\n";
        $message .= "Bei Fragen zu Größen, Materialien oder Zahlungsarten (Nachnahme / Vorkasse) stehen wir Ihnen jederzeit zur Verfügung.\n\n";
        $message .= "Herzliche Grüße,\nIhr MEHAAJ Concierge Team";

        return 'https://wa.me/' . $cleanPhone . '?text=' . rawurlencode($message);
    }
}
