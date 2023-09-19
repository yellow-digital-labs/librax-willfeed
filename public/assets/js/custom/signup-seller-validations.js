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
                placeholder: 'Seleziona attività principale',
                dropdownParent: $this.parent()
            });
        });
    }

    $("#region").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#province").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-region") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });

    $("#province").on("change", function(){
        let select_id = $(this).find(":selected").data("id");
        
        $("#common").select2("destroy").select2({
            templateResult: function(option, container) {
                if ($(option.element).attr("data-province") != select_id){ 
                  $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });

    $("#geographical_coverage_regions").on("change", function(){
        let regions = $(this).find(":selected");
        let selected_ids = [];

        for(let i = 0; i < regions.length; i++){
            selected_ids.push($(regions[i]).data("id"));
        }
        console.log("selected_ids", selected_ids)
        $("#geographical_coverage_provinces").select2("destroy").select2({
            templateResult: function(option, container) {
                if(jQuery.inArray($(option.element).data("region"), selected_ids) === -1){
                    $(container).css("display","none");
                }
        
                return option.text;
            }
        });
    });
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
            // Multi steps next prev button
            const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
            const stepsValidationPrev = [].slice.call(stepsValidationForm.querySelectorAll('.btn-prev'));

            let validationStepper = new Stepper(stepsValidation, {
                linear: true
            });

            // Registry details
            const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
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
            var formTwoValidationFields = {
                storage_capacity: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter capacità di stoccaggio'
                        }
                    }
                },
                order_capacity_limits: {
                    validators: {
                        notEmpty: {
                            enabled: false,
                            message: 'Please enter limiti di capacità ordini min'
                        }
                    }
                },
                order_capacity_limits_new: {
                    validators: {
                        notEmpty: {
                            enabled: false,
                            message: 'Please enter limiti di capacità ordini max'
                        }
                    }
                },
                available_products: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter prodotti disponibili'
                        }
                    }
                },
                geographical_coverage_regions: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter copertura geografica regioni'
                        }
                    }
                },
                time_limit_daily_order: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter tempo limite ordine giornaliero'
                        }
                    }
                },
                file_operating_license: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Licenza di esercizio'
                        }
                    }
                }
            };
            const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
                fields: formTwoValidationFields,
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
                    bank_transfer: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter bonifico bancario'
                            }
                        }
                    },
                    bank_check: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter assegno bancario'
                            }
                        }
                    },
                    rib: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter RIBA'
                            }
                        }
                    },
                    rid: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter RID'
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
                console.log("submit form");
                stepsValidationForm.submit();
                validationStepper.next();
            });

            stepsValidationNext.forEach(item => {
                item.addEventListener('click', event => {
                    // When click the Next button, we will validate the current step
                    switch (validationStepper._currentIndex) {
                        case 0:
                            multiSteps1.validate();
                            let main_activity_ids = $("#main_activity_ids").find(":selected").val();
                            // delete formTwoValidationFields.order_capacity_limits;
                            // delete formTwoValidationFields.order_capacity_limits_new;
                            if(main_activity_ids=="Agenzia"){
                                $(".order_capacity_limits_container").hide();
                                multiSteps2.disableValidator('order_capacity_limits');
                                multiSteps2.disableValidator('order_capacity_limits_new');
                            } else {
                                $(".order_capacity_limits_container").show();
                                multiSteps2.enableValidator('order_capacity_limits');
                                multiSteps2.enableValidator('order_capacity_limits_new');
                                // formTwoValidationFields["order_capacity_limits"] = {
                                //     validators: {
                                //         notEmpty: {
                                //             message: 'Please enter limiti di capacità ordini min'
                                //         }
                                //     }
                                // };
                                // formTwoValidationFields["order_capacity_limits_new"] = {
                                //     validators: {
                                //         notEmpty: {
                                //             message: 'Please enter limiti di capacità ordini max'
                                //         }
                                //     }
                                // };
                            }
                            break;

                        case 1:
                            multiSteps2.validate();
                            break;

                        case 2:
                            multiSteps3.validate();
                            break;

                        default:
                            break;
                    }
                });
            });

            stepsValidationPrev.forEach(item => {
                item.addEventListener('click', event => {
                    switch (validationStepper._currentIndex) {
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