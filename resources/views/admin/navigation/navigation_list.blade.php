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
                            {{$nav_category}} Category Navigation List
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

                            @if(Session::has('success'))
                                <div class="alert alert-success success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    {{Session::get('success')}}
                                </div>
                            @endif
                        </div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default backlink"><i class="fa fa-backward"
                                                                                      aria-hidden="true"> </i> Back
                            </button>

                            <button type="button" class="btn btn-success add"><i class="fa fa-plus"
                                                                                 aria-hidden="true"></i>Create New
                                Navigation
                            </button>

                        </div>

                    </div> <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                @if($nav_category!='SNS')
                                    <th>Page Type</th>
                                @endif
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(count($navigations) > 0)
                                @foreach($navigations as $index => $navigation)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{ $navigation->id }}</td>
                                        <td>{{$navigation->nav_name}}</td>

                                        @if($nav_category!='SNS')
                                            <td>{{$navigation->page_type}}
                                                @if($navigation->page_type == 'Group')
                                                    <div class="badge">
                                                        @if(count($navigation->childs))
                                                            {{$navigation->childs->count()}}
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{$navigation->position}}</td>

                                        <td class="center">
                                            <input type="checkbox" class="page_status" name="page_status"
                                                   data-id="{{$navigation->id}}" {{($navigation->page_status == 1)?'checked':''}} />
                                        </td>

                                        <td>
                                            @if($navigation->page_type === 'Group')
                                                <a href="/admin/navigation-list/{{$nav_category}}/{{$navigation->id}}"
                                                   title="Group">
                                                    <button class="btn btn-primary">Open</button>
                                                </a>
                                            @elseif($navigation->page_type == 'Photo Gallery' || $navigation->page_type == 'Slider' || $navigation->page_type == 'Audio Gallery')
                                                <a href="/admin/navigation-list/{{$nav_category}}/{{$navigation->id}}/showList"
                                                   title="Add Photos" class="btn-add">
                                                    <button class="btn btn-primary">View</button>
                                                </a>

                                            @elseif($navigation->page_type === 'Video Gallery')
                                                <a href="/admin/navigation-list/{{$nav_category}}/{{$navigation->id}}/vlink"
                                                   title="Add Videos" class="btn-add">
                                                    <button class="btn btn-primary">View Videos</button>
                                                </a>
                                            @endif
                                            <a href="/admin/navigation-edit/{{$nav_category}}/{{$navigation->id}}/edit"
                                               title="edit" class="edit_btn">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>

                                            @if(count($navigation->childs) <= 0)
                                                @if($navigation->nav_status == 0)
                                                    <a href="/admin/navigation-list/{{$nav_category}}/{{$navigation->id}}/delete"
                                                       title="delete" class="delete_btn"
                                                       onclick="return confirm('Are you sure to delete ?');">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                @endif
                                            @endif
                                            @if($navigation->parent_page_id == 500000)
                                                <a href="/admin/{{$navigation->id}}/comment_list">
                                                    <button class="btn btn-primary">Comments</button>
                                                </a>
                                            @endif

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
