@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Orders')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/rateyo/rateyo.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<style>
/* Whatsapp Style */
#whatsapp-button {
    position: fixed;
    bottom: 4%;
    right: 2%;
    background-color: #25D366;
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index:20;
}

#whatsapp-button > img {
    width: 60px;
    height: 60px;
}
</style>
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
<script>
    var isShowRating = false;
    @if($isBuyer && $order->payment_status == "paid")
        isShowRating = true;
        @if($order->is_review_popup_displaied == "1")
            isShowRating = false;
        @endif
    @endif
    @if($isSeller && $order->payment_status == "paid")
        isShowRating = true;
        @if($order->is_review_popup_displaied_seller == "1")
            isShowRating = false;
        @endif
    @endif
</script>
<script src="{{asset('assets/js/order-detail.js?version=1')}}"></script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Dettaglio ordine</h1>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
        <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">Ordine #{{$id}} 
            <span class="badge bg-label-{{$order->order_status_id == '3'?'danger':($order->order_status_id == '1'?'warning':'success')}} fw-normal">{{$order->order_status=='pending'?'In corso':$order->order_status}}</span>
        @if($order->payment_status == "paid")
            <span class="badge bg-label-{{$order->payment_status == 'unpaid'?'danger':'success'}} fw-normal">{{Str::ucfirst("Pagato")}}</span>
        @endif
        </h5>
        <p class="text-body">{{\App\Helpers\Helpers::getMonthName(date('m', strtotime($order->order_date)))}}{{date(' d, Y, H:i', strtotime($order->order_date))}} (ET)</p>
    </div>
    @if($isSeller)
    <div class="d-flex align-content-center flex-wrap gap-3">
    @if ($order->order_status_id == '1')
        <button data-href="{{route('order-status', ['id' => $id, 'status' => '3'])}}" class="btn btn-outline-dark waves-effect js-update-order-status" data-bs-toggle="modal" data-bs-target="#sellerNoteModal">Reject order</button>
    @endif
    @if ($order->order_status_id == '1')
        <button data-href="{{route('order-status', ['id' => $id, 'status' => '2'])}}" class="btn btn-primary delete-order waves-effect js-update-order-status" data-bs-toggle="modal" data-bs-target="#sellerNoteModal">Accept order </button>
    @endif
    @if ($order->order_status_id == '2')
        <a href="{{route('order-status', ['id' => $id, 'status' => '4'])}}" class="btn btn-primary delete-order waves-effect">Order deliver </a>
    @endif
    @if ($order->order_status_id == '4' && $order->payment_status != "paid")
        <a href="{{route("add-order-payment", [
            "id" => $id
        ])}}" class="btn btn-primary waves-effect">Segna come pagato</a>
    @endif
    </div>
    @endif
    @if ($order->payment_status == "paid")
        @if(($isSeller && $rating) || $isBuyer)
        <div class="d-flex justify-content-end flex-wrap gap-3">
            @if($rating)
            <label style="width: 100%; text-align: right;">Review by buyer</label>
            <div class="display-ratings mb-3" style="text-align: right;" data-rateyo-read-only="true" readonly="readonly" data-rating="{{$rating->star}}"></div>
            @elseif ($isBuyer)
            <button data-bs-toggle="modal" data-bs-target="#basicModal" data-seller="{{$order->seller_id}}" class="btn btn-primary waves-effect product-rating">Revisione dell'ordine</button>
            @endif
        </div>
        @endif
        @if(($isBuyer && $forBuyerRating) || $isSeller)
        <div class="d-flex justify-content-end flex-wrap gap-3">
            @if($forBuyerRating)
            <label style="width: 100%; text-align: right;">Review by seller</label>
            <div class="display-ratings mb-3" style="text-align: right;" data-rateyo-read-only="true" readonly="readonly" data-rating="{{$forBuyerRating->star}}"></div>
            @elseif ($isSeller)
            <button data-bs-toggle="modal" data-bs-target="#basicModal" data-seller="{{$order->user_id}}" class="btn btn-primary waves-effect product-rating">Revisione dell'ordine</button>
            @endif
        </div>
        @endif
    @endif
</div>

<div class="row">
    
    <div class="col-12 col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0 text-black">Dettaglio ordine</h5>
                <h6 class="m-0">
                    Prima consegna: {{$order->est_delivery_date}}
                </h6>
            </div>
            <div class="card-datatable table-responsive">
                <table class="table border-top">
                    <thead>
                        <tr>
                            <th class="w-50" style="width: 296px;">Prodotti</th>
                            <th class="w-25" style="width: 124px;">Prezzo</th>
                            <th class="w-25" style="width: 115px;">Quantità</th>
                            <th style="width: 53px;">Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center text-nowrap">
                                    <div class="avatar-wrapper">
                                        {{-- <div class="avatar me-2"><img src="../../assets/img/products/oneplus.png" alt="product-Wooden Chair" class="rounded-2"></div> --}}
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="text-body mb-0">{{$order->product_name}}</h6><small class="text-muted">{{$order->seller_name}}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span>€{{formatAmountForItaly($order->product_amount)}}</span></td>
                            <td><span class="text-body">{{formatAmountForItaly($order->product_qty)}} Litri</span></td>
                            <td>
                                <h6 class="mb-0">€{{formatAmountForItaly($order->product_amount * $order->product_qty)}}</h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex m-3 mb-2 p-1">
                    <div class="m-0 col">
                        <strong>Order note:</strong>
                        {{ $order->order_note?$order->order_note:"NA" }}
                    </div>
                    <div class="order-calculations justify-content-end">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Subtotale:</span>
                            <h6 class="mb-0">€{{formatAmountForItaly($order->product_amount * $order->product_qty)}}</h6>
                        </div>
                        <!-- <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">Discount:</span>
                            <h6 class="mb-0">$22</h6>
                        </div> -->
                        <div class="d-flex justify-content-between mb-2">
                            <span class="w-px-100 text-heading">IVA:</span>
                            <h6 class="mb-0">€{{formatAmountForItaly($order->total_payable_amount - ($order->product_amount * $order->product_qty))}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="w-px-100 mb-0">Totale:</h6>
                            <h6 class="mb-0">€{{formatAmountForItaly(($order->total_payable_amount))}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title m-0 text-black"><i class="ti ti-list-details me-2"></i> Monitoraggio ordine</h5>
            </div>
            <div class="card-body pt-4">
                <ul class="timeline pb-0 mb-0">
                    @if($rating)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Order rating by buyer ({{$rating->star}} star)</h6>
                                <span class="text-muted">{{\App\Helpers\Helpers::getMonthName(date('m', strtotime($rating->created_at)))}}{{date(' d, Y, H:i', strtotime($rating->created_at))}}</span>
                            </div>
                            <p class="mt-2">{{$rating->review_text}}</p>
                        </div>
                    </li>
                    @endif
                    @if($forBuyerRating)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Order rating by seller ({{$forBuyerRating->star}})</h6>
                                <span class="text-muted">{{\App\Helpers\Helpers::getMonthName(date('m', strtotime($forBuyerRating->created_at)))}}{{date(' d, Y, H:i', strtotime($forBuyerRating->created_at))}}</span>
                            </div>
                            <p class="mt-2">{{$forBuyerRating->review_text}}</p>
                        </div>
                    </li>
                    @endif
                    @foreach($order_activity as $num => $_order_activity)
                    <li class="timeline-item timeline-item-transparent ">
                        <span class="timeline-point timeline-point-{{strpos(strtolower($_order_activity->status_title), 'approve') !== false ? "success" : "danger"}}"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">{{$_order_activity->status_title}}</h6>
                                <span class="text-muted">{{\App\Helpers\Helpers::getMonthName(date('m', strtotime($_order_activity->status_updated_at)))}}{{date(' d, Y, H:i', strtotime($_order_activity->status_updated_at))}}</span>
                            </div>
                            <p class="mt-2">{{$_order_activity->status_description}}</p>
                        </div>
                    </li>
                    @endforeach
                    <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                        <span class="timeline-point timeline-point-warning"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Ordine inviato (Ordine ID: #{{$id}})</h6>
                                <span class="text-muted">{{\App\Helpers\Helpers::getMonthName(date('m', strtotime($order->order_date)))}}{{date(' d, Y, H:i', strtotime($order->order_date))}}</span>
                            </div>
                            <p class="mt-2">Ordine inviato correttamente</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title m-0 text-black"><i class="ti ti-list-details me-2"></i> Pagamenti</h5>
            </div>
            <div class="card-body pt-4">
                <ul class="timeline pb-0 mb-0">
                @if($payment_history)
                    @foreach($payment_history as $_payment_history)
                        <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">€{{$_payment_history->payment_amount}} received</h6>
                                    <span class="text-muted">{{date('F d, Y, H:i', strtotime($_payment_history->created_at))}}</span>
                                </div>
                                {{-- <p class="mt-2 mb-0">Payment done via {{$_payment_history->payment_type_name}}</p>
                                <p class="mt-0 mb-0">{{$_payment_history->description}}</p> --}}
                            </div>
                        </li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        @if($isSeller || $isAdmin)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between border-bottom">
                <h5 class="card-title m-0 text-black">Cliente</h5>
                <h6 class="m-0">Credit available: {{ App\Helpers\Helpers::getAvailableCreditLimit($order->seller_id, $order->user_id) }}</h6>
            </div>
            <div class="card-body pt-4">
                <div class="d-flex justify-content-start align-items-center mb-4">
                    <div class="avatar me-2">
                        <img src="{{ \App\Models\User::where(["id" => $order->user_id])->first()->profile_photo_url }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="d-flex flex-column">
                        <a href="{{route("profile-view", [
                            "id" => $order->user_id
                        ])}}" class="text-body text-nowrap">
                            <h6 class="mb-0 text-black">{{$order->user_name}}</h6>
                        </a>
                        <small class="text-muted">Cliente ID: #{{$order->user_id}}</small></div>
                </div>
                <div class="d-flex justify-content-start align-items-center mb-4">
                    <span class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i class="ti ti-shopping-cart ti-sm"></i></span>
                    <h6 class="text-body text-nowrap mb-0 text-black">{{$customer_total_orders}} Ordini</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class=" text-black">Informazioni di contatto</h6>
                    {{-- <h6><a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editUser">Edit</a></h6> --}}
                </div>
                <p class=" mb-1">Email: {{$order->billing_email}}</p>
                <p class=" mb-0">Mobile: +39 {{$order->billing_contact}}</p>
            </div>
        </div>
        @endif
        @if(!$isSeller || $isAdmin)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between border-bottom">
                <h5 class="card-title m-0 text-black">Venditore</h5>
                <h6 class="m-0">Credit available: {{ App\Helpers\Helpers::getAvailableCreditLimit($order->seller_id, $order->user_id) }}</h6>
            </div>
            <div class="card-body pt-4">
                <div class="d-flex justify-content-start align-items-center mb-4">
                    <div class="avatar me-2">
                        <img src="{{ \App\Models\User::where(["id" => $order->seller_id])->first()->profile_photo_url }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="d-flex flex-column">
                        <a href="{{route("profile-view", [
                            "id" => $order->seller_id
                        ])}}" class="text-body text-nowrap">
                            <h6 class="mb-0 text-black">{{$order->seller_name}}</h6>
                        </a>
                        <small class="text-muted">Seller ID: #{{$order->seller_id}}</small></div>
                </div>
            </div>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between border-bottom">
                <h5 class="card-title m-0 text-black">Indirizzo di consegna</h5>
                {{-- <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a></h6> --}}
            </div>
            <div class="card-body pt-4">
                <p class="mb-0">{{$order->selling_first_name}} <br>{{$order->selling_address}}, {{$order->selling_house_no}} <br>{{$order->selling_region}}, {{$order->selling_province}} <br>{{$order->selling_common}}, {{$order->selling_pincode}}<br>{{$order->selling_email}}<br>{{$order->selling_contact}}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between border-bottom">
                <h5 class="card-title m-0 text-black">Indirizzo di fatturazione</h5>
                {{-- <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a></h6> --}}
            </div>
            <div class="card-body pt-4">
                <p class="mb-0">{{$order->billing_first_name}} <br>{{$order->billing_address}}, {{$order->billing_house_no}} <br>{{$order->billing_region}}, {{$order->billing_province}} <br>{{$order->billing_common}}, {{$order->billing_pincode}}<br>{{$order->billing_email}}<br>{{$order->billing_contact}}</p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between border-bottom">
                <h5 class="card-title m-0 text-black">Pagamento</h5>
                <h6 class="m-0">{{$order->payment_method_name}}</h6>
            </div>
            <div class="card-body pt-4">
                <p class="d-flex justify-content-between">Dilazione di pagamento <span class="fw-semibold">{{$order->payment_option}}</span></p>
                <p class="d-flex justify-content-between">Pagamento totale <span class="fw-semibold">€{{formatAmountForItaly($order->total_payable_amount)}}</span></p>
                <p class="d-flex justify-content-between">Pagamento fino ad ora <span class="fw-semibold text-success">€{{formatAmountForItaly($order->total_paid_amount)}}</span></p>
                <p class="d-flex justify-content-between">In attesa di Pagamento <span class="fw-semibold text-danger">€{{formatAmountForItaly($order->total_pending_amount)}}</span></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">Add New Address</h3>
                    <p class="text-muted address-subtitle">Add new address for express delivery</p>
                </div>
                <form id="addNewAddressForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-icon checked">
                                    <label class="form-check-label custom-option-content" for="customRadioHome">
                                        <span class="custom-option-body">
                                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M24.25 33.75V23.75H16.75V33.75H6.75002V18.0469C6.7491 17.8733 6.78481 17.7015 6.85482 17.5426C6.92482 17.3838 7.02754 17.2415 7.15627 17.125L19.6563 5.76562C19.8841 5.5559 20.1825 5.43948 20.4922 5.43948C20.8019 5.43948 21.1003 5.5559 21.3281 5.76562L33.8438 17.125C33.9696 17.2438 34.0703 17.3866 34.1401 17.5449C34.2098 17.7032 34.2472 17.8739 34.25 18.0469V33.75H24.25Z" fill="currentColor" opacity="0.2"></path>
                                                <path d="M33.25 33.75C33.25 34.3023 33.6977 34.75 34.25 34.75C34.8023 34.75 35.25 34.3023 35.25 33.75H33.25ZM34.25 18.0469H35.25C35.25 18.0415 35.25 18.0361 35.2499 18.0307L34.25 18.0469ZM33.8437 17.125L34.5304 16.398C34.5256 16.3934 34.5207 16.389 34.5158 16.3845L33.8437 17.125ZM21.3281 5.76562L20.6509 6.50143L20.656 6.50611L21.3281 5.76562ZM19.6562 5.76562L20.3288 6.5057L20.3335 6.50141L19.6562 5.76562ZM7.15625 17.125L7.82712 17.8666L7.82878 17.8651L7.15625 17.125ZM6.75 18.0469H7.75001L7.74999 18.0416L6.75 18.0469ZM5.75 33.75C5.75 34.3023 6.19772 34.75 6.75 34.75C7.30228 34.75 7.75 34.3023 7.75 33.75H5.75ZM3 32.75C2.44772 32.75 2 33.1977 2 33.75C2 34.3023 2.44772 34.75 3 34.75V32.75ZM38 34.75C38.5523 34.75 39 34.3023 39 33.75C39 33.1977 38.5523 32.75 38 32.75V34.75ZM23.25 33.75C23.25 34.3023 23.6977 34.75 24.25 34.75C24.8023 34.75 25.25 34.3023 25.25 33.75H23.25ZM15.75 33.75C15.75 34.3023 16.1977 34.75 16.75 34.75C17.3023 34.75 17.75 34.3023 17.75 33.75H15.75ZM35.25 33.75V18.0469H33.25V33.75H35.25ZM35.2499 18.0307C35.2449 17.7243 35.1787 17.422 35.0551 17.1416L33.225 17.9481C33.2409 17.9844 33.2495 18.0235 33.2501 18.0631L35.2499 18.0307ZM35.0551 17.1416C34.9316 16.8612 34.7531 16.6084 34.5304 16.398L33.1571 17.852C33.1859 17.8792 33.209 17.9119 33.225 17.9481L35.0551 17.1416ZM34.5158 16.3845L22.0002 5.02514L20.656 6.50611L33.1717 17.8655L34.5158 16.3845ZM22.0053 5.02984C21.5929 4.6502 21.0528 4.43948 20.4922 4.43948V6.43948C20.551 6.43948 20.6076 6.46159 20.6509 6.50141L22.0053 5.02984ZM20.4922 4.43948C19.9316 4.43948 19.3915 4.6502 18.979 5.02984L20.3335 6.50141C20.3767 6.46159 20.4334 6.43948 20.4922 6.43948V4.43948ZM18.9837 5.02556L6.48371 16.3849L7.82878 17.8651L20.3288 6.50569L18.9837 5.02556ZM6.48538 16.3834C6.25236 16.5942 6.06642 16.8518 5.93971 17.1393L7.76988 17.9459C7.78318 17.9157 7.80268 17.8887 7.82712 17.8666L6.48538 16.3834ZM5.93971 17.1393C5.813 17.4269 5.74836 17.7379 5.75001 18.0521L7.74999 18.0416C7.74981 18.0087 7.75659 17.976 7.76988 17.9459L5.93971 17.1393ZM5.75 18.0469V33.75H7.75V18.0469H5.75ZM3 34.75H38V32.75H3V34.75ZM25.25 33.75V25H23.25V33.75H25.25ZM25.25 25C25.25 24.4033 25.013 23.831 24.591 23.409L23.1768 24.8232C23.2237 24.8701 23.25 24.9337 23.25 25H25.25ZM24.591 23.409C24.169 22.987 23.5967 22.75 23 22.75V24.75C23.0663 24.75 23.1299 24.7763 23.1768 24.8232L24.591 23.409ZM23 22.75H18V24.75H23V22.75ZM18 22.75C17.4033 22.75 16.831 22.9871 16.409 23.409L17.8232 24.8232C17.8701 24.7763 17.9337 24.75 18 24.75V22.75ZM16.409 23.409C15.9871 23.831 15.75 24.4033 15.75 25H17.75C17.75 24.9337 17.7763 24.8701 17.8232 24.8232L16.409 23.409ZM15.75 25V33.75H17.75V25H15.75Z" fill="currentColor"></path>
                                            </svg>
                                            <span class="custom-option-title">Home</span>
                                            <small> Delivery time (9am – 9pm) </small>
                                        </span>
                                        <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioHome" checked="" data-ol-has-click-handler="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="customRadioOffice">
                                        <span class="custom-option-body">
                                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.75 33.75V6.25C22.75 5.91848 22.6183 5.60054 22.3839 5.36612C22.1495 5.1317 21.8315 5 21.5 5H6.5C6.16848 5 5.85054 5.1317 5.61612 5.36612C5.3817 5.60054 5.25 5.91848 5.25 6.25V33.75" fill="currentColor" fill-opacity="0.2"></path>
                                                <path d="M2.75 32.75C2.19772 32.75 1.75 33.1977 1.75 33.75C1.75 34.3023 2.19772 34.75 2.75 34.75V32.75ZM37.75 34.75C38.3023 34.75 38.75 34.3023 38.75 33.75C38.75 33.1977 38.3023 32.75 37.75 32.75V34.75ZM21.75 33.75C21.75 34.3023 22.1977 34.75 22.75 34.75C23.3023 34.75 23.75 34.3023 23.75 33.75H21.75ZM21.5 5V4V5ZM5.25 6.25H4.25H5.25ZM4.25 33.75C4.25 34.3023 4.69772 34.75 5.25 34.75C5.80228 34.75 6.25 34.3023 6.25 33.75H4.25ZM34.25 33.75C34.25 34.3023 34.6977 34.75 35.25 34.75C35.8023 34.75 36.25 34.3023 36.25 33.75H34.25ZM22.75 14C22.1977 14 21.75 14.4477 21.75 15C21.75 15.5523 22.1977 16 22.75 16V14ZM10.25 10.25C9.69772 10.25 9.25 10.6977 9.25 11.25C9.25 11.8023 9.69772 12.25 10.25 12.25V10.25ZM15.25 12.25C15.8023 12.25 16.25 11.8023 16.25 11.25C16.25 10.6977 15.8023 10.25 15.25 10.25V12.25ZM12.75 20.25C12.1977 20.25 11.75 20.6977 11.75 21.25C11.75 21.8023 12.1977 22.25 12.75 22.25V20.25ZM17.75 22.25C18.3023 22.25 18.75 21.8023 18.75 21.25C18.75 20.6977 18.3023 20.25 17.75 20.25V22.25ZM10.25 26.5C9.69772 26.5 9.25 26.9477 9.25 27.5C9.25 28.0523 9.69772 28.5 10.25 28.5V26.5ZM15.25 28.5C15.8023 28.5 16.25 28.0523 16.25 27.5C16.25 26.9477 15.8023 26.5 15.25 26.5V28.5ZM27.75 26.5C27.1977 26.5 26.75 26.9477 26.75 27.5C26.75 28.0523 27.1977 28.5 27.75 28.5V26.5ZM30.25 28.5C30.8023 28.5 31.25 28.0523 31.25 27.5C31.25 26.9477 30.8023 26.5 30.25 26.5V28.5ZM27.75 20.25C27.1977 20.25 26.75 20.6977 26.75 21.25C26.75 21.8023 27.1977 22.25 27.75 22.25V20.25ZM30.25 22.25C30.8023 22.25 31.25 21.8023 31.25 21.25C31.25 20.6977 30.8023 20.25 30.25 20.25V22.25ZM2.75 34.75H37.75V32.75H2.75V34.75ZM23.75 33.75V6.25H21.75V33.75H23.75ZM23.75 6.25C23.75 5.65326 23.5129 5.08097 23.091 4.65901L21.6768 6.07322C21.7237 6.12011 21.75 6.18369 21.75 6.25H23.75ZM23.091 4.65901C22.669 4.23705 22.0967 4 21.5 4V6C21.5663 6 21.6299 6.02634 21.6768 6.07322L23.091 4.65901ZM21.5 4H6.5V6H21.5V4ZM6.5 4C5.90326 4 5.33097 4.23705 4.90901 4.65901L6.32322 6.07322C6.37011 6.02634 6.4337 6 6.5 6V4ZM4.90901 4.65901C4.48705 5.08097 4.25 5.65326 4.25 6.25H6.25C6.25 6.1837 6.27634 6.12011 6.32322 6.07322L4.90901 4.65901ZM4.25 6.25V33.75H6.25V6.25H4.25ZM36.25 33.75V16.25H34.25V33.75H36.25ZM36.25 16.25C36.25 15.6533 36.013 15.081 35.591 14.659L34.1768 16.0732C34.2237 16.1201 34.25 16.1837 34.25 16.25H36.25ZM35.591 14.659C35.169 14.2371 34.5967 14 34 14V16C34.0663 16 34.1299 16.0263 34.1768 16.0732L35.591 14.659ZM34 14H22.75V16H34V14ZM10.25 12.25H15.25V10.25H10.25V12.25ZM12.75 22.25H17.75V20.25H12.75V22.25ZM10.25 28.5H15.25V26.5H10.25V28.5ZM27.75 28.5H30.25V26.5H27.75V28.5ZM27.75 22.25H30.25V20.25H27.75V22.25Z" fill="currentColor"></path>
                                            </svg>
                                            <span class="custom-option-title"> Office </span>
                                            <small> Delivery time (9am – 5pm) </small>
                                        </span>
                                        <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioOffice" data-ol-has-click-handler="">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 fv-plugins-icon-container">
                        <label class="form-label" for="modalAddressFirstName">First Name</label>
                        <input type="text" id="modalAddressFirstName" name="modalAddressFirstName" class="form-control" placeholder="John">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-6 fv-plugins-icon-container">
                        <label class="form-label" for="modalAddressLastName">Last Name</label>
                        <input type="text" id="modalAddressLastName" name="modalAddressLastName" class="form-control" placeholder="Doe">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Country</label>
                        <div class="position-relative">
                            <div class="position-relative"><select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true" data-select2-id="modalAddressCountry">
                                    <option value="" data-select2-id="80">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="79" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalAddressCountry-container"><span class="select2-selection__rendered" id="select2-modalAddressCountry-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select value</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                        <input type="text" id="modalAddressAddress1" name="modalAddressAddress1" class="form-control" placeholder="12, Business Park">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                        <input type="text" id="modalAddressAddress2" name="modalAddressAddress2" class="form-control" placeholder="Mall Road">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressLandmark">Landmark</label>
                        <input type="text" id="modalAddressLandmark" name="modalAddressLandmark" class="form-control" placeholder="Nr. Hard Rock Cafe">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressCity">City</label>
                        <input type="text" id="modalAddressCity" name="modalAddressCity" class="form-control" placeholder="Los Angeles">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressLandmark">State</label>
                        <input type="text" id="modalAddressState" name="modalAddressState" class="form-control" placeholder="California">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                        <input type="text" id="modalAddressZipCode" name="modalAddressZipCode" class="form-control" placeholder="99950">
                    </div>
                    <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Use as a billing address?</span>
                        </label>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" data-ol-has-click-handler="">Submit</button>
                        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <input type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add New Credit Card Modal -->
<div class="modal fade editPaymentModal" id="editPayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2 text-black h4 text-start">Add new payment</h3>
                </div>
                <form class="row g-3" onsubmit="return false" id="paymentForm" method="POST" action="{{route("add-order-payment", [
                    "id" => $id
                ])}}">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$id}}">
                    <div class="col-12">
                        <label class="form-label" for="payment_type_id">Payment type</label>
                        <select class="form-select" id="payment_type_id" name="payment_type_id">
                        @foreach($payment_options as $payment_option)
                            <option value="{{$payment_option->id}}">{{$payment_option->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="payment_amount">Payment amount</label>
                        <input type="number" id="payment_amount" class="form-select" name="payment_amount" lang="es-ES"/>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Payment note</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter note"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-primary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add New Credit Card Modal -->

<!--/ Add seller note Modal -->
<div class="modal fade" id="sellerNoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="seller-note-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="message" class="form-label">Message</label>
                            <input type="text" id="message" name="message" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-seller-note">Update order status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--/ Add buyer rating Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" onsubmit="return false" id="rating-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Star rating</label>
                            <div class="onChange-event-ratings mb-3"></div>
                            <div class="counter-wrapper">
                                <strong>Ratings:</strong>
                                <span class="counter"></span>
                                <input type="hidden" name="rating" id="js-rating-val">
                                @if($isBuyer)
                                <input type="hidden" name="rating_for" id="rating_for" value="{{$order->seller_id}}">
                                @endif
                                @if($isSeller)
                                <input type="hidden" name="rating_for" id="rating_for" value="{{$order->user_id}}">
                                @endif
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="message" class="form-label">Message</label>
                            <input type="text" id="message" name="message" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-rating">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<a href="https://wa.me/3492442269?text=Ciao, ho bisogno di aiuto per l'ordine"  id="whatsapp-button" target="_blank">
    <img src="{{url('/assets/img/icons/whatsapp-icon.png')}}" alt="">
</a>

@endsection
