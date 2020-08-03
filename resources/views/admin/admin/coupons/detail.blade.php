
@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý mã giảm giá</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Mã giảm giá</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Mã giảm giá</span></li>
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <section class="card">
        <header class="card-header">
            <h2 class="card-title" style="float: left;">Thông tin mã giảm giá</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <a href="{{ url('admin/coupons') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <div class="p-3">
                            <h4 class="mb-3">Tổng quan</h4>
                            <p>Mã giảm giá: <span> {{ $coupon->name }}</span></p>
                            <p>Số lượng <span> {{ $coupon->qty }}</span></p>
                            <p>Giá trị giảm: <span> {{ $coupon->value <= 100 ? "-".$coupon->value." %" : "-".number_format($coupon->value). " đ"}}</span></p>
                            <p>Áp dụng cho đơn hàng: <span> > {{ $coupon->coupon_price }}</span></p>
                            <p>Hiệu lực từ ngày: <span> {{ $coupon->start }}</span></p>
                            <p>Đến ngày: <span> {{ $coupon->end }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $(document).ready( function () {
        $('#table-transaction').DataTable({
            "order": [[ 2, "desc"]]
        });
    } );

</script>
@endsection
