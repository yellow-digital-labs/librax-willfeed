@php
$configData = Helper::appClasses();
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
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        
        <h1 class="h3 text-black mb-4">Profilo</h4>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('assets/img/81160511660785db8768a15358306893.jpg') }}" height="100" width="100" alt="User avatar" />
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
            </div>
        </div>

    </div>

    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
        <ul class="nav nav-pills flex-column flex-md-row mb-4 card-header-pills">
            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Profilo" aria-controls="navs-pills-top-Profilo" aria-selected="true"><i class="wf-icon-User-Info ti-xs me-1"></i>Profilo</a></li>

            <li class="nav-item"><a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Fatturazione" aria-controls="navs-pills-top-Fatturazione" aria-selected="true"><i class="wf-icon-file-text1 ti-xs me-1"></i>Fatturazione</a></li>
        </ul>
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

                <div class="card mb-4">
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

            <div class="tab-pane fade" id="navs-pills-top-Fatturazione" role="tabpanel">

                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Il tuo piano Willfeed</h4>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-4">

                            <div class="col-sm-6 col-12">
                                <h2 class="text-black mb-2">Base</h2>

                                <h6 class="mb-1">Scade il 30/12/2023</h6>
                                <p>Riceverai una notifica alla scadenza del piano</p>

                                <h6 class="mb-1">$19 al mese <span class="badge bg-label-primary badge--primary">Popolare</span></h6>
                                <p class="mb-3">Il piano standard per iniziare</p>

                                <button type="button" class="btn btn-primary waves-effect waves-light me-2 mt-2">Salva</button>

                                <button type="button" class="btn btn-outline-dark waves-effect mt-2">Indietro</button>

                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading">Piano in scadenza</h5>
                                    <p class="mb-0 fw-normal">Aggiorna il metodo di pagamento</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1 fw-semibold text-heading">
                                    <span>Giorni</span>
                                    <span>6 giorni rimasti</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>6 giorni rimasti alla scadenza.</span>
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
                            <!-- Basic -->
                            <div class="col-lg mb-md-0 mb-4">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{asset('assets/img/illustrations/page-pricing-basic.png')}}" alt="Basic Image" height="140">
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-3 h5">Base</h3>
                                        <p class="text-center">Per iniziare</p>
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                                <h1 class="fw-semibold display-4 mb-0 text-primary">0</h1>
                                                <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/mese</sub>
                                            </div>
                                        </div>
                                        <ul class="ps-0 my-4 pt-2 list-disc">
                                            <li>100 responses a month</li>
                                            <li>Unlimited forms and surveys</li>
                                            <li>Unlimited fields</li>
                                            <li>Basic form creation tools</li>
                                            <li>Up to 2 subdomains</li>
                                        </ul>
                                        <a href="{{url('auth/register-basic')}}" class="btn btn-label-success d-grid w-100">Your Current Plan</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Pro -->
                            <div class="col-lg mb-md-0 mb-4">
                                <div class="card border-primary border shadow-none">
                                    <div class="card-body position-relative">
                                        <div class="position-absolute end-0 me-4 top-0 mt-4">
                                            <span class="badge bg-label-primary badge--primary">Popular</span>
                                        </div>
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{asset('assets/img/illustrations/page-pricing-standard.png')}}" alt="Standard Image" height="140">
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-3 h5">Standard</h3>
                                        <p class="text-center">Per medie imprese</p>
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
                                                <h1 class="price-toggle price-yearly fw-semibold display-4 text-primary mb-0">19</h1>
                                                <sub class="h6 text-muted pricing-duration mt-auto mb-2 fw-normal">/mese</sub>
                                            </div>
                                        </div>
                                        <ul class="ps-0 my-4 pt-2 list-disc">
                                            <li>Unlimited responses</li>
                                            <li>Unlimited forms and surveys</li>
                                            <li>Instagram profile page</li>
                                            <li>Google Docs integration</li>
                                            <li>Custom “Thank you” page</li>
                                        </ul>
                                        <a href="{{url('auth/register-basic')}}" class="btn btn-primary d-grid w-100">Upgrade</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Enterprise -->
                            <div class="col-lg">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{asset('assets/img/illustrations/page-pricing-enterprise.png')}}" alt="Enterprise Image" height="140">
                                        </div>
                                        <h3 class="card-title fw-semibold text-center text-capitalize mb-3 h5">Enterprise</h3>
                                        <p class="text-center">Per grandi <br> aziende</p>
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 text-primary pricing-currency mt-3 mb-0 me-1">$</sup>
                                                <h1 class="price-toggle price-yearly fw-semibold display-4 text-primary mb-0">29</h1>
                                                <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/mese</sub>
                                            </div>
                                        </div>
                                        <ul class="ps-0 my-4 pt-2 list-disc">
                                            <li>PayPal payments</li>
                                            <li>Logic Jumps</li>
                                            <li>File upload with 5 GB storage</li>
                                            <li>Monthly updates</li>
                                            <li>Custom domain support</li>
                                        </ul>
                                        <a href="{{url('auth/register-basic')}}" class="btn btn-label-primary d-grid w-100">Upgrade</a>
                                    </div>
                                </div>
                            </div>
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
                            <div class="cardMaster border p-3 rounded mb-3">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                    <div class="card-information">
                                        <img class="mb-3 img-fluid" src="{{asset('assets/img/icons/payments/mastercard.png')}}" alt="Master Card">
                                        <h6 class="mb-2 pt-1">Kaith Morrison</h6>
                                        <span class="card-number">&#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; 9856</span>
                                    </div>
                                    <div class="d-flex flex-column text-start text-lg-end">
                                        <div class="d-flex order-sm-0 order-1 mt-3">
                                            <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#editCCModal">Modifica</button>
                                            <button class="btn btn-outline-dark">Elimina</button>
                                        </div>
                                        <small class="mt-sm-auto mt-2 order-sm-1 order-0">Scadenza 03/2024</small>
                                    </div>
                                </div>
                            </div>
                            <div class="cardMaster border p-3 rounded mb-3">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                    <div class="card-information">
                                        <img class="mb-3 img-fluid" src="{{asset('assets/img/icons/payments/visa.png')}}" alt="Master Card">
                                        <div class="d-flex align-items-center mb-2 pt-1">
                                            <h6 class="mb-0 me-3">Tom McBride</h6>
                                            <span class="badge bg-label-primary me-1 badge--primary">Principale</span>
                                        </div>
                                        <span class="card-number">&#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; 6542</span>
                                    </div>
                                    <div class="d-flex flex-column text-start text-lg-end">
                                        <div class="d-flex order-sm-0 order-1 mt-3">
                                            <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#editCCModal">Modifica</button>
                                            <button class="btn btn-outline-dark">Elimina</button>
                                        </div>
                                        <small class="mt-sm-auto mt-2 order-sm-1 order-0">Scadenza 05/2025</small>
                                    </div>
                                </div>
                            </div>
                            <div class="cardMaster border p-3 rounded">
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                    <div class="card-information">
                                        <img class="mb-3 img-fluid" src="{{asset('assets/img/icons/payments/american-ex.png')}}" alt="Visa Card">
                                        <h6 class="mb-2 pt-1">Mildred Wagner</h6>
                                        <span class="card-number">&#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; 5896</span>
                                    </div>
                                    <div class="d-flex flex-column text-start text-lg-end">
                                        <div class="d-flex order-sm-0 order-1 mt-3">
                                            <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#editCCModal">Modifica</button>
                                            <button class="btn btn-outline-dark">Elimina</button>
                                        </div>
                                        <small class="mt-sm-auto mt-2 order-sm-1 order-0">Scadenza 05/2025</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Payment Methods -->

            </div>
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