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
        <form method="POST">
            <div class="uk-container checkout__container">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                <input type="hidden" name="seller_product_id" value="{{$product->id}}">
                <div class="checkout-box">
                    <div class="checkout-box__head">
                        <h2 class="checkout-box__headtitle">Product: <span class="checkout-box__headtitle-light">{{$product->product_name}}</span></h2>
                        <h2 class="checkout-box__headtitle">Seller: <span class="checkout-box__headtitle-light">{{$product->seller_name}}</span></h2>
                    </div>
                    <div class="checkout-box__body">
                        <div class="uk-grid checkout-box__prgrid gutter-xl" data-uk-grid>
                            <div class="uk-width-1-3 checkout-box__prcol  checkout-box__prcol--item">
                                <h3 class="checkout-box__prlabel">Item</h3>
                                <h2 class="checkout-box__itemname">Ethylene</h2>
                            </div>
                            <div class="uk-width-expand checkout-box__prcol  checkout-box__prcol--cost">
                                <h3 class="checkout-box__prlabel">Cost</h3>
                                <h2 class="checkout-box__itemcost"><span class="checkout-box__itemcost-price">€{{$product->amount_before_tax}}</span>/LITERS</h2>
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--qty">
                                <h3 class="checkout-box__prlabel">Qty</h3>
                                <div class="checkout-box__qty">
                                    <input type="text" class="uk-input checkout-box__qty-input" name="product_qty" value="1">
                                    <span class="checkout-box__qty-label">LITERS</span>
                                </div>
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--price">
                                <h3 class="checkout-box__prlabel">Price</h3>
                                <h2 class="checkout-box__price">€<span class="js-product-total">{{$product->amount_before_tax}}</span></h2>
                            </div>
                        </div>
                        <div class="uk-grid checkout-box__ntgrid" data-uk-grid>
                            <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                                <textarea class="uk-textarea checkout-box__textarea" rows="6" placeholder="Note" name="order_note"></textarea>
                            </div>
                            <div class="uk-width-2-3 checkout-box__ntcol checkout-box__ntcol--total">
                                <div class="checkout-box__total">
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Subtotal:</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-subtotal"></span>936</span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Tax (22,00%):</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-tax-amount">50.12</span></span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Total:</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-final-total"></span>986.12</span>
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
                                <label class="checkout-box__label">Full Name</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_first_name" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="customer_email" placeholder="">
                            </div>
                            <div class="uk-width-1-1">
                                <label class="checkout-box__label">Address</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_address_line_1" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">City</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_city" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="customer_contact" placeholder="">
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
                                <label class="checkout-box__label">Full Name</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_first_name" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="shipping_email" placeholder="">
                            </div>
                            <div class="uk-width-1-1">
                                <label class="checkout-box__label">Address</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_address_line_1" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">City</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_city" placeholder="">
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_contact" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout__action">
                    <button type="submit" class="uk-button uk-button-primary checkout__submit">Check out</button>    
                </div>

            </div>
        </form>
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