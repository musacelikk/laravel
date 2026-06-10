@extends('layouts.store')

@section('title', $title ?? 'Shop')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10 lg:px-8">
    <nav class="mb-6 text-sm text-zinc-400">
        <a href="{{ route('home') }}" class="hover:text-primary-600">Home</a>
        <span class="mx-2">/</span>
        <span class="font-medium text-primary-600">{{ $title ?? 'Shop' }}</span>
    </nav>

    <div class="flex gap-8">
        @include('store.partials.category-sidebar')

        <div class="min-w-0 flex-1">
            <div class="mb-8 flex items-center justify-between">
                <h1 class="section-title">{{ $title ?? 'Shop' }}</h1>
                <p class="text-sm text-zinc-400">{{ $products->total() }} products</p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-3">
                @forelse ($products as $product)
                    @include('store.partials.product-card', ['product' => $product])
                @empty
                    <div class="card col-span-full py-16 text-center">
                        <p class="text-zinc-400">No products found.</p>
                        <a href="{{ route('shop.index') }}" class="btn-primary mt-4 inline-flex">Browse All</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
