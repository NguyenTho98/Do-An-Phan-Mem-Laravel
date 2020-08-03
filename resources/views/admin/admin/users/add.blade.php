@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý nhân viên</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nhân viên</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Nhân viên</span></li>
                <li><span>Thêm mới</span></li>
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

            <h2 class="card-title">Thêm mới nhân viên</h2>
        </header>
        <div class="card-body">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Form đăng ký</h2>
                </header>
                <div class="card-body">
                    <form id="form-create-user" method="post" action="{{url('admin/users')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 control-label text-lg-right pt-2">Tên</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" placeholder="Odah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 control-label text-lg-right pt-2">Email</label>
                            <div class="col-lg-6">
                                <input type="email" name="email" class="form-control" placeholder="vinh268461@nuce.edu.vn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 control-label text-lg-right pt-2">Mật khẩu</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 control-label text-lg-right pt-2">Xác nhận mật khẩu</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary modal-confirm-create">Submit</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </section>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $(document).ready( function () {
        $('#datatable-default').DataTable({});
    } );

    $("#form-create-user").validate({
        rules: {
            name: {
                required: true,
                minlength: 4
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "Vui lòng điền tên!",
                minlength: "Tên bắt buộc phải lớn hơn 4 ký tự!"
            },
            password: {
                required: "Vui lòng điền mật khẩu!",
                minlength: "Mật khẩu bắt buộc phải lớn hơn 8 ký tự!"
            },
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp!"
            },
            email: {
                required: "Vui lòng điền email!",
                email: "Vui lòng điền đúng định dạng email!"
            }
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
