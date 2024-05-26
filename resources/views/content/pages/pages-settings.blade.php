@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Account')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/settings.js?version=1') }}"></script>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h1 class="h3 text-black mb-4">Account</h1>

    <div class="mb-4">
        @livewire('profile.update-password-form')
    </div>

    <div class="card">
        <h5 class="card-header"> Cambia email </h5>
        <div class="card-body pt-4">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-danger text-center" role="alert">
                        {{ $error }}
                    </p>
                @endforeach
            @endif

            <form method="POST" action="{{ route('email.sendVerificationLink') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Nuova email</label>
                            <input type="email" name="new_email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="password">Password attuale</label>
                            <input type="password" name="confirm_password" id="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div  class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Aggiorna email</button>
                </div>
            </form>
        </div>
    </div>



@endsection
