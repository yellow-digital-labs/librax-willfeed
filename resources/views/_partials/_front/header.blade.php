<header class="header" id="header">

    <div class="uk-container header__container">

        <a href="{{route("pages-home")}}" class="header__logo"><img src="{{asset('assets/front/images/weelfeed-brand-logo.svg')}}" class="header__logo-img" alt="Willfeed Brand Logo" height="39" width="99"></a>

        <div class="header__collapsible navmenu js-header-collapse" id="navmenu">
            <ul class="navmenu__list">
                <li class="navmenu__list-item">
                    <a href="{{route("pages-buyer-home")}}" class="navmenu__list-link">Acquista</a>
                </li>
                <li class="navmenu__list-item has-megamenu">
                    <a href="{{route("signup-seller")}}" class="navmenu__list-link">vendi</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="{{route("pages-buyer-home")}}" class="navmenu__list-link">Market</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="{{route("pages-aboutus")}}" class="navmenu__list-link">chi siamo</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="{{route("pages-contactus")}}" class="navmenu__list-link">contatti</a>
                </li>
            </ul>
            <div class="navmenu__left">
                <div class="navmenu-search">
                    <a href="{{route("pages-buyer-home")}}" class="uk-button navmenu-search__button">
                        <span class="wf-icon wf-icon-search"></span>
                    </a>
                    {{-- <div class="uk-dropdown uk-drop navmenu-search__dropdown" data-uk-dropdown="mode: click; pos: bottom-right">
                        <form class="navmenu-search__form">
                            <input type="search" name="" class="uk-input navmenu-search__input">
                            <button type="submit" class="uk-button uk-button-primary navmenu-search__form-button"><span class="wf-icon wf-icon-search"></span></button>
                        </form>
                    </div> --}}
                </div>
            @if(!Auth::user())
                <a href="{{route("login")}}" class="navmenu__left-link">Entra</a>
                <a href="{{route("register")}}" class="uk-button uk-button-light navmenu__left-link navmenu__left-link--button">Crea Account</a>
            @else
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);">
                                <div class="avatar avatar-online">
                                @if(Auth::user()->accountType == "0")
                                    <img src="{{ 'https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF' }}" alt class="rounded-circle">
                                @else
                                    <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/81160511660785db8768a15358306893.jpg') }}" alt class="rounded-circle">
                                @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end uk-drop uk-dropdown" data-uk-dropdown>
                                <li>
                                    <a class="dropdown-item" href="{{route("dashboard")}}">
                                        <i class="wf-icon wf-icon-analytics"></i>
                                        <span class="align-middle">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route("logout")}}">
                                        <i class="wf-icon wf-icon-signout"></i>
                                        <span class="align-middle">Esci</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            @endif
            </div>
        </div>

        <div class="header__toggler">
            <button type="button" class="header__toggler-btn js-header-toggler">
                <span class="header__toggler-icon"></span>
                <span class="header__toggler-text"><span class="sr-only">Menu</span></span>
            </button>
        </div>

    </div>

</header>