@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Multi Steps Sign-up - Pages')
@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection
@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('assets/js/custom/signup-seller-validations.js')}}"></script>
@endsection
@section('content')
    
<header class="auth-header">
    <a href="/" class="auth-header__logo">
        <img src="/assets/img/weelfeed-brand-logo-white.svg">
    </a>
</header>

<div class="signup-wiz">
    <div class="authentication-wrapper signup-wiz__wrapper">
        <div class="authentication-inner signup-wiz__inner">

            <h1 class="mb-5 pt-2 text-center text-black text-uppercase signup-wiz__maintitle">REGISTRAZIONE VENDITORE</h1>

            <div id="multiStepsValidation" class="bs-stepper shadow-none linear signup-wiz__stepper">

                <div class="bs-stepper-header border-bottom-0 signup-wiz__header">
                    <div class="step active signup-wiz__step" data-target="#SignupStepRegistry">
                        <button type="button" class="step-trigger signup-wiz__trigger" aria-selected="true">
                            <span class="bs-stepper-circle"><i class="ti ti-smart-home ti-sm"></i></span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Anagrafica</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step signup-wiz__step" data-target="#SignupStepDestination">
                        <button type="button" class="step-trigger signup-wiz__trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle"><i class="wf-icon wf-icon-location"></i></span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Operatività</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step signup-wiz__step" data-target="#SignupStepBilling">
                        <button type="button" class="step-trigger signup-wiz__trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle"><i class="ti ti-file-text ti-sm"></i></span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Fatturazione</span>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="bs-stepper-content signup-wiz__body">
                    <form id="multiStepsForm" onsubmit="return false" class="signup-wiz__form">
                        <!-- Registry -->
                        <div id="SignupStepRegistry" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header mb-4">
                                <h3 class="signup-wiz__name">Informazioni societarie</h3>
                            </div>
                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label class="form-label" for="">Ragione sociale *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Inserisci ragione sociale" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Partita IVA *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Inserisci numero di partita IVA" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Cellulare referente *</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31">+39 </span>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">PEC *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="latuaemail@pec.it" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Codice fiscale *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Inserisci il codice fiscale" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Nominativo Amministratore *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Mario Rossi" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Attività principale *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona attività principale</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Indirizzo *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Via Battisti " />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Numero civico *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Inserisci il numero civico" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Comune *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona comune</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Provincia *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona provincia</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">CAP *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Inserisci il CAP" />
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <!-- <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Indietro</span>
                                    </button> -->
                                    <button class="btn btn-dark btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Avanti</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Destination -->
                        <div id="SignupStepDestination" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header mb-4">
                                <h3 class="signup-wiz__name">Informazioni operative</h3>
                            </div>
                            <div class="row g-3">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Capacità di stoccaggio *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona facilità di accesso</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Limiti di capacità ordini *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona i limiti</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Prodotti disponibili *</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona prodotti </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Copertura geografica regioni</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona le regioni coperte</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Copertura geografica province</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona prodotti </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Tempo limite ordine giornaliero</label>
                                    <select name="" id="" class="form-select">
                                        <option>Seleziona limite</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-4">
                                    <button class="btn btn-outline-dark btn-prev waves-effect"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Indietro</span>
                                    </button>
                                    <button class="btn btn-dark btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Avanti</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Billing -->
                        <div id="SignupStepBilling" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header">
                                <h3 class="signup-wiz__name">Metodi di pagamento accettati</h3>
                            </div>

                            <div class="row g-3">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Bonifico Bancario *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="IBAN" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">Assegno Bancario *</label>
                                    <input type="text" name="" id="" class="form-control" placeholder="Intestazione assegno" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <input type="text" name="" id="" class="form-control" placeholder="Banca" />
                                </div>
                            </div>


                            <div class="row g-3 mt-4">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">RIBA *</label>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <input type="text" name="" id="" class="form-control" placeholder="Si" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="" id="" class="form-control" placeholder="No" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">RID *</label>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <input type="text" name="" id="" class="form-control" placeholder="Si" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="" id="" class="form-control" placeholder="No" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-4">
                                    <button class="btn btn-outline-dark btn-prev waves-effect"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Indietro</span>
                                    </button>
                                    <!-- <button class="btn btn-dark btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Avanti</span> <i class="ti ti-arrow-right ti-xs"></i></button> -->
                                    <button type="submit" class="btn btn-dark btn-next btn-submit waves-effect waves-light">Avanti</button>
                                </div>
                            </div>
                            <!--/ Credit Card Details -->
                        </div>
                    </form>
                </div>
                
            </div>

            <div class="signup-wiz__footer">
                <p>Hai già un account? <a href="#">Entra</a></p>    
            </div>

        </div>
    </div>
</div>
<script>
// Check selected custom option
window.Helpers.initCustomOptionCheck();
</script>
@endsection