'use strict';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(isShowRating){
      $("#basicModal").modal("show");
    }
});

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#paymentForm');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                    payment_type_id: {
                    validators: {
                      notEmpty: {
                        message: 'Please select payment type'
                      }
                    }
                  },
                  payment_amount: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter payment amount'
                      }
                    }
                  },
                  description: {
                    validators: {
                      notEmpty: {
                        message: 'Please enter payment note'
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
                    rowSelector: '.col-12'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
              }).on('core.form.valid', function () {
                // Jump to the next step when all fields in the current step are valid
                productForm.submit();
              });;
        }
    })();
});

$(".product-rating").on("click", function(){
  $("#rating_for").val($(this).data("seller"));
  var onChangeEvents = $('.onChange-event-ratings');
  onChangeEvents.rateYo({
    rtl: false,
    spacing: '8px'
  });
  $("#rating-form").trigger("reset");
});

$(".js-update-order-status").on("click", function(){
  $("#seller-note-form").attr("action", $(this).data("href"));
});

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
      const productForm = document.querySelector('#rating-form');
      // Form validation for Add new record
      if (productForm) {
          FormValidation.formValidation(productForm, {
              fields: {
                  rating: {
                      validators: {
                          notEmpty: {
                              message: 'Please select rating'
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
              console.log("submit")
              // Jump to the next step when all fields in the current step are valid
              // productForm.submit();

              $.ajax({
                  type: 'POST',
                  url: "/customer-rating/add",
                  data: $("#rating-form").serialize(),
                  success: function success(res) {
                      $("#basicModal").modal("toggle");
                      if(res.code == 200){
                          Swal.fire({
                              text: res.data,
                              icon: 'success',
                              showCancelButton: false,
                              customClass: {
                                  cancelButton: 'btn btn-label-secondary'
                              },
                              buttonsStyling: true
                          });

                          location.reload();
                      } else {
                          Swal.fire({
                              text: res.data,
                              icon: 'warning',
                              showCancelButton: false,
                              customClass: {
                                  cancelButton: 'btn btn-label-secondary'
                              },
                              buttonsStyling: true
                          });
                      }
                  },
                  error: function error(_error) {
                      $("#basicModal").modal("toggle");
                      Swal.fire({
                          text: 'Error! Please try again in some time.',
                          icon: 'warning',
                          showCancelButton: false,
                          customClass: {
                              cancelButton: 'btn btn-label-secondary'
                          },
                          buttonsStyling: true
                      });
                  }
              });
            });
      }
  })();
});

$(function () {
  var onChangeEvents = $('.onChange-event-ratings');
  var displayRating = $('.display-ratings');

  if (onChangeEvents) {
      onChangeEvents
      .rateYo({
          rtl: false,
          spacing: '8px'
      })
      .on('rateyo.change', function (e, data) {
          var rating = data.rating;
          $(this).parent().find('.counter').text(rating);
          $("#js-rating-val").val(rating);
      });
  }

  if(displayRating) {
    let displayRateOnLoad = $(displayRating).data("rating");
    displayRating
      .rateYo({
          rating: displayRateOnLoad,
          rtl: false,
          spacing: '8px'
      });
  }
});
$(".product-rating").on("click", function(){
  $("#rating_for").val($(this).data("seller"));
  var onChangeEvents = $('.onChange-event-ratings');
  onChangeEvents.rateYo({
      rtl: false,
      spacing: '8px'
  });
  $("#rating-form").trigger("reset");
});
