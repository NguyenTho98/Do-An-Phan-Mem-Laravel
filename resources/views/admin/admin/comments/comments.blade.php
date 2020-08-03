@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý bình luận sản phẩm</title>
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

            <h2 class="card-title">Số lượng bình luận</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-details">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng comment</th>
                        <th>Số lượng comment chưa xem</th>
                        <th>Thời gian bình luận</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->comments->where('is_delete', false)->count() }}</td>
                            <td class="notseen{{ $product->id }}">{{ $product->comments->where('is_delete', false)->where('status', 1)->count() }}</td>
                            <td>{{ $product->comments->max('created_at') }}</td>
                            <td>
                                <a href="admin/comments/{{ $product->id }}"><i class="fas fa-eye    "></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection

@section('content-script')
<script type="text/javascript">
    $(document).ready( function () {
        $('#datatable-details').DataTable();
    } );

</script>
@endsection
