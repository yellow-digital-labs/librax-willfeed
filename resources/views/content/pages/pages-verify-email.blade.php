@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Verify Email')
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
<script src="{{asset('assets/js/pages-auth.js?version=1')}}"></script>
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
                    <h4 class="mb-1 pt-2 text-center singup__title">Verifica di sicurezza <img src="{{asset('assets/img/icons/email.png')}}" width="20" height="20"></h4>

                    @if ($errors->any())
                    <p class="text-danger text-center" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </p>
                    @endif
                    
                    <p class="mb-5 text-center singup__text">Un link di verifica è stato inviato alla tua email <strong>{{$email}}</strong>, clicca sul link per verificare la tua email.</p>

                    <form id="formAuthentication" class="mb-3 singup__form" action="{{url('/')}}" method="POST">
                        <div class="singup__footer">
                            <p class="text-center">
                            Non hai rievuto l'email? <a href="{{route('resend-verify-email')}}" class="text-dark">Reinvia</a>  
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