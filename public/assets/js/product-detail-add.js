'use strict';

$(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker');

  // Bootstrap select
  if (selectPicker.length) {
    selectPicker.selectpicker();
  }

  // select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      });
    });
  }
});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#inventory-submit").on("click", function () {
        let qty = $("#qty").val();
        let product_id = $("#product_id").val();
        let data = {
            qty: qty
        }
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, "product/").concat(product_id, "/stock"),
            data: data,
            success: function success(res) {
                let data = res.data;
                $("qty").val("");
                $("#current_stock").text(data.current_stock);
                $("#stock_in_transit").text(data.stock_in_transit);
                $("#stock_lifetime").text(data.stock_lifetime);
                $("#stock_updated_at").text(data.stock_updated_at);
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    });

    $("#tax").on("change", function(){
      caclulate_price();
    });

    $("#amount_before_tax").on("change", function(){
      caclulate_price();
    });

    function caclulate_price(){
      let amount_before_tax = $('#amount_before_tax').val();
      let tax = $('#js-tax-container').text();
      let amount = Number(+amount_before_tax + (amount_before_tax*tax/100)).toLocaleString("es-ES", {minimumFractionDigits: 5});

      $("#amount").text(amount);

      let price_type = $("#price-type-container").text();
      if(price_type == "NORMAL PRICING") {
        $("#vista-price-container").text(Number(amount_before_tax).toLocaleString("es-ES", {minimumFractionDigits: 5}));
      } else if(price_type == "PLATTS"){
        let base_price = $("#base-price-container").text();
        $("#vista-price-container").text(Number(+base_price + +amount_before_tax).toLocaleString("es-ES", {minimumFractionDigits: 5}));
      }
    }

    $("#product_id").on("change", function(){
        let product_id = $("#product_id").find(":selected").val();
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, "product/").concat(product_id, "/detail"),
            success: function success(res) {
                let data = res.data;
                let tax = res.tax;
                $("#product-details-container").html(data);
                $("#price-type-container").text(res.price_type);
                $("#js-tax-container").text(tax);
                $("#base-price-container").text(res.today_price);

                if(res.price_type == "PLATTS"){
                  $(".js-platts-price-container").show();
                  $(".js-platts-price-container-not").hide();
                } else {
                  $(".js-platts-price-container").hide();
                  $(".js-platts-price-container-not").show();
                }
                caclulate_price();
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#productForm');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                  product_id: {
                    validators: {
                      notEmpty: {
                        message: 'Please select prodotto'
                      }
                    }
                  },
                  price: {
                    // All the email address field have js-price-input class
                    selector: '.js-price-input',
                    validators: {
                      callback: {
                        message: 'è necessario inserire almeno un prezzo',
                        callback: function (input) {
                          let isEmpty = true;
                          const emailElements = fv.getElements('price');
                          for (const i in emailElements) {
                            if (emailElements[i].value !== '') {
                              isEmpty = false;
                              break;
                            }
                          }
        
                          if (!isEmpty) {
                            // Update the status of callback validator for all fields
                            fv.updateFieldStatus('price', 'Valid', 'callback');
                            return true;
                          }
                          return false;
                        },
                      },
                      amount_before_tax: {
                        message: 'The value is not a valid email address',
                      },
                    },
                  },
                  delivery_time: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter time'
                      }
                    }
                  },
                  qty: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter stock'
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
                    rowSelector: '.col-12'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
              }).on('core.form.valid', function () {
                // Jump to the next step when all fields in the current step are valid
                productForm.submit();
              });;
        }
    })();
});
