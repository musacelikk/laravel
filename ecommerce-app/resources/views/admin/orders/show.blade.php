@extends('layouts.admin')

@section('title', 'Order #'.$order->id)
@section('page_title', 'Order #'.$order->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">#{{ $order->id }}</li>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Order Info</h3></div>
            <div class="card-body">
                <p><strong>Status:</strong> <span class="badge badge-{{ $order->adminBadgeClass() }}">{{ $order->statusLabel() }}</span></p>
                <p><strong>Date:</strong> {{ $order->created_at?->format('d M Y H:i') }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                @if ($order->isPending())
                    <div class="mt-4 d-flex gap-2">
                        <form action="{{ route('admin.orders.accept', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>
                        <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Reject this order and restore stock?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Customer</h3></div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->customerName() }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong><br>{{ $order->address }}</p>
                @if ($order->note)
                    <p><strong>Note:</strong><br>{{ $order->note }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Order Items</h3></div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderProducts as $line)
                            <tr>
                                <td>{{ $line->product?->title ?? 'Product #'.$line->product_id }}</td>
                                <td>${{ number_format($line->price, 2) }}</td>
                                <td>{{ $line->amount }}</td>
                                <td>${{ number_format($line->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Grand Total</th>
                            <th>${{ number_format($order->total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
