@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Subscription Plan')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    var urlListSubscribeData = {!! "'".$urlListSubscribeData."'" !!};
</script>
<script src="{{asset('assets/js/subscription-datatables.js')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Subscription Plan</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom align-items-center">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Plans list</h5>
        </div>
        
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th>Plan name</th>
                    <th>price</th>
                    <th>description</th>
                    <th>Azione</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="exampleModalLabel">Add plan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form method="POST" class="add-new-record pt-0 row g-4" id="form-add-new-record">
            @csrf
            <input type="hidden" name="id" id="edit-id">
            <div class="col-sm-12">
                <label class="form-label" for="edit-name">Plan name</label>
                <input type="text" id="edit-name" class="form-control" name="name" placeholder="Enter plan name" />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-tagline">Tagline</label>
                <input type="text" id="edit-tagline" class="form-control" name="tagline" placeholder="Enter tagline" />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-amount">Plan price</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">€</span>
                    <input type="mumber" id="edit-amount" name="amount" class="form-control dt-post" placeholder="0,00" step=".01" />
                </div>
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-description">Description</label>
                <textarea class="form-control" placeholder="Enter description" id="edit-description" name="description" rows="4"></textarea>
            </div>
            <div class="form-check form-switch col-sm-12">
                <label class="form-check-label" for="edit-status">Disponibilità</label>
                <input class="form-check-input" type="checkbox" name="status" id="edit-status" value="active">
            </div>
            <div class="col-sm-12 mt-5">
                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection
