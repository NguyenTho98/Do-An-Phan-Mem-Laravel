@extends('admin.layout.body')
@section('content-title')
    <title>Bình luận sản phẩm</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Bình luận</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Bình luận</span></li>
                <li><span>Chi tiết bình luận</span></li>
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

            <h2 class="card-title">Bình luận</h2>
        </header>
        <div class="card-body">
            <div class="product">
                <a href="{{ url('admin/products/detail')."/".$comments->first()->product->id }}">
                    <h2 class="name">{{ $comments->first()->product->name }}</h2>
                </a>
                <div class="p-3 row">

                    <div class="col-lg-6">
                        <img src="{{ URL::asset('').$comments->first()->product->picture }}" alt="">
                    </div>

                    <div class="col-lg-6">
                        <p>Thể loại: <a href="{{ url('admin/categories/detail')."/".$comments->first()->product->category_id }}"><span>{{ $comments->first()->product->category->name }}</span></a></p>
                        <p>Số lượng: <span>{{ $comments->first()->product->qty }}</span></p>
                        <p>Giá bán: <span>{{ $comments->first()->product->price ? $comments->first()->product->price."vnđ" : "Chưa bán" }}</span></p>
                        <p>Giảm giá: <span>{{ $comments->first()->product->price && $comments->first()->product->sale ? $comments->first()->product->sale."%" : "Chưa bán" }}</span></p>
                    </div>

                </div>
                <div class="p-3 row info">

                </div>
            </div>
            <h1>Bình luận</h1>
            <div class="row">
                @foreach ($comments as $item)
                <div class="col-md-10">
                    <a href="{{ url('admin/customers/detail')."/".$item->customer->id }}">
                        <b style="margin-bottom:5px; font-size: 17px; color: black;">{{ $item->customer->name }}</b>
                    </a>
                    <br>
                    <small>{{ $item->created_at }}</small>
                    <p class="content-player-review" style="white-space:pre-line; font-size:15px;">{{ $item->content }}</p>
                </div>
                <div class="col-md-2">
                    <div class="text-right" style="padding-top:20px">
                        <a  class="mb-1 mt-1 mr-1 modal-basic btn btn-danger" href="#modalHeaderColorDanger" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    {{ $comments->links() }}
                </div>
            </div>

        </div>
    </section>

    <!-- Modal Danger -->
    <div id="modalHeaderColorDanger" class="modal-block modal-header-color modal-block-danger mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title">Danger!</h2>
            </header>
            <div class="card-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="modal-text">
                        <h4>Danger</h4>
                        <p>This is a danger message.</p>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a id="iddelete" class="btn btn-danger">Submit</a>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script type="text/javascript">
    $(document).on('click', '.modal-basic', function() {
        let id = $(this).data('id');
        $("#iddelete").attr("href", "admin/comments/delete/" + id);
    })
</script>
@endsection
