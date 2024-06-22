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
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
@endsection

@section('page-script')
<script>
@if($total_orders>0)
    var completed_orders = {!! "'".number_format($completed_orders*100/$total_orders, 2)."'" !!};
@else
    var completed_orders = {!! "'0.00'" !!};
@endif
</script>
<script src="{{asset('assets/js/forms-pickers.js?version=1')}}"></script>
<script src="{{asset('assets/js/dashboards-analytics.js?version=1')}}"></script>

<script>
$(document).ready(function(){
let cardColor, headingColor, labelColor, shadeColor, grayColor, borderColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    shadeColor = 'dark';
    grayColor = '#5E6692'; // gray color is for stacked bar chart
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    shadeColor = '';
    grayColor = '#817D8D';
    borderColor = config.colors.borderColor;
  }
@foreach($top_selling_products as $count => $_top_selling_products)
@php
    $price_history = App\Models\ProductPriceHistory::where(["product_id" => $_top_selling_products->product_id])->orderBy("date", "DESC")->take(10)->get();
    $price_string = "";
    $sep = "";
    for($start = count($price_history); $start < 10; $start++){
        $price_string .= $sep . "0";
        $sep = ", ";
    }
    foreach($price_history as $_price_history){
        $price_string .= $sep . $_price_history->price;
        $sep = ", ";
    }
@endphp
const budgetChartEl{{$count}} = document.querySelector('.budgetChart-{{$count}}'),
    budgetChartOptions{{$count}} = {
      chart: {
        height: 100,
        toolbar: { show: false },
        zoom: { enabled: false },
        type: 'line'
      },
      series: [
        {
          name: 'Last Month',
          data: []
        },
        {
          name: 'This Month',
          data: [{{$price_string}}]
        }
      ],
      stroke: {
        curve: 'smooth',
        dashArray: [5, 0],
        width: [1, 2]
      },
      legend: {
        show: false
      },
      colors: [borderColor, config.colors.primary],
      grid: {
        show: false,
        borderColor: borderColor,
        padding: {
          top: -30,
          bottom: -15,
          left: 25
        }
      },
      markers: {
        size: 0
      },
      xaxis: {
        labels: {
          show: false
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        show: false
      },
      tooltip: {
        enabled: false
      }
    };
  if (typeof budgetChartEl{{$count}} !== undefined && budgetChartEl{{$count}} !== null) {
    const budgetChart{{$count}} = new ApexCharts(budgetChartEl{{$count}}, budgetChartOptions{{$count}});
    budgetChart{{$count}}.render();
  }
@endforeach
});
</script>

<script>
    $(document).ready(function(){
        $('#bs-rangepicker-range').data('daterangepicker').setStartDate('{{date('dd-mm-YYYY', strtotime($order_start_date))}}');
        $('#bs-rangepicker-range').data('daterangepicker').setEndDate('{{date('dd-mm-YYYY', strtotime($order_end_date))}}');

        $('#bs-rangepicker-range-revenue').data('daterangepicker').setStartDate('{{date('dd-mm-YYYY', strtotime($revenue_start_date))}}');
        $('#bs-rangepicker-range-revenue').data('daterangepicker').setEndDate('{{date('dd-mm-YYYY', strtotime($revenue_end_date))}}');

        $('#bs-rangepicker-range-product').data('daterangepicker').setStartDate('{{date('dd-mm-YYYY', strtotime($product_start_date))}}');
        $('#bs-rangepicker-range-product').data('daterangepicker').setEndDate('{{date('dd-mm-YYYY', strtotime($product_end_date))}}');

        $('#bs-rangepicker-range-vendor').data('daterangepicker').setStartDate('{{date('dd-mm-YYYY', strtotime($vendor_start_date))}}');
        $('#bs-rangepicker-range-vendor').data('daterangepicker').setEndDate('{{date('dd-mm-YYYY', strtotime($vendor_end_date))}}');
    });
</script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">
    @if($isAdmin)
    Admin dashboard
    @endif
    @if($isBuyer)
    Area riservata
    @endif
    @if($isSeller)
    Area personale
    @endif
</h4>

<form method="GET" id="dashboard-form">
<div class="row align-items-start g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom align-items-center">
                <div class="card-title mb-0">
                    <h5 class="mb-0 text-black col">Ordini</h5>
                </div>
                <div>
                    <input type="text" id="bs-rangepicker-range" name="orders_range" class="form-control form-control-sm" />
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                            <h1 class="mb-0 text-black">{{formatAmountForItaly($total_orders)}}</h1>
                            <p class="mb-0 fw-light">Ordini totali</p>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                <div class="badge rounded bg-label-primary p-1 badge--primary"><i class="ti ti-ticket ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Completati</h6>
                                    <small class="text-muted">{{formatAmountForItaly($completed_orders)}}</small>
                                </div>
                            </li>
                            <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-info p-1"><i class="ti ti-circle-check ti-sm"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">In corso</h6>
                                    <small class="text-muted">{{formatAmountForItaly($pending_orders)}}</small>
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
            <div class="card-header d-flex justify-content-between border-bottom align-items-center">
                <div class="card-title mb-0 row">
                    <h5 class="mb-0 text-black col">Fatturato</h5>
                </div>
                <div>
                    <input type="text" id="bs-rangepicker-range-revenue" name="revenue_range" class="form-control form-control-sm" />
                </div>
            </div>
            <div class="card-body pt-4">
                <h4 class="card-title mb-1">€{{formatAmountForItaly($approved_orders_paid_amount + $approved_orders_unpaid_amount)}}</h4>
                <div class="d-flex justify-content-between">
                    <small class="d-block mb-1 text-muted">Spesa totale</small>
                </div>
                <div class="row pt-4">
                    <div class="col-4">
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                            <p class="mb-0">Importo pagato</p>
                        </div>
                        <h5 class="mb-0 pt-1 text-nowrap">{{formatAmountForItaly($approved_orders_paid_amount_per, false, '', 2)}}%</h5>
                        <small class="text-muted">€{{formatAmountForItaly($approved_orders_paid_amount)}}</small>
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
                        <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{formatAmountForItaly($approved_orders_unpaid_amount_per, false, '', 2)}}%</h5>
                        <small class="text-muted">€{{formatAmountForItaly($approved_orders_unpaid_amount)}}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: {{$approved_orders_paid_amount_per}}%" role="progressbar" aria-valuenow="{{$approved_orders_paid_amount_per}}" aria-valuemin="0"
                            aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$approved_orders_unpaid_amount_per}}%" aria-valuenow="{{$approved_orders_unpaid_amount_per}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($isBuyer)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom align-items-center">
                <div class="card-title mb-0 row">
                    <h5 class="mb-0 text-black col">Acquisti</h5>
                </div>
                <div>
                    <input type="text" id="bs-rangepicker-range-revenue" name="revenue_range" class="form-control form-control-sm" />
                </div>
            </div>
            <div class="card-body pt-4">
                <h4 class="card-title mb-1">€{{formatAmountForItaly($approved_orders_paid_amount + $approved_orders_unpaid_amount)}}</h4>
                <div class="d-flex justify-content-between">
                    <small class="d-block mb-1 text-muted">Spesa totale</small>
                </div>
                <div class="row pt-4">
                    <div class="col-4">
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                            <p class="mb-0">Importo pagato</p>
                        </div>
                        <h5 class="mb-0 pt-1 text-nowrap">{{formatAmountForItaly($approved_orders_paid_amount_per, false, '', 2)}}%</h5>
                        <small class="text-muted">€{{formatAmountForItaly($approved_orders_paid_amount)}}</small>
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
                        <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{formatAmountForItaly($approved_orders_unpaid_amount_per, false, '', 2)}}%</h5>
                        <small class="text-muted">€{{formatAmountForItaly($approved_orders_unpaid_amount)}}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <div class="progress w-100" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: {{$approved_orders_paid_amount_per}}%" role="progressbar" aria-valuenow="{{$approved_orders_paid_amount_per}}" aria-valuemin="0"
                            aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$approved_orders_unpaid_amount_per}}%" aria-valuenow="{{$approved_orders_unpaid_amount_per}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom align-items-center">
                <div class="card-title mb-0 row">
                    <h5 class="mb-0 text-black col">Prodotti più
                    @if($isBuyer)
                    acquistati
                    @else
                    venduti
                    @endif 
                    </h5>
                </div>
                <div>
                    <input type="text" id="bs-rangepicker-range-product" name="product_range" class="form-control form-control-sm" />
                </div>
            </div>
            <div class="card-body pt-4">
                @foreach($top_selling_products as $count => $_top_selling_products)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">{{$_top_selling_products->product_name}}</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="budgetChart-{{$count}}"></div>
                            </div>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">€{{formatAmountForItaly($_top_selling_products->total_sales)}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_orders>0)
                                    {{formatAmountForItaly($_top_selling_products->total_orders*100/$total_orders, false, '', 2)}}%
                                @else
                                    0,00%
                                @endif
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
                @if(count($top_selling_products) == 0)
                    <li class="d-flex align-items-center mb-4">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">No data found</h6>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </div>
        </div>
    </div>

    @if($isAdmin)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between border-bottom align-items-center">
                <div class="card-title mb-0 row">
                    <h5 class="mb-0 text-black col">Accounts</h5>
                </div>
                <div class="col-md-8 col-12 text-right">
                    <input type="text" id="bs-rangepicker-range-vendor" name="vendor_range" class="form-control form-control-sm" />
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
                                <p class="ms-3 text-success mb-0">
                                @if($total_accounts>0)
                                    {{formatAmountForItaly($count*100/$total_accounts)}}
                                @else
                                    0,00
                                @endif
                                %</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                @if(count($account_counts)==0)
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Cliente
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">0</p>
                                <p class="ms-3 text-success mb-0">0,00%</p>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Venditore
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">0</p>
                                <p class="ms-3 text-success mb-0">0,00%</p>
                            </div>
                        </div>
                    </li>
                @endif
                    <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0">
                                Agenzia
                            </h6>
                            <div class="d-flex">
                                <p class="mb-0 fw-medium">{{$private_distributers}}</p>
                                <p class="ms-3 text-success mb-0">
                                @if($total_accounts>0)
                                    {{formatAmountForItaly($private_distributers*100/$total_accounts)}}
                                @else
                                    0,00
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
                                    {{formatAmountForItaly($accept_vendor_conf_count * 100 / $total_vendor_conf_count, false, '', 2)}}
                                @else
                                    0,00
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
                                    {{formatAmountForItaly($pending_vendor_conf_count * 100 / $total_vendor_conf_count, false, '', 2)}}
                                @else
                                    0,00
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
                <div class="card-title mb-0 row">
                    <h5 class="mb-0 text-black col">Clienti</h5>
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
                                    {{formatAmountForItaly($accept_vendor_conf_count * 100 / $total_vendor_conf_count, false, '', 2)}}
                                @else
                                    0,00
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
                                    {{formatAmountForItaly($pending_vendor_conf_count * 100 / $total_vendor_conf_count, false, '', 2)}}
                                @else
                                    0,00
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
</form>

@endsection