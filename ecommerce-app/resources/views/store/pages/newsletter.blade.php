@extends('layouts.store')

@section('title', 'Newsletter')

@section('content')
<div class="mx-auto max-w-lg px-4 py-20 text-center lg:px-8">
    <h1 class="section-title">Stay in the <span>Loop</span></h1>
    <p class="mt-4 text-zinc-400">Exclusive deals and new arrivals, delivered weekly.</p>
    <form action="{{ route('pages.newsletter.subscribe') }}" method="POST" class="card mt-10 p-8">
        @csrf
        <input type="email" name="email" required placeholder="your@email.com" class="w-full rounded-full border-surface-200 text-sm focus:border-primary-400 focus:ring-primary-500/20">
        <button type="submit" class="btn-primary mt-4 w-full">Subscribe</button>
    </form>
</div>
@endsection
