<?php

namespace App\Models;

use App\Services\ImageUploader;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'keywords',
        'description',
        'detail',
        'price',
        'quantity',
        'status',
        'slug',
        'image',
        'compare_price',
        'brand',
        'rating',
        'review_count',
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function name(): Attribute
    {
        return Attribute::get(fn () => $this->title);
    }

    protected function stock(): Attribute
    {
        return Attribute::get(fn () => $this->quantity);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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
        return $this->quantity > 0;
    }

    public function imageUrl(): ?string
    {
        return app(ImageUploader::class)->url($this->image);
    }

    public function allImages(): array
    {
        $urls = [];

        if ($main = $this->imageUrl()) {
            $urls[] = $main;
        }

        foreach ($this->images as $galleryImage) {
            if ($url = $galleryImage->imageUrl()) {
                $urls[] = $url;
            }
        }

        return array_values(array_unique($urls));
    }
}
