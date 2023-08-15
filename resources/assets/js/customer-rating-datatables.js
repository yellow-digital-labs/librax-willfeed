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
                        '<a href="javascript:;" class="btn btn-primary"  data-bs-toggle="offcanvas" data-bs-target="#add-new-record">Update</a>' +
                        '</div>'
                    );
                }
            }],
            orderCellsTop: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });
    }
});