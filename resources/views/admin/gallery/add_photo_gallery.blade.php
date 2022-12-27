@extends('admin.layout.master')
@section('content')
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            
            <h3 class="box-title">Add More Items</h3>  

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-default btn-sm backlink"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
          
        </div>
        </div>

        <div class="col-sm-12">
             @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>OOPS! You might have missed to fill some required fields. Please check the errors.<strong>
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
        <form method="post" action="/admin/navigation-list/{{$category}}/{{$id}}/addAlbum" enctype="multipart/form-data">
            {{csrf_field()}}
                    <div class="col-sm-12 ">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <h4 style="font-weight: bold;"> Gallery Items</h4>
                                </td>
                                <td colspan="2">
                                    <a id="add_pg_item" class="add_item btn btn-primary pull-right" style="cursor: pointer; font-weight: bold;"><i class="fa fa-plus"></i>
                                        Add More
                                    </a>
                                </td>
                            </tr>

                            <input type="hidden" id="pg_items" value="1"/>

                            <tr>
                                <th class="border_all" style="width: 80px;">S.N</th>
                                <th class="border_all" style="width: 250px;">Name | Image</th>
                                <th class="border_all" >Caption</th>
                                <th class="border_all" style="width: 200px;">Action</th>
                            </tr>
                        </thead>

                                                
                        <tbody id="pg_body">
                           
                            <tr id="tr_pg_1" class="border_all">
                                <td>
                                    <input type="number" id="pg_sort_1" name="pg_sort[]"  min="0" value="1" class="form-control"/>
                                </td>
                                
                                <td>  
                                    <input type="text" id="pg_name_1" placeholder="Name" name="pg_name[]"  class="form-control" />
                                    <input type="text" id="pg_name_nepali_1" placeholder="Nepali Name" name="pg_name_nepali[]"  class="form-control" />
                                    <input type="text" id="pg_link_1" placeholder="Link (if any)" name="pg_link[]"  class="form-control" />                                  
                                    <input type="file" id="pg_file_1" name="pg_file[]"  class="form-control pg_file" />
                                </td>
                                
                                <td>
                                    <textarea id="pg_caption_1" name="pg_caption[]" rows="2" class="form-control" placeholder="Image Caption"></textarea>
                                    <textarea id="pg_caption_nepali_1" name="pg_caption_nepali[]" rows="2" class="form-control" placeholder="Nepali Image Caption"></textarea>
                                </td>
                                 
                                <td>
                                    <a id="pg_id_1" class="btn btn-sm btn-danger pg_item_delete">Delete</a>

                                    
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
    $(document).on('click', '#add_pg_item', function () {
        var item_no = parseInt($('#pg_items').val());
        var new_sort = parseInt($('#pg_sort_'+item_no).val()) + 1;
        item_no = ++item_no;
        $('#pg_items').val(item_no);
        var pg_item_html = '<tr id="tr_pg_'+item_no+'" class="border_all border_top">';
        pg_item_html += '<td><input type="number" id="pg_sort_'+item_no+'" name="pg_sort[]"  value="'+new_sort+'" class="form-control"/></td>';

        pg_item_html += '<td><input type="text" id="pg_name_'+item_no+'" name="pg_name[]" placeholder="Name" class="form-control"/><input type="text" id="pg_name_nepali_'+item_no+'" name="pg_name_nepali[]"  placeholder="Nepali Name" class="form-control"/><input type="text" id="pg_link_'+item_no+'" name="pg_link[]"  placeholder="Link (if any)" class="form-control"/><input type="file" id="pg_file_'+item_no+'" name="pg_file[]"  class="form-control pg_file"/></td>';

        
        pg_item_html += '<td><textarea id="pg_caption_'+item_no+'" name="pg_caption[]" rows="2" class="form-control" placeholder="Image Caption"></textarea><textarea id="pg_caption_nepali_'+item_no+'" name="pg_caption_nepali[]" rows="2" class="form-control" placeholder="Nepali Image Caption"></textarea></td>';


        pg_item_html += '<td><a id="pg_id_'+item_no+'" class="btn btn-sm btn-danger pg_item_delete">Delete</a> </td>';

        pg_item_html += '</td>';
        pg_item_html += '</tr>';

        $('#pg_body').append(pg_item_html);
    });
        $(document).on('click', '.pg_item_delete', function(){
            var id = $(this).attr('id').replace('pg_id_', '');
            if (id.indexOf('s_') > -1) {
                if (confirm('Are you sure to delete this image from gallery?')) {
                    id = id.replace('s_', '');
                    window.location.href = 'http://himalayanwalkers.test/admin/navigation/main/delete-item'+id;
                }
            } else {
                $('#tr_pg_'+id).remove();
            }
        });
    
    </script> 





@endsection