@extends('layouts.admin')

@section('title', 'Comments')
@section('page_title', 'Comments')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Comments</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">All Comments</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr><th>#</th><th>Product</th><th>User</th><th>Comment</th><th>Rate</th><th>Status</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->product?->title ?? '—' }}</td>
                        <td>{{ $comment->user?->name ?? '—' }}</td>
                        <td>{{ Str::limit($comment->comment, 60) }}</td>
                        <td><span class="badge badge-warning">{{ $comment->rate }}/5</span></td>
                        <td><span class="badge badge-{{ $comment->status === 'active' ? 'success' : 'secondary' }}">{{ $comment->status }}</span></td>
                        <td>{{ $comment->created_at?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No comments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
