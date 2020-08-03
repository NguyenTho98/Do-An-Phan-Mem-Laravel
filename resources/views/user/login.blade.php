<!doctype html>
<html lang="en">
  <head>
    <title>Đăng nhập</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/custom.css')}}">

    <link rel="stylesheet" href="{{asset('public/vendor/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/vendor/pnotify/pnotify.custom.css')}}" />
  </head>
  <body>
    <main>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 login-section-wrapper">
              <div class="login-wrapper my-auto">
                <h1 class="login-title">Đăng nhập</h1>
              <form action="{{url('login')}}" method="post" id="form-login">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                  <div class="form-group">
                    <label for="email">Đia chỉ Email</label>
                    <input type="email" name="email" class="form-control">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div>
                    <a href="{{url('/')}}" class="forgot-password-link" style="text-decoration: none">< Quay về trang chủ</a>
                    <a href="{{url('/recover-password')}}" class="forgot-password-link" style="text-decoration: none;float: right;">Quên mật khẩu ></a>
                  </div>

                  <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Đăng nhập" >
                </form>


                <p class="login-wrapper-footer-text">Bạn chưa có tài khoản?<a href="{{url('register')}}" class="text-reset1">Đăng ký!</a></p>
              </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
              <img src="https://wall.vn/wp-content/uploads/2020/04/hinh-nen-game-dep-111.jpg" alt="login image" class="login-img">
            </div>
          </div>
        </div>
      </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('public/vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('public/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
        <script src="{{asset('public/vendor/jquery-cookie/jquery-cookie.js')}}"></script>
        <!-- <script src="master/style-switcher/style.switcher.js"></script> -->
        <script src="{{asset('public/vendor/popper/umd/popper.min.js')}}"></script>
        <script src="{{asset('public/vendor/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('public/vendor/common/common.js')}}"></script>
        <script src="{{asset('public/vendor/nanoscroller/nanoscroller.js')}}"></script>
        <script src="{{asset('public/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
        <script src="{{asset('public/vendor/jquery-placeholder/jquery-placeholder.js')}}"></script>
        <script src="{{asset('public/vendor/jquery-validation/jquery.validate.js')}}"></script>
        <script src="{{asset('public/vendor/pnotify/pnotify.custom.js')}}"></script>
    <script type="text/javascript">
        function notification(type, title, text) {
            let notifi = new PNotify({
                styling: 'fontawesome',
                title: title,
                text: text,
                type: type,
                shadow: true,
                addclass: `stack-bottomright`,
                buttons: {
                    closer: false,
                    sticker: false
                }
            });
            notifi.get().click(function() {
                notifi.remove();
            });
            return notifi;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#form-login").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    email: {
                        required: true,
                        email: true
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
            });
            <?php
            if (session('success')) { ?>
                let text = <?php echo json_encode(session('success'));?>;
                notification('success', 'Thông báo', text);
            <?php } ?>

        });

    </script>
  </body>
</html>
