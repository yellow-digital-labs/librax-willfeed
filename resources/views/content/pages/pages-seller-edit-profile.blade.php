@php
$configData = Helper::appClasses();
// if($isOnlyProfile){
//     $isMenu = false;
//     $navbarHideToggle = false;
// }
@endphp

@extends('layouts/layoutMaster')
@section('title', 'Edit Profilo')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-user-view.css')}}" />
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('page-script')
<!-- Edit Profle Modal js -->
<script src="{{asset('assets/js/app-user-view.js?version=1')}}"></script>
<!-- Extend Free Trail js -->
<script src="{{asset('assets/js/user-extend-free-trial.js?version=1')}}"></script>

<script>
let baseUrl ={{url('/')}};
</script>

<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>

<script src="{{asset('assets/js/custom/seller-profile-edit-validations.js')}}"></script>

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

    <div class="col-xl-8 col-lg-7 col-md-7" id="multiStepsValidation">
        <div id="edit-seller-profile" tabindex="-1">
               <form id="sellerEditForm" action="{{ route('edit-seller-profile') }}" onsubmit="return false" class="signup-wiz__form">
                    @csrf
                    <input type="hidden" name="user_detail_id" value="{{$user_detail->user_id}}" />

                <div id="SignupStepRegistry">
                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="background-color: #FFE000;">
                            <h4 class="text-black m-0">Anagrafica</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-4">
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Ragione sociale</h6>
                                    <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Inserisci ragione sociale" value="{{$user_detail?$user_detail->business_name:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Partita IVA</h6>
                                    <input type="text" name="vat_number" id="vat_number" class="form-control" placeholder="Inserisci numero di partita IVA" value="{{$user_detail?$user_detail->vat_number:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Cellulare referente</h6>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon-search31">+39 </span>
                                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{$user_detail?$user_detail->contact_person:''}}">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">PEC</h6>
                                    <input type="text" name="pec" id="pec" class="form-control" placeholder="latuaemail@pec.it" value="{{$user_detail?$user_detail->pec:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Codice fiscale</h6>
                                    <input type="text" name="tax_id_code" id="tax_id_code" class="form-control" placeholder="Inserisci il codice fiscale" maxlength="16" value="{{$user_detail?$user_detail->tax_id_code:''}}" oninput="this.value = this.value.toUpperCase()" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Nominativo Amministratore</h6>
                                <input type="text" name="administrator_name" id="administrator_name" class="form-control" placeholder="Mario Rossi" value="{{$user_detail?$user_detail->administrator_name:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Attività principale </h6>
                                    <select name="main_activity_ids" id="main_activity_ids" class="form-select select2" placeholder="Seleziona attività principale">
                                        <option value="{{$user_detail->main_activity_ids}}" selected>{{$user_detail->main_activity_ids}}</option>
                                        @foreach($main_activity as $_main_activity)
                                            <option value="{{$_main_activity->name}}" {{$user_detail?($user_detail->main_activity_ids==$_main_activity->name?'selected':''):''}}>{{$_main_activity->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Indirizzo</h6>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Via Battisti " value="{{$user_detail?$user_detail->address:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Numero civico</h6>
                                    <input type="text" name="house_no" id="house_no" class="form-control" placeholder="Inserisci il numero civico" value="{{$user_detail?$user_detail->house_no:''}}" />
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Regione</h6>
                                    <select name="region" id="region" class="form-select select2" data-minimum-results-for-search="Infinity">
                                    <option value="{{$user_detail->region}}" selected>{{$user_detail->region}}</option>
                                        @foreach($region as $_region)
                                            <option value="{{$_region->name}}" data-id="{{$_region->id}}" {{$user_detail?($user_detail->region==$_region->name?'selected':''):''}}>{{$_region->name}}</option>
                                        @endforeach
                                    </select>   
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Provincia</h6>
                                    <select name="province" id="province" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="{{$user_detail->province}}" selected>{{$user_detail->province}}</option>
                                        @foreach($province as $_province)
                                            <option value="{{$_province->name}}" data-id="{{$_province->id}}" data-region="{{$_province->regions_id}}" {{$user_detail?($user_detail->province==$_province->name?'selected':''):''}}>{{$_province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Comune</h6>
                                    <select name="common" id="common" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value="{{$user_detail->common}}" selected></option>
                                        @foreach($common as $_common)
                                            <option value="{{$_common->name}}" data-id="{{$_common->id}}" data-province="{{$_common->provinces_id}}" {{$user_detail?($user_detail->common==$_common->name?'selected':''):''}}>{{$_common->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">CAP</h6>
                                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Inserisci il CAP" value="{{$user_detail?$user_detail->pincode:''}}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header border-bottom" style="background-color: #FF9300;">
                            <h4 class="text-black m-0">Operatività</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-4">
                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Capacità di stoccaggio</h6>
                                    <select name="storage_capacity" id="storage_capacity" class="form-select select2" data-minimum-results-for-search="Infinity">
                                        <option value=""> </option>
                                        @foreach($storage_capacity as $_storage_capacity)
                                            <option value="{{$_storage_capacity->name}}" {{$user_detail?($user_detail->storage_capacity==$_storage_capacity->name?'selected':''):''}}>{{$_storage_capacity->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Limiti di capacità ordini</h6>
                                    <!-- <p class="mb-0">{{$user_detail->order_capacity_limits?$user_detail->order_capacity_limits.' litri':'NA'}} - {{$user_detail->order_capacity_limits_new?$user_detail->order_capacity_limits_new.' litri':'NA'}}</p> -->
                                    <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" name="order_capacity_limits" id="order_capacity_limits" class="form-control" placeholder="Min" value="{{$user_detail?$user_detail->order_capacity_limits:''}}" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="order_capacity_limits_new" id="order_capacity_limits_new" class="form-control" placeholder="Max" value="{{$user_detail?$user_detail->order_capacity_limits_new:''}}" />
                                                    </div>
                                                </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Prodotti disponibili</h6>
                                    <select name="available_products[]" id="available_products" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                                    <option value="">Seleziona prodotti</option>
                                                @foreach($product as $_product)
                                                    <option value="{{$_product->name}}" {{$user_detail?(in_array($_product->name, explode(",",$user_detail->available_products))?'selected':''):''}}>{{$_product->name}}</option>
                                                @endforeach
                                                </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Copertura geografica regioni</h6>
                                        <select name="geographical_coverage_regions[]" id="geographical_coverage_regions" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                                    <option value="">Seleziona le regioni coperte</option>
                                                @foreach($region as $_region)
                                                    <option value="{{$_region->name}}"  data-id="{{$_region->id}}" {{$user_detail?(in_array($_region->name, explode(",",$user_detail->geographical_coverage_regions))?'selected':''):''}}>{{$_region->name}}</option>
                                                @endforeach
                                                </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Copertura geografica province</h6>
                                    <select name="geographical_coverage_provinces[]" id="geographical_coverage_provinces" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                                    <option value="">Seleziona prodotti </option>
                                                @foreach($province as $_province)
                                                    <option value="{{$_province->name}}"  data-id="{{$_province->id}}" {{$user_detail?(in_array($_province->name, explode(",",$user_detail->geographical_coverage_provinces))?'selected':''):''}}>{{$_province->name}}</option>
                                                @endforeach
                                                </select>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Tempo limite accettazione ordine</h6>
                                    <input type="time" name="time_limit_daily_order" id="time_limit_daily_order" class="form-control" placeholder="Seleziona limite" value="{{$user_detail?$user_detail->time_limit_daily_order:''}}" />
                                            
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Licenza di esercizio</h6>
                                    <input type="file" name="file_operating_license" class="form-control" placeholder="Nessun file caricato" accept="application/pdf" value="{{$user_detail?$user_detail->file_operating_license:''}}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header border-bottom" style="background-color: #941100;">
                            <h4 class="m-0" style="color: #FFFFFF;">Fatturazione</h4>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row g-4">

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Bonifico Bancario</h6>
                                    <input type="text" name="bank_transfer" id="bank_transfer" class="form-control" placeholder="IBAN" value="{{$user_detail?$user_detail->bank_transfer:''}}" />
                                        
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">Assegno Bancario</h6>
                                    <input type="text" name="bank_check" id="bank_check" class="form-control" placeholder="Intestazione assegno" value="{{$user_detail?$user_detail->bank_check:''}}" />
                                            
                                </div>

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">RIBA</h6>
                                
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

                                <div class="col-sm-6 col-12">
                                    <h6 class="text-black mb-2">RID</h6>
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
                            </div>
                        </div>
                    </div>

                </div>

                <div class="m-3">
                    <button type="submit btn" class="btn btn-primary" id="seller-edit-form-submit"> Submit  </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
// Check selected custom option
window.Helpers.initCustomOptionCheck();
</script>
@endsection
