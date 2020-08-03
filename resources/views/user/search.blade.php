@extends('user.layout.index')


@section('content')
<div class="container">
    <div style="text-align:center;margin-bottom:22px;">
      <strong><h4>Tìm kiếm sản phẩm</h4></strong>
    </div>
    <form action="{{ url('tim-kiem') }}" method="get">
        <div class="search-header" id="content">
            <div class="row">
                <div class="col-lg-4 col-md-4 mb-15 col-filter-price">
                    <input type="text" name="search" value="" placeholder="Nhập từ khóa tìm kiếm..." class="form-control">
                </div>
                <div class="col-lg-2 col-md-2 mb-15 col-filter-price">
                    <select name="category" class="form-control">
                        <option value="">Tất cả danh mục</option>
                        @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 mb-15 col-filter-price">
                    <select name="sort" class="form-control">
                        <option value="">Sắp xếp</option>
                        <option value="name-asc">Từ A đến Z</option>
                        <option value="name-desc">Từ Z đến A</option>
                        <option value="price-asc">Giá tăng dần</option>
                        <option value="price-desc">Giá giảm dần</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group set-price">
            <label for="">Thiết lập giá tiền</label>

            <div class="range-slider">
                <input type="number" value="0" min="0" max="10000000" name="min_price"/>

                <div style="width: 100%;position: relative;margin: 10px 10px;">
                    <input value="0" min="0" max="10000000" step="500" type="range" class="min_range"/>
                    <input value="10000000" min="0" max="10000000" step="500" type="range" class="max_range"/>
                </div>
                <input type="number" value="10000000" min="0" max="10000000" name="max_price"/>
            </div>

            <button type="submit" class="btn btn-primary search-btn" type="button"><i class="fa fa-filter" aria-hidden="true"></i> Lọc</button>
        </div>
    </form>
    <div class="row" style="margin-top:25px;margin-bottom:50px;">
        @if ($products->count() == 0)
            <strong><h4>Sản phẩm thỏa điều kiện tìm kiếm (0 sản phẩm )</h4></strong>
        @else
        <div class="class" style="padding:20px;">
            <strong style="margin-bottom: 20px;"><h4>Sản phẩm thỏa điều kiện tìm kiếm ( {{$products->count()}} sản phẩm )</h4></strong>
        </div>
        @foreach($products as $product)
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
        @endif


    </div>
    @php
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $pagenumber = 1;
        if (strpos($actual_link, 'page') !== false) {
            $str = explode("=", $actual_link);
            $pagenumber = end($str);
            $actual_link = substr($actual_link,0 , -(6+strlen($pagenumber)));
        }
        $noi = "?";
        if (strpos($actual_link, '?') !== false) {
            $noi = "&";
        }
    @endphp
    <div class="list-sp">
        <div class="next-page" style="display:none;">1</div>
        @if ($products->count() == 0)
        <p class="text-center" style="color:red;font-weight:bold;min-height: 90px;">Không có sản phẩm thỏa điều kiện tìm kiếm.</p>
        @else
            @if ($products->lastPage() != 1)
            <nav>
                <ul class="pagination">
                    <li class="page-item @if ($pagenumber == 1)
                    disabled
                    @endif
                    " aria-disabled="true" aria-label="« Previous">
                        @if ($pagenumber == 1)
                            <span class="page-link" aria-hidden="true">‹</span>
                        @else
                            <a class="page-link" href="{{ $actual_link.$noi."page=". ((int)$pagenumber-1)}}" rel="prev" aria-label="Prev «">‹</a>
                        @endif

                    </li>

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        @if ($i == (int)$pagenumber)
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{$i}}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href=" {{ $actual_link.$noi."page=". $i}}">{{$i}}</a>
                        </li>
                        @endif
                    @endfor

                    <li class="page-item @if ($pagenumber == $products->lastPage())
                        disabled
                    @endif
                    " aria-disabled="true" aria-label="Next »">
                        @if ($pagenumber == $products->lastPage())
                            <span class="page-link" aria-hidden="true">›</span>
                        @else
                            <a class="page-link" href="{{ $actual_link.$noi."page=". ((int)$pagenumber+1)}}" rel="next" aria-label="Next »">›</a>
                        @endif

                    </li>
                </ul>
            </nav>
            @endif

        @endif
    </div>
  </div>
</section>

@endsection

@section('script')
<script>
(function() {

var parent = document.querySelector(".range-slider");
if(!parent) return;

var
  rangeS = parent.querySelectorAll("input[type=range]"),
  numberS = parent.querySelectorAll("input[type=number]");

rangeS.forEach(function(el) {
  el.oninput = function() {
    var slide1 = parseFloat(rangeS[0].value),
          slide2 = parseFloat(rangeS[1].value);

    if (slide1 > slide2) {
              [slide1, slide2] = [slide2, slide1];
    }

    numberS[0].value = slide1;
    numberS[1].value = slide2;
  }
});

numberS.forEach(function(el) {
  el.oninput = function() {
          var number1 = parseFloat(numberS[0].value),
                  number2 = parseFloat(numberS[1].value);

    if (number1 > number2) {
      var tmp = number1;
      numberS[0].value = number2;
      numberS[1].value = tmp;
    }

    rangeS[0].value = number1;
    rangeS[1].value = number2;

  }
});

})();

(function() {
    var pathname = window.location.href;
    if (!pathname.includes("bestsellers") && !pathname.includes("sale")) {
        var path = pathname.split('?');
        var path2 = path[1].split('&');
        for (let index = 0; index < path2.length; index++) {
            const element = path2[index];
            search = element.split('=');
            if(search[0] == "search") {
                $( "input[name='search']" ).val(search[1]);
            }
            if (search[0] == "min_price") {
                $( "input[name='min_price']" ).val(search[1]);
                $( ".min_range" ).val(search[1]);
            }
            if (search[0] == "max_price") {
                $( "input[name='max_price']" ).val(search[1]);
                $( ".max_range" ).val(search[1]);
            }
            if(search[0] == "category") {
                $( "select[name='category']" ).val(search[1]);
            }
            if(search[0] == "sort") {
                $( "select[name='sort']" ).val(search[1]);
            }
        }
    }
})();
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
