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
    @if($isEdit)
    description = "{!!$product->description!!}";
    @endif
</script>
<script src="{{asset('assets/js/forms-editors.js?version=1')}}"></script>
<script src="{{asset('assets/js/admin-product-add.js?version=1')}}"></script>
<script>
    $(document).ready(function(){
        let price_type_val = $("#price_type-selection").find("option:selected").val();
        updateDisplayField(price_type_val);

        $("#price_type-selection").on("change", function(){
            let price_type_val = $(this).find("option:selected").val();
            updateDisplayField(price_type_val, true);
        });

        function updateDisplayField(price_type_val, isUpdateVal = false){
            if(isUpdateVal){
                $("#today_price-container").find("input").val("");
            }
            if(price_type_val == "PLATTS") {
                $("#today_price-container").show();
                $("#today_price-container").find("input").attr("required", "true");
            } else {
                $("#today_price-container").hide();
                $("#today_price-container").find("input").removeAttr("required");
            }
        }
    });
</script>
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
<h1 class="h3 text-black mb-4">Aggiungi prodotto</h4>

<form method="POST" {{-- onsubmit="return false" --}} id="productAddForm">
@csrf
<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Scegli prodotto</h5>
        </div>
    </div>
    <div class="card-body pt-4">


        <div class="mb-3">
            <label class="form-label" for="Prodotto">Prodotto</label>
            <input type="text" class="form-control" id="Prodotto" placeholder="Enter product name" name="name" value="{{$isEdit?$product->name:''}}">
        </div>
        <!-- Description -->
        <div  class="mb-3">
            <label class="form-label">Descrizione</label>
            <textarea name="description" style="display: none;" id="text_quill">{{$isEdit?$product->description:""}}</textarea>
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

        <div class="mb-3">
            <label class="form-label" for="tax">IVA</label>
            <input type="number" class="form-control" id="tax" placeholder="Inserisci platts odierno" name="tax" value="{{$isEdit?$product->tax:'22'}}" step=".01" lang="es-ES">
        </div>

        <div class="mb-3">
            <label class="form-label" for="price_type">Tipo di prezzo</label>
            <select name="price_type" id="price_type-selection" class="form-select select2">
                <option value="PLATTS" {{$isEdit?($product->price_type == 'PLATTS' ? 'selected':''):''}}>Margine su Platts</option>
                <option value="NORMAL PRICING" {{$isEdit?($product->price_type == 'NORMAL PRICING' ? 'selected':''):''}}>Prezzo fisso</option>
            </select>
        </div>

        <div class="mb-3" id="today_price-container">
            <label class="form-label" for="today_price">Platts <i>({{date('d/m/Y')}})</i></label>
            <input type="number" class="form-control" id="today_price" placeholder="Inserisci platts odierno" name="today_price" value="{{$isEdit?$product->today_price:''}}" step=".00001" lang="es-ES" autocomplete="off">
        </div>

        <div class="form-check form-switch mb-3">
            <label class="form-check-label" for="status">Disponibilità</label>
            <input class="form-check-input" type="checkbox" name="active" id="status" value="active" {{$isEdit?($product->active=='yes'?'checked':''):'checked'}}>
        </div>
        
    </div>
</div>

<div class="text-md-start text-center">
    <button class="btn btn-primary px-5 mt-4" type="submit"><span class="px-5">Save</span></button>
</div>
    

</form>

@endsection