'use strict';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#paymentForm');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                    payment_type_id: {
                    validators: {
                      notEmpty: {
                        message: 'Please select payment type'
                      }
                    }
                  },
                  payment_amount: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter payment amount'
                      }
                    }
                  },
                  description: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter payment note'
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
