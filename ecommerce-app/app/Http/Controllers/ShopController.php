<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
            })
            ->latest()
            ->paginate(12);

        return view('store.shop.index', [
            'products' => $products,
            'title' => 'Shop',
        ]);
    }

    public function category(Category $category): View
    {
        $products = Product::query()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        return view('store.shop.index', [
            'products' => $products,
            'title' => $category->name,
            'activeCategory' => $category,
        ]);
    }

    public function sales(): View
    {
        $products = Product::query()
            ->whereNotNull('compare_price')
            ->whereColumn('compare_price', '>', 'price')
            ->latest()
            ->paginate(12);

        return view('store.shop.index', [
            'products' => $products,
            'title' => 'Sales',
        ]);
    }
}
