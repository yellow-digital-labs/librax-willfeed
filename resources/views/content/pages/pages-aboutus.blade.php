@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Chi siamo')


<!-- CSS Starts -->
@section('head-style') 

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/wf-icon/style.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/pages.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="page-heading">
        <div class="uk-container page-heading__container">
            <h1 class="title title--xl page-heading__title">Chi siamo</h1>
            <div class="page-heading__text">
                <p></p>
            </div>
            <hr class="page-heading__hr">
        </div>
    </div>

    <div class="about">
        <div class="uk-container about__container">

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name">La Nostra Mission</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <p>
                                Benvenuti in WILLFEED il tuo partner  affidabile per l’acquisto di carburanti di qualità online. Siamo più di una piattaforma di vendita, siamo il tuo supporto per un’esperienza di approvvigionamento senza precedenti. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name">Ecco perché siamo diversi</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <h2 class="about-item__title">Senza Intermediari, Solo Qualità</h2>
                            <p>
                                A differenza di altri, su WILLFEED eliminiamo gli intermediari, garantendo che il tuo carburante arrivi direttamente dalla fonte. Ciò significa prodotti di qualità superiore, sempre. 
                            </p>
                        </div>
                        <div class="about-item__text">
                            <p></p>
                            <h2 class="about-item__title">Prodotti Certificati e Clienti Selezionati</h2>
                            <p>
                                Siamo fieri di offrire solo carburanti certificati. Collaboriamo con venditori altamente qualificati e selezioniamo con attenzione i nostri clienti. 
                            </p>
                            <p>
                                La tua soddisfazione è la nostra priorità, e ogni acquisto su WILLFEED è una garanzia di qualità.
                            </p>

                            <h2 class="about-item__title">Assistenza Completa a Tua Disposizione</h2>
                            <p>
                                Il nostro impegno per il servizio va oltre la vendita. Con WILLFEED hai un’assistenza completa a tua disposizione. Il nostro team è pronto a rispondere alle tue domande, risolvere eventuali problemi e garantire che la tua esperienza sia sempre positiva. 
                            </p>

                            <h2 class="about-item__title">Distribuzione su Tutto il Territorio Italiano</h2>
                            <p>
                                Con una copertura nazionale, consegniamo il tuo carburante in ogni angolo d’Italia. Nessun luogo è troppo remoto o difficile da raggiungere. La tua comodità è la nostra priorità.
                            </p>
                            <p>
                                In breve, WILLFEED è il tuo compagno affidabile per l’approvvigionamento di carburanti di qualità. Siamo più di una piattaforma, siamo la tua scelta sicura per un futuro più efficiente e sostenibile.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="landing-video">
        {{-- <div class="uk-container uk-container-expand landing-video__container">
            <div class="landing-video__wrapper">
                
                <button type="button" class="uk-button uk-icon-button landing-video__action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="82" height="82" viewBox="0 0 82 82" fill="none">
                        <circle cx="41" cy="41" r="41" fill="black"/>
                        <path d="M51.0268 39.9336C52.0355 40.7343 52.0355 42.2657 51.0268 43.0664L38.2435 53.2145C36.9328 54.2551 35 53.3216 35 51.6481L35 31.3519C35 29.6784 36.9328 28.7449 38.2435 29.7855L51.0268 39.9336Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div> --}}
    </div>

</main>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>
@endsection
<!-- Scripts Ends -->