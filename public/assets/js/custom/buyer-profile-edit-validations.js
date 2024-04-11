/**
 *  Page auth register multi-steps
 */

'use strict';

// Select2 (jquery)
$(function () {
    var select2 = $('.select2');

    // select2
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                placeholder: 'Select an option',
                dropdownParent: $this.parent()
            });
        });
    }

    $("#region").on("change", function () {
        console.log('region changes');
        let select_id = $(this).find(":selected").data("id");

        $("#province").select2("destroy").select2({
            templateResult: function (option, container) {
                if ($(option.element).attr("data-region") != select_id) {
                    $(container).css("display", "none");
                }

                return option.text;
            }
        });
    });

    $("#province").on("change", function () {
        let select_id = $(this).find(":selected").data("id");

        $("#common").select2("destroy").select2({
            templateResult: function (option, container) {
                if ($(option.element).attr("data-province") != select_id) {
                    $(container).css("display", "none");
                }

                return option.text;
            }
        });
    });

    $("#destination_region").on("change", function () {
        let select_id = $(this).find(":selected").data("id");

        $("#destination_province").select2("destroy").select2({
            templateResult: function (option, container) {
                if ($(option.element).attr("data-region") != select_id) {
                    $(container).css("display", "none");
                }

                return option.text;
            }
        });
    });

    $("#destination_province").on("change", function () {
        let select_id = $(this).find(":selected").data("id");

        $("#destination_common").select2("destroy").select2({
            templateResult: function (option, container) {
                if ($(option.element).attr("data-province") != select_id) {
                    $(container).css("display", "none");
                }

                return option.text;
            }
        });
    });

    $("#geographical_coverage_regions").on("change", function () {
        let regions = $(this).find(":selected");
        let selected_ids = [];

        for (let i = 0; i < regions.length; i++) {
            selected_ids.push($(regions[i]).data("id"));
        }
        console.log("selected_ids", selected_ids)
        $("#geographical_coverage_provinces").select2("destroy").select2({
            templateResult: function (option, container) {
                if (jQuery.inArray($(option.element).data("region"), selected_ids) === -1) {
                    $(container).css("display", "none");
                }

                return option.text;
            }
        });
    });

    $('.container-transport').on('click', function () {
        if ($(this).prop("checked")) {
            //checked
            $(this).closest(".row").find(".form-control").removeClass("hide");
        } else {
            //unchecked
            $(this).closest(".row").find(".form-control").addClass("hide");
            $(this).closest(".row").find(".form-control").val(0);
        }
    });

    $("#destination_address").on("change", function () {
        if (this.value == "Si") {
            $(".address-container").removeClass('hide');
        } else {
            $(".address-container").addClass('hide');
        }
    });

    $("#is_private_distributer").on("change", function () {
        if (this.value == "Si") {
            $(".js-no-of-dis-container").removeClass("hide");
        } else {
            $(".js-no-of-dis-container").addClass("hide");
        }
    });
});

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#buyerEditForm');
        // Form validation for Add new record
        if (productForm) {
            console.log("...")
            FormValidation.formValidation(productForm, {
                fields: {
                    business_name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter ragione sociale'
                            }
                        }
                    },
                    vat_number: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter partita IVA'
                            },
                            stringLength: {
                                min: 11,
                                max: 11,
                                message: 'partita IVA should be 11 digit long'
                            }
                        }
                    },
                    contact_person: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter cellulare referente'
                            },
                            stringLength: {
                                min: 10,
                                max: 10,
                                message: 'cellulare referente should be 10 digit long'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'cellulare referente can only consist of number'
                            }
                        }
                    },
                    pec: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter PEC'
                            },
                            emailAddress: {
                                message: 'The value is not a valid PEC'
                            }
                        }
                    },
                    tax_id_code: {
                        validators: {
                            regexp: {
                                regexp: /^[A-Z0-9]+$/,
                                message: 'Codice fiscale can only consist of capital alphabets or number'
                            }
                        }
                    },
                    administrator_name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter nominativo amministratore'
                            }
                        }
                    },
                    main_activity_ids: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter attività principale'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter indirizzo'
                            }
                        }
                    },
                    house_no: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter numero civico'
                            }
                        }
                    },
                    common: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter comune'
                            }
                        }
                    },
                    province: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter provincia'
                            }
                        }
                    },
                    pincode: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter CAP'
                            }
                        }
                    },
                    payment_extension: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter dilazione di pagamento preferita'
                            }
                        }
                    },
                    payment_term: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter modalità di pagamento'
                            }
                        }
                    },
                    reference_bank: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter banca di riferimento'
                            }
                        }
                    },
                    sdi: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter SDI'
                            }
                        }
                    },
                    file_1: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload esenzione IVA'
                            }
                        }
                    },
                    file_2: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload esenzione IVA'
                            }
                        }
                    },
                    file_3: {
                        validators: {
                            notEmpty: {
                                message: 'Please upload esenzione IVA'
                            }
                        }
                    },
                    products: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter tipologia di prodotti consumati'
                            }
                        }
                    },
                    monthly_consumption: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter consumi medi mensili'
                            }
                        }
                    },
                    is_private_distributer: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter sei un distributore privato'
                            }
                        }
                    },
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
                var formData = new FormData($("#buyerEditForm")[0]);

                $.ajax({
                    url: $("#buyerEditForm").attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);

                        Swal.fire({
                            text: "Richiesta di modifica inviata",
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            window.location.href = `${baseUrl}profile`;
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            text: ` Hai già inviato una richiesta di aggiornamento`,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        })
                    }
                });
            });
        }

        // const stepsValidation = document.querySelector('#multiStepsBuyerValidation');
        // if (typeof stepsValidation !== undefined && stepsValidation !== null) {
        //     // Multi Steps form
        //     const stepsValidationForm = stepsValidation.querySelector('#buyerEditForm');
        //     // Form steps
        //     const stepsValidationFormStep1 = stepsValidationForm.querySelector('#SignupStepRegistry');
        //     const stepsValidationFormStep2 = stepsValidationForm.querySelector('#SignupStepDestination');
        //     const stepsValidationFormStep3 = stepsValidationForm.querySelector('#SignupStepBilling');
        //     const stepsValidationFormStep4 = stepsValidationForm.querySelector('#SignupStepProfile');
        //     // Multi steps next prev button
        //     const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
        //     const stepsValidationPrev = [].slice.call(stepsValidationForm.querySelectorAll('.btn-prev'));

        //     let validationStepper = new Stepper(stepsValidation, {
        //         linear: true
        //     });

        //     // Registry details
        //     const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
        //         fields: {

        //         },
        //         plugins: {
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap5: new FormValidation.plugins.Bootstrap5({
        //                 // Use this for enabling/changing valid/invalid class
        //                 // eleInvalidClass: '',
        //                 eleValidClass: '',
        //                 rowSelector: '.col-sm-6'
        //             }),
        //             autoFocus: new FormValidation.plugins.AutoFocus(),
        //             submitButton: new FormValidation.plugins.SubmitButton()
        //         },
        //         init: instance => {
        //             instance.on('plugins.message.placed', function (e) {
        //                 if (e.element.parentElement.classList.contains('input-group')) {
        //                     e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        //                 }
        //             });
        //         }
        //     }).on('core.form.valid', function () {
        //         // Jump to the next step when all fields in the current step are valid
        //         validationStepper.next();
        //     });

        //     // Destination details
        //     let formTwoValidationFields = 
        //     };
        //     const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
        //         fields: formTwoValidationFields,
        //         plugins: {
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap5: new FormValidation.plugins.Bootstrap5({
        //                 // Use this for enabling/changing valid/invalid class
        //                 // eleInvalidClass: '',
        //                 eleValidClass: '',
        //                 rowSelector: '.col-sm-6'
        //             }),
        //             autoFocus: new FormValidation.plugins.AutoFocus(),
        //             submitButton: new FormValidation.plugins.SubmitButton()
        //         },
        //         init: instance => {
        //             instance.on('plugins.message.placed', function (e) {
        //                 if (e.element.parentElement.classList.contains('input-group')) {
        //                     e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        //                 }
        //             });
        //         }
        //     }).on('core.form.valid', function () {
        //         // Jump to the next step when all fields in the current step are valid
        //         validationStepper.next();
        //     });

        //     // Billing details
        //     const multiSteps3 = FormValidation.formValidation(stepsValidationFormStep3, {
        //         fields: {

        //         },
        //         plugins: {
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap5: new FormValidation.plugins.Bootstrap5({
        //                 // Use this for enabling/changing valid/invalid class
        //                 // eleInvalidClass: '',
        //                 eleValidClass: '',
        //                 rowSelector: '.col-sm-6'
        //             }),
        //             autoFocus: new FormValidation.plugins.AutoFocus(),
        //             submitButton: new FormValidation.plugins.SubmitButton()
        //         },
        //         init: instance => {
        //             instance.on('plugins.message.placed', function (e) {
        //                 if (e.element.parentElement.classList.contains('input-group')) {
        //                     e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        //                 }
        //             });
        //         }
        //     }).on('core.form.valid', function () {
        //         // Jump to the next step when all fields in the current step are valid
        //         validationStepper.next();
        //     });

        //     // Profile details
        //     const multiSteps4 = FormValidation.formValidation(stepsValidationFormStep4, {
        //         fields: {

        //         },
        //         plugins: {
        //             trigger: new FormValidation.plugins.Trigger(),
        //             bootstrap5: new FormValidation.plugins.Bootstrap5({
        //                 // Use this for enabling/changing valid/invalid class
        //                 // eleInvalidClass: '',
        //                 eleValidClass: '',
        //                 rowSelector: '.col-sm-6'
        //             }),
        //             autoFocus: new FormValidation.plugins.AutoFocus(),
        //             submitButton: new FormValidation.plugins.SubmitButton()
        //         },
        //         init: instance => {
        //             instance.on('plugins.message.placed', function (e) {
        //                 if (e.element.parentElement.classList.contains('input-group')) {
        //                     e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        //                 }
        //             });
        //         }
        //     }).on('core.form.valid', function () {
        //         // Jump to the next step when all fields in the current step are valid
        //         validationStepper.next();
        //         console.log('final submit');

        //         // var formData = $("#sellerEditForm").serialize();

        //     });

        //     stepsValidationNext.forEach(item => {
        //         item.addEventListener('click', event => {
        //             // When click the Next button, we will validate the current step
        //             switch (validationStepper._currentIndex) {
        //                 case 0:
        //                     multiSteps1.validate();
        //                     break;

        //                 case 1:
        //                     let destination_address = $("#destination_address").find(":selected").val();
        //                     if (destination_address == "No") {
        //                         multiSteps2.disableValidator('destination_region');
        //                     } else {
        //                         multiSteps2.enableValidator('destination_region');

        //                     }
        //                     multiSteps2.validate();
        //                     break;

        //                 case 2:
        //                     multiSteps3.validate();
        //                     break;

        //                 case 3:
        //                     multiSteps4.validate();
        //                     break;

        //                 default:
        //                     break;
        //             }
        //         });
        //     });

        //     stepsValidationPrev.forEach(item => {
        //         item.addEventListener('click', event => {
        //             switch (validationStepper._currentIndex) {
        //                 case 3:
        //                     validationStepper.previous();
        //                     break;

        //                 case 2:
        //                     validationStepper.previous();
        //                     break;

        //                 case 1:
        //                     validationStepper.previous();
        //                     break;

        //                 case 0:

        //                 default:
        //                     break;
        //             }
        //         });
        //     });
        // }
    })();
});