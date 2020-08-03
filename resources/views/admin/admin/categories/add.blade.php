@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý thể loại</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Thể loại</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Thể loại</span></li>
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

        <h2 class="card-title">Thêm mới thể loại</h2>
    </header>
    <div class="card-body">
        <section class="card">
            <div class="card-body">
                <form id="form-create" method="post" action="{{url('admin/categories')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Thể loại 1">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</section>

</section>

@endsection

@section('content-script')
<script>

    $("#form-create").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Vui lòng điền tên!"
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
