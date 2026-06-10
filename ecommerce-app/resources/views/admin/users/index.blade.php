@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Registered Users</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th><th>Type</th><th>Status</th><th>Registered</th></tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }} {{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge badge-primary">{{ $user->type ?? 'user' }}</span></td>
                        <td><span class="badge badge-{{ ($user->status ?? 'active') === 'active' ? 'success' : 'secondary' }}">{{ $user->status ?? 'active' }}</span></td>
                        <td>{{ $user->created_at?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
