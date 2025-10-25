<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /** Relasi ke Order */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /** Relasi ke Product */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /** Subtotal */
    public function getSubtotalAttribute(): float
    {
        return $this->quantity * $this->price;
    }

    /** Update total order setelah berubah */
    protected static function booted(): void
    {
        static::saved(function ($item) {
            $item->order?->recalculateTotal();
        });

        static::deleted(function ($item) {
            $item->order?->recalculateTotal();
        });
    }
}
