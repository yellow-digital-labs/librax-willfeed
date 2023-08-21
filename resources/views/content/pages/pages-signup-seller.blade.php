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
    <a href="{{route("auth-header__logo")}}" class="auth-header__logo">
        <img src="{{asset("/assets/img/weelfeed-brand-logo-white.svg")}}">
    </a>
</header>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                    <form id="multiStepsForm" onsubmit="return false" class="signup-wiz__form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Registry -->
                        <div id="SignupStepRegistry" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="content-header mb-4">
                                <h3 class="signup-wiz__name">Informazioni societarie</h3>
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
                                    <input type="text" name="tax_id_code" id="tax_id_code" class="form-control" placeholder="Inserisci il codice fiscale" value="{{$user_detail?$user_detail->tax_id_code:''}}" />
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
                                        <option value="{{$_main_activity->name}}" {{$user_detail?($user_detail->main_activity_ids==$_main_activity->name?'selected':''):''}}>{{$_main_activity->name}}</option>
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
                                    <label class="form-label" for="storage_capacity">Capacità di stoccaggio *</label>
                                    <select name="storage_capacity" id="storage_capacity" class="form-select select2" data-minimum-results-for-search="Infinity">
                                    <option value="">Seleziona facilità di accesso</option>
                                    @foreach($storage_capacity as $_storage_capacity)
                                        <option value="{{$_storage_capacity->name}}" {{$user_detail?($user_detail->storage_capacity==$_storage_capacity->name?'selected':''):''}}>{{$_storage_capacity->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 order_capacity_limits_container">
                                    <label class="form-label" for="order_capacity_limits">Limiti di capacità ordini *</label>
                                    <select name="order_capacity_limits" id="order_capacity_limits" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="">Seleziona i limiti</option>
                                    @foreach($order_capacity as $_order_capacity)
                                        <option value="{{$_order_capacity->name}}" {{$user_detail?($user_detail->order_capacity_limits==$_order_capacity->name?'selected':''):''}}>{{$_order_capacity->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="available_products">Prodotti disponibili *</label>
                                    <select name="available_products[]" id="available_products" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                        <option value="">Seleziona prodotti</option>
                                    @foreach($product as $_product)
                                        <option value="{{$_product->name}}" {{$user_detail?(in_array($_product->name, explode(",",$user_detail->available_products))?'selected':''):''}}>{{$_product->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="geographical_coverage_regions">Copertura geografica regioni *</label>
                                    <select name="geographical_coverage_regions" id="geographical_coverage_regions" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="">Seleziona le regioni coperte</option>
                                    @foreach($region as $_region)
                                        <option value="{{$_region->name}}" {{$user_detail?($user_detail->geographical_coverage_regions==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="geographical_coverage_provinces">Copertura geografica province *</label>
                                    <select name="geographical_coverage_provinces" id="geographical_coverage_provinces" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="">Seleziona prodotti </option>
                                    @foreach($province as $_province)
                                        <option value="{{$_province->name}}" {{$user_detail?($user_detail->geographical_coverage_provinces==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="time_limit_daily_order">Tempo limite ordine giornaliero *</label>
                                    <input type="time" name="time_limit_daily_order" id="time_limit_daily_order" class="form-control" placeholder="Seleziona limite" value="{{$user_detail?$user_detail->time_limit_daily_order:''}}" />
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="file_operating_license">Licenza di esercizio *</label>
                                    <input type="file" name="file_operating_license" id="file_operating_license" class="form-control" placeholder="Nessun file caricato" accept="application/pdf" value="{{$user_detail?$user_detail->file_operating_license:''}}" />
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
                                    <label class="form-label" for="bank_transfer">Bonifico bancario *</label>
                                    <input type="text" name="bank_transfer" id="bank_transfer" class="form-control" placeholder="IBAN" value="{{$user_detail?$user_detail->bank_transfer:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="bank_check">Assegno bancario *</label>
                                    <input type="text" name="bank_check" id="bank_check" class="form-control" placeholder="Intestazione assegno" value="{{$user_detail?$user_detail->bank_check:''}}" />
                                </div>
                                
                                <div class="col-sm-6">
                                    <input type="text" name="bank" id="bank" class="form-control" placeholder="Banca" value="{{$user_detail?$user_detail->bank:''}}" />
                                </div>
                            </div>


                            <div class="row g-3 mt-4">
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">RIBA *</label>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="rib-si">
                                                  <input name="rib" class="form-check-input" type="radio" value="Si" id="rib-si" {{$user_detail?($user_detail->rib=='Si'?'checked=""':''):'checked=""'}}>
                                                  <span class="custom-option-header">
                                                    <span class="h6 mb-0">Si</span>
                                                  </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="rib-no">
                                                  <input name="rib" class="form-check-input" type="radio" value="No" id="rib-no" {{$user_detail?($user_detail->rib=='No'?'checked=""':''):''}}>
                                                  <span class="custom-option-header">
                                                    <span class="h6 mb-0">No</span>
                                                  </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="form-label" for="">RID *</label>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="rid-si">
                                                  <input name="rid" class="form-check-input" type="radio" value="Si" id="rid-si" {{$user_detail?($user_detail->rid=='Si'?'checked=""':''):'checked=""'}}>
                                                  <span class="custom-option-header">
                                                    <span class="h6 mb-0">Si</span>
                                                  </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="rid-no">
                                                  <input name="rid" class="form-check-input" type="radio" value="No" id="rid-no" {{$user_detail?($user_detail->rid=='No'?'checked=""':''):''}}>
                                                  <span class="custom-option-header">
                                                    <span class="h6 mb-0">No</span>
                                                  </span>
                                                </label>
                                            </div>
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