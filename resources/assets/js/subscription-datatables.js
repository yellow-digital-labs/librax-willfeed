/**
 * DataTables Advanced (jquery)
 */

'use strict';

$(function() {
    var dt_filter_table = $('.dt-column-search');

    // Column Search
    // --------------------------------------------------------------------

    if (dt_filter_table.length) {

        var dt_filter = dt_filter_table.DataTable({
            ajax: assetsPath + 'json/table-datatable.json',
            columns: [
                { data: 'id' },
                { data: 'email' },
                { data: 'email' },
                { data: '' }
            ],
            columnDefs: [{
                // Actions
                targets: -1,
                title: 'Azione',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="d-inline-block">' +
                        '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow me-3" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                        '<div class="dropdown-menu dropdown-menu-end m-0">' +
                        '<a href="javascript:;" class="dropdown-item">Details</a>' +
                        '<a href="javascript:;" class="dropdown-item">Archive</a>' +
                        '<div class="dropdown-divider"></div>' +
                        '<a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a>' +
                        '</div>' +
                        '</div>' +
                        '<a href="javascript:;" class="item-edit text-body"><i class="text-primary ti ti-pencil"></i></a>'
                    );
                }
            }],
            orderCellsTop: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });
    }
});