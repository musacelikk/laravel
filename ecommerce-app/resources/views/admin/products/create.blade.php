@extends('layouts.admin')

@section('title', 'Add Product')
@section('page_title', 'Add Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.catalog.products.index') }}">Product List</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">New Product</h3></div>
            <form action="{{ route('admin.catalog.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">@include('admin.products._form')</div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.catalog.products.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@include('admin.partials.summernote')
