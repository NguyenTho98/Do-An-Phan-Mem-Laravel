@extends('admin.layout.index')
@section('title')
    @yield('content-title')
@endsection
@section('body')
<section class="body">
    <!-- //header -->
    @include('admin.layout.header')
    <div class="inner-wrapper">
        <!-- //sidebar -->
        @include('admin.layout.sidebar')
        @yield('content-body')
    </div>
</section>
@endsection

@section('script')
    @yield('content-script')
@endsection
