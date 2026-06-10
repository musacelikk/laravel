@extends('layouts.store')

@section('title', 'My Profile')

@section('content')
<section class="mx-auto max-w-[1400px] px-6 py-12">
    @include('store.partials.account-breadcrumb', ['title' => 'User Panel'])

    <div class="mt-8 flex flex-col gap-12 lg:flex-row">
        @include('store.partials.account-sidebar')

        <div class="min-w-0 flex-1">
            <h1 class="heading-section border-b-2 border-luxe-gold pb-4">User Profile</h1>

            @if (session('success'))
                <div class="mt-6 border border-luxe-gold/30 bg-luxe-sand px-4 py-3 text-sm">{{ session('success') }}</div>
            @endif

            <div class="mt-10 border border-luxe-ink/10 p-6 md:p-8">
                <h2 class="font-display text-xl">Profile Information</h2>
                <p class="mt-2 text-sm text-luxe-muted">Update your account's profile information and email address.</p>

                <form action="{{ route('account.profile.update') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="label-upper">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="input-field mt-2">
                        @error('name', 'updateProfileInformation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="label-upper">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="input-field mt-2">
                        @error('email', 'updateProfileInformation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-gold">Save</button>
                </form>
            </div>

            <div class="mt-8 border border-luxe-ink/10 p-6 md:p-8">
                <h2 class="font-display text-xl">Update Password</h2>
                <p class="mt-2 text-sm text-luxe-muted">Ensure your account is using a long, random password to stay secure.</p>

                <form action="{{ route('account.password.update') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="label-upper">Current Password</label>
                        <input type="password" name="current_password" id="current_password" required class="input-field mt-2">
                        @error('current_password', 'updatePassword')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="label-upper">New Password</label>
                        <input type="password" name="password" id="password" required class="input-field mt-2">
                        @error('password', 'updatePassword')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="label-upper">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="input-field mt-2">
                    </div>

                    <button type="submit" class="btn-gold">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
