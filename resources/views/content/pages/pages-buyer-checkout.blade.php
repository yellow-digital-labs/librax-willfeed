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
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />


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
                                <input type="text" class="uk-input checkout-box__input" name="billing_first_name" placeholder="" value="{{$user_details->business_name}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Indirizzo</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_address" placeholder="" value="{{$user_details->address}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Numero civico</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_house_no" placeholder="" value="{{$user_details->house_no}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Regione</label>
                                <select name="billing_region" id="billing_region" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity" required>
                                    <option value=""></option>
                                @foreach($region as $_region)
                                    <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_details?($user_details->region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Provincia</label>
                                <select name="billing_province" id="billing_province" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($province as $_province)
                                    <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_details?($user_details->province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Comune</label>
                                <select name="billing_common" id="billing_common" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($common as $_common)
                                    <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_details?($user_details->common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">CAP</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_pincode" placeholder="" value="{{$user_details->pincode}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="billing_email" placeholder="" value="{{$user->email}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_contact" placeholder="" value="{{$user_details->contact_person}}" required>
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
                                <input type="text" class="uk-input checkout-box__input" name="selling_first_name" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Indirizzo</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_address" placeholder="" value="{{$user_details->destination_address_via}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Numero civico</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_house_no" placeholder="" value="{{$user_details->destination_house_no}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Regione</label>
                                <select name="selling_region" id="shipping_region" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity" required>
                                    <option value=""></option>
                                @foreach($region as $_region)
                                    <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_details?($user_details->destination_region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Provincia</label>
                                <select name="selling_province" id="shipping_province" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($province as $_province)
                                    <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_details?($user_details->destination_province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Comune</label>
                                <select name="selling_common" id="shipping_common" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($common as $_common)
                                    <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_details?($user_details->destination_common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">CAP</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_pincode" placeholder="" value="{{$user_details->destination_pincode}}" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="selling_email" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2">
                                <label class="checkout-box__label">Contact</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_contact" placeholder="" required>
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
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
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
    $("#billing_region").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#billing_province").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-region") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });

    $("#billing_province").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#billing_common").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-province") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });

    $("#selling_region").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#selling_province").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-region") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });

    $("#selling_province").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#selling_common").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-province") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
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