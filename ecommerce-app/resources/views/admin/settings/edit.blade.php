@extends('layouts.admin')

@section('title', 'Settings')
@section('page_title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
@php
    $tabs = [
        'general' => 'General',
        'smtp' => 'Smtp Email',
        'social' => 'Social Media',
        'about' => 'About Us',
        'contact' => 'Contact Page',
        'references' => 'References',
    ];
@endphp

<ul class="nav nav-tabs" role="tablist">
    @foreach ($tabs as $key => $label)
        <li class="nav-item">
            <a class="nav-link {{ $tab === $key ? 'active' : '' }}" href="{{ route('admin.settings.edit', ['tab' => $key]) }}">{{ $label }}</a>
        </li>
    @endforeach
</ul>

<div class="card card-primary card-outline">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="tab" value="{{ $tab }}">
        <div class="card-body">

            @if ($tab === 'general')
                <div class="form-group"><label>Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $setting->title) }}"></div>
                <div class="form-group"><label>Keywords</label><input type="text" name="keywords" class="form-control" value="{{ old('keywords', $setting->keywords) }}"></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="2">{{ old('description', $setting->description) }}</textarea></div>
                <div class="form-group"><label>Company</label><input type="text" name="company" class="form-control" value="{{ old('company', $setting->company) }}"></div>
                <div class="form-group"><label>Address</label><textarea name="address" class="form-control" rows="2">{{ old('address', $setting->address) }}</textarea></div>
                <div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}"></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}"></div>
            @endif

            @if ($tab === 'smtp')
                <div class="form-group"><label>Smtp Server</label><input type="text" name="smtp_server" class="form-control" value="{{ old('smtp_server', $setting->smtp_server) }}"></div>
                <div class="form-group"><label>Smtp Port</label><input type="text" name="smtp_port" class="form-control" value="{{ old('smtp_port', $setting->smtp_port) }}"></div>
                <div class="form-group"><label>Smtp Email</label><input type="email" name="smtp_email" class="form-control" value="{{ old('smtp_email', $setting->smtp_email) }}"></div>
                <div class="form-group"><label>Smtp Password</label><input type="password" name="smtp_password" class="form-control" value="{{ old('smtp_password', $setting->smtp_password) }}"></div>
            @endif

            @if ($tab === 'social')
                @foreach ($socials as $i => $social)
                    <input type="hidden" name="socials[{{ $i }}][id]" value="{{ $social->id }}">
                    <div class="row border-bottom pb-3 mb-3">
                        <div class="col-md-3"><input type="text" name="socials[{{ $i }}][title]" class="form-control" value="{{ $social->title }}"></div>
                        <div class="col-md-5"><input type="url" name="socials[{{ $i }}][url]" class="form-control" value="{{ $social->url }}" placeholder="https://"></div>
                        <div class="col-md-3">
                            <select name="socials[{{ $i }}][status]" class="form-control">
                                <option value="active" {{ $social->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $social->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($tab === 'about')
                <div class="form-group"><label>About Us</label><textarea name="aboutus" id="aboutus" class="form-control summernote" rows="8">{{ old('aboutus', $setting->aboutus) }}</textarea></div>
            @endif

            @if ($tab === 'contact')
                <div class="form-group"><label>Contact Page Content</label><textarea name="contact" id="contact" class="form-control summernote" rows="8">{{ old('contact', $setting->contact) }}</textarea></div>
            @endif

            @if ($tab === 'references')
                <div class="form-group"><label>References</label><textarea name="references" id="references" class="form-control summernote" rows="8">{{ old('references', $setting->references) }}</textarea></div>
            @endif

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Setting</button>
        </div>
    </form>
</div>
@endsection

@if (in_array($tab, ['about', 'contact', 'references']))
    @include('admin.partials.summernote')
@endif
