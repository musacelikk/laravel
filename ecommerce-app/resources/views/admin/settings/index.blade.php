@extends('layouts.admin')

@section('title', 'Settings')
@section('page_title', 'Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
@if ($setting)
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Site Settings</h3></div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Title</dt>
                        <dd class="col-sm-9">{{ $setting->title }}</dd>

                        <dt class="col-sm-3">Company</dt>
                        <dd class="col-sm-9">{{ $setting->company }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $setting->email }}</dd>

                        <dt class="col-sm-3">Phone</dt>
                        <dd class="col-sm-9">{{ $setting->phone }}</dd>

                        <dt class="col-sm-3">Address</dt>
                        <dd class="col-sm-9">{{ $setting->address }}</dd>

                        <dt class="col-sm-3">Keywords</dt>
                        <dd class="col-sm-9">{{ $setting->keywords }}</dd>

                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9">{{ $setting->description }}</dd>

                        <dt class="col-sm-3">About Us</dt>
                        <dd class="col-sm-9">{{ $setting->aboutus }}</dd>

                        <dt class="col-sm-3">Contact</dt>
                        <dd class="col-sm-9">{{ $setting->contact }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9"><span class="badge badge-success">{{ $setting->status }}</span></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">No settings found. Run <code>php artisan db:seed --class=AdminDataSeeder</code></div>
@endif
@endsection
