<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'bags-shoes',
                'name' => 'Urban Canvas Messenger Bag',
                'price' => 32.50,
                'compare_price' => 45.00,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=600&fit=crop',
                'is_new' => true,
                'is_featured' => true,
                'is_deal' => true,
                'rating' => 5,
                'review_count' => 12,
                'sizes' => ['S', 'M', 'L'],
                'colors' => ['#2563eb', '#7c3aed', '#db2777'],
            ],
            [
                'category' => 'jewelry-watches',
                'name' => 'Minimalist Gold Watch',
                'price' => 89.00,
                'compare_price' => null,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=600&fit=crop',
                'is_new' => true,
                'is_featured' => true,
                'rating' => 4,
                'review_count' => 8,
                'sizes' => ['One Size'],
                'colors' => ['#ca8a04', '#1e293b'],
            ],
            [
                'category' => 'bags-shoes',
                'name' => 'Premium Leather Wallet',
                'price' => 24.99,
                'compare_price' => 35.00,
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=600&h=600&fit=crop',
                'is_new' => false,
                'is_featured' => true,
                'is_deal' => true,
                'rating' => 5,
                'review_count' => 21,
                'sizes' => ['Standard'],
                'colors' => ['#92400e', '#1e293b'],
            ],
            [
                'category' => 'bags-shoes',
                'name' => 'Cloud Runner Sneakers',
                'price' => 64.00,
                'compare_price' => 80.00,
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&h=600&fit=crop',
                'is_new' => true,
                'is_featured' => true,
                'is_deal' => true,
                'rating' => 5,
                'review_count' => 34,
                'sizes' => ['39', '40', '41', '42', '43'],
                'colors' => ['#2563eb', '#dc2626', '#ffffff'],
            ],
            [
                'category' => 'womens-clothing',
                'name' => 'Silk Blend Blouse',
                'price' => 42.00,
                'compare_price' => 55.00,
                'image' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=600&h=600&fit=crop',
                'is_new' => true,
                'is_featured' => false,
                'is_deal' => true,
                'rating' => 4,
                'review_count' => 6,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'colors' => ['#fce7f3', '#ffffff', '#1e293b'],
            ],
            [
                'category' => 'mens-clothing',
                'name' => 'Classic Oxford Shirt',
                'price' => 38.50,
                'compare_price' => null,
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&h=600&fit=crop',
                'is_new' => false,
                'is_featured' => true,
                'rating' => 5,
                'review_count' => 15,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['#ffffff', '#1e40af', '#14532d'],
            ],
            [
                'category' => 'consumer-electronics',
                'name' => 'Wireless Noise-Cancel Headphones',
                'price' => 129.00,
                'compare_price' => 179.00,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop',
                'is_new' => true,
                'is_featured' => true,
                'is_deal' => true,
                'rating' => 5,
                'review_count' => 47,
                'sizes' => ['One Size'],
                'colors' => ['#1e293b', '#f8fafc'],
            ],
            [
                'category' => 'phones-accessories',
                'name' => 'MagSafe Phone Case',
                'price' => 19.99,
                'compare_price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=600&h=600&fit=crop',
                'is_new' => false,
                'is_featured' => false,
                'is_deal' => true,
                'rating' => 4,
                'review_count' => 9,
                'sizes' => ['iPhone 15', 'iPhone 16'],
                'colors' => ['#1e293b', '#f97316', '#e2e8f0'],
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('slug', $item['category'])->first();

            Product::create([
                'category_id' => $category->id,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Crafted with premium materials for everyday comfort and lasting style. Designed for modern lifestyles with attention to detail in every stitch and finish.',
                'price' => $item['price'],
                'compare_price' => $item['compare_price'],
                'image' => $item['image'],
                'brand' => 'E-SHOP',
                'rating' => $item['rating'],
                'review_count' => $item['review_count'],
                'stock' => 50,
                'is_new' => $item['is_new'],
                'is_featured' => $item['is_featured'],
                'is_deal' => $item['is_deal'] ?? false,
                'sizes' => $item['sizes'],
                'colors' => $item['colors'],
            ]);
        }
    }
}
