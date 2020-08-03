@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Danh sách sản phẩm</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Sản phẩm</span></li>
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <section class="card">

        <header class="card-header">
            <h2 class="card-title" style="float: left;">Chi tiết sản phẩm</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <a href="{{ url('admin/products') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#edit" data-toggle="tab">Sửa thông tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#detail" data-toggle="tab">Thông tin nhập hàng</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <h2 class="name">{{ $product->name }}</h2>
                        <div class="p-3 row">

                            <div class="col-lg-6">
                                <img id="image_show" src="{{ asset($product->picture) }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </div>

                            <div class="col-lg-6">
                                <p>Thể loại: <span class="category">{{ $product->category->name }}</span></p>
                                <p>Số lượng: <span class="qty">{{ $product->qty }}</span></p>

                                <p>Giá bán: <span >{{ $product->price ? number_format($product->price)." "."đ" : "Chưa bán" }}</span></p>
                                <p>Giảm giá: <span >{{ $product->price && $product->price ? $product->sale."%" : "Chưa bán"  }}</span></p>
                            </div>

                        </div>
                        <div class="p-3 row info">

                        </div>

                    </div>
                    <div id="edit" class="tab-pane">
                        <form id="form-update-product" method="post" class="form-horizontal form-bordered p-3" enctype="multipart/form-data" action="{{url('admin/products/update')}}">
                            <div class="error">

                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" name="id" value="{{ $product->id }}" class="form-control" readonly>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Tên</label>
                                        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="formGroupExampleInput">Thể loại</label>
                                        <select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Chọn thể loại" }' name="category_id" id="category_id_edit" >
                                            <optgroup label="Categories">
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Picture</label>
                                        <img id="image" src="{{ asset($product->picture) }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        <input name="picture" id="picture_edit" type="file" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Thông tin</label>
                                <textarea name="info" id="info_edit" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 500, "codemirror": { "theme": "ambiance" } }'></textarea>
                            </div>
                            <div class="form-group"></div>
                            <footer class="card-footer text-right">
                                <input type="submit" class="btn btn-primary submit-create-product" value = "Update"/>
                            </footer>
                        </form>
                    </div>
                    <div id="detail" class="tab-pane">

                        <div class="p-3">

                            <h4 class="mb-3">Thông tin nhập hàng</h4>
                            <table class="table table-striped table-inverse" id="table-import">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nhà phân phối</th>
                                        <th>Giá nhập</th>
                                        <th>Số lượng key</th>
                                        <th>Ngày nhập</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->importproducts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->publisher->name }}</td>
                                            <td>{{ number_format($item->import_price)." đ" }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ url('admin/importproducts/detail')."/".$item->id }}" class="edit-row"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>

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
        $('#table-import').DataTable({
            "order": [[ 4, "desc"]]
        });
        let info = <?php echo json_encode($product->info); ?>;
        let category = <?php echo json_encode($product->category_id); ?>;
        $('.info').html(info);
        $('#info_edit').summernote('code', info);
        $('#category_id_edit').val(category).trigger('change');
    } );



</script>
@endsection
