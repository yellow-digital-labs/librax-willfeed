@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Home')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script>
    var completed_orders = {!! "'".$completed_orders."'" !!};
</script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Dashboard</h4>

<div class="row align-items-start g-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Order tracker</h5>
                    <small class="fw-normal">Lorem ipsum</small>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                            <h1 class="mb-0 text-black">{{$total_orders}}</h1>
                            <p class="mb-0 fw-light">Total Orders</p>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                <div class="badge rounded bg-label-primary p-1 badge--primary"><i class="ti ti-ticket ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Completed orders</h6>
                                    <small class="text-muted">{{$completed_orders}}</small>
                                </div>
                            </li>
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-info p-1"><i class="ti ti-circle-check ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Pending orders</h6>
                                    <small class="text-muted">{{$pending_orders}}</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                        <div id="supportTracker"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Most orders from cities</h5>
                    <small class="fw-light">Sales Overview</small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                @foreach($most_order_from_city as $_most_order_from_city)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">€{{$_most_order_from_city->total_sales}} ({{$_most_order_from_city->total_orders}})</h6>
                                </div>
                                <small class="text-muted fw-light">{{$_most_order_from_city->billing_city}}</small>
                            </div>
                            <div class="user-progress">
                                <p class="text-success fw-semibold mb-0">
                                    {{$_most_order_from_city->total_orders*100/$total_orders}}%
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Top selling products</h5>
                    <small class="fw-light">€38.4k Total sell from top selling products</small>
                </div>
            </div>
            <div class="card-body pt-4">
                @foreach($top_selling_products as $_top_selling_products)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">{{$_top_selling_products->product_name}}</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="budgetChart"></div>
                            </div>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">€{{$_top_selling_products->total_sales}}</p>
                                <p class="ms-3 text-success mb-0">
                                    {{$_top_selling_products->total_orders*100/$total_orders}}%
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Payment method wise income</h5>
                    <small class="fw-light">€8.52k Total income</small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                @foreach($payment_method_wise_income as $_payment_method_wise_income)
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">{{$_payment_method_wise_income->payment_method_name}}</h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$_payment_method_wise_income->total_orders}}</p>
                                <p class="ms-3 text-success mb-0">{{$_payment_method_wise_income->total_orders*100/$total_orders}}%</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection