<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class StoreComposer
{
    public function compose(View $view): void
    {
        $cart = session('cart', []);
        $cartCount = array_sum($cart);
        $cartTotal = 0;

        if ($cartCount > 0) {
            $products = Product::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');

            foreach ($cart as $productId => $quantity) {
                if ($product = $products->get($productId)) {
                    $cartTotal += $product->price * $quantity;
                }
            }
        }

        $view->with([
            'storeCategories' => Category::query()->withCount('products')->orderBy('title')->get(),
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
        ]);
    }
}
