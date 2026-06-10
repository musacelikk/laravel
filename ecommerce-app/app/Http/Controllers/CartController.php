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
        if (! $product->inStock()) {
            return back()->with('error', $product->name.' is currently out of stock.');
        }

        $quantity = max(1, min(99, (int) $request->input('quantity', 1)));
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = min(99, ($cart[$product->id] ?? 0) + $quantity);
        $request->session()->put('cart', $cart);

        if ($request->input('redirect') === 'cart') {
            return redirect()->route('cart.index')->with('success', $product->name.' added to your bag.');
        }

        return back()->with('success', $product->name.' added to your bag.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $quantity = max(0, min(99, (int) $request->input('quantity', 1)));
        $cart = $request->session()->get('cart', []);

        if ($quantity === 0) {
            unset($cart[$product->id]);
            $message = 'Item removed from your bag.';
        } else {
            $cart[$product->id] = $quantity;
            $message = 'Bag updated.';
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', $message);
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed from your bag.');
    }
}
