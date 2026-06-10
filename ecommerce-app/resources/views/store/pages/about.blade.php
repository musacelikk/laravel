@extends('layouts.store')

@section('title', 'About Us')

@section('content')
<div class="mx-auto max-w-4xl px-4 py-14 lg:px-8">
    <h1 class="section-title">About <span>E-SHOP</span></h1>
    <p class="mt-6 text-lg leading-relaxed text-zinc-500">
        We curate premium fashion, accessories, and electronics for people who value quality over quantity.
        Every product is handpicked with care.
    </p>
    <div class="mt-12 grid gap-5 sm:grid-cols-3">
        @foreach ([['title' => 'Quality', 'desc' => 'Handpicked from trusted brands', 'icon' => '✦'], ['title' => 'Fast Delivery', 'desc' => 'Free shipping over $50', 'icon' => '◈'], ['title' => 'Support', 'desc' => 'Always here to help', 'icon' => '◎']] as $item)
            <div class="card p-6 text-center">
                <span class="text-2xl text-primary-500">{{ $item['icon'] }}</span>
                <h3 class="mt-3 font-bold text-zinc-900">{{ $item['title'] }}</h3>
                <p class="mt-2 text-sm text-zinc-400">{{ $item['desc'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
