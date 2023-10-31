@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Prodotti')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
<script>
    var urlListProductData = {!! "'".$urlListProductData."'" !!};
</script>
<script src="{{asset('assets/js/email-templates-list.js')}}"></script>
@endsection

@section('content')
        
<h1 class="h3 text-black mb-4">Email templates</h4>

<!-- Product List Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista email templates</h5>
    </div>
    <div class="card-datatable table-responsive">
        <table class="datatables-products table dt-column-search">
            <thead class="border-top">
                <tr>
                    <th>Template</th>
                    <th>Subject</th>
                    <th>Azione</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection