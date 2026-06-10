<aside class="hidden w-60 shrink-0 lg:block">
    <div class="card overflow-hidden">
        <div class="bg-gradient-to-r from-primary-700 to-primary-500 px-5 py-4">
            <h3 class="text-sm font-bold uppercase tracking-widest text-white">Categories</h3>
        </div>
        <ul>
            @foreach ($storeCategories as $category)
                <li>
                    <a href="{{ route('shop.category', $category) }}" class="flex items-center justify-between border-b border-surface-100 px-5 py-3.5 text-sm font-medium text-zinc-600 transition last:border-0 hover:bg-primary-50 hover:text-primary-700 {{ isset($activeCategory) && $activeCategory->id === $category->id ? 'bg-primary-50 text-primary-700' : '' }}">
                        {{ $category->name }}
                        <svg class="h-3.5 w-3.5 text-surface-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ route('shop.index') }}" class="block px-5 py-3.5 text-sm font-semibold text-accent-600 hover:bg-accent-500/5">View All →</a>
            </li>
        </ul>
    </div>
</aside>
