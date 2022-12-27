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
                            Product Category List
                        </h3>
                        <div class="clearfix"></div>

                        <div class="col-sm-9">
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hiddden="true">x</span></button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                @include('admin.flash-message')
                            @if(Session::has('success'))
                                <div class="alert alert-success success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    {{Session::get('success')}}
                                </div>
                            @endif
                        </div>
                        <div class="box-tools pull-right">
                            <a href="{{route('category-excel.import')}}" class="btn btn-primary"><i class="fa fa-upload"
                                                                                                    aria-hidden="true"></i>
                                Import Xls</a>
                            <button type="button" class="btn btn-success add"><i class="fa fa-plus"
                                                                                 aria-hidden="true"></i> Create New
                                Category
                            </button>
                        </div>
                    </div> <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.NO.</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->parents?$category->parents->name:'No Parent'}}</td>
                                        <td>{{$category->position}}</td>
                                        <td>
                                            @if($category->thumbnail)
                                                <img src="{{asset('uploads/category/'.$category->thumbnail)}}"
                                                     width="100px">
                                            @endif
                                        </td>
                                        <td class="center">
                                            <input type="checkbox" class="status" name="status"
                                                   data-id="{{$category->id}}" {{($category->status == 1)?'checked':''}} />
                                        </td>
                                        <td>
                                            <a href="{{route('product-categories.edit',$category->id)}}" title="edit"
                                               class="edit_btn">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            {!! Form::open([
                                                   'method' => 'DELETE',
                                                   'route' => ['product-categories.destroy', $category->id]
                                               ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
        $('.status').on('click', function () {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("data-id");
            console.log(id);
            var url = "{{url('admin/product-categories/update-status/')}}" + '/' + id;

            if ($(this).prop('checked') == true) {
                status = 1;
                $.ajax({
                    type: 'put',
                    url: url,
                    data: {_token: csrf, status: status},
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            } else if ($(this).prop('checked') == false) {
                status = 0;
                $.ajax({
                    type: 'put',
                    url: url,
                    data: {_token: csrf, status: status},
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

