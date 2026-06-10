<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('store.home', [
            'slides' => config('home.slides'),
            'categoryTree' => Category::tree(),
            'latestProducts' => Product::query()
                ->where('status', 'active')
                ->with('category')
                ->latest()
                ->take(8)
                ->get(),
            'featuredProducts' => Product::query()
                ->where('status', 'active')
                ->where('is_featured', true)
                ->with('category')
                ->take(4)
                ->get(),
            'dealProducts' => Product::query()
                ->where('status', 'active')
                ->where('is_deal', true)
                ->with('category')
                ->take(4)
                ->get(),
        ]);
    }
}
