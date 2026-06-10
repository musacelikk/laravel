@extends('layouts.admin')

@section('title', 'Category List')
@section('page_title', 'Category List')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Category List</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Category Tree</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @include('admin.partials.category-tree', ['nodes' => $categoryTree])
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="mb-3">
            <a href="{{ route('admin.catalog.categories.create') }}" class="btn btn-info">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>

        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Keywords</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if ($category->parent_id)
                                        <small class="text-muted">↳ sub</small>
                                    @endif
                                    {{ $category->title }}
                                </td>
                                <td>{{ Str::limit($category->keywords, 30) ?: '—' }}</td>
                                <td>{{ Str::limit(strip_tags($category->description), 40) ?: '—' }}</td>
                                <td>
                                    @if ($category->imageUrl())
                                        <img src="{{ $category->imageUrl() }}" alt="" class="img-thumbnail" style="height:40px;width:40px;object-fit:cover;">
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $category->isActive() ? 'True' : 'False' }}</td>
                                <td>
                                    <a href="{{ route('admin.catalog.categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.catalog.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.catalog.categories.show', $category) }}" class="btn btn-success btn-sm">Show</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-4 text-muted">No categories.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($categories->hasPages())
                <div class="card-footer">{{ $categories->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
