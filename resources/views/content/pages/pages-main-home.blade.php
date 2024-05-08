@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Main Home')


<!-- CSS Starts -->
@section('head-style') 

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/wf-icon.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css?ver=1')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

<header class="header" id="header">

    <div class="uk-container header__container">

        <a href="{{route("pages-home")}}" class="header__logo"><img src="{{asset('assets/front/images/weelfeed-brand-logo.svg')}}" class="header__logo-img" alt="Weelfeed Brand Logo" height="39" width="99"></a>

        <div class="header__collapsible navmenu js-header-collapse" id="navmenu">
            <ul class="navmenu__list">
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Buy</a>
                </li>
                <li class="navmenu__list-item has-megamenu">
                    <a href="#" class="navmenu__list-link">Sell</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Market</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">About Us</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Info</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Contact Us</a>
                </li>
            </ul>
            <div class="navmenu__left">
                <div class="navmenu-search">
                    <button type="button" class="uk-button navmenu-search__button">
                        <span class="wf-icon wf-icon-search"></span>
                    </button>
                    <div class="uk-dropdown uk-drop navmenu-search__dropdown" data-uk-dropdown="mode: click; pos: bottom-right">
                        <form class="navmenu-search__form">
                            <input type="search" name="" class="uk-input navmenu-search__input">
                            <button type="submit" class="uk-button uk-button-primary"><span class="wf-icon wf-icon-search"></span></button>
                        </form>
                    </div>
                </div>
                <a href="#" class="navmenu__left-link">Sing In</a>
                <a href="#" class="uk-button uk-button-primary navmenu__left-link navmenu__left-link--button">Get Started</a>
            </div>
        </div>

        <div class="header__toggler">
            <button type="button" class="header__toggler-btn js-header-toggler">
                <span class="header__toggler-icon"></span>
                <span class="header__toggler-text"><span class="sr-only">Menu</span></span>
            </button>
        </div>

    </div>

</header>

<main id="main-content" class="wrapper">

    <div class="hero">
        <div class="uk-container hero__container">
            <div class="uk-grid hero__grid" data-uk-grid>
                <div class="uk-width-1-2 hero__col">


                    <div class="hero__logo">
                        <img src="{{asset('assets/front/images/weelfeed-text-logo.svg')}}" width="326" height="47" alt="weelfeed">
                    </div>                            
                    
                    <h1 class="title hero__title">
                        La piattaforma che mette in contatto chi vende & chi compra carburanti, lubrificanti e affini.
                    </h1>
                    <h2 class="title hero__title">
                        Un unico portale che ti permette di trovare la soluzione migliore per la tua attività:
                    </h2>
                    <div class="hero__text">
                        <ol>
                            <li>
                                Senza costi di intermediazione
                            </li>
                            <li>
                                Reale trasparenza sui prezzi di mercato
                            </li>
                            <li>
                                Qualita del prodotto e servizio garantito
                            </li>
                        </ol>
                    </div>
                    <div class="hero__actions">
                        <a href="#" class="uk-button uk-button-primary">Scopri come Vendere</a>
                        <a href="#" class="uk-button uk-button-default">Scopri come comprare</a>
                    </div>

                </div>
                <div class="uk-width-1-2 hero__col">
                    <div class="hero__media">
                        <img src="{{asset('assets/front/images/hero-tablet-bg.png')}}" width="667" height="438">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-charts uk-slider" data-uk-slider>
        <div class="uk-container">
            <div class="uk-slider-container dash-charts__container">
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

    <div class="sell-buy">
        <div class="uk-container sell-buy__container">
            <div class="uk-grid uk-flex-middle sell-buy__grid" data-uk-grid>
                <div class="uk-width-auto sell-buy__col">
                    <div class="uk-grid sell-buy__bgblocks">
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--search">
                                    <span class="wf-icon wf-icon-search-with-bg"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">cerca clienti</h3>
                                <div class="sell-buy__item-details">
                                    <ol>
                                        <li>Destinazione</li>
                                        <li>Dilazione di pagamento</li>
                                        <li>Metodo di pagamento</li>
                                        <li>Dimensione flotta</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--cart">
                                    <span class="wf-icon wf-icon-shopping-bag"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">ordini</h3>
                                <div class="sell-buy__item-details">
                                    <ol>
                                        <li>Valuta e accetta richieste di collaborazione</li>
                                        <li> Monitora gli ordini attivi</li>
                                        <li> Supervisiona pagamenti e scadenze di oagamento</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--monitor">
                                    <span class="wf-icon "></span>
                                </div>
                                <h3 class="title sell-buy__item-name">consegne</h3>
                                <div class="sell-buy__item-details">
                                    <ol>
                                        <li>Monitora la consegna</li>
                                        <li>Verifica se le note sono rispettate</li>
                                        <li>Chat diretta con il cliente</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--feedback">
                                    <span class="wf-icon "></span>
                                </div>
                                <h3 class="title sell-buy__item-name">feedback</h3>
                                <div class="sell-buy__item-details">
                                    <p>
                                        Crea una relazione attraverso i feedback e entra a far oparte della community
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-expand sell-buy__col">
                    <div class="sell-buy__content">
                        <h2 class="sell-buy__title">COME VENDERE SU WILLFEED?</h2>
                        <h3 class="sell-buy__title-2">Diversifica il tuo modo vendere carburanti, lubrificanti e affini</h3>
                        <div class="sell-buy__desc">
                            <ol>
                                <li>Trova e crea le tue liste di clienti in base alle tue richieste</li>
                                <li>Monitora i tuoi ordini e i relativi flussi di vendita</li>
                                <li>Supervisiona i pagamenti e le relative scadenze</li>
                                <li>Conosci la community attraverso i feedback</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sell-buy">
        <div class="uk-container sell-buy__container">
            <div class="uk-grid uk-flex-middle sell-buy__grid" data-uk-grid>
                <div class="uk-width-auto sell-buy__col">
                    <div class="uk-grid sell-buy__bgblocks">
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--search">
                                    <span class="wf-icon wf-icon-search-with-bg"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">cerca i fornitori</h3>
                                <div class="sell-buy__item-details">
                                    <ol>
                                        <li>Prezzo</li>
                                        <li> Destinzazione</li>
                                        <li> Dilazione di pagamento</li>
                                        <li> Metodo di pagamento</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--cart">
                                    <span class="wf-icon wf-icon-shopping-bag"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">ordini</h3>
                                <div class="sell-buy__item-details">
                                    <ol>
                                        <li>Monitora gli oridni</li>
                                        <li>Destinzazione</li>
                                        <li>Dilazione di pagamento</li>
                                        <li>Metodo di pagamento</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--monitor">
                                    <span class="wf-icon wf-icon-analytics"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">monitora</h3>
                                <div class="sell-buy__item-details">
                                    <p>
                                        Monitora le consegne e le relative note in base alle tue richieste 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="sell-buy__item">
                                <div class="sell-buy__icon sell-buy__icon--feedback">
                                    <span class="wf-icon wf-icon-tick"></span>
                                </div>
                                <h3 class="title sell-buy__item-name">feedback</h3>
                                <div class="sell-buy__item-details">
                                    <p>
                                        Osserva i feedback per valutare e recensire i tuoi partner 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-expand sell-buy__col">
                    <div class="sell-buy__content">
                        <h2 class="sell-buy__title">COME ACQUISTARE SU WILLFEED?</h2>
                        <h3 class="sell-buy__text">Aziende di trasporto di merci su strada aziende edili aziende agricole distributori privati</h3>
                        <h3 class="sell-buy__title-2">Diversifica il tuo modo comprare carburanti,lubrificanti e affini</h3>
                        <div class="sell-buy__desc">
                            <ol>
                                <li>Cerca e crea la tua lista di fornitori in base alle tue esigenze</li>
                                <li>Monitora i tuoi ordini e i relativi fidi e scadenze di pagamento</li>
                                <li>Controlla lo stato delle consegne</li>
                                <li>Conosci la community attraverso i feedback </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="community">
        <div class="uk-container side-container side-container--right community__container">
            <div class="uk-grid uk-flex-middle community__grid" data-uk-grid>
                <div class="uk-width-1-2 community__col">
                    <div class="community__content">
                        <h2 class="title community__title">UNA COMMUNITY SOSTENIBILE</h2>
                        <div class="community__desc">
                            <p>
                                La nostra visione è quella di tenere costantemente aggiornato il mondo dei carburanti lubrificanti e affini con l'obiettivo di aumentare il consumo di materie prime ecosostenibili nel rispetto dell’ambiente del nostro pianeta dando così a tutte le attività l’opportunità di aumentare la propria quota green.
                            </p>
                            <p>
                                Siamo sempre in movimento per stare a passo con i cambiamenti pronti ad integrare e offrire sempre di più soluzioni di prodotti rinnovabili
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2 community__col">
                    <div class="community__media">
                        <img src="{{asset('assets/front/images/community-illutration.svg')}}" class="" width="906" height="743">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="partners">
        <div class="uk-container partners__container">

            <div class="partners__heading">
                <h2 class="title uk-text-uppercase partners__title">Our Partners</h2>
                <div class="title partners__text">
                    <p>We're trusted by 240+ <span class="partners__text-highlight">firms & departments</span> across the globe</p>
                </div>
            </div>

            <div class="uk-grid uk-flex-center partners__grid" data-uk-grid>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
                <div class="partners__col">
                    <div class="partners__item">
                        <img src="{{asset('assets/front/images/partner-logo-dummy.png')}}" width="119" height="34">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="platform">
        <div class="uk-container platform__container">
            <div class="uk-grid uk-flex-middle platform__grid">
                <div class="uk-width-1-2 platform__col">
                    <div class="platform__media">
                        <img src="{{asset('assets/front/images/platform.svg')}}" width="899" height="743" alt="platform">
                    </div>
                </div>
                <div class="uk-width-1-2 platform__col">
                    <div class="platform__content">
                        <h2 class="title platform__title">WILLFEED UNA PIATTAFORMA SICURA & CONVENIENTE</h2>
                        <div class="platform__item">
                            <h3 class="title platform__sectitle">
                                AUTENTICITA’
                            </h3>
                            <div class="platform__desc">
                                <p>
                                    Il sistema Willfeed si base su un controllo meticoloso nella fase di iscrizione e accettazione dei propri utenti garantendo per chi vende e chi compra la massima sicurezza e la certezza di interfacciarsi con realtà autentiche
                                </p>
                            </div>                                    
                        </div>
                        <div class="platform__item">
                            <h3 class="title platform__sectitle">
                                SENZA COSTI DI INTERMEDIAZIONE
                            </h3>
                            <div class="platform__desc">
                                <p>
                                    Il sistema Willfeed si base su un controllo meticoloso nella fase di iscrizione e accettazione dei propri utenti garantendo per chi vende e chi compra la massima sicurezza e la certezza di interfacciarsi con realtà autentiche
                                </p>
                            </div>                                    
                        </div>
                        <div class="platform__item">
                            <h3 class="title platform__sectitle">
                                TRASPARENZA SUI PREZZI
                            </h3>
                            <div class="platform__desc">
                                <p>
                                    L’obiettivo è quello di avere a disposizione una piena consapevolezza dell’andamento dei prezzi del mercato dei prodotti petroliferi offrendo il miglior prezzo garantendo sempre la qualità del prodotto
                                </p>
                            </div>                                    
                        </div>
                        <div class="platform__item">
                            <h3 class="title platform__sectitle">
                                BONUS E PREMI
                            </h3>
                            <div class="platform__desc">
                                <p>
                                    Willfeed premia chi consuma e produce di più e per questo abbiamo dedicato dei pacchetti bonus e premi esclusivi in base al vostro volume di ordini
                                </p>
                            </div>
                        </div>
                        <a href="#" class="uk-button uk-button-primary platform__action">Scopri di più</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="reviews uk-slider" data-uk-slider>
        <div class="uk-container reviews__container">
            <h2 class="title reviews__title">Esplora la nostra commununity</h2>
            <div class="reviews__about">
                <p>
                    Willfeed <span class="reviews__about-highlight">si basa su due concetti fondamentali: trasparenza e confronto</span>
                </p>
            </div>
        </div>
        <div class="uk-container side-container side-container--right reviews__sidecontainer uk-slider-container">
            <div class="uk-grid reviews__grid uk-slider-items">
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-4 reviews__col">
                    <div class="reviews__item">
                        <div class="reviews__rating">
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                            <span class="wf-icon wf-icon-star"></span>
                        </div>
                        <div class="reviews__text">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                        <div class="reviews__author">
                            <div class="reviews__author-img">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="reviews__author-data">
                                <h4 class="reviews__author-name">John Smith</h4>
                                <div class="reviews__author-dest">Ceo, XYZ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reviews__footer">
            <div class="uk-container reviews__footercontainer">
                <ul class="uk-slider-nav uk-dotnav reviews__dotnav"></ul>
            </div>
        </div>
    </div>

    <div class="help">
        <div class="uk-container help__container">
            <div class="uk-grid uk-flex-middle help__grid" data-uk-grid>
                <div class="uk-width-expand help__col">
                    <div class="help__content">
                        <h2 class="title help__title">SERVE AIUTO ?</h2>
                        <div class="help__desc">
                            <p>
                                Il nostro team e’ a tua completa disposizione
                            </p>
                            <p>
                                Offriamo un servizio di assistenza per rispondere a tutte le tue esigenze
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-auto help__col">
                    <div class="help__media">
                        <span class="wf-icon wf-icon-call help__icon"></span>
                        <span class="help__time">7/7</span>
                        <div class="help__call">
                            <a href="tel:+39 3470412793" class="help__call-num">+39 3470412793</a>
                        </div>
                        <a href="#" class="uk-button uk-button-light help__action">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<footer class="footer">
    <div class="foolter-upper">
        <div class="uk-container foolter-upper__container">
            <div class="uk-grid uk-flex-middle foolter-upper__grid" data-uk-grid>
                <div class="uk-width-1-2 foolter-upper__col">
                    <div class="footer-logo">
                        <img src="{{asset('assets/front/images/weelfeed-brand-logo.svg')}}" width= "233" height= "127.489">
                    </div>
                </div>
                <div class="uk-width-1-2 foolter-upper__col">
                    <div class="uk-grid footer-contact" data-uk-grid>
                        <div class="uk-width-1-2 footer-contact__col">
                            <div class="footer-contact__item">
                                <span class="wf-icon wf-icon-phone-call footer-contact__icon"></span>
                                <div class="footer-contact__data">
                                    <h2 class="footer-contact__name">Call Us</h2>
                                    <a href="tel:+39 3470412793" class="footer-contact__href">+39 3470412793</a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2 footer-contact__col">
                            <div class="footer-contact__item">
                                <span class="wf-icon wf-icon-email footer-contact__icon"></span>
                                <div class="footer-contact__data">
                                    <h2 class="footer-contact__name">Mail Us</h2>
                                    <a href="mailto:info@example.com" class="footer-contact__href">info@example.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-main">
        <div class="uk-container footer-main__container">
            <div class="uk-grid footer-main__grid" data-uk-grid>
                <div class="uk-width-1-4 footer-main__col footer-main__col--about">
                    <h2 class="title footer-main__title">About Us</h2>
                    <div class="footer-main__text">
                        <p>
                            WillFeed are responsible for manufacturing essential products such as plastics, fertilizers, synthetic fibers, and various other materials.
                        </p>
                    </div>
                    <div class="footer-social">
                        <a href="#" class="footer-social__link">
                            <span class="wf-icon wf-icon-facebook"></span>
                        </a>
                        <a href="#" class="footer-social__link">
                            <span class="wf-icon wf-icon-instagram"></span>
                        </a>
                        <a href="#" class="footer-social__link">
                            <span class="wf-icon wf-icon-linkedin"></span>
                        </a>
                        <a href="#" class="footer-social__link">
                            <span class="wf-icon wf-icon-youtube"></span>
                        </a>
                    </div>
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--links">
                    <h2 class="title footer-main__title">Links</h2>
                    <ul class="footer-links">
                        <li class="footer-links__item">
                            <a href="#" class="footer-links__action">Sell</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="#" class="footer-links__action">Buy</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="#" class="footer-links__action">Market</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="#" class="footer-links__action">About Us</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="#" class="footer-links__action">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--products">
                    <h2 class="title footer-main__title">Our Products</h2>
                    <ul class="footer-menu footer-menu--grid">
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Ethylene</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Cosmetics</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Benzene</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Fertilizers</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Medical resins</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Carpets</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Medical plastics</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Safety glass</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Food preservatives</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Crayons and markers</a>
                        </li>
                    </ul>
                    
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--support">
                    <h2 class="title footer-main__title">Support</h2>
                    <ul class="footer-menu">
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Support center</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Privacy & policy</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Terms of use</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">FAQs</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Help</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        Copyright © 2023 willFeed. All rights reserved.
    </div>
</footer>


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>
@endsection
<!-- Scripts Ends -->