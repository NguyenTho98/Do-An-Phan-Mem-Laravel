@extends('user.admin.profile')

@section('body-container')
    @php
        $user = Auth::guard('user')->user();
    @endphp

    <div class="container-body-container">
        <form action="{{ url('thay-doi-mat-khau')}}" method="post" id="form-change-password" class="form-horizontal">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <h2>Đổi mật khẩu tài khoản</h2>
            <hr>
            <div class="form-group">
                <label class="col-form-label" for="input-old-password">Xác nhận mật khẩu cũ:</label>
                <input type="password" name="old_password" placeholder="Mật khẩu cũ" id="input-old-password">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="input-password">Mật khẩu mới:</label>
                <input type="password" name="password" id="password" value="" placeholder="Mật khẩu mới" id="input-password">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="input-confirm">Xác nhận mật khẩu mới:</label>
                <input type="password" name="password_confirmation" value="" placeholder="Nhập lại mật khẩu mới" id="input-confirm">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn-aqua-bg">Cập nhật</button>
                <a href="{{ url('thong-tin/tai-khoan') }}" class="btn-aqua">Quay lại</a>
            </div>
        </form>
    </div>

@endsection

@section('content-script')
<script>
    $("#form-change-password").validate({
        rules: {
            old_password: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#password"
            },
        },
        messages: {
            old_password: {
                required: "Yêu cầu nhập mật khẩu cũ!",
            },
            password: {
                required: "Yêu cầu nhập mật khẩu mới!",
                minlength: "Yêu cầu mật khẩu mới dài hơn 8 kí tự!",
            },
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp!"
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
