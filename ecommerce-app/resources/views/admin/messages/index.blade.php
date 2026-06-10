@extends('layouts.admin')

@section('title', 'Messages')
@section('page_title', 'Contact Form Messages')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Messages</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">All Contact Messages</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="{{ $message->status === 'new' ? 'font-weight-bold' : '' }}">
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->phone ?? '—' }}</td>
                        <td>{{ Str::limit($message->message, 50) }}</td>
                        <td><span class="badge badge-{{ $message->status === 'new' ? 'info' : 'secondary' }}">{{ $message->status }}</span></td>
                        <td>{{ $message->created_at?->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-xs btn-success">Show</a>
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center py-4 text-muted">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
