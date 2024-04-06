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
                        <h2 class="checkout-box__headtitle">Prodotto: <span class="checkout-box__headtitle-light">{{$product->product_name}}</span></h2>
                        <h2 class="checkout-box__headtitle">Venditore: <span class="checkout-box__headtitle-light">{{$product->seller_name}}<br/><span class="" style="font-size: 14px; float:right;">Fido disponibile: {{ App\Helpers\Helpers::getAvailableCreditLimit($seller_id, $customer_id) }}</span></span></h2>
                    </div>
                    <div class="checkout-box__body">
                        <div class="uk-grid checkout-box__prgrid gutter-xl" data-uk-grid>
                            <div class="uk-width-1-3 checkout-box__prcol  checkout-box__prcol--item">
                                <h3 class="checkout-box__prlabel">Articolo</h3>
                                <h2 class="checkout-box__itemname">
                                  @php
                                    $display_date = \App\Helpers\Helpers::calculateEstimateShippingDate($product->delivery_time, $product->delivery_days, $product->days_off)
                                  @endphp
                                    {{$product->product_name}} <br/>
                                    Prima consegna: {{$display_date}}
                                  @if((date('Y-m-d', strtotime($product->updated_at)) != date('Y-m-d')) || (date('Y-m-d', strtotime($product->updated_at)) == date('Y-m-d') && (date('H:i') > $product->delivery_time)))
                                    <i class="text-danger" style="color: rgba(234, 84, 85, 1) !important;">ORDINE EFFETTUATO FUORI ORARIO OPERATIVO L'APPROVAZIONE SARÀ A DISCREZIONE DEL VENDITORE.</i>
                                  @endif
                                </h2>
                            </div>
                            <div class="uk-width-expand checkout-box__prcol  checkout-box__prcol--cost contact-form__group">
                                <h3 class="checkout-box__prlabel">Costo</h3>
                                <h2 class="checkout-box__itemcost">
                                  <select class="uk-input checkout-box__qty-input" id="js-price-selector" name="product_price_type">
                                    <option value="A vista" data-price="{{$product->amount_before_tax}}">€{{number_format($product->amount_before_tax, 2)}}/LITRO A vista</option>
                                    @if($product->amount_30gg)
                                    <option value="30gg" data-price="{{$product->amount_30gg}}">€{{number_format($product->amount_30gg, 2)}}/LITRO 30gg</option>
                                    @endif
                                    @if($product->amount_60gg)
                                    <option value="60gg" data-price="{{$product->amount_60gg}}">€{{number_format($product->amount_60gg, 2)}}/LITRO 60gg</option>
                                    @endif
                                    @if($product->amount_90gg)
                                    <option value="90gg" data-price="{{$product->amount_90gg}}">€{{number_format($product->amount_90gg, 2)}}/LITRO 90gg</option>
                                    @endif
                                  </select>
                                </h2>
                                <input type="hidden" id="js-one-litter-price-wo-tax" value="{{$product->amount_before_tax}}">
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--qty contact-form__group">
                                <h3 class="checkout-box__prlabel">Quantità</h3>
                                <div class="checkout-box__qty">
                                    <input type="text" class="uk-input checkout-box__qty-input" id="js-qty-input" name="product_qty" value="100" required>
                                    <span class="checkout-box__qty-label">LITRI</span>
                                </div>
                            </div>
                            <div class="uk-width-auto checkout-box__prcol  checkout-box__prcol--price">
                                <h3 class="checkout-box__prlabel">Prezzo</h3>
                                <h2 class="checkout-box__price">€<span class="js-product-total">{{number_format($product->amount_before_tax*100, 2)}}</span></h2>
                            </div>
                        </div>
                        <div class="uk-grid checkout-box__ntgrid" data-uk-grid>
                            <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                                <textarea class="uk-textarea checkout-box__textarea" rows="5" placeholder="Note" name="order_note"></textarea>
                            </div>
                            <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note contact-form__group">
                              <h3 class="checkout-box__prlabel">Modalità di pagamento</h3>
                              <h2 class="checkout-box__itemcost">
                                <select class="uk-input checkout-box__qty-input" name="payment_method">
                                  <option value="">Seleziona pagamento</option>
                                @if($seller_details->bank_transfer)
                                  <option value="bank_transfer">Bonifico</option>
                                @endif
                                @if($seller_details->bank_check)
                                  <option value="bank_check">Assegno</option>
                                @endif
                                @if($seller_details->rib=="Si")
                                  <option value="rib">RIBA</option>
                                @endif
                                @if($seller_details->rid=="Si")
                                  <option value="rid">RID</option>
                                @endif
                                </select>
                              </h2>
                            </div>
                            <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--total">
                                <div class="checkout-box__total">
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Totale parziale:</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-subtotal">{{number_format($product->amount_before_tax*100, 2)}}</span></span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">IVA (22,00%):</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-tax-amount">{{(number_format($product->amount_before_tax*100*22/100, 2))}}</span></span>
                                    </p>
                                    <p class="checkout-box__total-item">
                                        <span class="checkout-box__total-label">Totale:</span>
                                        <span class="checkout-box__total-val">€<span class="js-order-final-total">{{number_format(($product->amount_before_tax*100)+($product->amount_before_tax*100*22/100), 2)}}</span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="uk-grid checkout-box__ntgrid" data-uk-grid>
                          <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                            <h2 class="checkout-box__itemcost">
                                Bonifico Bancario <br/>
                                IBAN: <span class="checkout-box__itemcost-price">{{$seller_details->bank_transfer?$seller_details->bank_transfer:'NA'}}</span><br/>
                                Banca: <span class="checkout-box__itemcost-price">{{$seller_details->bank?$seller_details->bank:'NA'}}</span>
                            </h2>
                            <h2 class="checkout-box__itemcost">
                                RIBA: <span class="checkout-box__itemcost-price">{{$seller_details->rib?$seller_details->rib:'NA'}}</span>
                            </h2>
                        </div>
                        <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                            <h2 class="checkout-box__itemcost">
                                Assegno Bancario: <span class="checkout-box__itemcost-price">{{$seller_details->bank_check?$seller_details->bank_check:'NA'}}</span>
                            </h2>
                            <h2 class="checkout-box__itemcost">
                                RID: <span class="checkout-box__itemcost-price">{{$seller_details->rid?$seller_details->rid:'NA'}}</span>
                            </h2>
                        </div>
                            <div class="uk-width-1-3 checkout-box__ntcol checkout-box__ntcol--note">
                                <textarea class="uk-textarea checkout-box__textarea" rows="6" placeholder="Note" name="order_note"></textarea>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="checkout-box">
                    <div class="checkout-box__head">
                        <h2 class="checkout-box__headtitle">Indirizzo di fatturazione</h2>
                    </div>
                    <div class="checkout-box__body">
                        <div class="uk-grid checkout-box__frgrid" data-uk-grid>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Ragione sociale</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_first_name" placeholder="" value="{{$user_details->business_name}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Indirizzo</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_address" placeholder="" value="{{$user_details->address}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Numero civico</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_house_no" placeholder="" value="{{$user_details->house_no}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Regione</label>
                                <select name="billing_region" id="billing_region" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity" required>
                                    <option value=""></option>
                                @foreach($region as $_region)
                                    <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_details?($user_details->region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Provincia</label>
                                <select name="billing_province" id="billing_province" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($province as $_province)
                                    <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_details?($user_details->province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Comune</label>
                                <select name="billing_common" id="billing_common" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($common as $_common)
                                    <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_details?($user_details->common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">CAP</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_pincode" placeholder="" value="{{$user_details->pincode}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="billing_email" placeholder="" value="{{$user->email}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Contatto</label>
                                <input type="text" class="uk-input checkout-box__input" name="billing_contact" placeholder="" value="{{$user_details->contact_person}}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-box">
                    <div class="checkout-box__head">
                        <h2 class="checkout-box__headtitle">Indirizzo di spedizione</h2>
                    </div>
                    <div class="checkout-box__body">
                        <div class="uk-grid checkout-box__frgrid" data-uk-grid>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Ragione sociale</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_first_name" value="{{$user_details->business_name}}" placeholder="" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Indirizzo</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_address" placeholder="" value="{{$user_details->destination_address=="Si"?$user_details->destination_address_via:$user_details->address}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Numero civico</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_house_no" placeholder="" value="{{$user_details->destination_address=="Si"?$user_details->destination_house_no:$user_details->house_no}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Regione</label>
                                <select name="selling_region" id="shipping_region" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity" required>
                                    <option value=""></option>
                                @foreach($region as $_region)
                                    <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_details?(($user_details->destination_address=="Si"?$user_details->destination_region:$user_details->region)==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Provincia</label>
                                <select name="selling_province" id="shipping_province" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($province as $_province)
                                    <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_details?(($user_details->destination_address=="Si"?$user_details->destination_province:$user_details->province)==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Comune</label>
                                <select name="selling_common" id="shipping_common" class="uk-input checkout-box__input select2" data-minimum-results-for-search="Infinity">
                                    <option value=""></option>
                                @foreach($common as $_common)
                                    <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_details?(($user_details->destination_address=="Si"?$user_details->destination_common:$user_details->common)==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">CAP</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_pincode" placeholder="" value="{{$user_details->destination_address=="Si"?$user_details->destination_pincode:$user_details->pincode}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Email</label>
                                <input type="email" class="uk-input checkout-box__input" name="selling_email" placeholder="" value="{{$user->email}}" required>
                            </div>
                            <div class="uk-width-1-2 contact-form__group">
                                <label class="checkout-box__label">Contatto</label>
                                <input type="text" class="uk-input checkout-box__input" name="selling_contact" placeholder="" value="{{$user_details->contact_person}}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout__action">
                    <button type="submit" class="uk-button uk-button-primary checkout__submit">Ordina</button>    
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
      calculate_price();
    });
</script>
<script>
  $(document).ready(function(){
    $("#js-price-selector").on("change", function(){
      calculate_price();
    });
  });
</script>

<script>
  function calculate_price(){
    let price_wo_tax_per_litter = $("#js-price-selector option:selected").data("price");
    let qty = $("#js-qty-input").val();

    let price_wo_tax = price_wo_tax_per_litter * qty;
    let tax = price_wo_tax*22/100;
    let total_price = price_wo_tax + tax;

    $(".js-product-total").text((Math.round(price_wo_tax * 100) / 100).toFixed(2));
    $(".js-order-subtotal").text((Math.round(price_wo_tax * 100) / 100).toFixed(2));
    $(".js-order-tax-amount").text((Math.round(tax * 100) / 100).toFixed(2));
    $(".js-order-final-total").text((Math.round(total_price * 100) / 100).toFixed(2));
  }
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
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#checkout-form');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                  product_qty: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter qty'
                      }
                    }
                  },
                  product_price_type: {
                    validators: {
                      notEmpty: {
                        message: 'Please select costo'
                      }
                    }
                  },
                  payment_method: {
                    validators: {
                      notEmpty: {
                        message: 'Please select modalità di pagamento'
                      }
                    }
                  },
                  billing_first_name: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter ragione sociale'
                      }
                    }
                  },
                  billing_address: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter indirizzo'
                      }
                    }
                  },
                  billing_house_no: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter numero civico'
                      }
                    }
                  },
                  billing_region: {
                    validators: {
                      notEmpty: {
                        message: 'Please select regione'
                      }
                    }
                  },
                  billing_province: {
                    validators: {
                      notEmpty: {
                        message: 'Please select provincia'
                      }
                    }
                  },
                  billing_common: {
                    validators: {
                      notEmpty: {
                        message: 'Please select comune'
                      }
                    }
                  },
                  billing_pincode: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter CAP'
                      }
                    }
                  },
                  billing_email: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter email'
                      }
                    }
                  },
                  billing_contact: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter contatto'
                      }
                    }
                  },
                  selling_first_name: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter ragione sociale'
                      }
                    }
                  },
                  selling_address: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter indirizzo'
                      }
                    }
                  },
                  selling_house_no: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter numero civico'
                      }
                    }
                  },
                  selling_region: {
                    validators: {
                      notEmpty: {
                        message: 'Please select regione'
                      }
                    }
                  },
                  selling_province: {
                    validators: {
                      notEmpty: {
                        message: 'Please select provincia'
                      }
                    }
                  },
                  selling_common: {
                    validators: {
                      notEmpty: {
                        message: 'Please select comune'
                      }
                    }
                  },
                  selling_pincode: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter CAP'
                      }
                    }
                  },
                  selling_email: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter email'
                      }
                    }
                  },
                  selling_contact: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter contatto'
                      }
                    }
                  }
                },
                plugins: {
                  trigger: new FormValidation.plugins.Trigger(),
                  bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: '.contact-form__group'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
              }).on('core.form.valid', function () {
                console.log("submit")
                // Jump to the next step when all fields in the current step are valid
                productForm.submit();
              });;
        }
    })();
});
</script>

@endsection
<!-- Scripts Ends -->