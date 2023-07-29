@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('title', 'Terms Management')

@section('content')
<h4>Terms Management</h4>
@endsection
