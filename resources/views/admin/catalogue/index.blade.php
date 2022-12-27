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
                            Products List
                        </h3>
                        <div class="clearfix"></div>
                        <div class="col-sm-9">
                            @include('admin.flash-message')
                        </div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-success add">
                                <i class="fa fa-plus"  aria-hidden="true"></i>Create New Catalog
                            </button>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($catalogues) > 0)
                                @foreach($catalogues as $key => $catalogue)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$catalogue->name}}</td>
                                        <td>
                                            @if($catalogue->image)
                                                <img src="{{asset('public/uploads/catalogue/'.$catalogue->image)}}"
                                                     width="100px">
                                            @endif
                                        </td>
                                        <td>
                                            @if($catalogue->file)
                                                <a href="{{route('pdf.view',$catalogue->id)}}">{{$catalogue->file}}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('catalogues.edit',$catalogue->id)}}" title="edit"
                                               class="edit_btn">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            {!! Form::open([
                                                   'method' => 'DELETE',
                                                   'route' => ['catalogues.destroy', $catalogue->id]
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

@endsection

