@extends('layouts.admin')

@section('title', 'Social')
@section('page_title', 'Social')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Social</li>
@endsection

@section('content')
<div class="row">
    @forelse ($socials as $social)
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-body text-center">
                    <ion-icon name="{{ str_contains($social->image, 'facebook') ? 'logo-facebook' : (str_contains($social->image, 'instagram') ? 'logo-instagram' : 'logo-twitter') }}" style="font-size: 2.5rem; color: #3c8dbc;"></ion-icon>
                    <h4 class="mt-3">{{ $social->title }}</h4>
                    <p class="text-muted small">{{ $social->url }}</p>
                    <span class="badge badge-{{ $social->status === 'active' ? 'success' : 'secondary' }}">{{ $social->status }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">No social links. Run <code>php artisan db:seed --class=AdminDataSeeder</code></div></div>
    @endforelse
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">Social Links Table</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead><tr><th>#</th><th>Title</th><th>URL</th><th>Status</th></tr></thead>
            <tbody>
                @foreach ($socials as $social)
                    <tr>
                        <td>{{ $social->id }}</td>
                        <td>{{ $social->title }}</td>
                        <td><a href="{{ $social->url }}" target="_blank">{{ $social->url }}</a></td>
                        <td><span class="badge badge-success">{{ $social->status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
