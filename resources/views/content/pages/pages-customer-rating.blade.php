@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Customer rating')

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
<script src="{{asset('assets/js/extended-ui-star-ratings.js')}}"></script>
<script src="{{asset('assets/js/customer-rating-datatables.js')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Customer rating</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom align-items-center">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Customer rating list</h5>
        </div>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th class="js-add-search">Review by</th>
                    <th class="js-add-search">Review for</th>
                    <th>Ratings</th>
                    <th class="js-add-search">Status</th>
                    <th>Created at</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="exampleModalLabel">Ratings</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-4" id="form-add-new-record" onsubmit="return false">
            <div class="col-sm-12">
                <label class="form-label" for="Planname">Customer name</label>
                <input type="text" id="Planname" class="form-control" name="Planname" placeholder="Enter customer name" />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="Planprice">Customer rating</label>
                <div class="basic-ratings"></div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="Description">Customer review</label>
                <textarea class="form-control" placeholder="Enter review" id="Description" rows="4"></textarea>
            </div>
            <div class="col-sm-12 mt-5">
                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Approved</button>
                <button type="button" class="btn btn-outline-secondary">Rejected</button>
            </div>
        </form>
    </div>
</div>

@endsection
