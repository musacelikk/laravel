@extends('layouts.store')

@section('title', 'My Products')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'My Products'])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <h1 class="heading-section border-b-2 border-luxe-gold pb-4">My Products</h1>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($products as $product)
                    <article class="border border-luxe-ink/10 p-4">
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="aspect-square w-full bg-luxe-sand object-cover">
                        <h2 class="mt-4 font-display text-lg">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-luxe-gold">{{ $product->name }}</a>
                        </h2>
                        <p class="mt-1 text-sm text-luxe-muted">${{ number_format($product->price, 2) }}</p>
                    </article>
                @empty
                    <p class="col-span-full py-12 text-center text-luxe-muted">You have not listed any products.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
