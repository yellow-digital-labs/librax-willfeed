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

<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

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
            <h1 class="title title--xl page-heading__title">CONTATTACI</h1>
            <div class="page-heading__text">
                <p>Saremo felici di parlare con te!</p>
                <p>Puoi chiamarci o inviarci una mail, fai come meglio preferisci Siamo disponibili 24H su 24</p>
            </div>
            <hr class="page-heading__hr">
        </div>
    </div>

    <div class="contact">
        <div class="uk-container contact__container">
            <div class="uk-grid gutter-xxl contact__grid" data-uk-grid>
                <div class="uk-width-expand contact__col contact__col--content">
                    <div class="contact-sales">
                        <div class="uk-grid contact-sales__grid" data-uk-grid>
                            <div class="uk-width-1-2 contact-sales__col">
                                <div class="contact-sales__item">
                                    <div class="contact-sales__icon">
                                        <span class="wf-icon-phone-contact"></span>
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
                                </div>
                            </div>
                            <div class="uk-width-1-1 contact-sales__col">
                                <div class="contact-sales__item">
                                    <div class="contact-sales__icon">
                                        <span class="wf-icon-headquarters"></span>
                                    </div>
                                    <div class="contact-sales__title">Willfeed HQ</div>
                                    <div class="contact-sales__text">
                                        Italy
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-auto contact__col contact__col--form">
                    <div class="contact-form">
                        <form method="POST" onsubmit="return false" id="contact-us-form">
                            @csrf
                            <h3 class="contact-form__title">Inserisci i tuoi dati</h3>
                            <div class="contact-form__group">
                                <label class="contact-form__label">NOME & COGNOME</label>
                                <input type="text" class="uk-input contact-form__input" name="name" placeholder="">
                            </div>
                            <div class="contact-form__group">
                                <label class="contact-form__label">EMAIL</label>
                                <input type="email" class="uk-input contact-form__input" name="email" placeholder="">
                            </div>
                            <div class="contact-form__group">
                                <label class="contact-form__label">NUMERO DI CELLULARE</label>
                                <input type="text" class="uk-input contact-form__input" name="mobile" placeholder="">
                            </div>
                            <div class="contact-form__group">
                                <label class="contact-form__label">SCRIVI IL TUO MESSAGGIO</label>
                                <textarea class="uk-textarea contact-form__input" name="message" placeholder="" rows="5"></textarea>
                            </div>
                            <div class="contact-form__actions">
                                <button type="submit" class="uk-button uk-button-primary contact-form__submit">Invia</button>
                                <button type="reset" class="uk-button uk-button-default contact-form__cancel">Cancella</button>
                            </div>
                        </form>
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
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>

<script>
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#contact-us-form');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter name'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter email'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    mobile: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter mobile'
                            }
                        }
                    },
                    message: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter message'
                            }
                        }
                    },
                },
                plugins: {
                  trigger: new FormValidation.plugins.Trigger(),
                  bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: '.contact-form__group'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
              }).on('core.form.valid', function () {
                // console.log("submit")
                // Jump to the next step when all fields in the current step are valid
                productForm.submit();
              });;
        }
    })();
});
</script>
@endsection
<!-- Scripts Ends -->