@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Account')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/product-detail.js')}}"></script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Account</h1>


<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Cambia password</h5>
        </div>
    </div>
    <div class="card-body pt-4">
        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label" for="attuale">Password attuale</label>
                <input type="text" name="business_name" id="attuale" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
            </div>

        </div>
        <div class="row g-3 mt-2">

            <div class="col-md-4">
                <label class="form-label" for="Nuova">Nuova Password</label>
                <input type="text" name="business_name" id="Nuova" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
            </div>

            <div class="col-md-4">
                <label class="form-label" for="Conferma">Conferma password</label>
                <input type="text" name="business_name" id="Conferma" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
            </div>

        </div>

        <p class="text-black fw-semibold mt-4">Requisiti password:</p>
        <ul class="mb-5">
            <li>
                Minimum 8 characters long - the more, the better
            </li>
            <li>
                At least one lowercase character
            </li>
            <li>
                At least one number, symbol, or whitespace character
            </li>
        </ul>

        <a href="#" class="btn btn-primary me-3">Aggiorna password</a>

        <a href="#" class="btn btn-outline-dark">Annulla</a>

    </div>
</div>




@endsection