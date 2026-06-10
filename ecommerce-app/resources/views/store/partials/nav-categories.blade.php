@foreach ($navCategoryTree as $parent)
    @php
        $routeCategory = request()->route('category');
        $navActive = $routeCategory && ($routeCategory->id === $parent->id || $routeCategory->parent_id === $parent->id);
    @endphp
    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <a
            href="{{ route('shop.category', $parent) }}"
            class="label-upper inline-flex items-center gap-1 {{ $navActive ? 'text-luxe-gold' : '' }} hover:text-luxe-gold"
        >
            {{ $parent->title }}
            @if ($parent->children->isNotEmpty())
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            @endif
        </a>
        @if ($parent->children->isNotEmpty())
            <div
                x-show="open"
                x-cloak
                class="absolute left-0 top-full z-50 min-w-[200px] border border-luxe-ink/10 bg-luxe-cream py-2 shadow-lg"
            >
                <a href="{{ route('shop.category', $parent) }}" class="block px-4 py-2 text-xs font-semibold uppercase tracking-widest text-luxe-ink hover:bg-luxe-sand">
                    All {{ $parent->title }}
                </a>
                @foreach ($parent->children as $child)
                    <a href="{{ route('shop.category', $child) }}" class="block px-4 py-2 text-sm text-luxe-muted hover:bg-luxe-sand hover:text-luxe-gold">
                        — {{ $child->title }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endforeach
