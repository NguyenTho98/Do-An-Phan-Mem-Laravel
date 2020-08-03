@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý hóa đơn</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Hóa đơn</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Hóa đơn</span></li>
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <section class="card">
        <header class="card-header">
            <h2 class="card-title" style="float: left;">Thông tin đơn hàng</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <a href="{{ url('admin/orders') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#edit" data-toggle="tab">Chi tiết đơn hàng</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <h2 class="name">Đơn hàng số #{{ $order->id }}</h2>
                        <div class="p-3 row">

                            <div class="col-lg-6">
                                <p>Tên khách hàng: <span >{{ $order->customer->name }}</span></p>
                                <p>Mã giảm giá: <span >{{ $order->coupon_id ? get_coupon($coupons, $order->coupon_id)['name'] : "Không có" }}</span></p>

                                <p>Tổng đơn hàng: <span >{{ number_format($order->total)." đ" }}</span></p>
                            </div>

                        </div>

                    </div>
                    <div id="edit" class="tab-pane">
                        <table class="table table-striped table-inverse" id="table-transaction">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên game</th>
                                    <th>Key</th>
                                    <th>Giá bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderdetails as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ url('admin/products/detail')."/".$item->productkey->importproduct->product->id }}" style="color: #777;">{{ $item->productkey->importproduct->product->name }}</a></td>
                                        <td>{{ $item->productkey->key }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
<script type="text/javascript">
    $(document).ready( function () {
        $('#table-transaction').DataTable();
    } );

</script>
@endsection
