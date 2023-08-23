@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Prodotti')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script>
    var urlCreateProductView = {!! "'".$urlCreateProductView."'" !!};
    var urlListProductData = {!! "'".$urlListProductData."'" !!};
</script>
<script src="{{asset('assets/js/seller-product-list.js')}}"></script>
@endsection

@section('content')
        
<h1 class="h3 text-black mb-4">Prodotti</h4>

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                        <div>
                            <h6 class="mb-2 fw-normal">Totale prodotti</h6>
                            <h4 class="mb-2">{{$total_products}}</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">100,00%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none me-4">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                        <div>
                            <h6 class="mb-2 fw-normal">Prodotti attivi</h6>
                            <h4 class="mb-2">{{$active_products}}</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">{{$total_products>0?number_format($active_products*100/$total_products, 2, ',', '.'):0}}%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h6 class="mb-2">Prodotti inattivi</h6>
                            <h4 class="mb-2">{{$inactive_products}}</h4>
                            <p class="mb-0"><span class="badge bg-label-danger fw-normal">{{$total_products>0?number_format($inactive_products*100/$total_products, 2, ',', '.'):0}}%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti p-2 me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2">Best seller</h6>
                            <h4 class="mb-2">Gasolio</h4>
                            <!-- <p class="mb-0"><span class="text-muted me-2">150 orders</span><span class="badge bg-label-danger">-3.5%</span></p> -->
                        </div>
                        <span class="avatar avatar--prodotti p-2">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product List Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista prodotti</h5>
    </div>
    <div class="card-datatable table-responsive">
        <table class="datatables-products table dt-column-search">
            <thead class="border-top">
                <tr>
                    <th>Prodotto</th>
                    <th>prezzo / litro</th>
                    <th>status</th>
                    <th>Azione</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection