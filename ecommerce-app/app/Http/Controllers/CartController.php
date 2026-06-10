<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)->map(function ($quantity, $productId) use ($products) {
            $product = $products->get($productId);

            if (! $product) {
                return null;
            }

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
        })->filter();

        return view('store.cart.index', [
            'items' => $items,
            'total' => $items->sum('subtotal'),
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + max(1, (int) $request->input('quantity', 1));
        $request->session()->put('cart', $cart);

        return back()->with('success', $product->name.' added to cart.');
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
