@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Landing Page 9')


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
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

<header class="header" id="header">

    <div class="uk-container header__container">

        <a href="#" class="header__logo"><img src="{{asset('assets/front/images/weelfeed-brand-logo.svg')}}" class="header__logo-img" alt="Weelfeed Brand Logo" height="39" width="99"></a>

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
                                    <a href="tel:+234 123 2352" class="footer-contact__href">+234 123 2352</a>
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