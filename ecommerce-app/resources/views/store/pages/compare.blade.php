@extends('layouts.store')

@section('title', 'Compare')

@section('content')
<section class="mx-auto max-w-[900px] px-6 py-16 text-center">
    <h1 class="heading-section">Compare Products</h1>
    <p class="mt-4 text-sm text-luxe-muted">Select products to compare specifications side by side.</p>
    <a href="{{ route('shop.index') }}" class="btn-gold mt-8 inline-flex">Shop Now</a>
</section>
@endsection
