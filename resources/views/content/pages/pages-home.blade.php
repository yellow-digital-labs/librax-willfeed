@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Home')
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection
@section('content')
<div class="row">
    <!-- <div class="col-lg-8 mb-4 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Summary</h5>
                <small class="text-muted">Updated 1 month ago</small>
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">
                    <div class="col-md-4 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                            <div class="card-info">
                                <h5 class="mb-0">230k</h5>
                                <small>Customers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="ti ti-users ti-sm"></i></div>
                            <div class="card-info">
                                <h5 class="mb-0">8.549k</h5>
                                <small>Sellers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="ti ti-shopping-cart ti-sm"></i></div>
                            <div class="card-info">
                                <h5 class="mb-0">1.423k</h5>
                                <small>Brokers</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-4 col-6 mb-4">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 class="mb-0 me-2">86k</h3>
                    <small>Total Customers</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded-pill p-2">
                        <i class="ti ti-cpu ti-md"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6 mb-4">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 class="mb-0 me-2">67</h3>
                    <small>Sellers</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded-pill p-2">
                        <i class="ti ti-cpu ti-md"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6 mb-4">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 class="mb-0 me-2">34</h3>
                    <small>Brokers</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded-pill p-2">
                        <i class="ti ti-cpu ti-md"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection