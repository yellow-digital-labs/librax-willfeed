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
                placeholder: 'Seleziona attività principale',
                dropdownParent: $this.parent()
            });
        });
    }

    $("#region").on("change", function () {
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

});

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#sellerEditForm');
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
                                message: 'Please enter tempo limite accettazione ordine'
                            }
                        }
                    },
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
                console.log('form validated');
                var formData = new FormData($("#sellerEditForm")[0]);
                $.ajax({
                    url: $("#sellerEditForm").attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        window.location.href = `${baseUrl}profile`;
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);

                        Swal.fire({
                            text: " Hai già inviato una richiesta di aggiornamento",
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
    })();
});