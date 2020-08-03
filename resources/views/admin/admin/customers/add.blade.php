@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý khách hàng</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Khách hàng</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Khách hàng</span></li>
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

        <h2 class="card-title">Thêm mới khách hàng</h2>
    </header>
    <div class="card-body">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Form đăng ký</h2>
            </header>
            <div class="card-body">
                <form id="form-create-customer" method="post" action="{{url('admin/customers')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Odah2012">
                        </div>
                        <div class="form-group col-md-6 mb-3 mb-lg-0">
                            <label for="phone">SĐT</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="0977446532" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="vinh268461@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary modal-confirm-create">Submit</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</section>

</section>

@endsection

@section('content-script')
<script>

    $("#form-create-customer").validate({
        rules: {
            name: {
                required: true,
                minlength: 4
            },
            phone: {
                required: true
            },
            address: {
                required: true
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
            phone: {
                required: "Vui lòng điền số điện thoại!"
            },
            address: {
                required: "Vui lòng điền địa chỉ"
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
