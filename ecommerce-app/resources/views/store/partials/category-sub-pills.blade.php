@if (isset($subCategories) && $subCategories->isNotEmpty())
<div class="scrollbar-hide flex flex-wrap gap-2">
    <a href="{{ route('shop.category', $parentCategory) }}" class="pill {{ $activeCategory->id === $parentCategory->id ? 'pill-active' : '' }}">
        All {{ $parentCategory->title }}
    </a>
    @foreach ($subCategories as $sub)
        <a href="{{ route('shop.category', $sub) }}" class="pill {{ $activeCategory->id === $sub->id ? 'pill-active' : '' }}">
            {{ $sub->title }}
            <span class="ml-1 opacity-60">({{ $sub->products_count }})</span>
        </a>
    @endforeach
</div>
@endif
