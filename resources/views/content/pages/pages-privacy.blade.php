@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Privacy policy')


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
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css?ver=1')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/pages.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="support">
        <div class="uk-container support__container">
            <div class="uk-grid gutter-xl support__grid" data-uk-grid>
                <div class="uk-width-auto support__col support__col--sidebar">
                    @include('_partials/_front/_support-sidebar')
                </div>
                {!! $page->description !!}
                {{-- <div class="uk-width-expand support__col support__col--content">
                    
                    <h1 class="title title--xl support__maintitle">Privacy policy</h1>
                    <h2 class="support__maintext">Version: 4.7.00</h2>
                    <div class="support__text">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc non blandit massa enim nec dui nunc mattis. Amet volutpat consequat mauris nunc congue nisi vitae suscipit. Donec massa sapien faucibus et molestie ac feugiat sed. 
                        </p>
                        <p>
                            Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com.
                        </p>
                        <p>
                            Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                        </p>
                        <p>
                            Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com. Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                        </p>
                        <ul>
                            <li>
                                Et tortor consequat id porta. Aliquam ultrices sagittis orci a scelerisque. Aenean sed adipiscing diam. 
                            </li>
                            <li>
                                Donec adipiscing tristique risus nec feugiat. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget. 
                            </li>
                            <li>
                                Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet commodo. 
                            </li>
                            <li>
                                Bibendum neque egestas congue quisque egestas diam in arcu. Vestibulum mattis ullamcorper velit sed. 
                            </li>
                            <li>
                                Ullamcorper. Mauris cursus mattis molestie a iaculis at erat pellentesque. Dictum sit amet justo donec enim diam. 
                            </li>
                            <li>
                                Erat velit scelerisque in dictum non consectetur. Pulvinar mattis nunc sed blandit example@willfeed.com. 
                            </li>
                        </ul>
                        <p>
                            Feugiat pretium nibh ipsum consequat nisl. Viverra adipiscing at in tellus integer. Nisi vitae suscipit tellus mauris a diam maecenas. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet commodo nulla facilisi nullam. In est ante in nibh. Nulla malesuada pellentesque elit eget. Magna ac placerat vestibulum lectus mauris. Massa tincidunt dui ut ornare lectus. Tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Urna neque viverra justo nec ultrices dui sapien eget mi. Ut sem nulla pharetra diam sit amet nisl. Duis ut diam quam nulla porttitor massa id neque aliquam. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Dui faucibus in ornare quam. Vitae congue eu consequat ac felis donec et odio pellentesque. Ipsum suspendisse ultrices gravida dictum. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet.
                        </p>
                    </div>
                </div> --}}
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