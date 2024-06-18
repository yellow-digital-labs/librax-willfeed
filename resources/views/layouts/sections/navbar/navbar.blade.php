@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp
<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
    @endif
    @if(isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
            @endif

            <!-- ! Not required for layout-without-menu -->

            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="wf-icon wf-icon-align-left"></i>
                </a>
            </div>

            <div class="main-logo">
                <a href="{{url('/')}}" class="main-logo__link">
                    <img src="{{asset('assets/img/weelfeed-brand-logo-white.svg')}}" width="170" height="93" class="img-fluid">
                </a>
            </div>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    @php
                        // $notifications = App\Models\SystemNotification::where(['user_id' => Auth::user()->id])->get();
                        $notifications = App\Models\SystemNotification::where([])->get();
                    @endphp
                    <!-- Notification -->
                    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="ti ti-bell ti-md"></i>
                        {{-- <span class="badge bg-danger rounded-pill badge-notifications">5</span> --}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end py-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                            {{-- <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                            </div> --}}
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                @foreach($notifications as $notification)
                                @php
                                    $href = '';
                                    if($notification->module == "App/Model/Order"){
                                        $href = route('order-details', [
                                            'id' => $notification->record_id
                                        ]);
                                    }
                                @endphp
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <a href="{{$href}}">
                                        <div class="d-flex">
                                            {{-- <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
                                                </div>
                                            </div> --}}
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{$notification->notification_title}}</h6>
                                                <p class="mb-0">{{$notification->notification_desc}}</p>
                                                <small class="text-muted">{{ $notification->created_at }}</small>
                                            </div>
                                            {{-- <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                                                <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span></a>
                                            </div> --}}
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- <li class="dropdown-menu-footer border-top">
                            <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                            View all notifications
                            </a>
                        </li> --}}
                        </ul>
                    </li>
                    <!--/ Notification -->
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="avatar avatar-online">
                            @if(Auth::user()->accountType == "0")
                                <img src="{{ 'https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF' }}" alt class="rounded-circle">
                            @else
                                <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/81160511660785db8768a15358306893.jpg') }}" alt class="rounded-circle">
                            @endif
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end py-0">
                            <li>
                                <a class="dropdown-item" href="{{route("logout")}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="wf-icon wf-icon-signout"></i>
                                    <span class="align-middle">Esci</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>

            @if(!isset($navbarDetached))
        </div>
        @endif
    </nav>
    <!-- / Navbar -->