/**
 * Edit User
 */

'use strict';

function openEditUserModal() {
  $('#edit-user-profile').modal('show');
}

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    $(document).on("click", ".user-profile-edit-btn", () => {
      $('#edit-user-profile').modal('show');
    })
  })();
});
