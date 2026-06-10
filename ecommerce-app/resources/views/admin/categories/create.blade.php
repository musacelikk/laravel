@extends('layouts.admin')

@section('title', 'Add Category')
@section('page_title', 'Add Category')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Category</h3>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @include('admin.categories._form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
