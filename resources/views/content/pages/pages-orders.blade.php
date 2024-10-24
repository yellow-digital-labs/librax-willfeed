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
@if($isAdmin)
<script src="{{asset('assets/js/approved-order-datatables-admin.js?version=1')}}"></script>
@elseif($isBuyer)
<script src="{{asset('assets/js/approved-order-datatables-buyer.js?version=1')}}"></script>
@else
<script src="{{asset('assets/js/approved-order-datatables.js?version=1')}}"></script>
@endif
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
            <div class="row gy-1">
                <div class="col-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-0 card-widget-heading">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini totali</h6>
                            <h4 class="mb-2">{{formatAmountForItaly($total_orders)}}</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">100,00%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti me-sm-4 no-hover">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                    <hr class="d-block d-lg-none me-4">
                </div>
                <div class="col-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-0 card-widget-heading">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini in euro</h6>
                            <h4 class="mb-2">€{{formatAmountForItaly($total_orders_euro)}}</h4>
                            <p class="mb-0"><span class="badge bg-label-success fw-normal">100,00%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti me-sm-4 no-hover">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                    <hr class="d-block d-lg-none">
                </div>
                <div class="col-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end pb-0 card-widget-3 card-widget-heading">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini cancellati</h6>
                            <h4 class="mb-2">{{$rejected_orders}}</h4>
                            <p class="mb-0"><span class="badge bg-label-danger fw-normal">{{formatAmountForItaly($total_orders>0?100 * $rejected_orders / $total_orders:0, false, '', 2)}}%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti p-2 me-sm-4 no-hover">
                            <span class="avatar-initial bg-label-secondary rounded"><i class="ti-sm ti ti-smart-home text-body"></i></span>
                        </span>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-heading">
                        <div>
                            <h6 class="mb-2 fw-normal">Ordini completati</h6>
                            <h4 class="mb-2">{{$completed_orders}}</h4>
                            <p class="mb-0"><span class="badge bg-label-danger fw-normal">{{formatAmountForItaly($total_orders>0?100 * $completed_orders / $total_orders:0, false, '', 2)}}%</span></p>
                        </div>
                        <span class="avatar avatar--prodotti p-2 no-hover">
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
                @if($isAdmin || $isBuyer)
                    <th class="js-add-search">Venditore/Agenzia</th>
                @endif
                @if(!$isBuyer)
                    <th class="js-add-search">Cliente</th>
                @endif
                    <th class="js-add-search">Prodotto</th>
                    <th>Quantità</th>
                    <th>Data</th>
                    <th>Stato</th>
                    <th>Pagamento</th>
                    <th>Apri</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
