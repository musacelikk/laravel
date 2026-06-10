@extends('layouts.admin')

@section('title', 'Messages')
@section('page_title', 'Messages')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Messages</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Contact Messages</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Status</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject ?? '—' }}</td>
                        <td>{{ Str::limit($message->message, 50) }}</td>
                        <td><span class="badge badge-{{ $message->status === 'new' ? 'info' : 'secondary' }}">{{ $message->status }}</span></td>
                        <td>{{ $message->created_at?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
