@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Lista prezzi personalizzati')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>

<script>
    $(document).ready(function(){
        let select2 = $('.select2');
        if (select2.length) {
            var $this = select2;
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Seleziona i clienti',
                dropdownParent: $this.parent()
            });
        }
    });
</script>
@endsection

@section('content')
@error('msg')
  <div class="alert alert-danger" role="alert">
    <div class="alert-body">
      <div class="fw-bold">{{ __($message) }}</div>
    </div>
  </div>
@enderror
<h1 class="h3 text-black mb-4">Lista prezzi personalizzati</h4>
<form id="productForm" method="POST">
    @csrf
    <div class="row align-items-start g-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between border-bottom">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 text-black">Nuova lista</h5>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-3 mb-2">
                        <div class="col-12">
                            <label class="form-label" for="customer_group_name">Nome lista</label>
                            <input type="text" id="customer_group_name" name="customer_group_name" placeholder="Inserisci il nome" class="form-control" value="{{$subscription?$subscription->customer_group_name:''}}" required/>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="customers">Clienti assegnati</label>
                            <select name="customers[]" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}" {{$customer_group?($customer->customer_group==$customer_group?'selected':''):''}}>{{$customer->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-5">
                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Salva</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection