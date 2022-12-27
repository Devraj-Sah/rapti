@extends('admin.layout.master')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
         
         <h3 class="box-title">Videos List</h3>

        
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
         
          <button type="button" class="btn btn-info btn-md add" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus" aria-hidden="true"></i> Add Video</button>
          
        </div>
    </div>


      <!-- /.box-header -->
      <div class="box-body">
       <table id="example2" class="table table-bordered table-hover">
        <thead>
         <tr>
          <!--   <th><input type="checkbox"></th> -->
          <th>SN</th>
          <th>Name | Videos Links</th>
          <th>Content</th>
          <th style="text-align:center;" colspan="2">Action</th>
        </tr>
      </thead>
      
      <tbody>
       @foreach($links as $index => $link)
          <tr>
            <form action="/admin/navigation-list/vlink/{{$link->id}}/update" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
              <td>{{$index+1}}</td>
              <td>
                <input type="text" name="name" value="{{$link->name}}" class="form-control" placeholder="Video Title">
                <input type="text" name="name_nepali" value="{{$link->name_nepali}}" class="form-control" placeholder="Nepali Video Title">
                <input type="text" name="link" id="vlink" value="{{$link->link}}"  class="form-control" placeholder="Youtube links" />
              </td>
             
              
              <td>
                <textarea name="content" class="form-control" placeholder="video caption">{{$link->content}}</textarea>
                <textarea name="content_nepali" class="form-control" placeholder="Neplai video caption">{{$link->content_nepali}}</textarea>
              </td>

              <td class="text-right">  
                <a href="" title="" class="">
                    <button type="submit" class="btn btn-primary">Update</button></a>

              </td>
            </form>
            <td class="text-left">
                <a href="/admin/navigation-list/vlink/{{$link->id}}/delete" title="" class="" onclick="return confirm('Are you sure you want to delete??')"><button class="btn btn-danger">Delete</button></a>
                </td>

          </tr>
  
      </tbody>
      @endforeach
      
    </table>

    <div class="text-center">{{$links->links()}}</div>
    
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
