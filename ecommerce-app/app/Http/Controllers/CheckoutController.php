<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:1000'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = $request->session()->get('cart', []);

        if ($cart === []) {
            return redirect()->route('cart.index')->with('error', 'Your bag is empty.');
        }

        $products = Product::query()->whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)->map(function ($quantity, $productId) use ($products) {
            $product = $products->get($productId);

            if (! $product || ! $product->inStock()) {
                return null;
            }

            if ($product->quantity < $quantity) {
                return null;
            }

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
        })->filter();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Some items in your bag are no longer available.');
        }

        $order = DB::transaction(function () use ($request, $validated, $items) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'name' => $validated['name'],
                'surname' => $validated['surname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'note' => $validated['note'] ?? null,
                'total' => $items->sum('subtotal'),
                'status' => Order::STATUS_PENDING,
                'ip' => $request->ip(),
            ]);

            foreach ($items as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'user_id' => $request->user()->id,
                    'product_id' => $item['product']->id,
                    'price' => $item['product']->price,
                    'amount' => $item['quantity'],
                    'total' => $item['subtotal'],
                    'ip' => $request->ip(),
                    'status' => 'active',
                ]);

                $item['product']->decrement('quantity', $item['quantity']);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()
            ->route('checkout.complete', $order)
            ->with('success', 'Your order has been placed successfully.');
    }

    public function complete(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('orderProducts.product');

        return view('store.checkout.complete', [
            'order' => $order,
        ]);
    }
}
