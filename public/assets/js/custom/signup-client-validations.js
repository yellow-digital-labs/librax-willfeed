/**
 *  Page auth register multi-steps
 */

'use strict';

// Select2 (jquery)
$(function() {
    var select2 = $('.select2');

    // select2
    if (select2.length) {
        select2.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                placeholder: 'Select an country',
                dropdownParent: $this.parent()
            });
        });
    }
});

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function(e) {
    (function() {
        const stepsValidation = document.querySelector('#multiStepsValidation');
        if (typeof stepsValidation !== undefined && stepsValidation !== null) {
            // Multi Steps form
            const stepsValidationForm = stepsValidation.querySelector('#multiStepsForm');
            // Form steps
            const stepsValidationFormStep1 = stepsValidationForm.querySelector('#SignupStepRegistry');
            const stepsValidationFormStep2 = stepsValidationForm.querySelector('#SignupStepDestination');
            const stepsValidationFormStep3 = stepsValidationForm.querySelector('#SignupStepBilling');
            const stepsValidationFormStep4 = stepsValidationForm.querySelector('#SignupStepProfile');
            // Multi steps next prev button
            const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
            const stepsValidationPrev = [].slice.call(stepsValidationForm.querySelectorAll('.btn-prev'));

            let validationStepper = new Stepper(stepsValidation, {
                linear: true
            });

            // Registry details
            const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
                fields: {
                    multiStepsUsername: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter username'
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
                        rowSelector: '.col-sm-6'
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Destination details
            const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
                fields: {
                    multiStepsUsername: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter username'
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
                        rowSelector: '.col-sm-6'
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Billing details
            const multiSteps3 = FormValidation.formValidation(stepsValidationFormStep3, {
                fields: {
                    multiStepsUsername: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter username'
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
                        rowSelector: '.col-sm-6'
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Profile details
            const multiSteps4 = FormValidation.formValidation(stepsValidationFormStep4, {
                fields: {
                    multiStepsUsername: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter username'
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
                        rowSelector: '.col-sm-6'
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            stepsValidationNext.forEach(item => {
                item.addEventListener('click', event => {
                    // When click the Next button, we will validate the current step
                    switch (validationStepper._currentIndex) {
                        case 0:
                            multiSteps1.validate();
                            break;

                        case 1:
                            multiSteps2.validate();
                            break;

                        case 2:
                            multiSteps3.validate();
                            break;

                        case 3:
                            multiSteps4.validate();
                            break;

                        default:
                            break;
                    }
                });
            });

            stepsValidationPrev.forEach(item => {
                item.addEventListener('click', event => {
                    switch (validationStepper._currentIndex) {
                        case 3:
                            validationStepper.previous();
                            break;

                        case 2:
                            validationStepper.previous();
                            break;

                        case 1:
                            validationStepper.previous();
                            break;

                        case 0:

                        default:
                            break;
                    }
                });
            });
        }
    })();
});