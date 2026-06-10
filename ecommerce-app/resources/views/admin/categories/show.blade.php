@extends('layouts.admin')

@section('title', $category->title)
@section('page_title', 'Category Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.catalog.categories.index') }}">Category List</a></li>
    <li class="breadcrumb-item active">{{ $category->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                @if ($category->imageUrl())
                    <img src="{{ $category->imageUrl() }}" class="img-fluid rounded mb-3" alt="{{ $category->title }}">
                @endif
                <h3>{{ $category->title }}</h3>
                <p class="text-muted">{{ $category->slug }}</p>
                <span class="badge badge-{{ $category->isActive() ? 'success' : 'secondary' }}">{{ $category->isActive() ? 'True' : 'False' }}</span>
            </div>
        </div>

        @if ($category->children->isNotEmpty())
            <div class="card">
                <div class="card-header"><h3 class="card-title">Sub Categories</h3></div>
                <ul class="list-group list-group-flush">
                    @foreach ($category->children as $child)
                        <li class="list-group-item">
                            <a href="{{ route('admin.catalog.categories.show', $child) }}">{{ $child->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category Info</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.catalog.categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Parent</dt>
                    <dd class="col-sm-9">{{ $category->parent?->title ?? 'Top Level' }}</dd>
                    <dt class="col-sm-3">Keywords</dt>
                    <dd class="col-sm-9">{{ $category->keywords ?? '—' }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{!! $category->description !!}</dd>
                    <dt class="col-sm-3">Products</dt>
                    <dd class="col-sm-9">{{ $category->products->count() }} items</dd>
                </dl>
            </div>
        </div>

        @if ($category->products->isNotEmpty())
            <div class="card">
                <div class="card-header"><h3 class="card-title">Products (One-to-Many)</h3></div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm">
                        <thead><tr><th>Id</th><th>Title</th><th>Price</th><th>Qty</th></tr></thead>
                        <tbody>
                            @foreach ($category->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><a href="{{ route('admin.catalog.products.show', $product) }}">{{ $product->title }}</a></td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
