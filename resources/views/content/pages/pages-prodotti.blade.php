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
<script src="{{asset('assets/js/app-ecommerce-product-list.js')}}"></script>
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
                            <h4 class="mb-2">5,000</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">100.00%</span></p>
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
                            <h4 class="mb-2">4,000</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">80.00%</span></p>
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
                            <h4 class="mb-2">1,000</h4>
                            <p class="mb-0"><span class="badge bg-label-danger fw-normal">20.00%</span></p>
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
    <h5 class="card-title mb-0">Filter</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 product_status"></div>
      <div class="col-md-4 product_category"></div>
      <div class="col-md-4 product_stock"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-products table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th></th>
          <th>product</th>
          <th>category</th>
          <th>stock</th>
          <th>sku</th>
          <th>price</th>
          <th>qty</th>
          <th>status</th>
          <th>actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

@endsection