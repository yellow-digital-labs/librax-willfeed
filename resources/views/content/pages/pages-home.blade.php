@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Home')


<!-- CSS Starts -->
@section('head-style') 

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/rateyo/rateyo.css')}}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/wf-icon/style.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css?v1.0.1')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="landing-hero">
        <div class="uk-container landing-hero__container">
            <h1 class="title title--xl landing-hero__maintitle">Acquista e vendi carburanti on line
                In totale sicurezza e trasparenza</h1>
            <p class="landing-hero__desc">
                WILLFEED rivoluziona il mercato dei carburanti con una piattaforma unica in Italia.
            </p>
            <p class="landing-hero__bolddesc">
                Senza costi di intermediazione. Reale trasparenza sui prezzi di mercato. Qualità del prodotto e servizio garantito.
            </p>
        </div>
    </div>

    <div class="landing-video">
        <div class="uk-container landing-video__container">
            <div class="landing-video__wrapper">
                <video autoplay muted playsinline>
                    <source src="{{asset('assets/video/willfeed-landing-page-video.mp4')}}" type="video/mp4">
                </video>
                {{-- <button type="button" class="uk-button uk-icon-button landing-video__action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="82" height="82" viewBox="0 0 82 82" fill="none">
                        <circle cx="41" cy="41" r="41" fill="black"/>
                        <path d="M51.0268 39.9336C52.0355 40.7343 52.0355 42.2657 51.0268 43.0664L38.2435 53.2145C36.9328 54.2551 35 53.3216 35 51.6481L35 31.3519C35 29.6784 36.9328 28.7449 38.2435 29.7855L51.0268 39.9336Z" fill="white"/>
                    </svg>
                </button> --}}
            </div>
        </div>
    </div>

    <div class="dash-charts uk-slider uk-slider-container" data-uk-slider="center: true; autoplay: true; pause-on-hover: true; autoplay-interval: 2000">
        <div class="uk-container">
            <div class="dash-charts__container">

                <h2 class="title dash-charts__maintitle">Prezzi in tempo reale</h2>

                @include('content.sections.live-price-products')
            </div>
        </div>
    </div>

    <div class="landing-clrblock" id="vendor">
        <div class="uk-container landing-clrblock__container landing-clrblock__container--sell">
            <div class="uk-grid uk-flex-middle gutter-xxl landing-clrblock__maingrid" data-uk-grid>
                <div class="uk-width-expand@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--content">
                    <h2 class="title landing-clrblock__title">Come vendere su <br> willfeed?</h2>
                    <div class="landing-clrblock__text">
                        <p>
                            VENDITA e CONTROLLO sono al centro della tua esperienza.
                        </p>
                        <p>
                            AUMENTA IL TUO VOLUME DI AFFARI, Grazie alla diversificazione dei clienti, divisi per categorie suddivisi per regioni, modalità di pagamento e dilazioni, puoi ottimizzare le vendite.
                        </p>
                        <p>
                            Tutto sotto CONTROLLO grazie ad un avanzato gestionale a tua disposizione che consente di controllare e accettare gli ordini, monitorare i fidi in scadenza e ricevere avvisi automatici per i pagamenti imminenti.
                        </p>
                        <p>
                            Entra subito in CONTATTO con aziende di trasporto, aziende edili e aziende agricole soddisfa le loro richieste e aumenta i tuoi affari.
                        </p>
                        <p>
                            Garantiamo un ambiente in cui l'espansione del business è agevolata dalla diversità dei clienti e dal controllo completo
                        </p>
                    </div>
                    <a href="#" class="uk-button uk-button-default landing-clrblock__action" data-uk-toggle="target: #vendor; cls: is-active">SCOPRI DI PIU’</a>  
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <img src="{{asset('assets/img/home/yellow-section-1.png')}}" width="610" height="460">    
                    </div>
                </div>
            </div>

            <div class="landing-clrblock__grid uk-grid gutter-xxl" data-uk-grid hidden>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-bag"></div> --}}
                    <img src="{{asset('assets/img/home/analizza.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">CLIENTI</h3>
                    <div class="landing-clrblock__desc">
                        CERCA I TUOI CLIENTI PER REGIONI, PER ATTIVITÀ, PER PRODOTTO, PER DILAZIONE E MODALITA’ DI PAGAMENTO
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-analytics"></div> --}}
                    <img src="{{asset('assets/img/home/cerca.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">COLLABORA</h3>
                    <div class="landing-clrblock__desc">
                        INDIVIDUATI I POTENZIALI CLIENTI INVITALI A COLLABORARE OFFRENDO IL FIDO CHE RITIENI OPPORTUNO
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-search1"></div> --}}
                    <img src="{{asset('assets/img/home/conferma.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">VENDI</h3>
                    <div class="landing-clrblock__desc">
                        PUBBLICA QUOTIDIANAMENTE I TUOI PREZZI PER PRODOTTO E DILAZIONE DI PAGAMENTO IN BASE ALLE TUE ESIGENZE DI VENDITA
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-search1"></div> --}}
                    <img src="{{asset('assets/img/home/monitora.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">GESTISCI</h3>
                    <div class="landing-clrblock__desc">
                        ACCETTA O RIFIUTA LE RICHIESTE DEI TUOI CLIENTI E MONITORA I TUOI ORDINI E ANALIZZA I TUOI ANDAMENTI DI VENDITA PER PRODOTTO, PER PERIODO E PER CLIENTE
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="landing-clrblock" id="comprare">
        <div class="uk-container landing-clrblock__container landing-clrblock__container--buy">
            <div class="uk-grid uk-flex-middle gutter-xxl landing-clrblock__maingrid" data-uk-grid>
                <div class="uk-width-expand@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--content">
                    <h2 class="title landing-clrblock__title">Come comprare su <br> willfeed?</h2>
                    <div class="landing-clrblock__text">
                        <p>
                            CONVENIENZA e CONTROLLO sono al centro della tua esperienza. Con noi, hai uno scenario reale dei prezzi del carburante, lubrificanti e prodotti affini dai migliori fornitori di Italia.
                        </p>
                        <p>
                            Scopri la CONVENIENZA nell’avere a di disposizione in un unica piattaforma molteplici venditori con prezzi reali e competitivi, avendo la possibilità di acquistare il prodotto che vuoi con il metodo di pagamento e dilazioni che preferisci.
                        </p>
                        <p>
                            Tutto sotto CONTROLLO grazie al gestionale privato che ti consente di monitorare i tuoi fidi, gestire gli ordini e accedere a un'analisi dettagliata dei costi e dei risparmi legati ai tuoi acquisti.
                        </p>
                        <p>
                            Scegli la comodità di un servizio online pensato per ottimizzare il tuo business
                        </p>
                    </div>
                    <button type="button" class="uk-button uk-button-default landing-clrblock__action" data-uk-toggle="target: #comprare; cls: is-active">SCOPRI DI PIU’</button>
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <img src="{{asset('assets/img/home/orange-section-1.png')}}" width="610" height="460">    
                    </div>
                </div>
            </div>

            <div class="landing-clrblock__grid uk-grid gutter-xxl" data-uk-grid hidden>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-bag"></div> --}}
                    <img src="{{asset('assets/img/home/analizza.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">CERCA</h3>
                    <div class="landing-clrblock__desc">
                        CERCA I VENDITORI PER PRODOTTO, PREZZO, MODALITA’ E DILAZIONE DI PAGAMENTO
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-analytics"></div> --}}
                    <img src="{{asset('assets/img/home/cerca.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">COLLABORA</h3>
                    <div class="landing-clrblock__desc">
                        INDIVIDUATI I POTENZIALI VENDITORI INVIA UNA RICHIESTA DI COLLABORAZIONE PER OTTENERE UN FIDO
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-search1"></div> --}}
                    <img src="{{asset('assets/img/home/conferma.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">ACQUISTA</h3>
                    <div class="landing-clrblock__desc">
                        SCOPRI GIORNO PER GIORNO I PREZZI REALI DI MERCATO ANALIZZA, VALUTA E SCEGLI DA CHI ORDINARE
                    </div>
                </div>
                <div class="uk-width-1-4@s landing-clrblock__col">
                    {{-- <div class="landing-clrblock__icon wf-icon wf-icon-search1"></div> --}}
                    <img src="{{asset('assets/img/home/monitora.png')}}" style="height: 50px;">
                    <h3 class="landing-clrblock__name">GESTISCI</h3>
                    <div class="landing-clrblock__desc">
                        MONITORA I TUOI ORDINI E ANALIZZA I TUOI ANDAMENTI DI ACQUISTO PER PRODOTTO E PER VENDITORE
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="landing-clrblock">
        <div class="uk-container landing-clrblock__container landing-clrblock__container--safe">
            <div class="uk-grid uk-flex-middle gutter-xxl landing-clrblock__maingrid" data-uk-grid>
                <div class="uk-width-expand@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--content">
                    <h2 class="title landing-clrblock__title">Willfeed sicuro & <br> conveniente</h2>
                    <div class="landing-clrblock__text">
                        <p>
                            La nostra visone è dare la possibilità a fornitori e clienti di relazionarsi in piena sicurezza e convenienza
                        </p>
                    </div>
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <!-- <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">  -->

                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay: true">

                            <ul class="uk-slider-items uk-child-width-1-1">
                                <li>
                                    <img src="{{asset('assets/img/Illustration11.png')}}" width="610" height="460" alt="">
                                </li>
                                <li>
                                    <img src="{{asset('assets/img/Illustration13.png')}}" width="610" height="460" alt="">
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="landing-clrblock">
        <div class="uk-container landing-clrblock__container landing-clrblock__container--community">
            <div class="uk-grid uk-flex-middle gutter-xxl landing-clrblock__maingrid" data-uk-grid>
                <div class="uk-width-expand@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--content">
                    <h2 class="title landing-clrblock__title">Willfeed una <br> community sostenibile</h2>
                    <div class="landing-clrblock__text">
                        <p>
                            La nostra missione è aumentare il consumo di materie prime ecosostenibili dando così a tutte le attività l’opportunità di aumentare la propria quota green.
                        </p>
                    </div>
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <!-- <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">     -->

                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay: true">

                            <ul class="uk-slider-items uk-child-width-1-1">
                                <li>
                                    <img src="{{asset('assets/img/Illustration12.png')}}" width="610" height="460" alt="">
                                </li>
                                <li>
                                    <img src="{{asset('assets/img/Illustration15.png')}}" width="610" height="460" alt="">
                                </li>
                            </ul>

                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="landing-reviews uk-slider" data-uk-slider="center: true; autoplay: true; pause-on-hover: true; autoplay-interval: 2000">

        <div class="uk-container landing-reviews__container">
            <h2 class="title landing-reviews__title">Esplora la nostra community</h2>
            <div class="landing-reviews__about">
                <p>
                    Willfeed si base su due concetti fondamentali: Confronto e trasparenza
                </p>
            </div>
        </div>

        <div class="landing-reviews__slider uk-slider-container">
            <div class="uk-grid landing-reviews__grid uk-slider-items">
            @if($ratings)
                @foreach($ratings as $rating)
                <div class="uk-width-1-4 landing-reviews__col">
                    <div class="landing-reviews__item">
                        <div class="landing-reviews__rating">
                            <div class="read-only-ratings" data-rateyo-read-only="true" data-rateyo-rating="{{$rating->star}}" data-rateyo-star-width="20px"></div>
                        </div>
                        <div class="landing-reviews__text">
                            <p>
                                {{$rating->review_text}}
                            </p>
                        </div>
                        <div class="landing-reviews__author">
                            <div class="landing-reviews__author-data">
                                <h4 class="landing-reviews__author-name">{{$rating->review_by_name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
        <div class="landing-reviews__footer">
            <div class="uk-container landing-reviews__footercontainer">
                <ul class="uk-slider-nav uk-dotnav landing-reviews__dotnav"></ul>
            </div>
        </div>
    </div>

    @if(count($blogs))
    <div class="blog">
        <div class="uk-container blog__container">
            <h2 class="title blog__maintitle">Blog</h2>
            <div class="blog__maintext">
                <p>Costantemente aggiornato sulle ultime notizie di mercato</p>
            </div>
            <div class="uk-grid blog__grid" data-uk-grid>

                @foreach($blogs as $blog)
                <div class="uk-width-1-3@s blog__col">
                    <a href="{{route("blog-page", [
                        "slug" => $blog->slug
                    ])}}">
                        <div class="blog__item">
                            <h2 class="title blog__title">{{$blog->blog_name}}</h2>
                            <div class="blog__media">
                                <img src="{{Illuminate\Support\Facades\Storage::url($blog->blog_image)}}" width="340" height="255">
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif

</main>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>

<script>
    $('.read-only-ratings').rateYo();
</script>
@endsection
<!-- Scripts Ends -->