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

    <div class="checkout">

        <div class="uk-container checkout__container">

            <div class="checkout-box">
                <div class="checkout-box__head">
                    <h2 class="checkout-box__headtitle">Product: <span class="checkout-box__headtitle-light">Ethylene</span></h2>
                    <h2 class="checkout-box__headtitle">Seller: <span class="checkout-box__headtitle-light">Italia Trasporti</span></h2>
                </div>
                <div class="checkout-box__body">
                    <div class="uk-grid checkout-box__prgrid gutter-xl" data-uk-grid>
                        <div class="uk-width-1-3 checkout-box__prcol  checkout-box__prcol--item">
                            <h3 class="checkout-box__prlabel">Item</h3>
                            <h2 class="checkout-box__itemname">Ethylene</h2>
                        </div>
                        <div class="uk-width-expand checkout-box__prcol  checkout-box__prcol--cost">
                            <h3 class="checkout-box__prlabel">Cost</h3>
                            <h2 class="checkout-box__itemcost"><span class="checkout-box__itemcost-price">€468</span>/LITERS</h2>
                        </div>
                        <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--qty">
                            <h3 class="checkout-box__prlabel">Qty</h3>
                            <div class="checkout-box__qty">
                                <input type="text" class="uk-input checkout-box__qty-input" name="" value="2">
                                <span class="checkout-box__qty-label">LITERS</span>
                            </div>
                        </div>
                        <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--price">
                            <h3 class="checkout-box__prlabel">Price</h3>
                            <h2 class="checkout-box__price">€936</h2>
                        </div>
                    </div>
                    <div class="uk-grid checkout-box__ntgrid" data-uk-grid>
                        <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                            <textarea class="uk-textarea checkout-box__textarea" rows="6" placeholder="Note"></textarea>
                        </div>
                        <div class="uk-width-2-3 checkout-box__ntcol checkout-box__ntcol--total">
                            <div class="checkout-box__total">
                                <p class="checkout-box__total-item">
                                    <span class="checkout-box__total-label">Subtotal:</span>
                                    <span class="checkout-box__total-val">€936</span>
                                </p>
                                <p class="checkout-box__total-item">
                                    <span class="checkout-box__total-label">Discount:</span>
                                    <span class="checkout-box__total-val">€00.00</span>
                                </p>
                                <p class="checkout-box__total-item">
                                    <span class="checkout-box__total-label">Tax:</span>
                                    <span class="checkout-box__total-val">€50.12</span>
                                </p>
                                <p class="checkout-box__total-item">
                                    <span class="checkout-box__total-label">Total:</span>
                                    <span class="checkout-box__total-val">€986.12</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-box">
                <div class="checkout-box__head">
                    <h2 class="checkout-box__headtitle">Billing address</h2>
                </div>
                <div class="checkout-box__body">
                    <div class="uk-grid checkout-box__frgrid" data-uk-grid>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">First Name</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">Email</label>
                            <input type="email" class="uk-input checkout-box__input" name="" placeholder="Enter here">
                        </div>
                        <div class="uk-width-1-1">
                            <label class="checkout-box__label">Address</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="Enter here">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">City</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">Contact</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-box">
                <div class="checkout-box__head">
                    <h2 class="checkout-box__headtitle">Shipping address</h2>
                </div>
                <div class="checkout-box__body">
                    <div class="uk-grid checkout-box__frgrid" data-uk-grid>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">First Name</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">Email</label>
                            <input type="email" class="uk-input checkout-box__input" name="" placeholder="Enter here">
                        </div>
                        <div class="uk-width-1-1">
                            <label class="checkout-box__label">Address</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="Enter here">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">City</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                        <div class="uk-width-1-2">
                            <label class="checkout-box__label">Contact</label>
                            <input type="text" class="uk-input checkout-box__input" name="" placeholder="John">
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout__action">
                <a href="#" class="uk-button uk-button-primary checkout__submit">Check out</a>    
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