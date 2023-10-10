@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Email management')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/block-ui/block-ui.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-email.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-email.css')}}" />
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('content')

<h1 class="h3 text-black mb-4 d-flex justify-content-between">Email management <a href="{{route("email-management")}}" class="ti ti-rotate-clockwise rotate-180 scaleX-n1-rtl cursor-pointer email-refresh me-2 mt-1"></a></h1>
<div class="app-email card">
    <div class="row g-0">
        <!-- Emails List -->
        <div class="col app-emails-list">
            <div class="shadow-none border-0">
                <div class="emails-list-header p-3 py-lg-3 py-2">
                    {{-- <!-- Email List: Search -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center w-100">
                            <i class="ti ti-menu-2 ti-sm cursor-pointer d-block d-lg-none me-3" data-bs-toggle="sidebar" data-target="#app-email-sidebar" data-overlay></i>
                            <div class="mb-0 mb-lg-2 w-100">
                                <div class="input-group input-group-merge shadow-none">
                                    <span class="input-group-text border-0 ps-0" id="email-search">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control email-search-input border-0" placeholder="Search mail" aria-label="Search mail" aria-describedby="email-search">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-0 mb-md-2">
                            
                        </div>
                    </div>
                    <hr class="mx-n3 emails-list-header-hr"> 
                    --}}
                    <!-- Email List: Actions -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                        </div>
                        <div class="email-pagination d-flex align-items-center flex-wrap justify-content-end">
                            <span class="d-block mx-3 text-muted">Total {{count($email_history)}} email sent</span>
                            {{-- <i class="email-prev ti ti-chevron-left scaleX-n1-rtl cursor-pointer text-muted me-2"></i>
                            <i class="email-next ti ti-chevron-right scaleX-n1-rtl cursor-pointer"></i> --}}
                        </div>
                    </div>
                </div>
                <hr class="container-m-nx m-0">
                <!-- Email List: Items -->
                <div class="email-list pt-0">
                    <ul class="list-unstyled m-0">
                    @foreach($email_history as $_email_history)
                        <li class="email-list-item" data-starred="true" data-bs-toggle="sidebar" data-target="#app-email-view" data-id="{{$_email_history->id}}">
                            <div class="d-flex align-items-center email-list-body">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block flex-shrink-0 rounded-circle me-sm-3 me-2" height="32" width="32" />
                                <div class="email-list-item-content ms-2 ms-sm-0 me-2">
                                    <span class="h6 email-list-item-username me-2">{{$_email_history->to}}</span>
                                    <span class="email-list-item-subject d-xl-inline-block d-block"> {{$_email_history->subject}}</span>
                                </div>
                                <div class="email-list-item-meta ms-auto d-flex align-items-center">
                                    <small class="email-list-item-time text-muted">{{$_email_history->sent_at}}</small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="app-overlay"></div>
        </div>
        <!-- /Emails List -->
        <!-- Email View -->
        <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view">
            <div class="card shadow-none border-0 rounded-0 app-email-view-header p-3 py-md-3 py-2">
                <!-- Email View : Title  bar-->
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="d-flex align-items-center overflow-hidden">
                        <i class="ti ti-chevron-left ti-sm cursor-pointer me-2" data-bs-toggle="sidebar" data-target="#app-email-view"></i>
                        <h6 class="text-truncate mb-0 me-2" id="email-display-subject"></h6>
                    </div>
                    <!-- Email View : Action  bar-->
                </div>
                <hr class="app-email-view-hr mx-n3 mb-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        
                    </div>
                    <div class="d-flex align-items-center flex-wrap justify-content-end">
                        <span class="d-sm-block d-none mx-3 text-muted js-email-count"></span>
                        <i class="ti ti-chevron-left scaleX-n1-rtl cursor-pointer me-2 js-email-pre"></i>
                        <i class="ti ti-chevron-right scaleX-n1-rtl cursor-pointer js-email-next"></i>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <!-- Email View : Content-->
            <div class="app-email-view-content py-4">
                <!-- Email View : Last mail-->
                <div class="card email-card-last mx-sm-4 mx-3 mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center mb-sm-0 mb-3">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="flex-shrink-0 rounded-circle me-3" height="40" width="40" />
                            <div class="flex-grow-1 ms-1">
                                <h6 class="m-0 email-display-to" id="email-display-to"></h6>
                                <small class="text-muted" id="email-display-from"></small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0 me-3 text-muted" id="email-display-sent_at"></p>
                        </div>
                    </div>
                    <div class="card-body" id="email-display-html">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Email View -->
    </div>
    <!-- Compose Email -->
    <div class="app-email-compose modal" id="emailComposeSidebar" tabindex="-1" aria-labelledby="emailComposeSidebarLabel" aria-hidden="true">
        <div class="modal-dialog m-0 me-md-4 mb-4 modal-lg">
            <div class="modal-content p-0">
                <div class="modal-header py-3 bg-body">
                    <h5 class="modal-title fs-5">Compose Mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body flex-grow-1 pb-sm-0 p-4 py-2">
                    <form class="email-compose-form">
                        <div class="email-compose-to d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0" for="emailContacts">To:</label>
                            <div class="select2-primary border-0 shadow-none flex-grow-1 mx-2">
                                <select class="select2 select-email-contacts form-select" id="emailContacts" name="emailContacts" multiple>
                                    <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                    <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                    <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                    <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                    <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                    <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                </select>
                            </div>
                            <div class="email-compose-toggle-wrapper">
                                <a class="email-compose-toggle-cc" href="javascript:void(0);">Cc |</a>
                                <a class="email-compose-toggle-bcc" href="javascript:void(0);">Bcc</a>
                            </div>
                        </div>
                        <div class="email-compose-cc d-none">
                            <hr class="container-m-nx my-2">
                            <div class="d-flex align-items-center">
                                <label for="email-cc" class="form-label mb-0">Cc: </label>
                                <input type="text" class="form-control border-0 shadow-none flex-grow-1 mx-2" id="email-cc" placeholder="someone@email.com">
                            </div>
                        </div>
                        <div class="email-compose-bcc d-none">
                            <hr class="container-m-nx my-2">
                            <div class="d-flex align-items-center">
                                <label for="email-bcc" class="form-label mb-0">Bcc: </label>
                                <input type="text" class="form-control border-0 shadow-none flex-grow-1 mx-2" id="email-bcc" placeholder="someone@email.com">
                            </div>
                        </div>
                        <hr class="container-m-nx my-2">
                        <div class="email-compose-subject d-flex align-items-center mb-2">
                            <label for="email-subject" class="form-label mb-0">Subject:</label>
                            <input type="text" class="form-control border-0 shadow-none flex-grow-1 mx-2" id="email-subject" placeholder="Project Details">
                        </div>
                        <div class="email-compose-message container-m-nx">
                            <div class="d-flex justify-content-end">
                                <div class="email-editor-toolbar border-bottom-0 w-100">
                                    <span class="ql-formats me-0">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                    </span>
                                </div>
                            </div>
                            <div class="email-editor"></div>
                        </div>
                        <hr class="container-m-nx mt-0 mb-2">
                        <div class="email-compose-actions d-flex justify-content-between align-items-center mt-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="btn-group">
                                    <button type="reset" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-send ti-xs me-1"></i>Send</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="visually-hidden">Send Options</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Schedule send</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Save draft</a></li>
                                    </ul>
                                </div>
                                <label for="attach-file"><i class="ti ti-paperclip cursor-pointer ms-2"></i></label>
                                <input type="file" name="file-input" class="d-none" id="attach-file">
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="dropdownMoreActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMoreActions">
                                        <li><button type="button" class="dropdown-item">Add Label</button></li>
                                        <li><button type="button" class="dropdown-item">Plain text mode</button></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><button type="button" class="dropdown-item">Print</button></li>
                                        <li><button type="button" class="dropdown-item">Check Spelling</button></li>
                                    </ul>
                                </div>
                                <button type="reset" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-trash"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Compose Email -->
</div>
@endsection
