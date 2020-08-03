<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuce Shop</title>
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/vendor/pnotify/pnotify.custom.css') }}" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head><!--/head-->

<body>

    @include('user.layout.header')
    <div class="container">
        @include('user.layout.banner')
    </div>
    @yield('content')

    @include('user.layout.footer')
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/vendor/pnotify/pnotify.custom.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        var time_run_link = '5' * 1000;
        var timeout_handle = null;

        var myIndex = 0;
        carousel();

        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (x.length > 0) {
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
              myIndex = 1
            }
            x[myIndex - 1].style.display = "block";

            timeout_handle = setTimeout(carousel, time_run_link);

            $('.w3-content .mySlides').removeClass('animate-down');
            $('.w3-content .mySlides').addClass('animate-up');
          }
        }

        // Khi click nút chuyển slide trái thì thêm hiệu ứng chạy text từ phải sang trái
        $(".top-left").click(function (e) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (x.length > 0) {
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
            }
            myIndex--;
            if (myIndex < 0) {
              myIndex = x.length - 1;
            }
            x[myIndex].style.display = "block";

            $('.w3-content .mySlides').removeClass('animate-up');
            $('.w3-content .mySlides').addClass('animate-down');

            clearTimeout(timeout_handle);
            timeout_handle = setTimeout(carousel, time_run_link);
          }
        });

        // Khi click nút chuyển slide trái thì thêm hiệu ứng chạy text từ phải trái sang phải
        $(".top-right").click(function (e) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (x.length > 0) {
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
              myIndex = 1
            }
            x[myIndex - 1].style.display = "block";

            $('.w3-content .mySlides').removeClass('animate-down');
            $('.w3-content .mySlides').addClass('animate-up');

            clearTimeout(timeout_handle);
            timeout_handle = setTimeout(carousel, time_run_link);
          }
        });
        function notification(type, title, text) {
            let notifi = new PNotify({
                title: title,
                text: text,
                type: type,
                addclass: `stack-topright`,
                shadow: true,
                icon: false,
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
        let text;
        <?php
            if (session('success')) { ?>
                text = <?php echo json_encode(session('success'));?>;
                notification('success', 'Thông báo', text);
            <?php }
        ?>

        <?php
            if (session('error')) { ?>
                text = <?php echo json_encode(session('error'));?>;
                notification('danger', 'Thất bại', text);
            <?php }
        ?>
        <?php
            if ($errors->any()) {
                foreach ($errors->all() as $error) { ?>
                    text = <?php echo json_encode($error);?>;
                    notification('danger', 'Thất bại', text);
                <?php }
            }
        ?>
      </script>
    @yield('script')
</body>
</html>
