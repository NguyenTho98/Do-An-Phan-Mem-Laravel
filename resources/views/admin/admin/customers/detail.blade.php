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
                <li><span>Chi tiết</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->
    <section class="card">
        <header class="card-header">
            <h2 class="card-title" style="float: left;">Thông tin khách hàng</h2>
            <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
        </header>
        <div class="card-body">
            <a href="{{ url('admin/customers') }}" style="text-decoration: underline; color: #000; font-size:15px;">Quay lại</a>
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

                            <h4 class="mb-3">Lịch sử giao dịch</h4>
                            <table class="table table-striped table-inverse" id="table-transaction">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Ngày</th>
                                        <th>Giao dịch</th>
                                        <th>Tổng giao dịch</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history as $item)
                                        <tr>
                                            <td>{{ $item['created_at'] }}</td>
                                            <td>{{ $item['des'] }}</td>
                                            <td>{{ $item['total'] }}</td>
                                            <td><a href="{{ url($item['link']) }}" class="btn btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>

                        </div>

                    </div>
                    <div id="edit" class="tab-pane">
                        <form class="p-3" id="form-update-customer" method="post" action="{{url('admin/customers/update')}}">
                            <h4 class="mb-3">Thông tin cá nhân</h4>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="name">ID</label>
                                <input type="text" name="id" class="form-control" value="{{ $customer->id }}" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control" name="name" value="{{ $customer->name }}" placeholder="Odah" required="true" minlength="4">
                                </div>
                                <div class="form-group col-md-6 mb-3 mb-lg-0">
                                    <label for="phone">SĐT</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="0977446532" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $customer->email }}" placeholder="vinh268461@gmail.com" required="true" email="true">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{ $customer->address }}" placeholder="Apartment, studio, or floor" required="true">
                            </div>

                            <hr class="dotted tall">

                            <h4 class="mb-3">Đổi mật khẩu</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary modal-confirm-update">Save</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

@endsection

@section('content-script')
<script>
    $(document).ready(function(){
        $('#table-transaction').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
    $("#form-update-customer").validate({
        rules: {
            password_confirmation: {
                equalTo: "#password"
            }
        },
        messages: {
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp!",
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
