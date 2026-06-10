@extends('layouts.store')

@section('title', 'My Orders')

@section('content')
<section class="section-shell py-12 md:py-16">
    @include('store.partials.account-breadcrumb', ['title' => 'My Orders'])

    <div class="mt-8 flex flex-col gap-10 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <div class="account-shell">
                <div class="border-b border-luxe-ink/10 pb-5">
                    <h1 class="heading-section">My Orders</h1>
                    <p class="mt-2 text-sm text-luxe-muted">Track your order history and approval status.</p>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table-luxe">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="hover:bg-luxe-sand/30">
                                    <td class="font-medium">#{{ $order->id }}</td>
                                    <td class="text-luxe-muted">{{ $order->created_at?->format('d M Y') }}</td>
                                    <td>{{ $order->order_products_count }}</td>
                                    <td class="font-semibold">${{ number_format($order->total, 2) }}</td>
                                    <td>@include('store.partials.order-status', ['order' => $order])</td>
                                    <td>
                                        <a href="{{ route('account.orders.show', $order) }}" class="text-xs font-semibold uppercase tracking-wider text-luxe-gold hover:text-luxe-ink">Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="!py-16 text-center text-luxe-muted">
                                        No orders yet.
                                        <a href="{{ route('shop.index') }}" class="mt-2 block text-luxe-gold hover:text-luxe-ink">Start Shopping</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
