@props(['product', 'large' => false])

<article class="group {{ $large ? 'md:col-span-2 md:row-span-2' : '' }}">
    <div class="relative overflow-hidden bg-luxe-sand {{ $large ? 'aspect-[4/5]' : 'aspect-[3/4]' }}">
        @if ($product->is_new)
            <span class="absolute left-0 top-0 z-10 bg-luxe-ink px-3 py-1.5 text-[10px] font-semibold uppercase tracking-widest text-luxe-cream">New</span>
        @endif
        @if ($discount = $product->discountPercent())
            <span class="absolute right-0 top-0 z-10 bg-luxe-gold px-3 py-1.5 text-[10px] font-semibold uppercase tracking-widest text-luxe-ink">-{{ $discount }}%</span>
        @endif

        <a href="{{ route('products.show', $product) }}">
            <img src="{{ $product->imageUrl() ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=800&fit=crop' }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy">
        </a>

        <div class="absolute inset-x-0 bottom-0 hidden translate-y-full bg-luxe-ink/90 p-4 transition duration-300 group-hover:translate-y-0 md:block">
            <div class="flex gap-2">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-luxe-gold py-2.5 text-[10px] font-bold uppercase tracking-widest text-luxe-ink transition hover:opacity-90">Add to Bag</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4 flex items-start justify-between gap-4">
        <div class="min-w-0 flex-1">
            <a href="{{ route('products.show', $product) }}" class="font-display text-lg leading-tight text-luxe-ink transition hover:text-luxe-gold {{ $large ? 'md:text-2xl' : '' }}">
                {{ $product->name }}
            </a>
            <a href="{{ route('shop.category', $product->category) }}" class="mt-1 block text-xs text-luxe-muted transition hover:text-luxe-gold">{{ $product->category->name }}</a>
            <div class="mt-2 flex items-center gap-2">
                @include('store.partials.star-rating', ['rating' => $product->displayRating(), 'size' => 'sm'])
                <span class="text-xs text-luxe-muted">{{ $product->displayReviewCount() }}</span>
            </div>
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-3 md:hidden">
                @csrf
                <button type="submit" class="text-[10px] font-bold uppercase tracking-widest text-luxe-gold hover:text-luxe-ink">+ Add to Bag</button>
            </form>
        </div>
        <div class="shrink-0 text-right">
            <p class="text-sm font-semibold text-luxe-ink">${{ number_format($product->price, 2) }}</p>
            @if ($product->compare_price)
                <p class="text-xs text-luxe-muted line-through">${{ number_format($product->compare_price, 2) }}</p>
            @endif
        </div>
    </div>
</article>
