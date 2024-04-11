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
<script src="{{asset('assets/js/custom/signup-client-validations.js?version=1')}}"></script>
@endsection
@section('content')
    
<header class="auth-header">
    <a href="{{route("pages-home")}}" class="auth-header__logo">
        <img src="{{asset("/assets/img/weelfeed-brand-logo-white.svg")}}">
    </a>
</header>

<div class="signup-wiz">
    <div class="authentication-wrapper signup-wiz__wrapper">
        <div class="authentication-inner signup-wiz__inner">

            <h1 class="mb-5 pt-2 text-center text-black text-uppercase signup-wiz__maintitle">REGISTRAZIONE CLIENTE</h1>

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
                                <span class="bs-stepper-title">Destinazione</span>
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
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step signup-wiz__step" data-target="#SignupStepProfile">
                        <button type="button" class="step-trigger signup-wiz__trigger" aria-selected="false" disabled="disabled">
                            <span class="bs-stepper-circle"><i class="wf-icon wf-icon-user"></i></span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Profilo</span>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="bs-stepper-content signup-wiz__body">
                    <form id="multiStepsForm" onsubmit="return false" class="signup-wiz__form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Registry -->
                        <div id="SignupStepRegistry" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header mb-4">
                                <h3 class="signup-wiz__name text-center">Informazioni societarie</h3>
                            </div>
                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label class="form-label" for="business_name">Ragione sociale *</label>
                                    <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Inserisci ragione sociale" value="{{$user_detail?$user_detail->business_name:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="vat_number">Partita IVA *</label>
                                    <input type="text" name="vat_number" id="vat_number" class="form-control" placeholder="Inserisci numero di partita IVA" value="{{$user_detail?$user_detail->vat_number:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="contact_person">Cellulare referente *</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31">+39 </span>
                                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{$user_detail?$user_detail->contact_person:''}}">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="pec">PEC *</label>
                                    <input type="text" name="pec" id="pec" class="form-control" placeholder="latuaemail@pec.it" value="{{$user_detail?$user_detail->pec:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="tax_id_code">Codice fiscale</label>
                                    <input type="text" name="tax_id_code" id="tax_id_code" class="form-control" placeholder="Inserisci il codice fiscale" maxlength="16" value="{{$user_detail?$user_detail->tax_id_code:''}}" oninput="this.value = this.value.toUpperCase()" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="administrator_name">Nominativo amministratore *</label>
                                    <input type="text" name="administrator_name" id="administrator_name" class="form-control" placeholder="Mario Rossi" value="{{$user_detail?$user_detail->administrator_name:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="main_activity_ids">Attività principale *</label>
                                    <select name="main_activity_ids" id="main_activity_ids" class="form-select select2" placeholder="Seleziona attività principale">
                                        <option value=""></option>
                                    @foreach($main_activity as $_main_activity)
                                        <option value="{{$_main_activity}}" {{$user_detail?($user_detail->main_activity_ids==$_main_activity?'selected':''):''}}>{{$_main_activity}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="address">Indirizzo *</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Via Battisti " value="{{$user_detail?$user_detail->address:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="house_no">Numero civico *</label>
                                    <input type="text" name="house_no" id="house_no" class="form-control" placeholder="Inserisci il numero civico" value="{{$user_detail?$user_detail->house_no:''}}" />
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="region">Regione *</label>
                                    <select name="region" id="region" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($region as $_region)
                                        <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_detail?($user_detail->region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="province">Provincia *</label>
                                    <select name="province" id="province" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($province as $_province)
                                        <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_detail?($user_detail->province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="common">Comune *</label>
                                    <select name="common" id="common" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($common as $_common)
                                        <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_detail?($user_detail->common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="pincode">CAP *</label>
                                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Inserisci il CAP" value="{{$user_detail?$user_detail->pincode:''}}" />
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
                                <h3 class="signup-wiz__name text-center">Informazioni destinazione</h3>
                            </div>
                            <div class="row g-3">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="ease_of_access">Facilità di accesso *</label>
                                    <select name="ease_of_access" id="ease_of_access" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($ease_of_access as $_ease_of_access)
                                        <option value="{{$_ease_of_access->name}}" data-id="{{$_ease_of_access->id}}" {{$user_detail?($user_detail->ease_of_access==$_ease_of_access->name?'selected':''):''}}>{{$_ease_of_access->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="mobile_unloading">Cellulare referente di scarico *</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">+39 </span>
                                        <input type="text" class="form-control" id="mobile_unloading" name="mobile_unloading" value="{{$user_detail?$user_detail->mobile_unloading:''}}">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="destination_address">Indirizzo destinazione (se diverso da anagrafica)</label>
                                    <select name="destination_address" id="destination_address" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_address_via">Indirizzo</label>
                                    <input type="text" name="destination_address_via" id="destination_address_via" class="form-control" placeholder="Via Battisti" value="{{$user_detail?$user_detail->destination_address_via:''}}" />
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_house_no">Numero civico</label>
                                    <input type="text" name="destination_house_no" id="destination_house_no" class="form-control" placeholder="Inserisci il numero civico" />
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_region">Regione *</label>
                                    <select name="destination_region" id="destination_region" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($region as $_region)
                                        <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_detail?($user_detail->destination_region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_province">Provincia</label>
                                    <select name="destination_province" id="destination_province" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($province as $_province)
                                        <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_detail?($user_detail->destination_province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_common">Comune</label>
                                    <select name="destination_common" id="destination_common" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($common as $_common)
                                        <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_detail?($user_detail->destination_common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <label class="form-label" for="destination_pincode">CAP</label>
                                    <input type="text" name="destination_pincode" id="destination_pincode" class="form-control" placeholder="Inserisci il CAP" value="{{$user_detail?$user_detail->destination_pincode:''}}" />
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="minor_plant_code">Codice licenza cisterna</label>
                                    <input class="form-control" type="file" id="minor_plant_code" name="minor_plant_code">
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
                                <h3 class="signup-wiz__name text-center">Informazioni fatturazione</h3>
                            </div>

                            <div class="row g-3">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="payment_extension">Dilazione di pagamento preferita *</label>
                                    <select name="payment_extension" id="payment_extension" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($payment_extension as $_payment_extension)
                                        <option value="{{$_payment_extension->name}}" {{$user_detail?($user_detail->destination_common==$_payment_extension->name?'selected':''):''}}>{{$_payment_extension->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="payment_term">Modalità di pagamento * </label>
                                    <select name="payment_term" id="payment_term" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($payment_terms as $_payment_terms)
                                        <option value="{{$_payment_terms->name}}" {{$user_detail?($user_detail->payment_term==$_payment_terms->name?'selected':''):''}}>{{$_payment_terms->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="reference_bank">Banca di riferimento (RIBA e RID)</label>
                                    <input type="text" name="reference_bank" id="reference_bank" class="form-control" placeholder="Inserisci filiale" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="iban">IBAN (RIBA e RID)</label>
                                    <input type="text" name="iban" id="iban" class="form-control" placeholder="ITxxxxxxxxxxxx" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="sdi">SDI *</label>
                                    <input type="text" name="sdi" id="sdi" class="form-control" placeholder="Inserisci codice univoco" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="cig">CIG</label>
                                    <input type="text" name="cig" id="cig" class="form-control" placeholder="Inserisci CIG ove applicabile" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="cup">CUP</label>
                                    <input type="text" name="cup" id="cup" class="form-control" placeholder="Inserisci CUP, ove applicabile" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="file_1">Visura camerale *</label>
                                    <input class="form-control" type="file" id="file_1" name="file_1">
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="file_2">Documento di riconoscimento amministratore *</label>
                                    <input class="form-control" type="file" id="file_2" name="file_2">
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="file_3">Esenzione IVA</label>
                                    <input class="form-control" type="file" id="file_3" name="file_3">
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-4">
                                    <button class="btn btn-outline-dark btn-prev waves-effect"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Indietro</span>
                                    </button>
                                    <button class="btn btn-dark btn-next waves-effect waves-light"> <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Avanti</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                                    <!-- <button type="submit" class="btn btn-success btn-next btn-submit waves-effect waves-light">Submit</button> -->
                                </div>
                            </div>
                            <!--/ Credit Card Details -->
                        </div>

                        <!-- Profile -->
                        <div id="SignupStepProfile" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header">
                                <h3 class="signup-wiz__name text-center">Final Step: Profilo Cliente</h3>
                            </div>

                            <div class="row g-3">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="products">Tipologia di prodotti consumati *</label>
                                    <select name="products" id="products" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                        <option value=""></option>
                                    @foreach($product as $_product)
                                        <option value="{{$_product->name}}" {{$user_detail?(in_array($_product->name, explode(",",$user_detail->products))?'selected':''):''}}>{{$_product->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="monthly_consumption">Consumi medi mensili *</label>
                                    <select name="monthly_consumption" id="monthly_consumption" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($consume_capacity as $_consume_capacity)
                                        <option value="{{$_consume_capacity->name}}" {{$user_detail?($user_detail->monthly_consumption==$_consume_capacity->name?'selected':''):''}}>{{$_consume_capacity->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="is_private_distributer">Sei un distributore privato? *</label>
                                    <select name="is_private_distributer" id="is_private_distributer" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 js-no-of-dis-container">
                                    <label class="form-label" for="no_of_distributer">Numero di distributori *</label>
                                    <input type="text" name="no_of_distributer" id="no_of_distributer" class="form-control" placeholder="Inserisci numero di distributori" />
                                </div>
                                
                                <div class="col-sm-12">
                                    <label class="form-label" for="">Flotta *</label>
                                    <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                        <div class="card-body p-3">
                                            <div class="row g-3">
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport js-type_of_flotta-check" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion Ribaltabili
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide js-type_of_flotta-input" aria-label="000" name="type_of_flotta" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport js-folding_trucks-check" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion Furgonati
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide js-folding_trucks-input" aria-label="000" name="folding_trucks" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport js-van_trucks-check" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion Centinato
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide js-van_trucks-input" aria-label="000" name="van_trucks" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport js-hundred_trucks-check" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion a telaio
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide js-hundred_trucks-input" aria-label="000" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport js-chassis_trucks-check" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion a cassone Fisso
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" name="chassis_trucks" aria-label="000" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion Frigo
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="fixed_cassone_truck">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion con Gru
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="fridge_truck" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Camion Scarrabili
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="truck_with_crane" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Bitoniere
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="scarble_truck" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Veicoli Comerciali & Bus
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="bitoniere" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Semirimorchio
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="comircial_vehicle" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Rimorchi
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="semi_trailer" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-secondary h-100">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <input class="form-check-input mt-0 container-transport" type="checkbox">
                                                                </div>
                                                                <div class="col px-0">
                                                                    Trattori stradali
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control hide" aria-label="000" name="trailers" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between mt-4">
                                    <button class="btn btn-outline-dark btn-prev waves-effect"> <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Indietro</span>
                                    </button>
                                    <button type="submit" class="btn btn-dark btn-next btn-submit waves-effect waves-light">Avanti</button>
                                </div>
                            </div>
                            <!--/ Credit Card Details -->
                        </div>
                    </form>
                </div>
                
            </div>

            <div class="signup-wiz__footer">
                <p>Hai già un account? <a href="{{route('register')}}">Entra</a></p>    
            </div>

        </div>
    </div>
</div>
<script>
// Check selected custom option
window.Helpers.initCustomOptionCheck();
</script>
@endsection