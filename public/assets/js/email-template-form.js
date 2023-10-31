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
        const productAddForm = document.querySelector('#productAddForm');
        // Form validation for Add new record
        if (productAddForm) {
            FormValidation.formValidation(productAddForm, {
                fields: {
                    subject: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter subject'
                      }
                    }
                  },
                  html_template: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter email text'
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
                    rowSelector: '.mb-3'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
            }).on('core.form.valid', function () {
                // Jump to the next step when all fields in the current step are valid
                productAddForm.submit();
            });
        }
    })();
});
