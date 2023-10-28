@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Aggiungi blog')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/ckeditor5/build/ckeditor.js')}}"></script>
<script type="module">
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            removePlugins: ["Title"],
            extraAllowedContent: '*[*]{*}(*)',
            entities: false,
            basicEntities: false,
            forceSimpleAmpersand: true,
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            }
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

@section('page-script')
<script>
    let description = "";
    let isEdit = false;
    @if($isEdit)
    description = "{!!$product->description!!}";
    isEdit = true;
    @endif
</script>
<script src="{{asset('assets/js/admin-blog-add.js')}}"></script>
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
<h1 class="h3 text-black mb-4">Aggiungi blog</h4>

<form method="POST" {{-- onsubmit="return false" --}} enctype='multipart/form-data' id="productAddForm">
@csrf
<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Blog</h5>
        </div>
    </div>
    <div class="card-body pt-4">


        <div class="mb-3">
            <label class="form-label" for="Prodotto">Nome del blog</label>
            <input type="text" class="form-control" id="Prodotto" placeholder="Enter nome del blog" name="blog_name" value="{{$isEdit?$product->blog_name:''}}">
        </div>
        <!-- Description -->
        <div  class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="description" style="display: none;" id="editor">{{$isEdit?$product->description:""}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="blog_image">Image</label>
            <input type="file" class="form-control" id="blog_image" placeholder="Select image" name="blog_image">
            @if($isEdit)
            <img src="{{Illuminate\Support\Facades\Storage::url($product->blog_image)}}" class="mt-3" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="slug">Slug URL</label>
            <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" value="{{$isEdit?$product->slug:''}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="meta_title">Meta title</label>
            <input type="text" class="form-control" id="meta_title" placeholder="Enter meta title" name="meta_title" value="{{$isEdit?$product->meta_title:''}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="meta_keyword">Meta keywords</label>
            <input type="text" class="form-control" id="meta_keyword" placeholder="Enter meta keywords" name="meta_keyword" value="{{$isEdit?$product->meta_keyword:''}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="meta_description">Meta description</label>
            <textarea class="form-control" name="meta_description" placeholder="Enter description" id="meta_description" rows="4">{{$isEdit?$product->meta_description:''}}</textarea>
        </div>

        <div class="form-check form-switch mb-3">
            <label class="form-check-label" for="status">Disponibilità</label>
            <input class="form-check-input" type="checkbox" name="status" id="status" value="active" {{$isEdit?($product->status=='active'?'checked':''):'checked'}}>
        </div>
        
    </div>
</div>

<div class="text-md-start text-center">
    <button class="btn btn-primary px-5 mt-4" type="submit"><span class="px-5">Save</span></button>
</div>
    

</form>

@endsection