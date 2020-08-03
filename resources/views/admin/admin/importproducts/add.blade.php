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
                <li><span>Thêm mới</span></li>
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

            <h2 class="card-title">Nhập sản phẩm</h2>
        </header>
        <div class="card-body">
            <form class="form-horizontal form-bordered" id="form-new-import-product">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="row form-group">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Tên sản phẩm</label>
                            <select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Chọn sản phẩm"}' name="product_id" id="product_id" >
                                <optgroup label="Tên sản phẩm">
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Nhà phân phối</label>
                            <select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Chọn nhà phân phối" }' name="publisher_id" id="publisher_id">
                                <optgroup label="Nhà phân phối">
                                    @foreach ($publishers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label" for="import_price">Giá nhập vào</label>
                            <input type="text" name="import_price" class="form-control" id="import_price" placeholder="" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Key</label>
                    <select id="tags-input-multiple" multiple data-role="tagsinput" data-tag-class="badge badge-primary" class="select_key">

                    </select>
                </div>
                <div class="form-group"></div>
            </form>
            <footer class="card-footer text-right">
                <input type="submit" class="btn btn-primary submit-create-import-product" value = "Submit"/>
                <button type="reset" class="btn btn-default">Reset</button>
            </footer>

        </div>
    </section>


</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>

    $(document).on('click', '.submit-create-import-product', function (e) {
        e.preventDefault();
        let product_id = $('#product_id').select2('data')[0].id;
        let publisher_id = $('#publisher_id').select2('data')[0].id;
        $("select").tagsinput('items').forEach(element => {
            if (Array.isArray(element)) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/importproducts') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'keys': element,
                        'product_id': product_id,
                        'publisher_id': publisher_id,
                        'import_price': $('#import_price').val(),
                    },
                    success: function(data) {
                        notification('success', 'Thông báo', 'Thêm key thành công vào sản phẩm. ID:'+data.id)
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                })
            }
        });

    });
</script>
@endsection
