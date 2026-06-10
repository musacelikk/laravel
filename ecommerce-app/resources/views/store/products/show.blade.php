@extends('layouts.store')

@section('title', $product->name)

@section('content')
<section class="border-b border-luxe-ink/10 px-6 py-6">
    <div class="mx-auto max-w-[1400px]">
        <nav class="label-upper !text-luxe-muted">
            <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.category', $product->category) }}" class="hover:text-luxe-ink">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-luxe-ink">{{ $product->name }}</span>
        </nav>
    </div>
</section>

<section class="mx-auto max-w-[1400px] px-6 py-12" x-data="{ selectedSize: '{{ $product->sizes[0] ?? '' }}', selectedColor: '{{ $product->colors[0] ?? '#1a1814' }}', qty: 1 }">
    <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
        <div class="relative bg-luxe-sand">
            @if ($product->is_new)
                <span class="absolute left-0 top-0 z-10 bg-luxe-ink px-4 py-2 text-[10px] font-semibold uppercase tracking-widest text-luxe-cream">New</span>
            @endif
            @if ($discount = $product->discountPercent())
                <span class="absolute right-0 top-0 z-10 bg-luxe-gold px-4 py-2 text-[10px] font-semibold uppercase tracking-widest text-luxe-ink">-{{ $discount }}%</span>
            @endif
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="aspect-[4/5] w-full object-cover">
        </div>

        <div class="flex flex-col justify-center">
            <p class="label-upper">{{ $product->brand }}</p>
            <h1 class="heading-section mt-3">{{ $product->name }}</h1>

            <div class="mt-6 flex items-baseline gap-4 border-b border-luxe-ink/10 pb-6">
                <span class="font-display text-4xl text-luxe-ink">${{ number_format($product->price, 2) }}</span>
                @if ($product->compare_price)
                    <span class="text-lg text-luxe-muted line-through">${{ number_format($product->compare_price, 2) }}</span>
                @endif
            </div>

            <p class="mt-6 text-sm leading-relaxed text-luxe-muted">{{ $product->description }}</p>

            <div class="mt-4 flex gap-6 text-xs uppercase tracking-widest">
                <span class="{{ $product->inStock() ? 'text-luxe-ink' : 'text-red-600' }}">{{ $product->inStock() ? 'In Stock' : 'Sold Out' }}</span>
                <span class="text-luxe-muted">{{ $product->review_count }} reviews</span>
            </div>

            @if ($product->sizes)
                <div class="mt-8">
                    <p class="label-upper">Size</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($product->sizes as $size)
                            <button type="button" @click="selectedSize = '{{ $size }}'" :class="selectedSize === '{{ $size }}' ? 'bg-luxe-ink text-luxe-cream' : 'border-luxe-ink/15 text-luxe-ink'" class="border px-5 py-2.5 text-xs font-medium uppercase tracking-wider transition">{{ $size }}</button>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($product->colors)
                <div class="mt-6">
                    <p class="label-upper">Color</p>
                    <div class="mt-3 flex gap-3">
                        @foreach ($product->colors as $color)
                            <button type="button" @click="selectedColor = '{{ $color }}'" :class="selectedColor === '{{ $color }}' ? 'ring-2 ring-luxe-gold ring-offset-2' : ''" class="h-8 w-8 border border-luxe-ink/10 transition" style="background-color: {{ $color }}"></button>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <p class="label-upper">Quantity</p>
                <div class="mt-3 inline-flex items-center border border-luxe-ink/15">
                    <button type="button" @click="qty = Math.max(1, qty - 1)" class="px-4 py-2 text-luxe-muted hover:text-luxe-ink">−</button>
                    <input type="number" x-model="qty" min="1" class="w-14 border-0 bg-transparent text-center text-sm focus:ring-0">
                    <button type="button" @click="qty++" class="px-4 py-2 text-luxe-muted hover:text-luxe-ink">+</button>
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-3">
                @if ($product->inStock())
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" x-bind:value="qty">
                        <button type="submit" class="btn-gold">Add to Bag</button>
                    </form>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" x-bind:value="qty">
                        <input type="hidden" name="redirect" value="cart">
                        <button type="submit" class="btn-outline">Buy Now</button>
                    </form>
                @else
                    <button type="button" class="btn-gold cursor-not-allowed opacity-50" disabled>Sold Out</button>
                @endif
                <button type="button" class="btn-outline">Wishlist</button>
                <button type="button" class="btn-icon" title="Compare">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </button>
                <button type="button" class="btn-icon" title="Share" onclick="navigator.share?.({title: '{{ $product->name }}', url: window.location.href})">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </button>
            </div>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <div class="mt-24 border-t border-luxe-ink/10 pt-16">
            <h2 class="heading-section">You May Also Like</h2>
            <div class="mt-10 grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
                @foreach ($relatedProducts as $product)
                    @include('store.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
