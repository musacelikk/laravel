@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>
</div>

<div class="row">
    @foreach ($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <img class="img-fluid rounded" src="{{ $category->coverImage() }}" alt="{{ $category->title }}" style="height: 140px; width: 100%; object-fit: cover;">
                    </div>
                    <h3 class="profile-username text-center">{{ $category->title }}</h3>
                    <p class="text-muted text-center">{{ $category->tagline() }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Products</b> <span class="float-right badge badge-primary">{{ $category->products_count }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Slug</b> <span class="float-right text-muted">{{ $category->slug }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b>
                            <span class="float-right badge badge-{{ $category->status === 'active' ? 'success' : 'secondary' }}">{{ $category->status }}</span>
                        </li>
                    </ul>
                    <div class="btn-group btn-group-sm d-flex">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary w-50"><i class="fas fa-edit"></i> Edit</a>
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
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Keywords</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>{{ $category->keywords ?? '—' }}</td>
                                <td><span class="badge badge-info">{{ $category->products_count }}</span></td>
                                <td><span class="badge badge-{{ $category->status === 'active' ? 'success' : 'secondary' }}">{{ $category->status }}</span></td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No categories yet. <a href="{{ route('admin.categories.create') }}">Add one</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
