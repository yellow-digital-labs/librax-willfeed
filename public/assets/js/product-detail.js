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

    $("#amount_before_tax").on("change", function(){
        let amount_before_tax = $(this).val();
        let amount = Number(+amount_before_tax + (amount_before_tax*22/100)).toLocaleString("es-ES", {minimumFractionDigits: 2});

        $("#amount").text(amount);
    })

    $("#product_id").on("change", function(){
        let product_id = $("#product_id").find(":selected").val();
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, "product/").concat(product_id, "/detail"),
            success: function success(res) {
                let data = res.data;
                $("#product-details-container").text(data);
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
            const fv = FormValidation.formValidation(productForm, {
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
                // console.log("submit...")
                productForm.submit();
              });;
        }
    })();
});
