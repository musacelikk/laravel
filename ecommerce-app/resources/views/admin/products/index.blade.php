@extends('layouts.admin')

@section('title', 'Products')
@section('page_title', 'Products')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Products</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Product</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ $product->image }}" alt="" class="img-size-32"></td>
                                <td>
                                    {{ $product->title }}
                                    @if ($product->is_new)<span class="badge badge-danger ml-1">NEW</span>@endif
                                    @if ($product->is_deal)<span class="badge badge-warning ml-1">SALE</span>@endif
                                </td>
                                <td><span class="badge badge-info">{{ $product->category->title }}</span></td>
                                <td>
                                    ${{ number_format($product->price, 2) }}
                                    @if ($product->compare_price)
                                        <br><small class="text-muted"><s>${{ number_format($product->compare_price, 2) }}</s></small>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->quantity > 20)
                                        <span class="badge badge-success">{{ $product->quantity }}</span>
                                    @elseif ($product->quantity > 0)
                                        <span class="badge badge-warning">{{ $product->quantity }}</span>
                                    @else
                                        <span class="badge badge-danger">Out</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $product->status === 'active' ? 'success' : 'secondary' }}">{{ $product->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-xs btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-xs btn-default" title="View" target="_blank"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No products yet. <a href="{{ route('admin.products.create') }}">Add one</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <span class="text-muted">Showing {{ $products->count() }} products</span>
            </div>
        </div>
    </div>
</div>
@endsection
