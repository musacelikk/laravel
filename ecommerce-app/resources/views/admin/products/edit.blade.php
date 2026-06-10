@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page_title', 'Edit Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit: {{ $product->title }}</h3>
            </div>
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('admin.products._form')
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                    <button type="button" class="btn btn-danger" onclick="if(confirm('Delete this product?')) document.getElementById('delete-form').submit();">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </form>
            <form id="delete-form" action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection
