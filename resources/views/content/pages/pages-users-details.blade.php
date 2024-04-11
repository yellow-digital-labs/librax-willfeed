@php
$configData = Helper::appClasses();
// if($isOnlyProfile){
//     $isMenu = false;
//     $navbarHideToggle = false;
// }
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
<!-- Edit Profle Modal js -->
 <script src="{{asset('assets/js/user-edit-profile.js?version=1')}}"></script> 
<script src="{{asset('assets/js/modal-edit-user.js?version=1')}}"></script>
<script src="{{asset('assets/js/modal-edit-cc.js?version=1')}}"></script>
<script src="{{asset('assets/js/modal-add-new-cc.js?version=1')}}"></script>
<script src="{{asset('assets/js/modal-add-new-address.js?version=1')}}"></script>
<script src="{{asset('assets/js/app-user-view.js?version=1')}}"></script>
<!-- Extend Free Trail js -->
<script src="{{asset('assets/js/user-extend-free-trial.js?version=1')}}"></script>
<script src="{{asset('assets/js/app-user-view-billing.js?version=1')}}"></script>
@if(!$isOnlyProfile)
@php
$remainingDays = App\Helpers\Helpers::getDaysBetweenDates(date('Y-m-d H:i:s', time()), $user->exp_datetime);
@endphp
@if($remainingDays<0)
<script>
let baseUrl ={{url('/')}};
$(document).ready(function () {
    Swal.fire({
        text: "Per continuare, acquista un abbonamento.",
        icon: 'warning',
        showCancelButton: false,
        customClass: {
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: true
    });
});
</script>
@endif
@endif
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
        <!-- User Pills -->
        @if(!$isOnlyProfile)
        <ul class="nav nav-pills flex-row mb-4 card-header-pills">
            <div class="d-flex flex-grow-1">
                <li class="nav-item"><a class="nav-link {{$is_expired?'':'active'}}" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Profilo" aria-controls="navs-pills-top-Profilo" aria-selected="true"><i class="wf-icon-User-Info ti-xs me-1"></i>Profilo</a></li>
                <li class="nav-item"><a class="nav-link {{$is_expired?'active':''}}" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Fatturazione" aria-controls="navs-pills-top-Fatturazione" aria-selected="true"><i class="wf-icon-file-text1 ti-xs me-1"></i>Abbonamento</a></li>
            </div>
            <!-- Update User Profile Button -->
            @if(!$is_new_data)
            <li class="nav-item seller-profile-edit-btn"><a class="btn btn-primary" href="{{ route('profile-edit') }}" aria-controls="navs-pills-top-Fatturazione" aria-selected="true">Modifica Profilo</a></li>
            @endif
            @if($is_new_data)
            <!-- User Profle Review Button -->
            <li class="nav-item seller-proile-review-btn"  style="pointer-events: none;"><a class="btn btn-secondary " href="javascript:void(0);" aria-controls="navs-pills-top-Fatturazione" aria-selected="true">lnvia richiesta</a></li>
            @endif
        </ul>
        @endif
        @if($authUser->accountType==0)
        <ul class="nav nav-pills flex-row mb-4 card-header-pills user-details-actions">
            @if($user->approved_by_admin == "Pending" || $user->approved_by_admin == "No")
            <li class="nav-item flex-grow-1"><a href="javascript:;" data-id="{{$user->id}}" class="btn btn-primary btn-approve" href="javascript:void(0);"><i class="wf-icon-check ti-xs me-1"></i>Verify</a></li>
            @endif

            @if($user->approved_by_admin == "Pending" || $user->approved_by_admin == "Yes")
            <li class="nav-item flex-grow-1"><a href="javascript:;" data-id="{{$user->id}}" class="btn btn-primary btn-reject" href="javascript:void(0);"><i class="wf-icon-no ti-xs me-1"></i>Unverify</a></li>
            @endif

            <!-- Extend Free trial button  -->
            <li class="nav-item user-extend-free-trial-btn" data-user-id="{{ $user->id }}"><a href="javascript:;" data-id="{{$user->id}}" class="btn btn-outline-primary" href="javascript:void(0);">ESTENDI PROVA GRATUITA</a></li>

            @if($is_new_data)
            <!-- approve edit button  -->
            <li class="nav-item ms-2 user-approve-btn" data-user-id="{{ $user->id }}"><a href="javascript:;" data-id="{{$user->id}}" class="btn btn-outline-primary" href="javascript:void(0);"> Aprrova modifiche</a></li>

             <!-- Refuse edit button  -->
            <li class="nav-item  ms-2 user-Refuse-btn" data-user-id="{{ $user->id }}" ><a href="javascript:;" data-id="{{$user->id}}" class="btn btn-outline-primary" href="javascript:void(0);">Rifiuta modifiche</a></li>
            @endif
        </ul>
        @endif
    
        <!--/ User Pills -->
        <div class="tab-content p-0 @if($isOnlyProfile && $authUser->accountType!=0) tab-content-buyer @endif">
            <div class="tab-pane fade {{$is_expired?'':'show active'}}" id="navs-pills-top-Profilo" role="tabpanel">

                <div class="card mb-4">
                    <div class="card-header border-bottom" style="background-color: #FFE000;">
                        <h4 class="text-black m-0">Anagrafica</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Ragione sociale</h6>
                                @if($is_new_data && $user_detail->business_name !== $new_user_detail->business_name)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->business_name?$user_detail->business_name:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->business_name?$new_user_detail->business_name:'NA'}}</p>
                                </div>
                                @else
                                <p class="mb-0">{{$user_detail->business_name?$user_detail->business_name:'NA'}}</p>
                                @endif
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Partita IVA</h6>
                                 @if( $is_new_data && $user_detail->vat_number !== $new_user_detail->vat_number)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->vat_number?$user_detail->vat_number:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->vat_number?$new_user_detail->vat_number:'NA'}}</p>
                                </div>
                                @else
                                <p class="mb-0">{{$user_detail->vat_number?$user_detail->vat_number:'NA'}}</p>
                                @endif
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Cellulare referente</h6>
                                 @if( $is_new_data && $user_detail->contact_person !== $new_user_detail->contact_person)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through"><span class="text-black me-2">+39</span>{{$user_detail->contact_person?$user_detail->contact_person:'NA'}}</p>
                                    <p class="ms-2"><span class="text-black me-2">+39</span>{{$new_user_detail->contact_person?$new_user_detail->contact_person:'NA'}}</p>
                                </div>
                                @else
                                <p class="mb-0"><span class="text-black me-2">+39</span>{{$user_detail->contact_person?$user_detail->contact_person:'NA'}}</p>
                                @endif
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">PEC</h6>
                                 @if( $is_new_data && $user_detail->pec !== $new_user_detail->pec)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->pec?$user_detail->pec:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->pec?$new_user_detail->pec:'NA'}}</p>
                                </div>
                                @else
                                  <p class="mb-0">{{$user_detail->pec?$user_detail->pec:'NA'}}</p>
                                @endif
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Codice fiscale</h6>
                                   @if( $is_new_data && $user_detail->tax_id_code !== $new_user_detail->tax_id_code)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->tax_id_code?$user_detail->tax_id_code:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->tax_id_code?$new_user_detail->tax_id_code:'NA'}}</p>
                                </div>
                                @else
                                  <p class="mb-0">{{$user_detail->tax_id_code?$user_detail->tax_id_code:'NA'}}</p>
                                @endif
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Nominativo Amministratore</h6>
                               @if($is_new_data && $user_detail->administrator_name !== $new_user_detail->administrator_name)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->administrator_name?$user_detail->administrator_name:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->administrator_name?$new_user_detail->administrator_name:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->administrator_name?$user_detail->administrator_name:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Attività principale </h6>
                                
                                 @if( $is_new_data && $user_detail->main_activity_ids !== $new_user_detail->main_activity_ids)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->main_activity_ids?$user_detail->main_activity_ids:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->main_activity_ids?$new_user_detail->main_activity_ids:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->main_activity_ids?$user_detail->main_activity_ids:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Indirizzo</h6>
                                   @if( $is_new_data && $user_detail->address !== $new_user_detail->address)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->address?$user_detail->address:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->address?$new_user_detail->address:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->address?$user_detail->address:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero civico</h6>
                               @if($is_new_data && $user_detail->house_no !== $new_user_detail->house_no)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->house_no?$user_detail->house_no:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->house_no?$new_user_detail->house_no:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->house_no?$user_detail->house_no:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Regione</h6>
                               
                                   @if($is_new_data && $user_detail->region !== $new_user_detail->region)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->region?$user_detail->region:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->region?$new_user_detail->region:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->region?$user_detail->region:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Provincia</h6>
                           
                                   @if( $is_new_data && $user_detail->province !== $new_user_detail->province)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->province?$user_detail->province:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->province?$new_user_detail->province:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->province?$user_detail->province:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Comune</h6>
                                   @if( $is_new_data && $user_detail->common !== $new_user_detail->common)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->common?$user_detail->common:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->common?$new_user_detail->common:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->common?$user_detail->common:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CAP</h6>
                                   @if( $is_new_data && $user_detail->pincode !== $new_user_detail->pincode)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->pincode?$user_detail->pincode:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->pincode?$new_user_detail->pincode:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->pincode?$user_detail->pincode:'NA'}}</p>
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->accountType==2)
                <div class="card mb-4">
                    <div class="card-header border-bottom" style="background-color: #FF9300;">
                        <h4 class="text-black m-0">Operatività</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Capacità di stoccaggio</h6>

                                  @if( $is_new_data && $user_detail->storage_capacity !== $new_user_detail->storage_capacity)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->storage_capacity?$user_detail->storage_capacity:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->storage_capacity?$new_user_detail->storage_capacity:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->storage_capacity?$user_detail->storage_capacity:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Limiti di capacità ordini</h6>
                                <!-- <p class="mb-0">{{$user_detail->order_capacity_limits?$user_detail->order_capacity_limits.' litri':'NA'}} - {{$user_detail->order_capacity_limits_new?$user_detail->order_capacity_limits_new.' litri':'NA'}}</p> -->
                                  @if( $is_new_data && ( $user_detail->order_capacity_limits !== $new_user_detail->order_capacity_limits || $user_detail->order_capacity_limits_new !== $new_user_detail->order_capacity_limits_new ))
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->order_capacity_limits?$user_detail->order_capacity_limits.' litri':'NA'}} - {{$user_detail->order_capacity_limits_new?$user_detail->order_capacity_limits_new.' litri':'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->order_capacity_limits?$new_user_detail->order_capacity_limits.' litri':'NA'}} - {{$new_user_detail->order_capacity_limits_new?$new_user_detail->order_capacity_limits_new.' litri':'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->order_capacity_limits?$user_detail->order_capacity_limits.' litri':'NA'}} - {{$user_detail->order_capacity_limits_new?$user_detail->order_capacity_limits_new.' litri':'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Prodotti disponibili</h6>
                                  @if($is_new_data && $user_detail->available_products !== $new_user_detail->available_products)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->available_products?$user_detail->available_products:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->available_products?$new_user_detail->available_products:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->available_products?$user_detail->available_products:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Copertura geografica regioni</h6>
                                  @if( $is_new_data && $user_detail->geographical_coverage_regions !== $new_user_detail->geographical_coverage_regions)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->geographical_coverage_regions?$user_detail->geographical_coverage_regions:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->geographical_coverage_regions?$new_user_detail->geographical_coverage_regions:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->geographical_coverage_regions?$user_detail->geographical_coverage_regions:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Copertura geografica province</h6>
                          
                                  @if( $is_new_data && $user_detail->geographical_coverage_provinces !== $new_user_detail->geographical_coverage_provinces)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->geographical_coverage_provinces?$user_detail->geographical_coverage_provinces:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->geographical_coverage_provinces?$new_user_detail->geographical_coverage_provinces:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->geographical_coverage_provinces?$user_detail->geographical_coverage_provinces:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tempo limite accettazione ordine</h6>
                                
                              @if( $is_new_data && $user_detail->time_limit_daily_order !== $new_user_detail->time_limit_daily_order)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->time_limit_daily_order?$user_detail->time_limit_daily_order:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->time_limit_daily_order?$new_user_detail->time_limit_daily_order:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->time_limit_daily_order?$user_detail->time_limit_daily_order:'NA'}}</p>
                                @endif 
                            </div>
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Licenza di esercizio</h6>
                                  @if( $is_new_data && $user_detail->file_operating_license !== $new_user_detail->file_operating_license && $new_user_detail->file_operating_license !='')
                                <div class="d-flex">
                                    <p class="mb-0 strike-through"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_operating_license)}}" target="_blank">View Document</a></p>
                                    <p class="ms-2"><a href="{{Illuminate\Support\Facades\Storage::url($new_user_detail->file_operating_license)}}" target="_blank">View Document</a></p>
                                </div>
                                @else
                                  <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_operating_license)}}" target="_blank">View Document</a></p>
                                @endif 
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
                                <!-- <p class="mb-0">IBAN: {{$user_detail->bank_transfer?$user_detail->bank_transfer:'NA'}} <br>
                                Banca: {{$user_detail->bank?$user_detail->bank:'NA'}}</p>
                                -->
                            @if( $is_new_data && ($user_detail->bank_transfer !== $new_user_detail->bank_transfer || $user_detail->bank !== $new_user_detail->bank) )
                                <div class="d-flex">
                                <p class="mb-0 strike-through">IBAN: {{$user_detail->bank_transfer?$user_detail->bank_transfer:'NA'}} <br>
                                Banca: {{$user_detail->bank?$user_detail->bank:'NA'}}</p>
                                   <p class="ms-2">IBAN: {{$new_user_detail->bank_transfer?$new_user_detail->bank_transfer:'NA'}} <br>
                                Banca: {{$new_user_detail->bank?$new_user_detail->bank:'NA'}}</p>
                                </div>
                             @else
                                 <p class="mb-0">IBAN: {{$user_detail->bank_transfer?$user_detail->bank_transfer:'NA'}} <br>
                                Banca: {{$user_detail->bank?$user_detail->bank:'NA'}}</p>
                            @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Assegno Bancario</h6>
                     
                            @if( $is_new_data && $user_detail->bank_check !== $new_user_detail->bank_check)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->bank_check?$user_detail->bank_check:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->bank_check?$new_user_detail->bank_check:'NA'}}</p>
                                </div>
                            @else
                                   <p class="mb-0">{{$user_detail->bank_check?$user_detail->bank_check:'NA'}}</p>
                            @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">RIBA</h6>
                            
                            @if( $is_new_data && $user_detail->rib !== $new_user_detail->rib)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->rib?$user_detail->rib:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->rib?$new_user_detail->rib:'NA'}}</p>
                                </div>
                            @else
                                   <p class="mb-0">{{$user_detail->rib?$user_detail->rib:'NA'}}</p>
                            @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">RID</h6>
                            @if($is_new_data && $user_detail->rid !== $new_user_detail->rid)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->rid?$user_detail->rid:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->rid?$new_user_detail->rid:'NA'}}</p>
                                </div>
                            @else
                                   <p class="mb-0">{{$user_detail->rid?$user_detail->rid:'NA'}}</p>
                            @endif 
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($user->accountType==1)
                <div class="card mb-4">
                    <div class="card-header border-bottom" style="background-color: #FF9300;">
                        <h4 class="text-black m-0">Destinazione</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Facilità di accesso</h6>
                                @if($is_new_data && $user_detail->ease_of_access !== $new_user_detail->ease_of_access)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->ease_of_access?$user_detail->ease_of_access:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->ease_of_access?$new_user_detail->ease_of_access:'NA'}}</p>
                                    </div>
                                @else
                                    <p class="mb-0">{{$user_detail->ease_of_access?$user_detail->ease_of_access:'NA'}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Cellulare referente di scarico</h6>
                                  @if($is_new_data && $user_detail->mobile_unloading !== $new_user_detail->mobile_unloading)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->mobile_unloading?$user_detail->mobile_unloading:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->mobile_unloading?$new_user_detail->mobile_unloading:'NA'}}</p>
                                    </div>
                                @else
                                    <p class="mb-0">{{$user_detail->mobile_unloading?$user_detail->mobile_unloading:'NA'}}</p>
                                @endif 
                               
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Indirizzo destinazione (se diverso da anagrafica)</h6>
                                @if($is_new_data && $user_detail->destination_address !== $new_user_detail->destination_address)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_address?$user_detail->destination_address:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_address?$new_user_detail->destination_address:'NA'}}</p>
                                    </div>
                                @else
                                   <p class="mb-0">{{$user_detail->destination_address?$user_detail->destination_address:'NA'}}</p>
                                @endif 
                                
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Indirizzo</h6>
                                 @if($is_new_data && $user_detail->destination_address !== $new_user_detail->destination_address)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_address?$user_detail->destination_address:'NA'}}</p>
                                        <p class="ms-2">{{$user_detail->destination_address=='Si'?$user_detail->destination_address_via:$user_detail->address}}</p>
                                    </div>
                                @else
                                   <p class="mb-0">{{$user_detail->destination_address=='Si'?$user_detail->destination_address_via:$user_detail->address}}</p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero civico</h6>
                                  @if($is_new_data && $user_detail->destination_house_no !== $new_user_detail->destination_house_no)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_house_no?$user_detail->destination_house_no:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_house_no?$new_user_detail->destination_house_no:'NA'}}</p>
                                    </div>
                                @else
                                  <p class="mb-0">{{$user_detail->destination_address=='Si'?$user_detail->destination_house_no:$user_detail->house_no}}</p>
                                @endif 
                                
                            </div>
                              
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Regione</h6>
                                  @if($is_new_data && $user_detail->destination_region !== $new_user_detail->destination_region)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_region?$user_detail->destination_region:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_region?$new_user_detail->destination_region:'NA'}}</p>
                                    </div>
                                @else
                                     <p class="mb-0">{{$user_detail->destination_region=='Si'?$user_detail->destination_region:$user_detail->region}}</p>
                                @endif 
                             
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Provincia</h6>
                                  @if($is_new_data && $user_detail->destination_province !== $new_user_detail->destination_province)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_province?$user_detail->destination_province:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_province?$new_user_detail->destination_province:'NA'}}</p>
                                    </div>
                                @else
                                     <p class="mb-0">{{$user_detail->destination_address=='Si'?$user_detail->destination_province:$user_detail->province}}</p>
                                @endif 
                            
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Comune</h6>
                                  @if($is_new_data && $user_detail->destination_common !== $new_user_detail->destination_common)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_common?$user_detail->destination_common:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_common?$new_user_detail->destination_common:'NA'}}</p>
                                    </div>
                                @else
                                    <p class="mb-0">{{$user_detail->destination_common=='Si'?$user_detail->destination_common:$user_detail->common}}</p>
                                @endif 
                     
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CAP</h6>
                                  @if($is_new_data && $user_detail->destination_pincode !== $new_user_detail->destination_pincode)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->destination_pincode?$user_detail->destination_pincode:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->destination_pincode?$new_user_detail->destination_pincode:'NA'}}</p>
                                    </div>
                                @else
                                     <p class="mb-0">{{$user_detail->destination_pincode=='Si'?$user_detail->destination_pincode:$user_detail->pincode}}</p>
                                @endif 
                              
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Codice licenza cisterna</h6>
                                @if($is_new_data && $user_detail->minor_plant_code !== $new_user_detail->minor_plant_code)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->minor_plant_code)}}" target="_blank">View Document</a></p>
                                        <p class="ms-2"><a href="{{Illuminate\Support\Facades\Storage::url($new_user_detail->minor_plant_code)}}" target="_blank">View Document</a></p>
                                    </div>
                                @else
                                    <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->minor_plant_code)}}" target="_blank">View Document</a></p>
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header border-bottom" style="color: #FFFFFF; background-color: #941100;">
                        <h4 class="m-0" style="color: #FFFFFF;">Fatturazione</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Dilazione di pagamento preferita</h6>
                                  @if($is_new_data && $user_detail->payment_extension !== $new_user_detail->payment_extension)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->payment_extension?$user_detail->payment_extension:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->payment_extension?$new_user_detail->payment_extension:'NA'}}</p>
                                    </div>
                                @else
                                 <p class="mb-0">{{$user_detail->payment_extension?$user_detail->payment_extension:'NA'}}</p>
                                @endif 
                            
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Modalità di pagamento</h6>
                                  @if($is_new_data && $user_detail->payment_term !== $new_user_detail->payment_term)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->payment_term?$user_detail->payment_term:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->payment_term?$new_user_detail->payment_term:'NA'}}</p>
                                    </div>
                                @else
                                 <p class="mb-0">{{$user_detail->payment_term?$user_detail->payment_term:'NA'}}</p>
                                @endif 
                                
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Banca di riferimento (RIBA e RID)</h6>
                                  @if($is_new_data && $user_detail->reference_bank !== $new_user_detail->reference_bank)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->reference_bank?$user_detail->reference_bank:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->reference_bank?$new_user_detail->reference_bank:'NA'}}</p>
                                    </div>
                                @else
                                   <p class="mb-0">{{$user_detail->reference_bank?$user_detail->reference_bank:'NA'}}</p>
                                @endif 
                               
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">IBAN (RIBA e RID)</h6>
                                  @if($is_new_data && $user_detail->iban !== $new_user_detail->iban)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->iban?$user_detail->iban:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->iban?$new_user_detail->iban:'NA'}}</p>
                                    </div>
                                @else
                                   <p class="mb-0">{{$user_detail->iban?$user_detail->iban:'NA'}}</p>
                                @endif 
                              
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">SDI</h6>
                                  @if($is_new_data && $user_detail->sdi !== $new_user_detail->sdi)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->sdi?$user_detail->sdi:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->sdi?$new_user_detail->sdi:'NA'}}</p>
                                    </div>
                                @else
                                     <p class="mb-0">{{$user_detail->sdi?$user_detail->sdi:'NA'}}</p>
                                @endif 
                              
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CIG</h6>
                                  @if($is_new_data && $user_detail->cig !== $new_user_detail->cig)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->cig?$user_detail->cig:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->cig?$new_user_detail->cig:'NA'}}</p>
                                    </div>
                                @else
                                   <p class="mb-0">{{$user_detail->cig?$user_detail->cig:'NA'}}</p>
                                @endif 

                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">CUP</h6>
                                  @if($is_new_data && $user_detail->cup !== $new_user_detail->cup)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through">{{$user_detail->cup?$user_detail->cup:'NA'}}</p>
                                        <p class="ms-2">{{$new_user_detail->cup?$new_user_detail->cup:'NA'}}</p>
                                    </div>
                                @else
                                    <p class="mb-0">{{$user_detail->cup?$user_detail->cup:'NA'}}</p>
                                @endif 
                               
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Visura camerale</h6>
                                @if($is_new_data && $user_detail->file_1 !== $new_user_detail->file_1)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_1)}}" target="_blank">View Document</a></p>
                                        <p class="ms-2"><a href="{{Illuminate\Support\Facades\Storage::url($new_user_detail->file_1)}}" target="_blank">View Document</a></p>
                                    </div>
                                @else
                                    <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_1)}}" target="_blank">View Document</a></p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Documento di riconoscimento amministratore</h6>
                                @if($is_new_data && $user_detail->file_2 !== $new_user_detail->file_2 && $new_user_detail->file_2 != '')
                            <div class="d-flex">
                                <p class="mb-0 strike-through"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_2)}}" target="_blank">View Document</a></p>
                                <p class="ms-2"><a href="{{Illuminate\Support\Facades\Storage::url($new_user_detail->file_2)}}" target="_blank">View Document</a></p>
                            </div>
                                @else
                                    <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_2)}}" target="_blank">View Document</a></p>
                                @endif 
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Esenzione IVA</h6>
                                  @if($is_new_data && $user_detail->file_3 !== $new_user_detail->file_3)
                                    <div class="d-flex">
                                        <p class="mb-0 strike-through"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_3)}}" target="_blank">View Document</a></p>
                                        <p class="ms-2"><a href="{{Illuminate\Support\Facades\Storage::url($new_user_detail->file_3)}}" target="_blank">View Document</a></p>
                                    </div>
                                @else
                                    <p class="mb-0"><a href="{{Illuminate\Support\Facades\Storage::url($user_detail->file_3)}}" target="_blank">View Document</a></p>
                                @endif 
                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 mb-4">
                    <div class="card-header border-bottom" style="background-color: #0433FF;">
                        <h4 class="m-0" style="color: #FFFFFF;">Profilo</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tipologia di prodotti consumati</h6>
                                @if($is_new_data && $user_detail->products !== $new_user_detail->products)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->products?$user_detail->products:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->products?$new_user_detail->products:'NA'}}</p>
                                </div>
                                @else
                                  <p class="mb-0">{{$user_detail->products?$user_detail->products:'NA'}}</p>
                                @endif 
                              
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Consumi medi mensili</h6>
                                @if($is_new_data && $user_detail->monthly_consumption !== $new_user_detail->monthly_consumption)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->monthly_consumption?$user_detail->monthly_consumption:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->monthly_consumption?$new_user_detail->monthly_consumption:'NA'}}</p>
                                </div>
                                @else
                                     <p class="mb-0">{{$user_detail->monthly_consumption?$user_detail->monthly_consumption:'NA'}}</p>
                                @endif 
                              
                            </div>

                            @if($user_detail->is_private_distributer=='Si')
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Sei un distributore privato?</h6>
                                @if($is_new_data && $user_detail->is_private_distributer !== $new_user_detail->is_private_distributer)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->is_private_distributer?$user_detail->is_private_distributer:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->is_private_distributer?$new_user_detail->is_private_distributer:'NA'}}</p>
                                </div>
                                @else
                                   <p class="mb-0">{{$user_detail->is_private_distributer?$user_detail->is_private_distributer:'NA'}}</p>
                                @endif 
                             
                            </div>

                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Numero di distributori</h6>
                                @if($is_new_data && $user_detail->no_of_distributer !== $new_user_detail->no_of_distributer)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->no_of_distributer?$user_detail->no_of_distributer:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->no_of_distributer?$new_user_detail->no_of_distributer:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->no_of_distributer?$user_detail->no_of_distributer:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->fleet&&$user_detail->fleet>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Flotta</h6>
                                 @if($is_new_data && $user_detail->fleet !== $new_user_detail->fleet)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->fleet?$user_detail->fleet:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->fleet?$new_user_detail->fleet:'NA'}}</p>
                                </div>
                                @else
                                     <p class="mb-0">{{$user_detail->fleet?$user_detail->fleet:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->type_of_flotta&&$user_detail->type_of_flotta>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Tipologia & Dimensione Flotta</h6>
                                   @if($is_new_data && $user_detail->type_of_flotta !== $new_user_detail->type_of_flotta)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->type_of_flotta?$user_detail->type_of_flotta:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->type_of_flotta?$new_user_detail->type_of_flotta:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->type_of_flotta?$user_detail->type_of_flotta:'NA'}}</p>
                                @endif 
                               
                            </div>
                            @endif

                            @if($user_detail->folding_trucks&&$user_detail->folding_trucks>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Ribaltabili</h6>
                                @if($is_new_data && $user_detail->folding_trucks !== $new_user_detail->folding_trucks)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->folding_trucks?$user_detail->folding_trucks:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->folding_trucks?$new_user_detail->folding_trucks:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->folding_trucks?$user_detail->folding_trucks:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->van_trucks&&$user_detail->van_trucks>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Furgonati</h6>
                                         @if($is_new_data && $user_detail->van_trucks !== $new_user_detail->van_trucks)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->van_trucks?$user_detail->van_trucks:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->van_trucks?$new_user_detail->van_trucks:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->van_trucks?$user_detail->van_trucks:'NA'}}</p>
                                @endif 
                               
                            </div>
                            @endif
                            
                            @if($user_detail->hundred_trucks&&$user_detail->hundred_trucks>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Centinato</h6>
                              @if($is_new_data && $user_detail->hundred_trucks !== $new_user_detail->hundred_trucks)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->hundred_trucks?$user_detail->hundred_trucks:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->hundred_trucks?$new_user_detail->hundred_trucks:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->hundred_trucks?$user_detail->hundred_trucks:'NA'}}</p>
                                @endif 
                            </div>
                            @endif

                            @if($user_detail->chassis_trucks&&$user_detail->chassis_trucks>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion a telaio</h6>
                                @if($is_new_data && $user_detail->chassis_trucks !== $new_user_detail->chassis_trucks)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->chassis_trucks?$user_detail->chassis_trucks:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->chassis_trucks?$new_user_detail->chassis_trucks:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->chassis_trucks?$user_detail->chassis_trucks:'NA'}}</p>
                                @endif 
                                
                            </div>
                            @endif

                            @if($user_detail->fixed_cassone_truck&&$user_detail->fixed_cassone_truck>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion a cassone Fisso</h6>
                                   @if($is_new_data && $user_detail->fixed_cassone_truck !== $new_user_detail->fixed_cassone_truck)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->fixed_cassone_truck?$user_detail->fixed_cassone_truck:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->fixed_cassone_truck?$new_user_detail->fixed_cassone_truck:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->fixed_cassone_truck?$user_detail->fixed_cassone_truck:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->fridge_truck&&$user_detail->fridge_truck>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Frigo</h6>
                                       @if($is_new_data && $user_detail->fridge_truck !== $new_user_detail->fridge_truck)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->fridge_truck?$user_detail->fridge_truck:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->fridge_truck?$new_user_detail->fridge_truck:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->fridge_truck?$user_detail->fridge_truck:'NA'}}</p>
                                @endif 
                         
                            </div>
                            @endif

                            @if($user_detail->truck_with_crane&&$user_detail->truck_with_crane>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion con Gru</h6>
                                       @if($is_new_data && $user_detail->truck_with_crane !== $new_user_detail->truck_with_crane)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->truck_with_crane?$user_detail->truck_with_crane:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->truck_with_crane?$new_user_detail->truck_with_crane:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->truck_with_crane?$user_detail->truck_with_crane:'NA'}}</p>
                                @endif 
                               
                            </div>
                            @endif

                            @if($user_detail->scarble_truck&&$user_detail->scarble_truck>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Camion Scarrabili</h6>
                                   @if($is_new_data && $user_detail->scarble_truck !== $new_user_detail->scarble_truck)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->scarble_truck?$user_detail->scarble_truck:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->scarble_truck?$new_user_detail->scarble_truck:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->scarble_truck?$user_detail->scarble_truck:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->bitoniere&&$user_detail->bitoniere>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Bitoniere</h6>
                                       @if($is_new_data && $user_detail->bitoniere !== $new_user_detail->bitoniere)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->bitoniere?$user_detail->bitoniere:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->bitoniere?$new_user_detail->bitoniere:'NA'}}</p>
                                </div>
                                @else
                                  <p class="mb-0">{{$user_detail->bitoniere?$user_detail->bitoniere:'NA'}}</p>
                                @endif 
                              
                            </div>
                            @endif

                            @if($user_detail->comircial_vehicle&&$user_detail->comircial_vehicle>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Veicoli Comerciali & Bus</h6>
                                       @if($is_new_data && $user_detail->comircial_vehicle !== $new_user_detail->comircial_vehicle)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->comircial_vehicle?$user_detail->comircial_vehicle:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->comircial_vehicle?$new_user_detail->comircial_vehicle:'NA'}}</p>
                                </div>
                                @else
                                     <p class="mb-0">{{$user_detail->comircial_vehicle?$user_detail->comircial_vehicle:'NA'}}</p>
                                @endif 
                               
                            </div>
                            @endif

                            @if($user_detail->semi_trailer&&$user_detail->semi_trailer>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Semirimorchio</h6>
                                   @if($is_new_data && $user_detail->semi_trailer !== $new_user_detail->semi_trailer)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->semi_trailer?$user_detail->semi_trailer:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->semi_trailer?$new_user_detail->semi_trailer:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->semi_trailer?$user_detail->semi_trailer:'NA'}}</p>
                                @endif 
                       
                            </div>
                            @endif

                            @if($user_detail->trailers&&$user_detail->trailers>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Rimorchi</h6>
                                   @if($is_new_data && $user_detail->trailers !== $new_user_detail->trailers)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->trailers?$user_detail->trailers:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->trailers?$new_user_detail->trailers:'NA'}}</p>
                                </div>
                                @else
                                    <p class="mb-0">{{$user_detail->trailers?$user_detail->trailers:'NA'}}</p>
                                @endif 
                               
                            </div>
                            @endif

                            @if($user_detail->road_tractors&&$user_detail->road_tractors>0)
                            <div class="col-sm-6 col-12">
                                <h6 class="text-black mb-2">Trattori stradali</h6>
                              @if($is_new_data && $user_detail->road_tractors !== $new_user_detail->road_tractors)
                                <div class="d-flex">
                                    <p class="mb-0 strike-through">{{$user_detail->road_tractors?$user_detail->road_tractors:'NA'}}</p>
                                    <p class="ms-2">{{$new_user_detail->road_tractors?$new_user_detail->road_tractors:'NA'}}</p>
                                </div>
                              @else
                                   <p class="mb-0">{{$user_detail->road_tractors?$user_detail->road_tractors:'NA'}}</p>
                              @endif 
                               
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if(!$isOnlyProfile)
            <div class="tab-pane fade {{$is_expired?'show active':''}}" id="navs-pills-top-Fatturazione" role="tabpanel">
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

                                <h6 class="mb-1">
                                    €{{$user->subscription_amount}} al mese
                                    
                                    <span class="badge bg-label-{{$remainingDays>=0?'success':'danger'}} badge--{{$remainingDays>=0?'success':'danger'}}">{{$remainingDays>=0?'Active':'Expired'}}</span></h6>
                                <p class="mb-3">Il piano standard per iniziare</p>
                                {{-- <p class="mb-3 text-danger">Il tuo piano è scaduto, per continuare aggiungi il metodo di pagamento e sottoscrivi il piano</p> --}}

                                {{-- <button type="button" class="btn btn-primary waves-effect waves-light me-2 mt-2">Salva</button> --}}

                                {{-- <button type="button" class="btn btn-outline-dark waves-effect mt-2">Indietro</button> --}}

                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="card-action-element d-flex justify-content-end mb-1">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewCCModal">Paga ora</button>
                                </div>
                                @if($remainingDays<=5 && $remainingDays>=0)
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading">Piano in scadenza</h5>
                                    <p class="mb-0 fw-normal">Aggiorna il metodo di pagamento</p>
                                </div>
                                @endif
                                @if($remainingDays<0)
                                <div class="alert alert-danger" role="alert">
                                    <h5 class="alert-heading">Piano scaduto</h5>
                                    <p class="mb-0 fw-normal">Aggiorna il metodo di pagamento</p>
                                </div>
                                @endif
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
                        @if(count($subscriptions)==0)
                        Nessun piano disponibile
                        @endif
                        @foreach($subscriptions as $subscription)
                            <div class="col-6 mb-md-0 mb-4">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{url("/assets/img/illustrations/page-pricing-basic.png")}}" alt="{{$subscription->name}} Image" height="140">
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
                                        <p>
                                            {!! nl2br($subscription->description) !!}
                                        </p>
                                        @if($subscription->id == $user->subscription_id && $remainingDays >= 0)
                                            <a class="btn btn-label-success d-grid w-100">Your Current Plan</a>
                                        @else
                                            <a href="{{route("plan-update", [
                                                "planid" => $subscription->id
                                            ])}}" class="btn btn-primary d-grid w-100">Change plan</a>
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

@if($isOnlyProfile)
<!-- Reject Reason Modal -->
<div class="modal fade" id="reject-user-data" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<style>
  .input-group {
    margin-bottom: 1rem;
  }

  .error-message {
    color: red;
    font-size: 0.8rem;
    margin-top: 0.2rem;
  }
  .reject-container {
    max-width:80%;
    margin:auto
  }
</style>
<div class="reject-container">
  <h4> Inserisci il motivo del rifiuto</h4>
  <div class="input-group">
    <textarea class="form-control" id="rejectionReason" rows="4" cols="65" placeholder="Enter rejection reason" style="height: 150px;"></textarea>
    <div class="error-message" id="rejectionReasonError"></div>
  </div>
  <button onclick="validateAndSubmit({{$user->id}})" class="btn btn-primary" >Submit</button>
</div>
    </div>
 </div>
</div>
</div>
@endif
@endsection


