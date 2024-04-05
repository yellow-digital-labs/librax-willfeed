/**
 * Edit User
 */

'use strict';

function openEditUserModal() {
  $('#edit-seller-profile').modal('show');
}

function validateAndSubmit(userId) {
  var rejectionReason = document.getElementById("rejectionReason").value.trim();
  var errorField = document.getElementById("rejectionReasonError");

  if (rejectionReason === "") {
    errorField.textContent = "Please enter a rejection reason.";
    return;
  }

  const rejectReason = new FormData();
  rejectReason.append('reject_reason', rejectionReason);
  $.ajax({
    url: `${baseUrl}reject/${userId}/data`,
    method: 'POST',
    data: rejectReason,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      $('#reject-user-data').modal('hide');
      Swal.fire({
        text: "Rejected Data submitted",
        icon: 'success',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      })
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      $('#reject-user-data').modal('hide');
      Swal.fire({
        text: "Error while rejecting Data",
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      })
    }
  });

}

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    $(document).on('click', '.user-approve-btn', function (e) {
      let userId = $(this).data('user-id');
      $.ajax({
        url: `${baseUrl}approve/${userId}/data`,
        method: 'POST',
        success: function (response) {
          console.log(response);
          $('#edit-seller-profile').modal('hide');
          Swal.fire({
            text: "edited request submitted",
            icon: 'success',
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          })
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          $('#edit-seller-profile').modal('hide');
          Swal.fire({
            text: "Error while Submitting response",
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          })
        }
      });
    });
    $(document).on('click', '.user-Refuse-btn', function (e) {
      $('#reject-user-data').modal('show');
    });
  })();
});
