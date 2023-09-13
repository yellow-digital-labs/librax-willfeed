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

    <div class="dash-search">
        <div class="uk-container dash-search__container">
            <h2 class="title title--m dash-search__title">World’s first platform to buy more than 400+ petrochemical products online</h2>
            <div class="dash-search__box">
                <input type="search" class="uk-input dash-search__input" name="" placeholder="Search products or sellers">
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
                            <button type="button" class="uk-button filter-heading__clear">Clear</button>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Fuel type</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="FuelType-1">
                                <label class="filter-checkbox__label" for="FuelType-1">
                                    <span class="filter-checkbox__label-type">Fuel type-1</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="FuelType-2">
                                <label class="filter-checkbox__label" for="FuelType-2">
                                    <span class="filter-checkbox__label-type">Fuel type-2</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="FuelType-3">
                                <label class="filter-checkbox__label" for="FuelType-3">
                                    <span class="filter-checkbox__label-type">Fuel type-3</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Price</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Price-1">
                                <label class="filter-checkbox__label" for="Price-1">
                                    <span class="filter-checkbox__label-type">€0.10 to €10 /LITTER</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Price-2">
                                <label class="filter-checkbox__label" for="Price-2">
                                    <span class="filter-checkbox__label-type">€0.10 to €10 /LITTER</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Price-3">
                                <label class="filter-checkbox__label" for="Price-3">
                                    <span class="filter-checkbox__label-type">€0.10 to €10 /LITTER</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Price-4">
                                <label class="filter-checkbox__label" for="Price-4">
                                    <span class="filter-checkbox__label-type">€0.10 to €10 /LITTER</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Payment method</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentMethod-1">
                                <label class="filter-checkbox__label" for="PaymentMethod-1">
                                    <span class="filter-checkbox__label-type">Assegno</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentMethod-2">
                                <label class="filter-checkbox__label" for="PaymentMethod-2">
                                    <span class="filter-checkbox__label-type">Bonifico</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentMethod-3">
                                <label class="filter-checkbox__label" for="PaymentMethod-3">
                                    <span class="filter-checkbox__label-type">XYZ</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Geographic delivery limits</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Geographic-1">
                                <label class="filter-checkbox__label" for="Geographic-1">
                                    <span class="filter-checkbox__label-type">50km to 100km</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Geographic-2">
                                <label class="filter-checkbox__label" for="Geographic-2">
                                    <span class="filter-checkbox__label-type">100km to 200km</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Geographic-3">
                                <label class="filter-checkbox__label" for="Geographic-3">
                                    <span class="filter-checkbox__label-type">200km to 400km</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Geographic-4">
                                <label class="filter-checkbox__label" for="Geographic-4">
                                    <span class="filter-checkbox__label-type">400km to 800km</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Geographic-5">
                                <label class="filter-checkbox__label" for="Geographic-5">
                                    <span class="filter-checkbox__label-type">XYZ</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Payment time</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentTime-1">
                                <label class="filter-checkbox__label" for="PaymentTime-1">
                                    <span class="filter-checkbox__label-type">A vista</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentTime-2">
                                <label class="filter-checkbox__label" for="PaymentTime-2">
                                    <span class="filter-checkbox__label-type">30gg</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="PaymentTime-3">
                                <label class="filter-checkbox__label" for="PaymentTime-3">
                                    <span class="filter-checkbox__label-type">60gg</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter__item">
                            <h3 class="filter__name">Delivery time range</h3>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Delivery-1">
                                <label class="filter-checkbox__label" for="Delivery-1">
                                    <span class="filter-checkbox__label-type">Same day</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Delivery-2">
                                <label class="filter-checkbox__label" for="Delivery-2">
                                    <span class="filter-checkbox__label-type">1 to 10 days</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Delivery-3">
                                <label class="filter-checkbox__label" for="Delivery-3">
                                    <span class="filter-checkbox__label-type">10 to 20 days</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                            <div class="filter-checkbox">
                                <input type="checkbox" name="" class="uk-checkbox filter-checkbox__input" id="Delivery-4">
                                <label class="filter-checkbox__label" for="Delivery-4">
                                    <span class="filter-checkbox__label-type">20 to 30 days</span>
                                    <span class="filter-checkbox__label-count">5</span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="uk-width-expand product-filter__col product-filter__col--items">
                @if($products)
                    @foreach ($products as $product)
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
                                <div class="js-product-ratings" data-rating="4"></div>
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
                                            ( Inclusive Of all Tax)
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
                                        <div id="productItemChart"></div>
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

                    <div class="product-filter__footer">
                        <div class="product-filter__counter">
                            5 di 10 mostrati
                        </div>
                        <div class="product-filter__pagination">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-current="page" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a tabindex="0" class="page-link">…</a></li>
                                <li class="paginate_button page-item "><a href="#" tabindex="0" class="page-link">15</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" tabindex="0" class="page-link">Next</a></li>
                            </ul>
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
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>

<script>
    var productEl = document.querySelector('#productItemChart'),
        productElConfig = {
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
                data: [300, 350, 330, 380, 340, 400, 380]
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
                show: false
            },
            tooltip: {
                enabled: false
            }
        };
    var productItemChart = new ApexCharts(productEl, productElConfig);
    productItemChart.render();
</script>
@endsection
<!-- Scripts Ends -->