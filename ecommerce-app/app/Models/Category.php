<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sort_order',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function coverImage(): string
    {
        return match ($this->slug) {
            'womens-clothing' => 'https://images.unsplash.com/photo-1483985988350-763728e3685b?w=600&h=800&fit=crop',
            'mens-clothing' => 'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=600&h=800&fit=crop',
            'phones-accessories' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=800&fit=crop',
            'computer-office' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=800&fit=crop',
            'consumer-electronics' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=800&fit=crop',
            'jewelry-watches' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=600&h=800&fit=crop',
            'bags-shoes' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&h=800&fit=crop',
            default => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=800&fit=crop',
        };
    }

    public function tagline(): string
    {
        return match ($this->slug) {
            'womens-clothing' => 'Elegant essentials for every occasion',
            'mens-clothing' => 'Tailored pieces with modern appeal',
            'phones-accessories' => 'Smart devices & everyday tech',
            'computer-office' => 'Work tools that inspire productivity',
            'consumer-electronics' => 'Innovation for modern living',
            'jewelry-watches' => 'Timeless accents & fine craftsmanship',
            'bags-shoes' => 'Leather goods & statement footwear',
            default => 'Explore our curated selection',
        };
    }
}
