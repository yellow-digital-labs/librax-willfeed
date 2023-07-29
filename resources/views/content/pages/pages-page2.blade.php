@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('page-style')
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('title', 'Page 2')

@section('content')
<h4>Page 2</h4>
@endsection
