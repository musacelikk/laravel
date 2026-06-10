@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard v3')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v3</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Products</span>
                <span class="info-box-number">{{ $productCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Categories</span>
                <span class="info-box-number">{{ $categoryCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">6</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-star"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Featured</span>
                <span class="info-box-number">{{ $featuredCount }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Online Store Visitors</h3>
                    <a href="#" class="btn btn-sm btn-tool">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">820</span>
                        <span class="text-muted">Visitors Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success"><i class="fas fa-arrow-up"></i> 12.5%</span>
                        <span class="text-muted">Since last week</span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2"><i class="fas fa-square text-primary"></i> This Week</span>
                    <span><i class="fas fa-square text-gray"></i> Last Week</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sales</h3>
                    <a href="#" class="btn btn-sm btn-tool">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span class="text-muted">Sales Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success"><i class="fas fa-arrow-up"></i> 33.1%</span>
                        <span class="text-muted">Since last month</span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2"><i class="fas fa-square text-primary"></i> This year</span>
                    <span><i class="fas fa-square text-gray"></i> Last year</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ $product->imageUrl() }}" alt="" class="img-size-50 mr-2 rounded">
                                        {{ $product->name }}
                                        @if ($product->is_new)
                                            <span class="badge badge-danger">NEW</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        @if ($product->stock > 20)
                                            <span class="text-success"><i class="fas fa-arrow-up"></i> {{ $product->stock }}</span>
                                        @else
                                            <span class="text-warning">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->is_featured)
                                            <span class="badge badge-success">Featured</span>
                                        @else
                                            <span class="badge badge-secondary">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-default" target="_blank"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="{{ route('admin.catalog.products.index') }}" class="btn btn-sm btn-info float-right">View All Products</a>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Online Store Overview</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 12%</span>
                            <h5 class="description-header">{{ $totalStock }}</h5>
                            <span class="description-text">TOTAL STOCK</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0.8%</span>
                            <h5 class="description-header">$18,230</h5>
                            <span class="description-text">TOTAL SALES</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 1%</span>
                            <h5 class="description-header">{{ $categoryCount }}</h5>
                            <span class="description-text">CATEGORIES</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">{{ $productCount }}</h5>
                            <span class="description-text">PRODUCTS</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-4 text-center border-right">
                        <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-sync"></i></span>
                            <h5 class="description-header">12%</h5>
                            <span class="description-text">CONVERSION RATE</span>
                        </div>
                    </div>
                    <div class="col-4 text-center border-right">
                        <div class="description-block">
                            <span class="description-percentage text-warning"><i class="fas fa-shopping-cart"></i></span>
                            <h5 class="description-header">0.8%</h5>
                            <span class="description-text">SALES RATE</span>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-users"></i></span>
                            <h5 class="description-header">1%</h5>
                            <span class="description-text">REGISTRATION RATE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    const visitorsCtx = document.getElementById('visitors-chart').getContext('2d');
    new Chart(visitorsCtx, {
        type: 'line',
        data: {
            labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
            datasets: [
                {
                    label: 'This Week',
                    data: [65, 78, 90, 81, 95, 105, 120],
                    borderColor: '#007bff',
                    backgroundColor: 'transparent',
                    tension: 0.3
                },
                {
                    label: 'Last Week',
                    data: [45, 55, 60, 58, 62, 70, 75],
                    borderColor: '#ced4da',
                    backgroundColor: 'transparent',
                    tension: 0.3
                }
            ]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
    });

    const salesCtx = document.getElementById('sales-chart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'This year',
                    data: [1200, 1900, 1500, 2200, 2800, 3100, 3500],
                    backgroundColor: '#007bff'
                },
                {
                    label: 'Last year',
                    data: [800, 1200, 1000, 1500, 1800, 2000, 2400],
                    backgroundColor: '#ced4da'
                }
            ]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
    });
</script>
@endpush
