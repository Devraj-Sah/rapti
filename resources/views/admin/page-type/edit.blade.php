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
                <h3 class="box-title">Edit PageType</h3>
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
                {{ Form::open(['route'=>['pageType.update',$model->sort],'method'=>'PUT']) }}
                    <div class="row">
                        <div class="col-md-9" style="padding-top: 10px;">
                            <div class="form-group col-md-10">
                                <label for="nav_name">Name <i class="reqr">*</i> </label>
                                {{ Form::text('page_type_title',$model->page_type_title, ['class' => 'form-control', 'required' => 'required','placeholder'=>'PageType Title']) }}
                            </div>
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
        CKEDITOR.replace('short_content', {
            toolbar: [
                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-', 'RemoveFormat']
                },
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize']}
            ],
            uiColor: '#3c8dbc',
            height: '100px',
            enterMode: CKEDITOR.ENTER_BR,
            filebrowserWindowWidth: '400',
            filebrowserWindowHeight: '300'
        });

        CKEDITOR.replace('short_content_nepali', {
            toolbar: [
                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-', 'RemoveFormat']
                },
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize']}
            ],
            uiColor: '#3c8dbc',
            height: '100px',
            enterMode: CKEDITOR.ENTER_BR,
            filebrowserWindowWidth: '400',
            filebrowserWindowHeight: '300'
        });

    </script>

    <script>
        CKEDITOR.replace('long_content', {
            toolbar: [
                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll']
                },
                '/',
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe']},
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                },
                {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                '/',
                {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize']},
                {name: 'others', items: ['-']}
            ],
            uiColor: '#3c8dbc',
            height: '200px',
            enterMode: CKEDITOR.ENTER_BR,
            filebrowserWindowWidth: '400',
            filebrowserWindowHeight: '300',
            filebrowserBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserFlashBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html?type=Flash")}}',
            filebrowserUploadUrl: '{{asset("assetsckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
            filebrowserImageUploadUrl: '{{asset("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
            filebrowserFlashUploadUrl: '{{asset("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',

        });

        CKEDITOR.replace('long_content_nepali', {
            toolbar: [
                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll']
                },
                '/',
                {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe']},
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                },
                {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                '/',
                {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize']},
                {name: 'others', items: ['-']}
            ],
            uiColor: '#3c8dbc',
            height: '200px',
            enterMode: CKEDITOR.ENTER_BR,
            filebrowserWindowWidth: '400',
            filebrowserWindowHeight: '300',
            filebrowserBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserFlashBrowseUrl: '{{asset("assets/ckfinder/ckfinder.html?type=Flash")}}',
            filebrowserUploadUrl: '{{asset("assetsckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
            filebrowserImageUploadUrl: '{{asset("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
            filebrowserFlashUploadUrl: '{{asset("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',

        });
    </script>





@endsection