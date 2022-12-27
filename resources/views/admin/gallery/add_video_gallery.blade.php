@extends('admin.layout.master')
@section('content')
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            
            <h3 class="box-title">Add More Links</h3>  

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
          
        </div>
        </div>

        <div class="col-sm-12">
             @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>OOPS! You might have missed to fill some required fields. Please check the errors.  <strong>

            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>

             @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible col-sm-9 col-sm-offset-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{Session::get('success')}}
                </div>
            @endif

          </div>

        
          @endif
        </div>

        <div class="box-body">
        <!-- form start -->
        <form method="post" action="/admin/navigation-list/{{$category}}/{{$id}}/addVideoAlbum" enctype="multipart/form-data">
            {{csrf_field()}}
                    <div class="col-sm-12 ">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <h4 style="font-weight: bold;">Video Gallery Items</h4>
                                </td>
                                <td colspan="2">
                                    <a id="add_vg_item" class="add_item btn btn-primary pull-right" style="cursor: pointer; font-weight: bold;"><i class="fa fa-plus"></i>
                                        Add More
                                    </a>
                                </td>
                            </tr>

                            <input type="hidden" id="vg_items" value="1"/>

                            <tr>
                                <th class="border_all" style="width: 80px;">S.N</th>
                                <th class="border_all" style="width: 250px;">Name | Links</th>
                                <th class="border_all" >Content</th>
                                <th class="border_all" style="width: 200px;">Action</th>
                            </tr>
                        </thead>

                                                
                        <tbody id="vg_body">
                           
                            <tr id="tr_vg_1" class="border_all">
                                <td>
                                    <input type="number" id="vg_sort_1" name="vg_sort[]"  min="0" value="1" class="form-control"/>
                                </td>
                                
                                <td>  
                                    <input type="text" id="vg_name_1" name="vg_name[]"  class="form-control" placeholder="Name" />
                                    <input type="text" id="vg_name_nepali_1" name="vg_name_nepali[]"  class="form-control" placeholder="Nepali Name" />                                  
                                    <input type="text" id="vg_link_1" name="vg_link[]"  class="form-control" placeholder="youtube links" />
                                </td>

                                
                                <td>
                                    <textarea id="vg_content_1" name="vg_content[]" rows="2" class="form-control" placeholder="video caption" ></textarea>
                                    <textarea id="vg_content_nepali_1" name="vg_content_nepali[]" rows="2" class="form-control" placeholder="Nepali video caption" ></textarea>
                                </td>
                                 
                                <td>
                                    <a id="vg_id_1" class="btn btn-sm btn-danger vg_item_delete">Delete</a>

                                    
                                </td>
                            </tr>

                        </tbody>
                       
                    </table>

                    <input type="submit" class="btn btn-success" name="sBtn" value="Submit">
                    </div>  
           </form>
        </div>
    </div>

</section>
@endsection

@section('scripts')

<script>
    // Go back link
$('.backlink').click(function(){
  var url = '<?=url()->previous(); ?>';
  window.location=url;
});

</script>


<script>
    $(document).on('click', '#add_vg_item', function () {
        var item_no = parseInt($('#vg_items').val());
        var new_sort = parseInt($('#vg_sort_'+item_no).val()) + 1;
        item_no = ++item_no;
        $('#vg_items').val(item_no);
        var vg_item_html = '<tr id="tr_vg_'+item_no+'" class="border_all border_top">';
        vg_item_html += '<td><input type="number" id="vg_sort_'+item_no+'" name="vg_sort[]"  value="'+new_sort+'" class="form-control"/></td>';

        vg_item_html += '<td><input type="text" id="vg_name_'+item_no+'" name="vg_name[]"  class="form-control" placeholder="Name"/><input type="text" id="vg_name_nepali_'+item_no+'" name="vg_name_nepali[]"  class="form-control" placeholder="Nepali Name"/><input type="text" id="vg_link_'+item_no+'" name="vg_link[]"  class="form-control" placeholder="youtube links" /></td>';

        
        vg_item_html += '<td><textarea id="vg_content_'+item_no+'" name="vg_content[]" rows="2" class="form-control" placeholder="video caption"></textarea><textarea id="vg_content_nepali_'+item_no+'" name="vg_content_nepali[]" rows="2" class="form-control" placeholder="Nepali video caption"></textarea></td>';


        vg_item_html += '<td><a id="vg_id_'+item_no+'" class="btn btn-sm btn-danger vg_item_delete">Delete</a> </td>';

        vg_item_html += '</td>';
        vg_item_html += '</tr>';

        $('#vg_body').append(vg_item_html);
    });
        $(document).on('click', '.vg_item_delete', function(){
            var id = $(this).attr('id').replace('vg_id_', '');
            if (id.indexOf('s_') > -1) {
                if (confirm('Are you sure to delete this image from gallery?')) {
                    id = id.replace('s_', '');
                    window.location.href = 'http://himalayanwalkers.test/admin/navigation/main/delete-item'+id;
                }
            } else {
                $('#tr_vg_'+id).remove();
            }
        });
    
    </script> 





@endsection