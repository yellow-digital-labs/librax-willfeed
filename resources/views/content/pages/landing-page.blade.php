@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Home | WillFeed')


<!-- CSS Starts -->
@section('head-style')

    <!-- CSS: Framework Declaration -->
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css') }}" />

    <!-- CSS: Fonts Declaration -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/components/fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/wf-icon/style.css') }}" />

    <!-- CSS: Layout Setup -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/layout/var.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/components/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/layout/header.css?ver=1') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/layout/footer.css') }}" />


    <!-- CSS: Pagevise CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/pages/pages.css') }}" />

    <!-- Styles -->
    <style>
        #chartdiv {
            width: 100%;
            height: calc(100vh - 100px);
            min-height: 500px;
        }

        .mapwrapp {
            position: relative;
            height: calc(100vh - 100px);
            overflow: hidden;
            background: #fff;
        }

        ul.mapwrapp__list {
            list-style: none;
            position: absolute;
            bottom: 40px;
            left: 70px;
        }

        .mapwrapp__btn {
            text-transform: uppercase;
            font-size: 14px;
            background: #fff;
            color: #000;
            border: 1px solid #9e9c9c;
            padding: 10px 20px;
            border-radius: 5px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            min-width: 160px;
            text-align: center;
            justify-content: flex-start;
            cursor: pointer;
            transition: all .4s ease;
        }

        .mapwrapp__btn[data-type="all"] {
            justify-content: center;
        }

        .mapwrapp__btn-bar {
            height: 10px;
            width: 40px;
            display: inline-flex;
            margin-right: 10px;
        }

        .mapwrapp__btn.is-active {
            background: #000;
            color: #fff;
            border: 1px solid #000;
        }

        ul.mapwrapp__list>li:nth-child(n+2) {
            margin-top: 10px;
        }
    </style>
@endsection
<!-- CSS Ends -->

@section('content')

    @include('_partials/_front/header')

    <main id="main-content" class="wrapper">

        <div class="mapwrapp">
            <div id="chartdiv" class="mapwrapp__map"></div>
            <!-- type of items to be filtered -->
            <ul class="mapwrapp__list">
                <li>
                    <button type="button" class="mapwrapp__btn js-map-filter" data-type="all">All</button>
                </li>
                @foreach($products as $product)
                <li>
                    <button type="button" class="mapwrapp__btn js-map-filter {{$product->type=="Gasolio" ? "is-active" : ""}} " data-type="{{$product->type}}"><span
                            class="mapwrapp__btn-bar" style="background-color: {{$product->productColor}};"></span> {{$product->type}}</button>
                </li>
                @endforeach
            </ul>
        </div>

    </main>

    @include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
    <script src="{{ asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js?version=1') }}"></script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/italyLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root and chart
            var root = am5.Root.new("chartdiv");

            // Set themes
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create map - Starts

            var map = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "none",
                    projection: am5map.geoNaturalEarth1()
                })
            );

            // Ends

            // Create curtain + message to show when wheel is used over chart without CTRL - Starts
            var overlay = root.container.children.push(am5.Container.new(root, {
                width: am5.p100,
                height: am5.p100,
                layer: 100,
                visible: false
            }));

            var curtain = overlay.children.push(am5.Rectangle.new(root, {
                width: am5.p100,
                height: am5.p100,
                fill: am5.color(0xffffff),
                fillOpacity: 0.3
            }));

            var message = overlay.children.push(am5.Label.new(root, {
                text: "Use CTRL + Scroll to zoom",
                fontSize: 30,
                x: am5.p50,
                y: am5.p50,
                centerX: am5.p50,
                centerY: am5.p50
            }));

            map.events.on("wheel", function(ev) {
                if (ev.originalEvent.ctrlKey) {
                    ev.originalEvent.preventDefault();
                    map.set("wheelY", "zoom");
                } else {
                    map.set("wheelY", "none");
                    overlay.show();
                    overlay.setTimeout(function() {
                        overlay.hide()
                    }, 800);
                }
            });

            // Ends

            // Create polygon series - Starts
            var polygonSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_italyLow,
                    exclude: ["FR-H", "MT", "SM", "VA", ],
                    fill: '#eee',
                    stroke: '#000'
                })
            );

            var pointSeries = map.series.push(
                am5map.MapPointSeries.new(root, {})
            );

            var colorSet = am5.ColorSet.new(root, {
                step: 2
            });

            pointSeries.bullets.push(function(root, series, dataItem) {
                var value = dataItem.dataContext.value;
                var productColor = dataItem.dataContext.productColor;

                var container = am5.Container.new(root, {});
                var color = colorSet.next();
                var radius = 50;
                var width = 84;
                var height = 32;
                var circle = container.children.push(am5.RoundedRectangle.new(root, {
                    cornerRadiusBL: radius,
                    cornerRadiusBR: radius,
                    cornerRadiusTL: radius,
                    cornerRadiusTR: radius,
                    fill: productColor,
                    width: width,
                    height: height,
                    shadowColor: am5.color(0x000000),
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowOffsetY: 4,
                    shadowOpacity: 0.35
                }));

                var label = container.children.push(am5.Label.new(root, {
                    text: value,
                    fill: '#fff',
                    // fontWeight: "300",
                    width: width,
                    height: height,
                    textAlign: "center",
                    dy: -1.5,
                    // dx: -2
                }))

                // Add click event listener to the container
                container.events.on("click", function() {
                    alert(dataItem.dataContext.title + " clicked!");
                    // Perform other actions here, such as opening a modal or navigating to a URL
                });

                return am5.Bullet.new(root, {
                    sprite: container
                });
            });

            // Ends




            // ====================================
            // Create pins
            // ====================================

            var data = @json($product_price)

            // Ends

            // Function to update map with filtered data - Starts
            function updateMap(filterType) {
                var filteredData = data;
                if (filterType) {
                    filteredData = data.filter(function(item) {
                        return item.type === filterType;
                    });
                }
                pointSeries.data.setAll(filteredData.map(function(item) {
                    return {
                        geometry: {
                            type: "Point",
                            coordinates: [item.longitude, item.latitude]
                        },
                        title: item.title,
                        value: item.value,
                        type: item.type,
                        productColor: item.productColor
                    };
                }));
            }

            // Ends

            // Initial display (optional: show all pins initially or filter by default type)
            updateMap('Gasolio');
            // updateMap();

            // ====================================
            // Filter pins by type on button click - Starts
            // ====================================
            $('.js-map-filter').on('click', function() {
                var filterType = $(this).data('type');

                $('.js-map-filter').removeClass('is-active');
                $(this).addClass('is-active');

                if (filterType === 'all') {
                    updateMap();
                } else {
                    updateMap(filterType);
                }
            });

            // Ends


        }); // end am5.ready()
    </script>
@endsection
<!-- Scripts Ends -->
