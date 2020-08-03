@extends('admin.layout.index')
@section('title')
    <title>Lấy lại mật khẩu</title>
@endsection

@section('body')
<section class="body-sign">
    <div class="center-sign">
        <a href="" class="logo float-left">
            <img src="img/logo.png" height="54" alt="Porto Admin" />
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Recover Password</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <p class="m-0">Enter your e-mail below and we will send you reset instructions!</p>
                </div>

                <form action="{{url('admin/recover-password')}}" method="post" id="form-recover-password">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <span class="input-group-append">
                                <button class="btn btn-primary btn-lg" type="submit">Reset!</button>
                            </span>
                            <input name="email" id="email" type="email" placeholder="E-mail" class="form-control form-control-lg" style="width:80%"/>

                        </div>
                    </div>

                    <p class="text-center mt-3">Remembered? <a href="admin/login">Sign In!</a></p>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>
    </div>
</section>

@endsection


@section('script')
<script type="text/javascript">
    $("#form-recover-password").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: "{{ url('admin/checkemailrecover') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }
            }
        },
        messages: {
            email: {
                remote: "Email does not exist"
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
</script>
<script>
    <?php
        if (session('success')) { ?>
            let text = <?php echo json_encode(session('success'));?>;
            notification('success', 'Thong báo', text);
        <?php }
    ?>
</script>
@endsection
