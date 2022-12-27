@extends('admin.layout.master')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
         
         <h3 class="box-title">Media List</h3>

        
<div class="clearfix"></div>
        <div class="col-sm-9">
           <!--error shows-->
         @if (count($errors) > 0)
         <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <!--//error shows-->

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible col-sm-9 col-sm-offset-2 success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{Session::get('success')}}
        </div>
      @endif
    </div>
        <div class="box-tools pull-right">       
         
          <button type="button" class="btn btn-info btn-md add" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus" aria-hidden="true"></i> Add Medias</button>
          
        </div>
    </div>


      <!-- /.box-header -->
      <div class="box-body">
       <table id="example2" class="table table-bordered table-hover">
        <thead>
         <tr>
          <!--   <th><input type="checkbox"></th> -->
          <th>SN</th>
          <th>Name | File</th>
          <th>Content</th>
          <th style="text-align:center;" colspan="2">Action</th>
        </tr>
      </thead>
      
      <tbody>
        @foreach($medias as $index => $media)
          <tr>
            <form action="/admin/navigation-list/media/{{$media->id}}/update" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
              <td>{{$index+1}}<br>
                  <img src="{{asset('uploads/photo_gallery/'.$media->file)}}" alt="" height="50" width="80">
              </td>
              <td>
                <input type="text" value="{{$media->name}}" placeholder="Name" name="name" class="form-control">
                <input type="text" value="{{$media->name_nepali}}" placeholder="Nepali Name" name="name_nepali" class="form-control">
                <input type="text" value="{{$media->link}}" placeholder="Link (if any)" name="link" class="form-control">
                <input type="file" id="file" name="file"  class="form-control" />
              </td>
              
              <td>
                <textarea value="" name="content"  placeholder="Image Caption" class="form-control">{{$media->content}}</textarea>
                <textarea value="" name="content_nepali" placeholder="Nepali Image Caption" class="form-control">{{$media->content_nepali}}</textarea>
              </td>

              <td class="text-right">  
                <a href="/admin/navigation-list/media/{{$media->id}}/update" title="" class="">
                    <button type="submit" class="btn btn-primary">Update</button></a>

              </td>
            </form>
            <td class="text-left">
                <a href="/admin/navigation-list/media/{{$media->id}}/delete" title="" class="" onclick="return confirm('Are you sure you want to delete??')"><button class="btn btn-danger">Delete</button></a>
                </td>

          </tr>
          @endforeach
      </tbody>
      
      
    </table>
    <div class="text-center">{{$medias->links()}}</div>
  </div>
  <!-- /.box-body -->
</div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript"> 


// Add post redirect
$('.add').click(function(){
  var url = '<?=url()->full(); ?>'+'/create';
  window.location=url;
});

</script>

<script>
  setTimeout(function(){$('.success').slideUp();},2000);
</script>

@endsection
