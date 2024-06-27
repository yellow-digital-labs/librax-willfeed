(function webpackUniversalModuleDefinition(root, factory) {
    if (typeof exports === 'object' && typeof module === 'object')
        module.exports = factory();
    else if (typeof define === 'function' && define.amd)
        define([], factory);
    else {
        var a = factory();
        for (var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
    }
})(self, function () {
    return /******/ (function () { // webpackBootstrap
/******/ 	"use strict";
        var __webpack_exports__ = {};
        /*!***************************************************!*\
          !*** ./resources/js/laravel-farmer-management.js ***!
          \***************************************************/
        /**
         * Page User List
         */



        // Datatable (jquery)
        $(function () {
            console.log("here...")
            // Variable declaration for table
            var dt_user_table = $('.datatables-products'),
                select2 = $('.select2'),
                userView = urlListProductData;
            if (select2.length) {
                var $this = select2;
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Select Country',
                    dropdownParent: $this.parent()
                });
            }

            // ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Users datatable
            if (dt_user_table.length) {
                $('.datatables-farmers thead tr').clone(true).appendTo('.dt-column-search thead');
                $('.datatables-farmers thead tr:eq(1) th').each(function (i) {
                    var title = $(this).text();
                    if (title == "Status") {
                        $(this).html(`
        <select class="form-control">
          <option>All</option>
          <option>Pending</option>
          <option>Servey Completed</option>
        </select>`);
                    } else if (title == "Installer") {
                        let keys = Object.keys(filter_installer);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_installer[key].username}">${filter_installer[key].username}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "State") {
                        let keys = Object.keys(filter_state);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_state[key].name}">${filter_state[key].name}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "District") {
                        let keys = Object.keys(filter_district);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_district[key].name}">${filter_district[key].name}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "Block") {
                        let keys = Object.keys(filter_block);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_block[key].name}">${filter_block[key].name}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "Tehsil") {
                        let keys = Object.keys(filter_tehsil);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_tehsil[key].name}">${filter_tehsil[key].name}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "Village") {
                        let keys = Object.keys(filter_village);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_village[key].name}">${filter_village[key].name}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "Surveyor") {
                        let keys = Object.keys(filter_survey);
                        let html = ``;
                        keys.forEach((key) => {
                            html += `<option value="${filter_survey[key].username}">${filter_survey[key].username}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else if (title == "System Capacity") {
                        let html = ``;
                        filter_system_capacity.forEach((val) => {
                            html += `<option value="${val}">${val}</option>`;
                        })
                        $(this).html(`
        <select class="form-control select-filter">
          <option value="">All</option>
          ${html}
        </select>`);
                    } else {
                        $(this).html('');
                    }

                    $('input', this).on('keyup change', function () {
                        if (dt_user.column(i).search() !== this.value) {
                            dt_user.column(i).search(this.value).draw();
                        }
                    });

                    $('select', this).on('change', function () {
                        if (dt_user.column(i).search() !== this.value) {
                            dt_user.column(i).search(this.value).draw();
                        }
                    });
                });
                var dt_user = dt_user_table.DataTable({
                    processing: true,
                    serverSide: true,
                    orderCellsTop: true,
                    bLengthChange: true,
                    ajax: {
                        url: urlListProductData,
                    },
                    columns: [
                        // columns according to JSON
                        {
                            data: 'name'
                        }, {
                            data: 'active'
                        }, {
                            data: ''
                        }],
                    columnDefs: [{
                        // Actions
                        targets: 2,
                        searchable: false,
                        orderable: false,
                        render: function render(data, type, full, meta) {
                            return '<div class="d-inline-block text-nowrap">' + "<a href=\"/admin/product/" + full['id'] + "/edit\" class=\"btn btn-sm btn-icon\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-edit\"></i></a>") + "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"ti ti-trash\"></i></button>") + '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' + userView + '" class="dropdown-item">View</a>' + '<a href="javascript:;" class="dropdown-item">Suspend</a>' + '</div>' + '</div>';
                        }
                    }, {
                        // name
                        targets: 0,
                        // visible: false,
                        searchable: true,
                        orderable: true,
                        responsivePriority: 4,
                        render: function render(data, type, full, meta) {
                            var $name = full['name'] ? full['name'] : '';
                            return '<span class="user-name">' + $name + '</span>';
                        }
                    }, {
                        // active
                        targets: 1,
                        // visible: false,
                        searchable: true,
                        orderable: true,
                        responsivePriority: 4,
                        render: function render(data, type, full, meta) {
                            var $active = full['active'] ? full['active'] : '';
                            return '<span class="badge text-uppercase bg-label-'+($active=='yes'?'success':'danger')+'">' + $active + '</span>';
                        }
                    }],
                    order: [[2, 'desc']],
                    dom: '<"row mx-2 product-list-header"' + '<"col-md-2 col-auto product-list-page-col"<"datatable-toolbar"l>>' + '<"col-md-10 col product-list-action-col"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-row mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2 product-list-footer"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
                    language: {
                        sLengthMenu: '_MENU_',
                        search: 'Ricerca',
                        searchPlaceholder: 'Search..'
                    },
                    // Buttons with Dropdown
                    buttons: [{
                        text: '<i class="ti ti-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Aggiungi prodotto</span>',
                        className: 'add-new btn btn-primary ms-3',
                        action: function action(e, dt, node, config) {
                            window.location.href = urlCreateProductView;
                        }
                    }]
                });
            }

            // Delete Record
            $(document).on('click', '.delete-record', function () {
                var user_id = $(this).data('id'),
                    dtrModal = $('.dtr-bs-modal.show');

                // hide responsive modal in small screen
                if (dtrModal.length) {
                    dtrModal.modal('hide');
                }

                // sweetalert for confirmation of delete
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        // delete the data
                        $.ajax({
                            type: 'DELETE',
                            url: "".concat(baseUrl, "admin/product/").concat(user_id),
                            success: function success(res) {
                                dt_user.draw();
                                if(res.code == 200){
                                    // success sweetalert
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: res.message,
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Cancelled',
                                        text: res.message,
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                }
                            },
                            error: function error(_error) {
                                console.log(_error);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'The product is not deleted!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            });

            // edit record
            $(document).on('click', '.edit-record', function () {
                var user_id = $(this).data('id'),
                    dtrModal = $('.dtr-bs-modal.show');

                // hide responsive modal in small screen
                if (dtrModal.length) {
                    dtrModal.modal('hide');
                }

                // changing the title of offcanvas
                $('#offcanvasAddUserLabel').html('Edit User');

                // get data
                $.get("".concat(baseUrl, "user-list/").concat(user_id, "/edit"), function (data) {
                    $('#user_id').val(data.id);
                    $('#add-user-fullname').val(data.name);
                    $('#add-user-email').val(data.email);
                });
            });

            // changing the title
            $('.add-new').on('click', function () {
                $('#user_id').val(''); //reseting input field
                $('#offcanvasAddUserLabel').html('Add User');
            });

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(function () {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 300);
            var phoneMaskList = document.querySelectorAll('.phone-mask');

            // Phone Number
            if (phoneMaskList) {
                phoneMaskList.forEach(function (phoneMask) {
                    new Cleave(phoneMask, {
                        phone: true,
                        phoneRegionCode: 'US'
                    });
                });
            }
        });
/******/ 	return __webpack_exports__;
        /******/
})()
        ;
});