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
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css')}}" />
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
                    <span class="thanks__item-bold">Order number:</span>  ON545645161
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Seller:</span>  Italia Trasporti
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Product name:</span>  Ethylene
                </div>
                <div class="thanks__item">
                    <span class="thanks__item-bold">Order QTY:</span>  2 LITTERS
                </div>
            </div>
            <div class="thanks__action">
                <a href="#" class="uk-button uk-button-primary thanks__action-btn">Vai alla Dashboard</a>
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
<script src="{{asset('assets/front/js/custom.js')}}"></script>

@endsection
<!-- Scripts Ends -->