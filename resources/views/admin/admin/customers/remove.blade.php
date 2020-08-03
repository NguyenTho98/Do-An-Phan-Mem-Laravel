@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý khách hàng</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Khách hàng</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Khách hàng</span></li>
                <li><span>Danh sách đã xóa</span></li>
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

            <h2 class="card-title">Danh sách khách hàng</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Tài khoản</th>
                        <th>Ngày khởi tạo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="post{{$customer->id}}">
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ substr($customer->phone, 0, 15) }}...</td>
                            <td>{{ substr($customer->address, 0, 15) }}...</td>
                            <td>{{ $customer->money }}</td>
                            <td>{{ $customer->created_at }}</td>
                            <td class="actions">
                                <a href="#modalDelete" class="delete-row modal-with-zoom-anim" data-id="{{ $customer->id }}"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>


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
                        <p class="mb-0">Xác nhận hoàn tác thông tin khách hàng này. Bạn có chắc chắn?</p>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <form action="{{ url('admin/customers/undodelete') }}" method="post">
                            <input type="hidden" name="id" id="id_delete"/>
                            @csrf
                            <button class="btn btn-primary modal-confirm-delete">Xác nhận</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </form>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $(document).ready( function () {
        $('#datatable-default').DataTable();
    } );

    $(document).on('click','.delete-row',function(){
        $('#id_delete').val($(this).data('id'));
    })

</script>
@endsection
