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

            <h2 class="card-title">Thêm mới nhà phân phối</h2>
        </header>
        <div class="card-body">
            <form class="form-horizontal form-bordered" action="{{url('admin/publishers')}}" id="form-new-publisher" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Tên</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Email</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">SĐT</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="phone">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Address</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="address">
                    </div>
                </div>

                <div class="form-group"></div>
                <footer class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" value = "Submit"/>
                    <button type="reset" class="btn btn-default">Reset</button>
                </footer>
            </form>


        </div>
    </section>


</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script type="text/javascript">

    $("#form-new-publisher").validate({
        rules: {
            name: {
                required: true,
                minlength: 4
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "{{ url('admin/publishers/checkemailcreate') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }
            },
            phone: {
                required: true,
            },
            address: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Vui lòng điền tên!",
                minlength: "Tên bắt buộc phải lớn hơn 4 kí tự!"
            },
            email: {
                required: "Vui lòng điền email!",
                email: "Vui lòng điền đúng định dạng email!",
                remote: "Email đã tồn tại!"
            },
            phone: {
                required: "Vui lòng điền số điện thoại!"
            },
            address: {
                required: "Vui lòng điền địa chỉ!"
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
