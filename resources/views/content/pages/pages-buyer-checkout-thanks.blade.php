@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Buyer Home')


<!-- CSS Starts -->
@section('head-style') 

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/wf-icon/style.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css?ver=1')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="thanks">
        <div class="uk-container thanks__container">
            <div class="thanks__icon">
                <img src="/assets/front/images/thanks.svg" width="340" height="196">
            </div>
            <h2 class="thanks__text">Grazie!</h2>
            <h3 class="thanks__title">Ordine inviato con successo!</h3>
            <div class="thanks__data">
                <div class="thanks__item">
                    <span class="thanks__item-bold">Numero d'ordine:</span>  ORD{{$order->id}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Lo stato dell'ordine:</span>  {{$order->order_status}}
                </div>
                @if($order->payment_status == "paid")
                <div class="thanks__item">
                    <span class="thanks__item-bold">Stato del pagamento:</span>  Pagato
                </div>
                @endif
                <div class="thanks__item">
                    <span class="thanks__item-bold">Venditrice:</span>  {{$order->seller_name}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Prodotto:</span>  {{$order->product_name}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Qtyst:</span>  {{$order->product_qty}} LITRI
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Pagamento totale:</span>  €{{number_format($order->total_payable_amount, 2)}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Modalità di pagamento:</span>  {{$order->payment_method_name}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Prima consegna:</span>  {{$order->est_delivery_date}}
                </div>
            </div>
            <div class="thanks__data mt-4">
                <div class="w-100">
                    <span class="thanks__item-bold">Indirizzo di fatturazione</span>
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Ragione sociale:</span>  {{$order->billing_first_name}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Indirizzo:</span>  {{$order->billing_address}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Numero civico:</span>  {{$order->billing_house_no}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Regione:</span>  {{$order->billing_region}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Provincia:</span>  {{$order->billing_province}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Comune:</span>  {{$order->billing_common}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">CAP:</span>  {{$order->billing_pincode}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Email:</span>  {{$order->billing_email}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Contatto:</span>  {{$order->billing_contact}}
                </div>
            </div>
            <div class="thanks__data mt-4">
                <div class="w-100">
                    <span class="thanks__item-bold">Indirizzo di spedizione</span>
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Ragione sociale:</span>  {{$order->selling_first_name}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Indirizzo:</span>  {{$order->selling_address}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Numero civico:</span>  {{$order->selling_house_no}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Regione:</span>  {{$order->selling_region}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Provincia:</span>  {{$order->selling_province}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Comune:</span>  {{$order->selling_common}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">CAP:</span>  {{$order->selling_pincode}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Email:</span>  {{$order->selling_email}}
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Contatto:</span>  {{$order->selling_contact}}
                </div>
            </div>
            <div class="thanks__action">
                <a href="{{route("dashboard")}}" class="uk-button uk-button-primary thanks__action-btn">Vai alla Dashboard</a>
            </div>
        </div>
    </div>

</main>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js?version=1')}}"></script>

@endsection
<!-- Scripts Ends -->