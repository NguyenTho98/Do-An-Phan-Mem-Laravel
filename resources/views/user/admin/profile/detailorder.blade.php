@extends('user.admin.profile')

@section('body-container')
    @php
        $user = Auth::guard('user')->user();
        $totaldetail = 0;
        foreach ($detail as $value) {
            $totaldetail += $value->price;
        }
    @endphp
<div class="container-body-container">
    <div class="row cart-detail">
        @foreach ($detail as $item)
        <div class="col-md-12 hidden-sm hidden-xs item">
            @php
                $product = $item->productkey->importproduct->product;
            @endphp
            <div class="col-md-2">
                <a href="{{ url('chi-tiet-san-pham/').'/'.$product->slug.'.'.$product->id }}" target="_blank">
                    <img src="{{ asset('public/'.$product->picture) }}" style="width: 100%;">
                </a>
            </div>
            <div class="col-md-5">
                <a href="{{url('/chi-tiet-san-pham/'.$product->slug.'.'.$product->id)}}" target="_blank" class="title">{{$product->name}}</a>
                <div class="key-game">
                <div><strong>Key Game</strong></div>
                <div style="margin-top: 5px;cursor: copy;"><span class="copy-key"><i class="fa fa-caret-right" aria-hidden="true" style="max-width: 8px"></i>{{$item->productkey->key}}</span></div>
                </div>
            </div>
            <div class="col-md-3 text-right">
                <div style="font-size: 16px;margin-bottom: 5px;font-weight: bold;margin-bottom:10px;">{{ number_format($item->price)." "."đ"}}</div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="mb15"></div>
    <div class="thanh-toan">
        <div class="row">
            <div class="col-md-12 col-xs-12 padd-0">
                <div class="col-md-6 col-xs-12 padd-0">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><strong>THÔNG TIN ĐƠN HÀNG</strong></a></h4>
                            </div>
                            @php
                                $order = $detail[0]->order;
                            @endphp
                            <div class="panel-body">
                                Mã đơn hàng: <strong>#{{$order->id}}</strong><br>
                                Ngày tạo: {{ date_format($order->created_at, "d-m-Y") }}<br>
                                Email nhận key : {{$order->customer->email}}<br>
                                Tình trạng đơn hàng: <span style="color:green;">Đã xử lý</span>                                                                                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 padd-0">
                    <div class="order-total">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="border-color: transparent;">
                                <h4 class="panel-title"><strong>THÔNG TIN THANH TOÁN</strong></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <!-- Thành Tiền -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <span class="text-gray">Thành tiền sản phẩm</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                            <span class="thanh-tien">{{number_format($totaldetail)." "."đ"}}</span>
                                        </div>
                                    </div>
                                    <!-- Mã Giảm Giá -->
                                    @if ($order->coupon_id)
                                            @php
                                                $magiam = get_coupon($coupons, $order->coupon_id);
                                            @endphp
                                        <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                            <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                                <span class="text-gray">Mã giảm giá</span>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                                <span class="tag-giam-gia">{{ $magiam['name'] }}</span>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right padd-0">
                                                <span class="thanh-tien">-{{ number_format($totaldetail - $order->total)." "."đ" }}</span>
                                            </div>
                                        </div>
                                    @endif



                                    <!-- Border Bottom Nét Đứt -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-border-dash border-bottom-dash"></div>

                                    <!-- Tổng Tiền -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <div class="h16-md-26 text-gray-900">TỔNG TIỀN</div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                            <div class="h16-bo-26 text-primary"></div>
                                        </div>
                                    </div>

                                    <!-- Border Bottom Nét Đứt -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-border-dash border-bottom-dash"></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <span class="text-gray">Số tiền khi thanh toán</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                            <span class="thanh-tien">{{number_format($order->total)." "."đ"}}<i class="icon-coin-dollar" style="color:#000;"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Về trang lịch sử đơn hàng -->
    <hr>
    <a href="{{ url('lich-su-don-hang') }}" style="color: #279cff; cursor: pointer;font-weight:bold;">&lt;&lt; Về lịch sử đơn hàng</a>
</div>
@endsection

@section('content-script')
<script>

</script>
@endsection
