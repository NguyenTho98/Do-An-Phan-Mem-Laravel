<!doctype html>
<html lang="en">
  <head>
    <title>Đăng ký</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">

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
            <h1 class="login-title">Đăng ký</h1>
            <form action="{{url('register')}}" method="post" id="form-register">
                {{ csrf_field() }}
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
                <label for="email">Name</label>
                <input type="text" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
              </div>
              <div class="form-group mb-4">
                <label for="password">Confirm Password</label>
                <input type="password" name="password_confirmation"  class="form-control">
              </div>
              <input name="register" class="btn btn-block login-btn" type="submit" value="Register">
            </form>
            <p class="login-wrapper-footer-text">Bạn đã có tài khoản? <a href="login" class="text-reset">Đăng nhập.</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="https://wall.vn/wp-content/uploads/2020/04/hinh-nen-game-dep-111.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
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
      $("#form-register").validate({
        rules: {
            name: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "{{ url('checkemailregister') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }
            },
            agree: {
                required: true
            }
        },
        messages: {
            email: {
                remote: "Email already exists"
            },
            agree: {
                required: "Please agree with terms of use"
            }
        }
    })

  </script>
</body>
</html>

