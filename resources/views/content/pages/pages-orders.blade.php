@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Orders')

@section('content')

<h4>Orders</h4>

<div class="card">
    <!-- <h5 class="card-header">Light Table head</h5> -->
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
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
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                          <i class="ti ti-arrow-right"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
