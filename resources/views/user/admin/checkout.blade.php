@extends('user.layout.index')


@section('content')

<div class="thanh-toan-container">
    <div class="container">
    <div class="border-cart-top">
        <ol class="breadcrumb" style="opacity: 0.7; font-size:15px;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true" style="color: #7b7b7b; font-weight: 900;"></i></a></li>
            <li class="breadcrumb-item active">Thanh toán</li>
        </ol>
        <h1 style="font-size: 30px; display:inline-block; font-weight:bold; margin: 0;"> Giỏ hàng <small style="font-size: 17px; font-weight: bold;">({{ Cart::instance(Auth::guard('user')->user())->count() }} sản phẩm) </small></h1>
        <div class="pull-right" style="margin-top: -10px;"><a href="{{ url('/') }}" class="btn btn-primary">Tiếp tục mua sản phẩm</a></div>
    </div>
    <hr>
    @if (Cart::instance(Auth::guard('user')->user())->count() == false)
        <h4>Giỏ hàng trống</h4>
    @else
        <div class="row cart-detail">
                @foreach ($cart as $item)
                <div class="col-md-12 item" style="margin-left: 30px;width: 95%;">
                    <div class="col-md-3">
                        <a href="{{ url('chi-tiet-san-pham/').'/'.$item->options->slug.'.'.$item->id }}" target="_blank">
                            <img src="{{ asset('public/'.$item->options->picture) }}" style="width: 100%;">
                        </a>
                    </div>
                    <div class="col-md-5">
                        <a href="{{ url('chi-tiet-san-pham/').'/'.$item->options->slug.'.'.$item->id }}" target="_blank" class="title">{{ $item->name }}</a>
                        <div class="item-id">Mã sản phẩm: #{{ $item->id}}</div>
                    </div>
                    <div class="col-md-2">
                        <span style="font-size: 14px;" class="price">Số lượng: {{$item->qty}}</span>
                    </div>
                    <div class="col-md-2 text-right">
                        <span style="font-size: 16px;margin-bottom: 5px;font-weight: bold;">{{ number_format($item->price * (100 - $item->options->sale) / 100).' '.'đ'}}</span><br>
                    </div>
                </div>
                @endforeach
                @php
                    unset($value);
                    unset($coupon_price);
                    unset($name);
                    $user_cart = Auth::guard('user')->user();
                    if (Cart::instance('coupon'.$user_cart->id)->count() > 0) {
                        foreach (Cart::instance('coupon'.$user_cart->id)->content() as $item) {
                            $name = $item->name;
                            $value = $item->options->value;
                            $coupon_price = $item->options->coupon_price;
                        }
                    }
                    $total = total_cart(Cart::instance($user_cart)->content());
                    if (isset($value) && isset($coupon_price)) {
                        if ($total >= $coupon_price) {
                            if ($value > 1000) {
                                $total = total_cart($cart)-$value;
                            }
                            if ($value <= 100) {
                                $total = total_cart($cart)-$value*total_cart($cart)/100;
                            }
                        }
                    }
                @endphp
        </div>
    <div class="mb15"></div>
    <div class="thanh-toan">
        <div class="row">
            <div class="col-md-12 col-xs-12 padd-0">
                <div class="col-md-6 col-xs-12 padd-0">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><strong>MÃ GIẢM GIÁ</strong></a></h4>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                            <input type="text" name="coupon" value="{{ $name ?? '' }}" placeholder="Nhập mã giảm giá..." id="input-coupon" class="form-control">
                        </div>
                    </div>
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
                                <span class="thanh-tien">{{ number_format(total_cart($cart)).' '.'đ' }}</span>
                                </div>
                            </div>
                                    <!-- Border Bottom Nét Đứt -->
                            <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-border-dash border-bottom-dash"></div>

                                    <!-- Tổng Tiền -->
                                <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                    <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                        <div class="h16-md-26 text-gray-900">TỔNG TIỀN</div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                        <div class="h16-bo-26 text-primary">
                                            {{ number_format($total).' '.'đ' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Border Bottom Nét Đứt -->
                                <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-border-dash border-bottom-dash"></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <span class="text-gray">Số dư hiện tại</span>
                                        </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                        <span class="thanh-tien">{{ $user_cart->money }} <i class="icon-coin-dollar" style="color:#000;"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-border-dash border-bottom-dash"></div>
                                    <!-- Số Tiền Cần Nạp Thêm -->
                                    @if ($user_cart->money < $total)
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <div class="h16-md-26 text-gray-900">SỐ TIỀN CẦN NẠP THÊM</div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                        <div class="h16-bo-26 text-primary">{{ $total - $user_cart->money}}<i class="icon-coin-dollar" style="color:#000;"></i></div>
                                        </div>
                                    </div>
                                    <a href="{{ url('nap-tien') }}">
                                        <button type="button" class="btn btn-danger col-md-12 col-sm-12 col-xs-12"><strong style="color:#fff;">Nạp Thêm Tiền</strong></button>
                                    </a>
                                    @else
                                    <div class="col-md-12 col-sm-12 col-xs-12 padd-0 margin-item">
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0">
                                            <div class="h16-md-26 text-gray-900">SỐ DƯ</div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 padd-0 text-right">
                                        <div class="h16-bo-26 text-primary">{{ $user_cart->money - $total}}<i class="icon-coin-dollar" style="color:#000;"></i></div>
                                        </div>
                                    </div>
                                    <a href="{{ url('thanh-toan')}}">
                                        <button type="button" class="btn btn-danger col-md-12 col-sm-12 col-xs-12"><strong style="color:#fff;">Thanh toán</strong></button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <hr>
    <div class="buttons clearfix">
        <div class="pull-left"><a href="{{ url('/') }}" class="btn btn-default">Tiếp tục mua hàng</a></div>

    </div>
    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection
