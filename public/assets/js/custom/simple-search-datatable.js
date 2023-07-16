
/**
 * DataTables Advanced (jquery)
 */

'use strict';

$(function() {
    var dt_filter_table = $('.dt-column-search'),
        dt_with_actions = $('.has-actions-td'),
        startDateEle = $('.start_date'),
        endDateEle = $('.end_date');

    // Column Search
    // --------------------------------------------------------------------

    if (dt_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
        $('.dt-column-search thead tr:eq(1) th').each(function(i) {
            var selItem = $(this);
            var title = $(this).text();
            var thLength = $('.dt-column-search thead tr:eq(1) th').length;

            
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (dt_filter.column(i).search() !== this.value) {
                    dt_filter.column(i).search(this.value).draw();
                }
            });

            console.log('i', i);

            if (dt_with_actions.length > 0 && i === thLength-1) {
                console.log('$(selItem)', $(selItem));
                $(selItem).html('');
            }
        });

        var dt_filter = dt_filter_table.DataTable({
            orderCellsTop: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });

        if (dt_with_actions.length > 0) {
            $('.dt-column-search thead tr:eq(0) th:last-child').removeClass('sorting');
        }
    }
});