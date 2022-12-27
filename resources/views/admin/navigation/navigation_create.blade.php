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
                <h3 class="box-title">New Navigation for {{$category}} Category</h3>
                <div class="col-sm-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            <strong>OOPS! You might have missed to fill some required fields. Please check the errors.
                            </strong>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-backward"
                                                                                     aria-hidden="true"></i> Back
                    </button>
                </div>

            </div>
            <form method="post" action="/admin/navigation-list/{{$category}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-md-9" style="padding-top: 10px;">
                    <div class="form-group col-md-10">
                        <label for="nav_name">Name <i class="reqr">*</i> (For Admin and Slug) </label>
                        <input type="text" class="form-control {{ $errors->has('nav_name') ? 'has-error' : '' }}"
                               id="nav_name" name="nav_name" placeholder="Navigation Name" value="{{old('nav_name')}}"
                               required="required">
                        <br>

                    </div>

                    <div class="form-group col-md-2">
                        <label for="position">Position <i class="reqr">*</i> </label>
                        <input type="number" min="0"
                               class="form-control {{ $errors->has('position') ? 'has-error' : '' }}" name="position"
                               id="position" required="required" value="{{$next_position}}">
                    </div>

                    <div class="form-group col-md-10">
                        <label for="caption">Caption <i class="reqr">*</i> (Page/Navigation Title)</label>
                        <input class="form-control {{ $errors->has('caption') ? 'has-error' : '' }}" type="text"
                               id="caption" name="caption" placeholder="Caption" value="{{old('caption')}}"
                               required="required">
                    </div>

                    <div id="url_link_div" class="form-group col-md-10" style="display: none;">
                        <label for="link_url">URL Link <i class="reqr">*</i></label>
                        <input class="form-control {{ $errors->has('link') ? 'has-error' : '' }}" type="text"
                               id="link_url" name="link" placeholder="URL Link" value="{{old('link')}}">
                    </div>


                    <div id="attachment_div" class="form-group col-md-10" style="display: none">
                        <label for="attachment">Attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>

                    <div class="clearfix"></div>

                    <div id="short_content_div" class="form-group col-md-12">
                        <label for="short_content">Short Content</label>
                        <textarea class="form-control ckeditor" id="short_content" name="short_content" rows="5"
                                  placeholder="Short Content">{{old('short_content')}}</textarea>
                    </div>

                    <div id="long_content_div" class="form-group col-md-12">
                        <label for="long_content">Main Content</label>
                        <textarea class="form-control ckeditor" id="long_content" name="long_content" rows="10"
                                  placeholder="Main Content">{{old('long_content')}}</textarea>
                    </div>
                </div>

                <div class="col-md-3" style="padding-top: 10px;">

                    <div class="form-group col-md-12">
                        <button type="submit" id="nav_save" name="nav_save" class="btn btn-block btn-primary full_width"
                                title="Click to Save" action="#go_to_save">Save
                        </button>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="extra_one_url">Event Start Date <i class="reqr">*</i></label>
                        <input class="form-control {{ $errors->has('extra_one') ? 'has-error' : '' }}" type="date"
                               id="extra_one" name="extra_one" placeholder="Date" value="{{old('extra_one')}}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="extra_two">Event End Date <i class="reqr">*</i></label>
                        <input class="form-control {{ $errors->has('extra_two') ? 'has-error' : '' }}" type="date"
                               id="extra_two" name="extra_two" placeholder="Date" value="{{old('extra_two')}}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="is_active">Display Status <i class="reqr">*</i></label>
                        <select class="form-control" id="is_active" name="page_status">
                            <option value="1">Active</option>
                            <option value="0">De-active</option>
                        </select>
                    </div>

                    <div class="clearfix"></div>

                    <?php $page_types = App\Models\PageType::get(); ?>

                    <div class="form-group col-md-12">
                        <label for="page_type">Page Type <i class="reqr">*</i></label>
                        <select class="form-control" name="page_type" id="page_type"
                                required="">  @foreach($page_types as $type)
                                <option value="{{$type->page_type_title}}">{{$type->page_type_title}}</option>
                            @endforeach

                        </select>
                    </div>


                    <!--/.parent_id_div-->
                    <div id="parent_id_div" class="form-group col-md-12">
                        <label for="parent_page_id">Parent Navigation <i class="reqr">*</i></label>
                        <select class="form-control" name="parent_page_id" required>
                            <option value="0">----none-----</option>
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->nav_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--/.end parent_id_div-->

                    <!-- <div class="form-group col-md-12">-->
                    <!--    <label for="page_template">Page Template <i class="reqr">*</i></label>   -->
                    <!--    <select class="form-control" name="page_template" id="page_template" required=""> -->
                    <!--        <option value="Normal">Normal</option>-->
                    <!--        <option value="None">None</option>                                  -->
                    <!--    </select>-->
                    <!--</div>-->


                    <div class="form-group col-md-12">
                        <label for="icon_image">Icon Image </label>
                        <input type="file" class="form-control" id="icon_image" name="icon_image">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="featured_image">Featured Image </label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="icon_image_caption">Extra Caption</label>
                        <input class="form-control" type="text" id="icon_image_caption" name="icon_image_caption"
                               placeholder="Extra Caption" value="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="banner_image">Banner Image <i class="reqr">*</i></label><br>
                        <label for="banner_image">Slider Image size 1138x464</label>
                        <label for="banner_image">Executive Committe 388x449</label>
                        <input class="form-control" type="file" id="banner_image" name="banner_image">
                    </div>

                    <div id="main_attachment" class="form-group col-md-10">
                        <label for="main_attachment">Main Attachment</label>
                        <input type="file" class="form-control" id="main_attachment" name="main_attachment">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="page_title">Page Title</label>
                        <input class="form-control" type="text" id="page_title" name="page_title"
                               placeholder="Page Title" value="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="page_keyword">Page Keywords</label>
                        <input class="form-control" type="text" id="page_keyword" name="page_keyword"
                               placeholder="Page Keywords" value="">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="page_description">Page Description</label>
                        <textarea class="form-control" type="text" id="page_description" name="page_description"
                                  placeholder="Page Description" rows="3" style="resize: none;"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="is_active">Navigation Status <i class="reqr">*</i></label>
                        <select class="form-control" id="is_active" name="nav_status">
                            <option value="0">De-active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-12">
                    <a class="btn btn-info form-control" id="go_to_save">Go to Save Button</a>

                </div>
            </form>
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
       /* $('#nav_name').on('keyup', function () {
            var nav_name;
            nav_name = $('#nav_name').val();
            $('#page_keyword').val(nav_name);
            nav_name = nav_name.replace(/[^a-zA-Z0-9 ]+/g, "");
            nav_name = nav_name.replace(/\s+/g, "-");
            var pathArray = window.location.pathname.split('/');
            var url = "{{ url('/duplicate_alias') }}" + '/' + pathArray[2] + '/' + nav_name;

            $('#alias').val(nav_name.toLowerCase());
        });*/
    </script>
    <!-- end alias script -->

    <!-- page type script -->
    <script>

        $('#page_type').on('change', function () {

            var page_type = $('#page_type').val();
            if ((page_type == 'Normal') || (page_type == 'Group')) {
                $('#short_content_div').show();
                $('#long_content_div').show();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Photo Gallery') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').show();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Video Gallery') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').show();
                $('#slider_div').hide();

            } else if (page_type == 'File Group') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Page Link') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Link') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').show();
                $('#url_link').prop('required', true);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').hide();

            } else if (page_type == 'Slider') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
                $('#attachment_div').hide();
                $('#url_link_div').hide();
                $('#url_link').prop('required', false);
                $('#photo_gallery_div').hide();
                $('#video_gallery_div').hide();
                $('#slider_div').show();

            } else if (page_type == 'Attachment') {
                $('#short_content_div').show();
                $('#long_content_div').hide();
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
        CKEDITOR.replace('short_content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('long_content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

    </script>


@endsection