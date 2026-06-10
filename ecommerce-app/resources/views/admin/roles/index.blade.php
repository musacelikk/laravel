@extends('layouts.admin')

@section('title', 'Roles')
@section('page_title', 'User Roles')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Roles (Many to Many)</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr><th>#</th><th>Name</th><th>Users</th></tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>
                            <span class="badge badge-{{ $role->name === 'admin' ? 'danger' : 'primary' }}">{{ $role->name }}</span>
                        </td>
                        <td>{{ $role->users_count }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">No roles found. Run <code>php artisan db:seed --class=RoleSeeder</code></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
