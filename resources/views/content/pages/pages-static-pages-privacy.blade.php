@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Static pages | Privacy policy')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/forms-editors.js')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Static pages</h4>

<div class="nav-align-left mb-4">
    <ul class="nav nav-pills me-3 col-sm-3 card-header-pills" role="tablist">
        <li class="nav-item">
            <a href="/static-pages-terms" class="nav-link">Terms & Conditions</a>
        </li>
        <li class="nav-item">
            <a href="/static-pages-privacy" class="nav-link active">Privacy policy</a>
        </li>
    </ul>

    <div class="tab-content p-0 shadow-none m-0">
        <div class="tab-pane active show">

            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h4 class="text-black m-0">Privacy policy</h4>
                </div>
                <div class="card-body p-0 pb-1">
                    <div class="p-4 border-bottom">
                        <label class="form-label" for="Prodotto">Prodotto</label>
                        <input type="text" class="form-control" id="Prodotto" placeholder="Enter product name" name="">
                    </div>
                    <!-- Description -->
                    <div>
                        <div id="snow-toolbar" class="p-4 border-0 border-bottom">
                            <span class="ql-formats me-0">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                            </span>
                        </div>
                        <div id="snow-editor" class="border-0">
                            
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-primary me-3 px-5">Submit</a>
            <a href="#" class="btn btn-outline-dark px-5">Cancel</a>
        </div>
    </div>

</div>

@endsection
