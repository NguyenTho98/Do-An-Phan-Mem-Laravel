@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý nhân viên</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nhân viên</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Nhân viên</span></li>
                <li><span>Danh sách</span></li>
            </ol>

        </div>
    </header>

    <!-- start: page -->

    <section class="card">
        <header class="card-header">
            <div class="card-actions">
                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
            </div>

            <h2 class="card-title">List User</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Chức vụ</th>
                        <th>Ngày khởi tạo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="post{{$user->id}}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ? $user->role->title : 'Nhân viên' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="actions">
                                <a href="#modalFormEdit" class="edit-row modal-with-form" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#modalDelete" class="delete-row modal-with-zoom-anim" data-id="{{ $user->id }}"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <div id="modalFormEdit" class="modal-block modal-block-primary mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Cập nhật thông tin nhân viên</h2>
            </header>
            <div class="card-body">
                <form id="form-update-user" method="post" action="{{url('admin/users/update')}}">
                    <div class="error">

                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="text" name="id" id="id" class="form-control" id="name" required="true" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" id="name" required="true" minlength="4">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" id="email" required="true" email="true">
                    </div>
                    <hr class="dotted tall">

                    <h4 class="mb-3">Đổi mật khẩu</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 text-right mt-3">
                            <button type="submit" class="btn btn-primary modal-confirm-update">Xác nhận</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>


    <div id="modalDelete" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Are you sure?</h2>
            </header>
            <div class="card-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="modal-text">
                        <p class="mb-0">Bạn có chắc chắn muốn xóa nhân viên này?</p>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <form action="{{url('admin/users/delete')}}" method="post">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="id" id="id_delete"/>
                            <button class="btn btn-primary modal-confirm-delete">Xác nhận</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </form>
                    </div>
                </div>
            </footer>
        </section>
    </div>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $(document).ready( function () {
        $('#datatable-default').DataTable({});
    } );

    $(document).on('click','.edit-row',function(){
        $('#name').val($(this).data('name'));
        $('#id').val($(this).data('id'));
        $('#email').val($(this).data('email'));
    })

    $(document).on('click','.delete-row',function(){
        $('#id_delete').val($(this).data('id'));
    })

    $("#form-update-user").validate({
        rules: {
            password_confirmation: {
                equalTo: "#password"
            }
        },
        messages: {
            password_confirmation: {
                equalTo: "Mật khẩu không trùng khớp!",
            },
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
