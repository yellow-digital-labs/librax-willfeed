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
            if(isEdit){
                FormValidation.formValidation(productAddForm, {
                    ignore: [],
                    fields: {
                        blog_name: {
                        validators: {
                          notEmpty: {
                            message: 'Please enter nome del blog'
                          }
                        }
                      },
                    //   description: {
                    //     validators: {
                    //       notEmpty: {
                    //         message: 'Please enter descrizione'
                    //       }
                    //     }
                    //   },
                      slug: {
                        validators: {
                          notEmpty: {
                            message: 'Please enter slug'
                          },
                          regexp: {
                            regexp: /^[a-z0-9]+(?:-[a-z0-9]+)*$/,
                            message: 'you-can-only-write-in-this-format'
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
            } else {
                FormValidation.formValidation(productAddForm, {
                    ignore: [],
                    fields: {
                        blog_name: {
                        validators: {
                          notEmpty: {
                            message: 'Please enter nome del blog'
                          }
                        }
                      },
                    //   description: {
                    //     validators: {
                    //       notEmpty: {
                    //         message: 'Please enter descrizione'
                    //       }
                    //     }
                    //   },
                      blog_image: {
                        validators: {
                          notEmpty: {
                            message: 'Please select image'
                          }
                        }
                      },
                      slug: {
                        validators: {
                          notEmpty: {
                            message: 'Please enter slug'
                          },
                          regexp: {
                            regexp: /^[a-z0-9]+(?:-[a-z0-9]+)*$/,
                            message: 'you-can-only-write-in-this-format'
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
        }
    })();
});
