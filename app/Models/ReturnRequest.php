<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'return_number',
        'customer_name',
        'customer_email',
        'status',
        'reason',
        'customer_notes',
        'admin_notes',
        'refund_amount',
        'photo_path',
        'approved_at',
        'refunded_at',
    ];

    protected $casts = [
        'refund_amount' => 'float',
        'approved_at'   => 'datetime',
        'refunded_at'   => 'datetime',
    ];

    /**
     * Associated Order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Items requested for return.
     */
    public function items(): HasMany
    {
        return $this->hasMany(ReturnItem::class);
    }

    /**
     * Generate unique RMA Return Number.
     */
    public static function generateReturnNumber(): string
    {
        $prefix = 'RMA-' . date('Ym') . '-';
        do {
            $number = $prefix . strtoupper(Str::random(4)) . rand(10, 99);
        } while (static::where('return_number', $number)->exists());

        return $number;
    }

    /**
     * Get German & English translated Reason Label.
     */
    public function getReasonLabelAttribute(): string
    {
        $labels = [
            'wrong_size'       => 'Falsche Größe / Passform (Wrong Size)',
            'defect'           => 'Mangel / Beschädigung (Item Defect)',
            'changed_mind'     => '14-Tage Widerruf / Meinungsänderung (Changed Mind)',
            'not_as_pictured'  => 'Weicht von Abbildung ab (Not as Pictured)',
            'other'            => 'Sonstige Gründe (Other Reason)',
        ];

        return $labels[$this->reason] ?? ucfirst(str_replace('_', ' ', $this->reason));
    }

    /**
     * Get Status Badge styling & label.
     */
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'approved' => [
                'label' => 'Genehmigt (Approved)',
                'badge' => 'bg-[#2e683a]/15 text-[#2e683a] border-[#2e683a]/30',
            ],
            'received' => [
                'label' => 'Eingegangen (Received)',
                'badge' => 'bg-[#1d4ed8]/15 text-[#1d4ed8] border-[#1d4ed8]/30',
            ],
            'refunded' => [
                'label' => 'Erstattet (Refunded)',
                'badge' => 'bg-[#2e683a] text-white border-transparent',
            ],
            'rejected' => [
                'label' => 'Abgelehnt (Rejected)',
                'badge' => 'bg-[#991b1b]/15 text-[#991b1b] border-[#991b1b]/30',
            ],
            default => [
                'label' => 'In Prüfung (Pending)',
                'badge' => 'bg-[#b45309]/15 text-[#b45309] border-[#b45309]/30',
            ],
        };
    }
}
