
@extends('admin.layout.master')
@section('style')
<style type="text/css">
    .reqr{
        color: red;
    }
</style>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
               <h3 class="box-title" style="font-weight: bold">Profile</h3>
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

                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible col-sm-9 col-sm-offset-2 hide" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('error')}}
              </div>
              @endif
                <!--//error shows-->

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible col-sm-9 col-sm-offset-2 hide" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
              </div>
              @endif
          </div> 
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{route('admin.update_profile')}}">
            {{csrf_field()}}
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{$change_profile->name}}" required/>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email <i class="reqr">*</i></label>
                <input type="email" name="email" class="form-control" value="{{$change_profile->email}}"/>
            </div>
            <div class="col-md-12 reqr" id="msg_err"></div>

            <div class="form-group col-md-6">
                <label for="curr_password">Current Password <i class="reqr">*</i> <i class="fa fa-info-circle" title="Need to Save Profile"></i></label>
                <input type="password" name="curr_password" class="form-control" required/>
            </div>

            <div class="form-group col-md-6">
                <label for="password">New Password <i id="n_pw" class="reqr">*</i></label>
                <input type="password" name="password" class="form-control"/>
            </div>

            <div class="form-group col-md-6">
                <label for="confirm_password">Confirm Password <i id="c_pw" class="reqr">*</i></label>
                <input type="password" name="confirm_password" class="form-control"/>
            </div>
            
            <div class="form-group col-md-12">
                <button name="save_profile" class="btn btn-md btn-primary">Save</button>
            </div>
        </form>

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
<script>
    setTimeout(function(){$('.hide').slideUp();},2000);
</script>
@endsection
