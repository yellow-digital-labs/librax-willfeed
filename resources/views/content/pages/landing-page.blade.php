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
                <li>
                    <button type="button" class="mapwrapp__btn js-map-filter is-active" data-type="gasoline"><span
                            class="mapwrapp__btn-bar" style="background-color: #a3791f;"></span> Gasoline</button>
                </li>
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


            // ====================================
            // Create map
            // ====================================

            var map = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "none",
                    projection: am5map.geoNaturalEarth1()
                })
            );

            // Create polygon series
            var polygonSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_italyLow,
                    exclude: ["FR-H", "MT", "SM", "VA", ],
                    fill: '#f1f1f1',
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
                var radius = 32;
                var circle = container.children.push(am5.Circle.new(root, {
                    radius: radius,
                    fill: productColor,
                    dy: -radius * 2
                }));

                var pole = container.children.push(am5.Line.new(root, {
                    stroke: productColor,
                    height: -35,
                    strokeWidth: 1.5
                }));

                var label = container.children.push(am5.Label.new(root, {
                    text: value,
                    fill: '#fff',
                    fontWeight: "400",
                    centerX: am5.p50,
                    centerY: am5.p50,
                    dy: -radius * 2
                }))

                /*var titleLabel = container.children.push(am5.Label.new(root, {
                    text: dataItem.dataContext.title,
                    fill: '#fff',
                    fontWeight: "500",
                    fontSize: "1em",
                    centerY: am5.p50,
                    dy: -radius * 2,
                    dx: radius
                }))*/

                // Add tooltip text
                // container.set("tooltipText", dataItem.dataContext.title);

                // Add click event listener to the container
                container.events.on("click", function() {
                    alert(dataItem.dataContext.title + " clicked!");
                    // Perform other actions here, such as opening a modal or navigating to a URL
                });

                return am5.Bullet.new(root, {
                    sprite: container
                });
            });




            // ====================================
            // Create pins
            // ====================================

            var data = [{
                    "title": "Florence",
                    "latitude": 43.7799286,
                    "longitude": 11.158567,
                    "width": 100,
                    "height": 100,
                    "value": "1,29€/l",
                    "type": "gasoline",
                    "productColor": "#a3791f"
                },
                {
                    "title": "Rome",
                    "latitude": 41.9099533,
                    "longitude": 12.371189,
                    "width": 100,
                    "height": 100,
                    "value": "89€/l",
                    "type": "gasoline",
                    "productColor": "#a3791f"
                },
                {
                    "title": "Milan",
                    "latitude": 45.4627042,
                    "longitude": 9.0953315,
                    "width": 100,
                    "height": 100,
                    "value": "3,29€/l",
                    "type": "diesal",
                    "productColor": "green"
                }
            ];

            function showAll() {
                for (var i = 0; i < data.length; i++) {
                    var d = data[i];
                    pointSeries.data.push({
                        geometry: {
                            type: "Point",
                            coordinates: [d.longitude, d.latitude]
                        },
                        title: d.title,
                        value: d.value,
                        productColor: d.productColor
                    });
                }
            }

            // Function to update map with filtered data
            function updateMap(filterType) {
                var filteredData = data.filter(function(item) {
                    return item.type === filterType;
                });
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

            // Initial display (optional: show all pins initially or filter by default type)
            updateMap('gasoline');
            // showAll()

            // ====================================
            // Filter pins by type on button click
            // ====================================
            $('.js-map-filter').on('click', function() {
                var filterType = $(this).data('type');

                $('.js-map-filter').removeClass('is-active');
                $(this).addClass('is-active');

                if (filterType === 'all') {
                    showAll()
                } else {
                    updateMap(filterType);
                }
            });


        }); // end am5.ready()
    </script>
@endsection
<!-- Scripts Ends -->
