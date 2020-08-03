<!doctype html>
<html class="fixed">

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.1.1/pages-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Feb 2019 11:37:06 GMT -->
<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        @yield('title')

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('public/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('public/vendor/animate/animate.css')}}">

		<link rel="stylesheet" href="{{asset('public/vendor/font-awesome/css/fontawesome-all.min.css')}}" />
		<link rel="stylesheet" href="{{asset('public/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('public/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{asset('public/vendor/pnotify/pnotify.custom.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')}}" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{asset('public/vendor/select2/css/select2.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/datatables/media/css/dataTables.bootstrap4.css')}}" />
		<link rel="stylesheet" href="{{asset('public/vendor/jquery-ui/jquery-ui.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/jquery-ui/jquery-ui.theme.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" />
        <link rel="stylesheet" href="{{asset('public/vendor/summernote/summernote-bs4.css')}}" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('public/css/theme.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('public/css/custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('public/vendor/modernizr/modernizr.js')}}"></script>
        <script src="{{asset('public/master/style-switcher/style.switcher.localstorage.js')}}"></script>

	</head>
	<body>
		<!-- start: page -->
		@yield('body')
		<!-- end: page -->

		<!-- Vendor -->
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

        <!-- Specific Page Vendor -->
        <script src="{{asset('public/vendor/jquery-validation/jquery.validate.js')}}"></script>
        <script src="{{asset('public/vendor/pnotify/pnotify.custom.js')}}"></script>
        <script src="{{asset('public/vendor/select2/js/select2.js')}}"></script>
        <script src="{{asset('public/vendor/autosize/autosize.js')}}"></script>
		<script src="{{asset('public/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
		<script src="{{asset('public/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('public/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('public/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>


        <script src="{{asset('public/vendor/jquery-ui/jquery-ui.js')}}"></script>
		<script src="{{asset('public/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
		<script src="{{asset('public/vendor/jquery-maskedinput/jquery.maskedinput.js')}}"></script>
		<script src="{{asset('public/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('public/vendor/summernote/summernote-bs4.js')}}"></script>
		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('public/js/theme.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('public/js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('public/js/theme.init.js')}}"></script>
        <!-- Examples -->
		<!-- Analytics to Track Preview Website -->
        <!-- <script>		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)		  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');		  ga('create', 'UA-42715764-8', 'auto');		  ga('send', 'pageview');		</script> -->
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
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
        @yield('script')
        <script type="text/javascript">
            function initModal() {
                $('.modal-with-form').magnificPopup({
                    type: 'inline',
                    preloader: false,
                    focus: '#name',
                    modal: true,

                    // When elemened is focused, some mobile browsers in some cases zoom in
                    // It looks not nice, so we disable it:
                    callbacks: {
                        beforeOpen: function() {
                            if($(window).width() < 700) {
                                this.st.focus = false;
                            } else {
                                this.st.focus = '#name';
                            }
                        }
                    }
                });
                $('.modal-with-zoom-anim').magnificPopup({
                    type: 'inline',

                    fixedContentPos: false,
                    fixedBgPos: true,

                    overflowY: 'auto',

                    closeBtnInside: true,
                    preloader: false,

                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                $('.modal-basic').magnificPopup({
                    type: 'inline',
                    preloader: false,
                    modal: true
                });
            }
            initModal();
            $(document).on('click', '.modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });
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
	</body>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.1.1/pages-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Feb 2019 11:37:06 GMT -->
</html>
