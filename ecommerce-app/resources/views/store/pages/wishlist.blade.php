@extends('layouts.store')

@section('title', 'Wishlist')

@section('content')
<section class="mx-auto max-w-[900px] px-6 py-16 text-center">
    <h1 class="heading-section">My Wishlist</h1>
    <p class="mt-4 text-sm text-luxe-muted">Your saved favourites will appear here.</p>
    <a href="{{ route('shop.index') }}" class="btn-gold mt-8 inline-flex">Browse Collection</a>
</section>
@endsection
