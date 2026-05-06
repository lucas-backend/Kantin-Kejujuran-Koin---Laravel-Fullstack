<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cost_price',
        'selling_price',
        'stock',
        'is_active',
        'image_path',
        'category_id',
    ];
    
    #[Override]
    protected function casts()
    {
        return [
            'cost_price' => 'integer',
            'selling_price' => 'integer',
            'stock' => 'integer',
            'is_active' => 'boolean',
            'category_id' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}