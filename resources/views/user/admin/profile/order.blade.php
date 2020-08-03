@extends('user.admin.profile')

@section('body-container')
    @php
        $user = Auth::guard('user')->user();
        $total = 0;
        foreach ($user->orders as $value) {
            $total += $value->total;
        }
    @endphp
<div class="container-body-container tai-khoan">
    <div class="hidden-xs padding-left-right-pc">
        <h2>Lịch sử đơn hàng</h2>
        <hr>
        {{-- <p>Hiển thị {{ $paginator->current_page() }} đến 1 trong tổng số {{ $paginator->last_page() }} ({{ $paginator->last_page() }} Trang)</p> --}}
        {{-- <div class="row filter">
          <div class="col-lg-12 col-md-12">
              <div class="row">
                  <div class="col-md-4">
                      <div class="filter-title" for="input-order-id">Mã đơn hàng</div>
                      <input type="text" name="filter_order_id" value="" placeholder="Số đơn hàng" id="input-order-id" class="form-control">

                      <div class="filter-title" for="input-date-added-from">Ngày tạo từ</div>
                      <div class="input-group date">
                          <input type="text" name="filter_date_added_from" value="" placeholder="Ngày tạo từ" data-date-format="YYYY-MM-DD" id="input-date-added-from" class="form-control">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                          </span>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="filter-title" for="input-amount-from">Số tiền từ</div>
                      <input type="text" name="filter_total_from" value="" placeholder="Số tiền từ" id="input-amount-from" class="form-control">
                      <div class="filter-title" for="input-date-added-to">Ngày tạo đến</div>
                      <div class="input-group date">
                          <input type="text" name="filter_date_added_to" value="" placeholder="Ngày tạo đến" data-date-format="YYYY-MM-DD" id="input-date-added-to" class="form-control">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                          </span>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="filter-title" for="input-amount-to">Số tiền đến</div>
                      <input type="text" name="filter_total_to" value="" placeholder="Số tiền đến" id="input-amount-to" class="form-control">
                      <div class="button-group">
                        <div class="btn btn-green-bg" id="button-filter">Tìm Kiếm</div>
                      </div>
                  </div>
              </div>
          </div>
        </div> --}}

        <div style="text-align: right; font-weight: 600; font-size: 17px; margin-bottom: 10px;">
          Tổng Tiền: {{ number_format($total)." "."đ" }}
        </div>

        <div class="table-responsive">
            <table class="table table-bordered lich-su-don-hang" id="table_order">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 25%">Ngày tạo</th>
                        <th scope="col" class="text-center" style="width: 15%">Đơn hàng</th>
                        <th scope="col" class="text-center" style="width: 20%">Tổng cộng</th>
                        <th scope="col" class="text-center" style="width: 10%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->orders as $item)
                    <tr>
                        <td class="text-left vertical-align-center">{{ $item->created_at }}</td>
                        <td class="text-center vertical-align-center">{{ $item->id }}</td>
                        <td class="text-right vertical-align-center">{{ number_format($item->total)." "."đ" }}</td>
                        <td class="text-center vertical-align-center"><a href="{{ url('chi-tiet-don-hang').'/'.$item->id }}" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Xem">Xem chi tiết</a></td>
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
    $('#table_order').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );
</script>
@endsection
