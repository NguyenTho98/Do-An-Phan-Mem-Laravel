@extends('admin.layout.body')
@section('content-title')
    <title>Quản lý phản hồi</title>
@endsection

@section('content-body')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Phản hồi</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="admin">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Phản hồi</span></li>
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
            <h2 class="card-title">Phản hồi trong tháng {{ date('m') }}</h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-0" id="datatable-details">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Ngày gửi</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ strlen($feedback->title) > 20 ? substr($feedback->title, 0, 20)."..." : $feedback->title }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ strlen($feedback->content) > 20 ? substr($feedback->content, 0, 20)."..." : $feedback->content }}</td>
                            <td>{{ $feedback->created_at }}</td>
                            <td class="feedback{{ $feedback->id }}">
                                @if ($feedback->status == 1)
                                    Chưa đọc
                                @else
                                    Đã đọc
                                @endif
                            </td>
                            <td>
                                <a href="#modalFormEdit" class="edit-row modal-with-form" data-id="{{ $feedback->id }}"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <h2>Tổng số phản hồi: {{ $feedbacks->count() }}</h2>
        </div>
    </section>

    <div id="modalFormEdit" class="modal-block modal-block-lg mfp-hide">
        <section class="card">
            <header class="card-header">
                <h2 class="card-title" style="float: left;">Chi tiết phản hồi</h2>
                <span type="button" class="close modal-dismiss" aria-hidden="true">×</span>
            </header>
            <div class="card-body">
                <h2 class="title"></h2>
                <div class="p-3">
                    <p>ID: <span class="id"></span></p>
                    <p>Email: <span class="email"></span></p>
                    <p>Ngày gửi: <span class="created_at"></span></p>
                    <p>Nội dung: <span class="content"></span></p>
                </div>
                <div class="p-3 row info">

                </div>
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
            "order": [[ 4, "desc"]]
        });
    } );
    $(document).on('click','.edit-row',function(){
        $.ajax({
            type: "GET",
            url: "{{ url('/admin/feedbacks/') }}"+"/"+$(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log(data);
                // tab overview
                $('.id').html(data.id);
                $('.title').html(data.title);
                $('.email').html(data.email);
                $('.content').html(data.content);
                $('.created_at').html(data.created_at);
                $('.feedback'+data.id).html("Đã đọc");
            }
        })

    })
</script>
@endsection
