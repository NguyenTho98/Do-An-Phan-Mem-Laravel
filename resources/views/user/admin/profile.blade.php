@extends('user.layout.index')


@section('content')

<div class="container">
    <div class="container-header" style="top: 5px">
    <div class="img" style="background-image: url('{{ asset('upload/anh-bia.png')}}'); background-position: center center;
        background-size: cover; ">
        </div>
        <div class="account-title">
            <input type="file" id="avatar" style="display: none;">
            <div class="account-img">
            <div class="up-avatar" id="up-avatar" style="display: none;"></div>
                <img class="img-fit" id="avatar-profile" style="border-radius: 50%;" src="https://hgeqic7azi.vcdn.com.vn/image/default.png">
            </div>
            @php
                $user = Auth::guard('user')->user();
                $total = 0;
                foreach ($user->orders as $value) {
                    $total += $value->total;
                }
            @endphp
            <div class="account-name">
                <div class="full-name" style="text-transform: capitalize;">{{$user->name}}</div>
                <div class="account-balance">Số dư hiện tại: <span>{{ number_format($user->money)." "."đ" }}</span></div>
            </div>
        </div>
        <div class="account-info">
            <div class="account-info-item">Ngày đăng kí: <span>{{ date_format($user->created_at ,"d-m-Y") }}</span></div>
            <div class="account-info-item"><span>Member</span></div>
            <div class="account-info-item">Đã tích lũy: <span>{{ number_format($total)." "."đ" }}</span></div>
        </div>
    </div>
    <div class="container-body">
        @include('user.admin.sidebar')
        @yield('body-container')

      </div>
</div>

@endsection

@section('script')
@yield('content-script')
@endsection
