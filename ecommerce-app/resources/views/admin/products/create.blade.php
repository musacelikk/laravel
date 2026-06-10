@extends('layouts.admin')

@section('title', 'Add Product')
@section('page_title', 'Add Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Product</h3>
            </div>
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('admin.products._form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
