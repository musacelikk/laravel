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
            ->where('status', 'active')
            ->withReviewStats()
            ->with('category')
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->q.'%'))
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
        $category->load(['children' => fn ($q) => $q->where('status', 'active')->withCount('products'), 'parent']);

        $products = Product::query()
            ->where('status', 'active')
            ->withReviewStats()
            ->with('category')
            ->whereIn('category_id', $category->productScopeIds())
            ->latest()
            ->paginate(12);

        $parentCategory = $category->parent_id ? $category->parent : $category;
        $subCategories = $parentCategory->children()->where('status', 'active')->withCount('products')->orderBy('title')->get();

        return view('store.shop.index', [
            'products' => $products,
            'title' => $category->title,
            'activeCategory' => $category,
            'parentCategory' => $parentCategory,
            'subCategories' => $subCategories,
        ]);
    }

    public function sales(): View
    {
        $products = Product::query()
            ->where('status', 'active')
            ->withReviewStats()
            ->with('category')
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
