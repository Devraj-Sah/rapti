@extends('admin.layout.master')
@section('content')
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title" style="font-weight: bold">Global Setup</h3>
		</div>
		<div class="center">
			<br />

			@if(Session::has('success'))
            <div class="alert alert-success alert-dismissible col-sm-9 col-sm-offset-2 hide" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              {{Session::get('success')}}
          </div>
          @endif
      </div>

      <!-- form start -->
      <form action="{{route('update.global_setting')}}" method="post" enctype="multipart/form-data">                             
        {{csrf_field()}}     
        <div class="form-group col-md-6">
            <label for="site_name">Site Name</label>
            <input type="text" id="site_name" name="site_name" class="form-control" placeholder="Site Name" value="{{$global_setting->site_name}}">
        </div>
        <div class="form-group col-md-6">
            <label for="site_nepali_name">Site Name (nepali)</label>
            <input type="text" id="site_nepali_name" name="site_nepali_name" class="form-control" placeholder="Site Name" value="{{$global_setting->site_nepali_name}}">
        </div>                                                                                             
        <div class="form-group col-md-6">
            <label for="site_email">Site Email</label>
            <input type="email" id="site_email" name="site_email" class="form-control" placeholder="Site Email" value="{{$global_setting->site_email}}">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Site Contact</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Site Contact Number" value="{{$global_setting->phone}}">
        </div>
          <div class="form-group col-md-6">
              <label for="phone">Site Address</label>
              <input type="text" id="website_full_address" name="website_full_address" class="form-control" placeholder="Address" value="{{$global_setting->website_full_address}}">
          </div>
        <div class="form-group col-md-6">
            <label for="page_title">Page Title</label>
            <input type="text" id="page_title" name="page_title" class="form-control" placeholder="Page Title" value="{{$global_setting->page_title}}">
        </div>                                                                                             
        <div class="form-group col-md-6">
            <label for="page_keyword">Page Keyword</label>
            <input type="text" id="page_keyword" name="page_keyword" class="form-control" placeholder="Page Keyword" value="{{$global_setting->page_keyword}}">
        </div>                                                                                             
        <div class="clearfix"></div>

        <div class="form-group col-md-12">
            <label for="page_description">Page Description</label>
            <textarea id="page_description" name="page_description" class="form-control" placeholder="Page Description" rows="3">{{$global_setting->page_description}}</textarea>
        </div>                                                                                             
        <div class="clearfix"></div>

        <div class="form-group col-md-6">
            <label for="favicon">Fav Icon</label>
            <input type="file" id="favicon" name="favicon" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <img src="{{asset('uploads/icons/'.$global_setting->favicon)}}" class="img-responsive img-thumbnail">
        </div>                                                                                             
        <div class="clearfix"></div>

        <div class="form-group col-md-6">
            <label for="site_logo">Logo</label>
            <input type="file" id="site_logo" name="site_logo" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <img src="{{asset('uploads/icons/'.$global_setting->site_logo)}}" class="img-responsive img-thumbnail">
        </div>
          <div class="form-group col-md-6">
              <label for="page_title">Facebook link</label>
              <input type="text" id="facebook_link" name="facebook_link" class="form-control" placeholder="Facebook Link" value="{{$global_setting->facebook_link}}">
          </div>
          <div class="form-group col-md-6">
              <label for="page_title">Instagram link</label>
              <input type="text" id="instagram_link" name="instagram_link" class="form-control" placeholder="Instagram Link" value="{{$global_setting->instagram_link}}">
          </div>
          <div class="form-group col-md-6">
              <label for="twitter_link">Twitter link</label>
              <input type="text" id="twitter_link" name="twitter_link" class="form-control" placeholder="Twitter Link" value="{{$global_setting->twitter_link}}">
          </div>
          <div class="form-group col-md-6">
              <label for="youtube_link">Youtube link</label>
              <input type="text" id="youtube_link" name="youtube_link" class="form-control" placeholder="Youtube Link" value="{{$global_setting->youtube_link}}">
          </div>
          <div class="clearfix"></div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" id="save_global">Save</button>
        </div>

        <div class="clearfix"></div>
    </form>
</div>
</div>
</section>
@endsection

@section('scripts')
<script>

	CKEDITOR.replace( 'page_description',{
        toolbar: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'RemoveFormat' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'tools', items: [ 'Maximize' ] }
        ],
        uiColor : '#3c8dbc',
        height: '100px',
        enterMode :CKEDITOR.ENTER_BR,
        filebrowserWindowWidth: '400',
        filebrowserWindowHeight: '300'
    });


</script>

@section('scripts')
<script>
    setTimeout(function(){$('.hide').slideUp();},2000);
</script>
@endsection
@endsection