@extends('admin.layout.body')
@section('content-title')
    <title>Nhập sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nhập sản phẩm</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Sản phẩm</span></li>
                <li><span>Nhập sản phẩm</span></li>
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

            <h2 class="card-title">Danh sách nhập sản phẩm</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nhà phân phối</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá nhập</th>
                        <th>Số lượng key</th>
                        <th>Ngày nhập</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($importproducts as $importproduct)
                        <tr>
                            <td>{{ $importproduct->id }}</td>
                            <td>{{ $importproduct->publisher->name }}</td>
                            <td> <img src="{{ asset($importproduct->product->picture) }}" alt="" width="100" height="100"></td>
                            <td>{{ $importproduct->product->name }}</td>
                            <td>{{ $importproduct->import_price }}</td>
                            <td>{{ $importproduct->qty }}</td>
                            <td>{{ $importproduct->created_at }}</td>
                            <td class="actions">
                                <a href="{{ url('admin/importproducts/detail')."/".$importproduct->id }}" class="edit-row" ><i class="fas fa-eye    "></i></a>
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
                        <p class="mb-0">Are you sure that you want to delete this product?</p>
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

    let table = $('#table-transaction').DataTable({
        data: [{
            'id': 0,
            'key': ''
        }],
        columns: [
            { data: 'id' },
            { data: 'key' }
        ]
    });
    $(document).on('click','.edit-row',function(){
        $.ajax({
            type: "GET",
            url: "{{ url('/admin/importproducts/detail') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                // tab detail import products
                table.clear();
                table.rows.add( data.productkeys ).draw();
                // tab overview
                $('.name').html(data.product.name);
                $('.category').html(data.product.category.name);
                $('.qty').html(data.product.qty);
                $('.info').html(data.product.info);
                $("#image_show").attr("src", '{{ URL::asset('') }}'+ data.product.picture);
            }
        })

    })

    // $(document).on('click','.delete-row',function(){
    //     $('#info_edit').summernote('reset');
    //     $('#id_delete').val($(this).data('id'));
    // })
</script>
@endsection
