@extends('layouts.store')

@section('title', $product->name)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
    <nav class="mb-8 text-sm text-zinc-400">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('shop.category', $product->category) }}" class="hover:text-primary-600">{{ $product->category->name }}</a>
        <span class="mx-2">/</span>
        <span class="font-medium text-primary-600">{{ $product->name }}</span>
    </nav>

    <div class="card grid gap-10 p-6 lg:grid-cols-2 lg:p-10" x-data="{ selectedSize: '{{ $product->sizes[0] ?? '' }}', selectedColor: '{{ $product->colors[0] ?? '#000' }}', qty: 1 }">
        <div class="relative overflow-hidden rounded-3xl bg-surface-100">
            @if ($product->is_new)
                <span class="absolute left-4 top-4 z-10 rounded-full bg-zinc-900 px-3 py-1 text-xs font-bold text-white">New</span>
            @endif
            @if ($discount = $product->discountPercent())
                <span class="absolute left-4 {{ $product->is_new ? 'top-12' : 'top-4' }} z-10 rounded-full bg-accent-500 px-3 py-1 text-xs font-bold text-white">-{{ $discount }}%</span>
            @endif
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
        </div>

        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900">{{ $product->name }}</h1>

            <div class="mt-5 flex items-baseline gap-3">
                <span class="text-3xl font-bold text-zinc-900">${{ number_format($product->price, 2) }}</span>
                @if ($product->compare_price)
                    <span class="text-lg text-zinc-400 line-through">${{ number_format($product->compare_price, 2) }}</span>
                @endif
            </div>

            <div class="mt-4 flex items-center gap-3">
                <div class="flex gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4 {{ $i <= $product->rating ? 'text-primary-500' : 'text-surface-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <a href="#" class="text-sm text-zinc-400 hover:text-primary-600">{{ $product->review_count }} reviews</a>
            </div>

            <div class="mt-6 flex flex-wrap gap-4 text-sm">
                <p>Availability: <span class="{{ $product->inStock() ? 'text-primary-600' : 'text-red-500' }} font-semibold">{{ $product->inStock() ? 'In Stock' : 'Out of Stock' }}</span></p>
                <p>Brand: <span class="font-semibold text-zinc-900">{{ $product->brand }}</span></p>
            </div>

            <p class="mt-6 leading-relaxed text-zinc-500">{{ $product->description }}</p>

            @if ($product->sizes)
                <div class="mt-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Size</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($product->sizes as $size)
                            <button type="button" @click="selectedSize = '{{ $size }}'" :class="selectedSize === '{{ $size }}' ? 'border-primary-500 bg-primary-50 text-primary-700' : 'border-surface-200 text-zinc-600'" class="rounded-full border px-5 py-2 text-sm font-medium transition hover:border-primary-300">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($product->colors)
                <div class="mt-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Color</p>
                    <div class="mt-3 flex gap-3">
                        @foreach ($product->colors as $color)
                            <button type="button" @click="selectedColor = '{{ $color }}'" :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-primary-500 ring-offset-2' : ''" class="h-9 w-9 rounded-full border-2 border-white shadow-md transition" style="background-color: {{ $color }}"></button>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Quantity</p>
                <div class="mt-3 flex items-center gap-3">
                    <button type="button" @click="qty = Math.max(1, qty - 1)" class="btn-icon">−</button>
                    <input type="number" x-model="qty" min="1" class="w-20 rounded-full border-surface-200 text-center text-sm font-semibold">
                    <button type="button" @click="qty++" class="btn-icon">+</button>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1 sm:flex-none">
                    @csrf
                    <input type="hidden" name="quantity" x-bind:value="qty">
                    <button type="submit" class="btn-primary w-full sm:w-auto">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Add to Cart
                    </button>
                </form>
                <button type="button" class="btn-icon" title="Wishlist">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </button>
                <button type="button" class="btn-icon" title="Compare">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </button>
                <button type="button" class="btn-icon" title="Share" onclick="navigator.share?.({title: '{{ $product->name }}', url: window.location.href})">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </button>
            </div>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section class="mt-16">
            <h2 class="section-title">You May <span>Also Like</span></h2>
            <div class="mt-8 grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-4">
                @foreach ($relatedProducts as $related)
                    @include('store.partials.product-card', ['product' => $related])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
