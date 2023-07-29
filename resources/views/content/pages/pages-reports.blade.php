@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('title', 'Reports')

@section('content')
<h4>Reports</h4>
@endsection
