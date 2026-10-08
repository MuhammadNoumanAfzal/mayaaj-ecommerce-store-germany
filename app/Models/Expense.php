<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'amount',
        'expense_date',
        'reference_no',
        'vendor',
        'payment_method',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    /**
     * User who recorded this expense.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Human-friendly category label.
     */
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'workshop_rent'       => 'Atelier & Studio Lease',
            'artisan_payroll'     => 'Artisan & Tailor Payroll',
            'materials_packaging' => 'Luxury Packaging & Materials',
            'marketing_ads'       => 'Digital Marketing & Campaigns',
            'shipping_logistics'  => 'Courier & Express Logistics',
            'software_hosting'    => 'Software, Cloud & Hosting',
            'utilities'           => 'Utilities & Power',
            'taxes_legal'         => 'Legal, Tax & Accounting',
            default               => ucfirst(str_replace('_', ' ', $this->category ?? 'Operational')),
        };
    }

    /**
     * Category badge CSS classes.
     */
    public function getCategoryBadgeClassAttribute(): string
    {
        return match ($this->category) {
            'workshop_rent'       => 'bg-purple-50 text-purple-700 border-purple-200',
            'artisan_payroll'     => 'bg-rose-50 text-rose-700 border-rose-200',
            'materials_packaging' => 'bg-amber-50 text-amber-700 border-amber-200',
            'marketing_ads'       => 'bg-blue-50 text-blue-700 border-blue-200',
            'shipping_logistics'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'software_hosting'    => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'utilities'           => 'bg-orange-50 text-orange-700 border-orange-200',
            'taxes_legal'         => 'bg-stone-100 text-stone-700 border-stone-200',
            default               => 'bg-stone-50 text-stone-600 border-stone-200',
        };
    }
}
