'use strict';
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
            FormValidation.formValidation(productForm, {
                fields: {
                  product_id: {
                    validators: {
                      notEmpty: {
                        message: 'Please select prodotto'
                      }
                    }
                  },
                  amount_before_tax: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter prezzo a vista'
                      }
                    }
                  },
                  amount_30gg: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter prezzo 30gg'
                      }
                    }
                  },
                  amount_60gg: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter prezzo 60gg'
                      }
                    }
                  },
                  amount_90gg: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter prezzo 90gg'
                      }
                    }
                  },
                  delivery_time: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter time'
                      }
                    }
                  },
                  delivery_days: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter delivery days'
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
