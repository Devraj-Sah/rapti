@inject('category_helper','App\Helpers\CategoryHelper')
<?php $categories = $category_helper->getCategoriesForDropdown() ?>
@extends('admin.layout.master')
@section('style')
    <style>
        .reqr {
            color: red;
        }

        .border_all {
            border: 1px solid #000 !important;
        }

        table {
            max-width: 99% !important;
            margin: 0 auto;
            padding: 0;
        }
    </style>

@endsection
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Product Category</h3>
                <div class="col-sm-12">
                    @include('admin.flash-message')
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-backward"
                                                                                     aria-hidden="true"></i> Back
                    </button>
                </div>
                {{ Form::open(['route'=>['product-categories.update',$model->id],'method'=>'Put', 'enctype'=>'multipart/form-data']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label>Parent ID </label>
                            {{ Form::select('parent_id',['select']+$categories->toArray(),$model->parent_id,['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label for="nav_name">Name <i class="reqr">*</i> </label>
                            {{ Form::text('name',$model->name,['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-2">
                            <label for="position">Position <i class="reqr">*</i> </label>
                            <input type="number" min="0" class="form-control {{ $errors->has('position') ? 'has-error' : '' }}" name="position" id="position" required="required" value="{{$model->position}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label for="code">Code <i class="reqr">*</i> </label>
                            {{ Form::text('code',$model->code,['class' => 'form-control','required'=>'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="side_banner" id="side_banner" value="1" @if($model->side_banner) checked @endif>
                                <label class="form-check-label" for="side_banner">Side Banner</label>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="feature" id="feature" value="1"  @if($model->feature) checked @endif>
                                <label class="form-check-label" for="feature">Feature</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-9">
                        <div class="form-group col-md-10">
                            <label for="banner_image">Thumbnail</label>
                            <input class="form-control" type="file" name="thumbnail">
                        </div>
                    </div>
                </div>
                @if($model->thumbnail)
                    <div class="row">
                        <div class="form-group col-md-9">
                            <div class="form-group col-md-10">
                                <img src="{{asset('uploads/category/'.$model->thumbnail)}}" width="200px;">
                                <a href="#" onclick="return confirm('Are you sure to delete')" style="color: red">Remove
                                    Thumbnail</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="description">Main Content</label>
                        <textarea class="form-control ckeditor" id="description" name="description" rows="10"
                                  placeholder="Main Content">{{$model->description}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        {{ Form::submit('Update', ['class' => 'btn btn-block btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#go_to_save', function () {
            goToByScroll('nav_save');
        });

        function goToByScroll(id) {
            $('html,body').animate({scrollTop: $("#" + id).offset().top}, '500');
        }


        //back
        $(document).ready(function () {
            $('.backlink').click(function () {
                parent.history.back();
                return false;
            });
        });
    </script>



    <!--Youtube link  -->
    <script>
        $(document).on('keyup', '#video_link', function () {
            var y_link = $(this).val();
            if (embed_link = validateYouTubeUrl(y_link)) {
                $(this).val(embed_link);
            } else {
                $(this).val('');
                alert('Youtube Link is Invalid !');
            }
        });
    </script>


    <script>
        $('#nav_name').on('keyup', function () {
            var nav_name;
            nav_name = $('#nav_name').val();
            $('#page_keyword').val(nav_name);
            nav_name = nav_name.replace(/[^a-zA-Z0-9 ]+/g, "");
            nav_name = nav_name.replace(/\s+/g, "-");
            var pathArray = window.location.pathname.split('/');
            var url = "{{ url('/duplicate_alias') }}" + '/' + pathArray[2] + '/' + nav_name;

            $('#alias').val(nav_name.toLowerCase());
        });
    </script>
    <!-- end alias script -->

    <!-- page type script -->
    <script>

        $('#page_type').on('change', function () {

            var page_type = $('#page_type').val();
            if ((page_type == 'Normal') || (page_type == 'Group')) {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').show();
                $('#long_content_nepali_div').show();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Photo Gallery') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').show();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Video Gallery') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').show();
                $('#slider_div').hide();

            } else if (page_type == 'File Group') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Page Link') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Link') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').show();
                $('#url_link').prop('required', true);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Slider') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').show();

            } else if (page_type == 'Attachment') {
                $('#short_content_div').show();
                $('#short_content_nepali_div').show();
                $('#long_content_div').hide();
                $('#long_content_nepali_div').hide();
                $('#attachment_div').show();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#main_attachment').hide();
            }
        });


    </script>

    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });




    </script>





@endsection