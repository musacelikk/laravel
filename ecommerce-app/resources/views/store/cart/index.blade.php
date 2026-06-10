@extends('layouts.store')

@section('title', 'My Cart')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
    <h1 class="section-title">Shopping <span>Cart</span></h1>

    @if ($items->isEmpty())
        <div class="card mt-10 py-20 text-center">
            <svg class="mx-auto h-16 w-16 text-surface-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="mt-4 text-zinc-400">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="btn-primary mt-6 inline-flex">Continue Shopping</a>
        </div>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <div class="space-y-4 lg:col-span-2">
                @foreach ($items as $item)
                    <div class="card flex gap-4 p-4 sm:p-6">
                        <img src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}" class="h-24 w-24 rounded-2xl object-cover">
                        <div class="flex flex-1 flex-col justify-between">
                            <div>
                                <a href="{{ route('products.show', $item['product']) }}" class="font-semibold text-zinc-900 hover:text-primary-600">{{ $item['product']->name }}</a>
                                <p class="mt-1 text-sm text-zinc-400">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="text-lg font-bold text-primary-600">${{ number_format($item['subtotal'], 2) }}</p>
                        </div>
                        <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon !text-red-400 hover:!border-red-200 hover:!bg-red-50 hover:!text-red-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="card h-fit p-6">
                <h3 class="text-lg font-bold text-zinc-900">Order Summary</h3>
                <div class="mt-5 flex justify-between text-sm">
                    <span class="text-zinc-400">Subtotal</span>
                    <span class="font-semibold">${{ number_format($total, 2) }}</span>
                </div>
                <div class="mt-2 flex justify-between text-sm">
                    <span class="text-zinc-400">Shipping</span>
                    <span class="font-semibold text-primary-600">Free</span>
                </div>
                <div class="mt-5 flex justify-between border-t border-surface-100 pt-5">
                    <span class="font-bold text-zinc-900">Total</span>
                    <span class="text-xl font-bold text-primary-600">${{ number_format($total, 2) }}</span>
                </div>
                <button type="button" class="btn-primary mt-6 w-full">Proceed to Checkout</button>
                <a href="{{ route('shop.index') }}" class="mt-3 block text-center text-sm text-zinc-400 hover:text-primary-600">Continue Shopping</a>
            </div>
        </div>
    @endif
</div>
@endsection
