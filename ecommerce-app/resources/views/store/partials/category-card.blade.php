@props(['category'])

<a href="{{ route('shop.category', $category) }}" class="group relative block overflow-hidden bg-luxe-sand">
    <div class="aspect-[3/4] overflow-hidden">
        <img
            src="{{ $category->coverImage() }}"
            alt="{{ $category->name }}"
            class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]"
            loading="lazy"
        >
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-luxe-ink/80 via-luxe-ink/20 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-5 text-luxe-cream">
        <p class="label-upper !text-luxe-gold">{{ $category->products_count }} pieces</p>
        <h3 class="mt-2 font-display text-xl leading-tight transition group-hover:text-luxe-gold md:text-2xl">{{ $category->name }}</h3>
        <p class="mt-2 text-xs leading-relaxed text-luxe-cream/70 line-clamp-2">{{ $category->tagline() }}</p>
        <span class="mt-4 inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-luxe-gold">
            Shop Now
            <svg class="h-3 w-3 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </span>
    </div>
</a>
