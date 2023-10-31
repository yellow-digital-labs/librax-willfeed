@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Terms & conditions')


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
<style>
#blog__media {
  width: 100%;
  height: 400px;
  background-image: url('{{Illuminate\Support\Facades\Storage::url($blog->blog_image)}}');
  background-size: cover;
}
</style>
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="support">
        <div class="uk-container support__container">
            <div class="uk-grid gutter-xl support__grid" data-uk-grid>
                <div class="uk-width-expand support__col support__col--content">
                    <h1 class="title title--xl support__maintitle">{{$blog->blog_name}}</h1>
                </div>
            </div>

            <div class="uk-grid gutter-xl support__grid" data-uk-grid>
                <div id="blog__media"></div>

                <div class="support__text">
                    {!! $blog->description !!}
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