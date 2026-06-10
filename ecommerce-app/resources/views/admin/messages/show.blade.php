@extends('layouts.admin')

@section('title', 'Message #'.$message->id)
@section('page_title', 'Message Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
    <li class="breadcrumb-item active">#{{ $message->id }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">From: {{ $message->name }}</h3>
        <div class="card-tools">
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></dd>
            <dt class="col-sm-3">Phone</dt><dd class="col-sm-9">{{ $message->phone ?? '—' }}</dd>
            <dt class="col-sm-3">Subject</dt><dd class="col-sm-9">{{ $message->subject ?? '—' }}</dd>
            <dt class="col-sm-3">IP</dt><dd class="col-sm-9">{{ $message->ip ?? '—' }}</dd>
            <dt class="col-sm-3">Status</dt><dd class="col-sm-9"><span class="badge badge-success">{{ $message->status }}</span></dd>
            <dt class="col-sm-3">Date</dt><dd class="col-sm-9">{{ $message->created_at?->format('d M Y H:i') }}</dd>
            <dt class="col-sm-3">Message</dt><dd class="col-sm-9"><div class="p-3 bg-light rounded">{{ $message->message }}</div></dd>
        </dl>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-default">Back to List</a>
    </div>
</div>
@endsection
