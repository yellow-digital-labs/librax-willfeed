<footer class="footer">

    <div class="footer-info">
        <h2 class="title footer-info__title">Assistenza & info</h2>
        <div class="footer-info__text">
            <p>Il nostro team e’ a tua completa disposizione. Offriamo un servizio di assistenza per rispondere a tutte le tue esigenze</p>
        </div>
        <div class="footer-info__call">
            <span class="wf-icon wf-icon-phone-call footer-info__icon"></span>
            <div class="footer-info__data">
                <h2 class="footer-info__name">7/7</h2>
                <a href="tel:+39 3334565118" class="footer-info__href">+39 3334565118</a>
            </div>
        </div>
    </div>

    <div class="foolter-upper">
        <div class="uk-container foolter-upper__container">
            <div class="uk-grid uk-flex-middle foolter-upper__grid" data-uk-grid>
                <div class="uk-width-1-2@s foolter-upper__col">
                    <div class="footer-logo">
                        <img src="{{asset('/assets/front/images/weelfeed-brand-logo.svg')}}" width= "170" height= "105">
                    </div>
                </div>
                <div class="uk-width-1-2@s foolter-upper__col">
                    <div class="uk-grid footer-contact" data-uk-grid>
                        <div class="uk-width-1-2@s footer-contact__col">
                            <div class="footer-contact__item">
                                <span class="wf-icon wf-icon-email footer-contact__icon"></span>
                                <div class="footer-contact__data">
                                    <h2 class="footer-contact__name">Mail Us</h2>
                                    <a href="mailto:info@willfeed.it" class="footer-contact__href">info@willfeed.it</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="foolter-upper__hr">
        </div>
    </div>
    <div class="footer-main">
        <div class="uk-container footer-main__container">
            <div class="uk-grid footer-main__grid" data-uk-grid>
                <div class="uk-width-1-4 footer-main__col footer-main__col--about">
                    <h2 class="title footer-main__title">About Us</h2>
                    <div class="footer-main__text">
                        <p>
                            WillFeed are responsible for manufacturing essential products such as plastics, fertilizers, synthetic fibers, and various other materials.
                        </p>
                    </div>
                    <div class="footer-social">
                        <a href="#" class="footer-social__link">
                            <span class="wf-icon wf-icon-facebook"></span>
                        </a>
                    </div>
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--links">
                    <h2 class="title footer-main__title">Links</h2>
                    <ul class="footer-links">
                        <li class="footer-links__item">
                            <a href="{{route("register")}}" class="footer-links__action">Sell</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="{{route("register")}}" class="footer-links__action">Buy</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="{{route("pages-buyer-home")}}" class="footer-links__action">Market</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="{{route('pages-aboutus')}}" class="footer-links__action">About Us</a>
                        </li>
                        <li class="footer-links__item">
                            <a href="{{route('pages-contactus')}}" class="footer-links__action">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--products">
                    <h2 class="title footer-main__title">Our Products</h2>
                    <ul class="footer-menu footer-menu--grid">
                        @php
                        $products = App\Helpers\Helpers::getNewTenProducts();
                        @endphp
                        @if($products)
                            @foreach($products as $product)
                            <li class="footer-menu__item">
                                <a href="{{route("pages-buyer-home", ["search" => $product->name])}}" class="footer-menu__link">{{$product->name}}</a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                    
                </div>
                <div class="uk-width-1-4 footer-main__col footer-main__col--support">
                    <h2 class="title footer-main__title">Support</h2>
                    <ul class="footer-menu">
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Support center</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="{{route("pages-privacy")}}" class="footer-menu__link">Privacy & policy</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="{{route("pages-terms")}}" class="footer-menu__link">Terms of use</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="{{route("pages-faqs")}}" class="footer-menu__link">FAQs</a>
                        </li>
                        <li class="footer-menu__item">
                            <a href="#" class="footer-menu__link">Help</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        Copyright © 2023 willFeed. All rights reserved.
    </div>
</footer>