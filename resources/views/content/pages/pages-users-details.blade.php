@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Profilo')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-user-view.css')}}" />
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')
<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        
        <h1 class="h3 text-black mb-4">Profilo</h4>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('assets/img/avatars/15.png') }}" height="100" width="100" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4 class="text-black mt-3">Italia Trasporti</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around flex-wrap  pb-4 border-bottom">
                    <div class="d-flex align-items-start me-4 mt-1 gap-2">
                        <i class='wf-icon-location ti-sm text-black'></i>
                        <div>
                            Napoli
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-1 gap-2">
                        <i class='wf-icon-calendar ti-sm text-black'></i>
                        <div>
                            Da Marzo 2023
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
                                <span class="about-iconlist__val">John Doe</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-location"></span>
                                <span class="about-iconlist__name">Sede:</span>
                                <span class="about-iconlist__val">Via Francesco Del Giudice 41, Fibbiana</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-check"></span>
                                <span class="about-iconlist__name">Status:</span>
                                <span class="about-iconlist__val">Active</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-crown"></span>
                                <span class="about-iconlist__name">Role:</span>
                                <span class="about-iconlist__val">Deposito diretto</span>
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
                                <span class="about-iconlist__val">333 565 7677</span>
                            </li>
                            <li class="about-iconlist__item">
                                <span class="about-iconlist__icon wf-icon-mail"></span>
                                <span class="about-iconlist__name">Pec:</span>
                                <span class="about-iconlist__val">italiatrasporti@pec.it</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="badge bg-label-primary">Standard</span>
                    <div class="d-flex justify-content-center">
                        <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                        <h1 class="fw-semibold mb-0 text-primary">99</h1>
                        <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                    </div>
                </div>
                <ul class="ps-3 g-2 my-3">
                    <li class="mb-2">10 Users</li>
                    <li class="mb-2">Up to 10 GB storage</li>
                    <li>Basic Support</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mb-1 fw-semibold text-heading">
                    <span>Days</span>
                    <span>65% Completed</span>
                </div>
                <div class="progress mb-1" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>4 days remaining</span>
                <div class="d-grid w-100 mt-4">
                    <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>
                </div>
            </div>
        </div>

    </div>

    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="ti ti-user-check ti-xs me-1"></i>Account</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/security')}}"><i class="ti ti-lock ti-xs me-1"></i>Security</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/billing')}}"><i class="ti ti-currency-dollar ti-xs me-1"></i>Billing & Plans</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/notifications')}}"><i class="ti ti-bell ti-xs me-1"></i>Notifications</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('app/user/view/connections')}}"><i class="ti ti-link ti-xs me-1"></i>Connections</a></li>
        </ul>
        <!--/ User Pills -->

        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="text-black m-0">Anagrafica</h4>
            </div>
            <div class="card-body pt-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Ragione sociale</h6>
                        <p class="mb-0">Italia Trasporti S.p.A.</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Partita IVA</h6>
                        <p class="mb-0">183293203023</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Cellulare referente</h6>
                        <p class="mb-0"><span class="text-black">+39</span> 2526965</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">PEC</h6>
                        <p class="mb-0">italiatrasporti@pec.it</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Codice fiscale</h6>
                        <p class="mb-0">SYBWD878JSK9DSM9</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Nominativo Amministratore</h6>
                        <p class="mb-0">Mario Rossi</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Attività principale </h6>
                        <p class="mb-0">Deposito diretto Raffineria</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Indirizzo</h6>
                        <p class="mb-0">Via Battisti</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Numero civico</h6>
                        <p class="mb-0">23</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Comune</h6>
                        <p class="mb-0">Napoli</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Provincia</h6>
                        <p class="mb-0">NA</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">CAP</h6>
                        <p class="mb-0">80020</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="text-black m-0">Operatività</h4>
            </div>
            <div class="card-body pt-4">
                <div class="row g-4">

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Capacità di stoccaggio</h6>
                        <p class="mb-0">Motrice a 2 assi</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Limiti di capacità ordini</h6>
                        <p class="mb-0">1.000 - 18.000</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Prodotti disponibili</h6>
                        <p class="mb-0">Gasolio, Adblue</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Copertura geografica regioni</h6>
                        <p class="mb-0">Campania</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Copertura geografica province</h6>
                        <p class="mb-0">NA, CE</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Tempo limite ordine giornaliero</h6>
                        <p class="mb-0">11:00</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">CAP</h6>
                        <p class="mb-0">80020</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">CAP</h6>
                        <p class="mb-0">80020</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">CAP</h6>
                        <p class="mb-0">80020</p>
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
                        <p class="mb-0">IBAN: IT17128739239820398832 <br>
                        Banca: Intesa San Paolo</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">Assegno Bancario</h6>
                        <p class="mb-0">Italia Trasporti S.p.A.</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">RIBA</h6>
                        <p class="mb-0">Si</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6 class="text-black mb-2">RID</h6>
                        <p class="mb-0">Si</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!--/ User Content -->
</div>
@endsection