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
});

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#productForm');
        // Form validation for Add new record
        if (productForm) {
            //   const fv = FormValidation.formValidation(productForm, {
            //     fields: {
            //         product_id: {
            //         validators: {
            //           notEmpty: {
            //             message: 'Please select prodotto'
            //           }
            //         }
            //       },
            //       amount_before_tax: {
            //         validators: {
            //           notEmpty: {
            //             message: 'Please enter prezzo a vista'
            //           }
            //         }
            //       },
            //       amount_30gg: {
            //         validators: {
            //           notEmpty: {
            //             message: 'Please enter prezzo 30gg'
            //           }
            //         }
            //       },
            //       amount_60gg: {
            //         validators: {
            //           notEmpty: {
            //             message: 'Please enter prezzo 60gg'
            //           }
            //         }
            //       }
            //     },
            //     plugins: {
            //       trigger: new FormValidation.plugins.Trigger(),
            //       bootstrap5: new FormValidation.plugins.Bootstrap5({
            //         eleValidClass: '',
            //         rowSelector: '.mb-3'
            //       }),
            //       submitButton: new FormValidation.plugins.SubmitButton(),

            //       defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            //       autoFocus: new FormValidation.plugins.AutoFocus()
            //     },
            //     init: instance => {
            //       instance.on('plugins.message.placed', function (e) {
            //         if (e.element.parentElement.classList.contains('input-group')) {
            //           e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            //         }
            //       });
            //     }
            //   });
        }
    })();
});
