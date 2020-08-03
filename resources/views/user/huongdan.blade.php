@extends('user.layout.index')


@section('content')
<div class="container">
   <div class="row" style="width: 70%;margin: auto;">
    <div style="margin-bottom:22px;">
        <strong><h4>Hướng dẫn mua hàng</h4></strong>
    </div>
    <p style="font-size: 20px">Bước 1:</p>
    <p>Ở giao diện trang chủ Shop, click vào Đăng kí</p>
    <div style="">
        <img src="{{ asset('public/upload/huongdan01.PNG') }}"  alt="" style="width: 650px;"/>
    </div>
    <p style="font-size: 20px">Bước 2:</p>
    <p>Điền đầy đủ các thông được yêu cầu:</p>
    <div style="">
        <img src="{{ asset('public/upload/huongdan02.PNG') }}" alt="" style="width: 500px;"/>
    </div>

    <p style="font-size: 20px">Bước 3:</p>
    <p>Như vậy là bạn đã đăng ký tài khoản thành công rồi đó:</p>
    <div style="">
        <img src="{{ asset('public/upload/huongdan03.PNG') }}" alt="" style=""/>
    </div>
   </div>

</div>

@endsection

@section('script')
<script>

</script>
@endsection
