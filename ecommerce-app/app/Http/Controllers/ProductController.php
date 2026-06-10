<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        $product->load(['images', 'activeComments.user']);

        return view('store.products.show', [
            'product' => $product,
            'galleryImages' => $product->allImages(),
            'reviews' => $product->activeComments,
            'relatedProducts' => Product::query()
                ->where('status', 'active')
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->withReviewStats()
                ->with('category')
                ->take(4)
                ->get(),
        ]);
    }
}
