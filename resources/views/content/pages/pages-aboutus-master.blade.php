@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'About us')


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
            <h1 class="title title--xl page-heading__title">About us</h1>
            <div class="page-heading__text">
                <p>WILLFEED rivoluziona il mercato dei carburanti con una piattaforma unica in Italia.</p>
            </div>
            <hr class="page-heading__hr">
        </div>
    </div>

    <div class="about">
        <div class="uk-container about__container">

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name">Story</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <h2 class="about-item__title">We envision a brighter future, transforming the way the world purchase to create positive change.</h2>
                        <div class="about-item__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc non blandit massa enim nec dui nunc mattis. Amet volutpat consequat mauris nunc congue nisi vitae suscipit. Donec massa sapien faucibus et molestie ac feugiat sed. 
                            </p>
                            <p>
                                Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com.
                            </p>
                            <p>
                                Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                            </p>
                        </div>
                        <div class="about-build">
                            <div class="uk-grid gutter-xl about-build__grid" data-uk-grid>
                                <div class="uk-width-2-3@s">
                                    <h2 class="title title--l about-build__title">We build bridges between customer and seller</h2>
                                </div>
                                <div class="uk-width-1-3@s">
                                    <div class="about-build__icon">
                                        <img src="/assets/front/images/icons/communication.svg" width="176" height="176">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-item__text">
                            <p>
                                Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name">Together we are strong</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc non blandit massa enim nec dui nunc mattis. Amet volutpat consequat mauris nunc congue nisi vitae suscipit. Donec massa sapien faucibus et molestie ac feugiat sed. 
                            </p>
                            <p>
                                Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com.
                            </p>
                        </div>
                        <div class="about-count uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@s about-count__col">
                                <div class="about-count__item about-count__item--maroon">
                                    <div class="about-count__heading">
                                        <span class="about-count__heading-big"><span class="about-count__heading-big-light">></span> 80</span> million
                                    </div>
                                    <div class="about-count__text">
                                        <p>average monthly active users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-2@s about-count__col">
                                <div class="about-count__item about-count__item--blue">
                                    <div class="about-count__heading">
                                        <span class="about-count__heading-big"><span class="about-count__heading-big-light">></span> 350</span>
                                    </div>
                                    <div class="about-count__text">
                                        <p>employees</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-item__text">
                            <p>
                                Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                            </p>
                        </div>
                        <div class="about-count uk-grid" data-uk-grid>
                            <div class="uk-width-1-2@s about-count__col">
                                <div class="about-count__item about-count__item--yellow">
                                    <div class="about-count__heading">
                                        <span class="about-count__heading-big"><span class="about-count__heading-big-light">></span> 800</span>
                                    </div>
                                    <div class="about-count__text">
                                        <p>Sellers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-2@s about-count__col">
                                <div class="about-count__item about-count__item--orange">
                                    <div class="about-count__heading">
                                        <span class="about-count__heading-big">Certified</span>
                                    </div>
                                    <div class="about-count__text">
                                        <p>since June 2020</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <div class="about-author">
                            <div class="about-author__media">
                                <img src="{{asset('assets/front/images/review-img-dummy.png')}}" width="66" height="65">
                            </div>
                            <div class="about-author__body">
                                <h3 class="about-author__name">Darrell Barnes</h3>
                                <p class="about-author__des">Founder, CEO</p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__quote">
                            <p>"Our goal is to harness the power of advanced synthetic chemistry and cutting-edge technology to create a seamless and sustainable petrochemical ecosystem that benefits both our customers and the environment."</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item">                
                <div class="uk-grid about-item__grid" data-uk-grid>
                    <div class="uk-width-auto about-item__col about-item__col--sidebar">
                        <h2 class="about-item__name">Who we are</h2>
                    </div>
                    <div class="uk-width-expand about-item__col about-item__col--content">
                        <div class="about-item__text">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc non blandit massa enim nec dui nunc mattis. Amet volutpat consequat mauris nunc congue nisi vitae suscipit. Donec massa sapien faucibus et molestie ac feugiat sed. 
                            </p>
                            <p>
                                Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com.
                            </p>
                            <p>
                                Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

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