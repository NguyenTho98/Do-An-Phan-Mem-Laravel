@extends('user.layout.index')


@section('content')
<section style="">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <div class="panel-group category-products" id="accordian">
                    @foreach($categories as $cate)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ url('tim-kiem?category=').$cate->id }}" style="padding: 10px; font-size:16px;">{{$cate->name}}</a></h4>
                            </div>
                        </div>
                    @endforeach
                    </div>

                </div>
            </div>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-8" style="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#slider-carousel" data-slide-to="1"></li>
                                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                                    <li data-target="#slider-carousel" data-slide-to="3"></li>
                                </ol>

                                <div class="carousel-inner">
                                    <div class="item active" style="">
                                            <img src="{{ asset('public/upload/3.png') }}" style="width: 100%;" class="img-responsive" alt="" />
                                    </div>
                                    <div class="item"  style="">
                                            <img src="{{ asset('public/upload/2.png') }}" style="width: 100%;" class="img-responsive" alt="" />
                                    </div>
                                    <div class="item" style="">
                                            <img src="{{ asset('public/upload/4.png') }}" style="width: 100%;" class="img-responsive" alt="" />
                                    </div>
                                    <div class="item" style="">
                                        <img src="{{ asset('public/upload/1.png') }}" style="width: 100%;" class="img-responsive" alt="" />
                                    </div>

                                </div>

                                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                    <i class="fa fa-angle-left" style="font-size: 25px"></i>
                                </a>
                                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                    <i class="fa fa-angle-right" style="font-size: 25px"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-4 image">
                    <img src="{{ asset('public/upload/anh1.jpg') }}" class="img-responsive " alt="" style=""/>
                    <img src="{{ asset('public/upload/anh2.png') }}" class="img-responsive" alt="" style=""/>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 image">
                    <img src="{{ asset('public/upload/anh3.png') }}" class="img-responsive" alt="" style=""/>
                </div>
                <div class="col-sm-4 image">
                    <img src="{{ asset('public/upload/anh4.png') }}" class="img-responsive" alt="" style=""/>
                </div>
                <div class="col-sm-4 image">
                    <img src="{{ asset('public/upload/anh5.png') }}" class="img-responsive" alt="" style=""/>
                </div>
            </div>
            </div>




        </div>
        <div class="row">
            <div class="col-sm-4 image">
                <img src="{{ asset('public/upload/anh6.png') }}" class="img-responsive" alt="" style="height: 180px;width: 100%;"/>
            </div>
            <div class="col-sm-4 image">
                <img src="{{ asset('public/upload/anh7.png') }}" class="img-responsive" alt="" style="height: 180px; width: 100%;"/>
            </div>
            <div class="col-sm-4 image">
                <img src="{{ asset('public/upload/anh8.png') }}" class="img-responsive" alt="" style="height: 180px; width: 100%;"/>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <hr>
</div>
<div class="features_items">
    <div class="container">

        <h2 style="font-size: 20px;margin-bottom: 20px">Sản phẩm nổi bật</h2>
        <div class="row">
            @foreach($product1 as $product)

            <div class="col-sm-3">
                <div class="card text-center">
                    <img src="{{ asset('public/'.$product->picture) }}" style="height:105px; width: 100%;" alt="" />
                    <div class="card-body">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug.'.'.$product->id)}}">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <div class="item-price">
                                @if ($product->sale == false)
                                    <span class="cur-p">{{number_format($product->price).' '.'đ'}}</span>
                                @else
                                    <span class="cur-p">{{number_format($product->price*(100-$product->sale)/100).' '.'đ'}}</span>
                                    <span class="price-block">
                                        <span class="old-p">{{number_format($product->price).' '.'đ'}}</span>
                                        <span class="dis-p">-{{$product->sale}}%</span>
                                    </span>
                                @endif
                            </div>
                        </a>
                        @if ($product->qty == 0)
                            <input type="button" value="Hết hàng" class="btn btn-default hethang">
                        @else
                        <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id="{{$product->id}}" name="add-to-cart">
                        @endif

                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<div class="features_items">
    <div class="container">
        @if (isset($product2) )
             <h2 style="font-size: 20px;;margin-bottom: 20px">Sản phẩm khuyến mãi</h2>
            <div class="row">

            @foreach($product2 as $product)
            <div class="col-sm-3">
                <div class="card text-center">
                    <img src="{{ asset('public/'.$product->picture) }}" style="height:105px; width: 100%;" alt="" />
                    <div class="card-body">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug.'.'.$product->id)}}">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <div class="item-price">
                                @if ($product->sale == false)
                                    <span class="cur-p">{{number_format($product->price).' '.'đ'}}</span>
                                @else
                                    <span class="cur-p">{{number_format($product->price*(100-$product->sale)/100).' '.'đ'}}</span>
                                    <span class="price-block">
                                        <span class="old-p">{{number_format($product->price).' '.'đ'}}</span>
                                        <span class="dis-p">-{{$product->sale}}%</span>
                                    </span>
                                @endif
                            </div>
                        </a>
                        @if ($product->qty == 0)
                        <input type="button" value="Hết hàng" class="btn btn-default hethang">
                        @else
                        <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id="{{$product->id}}" name="add-to-cart" >
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        @endif

    </div>
</div>

</section>

@endsection

@section('script')
<script>
    $(document).on('click','.add-to-cart',function(){
        let id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "{{ url('/add-gio-hang') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "_token": "{{ csrf_token() }}",
                'qty': 1
            },
            success: function(data) {
                if (data.success) {
                    $('.qty-cart').text(parseInt($('.qty-cart').text()) + 1);
                    notification('success', 'Thông báo', data.success);
                } else {
                    window.location.replace("{{ url('/login') }}");
                }
            }
        })
    })
</script>
@endsection
