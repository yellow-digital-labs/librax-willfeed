<header class="header" id="header">

    <div class="uk-container header__container">

        <a href="#" class="header__logo"><img src="{{asset('assets/front/images/weelfeed-brand-logo.svg')}}" class="header__logo-img" alt="Weelfeed Brand Logo" height="39" width="99"></a>

        <div class="header__collapsible navmenu js-header-collapse" id="navmenu">
            <ul class="navmenu__list">
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Acquista</a>
                </li>
                <li class="navmenu__list-item has-megamenu">
                    <a href="#" class="navmenu__list-link">vendi</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">Market</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">chi siamo</a>
                </li>
                <li class="navmenu__list-item">
                    <a href="#" class="navmenu__list-link">contatti</a>
                </li>
            </ul>
            <div class="navmenu__left">
                <div class="navmenu-search">
                    <button type="button" class="uk-button navmenu-search__button">
                        <span class="wf-icon wf-icon-search"></span>
                    </button>
                    <div class="uk-dropdown uk-drop navmenu-search__dropdown" data-uk-dropdown="mode: click; pos: bottom-right">
                        <form class="navmenu-search__form">
                            <input type="search" name="" class="uk-input navmenu-search__input">
                            <button type="submit" class="uk-button uk-button-primary"><span class="wf-icon wf-icon-search"></span></button>
                        </form>
                    </div>
                </div>
            @if(!Auth::user())
                <a href="/login" class="navmenu__left-link">Entra</a>
                <a href="/register" class="uk-button uk-button-light navmenu__left-link navmenu__left-link--button">Crea Account</a>
            @else
                <a href="/logout" class="navmenu__left-link">Esci</a>
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