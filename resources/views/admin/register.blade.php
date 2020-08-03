@extends('admin.layout.index')
@section('title')
    <title>Đăng ký</title>
@endsection

@section('body')
<section class="body-sign">
    <div class="center-sign">
        <a href="" class="logo float-left">
            <img src="img/logo.png" height="54" alt="Porto Admin" />
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign Up</h2>
            </div>
            <div class="card-body">
                <form action="{{url('admin/register')}}" method="post" id="form-register">
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
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input name="name" id="name" type="text" class="form-control form-control-lg" />
                    </div>

                    <div class="form-group mb-3">
                        <label>E-mail Address</label>
                        <input name="email" id="email" type="email" class="form-control form-control-lg" />
                    </div>

                    <div class="form-group mb-0">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label>Password</label>
                                <input name="password" id="password" type="password" class="form-control form-control-lg" />
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>Password Confirmation</label>
                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control form-control-lg" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="agree" name="agree" type="checkbox"/>
                                <label for="agree">I agree with <a href="#">terms of use</a></label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary mt-2">Sign Up</button>
                        </div>
                    </div>

                    <!-- <span class="mt-3 mb-3 line-thru text-center text-uppercase">
                        <span>or</span>
                    </span>

                    <div class="mb-1 text-center">
                        <a class="btn btn-facebook mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-twitter mb-3 ml-1 mr-1" href="#">Connect with <i class="fab fa-twitter"></i></a>
                    </div> -->

                    <p class="text-center">Already have an account? <a href="admin/login">Sign In!</a></p>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>
    </div>
</section>

@endsection

@section('script')
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
                    url: "{{ url('admin/checkemailregister') }}",
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
@endsection
