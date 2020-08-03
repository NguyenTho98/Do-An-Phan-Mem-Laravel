@extends('admin.layout.index')
@section('title')
    <title>Error 403</title>
@endsection
@section('body')
<section class="body">
    <!-- //header -->
    @include('admin.layout.header')
    <div class="inner-wrapper">
        <!-- //sidebar -->
        <section role="main">

            <!-- start: page -->
                <section class="body-error error-inside">
                    <div class="center-error">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="main-error mb-3">
                                    <h2 class="error-code text-dark text-center font-weight-semibold m-0">403 <i class="fas fa-file"></i></h2>
                                    <p class="error-explanation text-center">We're sorry, but the page you were looking for doesn't exist.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

    </div>
</section>
@endsection

@section('script')
    @yield('content-script')
@endsection
