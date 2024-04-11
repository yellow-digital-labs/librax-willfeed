@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Edit Profilo')
@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('assets/js/custom/buyer-profile-edit-validations.js?version=1')}}"></script>
@endsection
@section('content')

<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        
        <h1 class="h3 text-black mb-4">
            Profilo
        </h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4 rounded-circle" src="{{ $user ? $user->profile_photo_url :asset('assets/img/81160511660785db8768a15358306893.jpg') }}" height="100" width="100" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4 class="text-black mt-3">{{$user_detail->business_name?$user_detail->business_name:'NA'}}</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around flex-wrap  pb-4 border-bottom">
                    <div class="d-flex align-items-start me-4 mt-1 gap-2">
                        <i class='wf-icon-location ti-sm text-black'></i>
                        <div>
                            {{$user_detail->region?$user_detail->region:'NA'}}
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-1 gap-2">
                        <i class='wf-icon-calendar ti-sm text-black'></i>
                        <div>
                            Da {{$user->created_at?(\App\Helpers\Helpers::getMonthName(date('m', strtotime($user->created_at)))." ".date('Y', strtotime($user->created_at))):'NA'}}
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <p class="mt-4 text-uppercase text-black fw-semibold">Sommario</p>
                    <div class="info-container">
                        <ul class="list-unstyled about-iconlist">
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-user"></span>
                                <span class="about-iconlist__name">Ragione sociale:</span>
                                <span class="about-iconlist__val">{{$user_detail->business_name?$user_detail->business_name:'NA'}}</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-location"></span>
                                <span class="about-iconlist__name">Sede:</span>
                                <span class="about-iconlist__val">{{$user_detail->address}} {{$user_detail->house_no}}, {{$user_detail->region}}</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-check"></span>
                                <span class="about-iconlist__name">Status:</span>
                                <span class="about-iconlist__val">{{$user->approved_by_admin=='Yes'?'Varified':'Unvarified'}}</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-crown"></span>
                                <span class="about-iconlist__name">Attività principale:</span>
                                <span class="about-iconlist__val">{{$user_detail->main_activity_ids?$user_detail->main_activity_ids:'NA'}}</span>
                            </li>
                        </ul>
                    </div>
                    <p class="mt-4 text-uppercase text-black fw-semibold">CONTATTI</p>
                    <div class="info-container">
                        <ul class="list-unstyled about-iconlist">
                            <li class="about-iconlist__item">
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-phone-call1"></span>
                                <span class="about-iconlist__name">Cellulare:</span>
                                <span class="about-iconlist__val">+39 {{$user_detail->contact_person}}</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-mail"></span>
                                <span class="about-iconlist__name">Pec:</span>
                                <span class="about-iconlist__val">{{$user_detail->pec}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <div id="edit-buyer-profile" tabindex="-1">

            
            <form id="buyerEditForm" action="{{ route('edit-buyer-profile') }}" onsubmit="return false" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Registry -->
                <div id="SignupStepRegistry" class="tab-content-buyer">
                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="background-color: #FFE000;">
                            <h4 class="text-black m-0">Anagrafica</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-4">

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Ragione sociale *</h6>
                                    <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Inserisci ragione sociale" value="{{$user_detail?$user_detail->business_name:''}}" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Partita IVA *</h6>
                                    <input type="text" name="vat_number" id="vat_number" class="form-control" placeholder="Inserisci numero di partita IVA" value="{{$user_detail?$user_detail->vat_number:''}}" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="contact_person">Cellulare referente *</h6>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31">+39 </span>
                                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{$user_detail?$user_detail->contact_person:''}}">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="pec">PEC *</h6>
                                    <input type="text" name="pec" id="pec" class="form-control" placeholder="latuaemail@pec.it" value="{{$user_detail?$user_detail->pec:''}}" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="tax_id_code">Codice fiscale</h6>
                                    <input type="text" name="tax_id_code" id="tax_id_code" class="form-control" placeholder="Inserisci il codice fiscale" maxlength="16" value="{{$user_detail?$user_detail->tax_id_code:''}}" oninput="this.value = this.value.toUpperCase()" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="administrator_name">Nominativo amministratore *</h6>
                                    <input type="text" name="administrator_name" id="administrator_name" class="form-control" placeholder="Mario Rossi" value="{{$user_detail?$user_detail->administrator_name:''}}" />
                                </div>
                            
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="main_activity_ids">Attività principale *</h6>
                                    <select name="main_activity_ids" id="main_activity_ids" class="form-select select2" placeholder="Seleziona attività principale">
                                        <option value="{{$user_detail->main_activity_ids}}" selected>{{$user_detail->main_activity_ids}}</option>
                                    @foreach($main_activity as $_main_activity)
                                        <option value="{{$_main_activity}}" {{$user_detail?($user_detail->main_activity_ids==$_main_activity?'selected':''):''}}>{{$_main_activity}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="address">Indirizzo *</h6>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Via Battisti " value="{{$user_detail?$user_detail->address:''}}" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="house_no">Numero civico *</h6>
                                    <input type="text" name="house_no" id="house_no" class="form-control" placeholder="Inserisci il numero civico" value="{{$user_detail?$user_detail->house_no:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="region">Regione *</h6>
                                    <select name="region" id="region" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($region as $_region)
                                        <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_detail?($user_detail->region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="province">Provincia *</h6>
                                    <select name="province" id="province" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($province as $_province)
                                        <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_detail?($user_detail->province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="common">Comune *</h6>
                                    <select name="common" id="common" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($common as $_common)
                                        <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_detail?($user_detail->common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="pincode">CAP *</h6>
                                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Inserisci il CAP" value="{{$user_detail?$user_detail->pincode:''}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destination -->
                <div id="SignupStepDestination" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="background-color: #FF9300;">
                            <h4 class="text-black m-0">Destinazione</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-4">
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="ease_of_access">Facilità di accesso *</h6>
                                    <select name="ease_of_access" id="ease_of_access" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($ease_of_access as $_ease_of_access)
                                        <option value="{{$_ease_of_access->name}}" data-id="{{$_ease_of_access->id}}" {{$user_detail?($user_detail->ease_of_access==$_ease_of_access->name?'selected':''):''}}>{{$_ease_of_access->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="mobile_unloading">Cellulare referente di scarico *</h6>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">+39 </span>
                                        <input type="text" class="form-control" id="mobile_unloading" name="mobile_unloading" value="{{$user_detail?$user_detail->mobile_unloading:''}}">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="destination_address">Indirizzo destinazione (se diverso da anagrafica)</h6>
                                    <select name="destination_address" id="destination_address" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_address_via">Indirizzo</h6>
                                    <input type="text" name="destination_address_via" id="destination_address_via" class="form-control" placeholder="Via Battisti" value="{{$user_detail?$user_detail->destination_address_via:''}}" />
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_house_no">Numero civico</h6>
                                    <input type="text" name="destination_house_no" id="destination_house_no" class="form-control" placeholder="Inserisci il numero civico" />
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_region">Regione *</h6>
                                    <select name="destination_region" id="destination_region" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($region as $_region)
                                        <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_detail?($user_detail->destination_region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_province">Provincia</h6>
                                    <select name="destination_province" id="destination_province" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($province as $_province)
                                        <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_detail?($user_detail->destination_province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_common">Comune</h6>
                                    <select name="destination_common" id="destination_common" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($common as $_common)
                                        <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_detail?($user_detail->destination_common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 address-container hide">
                                    <h6 class="text-black mb-2" for="destination_pincode">CAP</h6>
                                    <input type="text" name="destination_pincode" id="destination_pincode" class="form-control" placeholder="Inserisci il CAP" value="{{$user_detail?$user_detail->destination_pincode:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="minor_plant_code">Codice licenza cisterna</h6>
                                    <input class="form-control" type="file" id="minor_plant_code" name="minor_plant_code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing -->
                <div id="SignupStepBilling" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="color: #FFFFFF; background-color: #941100;">
                            <h4 class="m-0" style="color: #FFFFFF;">Fatturazione</h4>
                        </div>

                        <div class="card-body pt-4">
                            <div class="row g-4">
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="payment_extension">Dilazione di pagamento preferita *</h6>
                                    <select name="payment_extension" id="payment_extension" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="{{$user_detail->payment_extension}}" selected>{{$user_detail->payment_extension}}</option>
                                    @foreach($payment_extension as $_payment_extension)
                                        <option value="{{$_payment_extension->name}}" {{$user_detail?($user_detail->payment_extension==$_payment_extension->name?'selected':''):''}}>{{$_payment_extension->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="payment_term">Modalità di pagamento * </h6>
                                    <select name="payment_term" id="payment_term" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""></option>
                                    @foreach($payment_terms as $_payment_terms)
                                        <option value="{{$_payment_terms->name}}" {{$user_detail?($user_detail->payment_term==$_payment_terms->name?'selected':''):''}}>{{$_payment_terms->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="reference_bank">Banca di riferimento (RIBA e RID)</h6>
                                    <input type="text" name="reference_bank" id="reference_bank" class="form-control"  value="{{$user_detail->reference_bank ? $user_detail->reference_bank : ''}}" placeholder="Inserisci filiale" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="iban">IBAN (RIBA e RID)</h6>
                                    <input type="text" name="iban" id="iban" class="form-control" value="{{$user_detail->iban ? $user_detail->iban : ''}}" placeholder="ITxxxxxxxxxxxx" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="sdi">SDI *</h6>
                                    <input type="text" name="sdi" id="sdi" class="form-control" value="{{$user_detail->sdi ? $user_detail->sdi : ''}}" placeholder="Inserisci codice univoco" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="cig">CIG</h6>
                                    <input type="text" name="cig" id="cig" class="form-control"  value="{{$user_detail->cig ? $user_detail->cig : ''}}" placeholder="Inserisci CIG ove applicabile" />
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="cup">CUP</h6>
                                    <input type="text" name="cup" id="cup" class="form-control" value="{{$user_detail->cup ? $user_detail->cup : ''}}" placeholder="Inserisci CUP, ove applicabile" />
                                </div>
                                
                                 <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="file_1">Visura camerale</h6>
                                    <input class="form-control" type="file" id="file_1" name="file_1">
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="file_2">Documento di riconoscimento amministratore</h6>
                                    <input class="form-control" type="file" id="file_2" name="file_2">
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="file_3">Esenzione IVA</h6>
                                    <input class="form-control" type="file" id="file_3" name="file_3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Credit Card Details -->
                </div>

                <!-- Profile -->
                <div id="SignupStepProfile" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="background-color: #0433FF;">
                            <h4 class="m-0" style="color: #FFFFFF;">Profilo</h4>
                        </div>

                        <div class="card-body pt-4">
                            <div class="row g-4">
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="products">Tipologia di prodotti consumati *</h6>
                                    <select name="products" id="products" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                        <option value=""></option>
                                    @foreach($product as $_product)
                                        <option value="{{$_product->name}}" {{$user_detail?(in_array($_product->name, explode(",",$user_detail->products))?'selected':''):''}}>{{$_product->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="monthly_consumption">Consumi medi mensili *</h6>
                                    <select name="monthly_consumption" id="monthly_consumption" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="{{$user_detail->monthly_consumption}}" selected>{{$user_detail->monthly_consumption}}</option>
                                    @foreach($consume_capacity as $_consume_capacity)
                                        <option value="{{$_consume_capacity->name}}" {{$user_detail?($user_detail->monthly_consumption==$_consume_capacity->name?'selected':''):''}}>{{$_consume_capacity->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2" for="is_private_distributer">Sei un distributore privato? *</h6>
                                    <select name="is_private_distributer" id="is_private_distributer" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="{{$user_detail->is_private_distributer}}" selected>{{$user_detail->is_private_distributer}}</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 js-no-of-dis-container">
                                    <h6 class="text-black mb-2" for="no_of_distributer">Numero di distributori *</h6>
                                    <input type="text" name="no_of_distributer" id="no_of_distributer" class="form-control" value="{{$user_detail->no_of_distributer?$user_detail->no_of_distributer:'' }}" placeholder="Inserisci numero di distributori" />
                                </div>
                        
                                <div class="col-sm-12">
                                    <h6 class="text-black mb-2" for="">Flotta *</h6>
                                    <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                        <div class="card-body p-3">
                                            <div class="row g-3">
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                                                
                                                <div class="col-sm-6 col-12">
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-3">
                    <button type="submit" class="btn btn-primary" id="seller-edit-form-submit"> Submit</button>
                </div>
            </form>
            <script>
            // Check selected custom option
            window.Helpers.initCustomOptionCheck();
            </script>
        </div>
    </div>
</div>
@endsection