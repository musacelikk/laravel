<?php

namespace App\Models;

use App\Services\ImageUploader;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'keywords',
        'description',
        'image',
        'status',
        'slug',
    ];

    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('title');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function imageUrl(): ?string
    {
        return app(ImageUploader::class)->url($this->image);
    }

    public function coverImage(): string
    {
        return $this->imageUrl() ?? match ($this->slug) {
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
        if ($this->description) {
            return strip_tags($this->description);
        }

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

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public static function tree(): Collection
    {
        $all = self::query()
            ->where('status', 'active')
            ->withCount('products')
            ->orderBy('title')
            ->get()
            ->keyBy('id');

        return $all->filter(fn ($category) => ! $category->parent_id)->map(function ($category) use ($all) {
            $category->setRelation('children', self::buildChildren($category->id, $all));

            return $category;
        })->values();
    }

    public static function flatTree(?int $excludeId = null, ?int $parentId = null, string $prefix = ''): array
    {
        $options = [];

        $query = self::query()->orderBy('title');
        $parentId === null ? $query->whereNull('parent_id') : $query->where('parent_id', $parentId);

        foreach ($query->get() as $category) {
            if ($excludeId && $category->id === $excludeId) {
                continue;
            }

            $options[] = ['id' => $category->id, 'title' => $prefix.$category->title];
            $options = array_merge($options, self::flatTree($excludeId, $category->id, $prefix.'— '));
        }

        return $options;
    }

    private static function buildChildren(int $parentId, Collection $all): Collection
    {
        return $all->where('parent_id', $parentId)->map(function ($category) use ($all) {
            $category->setRelation('children', self::buildChildren($category->id, $all));

            return $category;
        })->values();
    }
}
