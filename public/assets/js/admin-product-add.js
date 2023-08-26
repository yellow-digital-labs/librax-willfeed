'use strict';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#productAddForm").on("submit",function() {
        $("#text_quill").val($("#snow-editor").html());
    });
});

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productAddForm = document.querySelector('#productAddForm');
        // Form validation for Add new record
        if (productAddForm) {
            FormValidation.formValidation(productAddForm, {
                fields: {
                    name: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter prodotto'
                      }
                    }
                  },
                  description: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter descrizione'
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
            });
        }
    })();
});
