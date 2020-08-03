<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Odah Shop
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li @if (Request::is('admin'))
                    class="nav-active"
                    @endif
                    >
                        <a class="nav-link" href="{{url('admin')}}">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Thống kê</span>
                        </a>
                    </li>
                    @if (Auth::guard('admin')->user()->can('view-user'))
                    <li class="nav-parent
                    @if (Request::is('admin/users') || Request::is('admin/users/add') || Request::is('admin/users/remove'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span>Nhân viên</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            @if (Request::is('admin/users'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/users')}}">
                                    Danh sách
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/users/add'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/users/add')}}">
                                    Thêm
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/users/remove'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/users/remove')}}">
                                    Nhân viên đã xóa
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-cateogory'))

                    <li class="nav-parent
                    @if (Request::is('admin/categories') || Request::is('admin/categories/add'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Thể loại</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            @if (Request::is('admin/categories'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/categories')}}">
                                    Danh sách
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/categories/add'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/categories/add')}}">
                                    Thêm
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-coupon'))

                    <li class="nav-parent
                    @if (Request::is('admin/coupons') || Request::is('admin/coupons/add'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Mã giảm giá</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            @if (Request::is('admin/coupons'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/coupons')}}">
                                    Danh sách
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/coupons/add'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/coupons/add')}}">
                                    Thêm
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-product'))

                    <li class="nav-parent
                    @if (Request::is('admin/products') || Request::is('admin/importproducts') || Request::is('admin/san-pham-dang-ban') || Request::is('admin/san-pham-khong-ban') || Request::is('admin/products/add') || Request::is('admin/products/remove') || Request::is('admin/importproducts/add'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fab fa-product-hunt" aria-hidden="true"></i>
                            <span>Sản phẩm</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            class="nav-parent
                            @if (Request::is('admin/products') || Request::is('admin/products/add') || Request::is('admin/products/remove'))
                            nav-active nav-expanded
                            @endif
                            ">
                                <a class="nav-link" href="#">
                                    Danh sách sản phẩm
                                </a>
                                <ul class="nav nav-children">
                                    <li
                                    @if (Request::is('admin/products'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/products')}}">
                                            Danh sách
                                        </a>
                                    </li>
                                    <li
                                    @if (Request::is('admin/products/add'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/products/add')}}">
                                            Thêm
                                        </a>
                                    </li>
                                    <li
                                    @if (Request::is('admin/products/remove'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/products/remove')}}">
                                            Sản phẩm đã xóa
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                            class="nav-parent
                            @if (Request::is('admin/importproducts') || Request::is('admin/importproducts/add'))
                            nav-active nav-expanded
                            @endif
                            ">
                                <a class="nav-link" href="#">
                                    Nhập sản phẩm
                                </a>
                                <ul class="nav nav-children">
                                    <li
                                    @if (Request::is('admin/importproducts'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/importproducts')}}">
                                            Danh sách
                                        </a>
                                    </li>
                                    <li
                                    @if (Request::is('admin/importproducts/add'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/importproducts/add')}}">
                                            Thêm
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                            class="nav-parent
                            @if (Request::is('admin/san-pham-dang-ban') || Request::is('admin/san-pham-khong-ban'))
                            nav-active nav-expanded
                            @endif
                            ">
                                <a class="nav-link" href="#">
                                    Bán sản phẩm
                                </a>
                                <ul class="nav nav-children">
                                    <li
                                    @if (Request::is('admin/san-pham-dang-ban'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/san-pham-dang-ban')}}">
                                            Sản phẩm đang bày bán
                                        </a>
                                    </li>
                                    <li
                                    @if (Request::is('admin/san-pham-khong-ban'))
                                    class="nav-active"
                                    @endif
                                    >
                                        <a class="nav-link" href="{{url('admin/san-pham-khong-ban')}}">
                                            Sản phẩm chưa bày bán
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-customer'))

                    <li class="nav-parent
                    @if (Request::is('admin/customers') || Request::is('admin/customers/add') || Request::is('admin/customers/remove'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Khách hàng</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            @if (Request::is('admin/customers'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/customers')}}">
                                    Danh sách khách hàng
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/customers/add'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/customers/add')}}">
                                    Thêm
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/customers/remove'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/customers/remove')}}">
                                    Khách hàng đã xóa
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-publisher'))

                    <li class="nav-parent
                    @if (Request::is('admin/publishers') || Request::is('admin/publishers/add') || Request::is('admin/publishers/remove'))
                    nav-expanded nav-active
                    @endif
                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Nhà cung cấp</span>
                        </a>
                        <ul class="nav nav-children">
                            <li
                            @if (Request::is('admin/publishers'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/publishers')}}">
                                    Danh sách
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/publishers/add'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/publishers/add')}}">
                                    Thêm
                                </a>
                            </li>
                            <li
                            @if (Request::is('admin/publishers/remove'))
                            class="nav-active"
                            @endif
                            >
                                <a class="nav-link" href="{{url('admin/publishers/remove')}}">
                                    Danh sách đã xóa
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-order'))

                    <li

                    @if (Request::is('admin/orders'))
                    class="nav-active"
                    @endif
                    >
                        <a class="nav-link" href="{{url('admin/orders')}}">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Hóa đơn</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-comment'))

                    <li
                    @if (Request::is('admin/comments'))
                    class="nav-active"
                    @endif
                    >
                        <a class="nav-link" href="{{url('admin/comments')}}">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Bình luận sản phẩm</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::guard('admin')->user()->can('view-feedback'))

                    <li
                    @if (Request::is('admin/feedbacks'))
                    class="nav-active"
                    @endif
                    >
                        <a class="nav-link" href="{{url('admin/feedbacks')}}">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Phản hồi</span>
                        </a>
                    </li>
                    @endif
                    <!-- <li>
                        <a class="nav-link" href="mailbox-folder.html">
                            <span class="float-right badge badge-primary">182</span>
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <span>Mailbox</span>
                        </a>
                    </li> -->
                    <!-- <li>
                        <a class="nav-link" href="http://themeforest.net/item/porto-responsive-html5-template/4106987?ref=Okler">
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                            <span>Front-End <em class="not-included">(Not Included)</em></span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fas fa-align-left" aria-hidden="true"></i>
                            <span>Menu Levels</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a>
                                    First Level
                                </a>
                            </li>
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    Second Level
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a>
                                            Second Level Link #1
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            Second Level Link #2
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a class="nav-link" href="#">
                                            Third Level
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a>
                                                    Third Level Link #1
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    Third Level Link #2
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                </ul>
            </nav>

            {{-- <hr class="separator" />

            <div class="sidebar-widget widget-tasks">
                <div class="widget-header">
                    <h6>Projects</h6>
                    <div class="widget-toggle">+</div>
                </div>
                <div class="widget-content">
                    <ul class="list-unstyled m-0">
                        <li><a href="#">Porto HTML5 Template</a></li>
                        <li><a href="#">Tucson Template</a></li>
                        <li><a href="#">Porto Admin</a></li>
                    </ul>
                </div>
            </div> --}}

            <!-- <hr class="separator" />

            <div class="sidebar-widget widget-stats">
                <div class="widget-header">
                    <h6>Company Stats</h6>
                    <div class="widget-toggle">+</div>
                </div>
                <div class="widget-content">
                    <ul>
                        <li>
                            <span class="stats-title">Stat 1</span>
                            <span class="stats-complete">85%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                                    <span class="sr-only">85% Complete</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="stats-title">Stat 2</span>
                            <span class="stats-complete">70%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                                    <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="stats-title">Stat 3</span>
                            <span class="stats-complete">2%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                    <span class="sr-only">2% Complete</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>


    </div>

</aside>
