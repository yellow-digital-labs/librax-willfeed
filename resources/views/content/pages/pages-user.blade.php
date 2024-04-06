{{-- @php
$configData = Helper::appClasses();
@endphp --}}
@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Customer')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>

@endsection

@section('page-script')
<script>
    var urlListCustomerData = {!! "'".$urlListCustomerData."'" !!};
</script>
<script src="{{asset('assets/js/approved-user-datatables.js')}}"></script>
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4">
@if($type=="buyer")
    Compratori
@elseif($type=="seller")
    Venditori
@endif
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between border-bottom">
        <div class="card-title mb-0">
            <h5 class="mb-0 text-black">
            @if($type=="buyer")
                Lista compratori
            @elseif($type=="seller")
                Lista Rivenditori
            @endif
            </h5>
        </div>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table">
            <thead>
                <tr>
                    <th class="js-add-search">
                    @if($type=="buyer")
                        Nome compratore
                    @elseif($type=="seller")
                        Nome Venditore
                    @endif
                    </th>
                    <th class="js-add-search">Email</th>
                    <th>Data Verificato</th>
                    <th>Data Iscrizione</th>
                    <th>data di scadenza</th>
                    <th>Verificato</th>
                    <th> Richiesta di aggiornamento </th>
                    <th>Abbonamento</th>
                    <th>Modifica</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection