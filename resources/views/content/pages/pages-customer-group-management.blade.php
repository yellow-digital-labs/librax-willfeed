@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Lista prezzi personalizzati')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    var urlListSubscribeData = {!! "'".$urlListSubscribeData."'" !!};
</script>
<script src="{{asset('assets/js/customer-group.js?version=1.1')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">Lista prezzi personalizzati</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom align-items-center">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">Elenco dei prezzi personalizzati</h5>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-record"><i class="ti ti-plus me-sm-1"></i> Aggiungi prezzo personalizzato</button>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th>Nome abbonamento</th>
                    <th>Stato</th>
                    <th>Azione</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="exampleModalLabel">Gruppo personalizzato</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form method="POST" class="add-new-record pt-0 row g-4" id="form-add-new-record">
            @csrf
            <input type="hidden" name="id" id="edit-id">
            <div class="col-sm-12">
                <label class="form-label" for="edit-customer_group_name">Nome del gruppo personalizzato</label>
                <input type="text" id="edit-customer_group_name" class="form-control" name="customer_group_name" placeholder="Enter nome del gruppo personalizzato" />
            </div>
            <div class="col-sm-12">
                <label class="form-label" for="edit-plan_for">Users</label>
                <select class="form-control" id="edit-plan_for" name="plan_for">
                    <option value="">Please select</option>
                    <option value="seller">Venditori</option>
                    <option value="buyer">Compratori</option>
                </select>
            </div>
            <div class="form-check form-switch col-sm-12">
                <label class="form-check-label" for="edit-status">Disponibilità</label>
                <input class="form-check-input" type="checkbox" name="status" id="edit-status" value="active">
            </div>
            <div class="col-sm-12 mt-5">
                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Salva</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Annulla</button>
            </div>
        </form>
    </div>
</div>

@endsection