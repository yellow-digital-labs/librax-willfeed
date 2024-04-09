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
                        <h2 class="about-item__name" style="color: #941100;">La Nostra Mission</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <p>
                                Benvenuti in WILLFEED il tuo partner affidabile per l’acquisto di carburanti di qualità online.
Siamo più di una piattaforma di vendita, siamo il tuo supporto esclusivo per un’esperienza di
approvvigionamento di carburanti lubrificanti e affini senza precedenti. Su WILLFEED
venditori e acquirenti di tutta Italia possono vendere e acquistare qualsiasi tipo di carburante
in maniere completamente personalizzata, partendo dalla scelta del prodotto, dalla modalità di
pagamento fino alla scelta di dilazione di esso. Scopri subito come funziona
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name" style="color: #0433FF;">Ecco perché siamo diversi</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <h2 class="about-item__title">Dal produttore al consumatore</h2>
                            <p>
                                WILLFEED è l’unica piattaforma che mette in contatto chi vende e chi acquista qualsiasi
prodotto che serva ad alimentare i processi produttivi della tua attività. Ciò significa, avrai a
disposizione tutti i tipi di carburante lubrificante e affini senza nessun costo di
intermediazione ma soprattutto prodotti di qualità superiore, sempre. 
                            </p>
                        </div>
                        <div class="about-item__text">
                            <p></p>
                            <h2 class="about-item__title">Prodotti Certificati e Clienti Selezionati</h2>
                            <p>
                                Siamo fieri di offrire solo carburanti certificati. Collaboriamo con venditori altamente qualificati e selezioniamo con attenzione i nostri clienti. 
                            </p>
                            <p>
                                La tua soddisfazione è la nostra priorità, e ogni acquisto su WILLFEED è una garanzia.
                            </p>

                            <h2 class="about-item__title">Assistenza Completa a Tua Disposizione</h2>
                            <p>
                                Il nostro impegno per il servizio va oltre la vendita. Con WILLFEED hai un’assistenza completa
a tua disposizione. Il nostro team è pronto a rispondere alle tue domande, risolvere eventuali
problemi e garantire che la tua esperienza sia sempre positiva. 
                            </p>

                            <h2 class="about-item__title">Monitoraggio dettagliato della tua attività su WILLFEED</h2>
                            <p>
                                Con Willfeed hai a disposizione un gestionale completamente personale che ti permette di tenere sotto controllo tutte le tue attività.
                            </p>
                            <p>
                                Sia per chi vende che per chi compra con un click hai tutto sotto controllo. Chi vende può
monitorare i suoi andamenti di vendita, per prodotto, per cliente e per prezzo, e controllare e
monitorare ogni singolo ordine effettuato. Chi compra allo stesso modo avrà sotto controllo
tutti i suoi acquisti, i suoi ordini e può monitorare i suoi andamenti in base al prezzo di
acquisto e prodotto. in pratica un gestionale che ha come priorità l’organizzazione e
l’ottimizzazione del tuo business
                            </p>

                            <h2 class="about-item__title">Distribuzione su Tutto il Territorio Italiano</h2>
                            <p>
                                Con una copertura nazionale, garantiamo le consegne in tutta Italia, Nessun luogo è troppo
remoto o difficile da raggiungere. La tua comodità è la nostra priorità. Grazie alla nostra
piattaforma estremamente elastica permette ad ogni singolo venditore e cliente di essere
raggiunto alla propria destinazione 
                            </p>
                            <p>
                                In breve, WILLFEED è il tuo compagno affidabile per l’approvvigionamento di carburanti di
qualità. Siamo più di una piattaforma, siamo la tua scelta sicura per un futuro più efficiente e
sostenibile.
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
<script src="{{asset('assets/front/js/custom.js?version=1')}}"></script>
@endsection
<!-- Scripts Ends -->