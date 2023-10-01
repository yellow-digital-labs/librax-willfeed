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

<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

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
        <form method="POST" id="checkout-form">
            <div class="uk-container checkout__container">
                @csrf
                <div class="checkout-box">
                    <input type="hidden" name="product_id" value="{{$product->product_id}}">
                    <input type="hidden" name="seller_product_id" value="{{$product->id}}">
                    <div class="checkout-box__head">
                        <h2 class="checkout-box__headtitle">Product: <span class="checkout-box__headtitle-light">{{$product->product_name}}</span></h2>
                        <h2 class="checkout-box__headtitle">Seller: <span class="checkout-box__headtitle-light">{{$product->seller_name}}</span></h2>
                    </div>
                    <div class="checkout-box__body">
                        <div class="uk-grid checkout-box__prgrid gutter-xl" data-uk-grid>
                            <div class="uk-width-1-3 checkout-box__prcol  checkout-box__prcol--item">
                                <h3 class="checkout-box__prlabel">Item</h3>
                                <h2 class="checkout-box__itemname">{{$product->product_name}}</h2>
                            </div>
                            <div class="uk-width-expand checkout-box__prcol  checkout-box__prcol--cost">
                                <h3 class="checkout-box__prlabel">Cost</h3>
                                <h2 class="checkout-box__itemcost"><span class="checkout-box__itemcost-price">€{{$product->amount_before_tax}}</span>/LITERS</h2>
                                <input type="hidden" id="js-one-litter-price-wo-tax" value="{{$product->amount_before_tax}}">
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--qty">
                                <h3 class="checkout-box__prlabel">Qty</h3>
                                <div class="checkout-box__qty">
                                    <input type="text" class="uk-input checkout-box__qty-input" id="js-qty-input" name="product_qty" value="100" required>
                                    <span class="checkout-box__qty-label">LITERS</span>
                                </div>
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--price">
                                <h3 class="checkout-box__prlabel">Price</h3>
                                <h2 class="checkout-box__price">€<span class="js-product-total">{{$product->amount_before_tax*100}}</span></h2>
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
                                        <span class="checkout-box__total-val">€<span class="js-order-subtotal">{{$product->amount_before_tax*100}}</span></span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Tax (22,00%):</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-tax-amount">{{($product->amount_before_tax*100*22/100)}}</span></span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Total:</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-final-total">{{($product->amount_before_tax*100)+($product->amount_before_tax*100*22/100)}}</span></span>
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
                                <input type="text" class="uk-input checkout-box__input" name="billing_first_name" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="customer_email" placeholder="" required>
                            </div>
                            <div class="uk-width-1-1">
                                <label class="checkout-box__label">Address</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_address_line_1" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">City</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_city" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="customer_contact" placeholder="" required>
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
                                <input type="text" class="uk-input checkout-box__input" name="shipping_first_name" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="shipping_email" placeholder="" required>
                            </div>
                            <div class="uk-width-1-1">
                                <label class="checkout-box__label">Address</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_address_line_1" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">City</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_city" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="shipping_contact" placeholder="" required>
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
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>

<script>
    $("#js-qty-input").on("change", function(){
        let price_wo_tax_per_litter = $("#js-one-litter-price-wo-tax").val();
        let qty = $(this).val();

        let price_wo_tax = price_wo_tax_per_litter * qty;
        let tax = price_wo_tax*22/100;
        let total_price = price_wo_tax + tax;

        $(".js-product-total").text(price_wo_tax);
        $(".js-order-subtotal").text(price_wo_tax);
        $(".js-order-tax-amount").text(tax);
        $(".js-order-final-total").text(total_price);
    });
</script>

<script>
// document.addEventListener('DOMContentLoaded', function (e) {
//     (function () {
//         const productForm = document.querySelector('#checkout-form');
//         // Form validation for Add new record
//         if (productForm) {
//             FormValidation.formValidation(productForm, {
//                 fields: {
//                   product_qty: {
//                     validators: {
//                       notEmpty: {
//                         message: 'Please select prodotto'
//                       }
//                     }
//                   },
//                   shipping_first_name: {
//                     validators: {
//                       notEmpty: {
//                         message: 'Please enter prezzo a vista'
//                       }
//                     }
//                   },
//                   amount_30gg: {
//                     validators: {
//                       notEmpty: {
//                         message: 'Please enter prezzo 30gg'
//                       }
//                     }
//                   },
//                   amount_60gg: {
//                     validators: {
//                       notEmpty: {
//                         message: 'Please enter prezzo 60gg'
//                       }
//                     }
//                   },
//                   amount_90gg: {
//                     validators: {
//                       notEmpty: {
//                         message: 'Please enter prezzo 90gg'
//                       }
//                     }
//                   }
//                 },
//                 plugins: {
//                   trigger: new FormValidation.plugins.Trigger(),
//                   bootstrap5: new FormValidation.plugins.Bootstrap5({
//                     // Use this for enabling/changing valid/invalid class
//                     // eleInvalidClass: '',
//                     eleValidClass: '',
//                     rowSelector: '.col-12'
//                   }),
//                   submitButton: new FormValidation.plugins.SubmitButton(),
//                   // Submit the form when all fields are valid
//                   // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
//                   autoFocus: new FormValidation.plugins.AutoFocus()
//                 }
//               }).on('core.form.valid', function () {
//                 console.log("submit")
//                 // Jump to the next step when all fields in the current step are valid
//                 // productForm.submit();
//               });;
//         }
//     })();
// });
</script>

@endsection
<!-- Scripts Ends -->