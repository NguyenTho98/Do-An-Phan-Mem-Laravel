
@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý thể loại</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Thể loại</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Thể loại</span></li>
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <section class="card">
        <header class="card-header">
            <h2 class="card-title" style="float: left;">Thông tin thể loại</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <a href="{{ url('admin/categories') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="nav-item active">
                        <a class="nav-link" href="#overview" data-toggle="tab">Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#edit" data-toggle="tab">Cập nhật thông tin</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">

                        <div class="p-3">

                            <h4 class="mb-3">Các sản phẩm đang bán</h4>
                            <table class="table table-striped table-inverse" id="table-transaction">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ngày khởi tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category->products as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><a href="{{ url('admin/products/detail')."/".$item->id }}" style="color: #777;">{{ $item->name }}</a></td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>

                        </div>

                    </div>
                    <div id="edit" class="tab-pane">
                        <form class="p-3" id="form-update" method="post" action="{{url('admin/categories/update')}}">
                            <h4 class="mb-3">Thông tin thể loại</h4>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" name="id" class="form-control" value="{{ $category->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Thể loại 1">
                            </div>
                            <footer class="card-footer text-right">
                                <input type="submit" class="btn btn-primary submit-create-product" value = "Update"/>
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
<script>
    $(document).ready( function () {
        $('#table-transaction').DataTable({
            "order": [[ 2, "desc"]]
        });
    } );

    $("#form-update").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Tên thể loại không được để trống",
            },
        },
        highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		}
    })
</script>
@endsection
