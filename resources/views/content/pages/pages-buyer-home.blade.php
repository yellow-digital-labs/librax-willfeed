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

    <div class="dash-charts uk-slider uk-slider-container" data-uk-slider="center: true; autoplay: true; pause-on-hover: true; autoplay-interval: 2000">
        <div class="uk-container">
            <div class="dash-charts__container">
                @include('content.sections.live-price-products')
            </div>
        </div>
    </div>

    <form method="GET" id="product-form">
        <div class="dash-search">
            <div class="uk-container dash-search__container">
                <h2 class="title title--m dash-search__title">World’s first platform to buy more than 400+ petrochemical products online</h2>
                <div class="dash-search__box">
                    <input type="search" class="uk-input dash-search__input" name="search" placeholder="Search products or sellers" value="{{$search}}">
                    <button type="submit" class="uk-button dash-search__button"><span class="wf-icon wf-icon-search"></span> </button>
                </div>
                <div class="dash-search__text">
                    <p>WILLFEED rivoluziona il mercato dei carburanti con una piattaforma unica in Italia.</p>
                </div>
            </div>
        </div>

        <div class="product-filter">
            <div class="uk-container product-filter__container">
                <div>
                    <button type="button" class="uk-button filter__toggler js-filter-toggler uk-icon uk-button-primary">
                        <svg height="20" viewBox="-4 0 393 393.99003" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m368.3125 0h-351.261719c-6.195312-.0117188-11.875 3.449219-14.707031 8.960938-2.871094 5.585937-2.3671875 12.3125 1.300781 17.414062l128.6875 181.28125c.042969.0625.089844.121094.132813.183594 4.675781 6.3125 7.203125 13.957031 7.21875 21.816406v147.796875c-.027344 4.378906 1.691406 8.582031 4.777344 11.6875 3.085937 3.105469 7.28125 4.847656 11.65625 4.847656 2.226562 0 4.425781-.445312 6.480468-1.296875l72.3125-27.574218c6.480469-1.976563 10.78125-8.089844 10.78125-15.453126v-120.007812c.011719-7.855469 2.542969-15.503906 7.214844-21.816406.042969-.0625.089844-.121094.132812-.183594l128.683594-181.289062c3.667969-5.097657 4.171875-11.820313 1.300782-17.40625-2.832032-5.511719-8.511719-8.9726568-14.710938-8.960938zm-131.53125 195.992188c-7.1875 9.753906-11.074219 21.546874-11.097656 33.664062v117.578125l-66 25.164063v-142.742188c-.023438-12.117188-3.910156-23.910156-11.101563-33.664062l-124.933593-175.992188h338.070312zm0 0"/></svg>
                        Filter
                    </button>
                </div>
                <div class="uk-grid product-filter__grid">
                    <div class="uk-width-auto product-filter__col product-filter__col--sidebar js-filter">
                        <div class="filter">

                            <button type="button" class="uk-button filter__close js-filter-toggler uk-icon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024">
                                <path d="M998 916c22 24 22 62 0 86-12 12-28 18-42 18-16 0-32-6-42-18l-402-402-402 402c-12 10-26 16-42 16s-30-6-42-16c-24-24-24-62 0-86l402-400-402-402c-24-24-24-62 0-84 22-24 60-24 84 0l402 400 402-400c22-24 60-24 84 0 24 22 24 60 0 84l-402 402z"></path>
                                </svg>
                                <span class="sr-only">Hide Filter</span>
                            </button>
                            
                            <div class="filter-heading">
                                <h2 class="filter-heading__title">Filters</h2>
                                @if(count($request)>0)
                                <a href="{{route("pages-buyer-home")}}" class="uk-button filter-heading__clear">Clear</a>
                                @endif
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Fuel type</h3>
                                @foreach($products as $product)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="fuel_type[]" class="uk-checkbox filter-checkbox__input product-filter-checkbox" id="FuelType-{{$product->id}}" value="{{$product->name}}"
                                    {{ isset($request['fuel_type'])&&in_array($product->name, $request['fuel_type'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="FuelType-{{$product->id}}">
                                        <span class="filter-checkbox__label-type">{{$product->name}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Price</h3>
                                <div class="mb-5 mt-4 noUi-primary" id="price-range"></div>
                                <input type="hidden" id="price_min" name="price_min" value="{{isset($request['price_min'])?$request['price_min']:''}}">
                                <input type="hidden" id="price_max" name="price_max" value="{{isset($request['price_max'])?$request['price_max']:''}}">
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Payment method</h3>
                                @foreach($payment_options as $c => $payment_option)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="payment_option[]" class="uk-checkbox filter-checkbox__input product-filter-checkbox" id="PaymentMethod-{{$c}}" value="{{$payment_option}}" {{ isset($request['payment_option'])&&in_array($payment_option, $request['payment_option'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="PaymentMethod-{{$c}}">
                                        <span class="filter-checkbox__label-type">{{$payment_option}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Geographic delivery limits</h3>
                                @foreach($regions as $region)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="region[]" class="uk-checkbox filter-checkbox__input product-filter-checkbox" id="Geographic-{{$region->id}}" value="{{$region->name}}" {{ isset($request['region'])&&in_array($region->name, $request['region'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="Geographic-{{$region->id}}">
                                        <span class="filter-checkbox__label-type">{{$region->name}}</span>
                                        {{-- <span class="filter-checkbox__label-count">5</span> --}}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Payment time</h3>
                                @foreach($payment_extensions as $payment_extension)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="payment_time[]" class="uk-checkbox filter-checkbox__input product-filter-checkbox" id="PaymentTime-{{$payment_extension->id}}" value="{{$payment_extension->name}}" {{ isset($request['payment_time'])&&in_array($payment_extension->name, $request['payment_time'])?'checked':'' }}>
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
                                <input type="hidden" name="delivery_time_min" id="delivery_time_min" value="{{isset($request['delivery_time_min'])?$request['delivery_time_min']:''}}" />
                                <input type="hidden" name="delivery_time_max" id="delivery_time_max" value="{{isset($request['delivery_time_max'])?$request['delivery_time_max']:''}}" />
                            </div> --}}

                        </div>
                    </div>
                    <div class="uk-width-expand product-filter__col product-filter__col--items">
                    @if($products_list && count($products_list))
                        @foreach ($products_list as $product)
                        @php
                            $rating = App\Models\Rating::where(['review_for_id' => $product->seller_id, 'status' => 'approve'])->avg('star');
                        @endphp
                        <div class="product__item">
                            
                            <div class="product__header">
                                <div class="product-seller">
                                    <div class="product-seller__media">
                                        <img src="/assets/img/avatars/1.png" width="48" height="48">
                                    </div>
                                    <div class="product-seller__body">
                                        <h3 class="product-seller__name">{{$product->seller_name}}</h3>
                                        <p class="product-seller__type">Seller</p>
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
                                                €{{$product->amount_before_tax}} + 22% TAX
                                            </div>
                                            <div class="product__price">
                                                <span class="product__price-big">€{{$product->amount}}</span>/LITERS 
                                            </div>
                                            <div class="product__priceinfo">
                                                (Inclusive Of all Tax)
                                            </div>
                                            <div class="product__avail">
                                                Availability:
                                                @if($product->current_stock>0)
                                                    <span class="product__avail-type">In stock</span>
                                                @else
                                                    <span class="product__avail-type product__avail-type--negative">Out of stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-chart">
                                            <div id="productItemChart-{{$product->id}}"></div>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <a href="{{route("profile-view", ['id' => $product->seller_id])}}" class="uk-button uk-button-default product-actions__view">Profilo</a>
                                    @if($isBuyer)
                                        @if($product->couldOrderStatus&&$product->couldOrderStatus=="approved")
                                        <a href="{{route("pages-buyer-checkout", [
                                            "csrf" => csrf_token(),
                                            "seller_product_id" => $product->id
                                        ])}}" class="uk-button uk-button-primary product-actions__buy">Ordina</a>
                                        @else
                                        <a href="{{route("customer-request-to-seller", [
                                            "csrf" => csrf_token(),
                                            "seller_id" => $product->seller_id
                                        ])}}" class="uk-button uk-button-primary product-actions__buy" target="_blank">
                                            {{($product->couldOrderStatus&&$product->couldOrderStatus=="pending")?'Requested':'Collabora'}}
                                        </a>
                                        @endif
                                    @else
                                        <a href="{{route("pages-buyer-checkout", [
                                            "csrf" => csrf_token(),
                                            "seller_product_id" => $product->id
                                        ])}}" class="uk-button uk-button-primary product-actions__buy">Ordina</a>
                                    @endif
                                    </div>
                                </div>
                                <div class="uk-width-expand product__item-col product__item-col--desc">
                                    <div class="product__desc">
                                        <div class="product__priceinfo">
                                            Attività principale: {{$product->main_activity_ids}}
                                        </div>
                                        <div class="product__priceinfo">
                                            Regione: {{$product->region}}
                                        </div>
                                        <div class="product__priceinfo">
                                            Payment timing: {{$product->payment_extension}}
                                        </div>
                                        <div class="product__priceinfo">
                                            Payment methods:
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
                                        <div class="product__priceinfo">
                                            Deliver on: {{App\Helpers\Helpers::calculateEstimateShippingDate($product->delivery_time, $product->delivery_days, $product->days_off)}}
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
                                        {{-- <p>
                                            {!!$product->product->description!!}
                                        </p> --}}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                        {{ $products_list->links() }}
                    @else
                        <div class="thanks__icon">
                            <img src="/assets/front/images/reject.svg" width="340" height="196">
                        </div>
                        <h3 style="text-center">Nessun prodotto trovato</h3>
                        <div class="thanks__action">
                            <a href="{{route("pages-buyer-home")}}" class="uk-button uk-button-primary thanks__action-btn">ricerca chiara</a>
                        </div>
                    @endif
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </form>

</main>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script>
    let price_min = {{isset($request['price_min'])?$request['price_min']:0.10}};
    let price_max = {{isset($request['price_max'])?$request['price_max']:10.00}};
    let delivery_time_min = {{isset($request['delivery_time_min'])?$request['delivery_time_min']:0}};
    let delivery_time_max = {{isset($request['delivery_time_max'])?$request['delivery_time_max']:30}};
</script>
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>
<script src="{{asset('assets/front/js/product-listing.js')}}"></script>

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
@if($products_list)
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
@endsection
<!-- Scripts Ends -->