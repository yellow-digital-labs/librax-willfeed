@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Contact us')


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
            <h1 class="title title--xl page-heading__title">Contact us</h1>
            <div class="page-heading__text">
                <p>WILLFEED rivoluziona il mercato dei carburanti con una piattaforma unica in Italia.</p>
            </div>
            <hr class="page-heading__hr">
        </div>
    </div>

    <div class="contact">
        <div class="uk-container contact__container">
            <div class="uk-grid gutter-xxl contact__grid" data-uk-grid>
                <div class="uk-width-expand contact__col contact__col--content">
                    <div class="contact-sales">
                        <h2 class="title contact-sales__maintitle">Talk to our sales team</h2>
                        <div class="contact-sales__text">
                            <p>
                                Find out how willfeed can help your company or get a product demo. We'll be in touch shortly.
                            </p>
                        </div>
                        <div class="uk-grid contact-sales__grid" data-uk-grid>
                            <div class="uk-width-1-2 contact-sales__col">
                                <div class="contact-sales__item">
                                    <div class="contact-sales__icon">
                                        <span class="wf-icon-phone-contact"></span>
                                    </div>
                                    <div class="contact-sales__boldtext">
                                        7/7
                                    </div>
                                    <div class="contact-sales__title"><a href="tel:+39 3334565118">+39 3334565118</a></div>
                                </div>
                            </div>
                            <div class="uk-width-1-2 contact-sales__col">
                                <div class="contact-sales__item">
                                    <div class="contact-sales__icon">
                                        <span class="wf-icon-mail"></span>
                                    </div>
                                    <div class="contact-sales__title"><a href="mailto:info@willfeed.it">info@willfeed.it</a></div>
                                    <div class="contact-sales__text">
                                        Best way to get a quick answer
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-1-1 contact-sales__col">
                                <div class="contact-sales__item">
                                    <div class="contact-sales__icon">
                                        <span class="wf-icon-headquarters"></span>
                                    </div>
                                    <div class="contact-sales__title">Willfeed HQ</div>
                                    <div class="contact-sales__text">
                                        45 Roker Terrace LatheronwheelKW5 8NW,LondonUK
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-auto contact__col contact__col--form">
                    <div class="contact-form">
                        <h3 class="contact-form__title">Share your contact details</h3>
                        <div class="contact-form__group">
                            <label class="contact-form__label">Full name</label>
                            <input type="text" class="uk-input contact-form__input" name="" placeholder="Enter name">
                        </div>
                        <div class="contact-form__group">
                            <label class="contact-form__label">Email</label>
                            <input type="text" class="uk-input contact-form__input" name="" placeholder="Enter email">
                        </div>
                        <div class="contact-form__group">
                            <label class="contact-form__label">Mobile Number</label>
                            <input type="text" class="uk-input contact-form__input" name="" placeholder="Enter mobile number">
                        </div>
                        <div class="contact-form__group">
                            <label class="contact-form__label">Message</label>
                            <textarea class="uk-textarea contact-form__input" name="" placeholder="Enter your message" rows="5"></textarea>
                        </div>
                        <div class="contact-form__actions">
                            <button type="submit" class="uk-button uk-button-primary contact-form__submit">Send</button>
                            <button type="submit" class="uk-button uk-button-default contact-form__cancel">Cancel</button>
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
<script src="{{asset('assets/front/js/custom.js')}}"></script>
@endsection
<!-- Scripts Ends -->