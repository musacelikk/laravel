<div class="scrollbar-hide flex gap-2 overflow-x-auto pb-1">
    <a href="{{ route('shop.index') }}" class="pill {{ !isset($activeCategory) && !request()->routeIs('shop.sales') ? 'pill-active' : '' }}">All</a>
    @foreach ($storeCategories as $category)
        <a href="{{ route('shop.category', $category) }}" class="pill {{ isset($activeCategory) && $activeCategory->id === $category->id ? 'pill-active' : '' }}">
            {{ $category->name }}
        </a>
    @endforeach
    <a href="{{ route('shop.sales') }}" class="pill {{ request()->routeIs('shop.sales') ? 'pill-active' : '' }}">Sale</a>
</div>
