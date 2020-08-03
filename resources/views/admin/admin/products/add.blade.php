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

            <h2 class="card-title">Thêm mới sản phẩm</h2>
        </header>
        <div class="card-body">
            <form class="form-horizontal form-bordered" action="{{url('admin/products')}}" id="form-create-product" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="row form-group">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Tên</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Thể Loại</label>
                            <select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Chọn thể loại" }' name="category_id" >
                                <optgroup label="Categories">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-form-label">Hình ảnh</label>
                            <input multiple="multiple" name="picture" type="file" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Thông tin</label>
                    <textarea name="info" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 500, "codemirror": { "theme": "ambiance" } }'></textarea>
                </div>
                <div class="form-group"></div>
                <footer class="card-footer text-right">
                    <input type="submit" class="btn btn-primary submit-create-product" value = "Submit"/>
                    <button type="reset" class="btn btn-default">Reset</button>
                </footer>
            </form>


        </div>
    </section>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script>
    $("#form-create-product").validate({
        rules: {
            name: {
                required: true
            },
            picture: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Vui lòng điền tên sản phẩm!",
            },
            picture: {
                required: "Vui lòng thêm ảnh sản phẩm!",
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
