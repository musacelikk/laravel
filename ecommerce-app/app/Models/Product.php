<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'image',
        'brand',
        'rating',
        'review_count',
        'stock',
        'is_new',
        'is_featured',
        'is_deal',
        'sizes',
        'colors',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_deal' => 'boolean',
            'sizes' => 'array',
            'colors' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function discountPercent(): ?int
    {
        if (! $this->compare_price || $this->compare_price <= $this->price) {
            return null;
        }

        return (int) round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
