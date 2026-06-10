@props(['product'])

<article class="group card flex flex-col overflow-hidden transition duration-300 hover:border-primary-200 hover:shadow-glow">
    <div class="relative aspect-square overflow-hidden bg-surface-100">
        @if ($product->is_new)
            <span class="absolute left-3 top-3 z-10 rounded-full bg-zinc-900 px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-white">New</span>
        @endif
        @if ($discount = $product->discountPercent())
            <span class="absolute {{ $product->is_new ? 'left-3 top-10' : 'left-3 top-3' }} z-10 rounded-full bg-accent-500 px-3 py-1 text-[10px] font-bold text-white">-{{ $discount }}%</span>
        @endif

        <a href="{{ route('products.show', $product) }}">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
        </a>

        <div class="absolute inset-x-3 bottom-3 flex translate-y-3 gap-2 opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100">
            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="btn-primary w-full !py-2.5 !text-xs !shadow-none">Add to Cart</button>
            </form>
            <button type="button" class="btn-icon !h-10 !w-10" title="Wishlist">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
            <button type="button" class="btn-icon !h-10 !w-10" title="Compare">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </button>
        </div>
    </div>

    <div class="flex flex-1 flex-col p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-baseline gap-2">
                <span class="text-lg font-bold text-zinc-900">${{ number_format($product->price, 2) }}</span>
                @if ($product->compare_price)
                    <span class="text-sm text-zinc-400 line-through">${{ number_format($product->compare_price, 2) }}</span>
                @endif
            </div>
            <div class="flex gap-0.5">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="h-3.5 w-3.5 {{ $i <= $product->rating ? 'text-primary-500' : 'text-surface-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
        </div>
        <a href="{{ route('products.show', $product) }}" class="mt-2 text-sm font-medium text-zinc-500 transition hover:text-primary-700 line-clamp-2">
            {{ $product->name }}
        </a>
    </div>
</article>
