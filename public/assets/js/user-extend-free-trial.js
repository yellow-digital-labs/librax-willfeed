/**
 * User Extend Free Trial - Javascript
 */
'use strict';

(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function () {
    $(document).on('click', '.user-extend-free-trial-btn', function () {
      var userId = $(this).data('user-id');

      Swal.fire({
        text: "Are you sure you want to extend the free trial period?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type: 'POST',
            url: baseUrl + `user/${userId}/extend-free-trial`,
            success: function () {
              Swal.fire({
                text: "30 free trial period has been extended successfully.",
                icon: 'success',
                customClass: {
                  confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
              }).then(function () {
                // Reload the page or perform any other action
                location.reload();
              });
            },
            error: function (error) {
              Swal.fire({
                text: "An error occurred while extending the free trial period.",
                icon: 'error',
                customClass: {
                  confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
              });
              console.log("Error:", error);
            }
          });
        }
      });
    });
  });

})();
