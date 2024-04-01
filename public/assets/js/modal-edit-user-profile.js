/**
 * Edit User
 */

'use strict';

function openEditUserModal() {
  console.log('edit modal script ')
  $('#edit-user-profile').modal('show');
}

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // variables

    $(". user-profile-edit-btn", "click", () => {
      $('#edit-user-profile').modal('show');
    })
    const modalEditUserTaxID = document.querySelector('.modal-edit-tax-id');
    const modalEditUserPhone = document.querySelector('.phone-number-mask');

    // // Prefix
    // if (modalEditUserTaxID) {
    //   new Cleave(modalEditUserTaxID, {
    //     prefix: 'TIN',
    //     blocks: [3, 3, 3, 4],
    //     uppercase: true
    //   });
    // }

    // // Phone Number Input Mask
    // if (modalEditUserPhone) {
    //   new Cleave(modalEditUserPhone, {
    //     phone: true,
    //     phoneRegionCode: 'US'
    //   });
    // }

    // // Edit user form validation
    // FormValidation.formValidation(document.getElementById('editUserForm'), {
    //   fields: {
    //     modalEditUserFirstName: {
    //       validators: {
    //         notEmpty: {
    //           message: 'Please enter your first name'
    //         },
    //         regexp: {
    //           regexp: /^[a-zA-Zs]+$/,
    //           message: 'The first name can only consist of alphabetical'
    //         }
    //       }
    //     },
    //     modalEditUserLastName: {
    //       validators: {
    //         notEmpty: {
    //           message: 'Please enter your last name'
    //         },
    //         regexp: {
    //           regexp: /^[a-zA-Zs]+$/,
    //           message: 'The last name can only consist of alphabetical'
    //         }
    //       }
    //     },
    //     modalEditUserName: {
    //       validators: {
    //         notEmpty: {
    //           message: 'Please enter your username'
    //         },
    //         stringLength: {
    //           min: 6,
    //           max: 30,
    //           message: 'The name must be more than 6 and less than 30 characters long'
    //         },
    //         regexp: {
    //           regexp: /^[a-zA-Z0-9 ]+$/,
    //           message: 'The name can only consist of alphabetical, number and space'
    //         }
    //       }
    //     }
    //   },
    //   plugins: {
    //     trigger: new FormValidation.plugins.Trigger(),
    //     bootstrap5: new FormValidation.plugins.Bootstrap5({
    //       // Use this for enabling/changing valid/invalid class
    //       // eleInvalidClass: '',
    //       eleValidClass: '',
    //       rowSelector: '.col-12'
    //     }),
    //     submitButton: new FormValidation.plugins.SubmitButton(),
    //     // Submit the form when all fields are valid
    //     // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
    //     autoFocus: new FormValidation.plugins.AutoFocus()
    //   }
    // });
  })();
});
