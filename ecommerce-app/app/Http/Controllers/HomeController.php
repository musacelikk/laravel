<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('store.home', [
            'latestProducts' => Product::query()->where('status', 'active')->latest()->take(4)->get(),
            'dealProducts' => Product::query()->where('status', 'active')->where('is_deal', true)->take(4)->get(),
            'featuredProducts' => Product::query()->where('status', 'active')->where('is_featured', true)->take(4)->get(),
        ]);
    }
}
