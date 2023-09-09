@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Home')


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
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="landing-hero">
        <div class="uk-container landing-hero__container">
            <h1 class="title title--xl landing-hero__maintitle">Acquista e vendi carburanti in totale sicurezza e trasparenza online.</h1>
            <p class="landing-hero__desc">
                WILLFEED rivoluziona il mercato dei carburanti con una piattaforma unica in Italia.
            </p>
            <p class="landing-hero__bolddesc">
                Senza costi di intermediazione. Reale trasparenza sui prezzi di mercato. Qualità del prodotto e servizio garantito.
            </p>
        </div>
    </div>

    <div class="landing-video">
        <div class="uk-container uk-container-expand landing-video__container">
            <div class="landing-video__wrapper">
                
                <button type="button" class="uk-button uk-icon-button landing-video__action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="82" height="82" viewBox="0 0 82 82" fill="none">
                        <circle cx="41" cy="41" r="41" fill="black"/>
                        <path d="M51.0268 39.9336C52.0355 40.7343 52.0355 42.2657 51.0268 43.0664L38.2435 53.2145C36.9328 54.2551 35 53.3216 35 51.6481L35 31.3519C35 29.6784 36.9328 28.7449 38.2435 29.7855L51.0268 39.9336Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="dash-charts uk-slider uk-slider-container" data-uk-slider="center: true; autoplay: true; pause-on-hover: true; autoplay-interval: 2000">
        <div class="uk-container">
            <div class="dash-charts__container">

                <h2 class="title dash-charts__maintitle">Prezzi in tempo reale</h2>

                <div class="uk-grid dash-charts__grid uk-slider-items">
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count uk-text-success">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count uk-text-danger">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-4 dash-charts__col">
                        <div class="dash-charts__item">
                            <div class="dash-charts__upper">
                                <div class="dash-charts__icon">
                                    <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                                </div>
                                <div class="dash-charts__text">
                                    <h2 class="dash-charts__title">Ethylene</h2>
                                    <div class="dash-charts__about">Ethylene</div>
                                </div>
                                <div class="dash-charts__object">
                                    <img src="{{asset('assets/front/images/chart-sample.png')}}" width="101" height="47" alt="chart sample image">
                                </div>
                            </div>
                            <div class="dash-charts__down">
                                <div class="dash-charts__price">
                                    <div class="dash-charts__price-text">
                                        1.4700
                                    </div>
                                    <div class="dash-charts__price-type">
                                        Market price
                                    </div>
                                </div>
                                <div class="dash-charts__perc">
                                    <div class="dash-charts__perc-count">
                                        <span class="dash-charts__perc-arrow"></span>
                                        +0.32 (+0.08%)
                                    </div>
                                    <div class="dash-charts__perc-text">
                                        Price change
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="landing-clrblock">
        <div class="uk-container landing-clrblock__container landing-clrblock__container--sell">
            <div class="uk-grid uk-flex-middle gutter-xxl landing-clrblock__maingrid" data-uk-grid>
                <div class="uk-width-expand@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--content">
                    <h2 class="title landing-clrblock__title">Come vendere su <br> willfeed?</h2>
                    <div class="landing-clrblock__text">
                        <p>
                            Diversifica il tuo modo di vendere carburanti lubrificanti e affini
                        </p>
                    </div>
                    <a href="#" class="uk-button uk-button-default landing-clrblock__action">SCOPRI DI PIU’</a>  
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">    
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dapibus, nisi at tempor convallis.
                        </p>
                    </div>
                    <button type="button" class="uk-button uk-button-default landing-clrblock__action" data-uk-toggle="target: #comprare; cls: is-active">SCOPRI DI PIU’</button>
                </div>
                <div class="uk-width-auto@l uk-width-1-2@s landing-clrblock__maincol landing-clrblock__maincol--media">
                    <div class="landing-clrblock__media">
                        <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">    
                    </div>
                </div>
            </div>

            <div class="landing-clrblock__grid uk-grid gutter-xxl" data-uk-grid hidden>
                <div class="uk-width-1-3@s landing-clrblock__col">
                    <div class="landing-clrblock__icon wf-icon wf-icon-bag"></div>
                    <h3 class="landing-clrblock__name">Ordina</h3>
                    <div class="landing-clrblock__desc">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit Sed dapibus, nisi at tempor
                    </div>
                </div>
                <div class="uk-width-1-3@s landing-clrblock__col">
                    <div class="landing-clrblock__icon wf-icon wf-icon-analytics"></div>
                    <h3 class="landing-clrblock__name">Traccia</h3>
                    <div class="landing-clrblock__desc">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit Sed dapibus, nisi at tempor
                    </div>
                </div>
                <div class="uk-width-1-3@s landing-clrblock__col">
                    <div class="landing-clrblock__icon wf-icon wf-icon-search1"></div>
                    <h3 class="landing-clrblock__name">Trova</h3>
                    <div class="landing-clrblock__desc">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit Sed dapibus, nisi at tempor
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
                        <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">    
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
                        <img src="https://placehold.jp/000/fff/610x460.jpg" width="610" height="460">    
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

    <div class="blog">
        <div class="uk-container blog__container">
            <h2 class="title blog__maintitle">Blog</h2>
            <div class="blog__maintext">
                <p>Costantemente aggiornato sulle ultime notizie di mercato</p>
            </div>
            <div class="uk-grid blog__grid" data-uk-grid>

                <div class="uk-width-1-3@s blog__col">
                    <div class="blog__item">
                        <h2 class="title blog__title">BIO DIESEL: Cos’è e quali sono i suoi benefici</h2>
                        <div class="blog__media">
                            <img src="https://placehold.jp/000/fff/340x255.jpg" width="340" height="255">
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-3@s blog__col">
                    <div class="blog__item">
                        <h2 class="title blog__title">BIO DIESEL: Cos’è e quali sono i suoi benefici</h2>
                        <div class="blog__media">
                            <img src="https://placehold.jp/000/fff/340x255.jpg" width="340" height="255">
                        </div>
                    </div>
                </div>

                <div class="uk-width-1-3@s blog__col">
                    <div class="blog__item">
                        <h2 class="title blog__title">BIO DIESEL: Cos’è e quali sono i suoi benefici</h2>
                        <div class="blog__media">
                            <img src="https://placehold.jp/000/fff/340x255.jpg" width="340" height="255">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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