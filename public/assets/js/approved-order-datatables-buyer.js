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
                $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');

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
            ajax: {
                url: urlListOrderData 
            },
            columns: [
                { data: 'seller_name' },
                { data: 'product_name' },
                { data: 'product_qty' },
                { data: 'order_date' },
                { data: 'order_status' },
                { data: 'payment_status' },
                { data: '' }
            ],
            columnDefs: [{
                // seller_name
                targets: 0,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $seller_name = full['seller_name'] ? full['seller_name'] : '';
                    return '<span class="user-seller_name">' + $seller_name + '</span>';
                }
            }, {
                // product_name
                targets: 1,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $product_name = full['product_name'] ? full['product_name'] : '';
                    return '<span class="user-product_name">' + $product_name + '</span>';
                }
            }, {
                // product_qty
                targets: 2,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $product_qty = full['product_qty'] ? full['product_qty'] : '';
                    return '<span class="user-product_qty">' + $product_qty + '</span>';
                }
            }, {
                // order_date
                targets: 3,
                // visible: false,
                searchable: true,
                orderable: true,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $order_date = full['order_date'] ? full['order_date'] : '';
                    return '<span class="user-order_date">' + $order_date + '</span>';
                }
            }, {
                // Label
                targets: 4,
                render: function (data, type, full, meta) {
                    var $status_number = full['order_status'];
                    console.log("status_number", $status_number)
                    var $status = {
                        'Pending': { title: 'Pending', class: 'bg-label-primary' },
                        'Approved': { title: 'Approved', class: ' bg-label-success' },
                        'Rejected': { title: 'Rejected', class: ' bg-label-danger' }
                    };
                    if (typeof $status[$status_number] === 'undefined') {
                        return data;
                    }
                    return (
                        '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                    );
                }
            }, {
                // Payment Status
                targets: 5,
                render: function (data, type, full, meta) {
                    var $status_number = full['payment_status'];
                    var $status = {
                        'unpaid': { title: 'Unpaid', class: 'bg-label-danger' },
                        'paid': { title: 'Paid', class: ' bg-label-success' }
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
                targets: 6,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    var id = full['id'];
                    return (
                        '<div class="d-inline-block">' +
                        `<a href="/order/detail/${id}" class="btn btn-sm btn-icon dropdown-toggle hide-arrow btn-edit-order"><i class="text-primary ti ti-pencil"></i></a>`
                    );
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
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-start justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
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
});