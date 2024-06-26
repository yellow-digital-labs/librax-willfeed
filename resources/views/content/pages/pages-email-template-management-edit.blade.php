@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Aggiungi prodotto')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    let description = "";
    description = `{!!$template->html_template!!}`;
</script>
<script src="{{asset('assets/js/forms-editors.js?version=1')}}"></script>
<script src="{{asset('assets/js/email-template-form.js?version=1')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')
@error('msg')
  <div class="alert alert-danger" role="alert">
    <div class="alert-body">
      <div class="fw-bold">{{ __($message) }}</div>
    </div>
  </div>
@enderror
<h1 class="h3 text-black mb-4">Edit email template</h4>

<form method="POST" {{-- onsubmit="return false" --}} id="productAddForm">
@csrf
<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Edit {{$template->template}} template ({{$template->email_for}})</h5>
        </div>
    </div>
    <div class="card-body pt-4">
        <div class="row gy-1">
            <div class="col-8">

                <div class="mb-3">
                    <label class="form-label" for="Template">Template name</label>
                    <input type="text" class="form-control" id="Template" placeholder="Enter template name" name="template" value="{{$template->template}}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="Prodotto">Subject</label>
                    <input type="text" class="form-control" id="Prodotto" placeholder="Enter subject" name="subject" value="{{$template->subject}}">
                </div>
                <!-- Description -->
                <div  class="mb-3">
                    <label class="form-label">Email text</label>
                    <textarea name="html_template" style="display: none;" id="text_quill">{{$template->html_template}}</textarea>
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

            <div class="col-3">
                <div class="mb-3">
                    <strong>Available dynamic variables</strong>
                </div>
                @if(count($variables)>0)
                    @foreach($variables as $variable)
                <div class="mb-3">
                    @php
                        echo '{{'.$variable.'}}'
                    @endphp
                </div>
                    @endforeach
                @endif
            </div>
        </div>
        
    </div>
</div>

<div class="text-md-start text-center">
    <button class="btn btn-primary px-5 mt-4" type="submit"><span class="px-5">Save</span></button>
</div>
    

</form>

@endsection