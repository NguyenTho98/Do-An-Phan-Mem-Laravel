@extends('admin.layout.index')
@section('title')
    <title>Đăng nhập</title>
@endsection

@section('body')
<section class="body-sign">
    <div class="center-sign">
        <a href="" class="logo float-left">
            <img src="img/logo.png" height="54" alt="Porto Admin" />
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
            </div>
            <div class="card-body">
                <form action="{{url('admin/login')}}" method="post" id="form-login">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <div class="input-group">
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </span>
                            <input name="email" id="email" type="text" class="form-control form-control-lg" style="width:85%"/>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="clearfix">
                            <label class="float-left">Password</label>
                            <a href="admin/recover-password" class="float-right">Lost Password?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </span>
                            <input name="password" id="password" type="password" class="form-control form-control-lg" style="width:85%"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="RememberMe" name="rememberme" type="checkbox"/>
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                        </div>
                    </div>

                    <!-- <span class="mt-3 mb-3 line-thru text-center text-uppercase">
                        <span>or</span>
                    </span>

                    <div class="mb-1 text-center">
                        <a class="btn btn-facebook mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-twitter mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-twitter"></i></a>
                    </div> -->

                    <p class="text-center">Don't have an account yet? <a href="admin/register">Sign Up!</a></p>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>
    </div>
</section>

@endsection


@section('script')
<script type="text/javascript">
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
    })
</script>
<script>
    <?php
        if (session('success')) { ?>
            let text = <?php echo json_encode(session('success'));?>;
            notification('success', 'Thông báo', text);
        <?php }
    ?>
</script>
@endsection
