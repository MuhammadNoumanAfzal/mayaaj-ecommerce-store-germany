<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'subtype',
        'name',
        'balance',
        'notes',
        'is_system',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_system' => 'boolean',
    ];

    /**
     * Scope for Assets.
     */
    public function scopeAssets($query)
    {
        return $query->where('type', 'asset');
    }

    /**
     * Scope for Liabilities.
     */
    public function scopeLiabilities($query)
    {
        return $query->where('type', 'liability');
    }

    /**
     * Scope for Equity.
     */
    public function scopeEquity($query)
    {
        return $query->where('type', 'equity');
    }
}
