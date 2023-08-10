'use strict';
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
