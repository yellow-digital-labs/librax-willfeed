@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Login')
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

            <h1 class="mb-5 pt-2 text-center text-black text-uppercase singup__maintitle">benvenuto</h1>

            <!-- Register Card -->
            <div class="card singup__card">
                <div class="card-body singup__cardbody ">

                    <h4 class="mb-1 pt-2 text-center singup__title">Accedi al tuo account <img src="{{asset('assets/img/icons/handshake.png')}}" width="20" height="20"></h4>
                    <p class="mb-5 text-center singup__text">Inizia ad usare la piattaforma Willfeed in un lampo</p>

                    @if ($errors->any())
                    <p class="text-danger text-center" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </p>
                    @endif

                    <form id="formAuthentication" class="mb-3 singup__form" action="{{url('/login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Inserisci email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>Password dimenticata?</small>
                            </a>
                            @endif
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        </div>

                        <button class="btn btn-dark d-grid w-100">
                            Accedi all'account
                        </button>
                    </form>

                </div>
            </div>
            <!-- Register Card -->

            @if (!$isAdmin)
            <div class="singup__footer">
                <p class="text-center">
                    <span>Non hai un account?</span>
                    <a href="{{route('register')}}">
                        <span>Crea account</span>
                    </a>
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection