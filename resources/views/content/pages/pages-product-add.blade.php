@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Aggiungi prodotto')

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

<h1 class="h3 text-black mb-4">Aggiungi prodotto</h4>


<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Scegli prodotto</h5>
        </div>
    </div>
    <div class="card-body pt-4">


        <div class="mb-3">
            <label class="form-label" for="Prodotto">Prodotto</label>
            <input type="text" class="form-control" id="Prodotto" placeholder="Enter product name" name="">
        </div>
        <!-- Description -->
        <div>
            <label class="form-label">Descrizione</label>
            <div id="snow-toolbar">
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
            <div id="snow-editor">
                
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary px-5 mt-4" type="submit"><span class="px-5">Save</span></button>

@endsection