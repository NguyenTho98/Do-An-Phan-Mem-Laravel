@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý bán sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sản phẩm đang bán</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Sản phẩm</span></li>
                <li><span>Sản phẩm đang bán</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->

    <section class="card">
        <header class="card-header">
            <div class="card-actions">
                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
            </div>

            <h2 class="card-title">Sản phẩm đang bày bán</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Thể loại</th>
                        <th>Giá bán</th>
                        <th>Giảm giá</th>
                        <th>Số lượng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @if ($product->price)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> <img src="{{ asset('public/'.$product->picture) }}" alt="" width="100" height="100"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->sale }}</td>
                            <td>{{ $product->qty }}</td>
                            <td class="actions">
                                <a href="#modalFormEdit" class="edit-row modal-with-form" data-id="{{ $product->id }}"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>




    <div id="modalFormEdit" class="modal-block modal-block-lg mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title" style="float: left;">Chi tiết sản phẩm</h2>
                <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
            </header>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs tabs-primary">
                        <li class="nav-item active">
                            <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#editprice" data-toggle="tab">Thông tin bán</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane active">
                            <h2 class="name"></h2>
                            <div class="p-3 row">

                                <div class="col-lg-6">
                                    <img id="image_show" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                </div>

                                <div class="col-lg-6">
                                    <p>Mã sản phẩm: <span class="code"></span></p>
                                    <p>Thể loại: <span class="category"></span></p>
                                    <p>Số lượng: <span class="qty"></span></p>
                                </div>

                            </div>
                            <div class="p-3 row info">

                            </div>

                        </div>
                        <div id="editprice" class="tab-pane">
                            <div class="p-3">
                                <h4 class="mb-3">Thông tin nhập hàng 5 lần gần nhất</h4>
                                <table class="table table-striped table-inverse" id="table-transaction">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nhà phân phối</th>
                                            <th>Giá nhập</th>
                                            <th>Ngày nhập</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                </table>

                            </div>
                            <div class="p-3">
                                <form id="form-sell-product" method="post" class="form-horizontal form-bordered p-3" action="{{url('admin/products/updateprice')}}">
                                    <p>Xóa trắng giá bán để đưa sản phẩm về kho.</p>
                                    <p>Cập nhật giá sẽ đưa sản phẩm lên cửa hàng.</p>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="id" id="id_sell" class="form-control">
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Giá bán</label>
                                                <input type="text" name="price" id="price_sell" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Khuyến mãi (%)</label>
                                                <input type="text" name="sale" id="sale_sell" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Giá bán trên web</label>
                                                <input type="text" id="sell_sell" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"></div>
                                    <footer class="card-footer text-right">
                                        <input type="submit" class="btn btn-primary" value = "Update"/>
                                    </footer>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $(document).ready( function () {
        $('#datatable-default').DataTable({});
        if ($('#price_sell').val() > 0) {
            if ($('#sale_sell').val()) {
                $('#sell_sell').val($('#price_sell').val() *(100 - $('#sale_sell').val()) / 100);
            } else {
                $('#sell_sell').val($('#price_sell').val());
            }
        }
        $('#price_sell').change(function(){
            if ($('#sale_sell').val()) {
                $('#sell_sell').val($('#price_sell').val() *(100 - $('#sale_sell').val()) / 100);
            } else {
                $('#sell_sell').val($('#price_sell').val());
            }

        })
        $('#sale_sell').change(function(){
            $('#sell_sell').val($('#price_sell').val() *(100 - $('#sale_sell').val()) / 100);
        })
    } );

    let table = $('#table-transaction').DataTable({
        paging: false,
        searching: false,
        pageLength: 5,
        data: [{
            'id': 0,
            'name': 0,
            'price': 0,
            'created_at': ''
        }],
        columns: [
            { data: 'id'},
            { data: 'name'},
            { data: 'price' },
            { data: 'created_at' }
        ]
    });

    $(document).on('click','.edit-row',function(){
        $.ajax({
            type: "GET",
            url: "{{ url('/admin/products/chi-tiet') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log(data);
                // tab overview
                $('.name').html(data.product.name);
                $('.category').html(data.product.category.name);
                $('.qty').html(data.product.qty);
                $('.info').html(data.product.info);
                $("#image_show").attr("src", "{{ URL::asset('public') }}"+"/"+ data.product.picture);
                // tab sell
                $('#id_sell').val(data.product.id);
                $('#import_price_sell').val(data.product.import_price);
                $('#price_sell').val(data.product.price);
                $('#sale_sell').val(data.product.sale);
                let detail = []
                data.importproducts.forEach(element => {
                    let item = {
                        'id': element.id,
                        'name': element.publisher.name,
                        'price': element.import_price,
                        'created_at': element.created_at
                    }
                    detail.push(item)
                });
                table.clear();
                table.rows.add( detail ).draw();
            }
        })

    })

</script>
@endsection
