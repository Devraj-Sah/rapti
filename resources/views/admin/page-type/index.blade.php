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
                            Page Type List
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($page_types) > 0)
                                @foreach($page_types as $key => $page_type)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$page_type->page_type_title}}</td>
                                        <td>
                                            <a href="{{route('pageType.edit',$page_type->sort)}}" title="edit" class="edit_btn"><button class="btn btn-warning">Edit</button></a>
                                            {!! Form::open([
                                                   'method' => 'DELETE',
                                                   'route' => ['pageType.destroy', $page_type->sort]
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
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>

    <script>
        $('.add').click(function(){
            var url = '<?=url()->full();?>'+'/create';
            window.location=url;
        });
    </script>

    <script>
        $('.backlink').click(function(){
            parent.history.back();
            return false;
        });
    </script>

    <script>
        setTimeout(function(){$('.success').slideUp();},2000);
    </script>


    <script>
        // Change status
        $('.page_status').on('click',function(){
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("data-id");
            var url = "{{url('admin/navigation-list')}}" + '/' + id;

            if($(this).prop('checked')==true){
                page_status = 1;
                $.ajax({
                    type:'put',
                    url:url,
                    data:{_token:csrf,page_status:page_status},
                    success:function(data){
                        console.log(data);
                    },
                    error:function(data){
                        console.log(data);
                    }
                });

            }else if($(this).prop('checked')==false){
                page_status = 0;
                $.ajax({
                    type:'put',
                    url:url,
                    data:{_token:csrf,page_status:page_status},
                    success:function(data){
                        console.log(data);
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endsection

