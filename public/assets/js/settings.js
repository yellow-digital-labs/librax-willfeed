'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const formValidationExamples = document.getElementById('settingForm');

        const fv = FormValidation.formValidation(formValidationExamples, {
            fields: {
                old_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your password attuale'
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'The password attuale must be more than 8 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{1,}$/,
                            message: 'The password attuale can only consist of at least one number and symbol'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your nuova password'
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'The nuova password must be more than 8 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{1,}$/,
                            message: 'The nuova password can only consist of at least one number and symbol'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your conferma password'
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'The conferma password must be more than 8 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{1,}$/,
                            message: 'The conferma password can only consist of at least one number and symbol'
                        },
                        identical: {
                            compare: function () {
                                return formAuthentication.querySelector('[name="password"]').value;
                            },
                            message: 'The nuova password and conferma password are not the same'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: ''
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    //* Move the error message out of the `input-group` element
                    if (e.element.parentElement.classList.contains('input-group')) {
                        // `e.field`: The field name
                        // `e.messageElement`: The message element
                        // `e.element`: The field element
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                    //* Move the error message out of the `row` element for custom-options
                    if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                        e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
    })();
});