
@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý mã giảm giá</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Mã giảm giá</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Mã giảm giá</span></li>
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

            <h2 class="card-title">Danh sách mã giảm giá</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Giá trị</th>
                        <th>Số lượng</th>
                        <th>Đơn hàng áp dụng</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Ngày tạo mã</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>{{ $coupon->qty }}</td>
                            <td>{{ $coupon->coupon_price }}</td>
                            <td>{{ $coupon->start }}</td>
                            <td>{{ $coupon->end }}</td>
                            <td>{{ $coupon->created_at }}</td>
                            <td class="actions">
                                <a href="{{ url('admin/coupons/detail')."/".$coupon->id }}" class="edit-row"><i class="fas fa-pencil-alt"></i></a>
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
                        <p class="mb-0">Bạn có chắc chắn muốn xóa thể loại này?</p>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <form action="{{url('admin/categories/delete')}}" method="post">
                            @csrf
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
        $('#datatable-default').DataTable({
            "order": [[ 5, "desc" ]]
        });
    } );

    $(document).on('click','.delete-row',function(){
        $('#id_delete').val($(this).data('id'));
    })

</script>
@endsection
