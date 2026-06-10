@extends('layouts.store')

@section('title', 'My Orders')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'My Orders'])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <h1 class="heading-section border-b-2 border-luxe-gold pb-4">My Orders</h1>
            <p class="mt-3 text-sm text-luxe-muted">View your order history and approval status.</p>

            <div class="mt-8 overflow-x-auto border border-luxe-ink/10">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="border-b border-luxe-ink/10 bg-luxe-sand/50 text-xs uppercase tracking-widest text-luxe-muted">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Items</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-luxe-ink/10">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="px-4 py-4 font-medium">#{{ $order->id }}</td>
                                <td class="px-4 py-4 text-luxe-muted">{{ $order->created_at?->format('d M Y') }}</td>
                                <td class="px-4 py-4">{{ $order->order_products_count }}</td>
                                <td class="px-4 py-4">${{ number_format($order->total, 2) }}</td>
                                <td class="px-4 py-4">
                                    @include('store.partials.order-status', ['order' => $order])
                                </td>
                                <td class="px-4 py-4">
                                    <a href="{{ route('account.orders.show', $order) }}" class="text-xs font-semibold uppercase tracking-wider text-luxe-gold hover:text-luxe-ink">Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-luxe-muted">
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
</section>
@endsection
