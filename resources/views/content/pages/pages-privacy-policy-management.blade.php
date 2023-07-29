@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('title', 'Privacy policy management')

@section('content')
<h4>Privacy policy management</h4>
@endsection
