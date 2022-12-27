@extends('admin.layout.master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin/plugins/DataTables/datatables.min.css')}}">

@endsection

@section('content')

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          
         <h3 class="box-title" style="font-weight: bold">Subscribers List</h3>

        
<div class="clearfix"></div>
        <div class="col-sm-9">
           <!--error shows-->
         @if (count($errors) > 0)
         <div class="alert alert-danger lert-dismissible">
         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
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
      </div>
      <!-- /.box-header -->
      <div class="box-body">

       <table id="datatable" class="table table-bordered">
        <tbody>        
        <tr>
          <th>Full Name</th>
          <td>{{$feedback->name}} </td>
        </tr>
        <tr>         
          <th>Email</th>
          <td>{{$feedback->email}} </td>
        </tr>
        <tr>
          <th>Subject</th>
          <td>{{$feedback->subject}}  </td>
        </tr>
        <tr>         
          <th>Message</th>
          <td>{{$feedback->comment}} </td>
        </tr>
        <tr>
          <th>Status</th>
          <td>
            <input type="checkbox" class="page_status" name="page_status" data-id="{{$feedback->id}}" {{($feedback->page_status == 1)?'checked':''}} />
            (<i>active feedback is shown on website!</i>)
          </td>
        </tr>
        <tr>         
          <th>Added At</th>
          <td>{{date('F d, Y' ,strtotime($feedback->created_at))}}</td>
        </tr>
        <tr>
          <th>Action</th>
          <td><a href="/admin/feedbacks-list/{{$feedback->id}}" onclick="return confirm('Are you sure to delete ?');" class="btn btn-danger">Delete</a></td>
        </tr>
      </tbody>
      
       
    </table>  
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

<script src="{{asset('assets/admin/plugins/DataTables/datatables.min.js')}}"></script>

<script type="text/javascript"> 
$(document).ready(function(){
  $('.backlink').click(function(){
    parent.history.back();
    return false;
  });
});


$(document).ready( function () {
    $('#datatable').DataTable();
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
 var url = "{{url('admin/feedbacks-list')}}" + '/' + id;

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
