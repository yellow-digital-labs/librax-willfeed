/**
 * Form Picker
 */

'use strict';

// * Pickers with jQuery dependency (jquery)
$(function () {
  // Bootstrap Daterange Picker
  // --------------------------------------------------------------------
  var bsRangePickerRange = $('#bs-rangepicker-range');

  if (bsRangePickerRange.length) {
    bsRangePickerRange.daterangepicker({
      locale: {
        format: "DD-MM-YYYY"
      },
      ranges: {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    });

    bsRangePickerRange.on("apply.daterangepicker", function(ev, picker){
      $("#dashboard-form").submit();
    });
  }
});
