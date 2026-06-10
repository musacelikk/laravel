@extends('layouts.admin')

@section('title', 'Assign Roles')
@section('page_title', 'Assign Roles')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Roles for {{ $user->name }} ({{ $user->email }})</h3>
    </div>
    <form action="{{ route('admin.users.roles.update', $user) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')

        <p class="text-muted">Select one or more roles. Admin role grants access to this panel.</p>

        <div class="form-group">
            @foreach ($roles as $role)
                <div class="custom-control custom-checkbox mb-2">
                    <input
                        class="custom-control-input"
                        type="checkbox"
                        name="roles[]"
                        value="{{ $role->id }}"
                        id="role-{{ $role->id }}"
                        @checked($user->roles->contains('id', $role->id))
                    >
                    <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                </div>
            @endforeach
            @error('roles')<p class="text-danger small">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Roles</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
