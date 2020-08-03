@extends('user.layout.index')


@section('content')
<div class="container">
    <div style="text-align:center;margin-bottom:22px;">
      <strong><h4>Đóng góp ý kiến</h4></strong>
    </div>
    <form action="{{ url('phan-hoi') }}" method="post" id="form-feedback">
        <div class="search-header" id="content">
            <div class="row">
                {{ csrf_field() }}
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text"
                        class="form-control" name="email" id="" aria-describedby="helpId" placeholder="nuceshop@nuce.edu.vn">
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-group">
                      <label for="">Vấn đề bạn đang mắc phải?</label>
                      <input type="text"
                        class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-group">
                      <label for="">Chi tiết vấn đề</label>
                      <textarea type="text"
                        class="form-control" name="content" id="" aria-describedby="helpId" placeholder="" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-aqua-bg">Submit</button>
                        <a href="{{ url('/') }} " class="btn btn-qua">Trang chủ</a>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#form-feedback").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                title: {
                    required: true
                },
                content: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Vui lòng nhập email của bạn!",
                    email: "Vui lòng nhập đúng định dạng email!"
                },
                title: {
                    required: "Vui lòng nhập vấn đề của bạn!"
                },
                content: {
                    required: "Vui lòng nhập chi tiết vấn đề của bạn!"
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

    });
</script>
@endsection
