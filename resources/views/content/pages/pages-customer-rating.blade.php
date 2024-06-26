@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Feedback')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/rateyo/rateyo.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script>
    var urlListRatingData = {!! "'".$urlListRatingData."'" !!};
</script>
<script src="{{asset('assets/js/extended-ui-star-ratings.js?version=1')}}"></script>
<script src="{{asset('assets/js/customer-rating-datatables.js?version=1')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Feedback</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom align-items-center">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Lista feedback</h5>
        </div>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th class="js-add-search">Recensione di</th>
                    <th class="js-add-search">Recensione per</th>
                    <th>Valutazione</th>
                    <th class="js-add-search">Stato</th>
                    <th>Modifica</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="exampleModalLabel">Feedback</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-4" id="form-add-new-record" onsubmit="return false">
            <input type="hidden" id="edit-id">
            <div class="col-sm-12">
                <label class="form-label" for="edit-review_by_name">Inviata da</label>
                <input type="text" id="edit-review_by_name" class="form-control" placeholder="Enter inviata da" readonly />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-review_for_name">Ricevuta da</label>
                <input type="text" id="edit-review_for_name" class="form-control" placeholder="Enter ricevuta da" readonly />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-star">Punteggio</label>
                <div class="edit-star" data-rateyo-read-only="true" data-rateyo-star-width="20px"></div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-review_text">Commenti</label>
                <textarea class="form-control" placeholder="Enter commenti" id="edit-review_text" rows="4" readonly></textarea>
            </div>
            <div class="col-sm-12">
                <select id="edit-status" class="form-control" name="status">
                    <option value="pending">In attesa di approvazione</option>
                    <option value="approve">Approvata</option>
                    <option value="reject">Respinto</option>
                </select>
            </div>
            <div class="col-sm-12 mt-5">
                <button type="button" class="btn btn-primary data-submit me-sm-3 me-1">Approva</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Indietro</button>
            </div>
        </form>
    </div>
</div>

@endsection
