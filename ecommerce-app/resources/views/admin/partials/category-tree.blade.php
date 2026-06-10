@foreach ($nodes as $node)
    <li class="list-group-item {{ isset($activeId) && $activeId === $node->id ? 'active' : '' }}">
        <a href="{{ route('admin.catalog.categories.show', $node) }}" class="d-flex justify-content-between align-items-center {{ isset($activeId) && $activeId === $node->id ? 'text-white' : '' }}">
            <span>{{ $node->title }}</span>
            <span class="badge badge-{{ isset($activeId) && $activeId === $node->id ? 'light' : 'info' }}">{{ $node->products_count }}</span>
        </a>
        @if ($node->children->isNotEmpty())
            <ul class="list-group mt-2 ml-3">
                @include('admin.partials.category-tree', ['nodes' => $node->children, 'activeId' => $activeId ?? null])
            </ul>
        @endif
    </li>
@endforeach
