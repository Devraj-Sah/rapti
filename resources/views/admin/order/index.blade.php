@extends('admin.layout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/DataTables/datatables.min.css')}}">
@endsection

@section('content')
    <!-- main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-weight: bold;margin-bottom: 10px;">
                            Order List
                        </h3>
                        <div class="clearfix"></div>
                        <div class="col-sm-9">
                            @include('admin.flash-message')
                        </div>

                    </div> <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Order Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $key => $order)
                                    <tr>

                                        <td>{{$order->id}}</td>
                                        <td>{{$order->invoice_id }}</td>
                                        <td>{{$order->orderAddress->name}}</td>
                                        <td>{{$order->orderAddress->email}}</td>
                                        <td>{{$order->status_id}}</td>
                                        <td>{{$order->orderAddress->created_at}}</td>
                                        {{-- <td>{{$order->orderStatus->title}}</td> --}}

                                        <td>
                                            <a href="{{route('order.show',['id'=>$order->id])}}" title="edit"
                                               class="edit_btn">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script src="{{asset('assets/admin/plugins/DataTables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>

    <script>
        $('.add').click(function () {
            var url = '<?=url()->full();?>' + '/create';
            window.location = url;
        });
    </script>

    <script>
        $('.backlink').click(function () {
            parent.history.back();
            return false;
        });
    </script>

    <script>
        setTimeout(function () {
            $('.success').slideUp();
        }, 2000);
    </script>


    <script>
        // Change status
        $('.page_status').on('click', function () {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("data-id");
            var url = "{{url('admin/navigation-list')}}" + '/' + id;

            if ($(this).prop('checked') == true) {
                page_status = 1;
                $.ajax({
                    type: 'put',
                    url: url,
                    data: {_token: csrf, page_status: page_status},
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            } else if ($(this).prop('checked') == false) {
                page_status = 0;
                $.ajax({
                    type: 'put',
                    url: url,
                    data: {_token: csrf, page_status: page_status},
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endsection

