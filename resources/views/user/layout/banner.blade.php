<div class="home-page banner-home common-menu-top" style="margin-bottom: 15px;">
    <div class="menu-2" style="margin-top: 0">
        <div class="container padd-0" style="margin-top: 6px;padding-left: 0px">
            <div class="menu-catalog">
                <div class="header-menu btn-group"  style="cursor: pointer;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="fa fa-bars"></i><span>  Danh mục sản phẩm</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right drop-category nav-menu" aria-labelledby="triggerId">
                        @foreach ($categories as $item)
                            <a class="dropdown-item" href="{{ url('tim-kiem?category=').$item->id }}">
                                <span>{{ $item->name }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </div>

                <div class="right-menu">
                    <div class="row menu-tab-all">
                        <div class="quick-menu head-link">
                            <a href="{{ url('tim-kiem/bestsellers') }}"><i class="fa fa-dollar"></i><span>Mua nhiều trong 24h</span></a>
                        </div>
                        <div class="quick-menu head-link">
                            <a href="{{ url('tim-kiem/sale') }}"><i class="fa fa-backward" aria-hidden="true"></i><span>ĐANG KHUYẾN MẠI</span></a>
                        </div>
                        <div class="quick-menu head-link">
                            <a href="{{ url('phan-hoi') }}"><i class="fa fa-credit-card"></i><span>Phản hồi</span></a>
                        </div>
                        <div class="quick-menu head-link">
                            <a href="{{ url('huong-dan-mua-hang') }}"><i class="fa fa-gamepad"></i><span>Hướng dẫn mua hàng</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
