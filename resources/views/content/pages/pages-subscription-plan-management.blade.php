@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Subscription Plan management')

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
<script src="{{asset('assets/js/custom/simple-search-datatable.js')}}"></script>
@endsection

@section('content')

<h4>Subscription Plan management</h4>

<div class="card">
    <!-- <h5 class="card-header">Light Table head</h5> -->
    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table has-actions-td">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Lorem Field</th>
                    <th>Lorem Field</th>
                    <th>Lorem Field</th>
                    <th>Lorem Field</th>
                    <th class="w-px-100">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td>Lorem come here 1</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Lorem come here 2</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Lorem come here 3</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Lorem come here 4</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Lorem come here 5</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
