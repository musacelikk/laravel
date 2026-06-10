@extends('layouts.admin')

@section('title', 'Product List')
@section('page_title', 'Product List')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Product List</li>
@endsection

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.catalog.products.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Add Product</a>
</div>

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Show</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->imageUrl())
                                <img src="{{ $product->imageUrl() }}" class="img-thumbnail" style="height:40px;width:40px;object-fit:cover;">
                            @endif
                        </td>
                        <td>{{ $product->title }}</td>
                        <td><span class="badge badge-info">{{ $product->category->title }}</span></td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->status === 'active' ? 'True' : 'False' }}</td>
                        <td><a href="{{ route('admin.catalog.products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.catalog.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        <td><a href="{{ route('admin.catalog.products.show', $product) }}" class="btn btn-success btn-sm">Show</a></td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center py-4">No products.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($products->hasPages())
        <div class="card-footer">{{ $products->links() }}</div>
    @endif
</div>
@endsection
