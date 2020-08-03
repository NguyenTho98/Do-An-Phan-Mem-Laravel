@extends('user.layout.index')


@section('content')
<div class="features_items">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb" style="opacity: 0.7; font-size:15px;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true" style="color: #7b7b7b; font-weight: 900;"></i></a></li>
                <li class="breadcrumb-item active">{{$product->name}}</li>
            </ol>
            <h1 style="font-size: 30px; display:inline-block; font-weight:bold; margin: 0;"> {{$product->name}}</h1>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-6">
                <img src="{{ asset('public/'.$product->picture) }}" alt="">
            </div>
            <div class="col-sm-6">
                <div class="sp-info">
                    <div class="sp-info-top">
                        <div class="sp-info-top-item col-md-4 col-xs-4 col-sm-4">
                            <div class="sp-info-top-item-icon"><img style="width: 20px;" src="{{ asset('public/upload/item-icon-1.png') }}"></div>
                            <div class="text-wrap">
                                <div class="text">Mã sản phẩm</div>
                                <div class="text-1">{{$product->id}} </div>
                            </div>
                        </div>
                        <div class="sp-info-top-item col-md-4 col-xs-4 col-sm-4">
                            <div class="sp-info-top-item-icon"><img style="width: 20px;" src="{{ asset('public/upload/item-icon-2.png') }}"></div>
                            <div class="text-wrap">
                                <div class="text">Tình trạng</div>
                                <span style="color:#53af2e; font-weight:bold;">{{ $product->qty > 0 ? "Còn hàng" : "Hết hàng" }}</span>
                            </div>

                        </div>
                        <div class="sp-info-top-item col-md-4 col-xs-4 col-sm-4">
                            <div class="sp-info-top-item-icon"><img style="width: 20px;" src="{{ asset('public/upload/item-icon-3.png') }}"></div>
                            <div class="text-wrap">
                                <div class="text">Link gốc</div>
                                <div class="text-1">Sản phẩm</div>
                            </div>
                        </div>
                    </div>
                    <div class="sp-price-text">Giá sản phẩm</div>
                    <div class="sp-price-old">{{$product->sale ? number_format($product->price).' '.'đ' : ""}}</div>
                    <div class="sp-price-new">
                        <div class="price">{{number_format($product->price*(100-$product->sale)/100).' '.'đ'}}</div>
                        <div class="price-info">
                        <span class="dis-p">{{ $product->sale ? "- ".$product->sale."%": "" }}</span>
                            <a style="padding-left: 15px;" alt="Thông báo cho tôi khi có giá tốt hơn" title="Thông báo cho tôi khi có giá tốt hơn"><i class="fa fa-bell" style="color: #928e8e" aria-hidden="true"></i><b style="color: #928e8e"> Chuông báo giảm giá</b></a>
                        </div>
                    </div>
                    <div id="product">
                        <hr>
                        <div class="row bar-info-product d-flex">
                            <div class="col-md-3 col-xs-12" style="padding: 0 0 10px 15px;">
                                <label>Số lượng:</label>
                                <br>
                                <div class="qty" style="display: -webkit-inline-box;">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"><i class="fa fa-minus" aria-hidden="true" style="color:#aaa4a4;"></i></button>
                                    <input class="quantity" min="0" size="2" name="quantity" value="1" type="number" style="color:#aaa4a4;">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"><i class="fa fa-plus" aria-hidden="true" style="color:#aaa4a4;"></i></button>
                                    <input type="hidden" name="product_id" value="1181">
                                </div>
                            </div>
                            <div class="col-md-9 col-xs-12 bar-buy-product">
                                <div id="button-cart-redirect" data-loading-text="Đang tải..." class="btn btn-green-bg col-md-5" style="margin-top: 12px;width: 144px" data-id={{ $product->id }}>Mua Ngay
                                </div>
                                @if ($product->qty > 0)
                                <a href="#" data-loading-text="Đang tải..." class="btn btn-orange-bg col-md-5 add-cart-orange" style="width: 144px" data-id={{ $product->id }}>
                                    <i class="fa fa-shopping-cart text-left"> </i>Thêm vào giỏ
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr style="border: 0.5px solid #aaa4a4;">
        <div class="row">
            <h1>Chi tiết sản phẩm</h1>
            <div class="info">

            </div>
        </div>
        <hr>
        <div class="row">
            <h1>Đánh giá sản phẩm</h1>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form action="{{ url('them-binh-luan') }}" method="post" class="form-horizontal" id="form-review">
                        {{ csrf_field() }}
                        <div class="col-md-1 col-sm-2 col-xs-2" style="padding: 0;text-align:center;">
                            <img src="https://hgeqic7azi.vcdn.com.vn/image/default.png" alt="" style="max-width:50px;border-radius: 50%;">
                        </div>

                        <div class="col-md-7 col-sm-8 col-xs-10" style="display: flex;">
                            <input type="text" name="comment" placeholder="Viết đánh giá" class="input-comment">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            @foreach ($comments as $item)
            <div class="row" style="margin-top: 23px">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="review-image-small">
                        <div class="avt avt-md">
                            <img src="https://hgeqic7azi.vcdn.com.vn/image/default.png" class="avt-img">
                        </div>
                    </div>
                    <div class="wrapper-content-rating">
                        <div class="review-content">
                            <p class="name-player-review hidden-over-name" style="font-weight: bold; font-size:15px;">{{ $item->customer->name }}</p>
                            <p class="time-player-review"><span>{{ $item->created_at }}</span></p>
                        </div>
                        <p class="content-player-review">{{ $item->content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $comments->links() }}
        </div>
    </div>
</div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        let info = <?php echo json_encode($product->info);?>;
        $('.info').html(info);
    })
    $(document).on('click','.add-cart-orange',function(){
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "{{ url('/add-gio-hang') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "_token": "{{ csrf_token() }}",
                'qty': $('.quantity').val(),
            },
            success: function(data) {
                if (data.success) {
                    $('.qty-cart').text(parseInt($('.qty-cart').text()) + parseInt($('.quantity').val()));
                    notification('success', 'Thông báo', data.success);
                }
                if (data.error) {
                    notification('danger', 'Thông báo', data.error);
                }
            }
        })

    })
    $(document).on('click','#button-cart-redirect',function(){
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "{{ url('/add-gio-hang') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "_token": "{{ csrf_token() }}",
                'qty': $('.quantity').val(),
            },
            success: function(data) {
                if (data.success) {
                    window.location.replace("{{ url('thong-tin-thanh-toan') }}");
                }

            }
        })

    })
</script>
@endsection
