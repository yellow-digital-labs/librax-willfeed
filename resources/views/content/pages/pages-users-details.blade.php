@php
$configData = Helper::appClasses();
if($isOnlyProfile){
    $isMenu = false;
    $navbarHideToggle = false;
}
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Profilo')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
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
<script src="{{asset('assets/js/modal-edit-user.js')}}"></script>
<script src="{{asset('assets/js/modal-edit-cc.js')}}"></script>
<script src="{{asset('assets/js/modal-add-new-cc.js')}}"></script>
<script src="{{asset('assets/js/modal-add-new-address.js')}}"></script>
<script src="{{asset('assets/js/app-user-view.js')}}"></script>
<script src="{{asset('assets/js/app-user-view-billing.js')}}"></script>
@endsection

@section('content')
<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5">
        
        <h1 class="h3 text-black mb-4">
        @if($isOnlyProfile && $user->accountType==1)
            Buyer Profilo
        @elseif($isOnlyProfile && $user->accountType==2)
            Seller Profilo
        @else
            Profilo
        @endif
        </h4>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('assets/img/81160511660785db8768a15358306893.jpg') }}" height="100" width="100" alt="User avatar" />
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
                            Da {{$user->created_at?date('F Y', strtotime($user->created_at)):'NA'}}
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <p class="mt-4 text-uppercase text-black fw-semibold">ABOUT</p>
                    <div class="info-container">
                        <ul class="list-unstyled about-iconlist">
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-user"></span>
                                <span class="about-iconlist__name">Ragione sociale:</span>
                                <span class="about-iconlist__val">{{$user_detail->administrator_name?$user_detail->administrator_name:'NA'}}</span>
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
                                <span class="about-iconlist__name">Role:</span>
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
        <!-- User Pills -->
        @if(!$isOnlyProfile)
        <ul class="nav nav-pills flex-row mb-4 card-header-pills">
            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Profilo" aria-controls="navs-pills-top-Profilo" aria-selected="true"><i class="wf-icon-User-Info ti-xs me-1"></i>Profilo</a></li>

            <li class="nav-item"><a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Fatturazione" aria-controls="navs-pills-top-Fatturazione" aria-selected="true"><i class="wf-icon-file-text1 ti-xs me-1"></i>Fatturazione</a></li>
        </ul>
        @endif
        @if($authUser->accountType==0)
        <ul class="nav nav-pills flex-row mb-4 card-header-pills">
            @if($user->approved_by_admin == "Pending" || $user->approved_by_admin == "No")
            <li class="nav-item"><a href="" class="btn btn-primary" href="javascript:void(0);"><i class="wf-icon-check ti-xs me-1"></i>Verify</a></li>
            @endif

            @if($user->approved_by_admin == "Pending" || $user->approved_by_admin == "Yes")
            <li class="nav-item"><a href="" class="btn btn-primary" href="javascript:void(0);"><i class="wf-icon-no ti-xs me-1"></i>Unverify</a></li>
            @endif
        </ul>
        @endif
        <!--/ User Pills -->
        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-pills-top-Profilo" role="tabpanel">

                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Anagrafica</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Ragione sociale</h6>
                                <p class="mb-0">{{$user_detail->business_name?$user_detail->business_name:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Partita IVA</h6>
                                <p class="mb-0">{{$user_detail->vat_number?$user_detail->vat_number:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Cellulare referente</h6>
                                <p class="mb-0"><span class="text-black">+39</span> {{$user_detail->contact_person?$user_detail->contact_person:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">PEC</h6>
                                <p class="mb-0">{{$user_detail->pec?$user_detail->pec:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Codice fiscale</h6>
                                <p class="mb-0">{{$user_detail->tax_id_code?$user_detail->tax_id_code:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Nominativo Amministratore</h6>
                                <p class="mb-0">{{$user_detail->administrator_name?$user_detail->administrator_name:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Attività principale </h6>
                                <p class="mb-0">{{$user_detail->main_activity_ids?$user_detail->main_activity_ids:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Indirizzo</h6>
                                <p class="mb-0">{{$user_detail->address?$user_detail->address:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero civico</h6>
                                <p class="mb-0">{{$user_detail->house_no?$user_detail->house_no:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Regione</h6>
                                <p class="mb-0">{{$user_detail->region?$user_detail->region:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Provincia</h6>
                                <p class="mb-0">{{$user_detail->province?$user_detail->province:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Comune</h6>
                                <p class="mb-0">{{$user_detail->common?$user_detail->common:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CAP</h6>
                                <p class="mb-0">{{$user_detail->pincode?$user_detail->pincode:'NA'}}</p>
                            </div>

                        </div>
                    </div>
                </div>

                @if($user->accountType==2)
                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Operatività</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Capacità di stoccaggio</h6>
                                <p class="mb-0">{{$user_detail->storage_capacity?$user_detail->storage_capacity:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Limiti di capacità ordini</h6>
                                <p class="mb-0">{{$user_detail->order_capacity_limits?$user_detail->order_capacity_limits:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Prodotti disponibili</h6>
                                <p class="mb-0">{{$user_detail->available_products?$user_detail->available_products:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Copertura geografica regioni</h6>
                                <p class="mb-0">{{$user_detail->geographical_coverage_regions?$user_detail->geographical_coverage_regions:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Copertura geografica province</h6>
                                <p class="mb-0">{{$user_detail->geographical_coverage_provinces?$user_detail->geographical_coverage_provinces:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tempo limite ordine giornaliero</h6>
                                <p class="mb-0">{{$user_detail->time_limit_daily_order?$user_detail->time_limit_daily_order:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Licenza di esercizio</h6>
                                <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_operating_license)}}" target="_blank">View Document</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Fatturazione</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Bonifico Bancario</h6>
                                <p class="mb-0">IBAN: {{$user_detail->bank_transfer?$user_detail->bank_transfer:'NA'}} <br>
                                Banca: {{$user_detail->bank?$user_detail->bank:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Assegno Bancario</h6>
                                <p class="mb-0">{{$user_detail->bank_check?$user_detail->bank_check:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">RIBA</h6>
                                <p class="mb-0">{{$user_detail->rib?$user_detail->rib:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">RID</h6>
                                <p class="mb-0">{{$user_detail->rid?$user_detail->rid:'NA'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($user->accountType==1)
                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Destinazione</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Facilità di accesso</h6>
                                <p class="mb-0">{{$user_detail->ease_of_access?$user_detail->ease_of_access:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Cellulare referente di scarico</h6>
                                <p class="mb-0">{{$user_detail->mobile_unloading?$user_detail->mobile_unloading:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Indirizzo destinazione (se diverso da anagrafica)</h6>
                                <p class="mb-0">{{$user_detail->destination_address?$user_detail->destination_address:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero civico</h6>
                                <p class="mb-0">{{$user_detail->destination_house_no?$user_detail->destination_house_no:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Comune</h6>
                                <p class="mb-0">{{$user_detail->destination_common?$user_detail->destination_common:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Provincia</h6>
                                <p class="mb-0">{{$user_detail->destination_province?$user_detail->destination_province:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CAP</h6>
                                <p class="mb-0">{{$user_detail->destination_pincode?$user_detail->destination_pincode:'NA'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Fatturazione</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Dilazione di pagamento preferita</h6>
                                <p class="mb-0">IBAN: {{$user_detail->payment_extension?$user_detail->payment_extension:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Modalità di pagamento</h6>
                                <p class="mb-0">{{$user_detail->payment_term?$user_detail->payment_term:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Banca di riferimento (RIBA e RID)</h6>
                                <p class="mb-0">{{$user_detail->reference_bank?$user_detail->reference_bank:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">IBAN (RIBA e RID)</h6>
                                <p class="mb-0">{{$user_detail->iban?$user_detail->iban:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">SDI</h6>
                                <p class="mb-0">{{$user_detail->sdi?$user_detail->sdi:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CIG</h6>
                                <p class="mb-0">{{$user_detail->cig?$user_detail->cig:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CUP</h6>
                                <p class="mb-0">{{$user_detail->cup?$user_detail->cup:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Esenzione IVA</h6>
                                <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_1)}}" target="_blank">View Document</a></p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Esenzione IVA</h6>
                                <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_2)}}" target="_blank">View Document</a></p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Esenzione IVA</h6>
                                <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_3)}}" target="_blank">View Document</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Profilo</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tipologia di prodotti consumati</h6>
                                <p class="mb-0">{{$user_detail->products?$user_detail->products:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Consumi medi mensili</h6>
                                <p class="mb-0">{{$user_detail->monthly_consumption?$user_detail->monthly_consumption:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Sei un distributore privato?</h6>
                                <p class="mb-0">{{$user_detail->is_private_distributer?$user_detail->is_private_distributer:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero di distributori</h6>
                                <p class="mb-0">{{$user_detail->no_of_distributer?$user_detail->no_of_distributer:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Flotta</h6>
                                <p class="mb-0">{{$user_detail->fleet?$user_detail->fleet:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tipologia & Dimensione Flotta</h6>
                                <p class="mb-0">{{$user_detail->type_of_flotta?$user_detail->type_of_flotta:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Ribaltabili</h6>
                                <p class="mb-0">{{$user_detail->folding_trucks?$user_detail->folding_trucks:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Furgonati</h6>
                                <p class="mb-0">{{$user_detail->van_trucks?$user_detail->van_trucks:'NA'}}</p>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Centinato</h6>
                                <p class="mb-0">{{$user_detail->hundred_trucks?$user_detail->hundred_trucks:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion a telaio</h6>
                                <p class="mb-0">{{$user_detail->chassis_trucks?$user_detail->chassis_trucks:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion a cassone Fisso</h6>
                                <p class="mb-0">{{$user_detail->fixed_cassone_truck?$user_detail->fixed_cassone_truck:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Frigo</h6>
                                <p class="mb-0">{{$user_detail->fridge_truck?$user_detail->fridge_truck:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion con Gru</h6>
                                <p class="mb-0">{{$user_detail->truck_with_crane?$user_detail->truck_with_crane:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Scarrabili</h6>
                                <p class="mb-0">{{$user_detail->scarble_truck?$user_detail->scarble_truck:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Bitoniere</h6>
                                <p class="mb-0">{{$user_detail->bitoniere?$user_detail->bitoniere:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Veicoli Comerciali & Bus</h6>
                                <p class="mb-0">{{$user_detail->comircial_vehicle?$user_detail->comircial_vehicle:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Semirimorchio</h6>
                                <p class="mb-0">{{$user_detail->semi_trailer?$user_detail->semi_trailer:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Rimorchi</h6>
                                <p class="mb-0">{{$user_detail->trailers?$user_detail->trailers:'NA'}}</p>
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Trattori stradali</h6>
                                <p class="mb-0">{{$user_detail->road_tractors?$user_detail->road_tractors:'NA'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if(!$isOnlyProfile)
            <div class="tab-pane fade" id="navs-pills-top-Fatturazione" role="tabpanel">
                @php
                $remainingDays = App\Helpers\Helpers::getDaysBetweenDates(date('Y-m-d H:i:s', time()), $user->exp_datetime);
                @endphp
                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Il tuo piano Willfeed</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h2 class="text-black mb-2">{{$user->subscription_name}}</h2>

                                <h6 class="mb-1">Scade il {{date('d F, Y', strtotime($user->exp_datetime))}}</h6>
                                <p>Riceverai una notifica alla scadenza del piano</p>

                                <h6 class="mb-1">{{$user->subscription_amount==0?'Free':'€'.$user->subscription_amount}} al mese <span class="badge bg-label-{{$remainingDays>0?'success':'danger'}} badge--{{$remainingDays>0?'success':'danger'}}">{{$remainingDays>0?'Active':'Expired'}}</span></h6>
                                <p class="mb-3">Il piano standard per iniziare</p>

                                {{-- <button type="button" class="btn btn-primary waves-effect waves-light me-2 mt-2">Salva</button> --}}

                                <button type="button" class="btn btn-outline-dark waves-effect mt-2">Indietro</button>

                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading">Piano in scadenza</h5>
                                    <p class="mb-0 fw-normal">Aggiorna il metodo di pagamento</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1 fw-semibold text-heading">
                                    <span>Giorni</span>
                                    <span>{{$remainingDays}} giorni rimasti</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{$remainingDays * 100 /30}}%;" aria-valuenow="{{$remainingDays * 100 /30}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{$remainingDays}} giorni rimasti alla scadenza.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Piani</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row gy-3">
                        @foreach($subscriptions as $subscription)
                            <div class="col-lg mb-md-0 mb-4">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{asset($subscription->image)}}" alt="{{$subscription->name}} Image" height="140">
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-3 h5">{{$subscription->name}}</h3>
                                        <p class="text-center">{!!$subscription->tagline!!}</p>
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">€</sup>
                                                <h1 class="fw-semibold display-4 mb-0 text-primary">{{$subscription->amount}}</h1>
                                                <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/mese</sub>
                                            </div>
                                        </div>
                                        {!!$subscription->description!!}
                                        @if($subscription->id == $user->subscription_id && $remainingDays > 0)
                                            <a class="btn btn-label-success d-grid w-100">Your Current Plan</a>
                                        @else
                                            <a href="{{url('auth/register-basic')}}" class="btn btn-primary d-grid w-100">Subscribe</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Metodo di pagamento</h5>
                        <div class="card-action-element">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewCCModal"><i class="ti ti-plus ti-xs me-1"></i>Aggiungi</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="added-cards">
                        @if($payment_methods)
                            @foreach($payment_methods as $payment_method)
                                <div class="cardMaster border p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between flex-lg-row flex-column">
                                        <div class="card-information">
                                            <img class="mb-3 img-fluid" src="{{asset('assets/img/icons/payments/'.$payment_method->card->brand.'.png')}}" alt="Master Card">
                                            <h6 class="mb-2 pt-1">&nbsp;&nbsp;</h6>
                                            <span class="card-number">XXXX XXXX XXXX {{$payment_method->card->last4}}</span>
                                        </div>
                                        <div class="d-flex flex-column text-start text-lg-end">
                                            <div class="d-flex order-lg-0 order-1 mt-3">
                                                <a class="btn btn-outline-dark" href="{{route('stripe.payment.delete')}}">Elimina</a>
                                            </div>
                                            <small class="mt-lg-auto mt-2 order-lg-1 order-0">Scadenza {{$payment_method->card->exp_month}}/{{$payment_method->card->exp_year}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No payment method found</p>
                        @endif
                        </div>
                    </div>
                </div>
                <!--/ Payment Methods -->

            </div>
            @endif
        </div>
        
    </div>
    <!--/ User Content -->
</div>

<!-- Modal -->
@include('_partials/_modals/modal-edit-user')
@include('_partials/_modals/modal-edit-cc')
@include('_partials/_modals/modal-add-new-address')
@include('_partials/_modals/modal-add-new-cc')
@include('_partials/_modals/modal-upgrade-plan')
<!-- /Modal -->
@endsection