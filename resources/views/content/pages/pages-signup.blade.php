@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Register Basic - Pages')
@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection
@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection
@section('content')
    
<header class="auth-header">
    <a href="/" class="auth-header__logo">
        <img src="assets/img/weelfeed-brand-logo-white.svg">
    </a>
</header>

<div class="container-xxl singup">
    <div class="authentication-wrapper container-p-y singup__wrapper">
        <div class="authentication-inner py-4 singup__inner">

            <h1 class="mb-5 pt-2 text-center text-black text-uppercase singup__maintitle">benvenuto</h1>

            <!-- Register Card -->
            <div class="card singup__card">
                <div class="card-body singup__cardbody ">

                    <h4 class="mb-1 pt-2 text-center singup__title">Crea il tuo account👋</h4>
                    <p class="mb-5 text-center singup__text">Inizia ad usare la piattaforma Willfeed in un lampo</p>

                    <form id="formAuthentication" class="mb-3 singup__form" action="{{url('/')}}" method="POST">

                        <div class="mb-3">
                            <label for="account-type" class="form-label">Tipo Account</label>
                            <select class="form-select" id="account-type" name="accountType">
                                <option value="" selected>Please select</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="confirm-password">Confirm password</label>
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>

                        <button class="btn btn-dark d-grid w-100">
                            Crea Account
                        </button>
                    </form>

                </div>
            </div>
            <!-- Register Card -->

            <div class="singup__footer">
                <p class="text-center">
                    <span>Hai già un account?</span>
                    <a href="#">
                        <span>Entra</span>
                    </a>
                </p>
            </div>
             
        </div>
    </div>
</div>
@endsection