@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Forget Password')
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
    <a href="{{route("pages-home")}}" class="auth-header__logo">
        <img src="{{asset("/assets/img/weelfeed-brand-logo-white.svg")}}">
    </a>
</header>

<div class="container-xxl singup">
    <div class="authentication-wrapper container-p-y singup__wrapper">
        <div class="authentication-inner py-4 singup__inner">

            <!-- <h1 class="mb-5 pt-2 text-center text-black text-uppercase singup__maintitle">benvenuto</h1> -->

            <!-- Register Card -->
            <div class="card singup__card">
                <div class="card-body singup__cardbody ">

                    <h4 class="mb-1 text-center singup__title">Reset Password <img src="{{asset('assets/img/icons/lock.png')}}" width="20" height="20"></h4>
                    <p class="mb-5 text-center singup__text">for john.doe@email.com</p>

                    <form id="formAuthentication" class="mb-3 singup__form" action="{{url('/')}}" method="POST">

                        <div class="mb-3">
                            <label class="form-label" for="password">New Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="confirm-password">Confirm password</label>
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>

                        <button type="submit" class="btn btn-dark d-grid w-100">
                            Set New Password
                        </button>

                        <div class="singup__footer">
                            <p class="text-center">
                                <a href="#" class="text-dark"><i class="ti ti-chevron-left ti-xs me-sm-1 me-0"></i>Back to log in</a>  
                            </p>
                        </div>
                    </form>

                </div>
            </div>
            <!-- Register Card -->
             
        </div>
    </div>
</div>
@endsection