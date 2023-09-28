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
                <div class="uk-grid product-filter__grid" data-uk-grid>
                    <div class="uk-width-auto product-filter__col  product-filter__col--sidebar">
                        <div class="filter">
                            
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
                                <input type="hidden" id="price_min" name="price_min" value="">
                                <input type="hidden" id="price_max" name="price_max" value="">
                            </div>

                            <div class="filter__item">
                                <h3 class="filter__name">Payment method</h3>
                                @foreach($payment_options as $payment_option)
                                <div class="filter-checkbox">
                                    <input type="checkbox" name="payment_option[]" class="uk-checkbox filter-checkbox__input product-filter-checkbox" id="PaymentMethod-{{$payment_option->id}}" value="{{$payment_option->name}}" {{ isset($request['payment_option'])&&in_array($payment_option->name, $request['payment_option'])?'checked':'' }}>
                                    <label class="filter-checkbox__label" for="PaymentMethod-{{$payment_option->id}}">
                                        <span class="filter-checkbox__label-type">{{$payment_option->name}}</span>
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

                            <div class="filter__item">
                                <h3 class="filter__name">Delivery time range</h3>
                                <div class="mb-5 mt-4 noUi-primary" id="delivery-time-range"></div>
                                <input type="hidden" name="delivery_time_min" id="delivery_time_min" />
                                <input type="hidden" name="delivery_time_max" id="delivery_time_max" />
                            </div>

                        </div>
                    </div>
                    <div class="uk-width-expand product-filter__col product-filter__col--items">
                    @if($products_list)
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
                                        <a href="{{route("profile-view", ['id' => $product->seller_id])}}" class="uk-button uk-button-default product-actions__view">View seller</a>
                                        <a href="{{route("pages-buyer-checkout", [
                                            "csrf" => csrf_token(),
                                            "seller_product_id" => $product->id
                                        ])}}" class="uk-button uk-button-primary product-actions__buy">Buy now</a>
                                    </div>
                                </div>
                                <div class="uk-width-expand product__item-col product__item-col--desc">
                                    <div class="product__desc">
                                        <p>
                                            {!!$product->product->description!!}
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    @endif
                        {{ $products_list->links() }}
                        
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
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/nouislider/nouislider.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>
<script src="{{asset('assets/front/js/product-listing.js')}}"></script>

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
@endsection
<!-- Scripts Ends -->