/**
 * Form Picker
 */

'use strict';

// * Pickers with jQuery dependency (jquery)
$(function () {
  // Bootstrap Daterange Picker
  // --------------------------------------------------------------------
  var bsRangePickerRange = $('#bs-rangepicker-range');
  var bsRangePickerRangeRevenue = $('#bs-rangepicker-range-revenue');
  var bsRangePickerRangeProduct = $('#bs-rangepicker-range-product');
  var bsRangePickerRangeVendor = $('#bs-rangepicker-range-vendor');

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

  if(bsRangePickerRangeRevenue.length){
    bsRangePickerRangeRevenue.daterangepicker({
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

    bsRangePickerRangeRevenue.on("apply.daterangepicker", function(ev, picker){
      $("#dashboard-form").submit();
    });
  }

  if(bsRangePickerRangeProduct.length){
    bsRangePickerRangeProduct.daterangepicker({
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

    bsRangePickerRangeProduct.on("apply.daterangepicker", function(ev, picker){
      $("#dashboard-form").submit();
    });
  }

  if(bsRangePickerRangeVendor.length){
    bsRangePickerRangeVendor.daterangepicker({
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

    bsRangePickerRangeVendor.on("apply.daterangepicker", function(ev, picker){
      $("#dashboard-form").submit();
    });
  }
});
