@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý mã giảm giá</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Mã giảm giá</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Mã giảm giá</span></li>
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

        <h2 class="card-title">Thêm mới mã giảm giá</h2>
    </header>
    <div class="card-body">
        <section class="card">
            <div class="card-body">
                <form class="p-3" id="form-update" method="post" action="{{url('admin/coupons')}}">
                    <h4 class="mb-3">Thông tin mã giảm giá</h4>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="value">Giá trị</label>
                            <input type="number" class="form-control" name="value">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="qty">Số lượng</label>
                            <input type="text" class="form-control" id="qty" name="qty">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="value">Áp dụng cho đơn hàng</label>
                            <input type="number" class="form-control" name="coupon_price">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start">Ngày bắt đầu</label>
                            <input type="date" class="form-control" name="start">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="value">Ngày kết thúc</label>
                            <input type="date" class="form-control" name="end">
                        </div>
                    </div>

                    <footer class="card-footer text-right">
                        <input type="submit" class="btn btn-primary submit-create" value = "Add"/>
                    </footer>
                </form>
            </div>
        </section>

    </div>
</section>

</section>

@endsection

@section('content-script')
<script>

    $("#form-create").validate({
        rules: {
            name: {
                required: true
            },
            qty: {
                required: true
            },
            start: {
                required: true
            },
            end: {
                required: true
            },
            value: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Vui lòng điền tên!"
            },
            qty: {
                required: "Vui lòng điền số lượng!"
            }
            start: {
                required: "Vui lòng điền ngày bắt đầu có hiệu lực!"
            }
            end: {
                required: "Vui lòng điền ngày kết thúc hiệu lực!"
            }
            value: {
                required: "Vui lòng điền giá trị của mã!"
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
