@extends('layouts.store')

@section('title', 'Checkout')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    <nav class="label-upper !text-luxe-muted">
        <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('cart.index') }}" class="hover:text-luxe-ink">Your Bag</a>
        <span class="mx-2">/</span>
        <span class="text-luxe-ink">Checkout</span>
    </nav>
    <h1 class="heading-section mt-4">Checkout</h1>

    <div class="mt-12 grid gap-16 lg:grid-cols-3">
        <div class="space-y-4 lg:col-span-2">
            @foreach ($items as $item)
                <div class="flex gap-4 border border-luxe-ink/10 p-4">
                    <img src="{{ $item['product']->imageUrl() }}" alt="" class="h-20 w-16 bg-luxe-sand object-cover">
                    <div class="flex-1">
                        <p class="font-display text-lg">{{ $item['product']->name }}</p>
                        <p class="text-sm text-luxe-muted">Qty: {{ $item['quantity'] }} · ${{ number_format($item['product']->price, 2) }}</p>
                    </div>
                    <p class="font-display text-lg">${{ number_format($item['subtotal'], 2) }}</p>
                </div>
            @endforeach
        </div>

        <div class="h-fit border border-luxe-ink/10 p-8">
            <p class="label-upper">Order Total</p>
            <p class="mt-4 font-display text-3xl">${{ number_format($total, 2) }}</p>
            @auth
                <p class="mt-4 text-sm text-luxe-muted">Shipping to {{ $user->email }}</p>
                <a href="{{ route('cart.index') }}" class="btn-gold mt-8 block w-full text-center">Review Bag & Checkout</a>
            @else
                <p class="mt-4 text-sm text-luxe-muted">Please sign in to complete your order.</p>
                <a href="{{ route('login') }}" class="btn-gold mt-8 block w-full text-center">Login to Checkout</a>
            @endauth
            <a href="{{ route('shop.index') }}" class="mt-4 block text-center text-xs uppercase tracking-widest text-luxe-muted hover:text-luxe-ink">Continue Shopping</a>
        </div>
    </div>
</section>
@endsection
