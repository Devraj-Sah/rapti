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
                <h3 class="box-title">Edit Product</h3>
                <div class="col-sm-12">
                    @include('admin.flash-message')
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-backward"
                                                                                     aria-hidden="true"></i> Back
                    </button>
                </div>
                {{ Form::open(['route'=>['products.update',$model->id],'method'=>'Put', 'enctype'=>'multipart/form-data']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label>Product Category <i class="reqr">*</i> </label>
                            {{ Form::select('category_id',['Select']+$categories->toArray(),$model->category_id,['class' => 'form-control required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label><strong>Featured Items :</strong></label><br>
                            <label><input type="checkbox" name="featured_products"
                                          value="1" {{  ($model->featured_products == 1 ? ' checked' : '') }}> Featured
                                Products</label>
                            <label><input type="checkbox" name="popular_product"
                                          value="1" {{  ($model->popular_product == 1 ? ' checked' : '') }}> Popular
                                Product</label>
                            <label><input type="checkbox" name="hot_deal"
                                          value="1" {{  ($model->hot_deal == 1 ? ' checked' : '') }}> Hot Deal</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label>Name <i class="reqr">*</i> </label>
                            {{ Form::text('name',$model->name,['class' => 'form-control required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label>Item Code   </label>
                            {{ Form::text('code',$model->code,['class' => 'form-control required']) }}
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
                                <img src="{{asset('uploads/products/'.$model->thumbnail)}}" width="200px;">
                                <a href="{{route('productImage.delete',$model->id)}}"
                                   onclick="return confirm('Are you sure to delete')" style="color: red">Remove
                                    Thumbnail</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row ">
                    <div class="form-group col-md-9">
                        <div class="form-group col-md-10">
                            {{ Form::label('Featured Image') }}
                            <div class="input-group control-group">
                                <input type="file" name="featured_image[]" class="form-control" multiple>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i
                                                class="glyphicon glyphicon-plus"></i>Add More
                                    </button>
                                </div>
                            </div>
                            <div id="featured-image">

                            </div>
                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="featured_image[]" class="form-control" multiple>
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i
                                                    class="glyphicon glyphicon-remove"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->images)
                    <div class="row">
                        <div class="form-group col-md-9">
                            <div class="form-group">
                                @foreach($model->images as  $featureImage)
                                    @if($featureImage->image)
                                        <img src="{{asset('uploads/products/featured_image/'.$featureImage->image)}}"
                                             width="100px;">
                                        <a href="{{route('productFeaturedImage.delete',$featureImage->id)}}"
                                           onclick="return confirm('Are you sure to delete')" style="color: red">Remove
                                            Featured Image</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="row col-md-12">
                    <div class="form-group col-md-7">
                        <label for="price">Pdf Upload </label>
                        <input type="file" name="pdf_file" class="form-control">
                    </div>
                </div>

                @if($model->pdf_file)
                    <div class="row">
                        <div class="form-group col-md-9">
                            <div class="form-group col-md-10">
                                <a href="{{asset('uploads/products/pdf/'.$model->pdf_file)}}" target="_blank">{{$model->name}} Attachment</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="price">Price (Rs.) </label>
                        {{ Form::text('price',$model->price,['class' => 'form-control required']) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="compare_price">Compare Price (Rs.)</label>
                        {{ Form::text('compare_price',$model->compare_price,['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="short_content_div" class="form-group col-md-12">
                            <label for="short_content">Short Content</label>
                            <textarea class="form-control ckeditor" id="short_content" name="short_desc" rows="5"
                                      placeholder="Short Content">{{$model->short_desc}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="long_content_div" class="form-group col-md-12">
                            <label for="long_content">Main Content</label>
                            <textarea class="form-control ckeditor" id="long_content" name="description" rows="10"
                                      placeholder="Main Content">{{$model->description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                        <label for="meta_title">Page Title</label>
                        <input class="form-control" type="text" id="meta_title" name="meta_title" placeholder="Page Title" value="{{$model->meta_title}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="meta_keywords">Page Keywords</label>
                        <input class="form-control" type="text" id="meta_keywords" name="meta_keywords" placeholder="Page Keywords" value="{{$model->meta_keywords}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="meta_description">Page Description</label>
                        <input class="form-control" type="text" id="meta_description" name="meta_description" placeholder="Page Description" rows="3" style="resize: none;" value="{{$model->meta_description}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-9">
                        <div class="col-md-2">
                            {{ Form::submit('Update', ['class' => 'btn btn-block btn-primary']) }}
                        </div>
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
        CKEDITOR.replace('short_content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('long_content', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

    </script>



    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-success").click(function () {
                var html = $(".clone").html();

                $("#featured-image").append(html);


            });
            $("body").on("click", ".btn-danger", function () {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endsection
