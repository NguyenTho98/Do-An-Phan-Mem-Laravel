@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý hóa đơn</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Hóa đơn</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Hóa đơn</span></li>
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

            <h2 class="card-title">Hóa đơn</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-details">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày mua</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <a href="{{ url('admin/orders/detail')."/".$order->id }}" class="detail-row"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

</div>
    <!-- end: page -->
</section>

@endsection

@section('content-script')
<script type="text/javascript">
    $(document).ready( function () {
        $('#datatable-details').DataTable({
            "order": [[ 3, "desc" ]]
        });
    } );

</script>
@endsection
