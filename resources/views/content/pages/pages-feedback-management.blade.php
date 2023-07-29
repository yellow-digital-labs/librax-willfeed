@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Feedback management')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/rateyo/rateyo.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/rateyo/rateyo.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-star-ratings.js')}}"></script>
<script src="{{asset('assets/js/custom/simple-search-datatable.js')}}"></script>
@endsection

@section('content')

<h4>Feedback management</h4>

<div class="card">
    <!-- <h5 class="card-header">Light Table head</h5> -->
    <div class="card-datatable">
        <table class="dt-column-search table has-actions-td">
            <thead class="text-nowrap">
                <tr>
                    <th>Name</th>
                    <th>Star Rating</th>
                    <th class="w-px-700">Feedback</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td>Lorem come here</td>
                    <td><div class="read-only-ratings" data-rateyo-read-only="true" data-rateyo-rating="4.5" data-rateyo-star-width="20px"></div></td>
                    <td class="w-px-500">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
