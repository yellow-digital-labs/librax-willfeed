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
<script src="{{asset('assets/js/settings.js?version=1')}}"></script>
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Account</h1>

<div class="mb-4">
    @livewire('profile.update-password-form')
</div>

{{-- <div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Cambia password</h5>
        </div>
    </div>
    <div class="card-body pt-4">
        @if ($errors->any())
        <p class="text-danger text-center" role="alert">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </p>
        @endif

        <form method="POST" id="settingForm" onsubmit="return false">
            @csrf
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label" for="old_password">Password attuale</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                </div>

            </div>
            <div class="row g-3 mt-2">

                <div class="col-md-4">
                    <label class="form-label" for="password">Nuova password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="confirm_password">Conferma password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                </div>

            </div>

            <p class="text-black fw-semibold mt-4">Requisiti password:</p>
            <ul class="mb-5">
                <li>
                    Minimum 8 characters long - the more, the better
                </li>
                <li>
                    At least one uppercase character
                </li>
                <li>
                    At least one number and symbol
                </li>
            </ul>

            <button type="submit" class="btn btn-primary me-3">Aggiorna password</button>

            <a href="#" class="btn btn-outline-dark">Annulla</a>
        </form>
    </div>
</div> --}}




@endsection