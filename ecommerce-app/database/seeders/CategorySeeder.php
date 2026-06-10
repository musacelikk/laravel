<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => "Women's Clothing", 'slug' => 'womens-clothing', 'sort_order' => 1],
            ['name' => "Men's Clothing", 'slug' => 'mens-clothing', 'sort_order' => 2],
            ['name' => 'Phones & Accessories', 'slug' => 'phones-accessories', 'sort_order' => 3],
            ['name' => 'Computer & Office', 'slug' => 'computer-office', 'sort_order' => 4],
            ['name' => 'Consumer Electronics', 'slug' => 'consumer-electronics', 'sort_order' => 5],
            ['name' => 'Jewelry & Watches', 'slug' => 'jewelry-watches', 'sort_order' => 6],
            ['name' => 'Bags & Shoes', 'slug' => 'bags-shoes', 'sort_order' => 7],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
