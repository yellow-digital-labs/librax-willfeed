/**
 * DataTables Advanced (jquery)
 */

'use strict';

$(function () {
    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dt_ajax_table = $('.datatables-ajax'),
        dt_filter_table = $('.dt-column-search'),
        dt_adv_filter_table = $('.dt-advanced-search'),
        dt_responsive_table = $('.dt-responsive'),
        startDateEle = $('.start_date'),
        endDateEle = $('.end_date');

    // Advanced Search Functions Starts
    // --------------------------------------------------------------------

    // Datepicker for advanced filter
    var rangePickr = $('.flatpickr-range'),
        dateFormat = 'MM/DD/YYYY';

    if (rangePickr.length) {
        rangePickr.flatpickr({
            mode: 'range',
            dateFormat: 'm/d/Y',
            orientation: isRtl ? 'auto right' : 'auto left',
            locale: {
                format: dateFormat
            },
            onClose: function (selectedDates, dateStr, instance) {
                var startDate = '',
                    endDate = new Date();
                if (selectedDates[0] != undefined) {
                    startDate = moment(selectedDates[0]).format('MM/DD/YYYY');
                    startDateEle.val(startDate);
                }
                if (selectedDates[1] != undefined) {
                    endDate = moment(selectedDates[1]).format('MM/DD/YYYY');
                    endDateEle.val(endDate);
                }
                $(rangePickr).trigger('change').trigger('keyup');
            }
        });
    }

    // Filter column wise function
    function filterColumn(i, val) {
        if (i == 5) {
            var startDate = startDateEle.val(),
                endDate = endDateEle.val();
            if (startDate !== '' && endDate !== '') {
                $.fn.dataTableExt.afnFiltering.length = 0; // Reset datatable filter
                dt_adv_filter_table.dataTable().fnDraw(); // Draw table after filter
                filterByDate(i, startDate, endDate); // We call our filter function
            }
            dt_adv_filter_table.dataTable().fnDraw();
        } else {
            dt_adv_filter_table.DataTable().column(i).search(val, false, true).draw();
        }
    }

    // Advance filter function
    // We pass the column location, the start date, and the end date
    $.fn.dataTableExt.afnFiltering.length = 0;
    var filterByDate = function (column, startDate, endDate) {
        // Custom filter syntax requires pushing the new filter to the global filter array
        $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
            var rowDate = normalizeDate(aData[column]),
                start = normalizeDate(startDate),
                end = normalizeDate(endDate);

            // If our date from the row is between the start and end
            if (start <= rowDate && rowDate <= end) {
                return true;
            } else if (rowDate >= start && end === '' && start !== '') {
                return true;
            } else if (rowDate <= end && start === '' && end !== '') {
                return true;
            } else {
                return false;
            }
        });
    };

    // converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
    var normalizeDate = function (dateString) {
        var date = new Date(dateString);
        var normalized =
            date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
        return normalized;
    };
    // Advanced Search Functions Ends

    // Ajax Sourced Server-side
    // --------------------------------------------------------------------

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            ajax: assetsPath + 'json/ajax.php',
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-start justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });
    }

    // Column Search
    // --------------------------------------------------------------------

    if (dt_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
        $('.dt-column-search thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if ($(this).hasClass('js-add-search')) {
                $(this).html('<input type="text" class="form-control" placeholder="Cerca ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (dt_filter.column(i).search() !== this.value) {
                        dt_filter.column(i).search(this.value).draw();
                    }
                });
            }
            else {
                $(this).html('');
            }
        });

        var dt_filter = dt_filter_table.DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            bLengthChange: true,
            oLanguage: {
                oPaginate: {
                    sPrevious: "Precednte",
                    sNext: "Prossimo",
                },
                info: "Visualizza _START_ di _END_ of _TOTAL_ Risultati",
                zeroRecords: "nessun account trovato"
            },
            ajax: {
                url: urlListCustomerData 
            },
            columns: [
                { data: 'customer_name' },
                { data: 'seller_name' },
                { data: 'customer_region' },
                { data: 'status_on' },
                { data: 'customer_since' },
                { data: 'status' },
                { data: 'customer_group' },
                { data: '' }
            ],
            columnDefs: [{
                // customer_name
                targets: 0,
                visible: isSeller=="1"?true:false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $customer_name = full['customer_name'] ? full['customer_name'] : '';
                    return '<span class="user-customer_name">' + $customer_name + '</span>';
                }
            }, {
                // seller_name
                targets: 1,
                visible: isSeller=="1"?false:true,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $seller_name = full['seller_name'] ? full['seller_name'] : '';
                    return '<span class="user-seller_name">' + $seller_name + '</span>';
                }
            }, {
                // customer_region
                targets: 2,
                visible: isSeller=="1"?true:false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $customer_region = full['customer_region'] ? full['customer_region'] : '';
                    return '<span class="user-customer_region">' + $customer_region + '</span>';
                }
            }, {
                // status_on
                targets: 3,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $status_on = full['status_on'] ? full['status_on'] : '';
                    return '<span class="user-status_on">' + $status_on + '</span>';
                }
            }, {
                // customer_since
                targets: 4,
                visible: isSeller=="1"?true:false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $customer_since = full['customer_since'] ? full['customer_since'] : '';
                    return '<span class="user-customer_since">' + $customer_since + '</span>';
                }
            }, {
                // customer_group
                targets: 5,
                visible: true,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    console.log("FULL", data)
                    var $customer_group = full['customer_group'] ? full['customer_group'] : '';
                    // return '<span class="user-customer_group">' + $customer_group + '</span>';
                    let selectOption = `<select class="form-control select2 change-customer-group" data-id="${full['id']}">
                        <option value="0">Primo prezzo</option>`;
                    $.each(customer_groups, function(key, val){
                        selectOption += `<option value="${val.id}" ${val.id == $customer_group?'selected':''}>${val.customer_group_name}</option>`
                    });
                    selectOption += `</select>`;
                    return selectOption;
                }
            }, {
                // credit_limit
                targets: 6,
                visible: true,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $credit_limit = full['credit_limit'] ? full['credit_limit'] : '';
                    return '<span class="user-credit_limit">' + $credit_limit + '</span>';
                }
            }, {
                // credit_used
                targets: 7,
                visible: true,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $credit_used = full['credit_used'] ? full['credit_used'] : '';
                    return '<span class="user-credit_used">' + $credit_used + '</span>';
                }
            }, {
                // credit_avail
                targets: 8,
                visible: true,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $credit_avail = full['credit_avail'] ? full['credit_avail'] : '';
                    return '<span class="user-credit_avail">' + $credit_avail + '</span>';
                }
            }, {
                // Label
                targets: 9,
                render: function (data, type, full, meta) {
                    var $status_number = full['status'];
                    var $status = {
                        'pending': { title: 'Pending', class: 'bg-label-primary' },
                        'approved': { title: 'Approved', class: ' bg-label-success' },
                        'rejected': { title: 'Rejected', class: ' bg-label-danger' }
                    };
                    if (typeof $status[$status_number] === 'undefined') {
                        return data;
                    }
                    return (
                        '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                    );
                }
            },
            {
                // Actions
                targets: 10,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    var status_number = full['status'];
                    var id = full['id'];
                    let statusList = "";
                    // if(status_number != "pending") {
                    //     statusList += `<a href="javascript:;" class="dropdown-item btn-pending" data-id="${id}">Pending</a>`;
                    // }
                    if(isSeller=="1"){
                        if(status_number != "approved") {
                            statusList += `<a href="javascript:;" class="dropdown-item btn-approve" data-id="${id}" data-bs-toggle="modal" data-bs-target="#creditLimitModal">Approve</a>`;
                        }
                        if(status_number != "rejected") {
                            statusList += `<a href="javascript:;" class="dropdown-item btn-reject" data-id="${id}">Reject</a>`;
                        }
                        if(full['is_request_by_seller'] == "0"){
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="'+baseUrl+'profile/'+full['customer_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                '<a href="'+baseUrl+'profile/'+full['customer_id']+'/view" class="btn btn-sm btn-icon js-update-credit-limit" data-id="'+full['id']+'" data-bs-toggle="modal" data-bs-target="#creditLimitModal">€</a>' +
                                '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                statusList +
                                '</div>' +
                                '</div>'
                            );
                        } else {
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="'+baseUrl+'profile/'+full['customer_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                '<a href="'+baseUrl+'profile/'+full['customer_id']+'/view" class="btn btn-sm btn-icon js-update-credit-limit" data-id="'+full['id']+'" data-bs-toggle="modal" data-bs-target="#creditLimitModal">€</a>' +
                                '</div>'
                            );
                        }
                    } else {
                        if(status_number != "approved") {
                            statusList += `<a href="javascript:;" class="dropdown-item btn-approve-buyer-login" data-id="${id}">Approve</a>`;
                        }
                        if(status_number != "rejected") {
                            statusList += `<a href="javascript:;" class="dropdown-item btn-reject" data-id="${id}">Reject</a>`;
                        }
                        if(full['is_request_by_seller'] == "1"){
                            if(status_number == "approved") {
                                return (
                                    '<div class="d-inline-block">' +
                                    '<a href="'+baseUrl+'profile/'+full['seller_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                    '<a href="'+baseUrl+'buyer-home?search='+full['seller_name']+'" class="btn btn-sm btn-icon js-update-credit-limit"><i class="ti ti-share"></i></a>' +
                                    '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                                    '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                    statusList +
                                    '</div>' +
                                    '</div>'
                                );
                            } else {
                                return (
                                    '<div class="d-inline-block">' +
                                    '<a href="'+baseUrl+'profile/'+full['seller_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                    '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                                    '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                    statusList +
                                    '</div>' +
                                    '</div>'
                                );
                            }
                        } else {
                            if(status_number == "approved") {
                                return (
                                    '<div class="d-inline-block">' +
                                    '<a href="'+baseUrl+'profile/'+full['seller_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                    '<a href="'+baseUrl+'buyer-home?search='+full['seller_name']+'" class="btn btn-sm btn-icon js-update-credit-limit"><i class="ti ti-share"></i></a>' +
                                    '</div>'
                                );
                            } else {
                                return (
                                    '<div class="d-inline-block">' +
                                    '<a href="'+baseUrl+'profile/'+full['seller_id']+'/view" class="btn btn-sm btn-icon" data-id=""><i class="ti ti-edit"></i></a>' +
                                    '</div>'
                                );
                            }
                        }
                    }
                }
            }
            ],
            order: [[2, 'desc']],
            // orderCellsTop: true,
            language: {
                sLengthMenu: '_MENU_',
                search: 'Ricerca',
                searchPlaceholder: 'Search..'
            },
            dom: '<"row datatable-custom-heading"<"col-6"l><"col-6 d-flex justify-content-end"f>><"table-responsive"t><"row datatable-custom-footer"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });
    }

    $(document).on('click', '.btn-approve', function () {
        var id = $(this).data('id');
        $("#credit-limit-form").trigger("reset");
        $("#credit-limit-form").attr("data-recordid", id);
        $("#save-seller-note").removeAttr('style');
        $("#save-credit-limit").attr('style','display:none !important');
    });

    $(document).on('click', '.js-update-credit-limit', function () {
        var id = $(this).data('id');
        $("#credit-limit-form").trigger("reset");
        $("#credit-limit-form").attr("data-recordid", id);
        $("#save-seller-note").attr('style','display:none !important');
        $("#save-credit-limit").removeAttr('style');
    });

    $(document).on('click', '.btn-approve-buyer-login', function () {
        var id = $(this).data('id');

        updateStatus(id, 'approved');
    });

    $(document).on('click', '.btn-reject', function () {
        var id = $(this).data('id');

        updateStatus(id, 'rejected');
    });

    $(document).on('click', '.btn-pending', function () {
        var id = $(this).data('id');

        updateStatus(id, 'pending');
    });

    $(document).on('click', '.change-customer-group', function () {
        var id = $(this).data('id');
        var status = $(this).find('option:selected').val();
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, `customer/${id}/group/${status}`),
            data: {},
            success: function success() {
                dt_filter.draw();
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    });

    function updateStatus(id, status, credit_limit = null){
        // sweetalert for confirmation of update status
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonText: `Yes, ${status} it!`,
        //     customClass: {
        //         confirmButton: 'btn btn-primary me-3',
        //         cancelButton: 'btn btn-label-secondary'
        //     },
        //     buttonsStyling: false
        // }).then(function (result) {
        //     if (result.value) {
        //         // update the status
                
        //     }
        // });
        var data = {};
        if(status == "approved"){
            data = {
                "credit_limit": credit_limit
            };
        }
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, `customer/${id}/status/${status}`),
            data: data,
            success: function success() {
                dt_filter.draw();
                $('#creditLimitModal').modal('hide');
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    }

    function updateCredit(id, credit_limit){
        var data = {
            "credit_limit": credit_limit,
            "only_update": "yes"
        };
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, `customer/${id}/status/approved`),
            data: data,
            success: function success() {
                dt_filter.draw();
                $('#creditLimitModal').modal('hide');
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    }

    // on key up from input field
    $('input.dt-input').on('keyup', function () {
        filterColumn($(this).attr('data-column'), $(this).val());
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 200);

    
    const productForm = document.querySelector('#credit-limit-form');
    // Form validation for Add new record
    if (productForm) {
        FormValidation.formValidation(productForm, {
            fields: {
                credit_limit: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter credit limit'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Please enter valid credit limit'
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
                rowSelector: '.col'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            }
            }).on('core.form.valid', function () {
            // Jump to the next step when all fields in the current step are valid
            // productForm.submit();
            var credit_limit = $("#credit_limit").val();
            var id = $("#credit-limit-form").attr("data-recordid");
            if($("#save-seller-note").attr("style")){
                //update
                updateCredit(id, credit_limit);
            } else {
                //approve
                updateStatus(id, 'approved', credit_limit);
            }
            });
    }
});