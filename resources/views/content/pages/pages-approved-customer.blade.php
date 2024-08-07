@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Customer')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

@endsection

@section('page-script')
<script>
    var isSeller = "{{$isSeller}}";
    var urlListCustomerData = {!! "'".$urlListCustomerData."'" !!};
    var customer_groups = JSON.parse({!! "'".$customer_groups."'" !!});
</script>
<script src="{{asset('assets/js/approved-customer-datatables.js?version=3')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">
@if($isSeller)
    Clienti
@else
    Venditori
@endif
</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">
            Lista
            @if($isSeller)
                clienti
            @else
                venditori
            @endif
            </h5>
        </div>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th class="js-add-search">Compratori</th>
                    <th class="js-add-search">Venditori</th>
                    <th class="js-add-search">Luogo</th>
                    <th>Data verificato</th>
                    <th>Data iscrizione</th>
                    <th>Gruppo di clienti</th>
                    <th>Ammontare fido</th>
                    <th>Fido utilizzato</th>
                    <th>Fido disponibile</th>
                    <th>Verificato</th>
                    <th>Apri</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="creditLimitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" onsubmit="return false" id="credit-limit-form" data-recordid="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add credit limit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="credit_limit" class="form-label">Credit limit</label>
                            <input type="number" id="credit_limit" name="credit_limit" class="form-control" placeholder="Enter credit limit" lang="es-ES">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-seller-note" name="approve-customer">Approve customer</button>
                    <button type="submit" class="btn btn-primary" id="save-credit-limit" name="update-credit-limit">Update credit limit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection