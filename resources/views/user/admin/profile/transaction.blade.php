@extends('user.admin.profile')

@section('body-container')
    @php
        $user = Auth::guard('user')->user();
    @endphp
<div class="container-body-container tai-khoan">
    <div class="hidden-xs padding-left-right-pc">
        <h2>Lịch sử giao dịch</h2>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered lich-su-don-hang " id="table_transaction">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 15%">Ngày tạo</th>
                        <th scope="col" class="text-center" style="width: 30%">Miêu tả</th>
                        <th scope="col" class="text-center" style="width: 15%">Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $item)
                    <tr>
                        <td class="text-left vertical-align-center">{{ $item['created_at'] }}</td>
                        <td class="text-center vertical-align-center">{{ $item['des'] }}</td>
                        <td class="text-right vertical-align-center">{{ number_format($item['total'])." "."đ" }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="row">

        </div>

    </div>
</div>
@endsection

@section('content-script')
<script>
$(document).ready( function () {
    $('#table_transaction').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );
</script>
@endsection
