<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    public const PAYMENT_CASH = 'CASH';
    public const PAYMENT_QRIS = 'QRIS';

    protected $fillable = [
        'buyer_name',
        'payment_method',
        'total_amount',
        'total_profit',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'integer',
            'total_profit' => 'integer',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}
