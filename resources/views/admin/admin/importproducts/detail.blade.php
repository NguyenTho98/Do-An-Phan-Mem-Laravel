@extends('admin.layout.body')
@section('content-title')
    <title>Nhập sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nhập sản phẩm</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Sản phẩm</span></li>
                <li><span>Nhập sản phẩm</span></li>
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
            <a href="{{ url('admin/importproducts') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#detail" data-toggle="tab">Chi tiết key nhập</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <a href="{{ url('admin/products/detail')."/".$importproduct->product->id }}">
                            <h2 class="name">{{ $importproduct->product->name }}</h2>
                        </a>
                        <div class="p-3 row">
                            <div class="col-lg-6">
                                <img id="image_show" src="{{ asset($importproduct->product->picture)}}"class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                            </div>

                            <div class="col-lg-6">
                                <p>Thể loại: <span> <a href="{{ url('admin/categories/')."/".$importproduct->product->category_id }}">{{ $importproduct->product->category->name }}</a></span></p>
                                <p>Số lượng hiện tại: <span>{{ $importproduct->product->qty }}</span></p>
                                <p>Tổng số lượng key nhập: <span>{{ $importproduct->qty }}</span></p>
                                <p>Giá nhập: <span>{{ $importproduct->import_price }}</span></p>
                                <p>Ngày nhập: <span>{{ $importproduct->created_at }}</span></p>
                            </div>

                        </div>

                    </div>
                    <div id="detail" class="tab-pane">
                        <div class="p-3">

                            <h4 class="mb-3">Thông tin chi tiết phiên nhập hàng</h4>
                            <table class="table table-striped table-inverse" id="table-transaction">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Key</th>
                                        <th>Tình trạng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($importproduct->productkeys as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->key}}</td>
                                            <td>{{ $item->active ? "Đã bán" : "Chưa bán" }}</td>
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
        $('#table-transaction').DataTable({});
    } );
</script>
@endsection
