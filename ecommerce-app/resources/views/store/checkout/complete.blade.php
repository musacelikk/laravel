@extends('layouts.store')

@section('title', 'Order Complete')

@section('content')
<section class="mx-auto max-w-[900px] px-6 py-16 text-center">
    <p class="label-upper text-luxe-gold">Thank You</p>
    <h1 class="heading-section mt-3">Order Complete</h1>
    <p class="mx-auto mt-4 max-w-lg text-sm leading-relaxed text-luxe-muted">
        Your order <strong>#{{ $order->id }}</strong> has been received and is waiting for approval.
    </p>

    <div class="mx-auto mt-8 max-w-md border border-luxe-ink/10 p-6 text-left">
        <div class="flex items-center justify-between">
            <span class="text-sm text-luxe-muted">Status</span>
            @include('store.partials.order-status', ['order' => $order])
        </div>
        <div class="mt-4 flex justify-between text-sm">
            <span class="text-luxe-muted">Total</span>
            <span class="font-semibold">${{ number_format($order->total, 2) }}</span>
        </div>
        <div class="mt-2 flex justify-between text-sm">
            <span class="text-luxe-muted">Date</span>
            <span>{{ $order->created_at?->format('d M Y H:i') }}</span>
        </div>
    </div>

    <div class="mt-10 flex flex-wrap justify-center gap-4">
        <a href="{{ route('account.orders.show', $order) }}" class="btn-gold">View Order</a>
        <a href="{{ route('account.orders') }}" class="btn-outline">My Orders</a>
        <a href="{{ route('shop.index') }}" class="btn-outline">Continue Shopping</a>
    </div>
</section>
@endsection
