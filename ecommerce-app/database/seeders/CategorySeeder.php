<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => "Women's Clothing",
                'slug' => 'womens-clothing',
                'keywords' => 'women, clothing, fashion',
                'description' => 'Elegant essentials for every occasion',
                'image' => 'https://images.unsplash.com/photo-1483985988350-763728e3685b?w=600&h=800&fit=crop',
                'children' => ['Dresses', 'Blouses', 'Outerwear'],
            ],
            [
                'title' => "Men's Clothing",
                'slug' => 'mens-clothing',
                'keywords' => 'men, clothing, fashion',
                'description' => 'Tailored pieces with modern appeal',
                'image' => 'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=600&h=800&fit=crop',
                'children' => ['Shirts', 'Trousers', 'Jackets'],
            ],
            [
                'title' => 'Phones & Accessories',
                'slug' => 'phones-accessories',
                'keywords' => 'phone, mobile, accessories',
                'description' => 'Smart devices & everyday tech',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=800&fit=crop',
                'children' => ['Cases', 'Chargers', 'Cables'],
            ],
            [
                'title' => 'Computer & Office',
                'slug' => 'computer-office',
                'keywords' => 'computer, office, laptop',
                'description' => 'Work tools that inspire productivity',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=800&fit=crop',
                'children' => ['Laptops', 'Keyboards', 'Monitors'],
            ],
            [
                'title' => 'Consumer Electronics',
                'slug' => 'consumer-electronics',
                'keywords' => 'electronics, gadgets',
                'description' => 'Innovation for modern living',
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=800&fit=crop',
                'children' => ['Audio', 'Cameras', 'Smart Home'],
            ],
            [
                'title' => 'Jewelry & Watches',
                'slug' => 'jewelry-watches',
                'keywords' => 'jewelry, watches, accessories',
                'description' => 'Timeless accents & fine craftsmanship',
                'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=600&h=800&fit=crop',
                'children' => ['Watches', 'Rings', 'Necklaces'],
            ],
            [
                'title' => 'Bags & Shoes',
                'slug' => 'bags-shoes',
                'keywords' => 'bags, shoes, leather',
                'description' => 'Leather goods & statement footwear',
                'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&h=800&fit=crop',
                'children' => ['Handbags', 'Sneakers', 'Wallets'],
            ],
        ];

        foreach ($categories as $data) {
            $children = $data['children'] ?? [];
            unset($data['children']);

            $parent = Category::firstOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['parent_id' => null, 'status' => 'active'])
            );

            foreach ($children as $childTitle) {
                $childSlug = $parent->slug.'-'.Str::slug($childTitle);

                Category::firstOrCreate(
                    ['slug' => $childSlug],
                    [
                        'parent_id' => $parent->id,
                        'title' => $childTitle,
                        'keywords' => Str::lower($childTitle).', '.$parent->keywords,
                        'description' => $childTitle.' in '.$parent->title,
                        'image' => $parent->image,
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
