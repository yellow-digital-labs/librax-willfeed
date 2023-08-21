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
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);">
                            <div class="avatar avatar-online">
                                <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/81160511660785db8768a15358306893.jpg') }}" alt class="rounded-circle">
                            </div>
                        </a>
                    </li>
                    <!--/ User -->
                </ul>
            </div>

            @if(!isset($navbarDetached))
        </div>
        @endif
    </nav>
    <!-- / Navbar -->