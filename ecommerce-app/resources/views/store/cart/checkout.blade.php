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
    <h1 class="heading-section mt-4">Complete Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" class="mt-12 grid gap-16 lg:grid-cols-3">
        @csrf

        <div class="space-y-10 lg:col-span-2">
            <div>
                <h2 class="font-display text-xl">Order Items</h2>
                <div class="mt-4 space-y-4">
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
            </div>

            <div class="border border-luxe-ink/10 p-6 md:p-8">
                <h2 class="font-display text-xl">Shipping Details</h2>
                <div class="mt-6 grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="label-upper">First Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="input-field mt-2">
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="surname" class="label-upper">Last Name</label>
                        <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}" required class="input-field mt-2">
                        @error('surname')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="label-upper">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="input-field mt-2">
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone" class="label-upper">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="input-field mt-2">
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address" class="label-upper">Address</label>
                        <textarea name="address" id="address" rows="3" required class="mt-2 w-full border border-luxe-ink/15 bg-luxe-cream px-4 py-3 text-sm focus:border-luxe-gold focus:ring-0">{{ old('address') }}</textarea>
                        @error('address')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="note" class="label-upper">Order Note</label>
                        <textarea name="note" id="note" rows="2" class="mt-2 w-full border border-luxe-ink/15 bg-luxe-cream px-4 py-3 text-sm focus:border-luxe-gold focus:ring-0">{{ old('note') }}</textarea>
                        @error('note')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="h-fit border border-luxe-ink/10 p-8">
            <p class="label-upper">Order Summary</p>
            <div class="mt-6 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-luxe-muted">Items ({{ $items->sum('quantity') }})</span>
                    <span>${{ number_format($total, 2) }}</span>
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
            <button type="submit" class="btn-gold mt-8 w-full">Place Order</button>
            <a href="{{ route('cart.index') }}" class="mt-4 block text-center text-xs uppercase tracking-widest text-luxe-muted hover:text-luxe-ink">Back to Bag</a>
        </div>
    </form>
</section>
@endsection
