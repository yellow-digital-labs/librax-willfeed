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
<script>
    let description = "";
    @if($page)
    description = "{!!$page?$page->description:""!!}";
    @endif
</script>
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
            <a href="{{$staticPagePrivacyUrl}}" class="nav-link active">Privacy policy</a>
        </li>
        <li class="nav-item">
            <a href="{{$staticPageTermsUrl}}" class="nav-link">Terms & Conditions</a>
        </li>
    </ul>

    <div class="tab-content p-0 shadow-none m-0">
        <form method="POST" action="{{route("save-static-page")}}">
            @csrf
            <div class="tab-pane active show">
                <input type="hidden" name="slug" value="{{$page?$page->slug:$slug}}" />
                <div class="card mb-4">
                    <div class="card-header border-bottom">
                        <h4 class="text-black m-0">Privacy policy</h4>
                    </div>
                    <div class="card-body p-0 pb-1">
                        <div class="p-4 border-bottom">
                            <label class="form-label" for="title">Page Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter page title" name="page_name" value="{{$page?$page->page_name:''}}">
                        </div>
                        <!-- Description -->
                        <div>
                            <textarea name="description" style="display: none;" id="text_quill">{{$page?$page->description:""}}</textarea>
                            <div id="snow-toolbar" class="p-4 border-bottom">
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

                        <div class="p-4 border-top">
                            <label class="form-label" for="meta_title">Meta title</label>
                            <input type="text" class="form-control" id="meta_title" placeholder="Enter meta title" name="meta_title" value="{{$page?$page->meta_title:''}}">
                        </div>

                        <div class="p-4">
                            <label class="form-label" for="meta_keyword">Meta keywords</label>
                            <input type="text" class="form-control" id="meta_keyword" placeholder="Enter meta keywords" name="meta_keyword" value="{{$page?$page->meta_keyword:''}}">
                        </div>

                        <div class="p-4">
                            <label class="form-label" for="meta_description">Meta description</label>
                            <textarea class="form-control" name="meta_description" placeholder="Enter description" id="meta_description" rows="4">{{$page?$page->meta_description:''}}</textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary me-3 px-5">Submit</button>
            </div>
        </form>
    </div>

</div>

@endsection
