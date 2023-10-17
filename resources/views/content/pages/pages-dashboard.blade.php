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
@if($total_orders>0)
    var completed_orders = {!! "'".($completed_orders*100/$total_orders)."'" !!};
@else
    var completed_orders = {!! "'0.00'" !!};
@endif
</script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">
    @if($isAdmin)
    Admin
    @endif
    @if($isBuyer)
    Buyer
    @endif
    @if($isSeller)
    Seller
    @endif
    dashboard
</h4>

<div class="row align-items-start g-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <div class="row">
                        <h5 class="mb-0 text-black col">Ordini</h5>
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                            <h1 class="mb-0 text-black">{{$total_orders}}</h1>
                            <p class="mb-0 fw-light">Ordini totali</p>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                <div class="badge rounded bg-label-primary p-1 badge--primary"><i class="ti ti-ticket ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Completati</h6>
                                    <small class="text-muted">{{$completed_orders}}</small>
                                </div>
                            </li>
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-info p-1"><i class="ti ti-circle-check ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">In corso</h6>
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

    @if($isAdmin || $isSeller)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Fatturato</h5>
                    <small class="fw-light"></small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                @foreach($most_order_from_city as $_most_order_from_city)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">€{{number_format($_most_order_from_city->total_sales, 2)}} ({{$_most_order_from_city->total_orders}})</h6>
                                </div>
                                <small class="text-muted fw-light">{{$_most_order_from_city->billing_region}}</small>
                            </div>
                            <div class="user-progress">
                                <p class="text-success fw-semibold mb-0">
                                    {{number_format($_most_order_from_city->total_orders*100/$total_orders, 2)}}%
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if($isBuyer)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Acquisti</h5>
                    <small class="fw-light"></small>
                </div>
            </div>
            <div class="card-body pt-4">
                <h4 class="card-title mb-1">€{{number_format($approved_orders_amount, 2)}}</h4>
                <div class="d-flex justify-content-between">
                    <small class="d-block mb-1 text-muted">Spesa totale</small>
                </div>
                <div class="row pt-4">
                    <div class="col-4">
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                            <p class="mb-0">Importo pagato</p>
                        </div>
                        <h5 class="mb-0 pt-1 text-nowrap">{{number_format($approved_orders_paid_amount_per, 2)}}%</h5>
                        <small class="text-muted">€{{number_format($approved_orders_paid_amount, 2)}}</small>
                    </div>
                    <div class="col-4">
                        <div class="divider divider-vertical">
                            <div class="divider-text">
                                <span class="badge-divider-bg bg-label-secondary">VS</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                            <p class="mb-0">Importo non pagato</p>
                            <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
                        </div>
                        <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{number_format($approved_orders_unpaid_amount_per, 2)}}%</h5>
                        <small class="text-muted">€{{number_format($approved_orders_unpaid_amount, 2)}}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: {{$approved_orders_paid_amount}}%" role="progressbar" aria-valuenow="{{$approved_orders_paid_amount}}" aria-valuemin="0"
                            aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$approved_orders_unpaid_amount}}%" aria-valuenow="{{$approved_orders_unpaid_amount}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Prodotti più
                    @if($isBuyer)
                    acquistati
                    @else
                    venduti
                    @endif 
                    </h5>
                    <small class="fw-light"></small>
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
                                <p class="mb-0 fw-medium">€{{number_format($_top_selling_products->total_sales, 2)}}</p>
                                <p class="ms-3 text-success mb-0">
                                    {{number_format($_top_selling_products->total_orders*100/$total_orders, 2)}}%
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>
        </div>
    </div>

    @if($isAdmin)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Accounts</h5>
                    <small class="fw-light"></small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                @foreach($account_counts as $account_count)
                    @php
                        $count = 0;
                        if($account_count->accountType == "1"){
                            $accTypeName = "Cliente";
                            $count = $account_count->accounts;
                        }elseif($account_count->accountType == "2"){
                            $accTypeName = "Venditore";
                            $count = $account_count->accounts - $private_distributers;
                        }
                    @endphp
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                {{$accTypeName}}
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$count}}</p>
                                <p class="ms-3 text-success mb-0">{{number_format($count*100/$total_accounts, 2)}}%</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Agenzia
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$private_distributers}}</p>
                                <p class="ms-3 text-success mb-0">{{number_format($private_distributers*100/$total_accounts, 2)}}%</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if($isBuyer)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Venditori in collaborazione</h5>
                    <small class="fw-light"></small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Venditori in collaborazione
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$accept_vendor_conf_count}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_vendor_conf_count>0)
                                    {{number_format($accept_vendor_conf_count * 100 / $total_vendor_conf_count, 2)}}
                                @else
                                    0.00
                                @endif
                                %</p>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                In attesa di verifica
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$pending_vendor_conf_count}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_vendor_conf_count>0)
                                    {{number_format($pending_vendor_conf_count * 100 / $total_vendor_conf_count, 2)}}
                                @else
                                    0.00
                                @endif
                                %</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if($isSeller)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black">Clienti</h5>
                    <small class="fw-light"></small>
                </div>
            </div>
            <div class="card-body pt-4">
                <ul class="p-0 m-0">
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Clienti approvatli
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$accept_vendor_conf_count}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_vendor_conf_count>0)
                                    {{number_format($accept_vendor_conf_count * 100 / $total_vendor_conf_count, 2)}}
                                @else
                                    0.00
                                @endif
                                %</p>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Clienti in attesa
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$pending_vendor_conf_count}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_vendor_conf_count>0)
                                    {{number_format($pending_vendor_conf_count * 100 / $total_vendor_conf_count, 2)}}
                                @else
                                    0.00
                                @endif
                                %</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection