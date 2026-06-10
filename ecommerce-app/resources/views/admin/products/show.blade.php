@extends('layouts.admin')

@section('title', $product->title)
@section('page_title', 'Product Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.catalog.products.index') }}">Product List</a></li>
    <li class="breadcrumb-item active">{{ $product->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Main Image</h3></div>
            <div class="card-body text-center">
                @if ($product->imageUrl())
                    <img src="{{ $product->imageUrl() }}" class="img-fluid rounded" alt="{{ $product->title }}">
                @endif
            </div>
        </div>

        @if ($product->images->isNotEmpty())
            <div class="card">
                <div class="card-header"><h3 class="card-title">Image Gallery</h3></div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($product->images as $galleryImage)
                            <div class="col-4 mb-2">
                                <img src="{{ $galleryImage->imageUrl() }}" class="img-thumbnail w-100" style="height:80px;object-fit:cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $product->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.catalog.products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-default btn-sm" target="_blank">View Store</a>
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">
                        <a href="{{ route('admin.catalog.categories.show', $product->category) }}">{{ $product->category->title }}</a>
                    </dd>
                    <dt class="col-sm-3">Price</dt>
                    <dd class="col-sm-9">${{ number_format($product->price, 2) }}</dd>
                    <dt class="col-sm-3">Quantity</dt>
                    <dd class="col-sm-9">{{ $product->quantity }}</dd>
                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">{{ $product->status === 'active' ? 'True' : 'False' }}</dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{!! $product->description !!}</dd>
                    <dt class="col-sm-3">Detail</dt>
                    <dd class="col-sm-9">{!! $product->detail !!}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
