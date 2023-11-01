/**
 * DataTables Advanced (jquery)
 */

'use strict';

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
                    data: 'name'
                }, {
                    data: 'amount'
                }, {
                    data: 'status'
                }],
            columnDefs: [{
                // Actions
                targets: 3,
                searchable: false,
                orderable: false,
                render: function render(data, type, full, meta) {
                    return (
                        '<a href="javascript:;" class="item-edit text-body edit-record" data-bs-toggle="offcanvas" data-bs-target="#add-new-record" data-id="'+full['id']+'"><i class="text-primary ti ti-pencil"></i></a>'
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
                    var $name = full['name'] ? full['name'] : '';
                    return '<span class="name-id">' + $name + '</span>';
                }
            }, {
                // amount
                targets: 1,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $amount = full['amount'] ? full['amount'] : '';
                    return '<span class="amount-name">' + $amount + '</span>';
                }
            }, {
                // status
                targets: 2,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $status = full['status'] ? full['status'] : '';
                    return '<span class="badge text-uppercase bg-label-'+($status=='active'?'success':'danger')+'">' + $status + '</span>';
                }
            }],
            order: [[2, 'desc']],
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
                name: {
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
});

// edit record
$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    $('#form-add-new-record').attr('action', baseUrl+'subscription-plan-management/'+user_id+'/edit');

    // get data
    $.get("".concat(baseUrl, "subscription-plan-management/").concat(user_id, "/edit"), function (data) {
      $('#edit-id').val(data.id);
      $('#edit-name').val(data.name);
      $('#edit-tagline').val(data.tagline);
      $('#edit-amount').val(data.amount);
      $('#edit-description').val(data.description);
      $('#edit-plan_for').val(data.plan_for);
      $('#edit-status').prop("checked", data.status=="active"?true:false);
      $('#edit-image').val(data.image);
    });
});