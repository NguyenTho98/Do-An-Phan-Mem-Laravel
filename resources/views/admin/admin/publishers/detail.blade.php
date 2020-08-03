@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý nhà phân phối</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nhà phân phối</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Nhà phân phối</span></li>
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->

    <section class="card">
        <header class="card-header">
            <h2 class="card-title" style="float: left;">Chi tiết nhà phân phối</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#edit" data-toggle="tab">Sửa thông tin</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <div class="p-3 row">
                            <h4 class="mb-3">Lịch sử giao dịch</h4>
                            <table class="table table-striped table-inverse" id="table-transaction">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá nhập</th>
                                        <th>Số lượng</th>
                                        <th>Ngày nhập</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publisher->importproducts as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->import_price }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ url('admin/importproducts/detail')."/".$item->id }}"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>


                        </div>

                    </div>
                    <div id="edit" class="tab-pane">
                        <form id="form-update-publisher" method="post" class="form-horizontal form-bordered p-3" action="{{url('admin/publishers/update')}}">
                            <h4 class="mb-3">Thông tin nhà phân phối</h4>
                            <div class="error">

                            </div>
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" name="id" class="form-control" value="{{ $publisher->id }}" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" name="name" value="{{ $publisher->name }}" required="true" minlength=4>
                                </div>
                                <div class="form-group col-md-6 mb-3 mb-lg-0">
                                    <label for="phone">SĐT</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $publisher->phone }}" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $publisher->email }}" required="true">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{ $publisher->address }}" required="true">
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
    </section>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script type="text/javascript">
    $(document).ready( function () {
        $('#table-transaction').DataTable({});
    } );
</script>
@endsection
