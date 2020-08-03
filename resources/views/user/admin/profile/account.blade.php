@extends('user.admin.profile')

@section('body-container')
    @php
        $user = Auth::guard('user')->user();
    @endphp
<div class="container-body-container tai-khoan">
    <h2>Thông tin cá nhân</h2>
    <hr>

    <div class="form-group">
        <label class="col-form-label">Email đăng nhập:</label>
        <div class="text info_detail">{{ $user->email }}</div>
        <input type="text" value="{{ $user->email }}" id="email" class="form-control info_edit edit" readonly>
        <input type="hidden" value="104942" id="address_id">
        <input type="hidden" value="145183" id="customer_id">
        <span class="span_info"><a id="btn_edit"><i class="fa fa-edit"></i>Cập Nhật</a></span>
    </div>

    <div class="form-group">
        <label class="col-form-label"> <span style="color: red" class="info_edit"> * </span> Họ và tên:</label>
        <div class="text info_detail">{{ $user->name ? $user->name : "(Chưa có thông tin)" }}</div>
        <input type="text" value="{{$user->name}}" id="name" class="form-control info_edit edit" placeholder="Nhập fullname">
    </div>

    <div class="form-group">
        <label class="col-form-label">Số điện thoại:</label>
        <span class="text info_detail">{{ $user->phone ? $user->phone : "(Chưa có thông tin)" }}</span>
        <input type="text" value="{{$user->phone}}" id="phone" class="form-control info_edit edit">
    </div>

    <div class="form-group">
        <label class="col-form-label">Địa chỉ:</label>
        <div class="text info_detail">{{ $user->address ? $user->address : "(Chưa có thông tin)" }}</div>
        <input type="text" value="{{$user->address}}" id="address" class="form-control info_edit edit">
    </div>

    <div class="btn-group btn_acction_edit">
        <div class="btn-aqua-bg" id="btn_update" data-id="{{$user->id}}">Cập nhật</div>
        <div class="btn-aqua" id="btn_back">Quay Lại</div>
    </div>
</div>
@endsection

@section('content-script')
<script>
    $(document).on('click','#btn_edit',function(){
        $('.info_detail').addClass('hidden');
        $('#btn_edit').addClass('hidden');
        $('.info_edit').removeClass('info_edit');
        $('.btn_acction_edit').removeClass('btn_acction_edit');
    })
    $(document).on('click','#btn_update',function(){
        $.ajax({
            type: "POST",
            url: "{{ url('/cap-nhat-tai-khoan') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                name: $('#name').val(),
                phone: $('#phone').val(),
                address: $('#address').val(),
            },
            success: function(data) {
                if (data.error) {
                    notification('danger', 'Thông báo', data.error);
                } else {
                    notification('success', 'Thông báo', data.success);
                }
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        })
    })
    $(document).on('click','#btn_back',function(){
        window.location.replace("{{ url('thong-tin-tai-khoan')}}");
    })
</script>
@endsection
