@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Danh sách sản phẩm</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Sản phẩm</span></li>
                <li><span>Danh sách sản phẩm</span></li>
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

            <h2 class="card-title">Danh sách sản phẩm</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Thể loại</th>
                        <th>Số lượng</th>
                        <th>Số lần nhập</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> <img src="{{ asset('public/'.$product->picture) }}" alt="" width="100" height="100"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $product->importproducts->count() }}</td>
                            <td class="actions">
                                <a href="{{ url('admin/products/detail')."/".$product->id }}" class="edit-row"><i class="fas fa-eye"></i></a>
                                <a href="#modalDelete" class="delete-row modal-with-zoom-anim" data-id="{{ $product->id }}"><i class="far fa-trash-alt"></i></a>
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
                        <p class="mb-0">Toàn bộ thông tin liên quan đến sản phẩm bao gồm đơn nhập, key game sẽ bị xóa. Bạn có muốn tiếp tục?</p>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <form action="{{url('admin/products/delete')}}" method="post" id="form_delete">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="iddelete" id="id_delete"/>
                            <button type="submit" class="btn btn-primary modal-confirm-delete">Confirm</button>
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

    $(document).on('click','.delete-row',function(){
        $('#info_edit').summernote('reset');
        $('#id_delete').val($(this).data('id'));
    })

    // $(document).on('click', '.submit-addkey-product', function (e) {
    //     e.preventDefault();
    //     $("select").tagsinput('items').forEach(element => {
    //         if (Array.isArray(element)) {
    //             $.ajax({
    //                 type: "POST",
    //                 url: "{{ url('/admin/products/addkey') }}",
    //                 data: {
    //                     "_token": "{{ csrf_token() }}",
    //                     'id': $('#id_addkey').val(),
    //                     'keys': element,
    //                 },
    //                 success: function(data) {
    //                     $.magnificPopup.close();
    //                     notification('success', 'Thông báo', 'Thêm key thành công vào sản phẩm. ID:'+data)
    //                     setTimeout(function(){
    //                         location.reload();
    //                     }, 1000);
    //                 }
    //             })
    //         }
    //     });

    // });
</script>
@endsection
