<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row" style="padding-left: 0px;padding-right: 0px">
                <div class="col-sm-6">
                    <div class="slide-news">
                        <div class="w3-content w3-section">

                            <a class="top-left carousel-control" role="button">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="top-right carousel-control" role="button">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>


                            <div class="marquee-slide">
                                <a href="https://divineshop.vn/gia-han-spotify-premium-6m" class="mySlides animate-up" id="new-slide-0" style="display: block;">
                                    <i class="fab fa-hotjar"></i>Gia hạn Spotify Premium 12 tháng chỉ 120K
                                </a>
                                <a href="https://divineshop.vn/playerunknowns-battlegrounds" class="mySlides animate-up" id="new-slide-1" style="display: none;">
                                    <i class="fab fa-hotjar"></i>
                                    PUBG sale cực mạnh chỉ 169k
                                </a>
                                <a href="https://divineshop.vn/goi-gia-han-adobe-1-thang" class="mySlides animate-up" id="new-slide-2" style="display: none;">
                                    <i class="fab fa-hotjar"></i>
                                    Adobe Full App giá chỉ 289k/tháng
                                </a>
                            </div>
                        </div>
                      </div>

                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 0977 446 352</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> nuceshop@nuce.edu.vn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle" style="background-color:#4267B2;"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src="{{ asset('public/upload/logo.png') }}" style="height: 50px;width: 150px;"/></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form action="{{URL::to('/tim-kiem')}}" method="get">
                        <div class="search_box pull-right">
                            <input type="text" class="search" name="search" placeholder="Tìm kiếm sản phẩm"/>
                            <button type="submit" style="margin-top:0;" class="btn btn-primary btn-sm">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-3">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            @if (Auth::guard('user')->check())
                            <li>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @php
                                            $name = explode(" ", Auth::guard('user')->user()->name);
                                        @endphp
                                     <i class="fa fa-user"></i> {{ $name[0] }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="menu-login-head dropdown-item" >
                                            <b>SỐ DƯ TÀI KHOẢN</b>
                                            <br>
                                            <div class="menu-login-head-wallet">
                                                <div class="d-flex">
                                                    <i class="icon-wallet icon-wallet-login"></i>
                                                    <div class="balance">Số dư: {{ number_format(Auth::guard('user')->user()->money).' '.'đ' }} <i class="icon-coin-dollar" style="color:#000;"></i></div>
                                                </div>
                                            </div>
                                            <a href="{{ url('nap-tien') }}" class="btn btn_recharge">NẠP THÊM</a>
                                        </div>
                                        <a href="{{ url('lich-su-don-hang') }}" class="dropdown-item">
                                            <div class="drop-link-menu-login">
                                                Lịch sử mua hàng
                                            </div>
                                        </a>

                                        <a href="{{ url('thong-tin-tai-khoan') }}" class="dropdown-item">
                                        <div class="drop-link-menu-login">
                                            Thông tin tài khoản
                                        </div>
                                        </a>

                                        <a href="{{ url('/logout') }}" class="dropdown-item">
                                        <div class="menu-logout">
                                            Đăng xuất
                                        </div>
                                        </a>
                                    </div>
                                  </div>
                            </li>
                            @else
                            <li><a href="{{URL::to('/login')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            @endif
                            <li class="item-giohang"><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span class="qty-cart" style="background-color: #ffba27; padding: 2px 5px; color: #1c1c1c !important; border-radius: 3px; margin-right: 2px; font-weight: bold;">{{ Cart::instance(Auth::guard('user')->user())->count() }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->
