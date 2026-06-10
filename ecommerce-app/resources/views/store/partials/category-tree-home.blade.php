@foreach ($nodes as $category)
    <div class="border border-luxe-ink/10 bg-white p-5 transition hover:border-luxe-gold/40">
        <a href="{{ route('shop.category', $category) }}" class="group flex items-center gap-4">
            <img src="{{ $category->coverImage() }}" alt="{{ $category->title }}" class="h-16 w-16 shrink-0 object-cover bg-luxe-sand">
            <div class="min-w-0 flex-1">
                <h3 class="font-display text-lg text-luxe-ink transition group-hover:text-luxe-gold">{{ $category->title }}</h3>
                <p class="mt-0.5 text-xs text-luxe-muted">{{ $category->products_count }} products</p>
            </div>
            <span class="text-luxe-muted transition group-hover:text-luxe-gold">→</span>
        </a>

        @if ($category->children->isNotEmpty())
            <ul class="mt-4 space-y-2 border-t border-luxe-ink/10 pt-4">
                @foreach ($category->children->where('status', 'active') as $child)
                    <li>
                        <a href="{{ route('shop.category', $child) }}" class="flex items-center justify-between text-sm text-luxe-muted transition hover:text-luxe-gold">
                            <span class="flex items-center gap-2">
                                <span class="text-luxe-gold">—</span>
                                {{ $child->title }}
                            </span>
                            <span class="text-xs">{{ $child->products_count ?? 0 }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endforeach
