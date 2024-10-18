@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Buyer Home')


<!-- CSS Starts -->
@section('head-style')

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/rateyo/rateyo.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/nouislider/nouislider.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet"
    href="{{ asset(mix('assets/vendor/css' .$configData['rtlSupport'] .'/core' .($configData['style'] !== 'light' ? '-' . $configData['style'] : '') .'.css')) }}"
    class="{{ $configData['hasCustomizer'] ? 'template-customizer-core-css' : '' }}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/wf-icon/style.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css?ver=1')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/home.css')}}" />
<style type="text/css">
    body {
        background: #fff;
    }
    .navbar-nav .dropdown-menu {
        position: absolute;
    }
</style>
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">
@if(!$isSeller)
    <div class="dash-charts uk-slider uk-slider-container"
        data-uk-slider="center: true; autoplay: true; pause-on-hover: true; autoplay-interval: 2000">
        <div class="uk-container">
            <div class="dash-charts__container">
                @include('content.sections.live-price-products')
            </div>
        </div>
    </div>
@endif

    <form method="GET" id="product-form">
        <div class="dash-search"
        @if($isSeller)
        style="padding-top: 60px;"
        @endif
        >
            <div class="uk-container dash-search__container">
                <h2 class="title title--m dash-search__title">La prima piattaforma in Italia per acquistare prodotti petroliferi online.</h2>
                <div class="dash-search__text">
                    <p>
                    @if($isSeller)
                        Cerca acquirenti su WillFeed
                    @else
                        Ricerca prodotti e venditori su WillFeed
                    @endif
                    </p>
                </div>
                <div class="dash-search__box">
                    <input type="search" class="uk-input dash-search__input" name="search"
                        placeholder="Cerca" value="{{$search}}">
                    <button type="submit" class="uk-button dash-search__button"><span
                            class="wf-icon wf-icon-search"></span> </button>
                </div>
            </div>
        </div>

        <div class="product-filter">
            <div class="uk-container product-filter__container">
                <div>
                    <button type="button" class="uk-button filter__toggler js-filter-toggler uk-icon uk-button-primary">
                        <svg height="20" viewBox="-4 0 393 393.99003" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m368.3125 0h-351.261719c-6.195312-.0117188-11.875 3.449219-14.707031 8.960938-2.871094 5.585937-2.3671875 12.3125 1.300781 17.414062l128.6875 181.28125c.042969.0625.089844.121094.132813.183594 4.675781 6.3125 7.203125 13.957031 7.21875 21.816406v147.796875c-.027344 4.378906 1.691406 8.582031 4.777344 11.6875 3.085937 3.105469 7.28125 4.847656 11.65625 4.847656 2.226562 0 4.425781-.445312 6.480468-1.296875l72.3125-27.574218c6.480469-1.976563 10.78125-8.089844 10.78125-15.453126v-120.007812c.011719-7.855469 2.542969-15.503906 7.214844-21.816406.042969-.0625.089844-.121094.132812-.183594l128.683594-181.289062c3.667969-5.097657 4.171875-11.820313 1.300782-17.40625-2.832032-5.511719-8.511719-8.9726568-14.710938-8.960938zm-131.53125 195.992188c-7.1875 9.753906-11.074219 21.546874-11.097656 33.664062v117.578125l-66 25.164063v-142.742188c-.023438-12.117188-3.910156-23.910156-11.101563-33.664062l-124.933593-175.992188h338.070312zm0 0" />
                        </svg>
                        Filter
                    </button>
                </div>
                <div class="uk-grid product-filter__grid">
                    <div class="uk-width-auto product-filter__col product-filter__col--sidebar js-filter">
                        <div class="filter">

                            <button type="button" class="uk-button filter__close js-filter-toggler uk-icon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1024" height="1024"
                                    viewBox="0 0 1024 1024">
                                    <path
                                        d="M998 916c22 24 22 62 0 86-12 12-28 18-42 18-16 0-32-6-42-18l-402-402-402 402c-12 10-26 16-42 16s-30-6-42-16c-24-24-24-62 0-86l402-400-402-402c-24-24-24-62 0-84 22-24 60-24 84 0l402 400 402-400c22-24 60-24 84 0 24 22 24 60 0 84l-402 402z">
                                    </path>
                                </svg>
                                <span class="sr-only">Hide Filter</span>
                            </button>

                            <div class="filter-heading">
                                <h2 class="filter-heading__title">Filtra ricerca</h2>
                                @if(count($request)>0)
                                <a href="{{route("pages-buyer-home")}}"
                                    class="uk-button filter-heading__clear">Clear</a>
                                @endif
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Prodotto</h3>
                                @foreach($products_filter as $product)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="fuel_type[]"
                                        class="uk-checkbox filter-checkbox__input product-filter-checkbox"
                                        id="FuelType-{{$product->id}}" value="{{$product->name}}" {{
                                        isset($request['fuel_type'])&&in_array($product->name,
                                    $request['fuel_type'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="FuelType-{{$product->id}}">
                                        <span class="filter-checkbox__label-type">{{$product->name}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            @if(!$isSeller)
                            <div class="filter__item">
                                <h3 class="filter__name">Prezzo</h3>
                                <div class="mb-5 mt-4 noUi-primary" id="price-range"></div>
                                <input type="hidden" id="price_min" name="price_min"
                                    value="{{isset($request['price_min'])?formatAmountForItaly($request['price_min']):''}}">
                                <input type="hidden" id="price_max" name="price_max"
                                    value="{{isset($request['price_max'])?formatAmountForItaly($request['price_max']):''}}">
                            </div>
                            @endif

                            <div class="filter__item">
                                <h3 class="filter__name">Metodo di pagamento</h3>
                                @foreach($payment_options as $c => $payment_option)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="payment_option[]"
                                        class="uk-checkbox filter-checkbox__input product-filter-checkbox"
                                        id="PaymentMethod-{{$c}}" value="{{$payment_option}}" {{
                                        isset($request['payment_option'])&&in_array($payment_option,
                                        $request['payment_option'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="PaymentMethod-{{$c}}">
                                        <span class="filter-checkbox__label-type">{{$payment_option}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Regione di consegna</h3>
                                @foreach($regions as $region)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="region[]"
                                        class="uk-checkbox filter-checkbox__input product-filter-checkbox"
                                        id="Geographic-{{$region->id}}" value="{{$region->name}}" {{
                                        isset($request['region'])&&in_array($region->name,
                                    $request['region'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="Geographic-{{$region->id}}">
                                        <span class="filter-checkbox__label-type">{{$region->name}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Dilazione di pagamento</h3>
                                @foreach($payment_extensions as $payment_extension)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="payment_time[]"
                                        class="uk-checkbox filter-checkbox__input product-filter-checkbox"
                                        id="PaymentTime-{{$payment_extension->id}}" value="{{$payment_extension->name}}"
                                        {{ isset($request['payment_time'])&&in_array($payment_extension->name,
                                    $request['payment_time'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="PaymentTime-{{$payment_extension->id}}">
                                        <span class="filter-checkbox__label-type">{{$payment_extension->name}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            {{-- <div class="filter__item">
                                <h3 class="filter__name">Delivery time range</h3>
                                <div class="mb-5 mt-4 noUi-primary" id="delivery-time-range"></div>
                                <input type="hidden" name="delivery_time_min" id="delivery_time_min"
                                    value="{{isset($request['delivery_time_min'])?$request['delivery_time_min']:''}}" />
                                <input type="hidden" name="delivery_time_max" id="delivery_time_max"
                                    value="{{isset($request['delivery_time_max'])?$request['delivery_time_max']:''}}" />
                            </div> --}}

                        </div>
                    </div>
                    <div class="uk-width-expand product-filter__col product-filter__col--items">
                        @if($products_list && count($products_list))
                        @if($isSeller)
                        @foreach ($products_list as $product)
                        @php
                        $rating = App\Models\Rating::where(['review_for_id' => $product->user_id, 'status' =>
                        'approve'])->avg('star');
                        $u = \App\Models\User::where(["id" => $product->user_id])->first();
                        @endphp
                        <div class="product__item">

                            <div class="product__header">
                                <div class="product-seller">
                                    <div class="product-seller__media">
                                        @if($u)
                                        <img src="{{$u->profile_photo_url}}" width="48" height="48">
                                        @endif
                                    </div>
                                    <div class="product-seller__body">
                                        <h3 class="product-seller__name">{{$product->business_name}}</h3>
                                        <p class="product-seller__type">{{$product->main_activity_ids}}</p>
                                    </div>
                                </div>
                                <div class="product-rating">
                                    <div class="js-product-ratings" data-rating="{{$rating}}"></div>
                                </div>
                            </div>
                            <div class="product__body uk-grid" daa-uk-grid>
                                <div class="uk-width-auto product__item-col product__item-col--names">
                                    <div class="product-data-chart uk-grid" data-uk-grid>
                                        <div class="product-prdata">
                                            <h2 class="product__name">{{$product->products}}</h2>
                                        </div>
                                        <div class="product-chart">
                                            
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        @if($product->user_id)
                                        <a href="{{route("profile-view", ['id'=> $product->user_id])}}"
                                            class="uk-button uk-button-default product-actions__view">Profilo</a>
                                        @endif
                                        @if($product->couldOrderStatus&&$product->couldOrderStatus=="approved")
                                        <button type="button" class="uk-button uk-button-primary product-actions__buy" disabled>Collaborata</button>
                                        @elseif(($product->couldOrderStatus&&$product->couldOrderStatus=="pending"))
                                        <button type="button" class="uk-button uk-button-primary product-actions__buy" disabled>Richiesta inviata</button>
                                        @else
                                        <button type="button" class="uk-button uk-button-primary product-actions__buy js-send-collab-request" data-customer-id="{{$product->user_id}}"
                                            target="_blank">
                                            {{($product->couldOrderStatus&&$product->couldOrderStatus=="pending")?'Requested':'Collabora'}}
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-width-expand product__item-col product__item-col--desc">
                                    <div class="product__desc">
                                        <div class="product__priceinfo fs-18">
                                            <strong>Dilazione di pagamento:</strong> {{$product->payment_extension}}
                                        </div>
                                        <div class="product__priceinfo fs-18">
                                            <strong>Sei un distributore privato:</strong> {{$product->is_private_distributer}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @else
                        @foreach ($products_list as $product)
                        @php
                        $rating = App\Models\Rating::where(['review_for_id' => $product->seller_id, 'status' =>
                        'approve'])->avg('star');
                        @endphp
                        <div class="product__item">

                            <div class="product__header">
                                <div class="product-seller">
                                    <div class="product-seller__media">
                                        <img src="{{$product->seller->profile_photo_url}}" width="48" height="48">
                                    </div>
                                    <div class="product-seller__body">
                                        <h3 class="product-seller__name">{{$product->seller_name}}</h3>
                                        <p class="product-seller__type">{{$product->main_activity_ids}}</p>
                                    </div>
                                </div>
                                <div class="product-rating">
                                    <div class="js-product-ratings" data-rating="{{$rating}}"></div>
                                </div>
                            </div>
                            <div class="product__body uk-grid" data-uk-grid>
                                <div class="uk-width-auto product__item-col product__item-col--names">
                                    <div class="product-data-chart uk-grid" data-uk-grid>
                                        <div class="product-prdata">
                                            <h2 class="product__name">{{$product->product_name}}</h2>
                                            <div class="product__fullprice">
                                                €<span class="js-display-final-amount">{{formatAmountForItaly($product->amount)}}/LITRO</span> IVA inclusa
                                            </div>
                                            <div class="product__price">
                                                <span class="product__price-big">€<span class="js-display-without-tax">{{formatAmountForItaly($product->amount_before_tax)}}</span></span>/LITRO
                                            </div>
                                            {{-- <div class="product__priceinfo">
                                                (Inclusive Of all Tax)
                                            </div> --}}
                                            <div class="product__avail">
                                                Disponibilità:
                                                @if($product->status == "active")
                                                <span class="product__avail-type">Disponibile</span>
                                                @else
                                                <span class="product__avail-type product__avail-type--negative">Non disponibile</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-chart">
                                            <div id="productItemChart-{{$product->id}}"></div>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a href="{{route("profile-view", ['id'=> $product->seller_id])}}"
                                            class="uk-button uk-button-default product-actions__view">Profilo</a>
                                        @if($isBuyer)
                                        @if($product->couldOrderStatus&&$product->couldOrderStatus=="approved")
                                        <a href="{{route("pages-buyer-checkout", [ "csrf"=> csrf_token(),
                                            "seller_product_id" => $product->id
                                            ])}}" class="uk-button uk-button-primary product-actions__buy">Ordina</a>
                                        @else
                                        <a href="{{route("customer-request-to-seller", [ "csrf"=> csrf_token(),
                                            "seller_id" => $product->seller_id
                                            ])}}" class="uk-button uk-button-primary product-actions__buy"
                                            target="_blank">
                                            {{($product->couldOrderStatus&&$product->couldOrderStatus=="pending")?'Requested':'Collabora'}}
                                        </a>
                                        @endif
                                        @else
                                        @if(!$isAdmin)
                                        <a href="{{route("pages-buyer-checkout", [ "csrf"=> csrf_token(),
                                            "seller_product_id" => $product->id
                                            ])}}" class="uk-button uk-button-primary product-actions__buy">Ordina</a>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="uk-width-expand product__item-col product__item-col--desc">
                                    <div class="product__desc">
                                        {{-- <div class="product__priceinfo">
                                            Regione: {{$product->region}}
                                        </div> --}}
                                        <div class="product__priceinfo fs-18">
                                            <strong class="">Dilazione di pagamento:</strong>
                                            <select class="form-select select2 js-payment-term" data-minimum-results-for-search="Infinity">
                                                @if($product->amount_before_tax>0)
                                                <option data-price="{{$product->amount_before_tax}}">A vista</option>
                                                @endif
                                                @if($product->amount_30gg>0)
                                                <option data-price="{{$product->amount_30gg}}">30gg</option>
                                                @endif
                                                @if($product->amount_60gg>0)
                                                <option data-price="{{$product->amount_60gg}}">60gg</option>
                                                @endif
                                                @if($product->amount_90gg>0)
                                                <option data-price="{{$product->amount_90gg}}">90gg</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="product__priceinfo fs-18">
                                            <strong>Metodi di pagamento accettati:</strong>
                                            @php
                                            $sep = "";
                                            if($product->bank_transfer != ""){
                                            echo $sep."Bonifico Bancario";
                                            $sep = ", ";
                                            }
                                            if($product->bank_check != ""){
                                            echo $sep."Assegno Bancario";
                                            $sep = ", ";
                                            }
                                            if($product->rib == "Si"){
                                            echo $sep."RIBA";
                                            $sep = ", ";
                                            }
                                            if($product->rid == "Si"){
                                            echo $sep."RID";
                                            $sep = ", ";
                                            }
                                            @endphp
                                        </div>
                                        <div class="product__priceinfo fs-18">
                                        @php
                                            $display_date = \App\Helpers\Helpers::calculateEstimateShippingDate($product->delivery_time, $product->delivery_days, $product->days_off)
                                        @endphp
                                            <strong>Prima consegna:</strong>
                                            {{$display_date}}
                                            {{-- @if($product->delivery_time)
                                            @if(date("H:i")<=$product->delivery_time)
                                                Deliver on: {{date("d-m-Y")}}
                                                @else
                                                Deliver on:

                                                @if($product->delivery_days=="Stesso giorno")
                                                {{date("d-m-Y")}}
                                                @else
                                                {{date("d-m-Y", time() + 86400)}}
                                                @endif
                                                @endif
                                                @else
                                                Deliver on: NA
                                                @endif --}}
                                        </div>
                                        @if((date('Y-m-d', strtotime($product->updated_at)) != date('Y-m-d')) || (date('Y-m-d', strtotime($product->updated_at)) == date('Y-m-d') && (date('H:i') > $product->delivery_time)))
                                        <p>
                                            <strong class="text-danger">ORDINE EFFETTUATO FUORI ORARIO OPERATIVO.<br>
                                            L'APPROVAZIONE SARÀ A DISCREZIONE DEL VENDITORE.</strong>
                                        </p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        @endif
                        {{ $products_list->links() }}
                        @else
                        <div class="thanks__icon">
                            <img src="/assets/front/images/reject.svg" width="340" height="196">
                        </div>
                        <h3 style="text-center">
                        @if($isSeller)
                            Nessun acquirente trovato
                        @else
                            Nessun prodotto trovato
                        @endif
                        </h3>
                        <div class="thanks__action">
                            <a href="{{route("pages-buyer-home")}}"
                                class="uk-button uk-button-primary thanks__action-btn">ricerca chiara</a>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </form>

</main>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" onsubmit="return false" id="rating-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Star rating</label>
                            <div class="onChange-event-ratings mb-3"></div>
                            <div class="counter-wrapper">
                                <strong>Ratings:</strong>
                                <span class="counter"></span>
                                <input type="hidden" name="rating" id="js-rating-val">
                                <input type="hidden" name="rating_for" id="rating_for">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="message" class="form-label">Message</label>
                            <input type="text" id="message" name="message" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-rating">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="collabModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="collab-form" action="{{route("seller-request-to-buyer", [
                "csrf" => csrf_token()
            ])}}">
                @csrf
                <div class="modal-header">
                    <input type="hidden" name="buyer_id" id="buyer_id_input">
                    <h5 class="modal-title" id="exampleModalLabel1">Aggiungi limite di credito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="message" class="form-label">Limite di credito</label>
                            <input type="number" id="credit_limit" name="credit_limit" class="form-control" placeholder="Inserisci il limite di credito" lang="es-ES">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="uk-button uk-button-default product-actions__view" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="uk-button uk-button-primary product-actions__buy" id="save-invitation">Invia collaborazione</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script>
    let price_min = {{isset($request['price_min'])?$request['price_min']:$price_min}};
    let price_max = {{isset($request['price_max'])?$request['price_max']:$price_max}};
    let delivery_time_min = {{isset($request['delivery_time_min'])?$request['delivery_time_min']:0}};
    let delivery_time_max = {{isset($request['delivery_time_max'])?$request['delivery_time_max']:30}};
</script>
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/ui-modals.js')}}"></script> --}}
<script src="{{asset('assets/front/js/custom.js')}}"></script>
{{-- <script src="{{asset('assets/front/js/product-listing.js')}}"></script> --}}
<script>
    $(function(){
        const dynamicSlider = document.getElementById('delivery-time-range');
        const priceRangeSlider = document.getElementById('price-range');

        if(priceRangeSlider){
            noUiSlider.create(priceRangeSlider, {
                start: [price_min, price_max],
                connect: true,
                step: 0.1,
                direction: 'ltr',
                behaviour: 'tap-drag',
                tooltips: true,
                range: {
                min: {{$price_min}},
                max: {{$price_max}}
                }
            });

            priceRangeSlider.noUiSlider.on('change', function (values, handle) {
                $("#price_min").val(values[0]);
                $("#price_max").val(values[1]);

                $("#product-form").submit();
            });
        }

        if (dynamicSlider) {
            noUiSlider.create(dynamicSlider, {
                start: [delivery_time_min, delivery_time_max],
                connect: true,
                step: 1,
                direction: 'ltr',
                behaviour: 'tap-drag',
                tooltips: true,
                range: {
                min: 0,
                max: 30
                }
            });

            dynamicSlider.noUiSlider.on('change', function (values, handle) {
                $("#delivery_time_min").val(values[0]);
                $("#delivery_time_max").val(values[1]);

                $("#product-form").submit();
            });
        }

        $(".product-filter-checkbox").on("change", function(){
            $("#product-form").submit();
        });
    });
</script>
<script>
    //.product-filter
    var $container = $("html,body");
    var $scrollTo = $('.product-filter');
    $(document).ready(function(){
        if ((window.location.href).includes('?')) {
            $container.animate({
                scrollTop: $scrollTo.offset().top - 120, 
                scrollLeft: 0}
            ,300);
        }
        // $('html, body').scrollTop($('.product-filter').offset().top);
        
    });
</script>

<script>
    @if($products_list && $isBuyer)
@foreach ($products_list as $product)
    @php
    $price_history = App\Models\ProductPriceHistory::where(["product_id" => $product->product_id])->orderBy("date", "DESC")->take(10)->get();
    $price_string = "";
    $sep = "";
    foreach($price_history as $_price_history){
        $price_string .= $sep . $_price_history->price;
        $sep = ", ";
    }
    @endphp
    var productEl{{$product->id}} = document.querySelector('#productItemChart-{{$product->id}}'),
        productElConfig{{$product->id}} = {
            chart: {
                height: 130,
                type: 'area',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                }
            },
            markers: {
                colors: 'transparent',
                strokeColors: 'transparent'
            },
            grid: {
                show: false
            },
            colors: ['#28C76F'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.8,
                    opacityFrom: 0.6,
                    opacityTo: 0.1
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            series: [{
                data: [{{$price_string}}]
            }],
            xaxis: {
                show: true,
                lines: {
                    show: false
                },
                labels: {
                    show: false
                },
                stroke: {
                    width: 0
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                stroke: {
                    width: 0
                },
                show: true
            },
            tooltip: {
                enabled: true
            }
        };
    var productItemChart{{$product->id}} = new ApexCharts(productEl{{$product->id}}, productElConfig{{$product->id}});
    productItemChart{{$product->id}}.render();
@endforeach
@endif
</script>
<script type="text/javascript">
    $('.js-filter-toggler').on('click', function () {
        $('.js-filter').fadeToggle();
    });

</script>
<script>
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const productForm = document.querySelector('#rating-form');
        // Form validation for Add new record
        if (productForm) {
            FormValidation.formValidation(productForm, {
                fields: {
                    rating: {
                        validators: {
                            notEmpty: {
                                message: 'Please select rating'
                            }
                        }
                    },
                    message: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter message'
                            }
                        }
                    }
                },
                plugins: {
                  trigger: new FormValidation.plugins.Trigger(),
                  bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: '.col'
                  }),
                  submitButton: new FormValidation.plugins.SubmitButton(),
                  // Submit the form when all fields are valid
                  // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                  autoFocus: new FormValidation.plugins.AutoFocus()
                }
              }).on('core.form.valid', function () {
                console.log("submit")
                // Jump to the next step when all fields in the current step are valid
                // productForm.submit();

                $.ajax({
                    type: 'POST',
                    url: "{{route("customer-rating-add")}}",
                    data: $("#rating-form").serialize(),
                    success: function success(res) {
                        $("#basicModal").modal("toggle");
                        if(res.code == 200){
                            Swal.fire({
                                text: res.data,
                                icon: 'success',
                                showCancelButton: false,
                                customClass: {
                                    cancelButton: 'btn btn-label-secondary'
                                },
                                buttonsStyling: true
                            });
                        } else {
                            Swal.fire({
                                text: res.data,
                                icon: 'warning',
                                showCancelButton: false,
                                customClass: {
                                    cancelButton: 'btn btn-label-secondary'
                                },
                                buttonsStyling: true
                            });
                        }
                    },
                    error: function error(_error) {
                        $("#basicModal").modal("toggle");
                        Swal.fire({
                            text: 'Error! Please try again in some time.',
                            icon: 'warning',
                            showCancelButton: false,
                            customClass: {
                                cancelButton: 'btn btn-label-secondary'
                            },
                            buttonsStyling: true
                        });
                    }
                });
              });
        }
    })();
});
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    @if($isBuyer)
    $(function () {
        var onChangeEvents = $('.onChange-event-ratings');

        if (onChangeEvents) {
            onChangeEvents
            .rateYo({
                rtl: false,
                spacing: '8px'
            })
            .on('rateyo.change', function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.counter').text(rating);
                $("#js-rating-val").val(rating);
            });
        }
    });
    // $(".product-rating").on("click", function(){
    //     $("#rating_for").val($(this).data("seller"));
    //     var onChangeEvents = $('.onChange-event-ratings');
    //     onChangeEvents.rateYo({
    //       rtl: false,
    //       spacing: '8px'
    //     });
    //     $("#rating-form").trigger("reset");
    // });
    @else
    // $(".js-product-ratings").on("click", function(){
    //     Swal.fire({
    //         text: 'You are not logged in, First you need to login to give reviews!',
    //         icon: 'warning',
    //         showCancelButton: false,
    //         customClass: {
    //             cancelButton: 'btn btn-label-secondary'
    //         },
    //         buttonsStyling: true
    //     });
    // });
    @endif
</script>

<script>
    $(".js-send-collab-request").on("click", function(){
        $("#collabModal").modal("toggle");
        $("#buyer_id_input").val($(this).attr("data-customer-id"));
    })
</script>
<script>
    $(".js-payment-term").on("change", function(){
        let p = $(this).find("option:selected").attr("data-price");
        $(this).parents(".product__body").find(".js-display-without-tax").text(p);
        let per = 22 * p / 100;
        let fp = (+p + +per).toFixed(2);
        $(this).parents(".product__body").find(".js-display-final-amount").text(fp);
    })
</script>
@endsection
<!-- Scripts Ends -->