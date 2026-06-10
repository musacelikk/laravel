@extends('layouts.store')

@section('title', 'About')

@section('content')
<section class="grid lg:grid-cols-2">
    <div class="bg-luxe-sand px-6 py-20 lg:px-16">
        <p class="label-upper">Our Story</p>
        <h1 class="heading-display mt-6">Crafted with<br>Intention</h1>
    </div>
    <div class="flex flex-col justify-center px-6 py-20 lg:px-16">
        <p class="text-sm leading-relaxed text-luxe-muted">
            E-SHOP was founded on a simple belief: fewer, better things. We partner with artisans and responsible makers to bring you pieces that last beyond seasons.
        </p>
        <div class="mt-12 grid grid-cols-3 gap-6 border-t border-luxe-ink/10 pt-12">
            @foreach ([['n' => '50+', 'l' => 'Brands'], ['n' => '10k', 'l' => 'Customers'], ['n' => '30', 'l' => 'Day Returns']] as $stat)
                <div>
                    <p class="font-display text-3xl text-luxe-gold">{{ $stat['n'] }}</p>
                    <p class="mt-1 text-xs uppercase tracking-widest text-luxe-muted">{{ $stat['l'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
