<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

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
            ],
            [
                'title' => "Men's Clothing",
                'slug' => 'mens-clothing',
                'keywords' => 'men, clothing, fashion',
                'description' => 'Tailored pieces with modern appeal',
                'image' => 'https://images.unsplash.com/photo-1617137968427-85924c800a22?w=600&h=800&fit=crop',
            ],
            [
                'title' => 'Phones & Accessories',
                'slug' => 'phones-accessories',
                'keywords' => 'phone, mobile, accessories',
                'description' => 'Smart devices & everyday tech',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=800&fit=crop',
            ],
            [
                'title' => 'Computer & Office',
                'slug' => 'computer-office',
                'keywords' => 'computer, office, laptop',
                'description' => 'Work tools that inspire productivity',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=800&fit=crop',
            ],
            [
                'title' => 'Consumer Electronics',
                'slug' => 'consumer-electronics',
                'keywords' => 'electronics, gadgets',
                'description' => 'Innovation for modern living',
                'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=800&fit=crop',
            ],
            [
                'title' => 'Jewelry & Watches',
                'slug' => 'jewelry-watches',
                'keywords' => 'jewelry, watches, accessories',
                'description' => 'Timeless accents & fine craftsmanship',
                'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=600&h=800&fit=crop',
            ],
            [
                'title' => 'Bags & Shoes',
                'slug' => 'bags-shoes',
                'keywords' => 'bags, shoes, leather',
                'description' => 'Leather goods & statement footwear',
                'image' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=600&h=800&fit=crop',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'parent_id' => 0,
                'title' => $category['title'],
                'slug' => $category['slug'],
                'keywords' => $category['keywords'],
                'description' => $category['description'],
                'image' => $category['image'],
                'status' => 'active',
            ]);
        }
    }
}
