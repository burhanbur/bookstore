        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> perpustakaan@universitaspertamina.ac.id</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/universitaspertamina" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/UnivPertamina" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/universitaspertamina/" target="_blank"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.youtube.com/channel/UCwoZlTkQX9qfyabTfv6F0gg" target="_blank"><i class="fa fa-youtube"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{ asset('front/img/language_id.png') }}" alt="">
                                <div>Indonesia</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Indonesia</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                @if (Auth::check())
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="btn-logout"><i class="fa fa-sign-out"></i> Logout</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('front/img/logo_up2.png') }}" alt=""></a> <strong>UPer Press</strong>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="@if (Request::is('/') || Request::is('home*')) active @endif"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="@if (Request::is('shop*') || Request::is('product-detail*')) active @endif"><a href="{{ route('shop') }}">Produk</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li class="@if (Request::is('publication*')) active @endif"><a href="{{ route('publication') }}">Publikasi</a></li>
                            <li class="@if (Request::is('contact*')) active @endif"><a href="{{ route('contact') }}">Kontak</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a></li> -->
                            <!-- <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li> -->
                            <li>
                                <a href="{{ route('publication.create') }}" style="color: black;"><i class="fa fa-upload"></i> &nbsp; Unggah</a>
                            </li>
                        </ul>
                        <!-- <div class="header__cart__price">item: <span>Rp 0</span></div> -->
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>