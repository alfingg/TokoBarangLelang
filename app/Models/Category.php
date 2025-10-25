<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi.
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Kolom yang akan di-cast otomatis.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke model Product.
     * 1 kategori punya banyak produk.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope pencarian cepat (misalnya untuk fitur search di admin).
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where('name', 'like', "%{$term}%");
        }
    }

    /**
     * Auto-generate slug setiap kali kategori dibuat / diubah.
     */
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Getter untuk menampilkan nama kategori dengan huruf besar di awal.
     */
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }
}
