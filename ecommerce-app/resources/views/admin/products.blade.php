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
                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Product</button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ $product->image }}" alt="" class="img-size-32"></td>
                                <td>
                                    {{ $product->name }}
                                    @if ($product->is_new)<span class="badge badge-danger ml-1">NEW</span>@endif
                                    @if ($product->is_deal)<span class="badge badge-warning ml-1">SALE</span>@endif
                                </td>
                                <td><span class="badge badge-info">{{ $product->category->name }}</span></td>
                                <td>
                                    ${{ number_format($product->price, 2) }}
                                    @if ($product->compare_price)
                                        <br><small class="text-muted"><s>${{ number_format($product->compare_price, 2) }}</s></small>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->stock > 20)
                                        <span class="badge badge-success">{{ $product->stock }}</span>
                                    @elseif ($product->stock > 0)
                                        <span class="badge badge-warning">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge badge-danger">Out</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->is_featured)
                                        <span class="badge badge-primary">Featured</span>
                                    @else
                                        <span class="badge badge-secondary">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-default" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-xs btn-default" title="Delete"><i class="fas fa-trash text-danger"></i></button>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-xs btn-default" title="View" target="_blank"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
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
