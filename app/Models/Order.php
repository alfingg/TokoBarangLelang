<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_address',
    ];

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi ke Order Items */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Format total */
    public function getTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    /** Accessor warna status */
    public function getStatusColorAttribute(): string
    {
        return match (strtolower($this->status)) {
            'pending'    => 'bg-yellow-100 text-yellow-800',
            'diproses'   => 'bg-blue-100 text-blue-800',
            'dikirim'    => 'bg-indigo-100 text-indigo-800',
            'selesai'    => 'bg-green-100 text-green-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            default      => 'bg-gray-100 text-gray-800',
        };
    }

    /** Recalculate total otomatis */
    public function recalculateTotal(): void
    {
        $newTotal = $this->items->sum(fn($item) => $item->subtotal);
        $this->updateQuietly(['total' => $newTotal]);
    }

    /** Tambahkan item baru */
    public function addItem(Product $product, int $quantity = 1): void
    {
        $this->items()->create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $product->price,
        ]);

        $this->recalculateTotal();
    }

    /** Hapus semua item */
    public function clearItems(): void
    {
        $this->items()->delete();
        $this->update(['total' => 0]);
    }
}
