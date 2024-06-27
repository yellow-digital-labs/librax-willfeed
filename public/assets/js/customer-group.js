/**
 * DataTables Advanced (jquery)
 */
(function webpackUniversalModuleDefinition(root, factory) {
    if (typeof exports === 'object' && typeof module === 'object')
        module.exports = factory();
    else if (typeof define === 'function' && define.amd)
        define([], factory);
    else {
        var a = factory();
        for (var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
    }
})(self, function () {
    return /******/ (function () { // webpackBootstrap

'use strict';
var __webpack_exports__ = {};
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(function() {
    var dt_filter_table = $('.dt-column-search');

    // Column Search
    // --------------------------------------------------------------------

    if (dt_filter_table.length) {

        var dt_user = dt_filter_table.DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            bLengthChange: true,
            ajax: {
                url: urlListSubscribeData,
            },
            columns: [
                // columns according to JSON
                {
                    data: 'id'
                }, {
                    data: 'customer_group_name'
                }],
            columnDefs: [{
                // Actions
                targets: 1,
                searchable: false,
                orderable: false,
                render: function render(data, type, full, meta) {
                    return (
                        '<a href="/customer-group-management/'+full['id']+'/edit" class="item-edit text-body edit-record" data-id="'+full['id']+'"><i class="text-primary ti ti-pencil"></i></a>' + '<button class="btn btn-sm btn-icon delete-record" data-id="' + full['id'] + '"><i class=\"ti ti-trash\"></i></button>'
                    );
                }
            }, {
                // name
                targets: 0,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $name = full['customer_group_name'] ? full['customer_group_name'] : '';
                    return '<span class="name-id">' + $name + '</span>';
                }
            }],
            order: [[0, 'asc']],
            dom: '<"row mx-2"' + '<"col-md-2"<"me-3 datatable-toolbar"l>>' + '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
            language: {
                sLengthMenu: '_MENU_',
                search: 'Ricerca',
                searchPlaceholder: 'Search..'
            },
            // Buttons with Dropdown
            buttons: []
        });
    }

    const productForm = document.querySelector('#form-add-new-record');
    // Form validation for Add new record
    if (productForm) {
        FormValidation.formValidation(productForm, {
            fields: {
                customer_group_name: {
                validators: {
                    notEmpty: {
                    message: 'Please enter name'
                    }
                }
                },
                tagline: {
                validators: {
                    notEmpty: {
                    message: 'Please enter tagline'
                    }
                }
                },
                amount: {
                validators: {
                    notEmpty: {
                    message: 'Please enter amount'
                    }
                }
                },
                description: {
                validators: {
                    notEmpty: {
                    message: 'Please enter description'
                    }
                }
                },
                plan_for: {
                validators: {
                    notEmpty: {
                    message: 'Please select assign to'
                    }
                }
                },
                plan_validity: {
                validators: {
                    notEmpty: {
                    message: 'Please select validità'
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
                rowSelector: '.col-sm-12'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            }
            }).on('core.form.valid', function () {
            // Jump to the next step when all fields in the current step are valid
                productForm.submit();
            });
    }

    // edit record
$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    $('#form-add-new-record').attr('action', baseUrl+'customer-group-management/'+user_id+'/edit');

    // get data
    $.get("".concat(baseUrl, "customer-group-management/").concat(user_id, "/edit"), function (data) {
      $('#edit-id').val(data.id);
      $('#edit-customer_group_name').val(data.customer_group_name);
    });
});

// Delete Record
$(document).on('click', '.delete-record', function () {
    var user_id = $(this).data('id'),
        dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
        dtrModal.modal('hide');
    }

    // sweetalert for confirmation of delete
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            // delete the data
            $.ajax({
                type: 'DELETE',
                url: "".concat(baseUrl, "customer-group-management/delete/").concat(user_id),
                success: function success(res) {
                    dt_user.draw();

                    if(res.code == 200){
                        // success sweetalert
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message,
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Cancelled',
                            text: res.message,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                },
                error: function error(_error) {
                    console.log(_error);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'The product is not deleted!',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        }
    });
});
});

/******/ 	return __webpack_exports__;
        /******/
    })()
    ;
});