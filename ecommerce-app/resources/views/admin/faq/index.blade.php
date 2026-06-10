@extends('layouts.admin')

@section('title', 'FAQ')
@section('page_title', 'FAQ')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">FAQ</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Frequently Asked Questions</h3></div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped">
            <thead>
                <tr><th>#</th><th>Question</th><th>Answer</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->id }}</td>
                        <td><strong>{{ $faq->question }}</strong></td>
                        <td>{{ Str::limit($faq->answer, 80) }}</td>
                        <td><span class="badge badge-{{ $faq->status === 'active' ? 'success' : 'secondary' }}">{{ $faq->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No FAQ entries. Run <code>php artisan db:seed --class=AdminDataSeeder</code></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
