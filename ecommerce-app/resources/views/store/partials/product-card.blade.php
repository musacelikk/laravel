@props(['product', 'large' => false])

<article class="group product-card {{ $large ? 'md:col-span-2 md:row-span-2' : '' }}">
    <div class="product-card-media {{ $large ? 'aspect-[4/5]' : 'aspect-[3/4]' }}">
        @if ($product->is_new)
            <span class="absolute left-0 top-0 z-10 bg-luxe-ink px-3 py-1.5 text-[10px] font-semibold uppercase tracking-widest text-luxe-cream">New</span>
        @endif
        @if ($discount = $product->discountPercent())
            <span class="absolute right-0 top-0 z-10 bg-luxe-gold px-3 py-1.5 text-[10px] font-semibold uppercase tracking-widest text-luxe-ink">-{{ $discount }}%</span>
        @endif

        <a href="{{ route('products.show', $product) }}" class="block h-full">
            <img src="{{ $product->imageUrl() ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=800&fit=crop' }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]" loading="lazy">
        </a>

        <div class="absolute inset-x-0 bottom-0 translate-y-full bg-gradient-to-t from-luxe-ink via-luxe-ink/95 to-transparent p-4 pt-10 transition duration-300 group-hover:translate-y-0">
            <div class="flex gap-2">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-luxe-gold py-2.5 text-[10px] font-bold uppercase tracking-widest text-luxe-ink transition hover:bg-luxe-gold-light">Add to Bag</button>
                </form>
                <a href="{{ route('cart.add.link', $product) }}" class="flex h-[38px] w-10 items-center justify-center border border-luxe-gold/50 text-sm font-bold text-luxe-gold transition hover:bg-luxe-gold hover:text-luxe-ink" title="Quick add">+</a>
            </div>
        </div>
    </div>

    <div class="mt-4 space-y-2">
        <div class="flex items-start justify-between gap-3">
            <a href="{{ route('products.show', $product) }}" class="min-w-0 flex-1 font-display leading-tight text-luxe-ink transition hover:text-luxe-gold {{ $large ? 'text-xl md:text-2xl' : 'text-lg' }}">
                {{ $product->name }}
            </a>
            <div class="shrink-0 text-right">
                <p class="price-current {{ $large ? 'text-base' : 'text-sm' }}">${{ number_format($product->price, 2) }}</p>
                @if ($product->compare_price)
                    <p class="price-compare">${{ number_format($product->compare_price, 2) }}</p>
                @endif
            </div>
        </div>

        <a href="{{ route('shop.category', $product->category) }}" class="block text-xs text-luxe-muted transition hover:text-luxe-gold">{{ $product->category->name }}</a>

        <div class="flex items-center gap-2">
            @include('store.partials.star-rating', ['rating' => $product->displayRating(), 'size' => 'sm'])
            <span class="text-xs tabular-nums text-luxe-muted">({{ $product->displayReviewCount() }})</span>
        </div>

        <div class="flex flex-wrap gap-3 pt-1 md:hidden">
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="text-[10px] font-bold uppercase tracking-widest text-luxe-gold hover:text-luxe-ink">Add to Bag</button>
            </form>
            <a href="{{ route('cart.add.link', $product) }}" class="text-[10px] font-bold uppercase tracking-widest text-luxe-muted hover:text-luxe-ink">Quick Add</a>
        </div>
    </div>
</article>
