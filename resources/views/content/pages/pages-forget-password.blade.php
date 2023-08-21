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

                    <h4 class="mb-1 pt-2 text-center singup__title">Forgot Password? 🔒</h4>
                    <p class="mb-5 text-center singup__text">Enter your email, and we'll send you instructions to reset your password</p>

                    <form id="formAuthentication" class="mb-3 singup__form" action="{{url('/')}}" method="POST">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>

                        <button type="submit" class="btn btn-dark d-grid w-100">
                            Send Reset Link
                        </button>
                        
                        <div class="singup__footer">
                            <p class="text-center">
                                <a href="#" class="text-dark"><i class="ti ti-chevron-left ti-xs me-sm-1 me-0"></i> Back to log in</a>  
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