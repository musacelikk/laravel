@extends('layouts.store')

@section('title', 'Newsletter')

@section('content')
<section class="flex min-h-[60vh] flex-col items-center justify-center px-6 py-20 text-center">
    <p class="label-upper">Stay Connected</p>
    <h1 class="heading-display mt-4">The Edit</h1>
    <p class="mt-4 max-w-sm text-sm text-luxe-muted">Exclusive access to new arrivals and private sales.</p>
    <form action="{{ route('pages.newsletter.subscribe') }}" method="POST" class="mt-10 flex w-full max-w-md flex-col gap-4 sm:flex-row">
        @csrf
        <input type="email" name="email" required placeholder="Email address" class="flex-1 border-0 border-b border-luxe-ink/20 bg-transparent py-3 text-sm focus:border-luxe-ink focus:ring-0">
        <button type="submit" class="btn-gold shrink-0">Subscribe</button>
    </form>
</section>
@endsection
