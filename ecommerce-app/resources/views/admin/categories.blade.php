@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="row">
    @foreach ($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <img class="img-fluid rounded" src="{{ $category->coverImage() }}" alt="{{ $category->name }}" style="height: 140px; width: 100%; object-fit: cover;">
                    </div>
                    <h3 class="profile-username text-center">{{ $category->name }}</h3>
                    <p class="text-muted text-center">{{ $category->tagline() }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Products</b> <span class="float-right badge badge-primary">{{ $category->products_count }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Slug</b> <span class="float-right text-muted">{{ $category->slug }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <span class="float-right badge badge-success">{{ $category->status }}</span>
                        </li>
                    </ul>
                    <div class="btn-group btn-group-sm d-flex">
                        <button class="btn btn-primary w-50"><i class="fas fa-edit"></i> Edit</button>
                        <a href="{{ route('shop.category', $category) }}" class="btn btn-default w-50" target="_blank"><i class="fas fa-eye"></i> View</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories Table</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Category</button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td><span class="badge badge-info">{{ $category->products_count }}</span></td>
                                <td><span class="badge badge-success">{{ $category->status }}</span></td>
                                <td>
                                    <button class="btn btn-xs btn-default"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-xs btn-default"><i class="fas fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
