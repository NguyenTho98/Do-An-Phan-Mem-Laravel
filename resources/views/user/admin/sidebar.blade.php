<div class="container-body-side">
        <a class="side-item {{ Request::is('thong-tin-tai-khoan') ? "active" : "" }}" href="{{ url('thong-tin-tai-khoan')}}">
        <div class="side-item-icon fix-width-icon">
            <i class="fa fa-info fa-2x"></i>
        </div>
        <div class="side-item-title">
            <div><b>Thông tin tài khoản</b>
            </div>
            <div>Quản lí thông tin cá nhân</div>
        </div>
    </a>
    <a class="side-item {{ Request::is('lich-su-don-hang') ? "active" : "" }}" href="{{ url('lich-su-don-hang')}}">
        <div class="side-item-icon fix-width-icon">
            <i class="fa fa-shopping-cart fa-2x" style="color: #f4b844;"></i>
        </div>
        <div class="side-item-title">
            <div><b>Lịch sử đơn hàng</b>
            </div>
            <div>Thông tin sản phẩm đã mua</div>
        </div>
    </a>
    <a class="side-item {{ Request::is('lich-su-giao-dich') ? "active" : "" }}" href="{{ url('lich-su-giao-dich')}}">
        <div class="side-item-icon fix-width-icon">
            <i class="fa fa-usd fa-2x" style="color: #48a163;"></i>
        </div>
        <div class="side-item-title">
            <div><b>Lịch sử giao dịch</b>
            </div>
            <div>Thông tin thanh toán</div>
        </div>
    </a>
    <a class="side-item {{ Request::is('thay-doi-mat-khau') ? "active" : "" }}" href="{{ url('thay-doi-mat-khau')}}">
        <div class="side-item-icon fix-width-icon">
            <i class="fa fa-key fa-2x" style="color: #ad4025;"></i>
        </div>
        <div class="side-item-title">
            <div><b>Thay đổi mật khẩu</b>
            </div>
            <div>Cập nhật mật khẩu mới</div>
        </div>
    </a>
    <a class="side-item {{ Request::is('nap-tien') ? "active" : "" }}" href="{{ url('nap-tien')}}">
        <div class="side-item-icon fix-width-icon">
            <i class="fa fa-money fa-2x" style="color: #ad4025;"></i>
        </div>
        <div class="side-item-title">
            <div><b>Nạp tiền</b>
            </div>
            <div>Nạp tiền vào tài khoản</div>
        </div>
    </a>
    </div>
