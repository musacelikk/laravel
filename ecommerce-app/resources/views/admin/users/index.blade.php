@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registered Users</h3>
        <div class="card-tools">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-primary">View Roles</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr><th>#</th><th>Name</th><th>Email</th><th>Roles</th><th>Status</th><th>Registered</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }} {{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @forelse ($user->roles as $role)
                                <span class="badge badge-{{ $role->name === 'admin' ? 'danger' : 'primary' }}">{{ $role->name }}</span>
                            @empty
                                <span class="text-muted">—</span>
                            @endforelse
                        </td>
                        <td><span class="badge badge-{{ ($user->status ?? 'active') === 'active' ? 'success' : 'secondary' }}">{{ $user->status ?? 'active' }}</span></td>
                        <td>{{ $user->created_at?->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.users.roles.edit', $user) }}" class="btn btn-xs btn-outline-secondary">Roles</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
