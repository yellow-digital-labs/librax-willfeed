@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Unverified Users')

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
<h4>Unverified Users</h4>

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
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>Lorem come here</td>
                    <td>
                        <a href="/users-details" role="button" class="btn btn-sm btn-icon item-edit me-sm-2 me-1"> <i class="text-primary ti ti-pencil"> </i></a>
                        <button type="button" class="btn btn-sm btn-icon item-edit" data-bs-toggle="modal" data-bs-target="#RejectUser1"> <i class="text-danger ti ti-user-off"> </i> </button>
                        <!-- Reject User Modal -->
                        <div class="modal fade" id="RejectUser1" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Reject Document of - (user name)</h3>
                                            <p class="text-muted">After rejection, user can re-apply!</p>
                                        </div>
                                        <form id="editUserForm" class="row g-3" onsubmit="return false">
                                            <div class="col-12">
                                                <label class="form-label" for="modalEditUserFirstName">User's Name</label>
                                                <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="John" readonly />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="modalEditUserFirstName">Rejection Message</label>
                                                <textarea id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="Start writing here" rows="8"></textarea>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-2 me-1">Submit</button>
                                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Reject User Modal -->
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection