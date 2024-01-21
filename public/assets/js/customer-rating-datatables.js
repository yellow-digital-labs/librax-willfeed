/**
 * DataTables Advanced (jquery)
 */

'use strict';

$(function() {
    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dt_filter_table = $('.dt-column-search');

    // Column Search
    // --------------------------------------------------------------------

    if (dt_filter_table.length) {

        $('.dt-column-search thead tr').clone(true).appendTo('.dt-column-search thead');
        $('.dt-column-search thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if ($(this).hasClass('js-add-search')) {
                $(this).html('<input type="text" class="form-control" placeholder="Cerca ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (dt_filter.column(i).search() !== this.value) {
                        dt_filter.column(i).search(this.value).draw();
                    }
                });
            }
            else {
                $(this).html('');
            }
        });

        var dt_filter = dt_filter_table.DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            bLengthChange: true,
            oLanguage: {
                oPaginate: {
                    sPrevious: "Precednte",
                    sNext: "Prossimo",
                },
                info: "Visualizza _START_ di _END_ of _TOTAL_ Risultati",
                zeroRecords: "nessun account trovato"
            },
            ajax: {
                url: urlListRatingData 
            },
            columns: [
                { data: 'review_by_name' },
                { data: 'review_for_name' },
                { data: 'star' },
                { data: 'status' },
                { data: 'created_at' }
            ],
            columnDefs: [{
                // review_by_name
                targets: 0,
                // visible: false,
                searchable: true,
                orderable: false,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $review_by_name = full['review_by_name'] ? full['review_by_name'] : '';
                    return '<span class="user-review_by_name">' + $review_by_name + '</span>';
                }
            }, {
                // review_for_name
                targets: 1,
                // visible: false,
                searchable: true,
                orderable: false,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $review_for_name = full['review_for_name'] ? full['review_for_name'] : '';
                    return '<span class="user-review_for_name">' + $review_for_name + '</span>';
                }
            }, {
                // star
                targets: 2,
                // visible: false,
                searchable: true,
                orderable: false,
                responsivePriority: 4,
                render: function render(data, type, full, meta) {
                    var $star = full['star'] ? full['star'] : '';
                    return '<div class="read-only-ratings" data-rateyo-read-only="true" data-rateyo-rating="'+$star+'" data-rateyo-star-width="20px"></div>';
                }
            }, {
                // status
                targets: 3,
                render: function (data, type, full, meta) {
                    var $status_number = full['status'];
                    var $status = {
                        'pending': { title: 'Pending', class: 'bg-label-primary' },
                        'approve': { title: 'Approved', class: ' bg-label-success' },
                        'reject': { title: 'Rejected', class: ' bg-label-danger' }
                    };
                    if (typeof $status[$status_number] === 'undefined') {
                        return data;
                    }
                    return (
                        '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                    );
                }
            },
            {
                // Actions
                targets: 4,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    var status_number = full['status'];
                    var id = full['id'];
                    let statusList = "";
                    if(status_number != "pending") {
                        statusList += `<a href="javascript:;" class="dropdown-item btn-pending" data-id="${id}">Pending</a>`;
                    }
                    if(status_number != "approve") {
                        statusList += `<a href="javascript:;" class="dropdown-item btn-approve" data-id="${id}">Approve</a>`;
                    }
                    if(status_number != "reject") {
                        statusList += `<a href="javascript:;" class="dropdown-item btn-reject" data-id="${id}">Reject</a>`;
                    }
                    return (
                        '<div class="d-inline-block">' +
                        '<a href="javascript:;" class="btn btn-sm btn-icon edit-record" data-id="'+full['id']+'" data-bs-toggle="offcanvas" data-bs-target="#add-new-record"><i class="ti ti-edit"></i></a>' +
                        '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                        '<div class="dropdown-menu dropdown-menu-end m-0">' +
                        statusList +
                        '</div>'
                    );
                }
            },
            {
                // Actions
                targets: 5,
                title: 'Actions',
                searchable: false,
                orderable: false,
                visible: false,
                render: function (data, type, full, meta) {
                    return "";
                }
            }
            ],
            order: [[5, 'desc']],
            // orderCellsTop: true,
            language: {
                sLengthMenu: '_MENU_',
                search: 'Ricerca',
                searchPlaceholder: 'Search..'
            },
            dom: '<"row datatable-custom-heading"<"col-6"l><"col-6 d-flex justify-content-end"f>><"table-responsive"t><"row datatable-custom-footer"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            initComplete: function(settings, json){
                $('.read-only-ratings').rateYo();
            },
            drawCallback: function(settings) {
                $('.read-only-ratings').rateYo();
            }
        });
    }

    $(document).on('click', '.btn-approve', function () {
        var id = $(this).data('id');

        updateStatus(id, 'approve');
    });

    $(document).on('click', '.btn-reject', function () {
        var id = $(this).data('id');

        updateStatus(id, 'reject');
    });

    $(document).on('click', '.btn-pending', function () {
        var id = $(this).data('id');

        updateStatus(id, 'pending');
    });

    $(document).on('click', '.data-submit', function(){
        let id = $('#edit-id').val();
        let status = $('#edit-status option:selected').val();
        updateStatus(id, status, true);
    });

    function updateStatus(id, status, isModel = false){
        // sweetalert for confirmation of update status
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonText: `Yes, ${status} it!`,
        //     customClass: {
        //         confirmButton: 'btn btn-primary me-3',
        //         cancelButton: 'btn btn-label-secondary'
        //     },
        //     buttonsStyling: false
        // }).then(function (result) {
        //     if (result.value) {
        //         // update the status
                
        //     }
        // });
        $.ajax({
            type: 'POST',
            url: "".concat(baseUrl, `customer-rating/${id}/status/${status}`),
            success: function success() {
                dt_filter.draw();
                if(isModel){
                    bootstrap.Offcanvas.getInstance("#add-new-record").toggle();
                }
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    }
});

// edit record
$(document).on('click', '.edit-record', function () {
    var user_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // get data
    $.get("".concat(baseUrl, "customer-rating/").concat(user_id, "/edit"), function (data) {
        if(data.code == 200){
            $('#edit-id').val(data.data.id);
            $('#edit-review_by_name').val(data.data.review_by_name);
            $('#edit-review_for_name').val(data.data.review_for_name);
            $('#edit-review_text').val(data.data.review_text);
            $('#edit-status').val(data.data.status);
            $('#edit-created_at').val(data.data.created_at);

            // $('.edit-star').data("rateyo-rating", data.data.star);

            var $instance = $('.edit-star').rateYo();

            $instance.rateYo('rating', data.data.star);
        } else {
            
        }
    });
});