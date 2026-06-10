@extends('layouts.store')

@section('title', 'Bag')

@section('content')
<section class="section-shell py-12 md:py-16">
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
        <span class="mx-2">/</span>
        <span class="text-luxe-ink">Your Bag</span>
    </nav>
    <h1 class="heading-section mt-4">Your Bag</h1>

    @if ($items->isEmpty())
        <div class="card-luxe mt-16 py-20 text-center">
            <p class="font-display text-3xl text-luxe-muted">Your bag is empty</p>
            <p class="mt-3 text-sm text-luxe-muted">Discover something you love from our collection.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('shop.index') }}" class="btn-gold">Continue Shopping</a>
                <a href="{{ route('shop.sales') }}" class="btn-outline">View Sale</a>
            </div>
        </div>
    @else
        <div class="mt-12 grid gap-12 lg:grid-cols-3 lg:gap-16">
            <div class="space-y-0 lg:col-span-2">
                @foreach ($items as $item)
                    <div class="flex gap-5 border-b border-luxe-ink/10 py-8 first:pt-0">
                        <a href="{{ route('products.show', $item['product']) }}" class="shrink-0 overflow-hidden ring-1 ring-luxe-ink/10">
                            <img src="{{ $item['product']->imageUrl() }}" alt="{{ $item['product']->name }}" class="h-36 w-28 bg-luxe-sand object-cover transition hover:scale-105">
                        </a>
                        <div class="flex min-w-0 flex-1 flex-col justify-between">
                            <div>
                                <a href="{{ route('products.show', $item['product']) }}" class="font-display text-xl hover:text-luxe-gold">{{ $item['product']->name }}</a>
                                <a href="{{ route('shop.category', $item['product']->category) }}" class="mt-1 block text-xs text-luxe-muted hover:text-luxe-gold">{{ $item['product']->category->name }}</a>
                                <p class="mt-2 text-sm text-luxe-muted">${{ number_format($item['product']->price, 2) }} each</p>
                            </div>
                            <div class="mt-4 flex flex-wrap items-center gap-6">
                                <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="inline-flex items-center border border-luxe-ink/15 bg-white">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-2 text-luxe-muted hover:text-luxe-ink" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>−</button>
                                    <span class="w-10 text-center text-sm font-medium tabular-nums">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-2 text-luxe-muted hover:text-luxe-ink" {{ $item['quantity'] >= 99 ? 'disabled' : '' }}>+</button>
                                </form>
                                <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs uppercase tracking-widest text-luxe-muted hover:text-red-700">Remove</button>
                                </form>
                            </div>
                        </div>
                        <p class="shrink-0 font-display text-2xl">${{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="card-luxe h-fit p-8">
                <p class="label-upper">Order Summary</p>
                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-luxe-muted">Items ({{ $items->sum('quantity') }})</span>
                        <span class="font-medium">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-luxe-muted">Shipping</span>
                        <span class="text-luxe-gold">Complimentary</span>
                    </div>
                </div>
                <div class="mt-6 flex justify-between border-t border-luxe-ink/10 pt-6">
                    <span class="font-display text-xl">Total</span>
                    <span class="font-display text-2xl">${{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="btn-gold mt-8 block w-full text-center">Proceed to Checkout</a>
                <a href="{{ route('shop.index') }}" class="mt-4 block text-center text-xs uppercase tracking-widest text-luxe-muted hover:text-luxe-ink">Continue Shopping</a>
            </div>
        </div>
    @endif
</section>
@endsection
