@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Orders')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

@endsection

@section('page-script')
<script>
    var urlListOrderData = {!! "'".$urlListOrderData."'" !!};
</script>
<script src="{{asset('assets/js/approved-order-datatables.js')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Ordini</h1>

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini totali</h6>
                            <h4 class="mb-2">{{$total_orders}}</h4>
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
                            <h6 class="mb-2 fw-normal">Ordini in Euro</h6>
                            <h4 class="mb-2">€{{$total_orders_euro}}</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">100.00%</span></p>
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
                            <h6 class="mb-2 fw-normal">Ordini Cancellati</h6>
                            <h4 class="mb-2">{{$rejected_orders}}</h4>
                            <p class="mb-0"><span class="badge bg-label-danger fw-normal">{{$total_orders>0?100 * $rejected_orders / $total_orders:0}}%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti p-2 me-sm-4">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini completati</h6>
                            <h4 class="mb-2">{{$completed_orders}}</h4>
                            <p class="mb-0"><span class="badge bg-label-danger">{{$total_orders>0?100 * $completed_orders / $total_orders:0}}%</span></p>
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

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Lista ordini</h5>
        </div>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th class="js-add-search">Cliente</th>
                    <th class="js-add-search">Prodotto</th>
                    <th>quantità</th>
                    <th>data</th>
                    <th>status</th>
                    <th>payment</th>
                    <th>Azione</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
