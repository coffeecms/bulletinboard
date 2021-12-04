<?php

if(!isset(Configs::$_['user_permissions']['BB30023']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

    $db=new Database();

    $listData=$db->query("select * from bb_bbcode_data order by upd_dt asc");

?>


<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit bbcode','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">
                          
                        <form action="" method="post" enctype="multipart/form-data"> 
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Title','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium edit-title" name="send[title]" placeholder="<?php echo get_text_by_lang('Title','admin');?>" />
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Tag name','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium edit-tag" name="send[title]" />
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Replace Data','admin');?></strong>: <i>{{value}}, {{param_1_name}}... {{param_n_name}}</i></label>
                            <textarea type="text" class="form-control input-size-medium edit-replacedata" style='min-height:100px;' name="send[title]"></textarea>
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Example','admin');?></strong></label>
                            <textarea type="text" class="form-control input-size-medium edit-example" style='min-height:100px;' name="send[title]"></textarea>
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Descriptions','admin');?></strong></label>
                            <textarea type="text" class="form-control input-size-medium edit-descriptions" style='min-height:100px;' name="send[title]"></textarea>
                        </p>

                        <p>
                            <label><strong><?php echo get_text_by_lang('Status','admin');?></strong></label>
                            <select type="text" class="form-control input-size-medium edit-status" name="send[title]">
                                <option value="1">Activate</option>
                                <option value="0">Deactivate</option>
                            </select>
                        </p>     
                        </form>     
            
                    
                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSaveEdit" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Save changes','admin');?></button>
        <button type="button" class="btn btn-danger " data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
      </div>
    </div>
  </div>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
                    <div class="col-lg-12">
                    <form action="" method="post" enctype="multipart/form-data">

                    <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                <h3 class="card-title"><?php echo get_text_by_lang('BBCode','admin');?></h3>
                <div class="card-tools">
                  <!-- <a href="#" class="btn btn-tool btn-sm btnAddNew" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </a>
                  -->
                </div>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-hover table-striped table-valign-middle">
                  <thead>
                    <tr >
                                              <th><?php echo get_text_by_lang('Title','admin');?></th>
                                              <th><?php echo get_text_by_lang('Tag','admin');?></th>
                                              <th><?php echo get_text_by_lang('Example','admin');?></th>
                                              <th><?php echo get_text_by_lang('Descriptions','admin');?></th>
                                              <th><?php echo get_text_by_lang('Status','admin');?></th>
                                              <th class="text-right"><?php echo get_text_by_lang('Action','admin');?></th>
                                          </tr>
                  </thead>
                  <tbody class='list-data'>
                  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
                  
                    </form>
                    </div>
 
                                    
                    
                </div>
        <!-- /.row -->


        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>
    pageData['listData']=<?php echo json_encode($listData);?>;

</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });

function prepareShowData()
{
  var total=pageData['listData'].length;

  var li='';

  var td='';

var statusCl='';
  for (var i = 0; i < total; i++) {

    if(parseInt(pageData['listData'][i]['status'])==1)
    {
        statusCl='<span class="text-success">Activated</span>';
    }
    else
    {
        statusCl='<span class="text-danger">Deativated</span>';
    }

    td+='<tr class="tr-id-'+pageData['listData'][i]['bbcode_id']+'" style="cursor:pointer;">';
  
    td+='<td  data-id="'+pageData['listData'][i]['bbcode_id']+'">'+pageData['listData'][i]['title'];
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['bbcode_id']+'">'+pageData['listData'][i]['tagname'];
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['bbcode_id']+'">'+pageData['listData'][i]['example_str'];
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['bbcode_id']+'">'+pageData['listData'][i]['descriptions'];
    td+='</td>';

    td+='<td  data-id="'+pageData['listData'][i]['bbcode_id']+'">'+statusCl;
    td+='</td>';

    td+='<td class="text-right">';

    td+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listData'][i]['bbcode_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';

    td+='</td>';

    td+='</tr>';

  }

  $('.list-data').html(td);
}



    $(document).ready(function(){

        prepareShowData();
      $('.select2js').select2();
      $('.select2js-nomodal').select2();

      $('.edit-status').select2({
            dropdownParent: $("#modalEdit")
      });
    });



    $(document).on('click','.btnSaveEdit',function(){
      var sendData={};

      sendData['title']=$('.edit-title').val().trim();
      sendData['tagname']=$('.edit-tag').val().trim();
      sendData['replace_data']=$('.edit-replacedata').val().trim();
      sendData['example_str']=$('.edit-example').val().trim();
      sendData['descriptions']=$('.edit-descriptions').val().trim();
      sendData['status']=$('.edit-status > option:selected').val().trim();
      sendData['bbcode_id']=pageData['edit_id'];
   
      sendData['type']='1';

        
      if(sendData['title'].length==0)
      {
        showAlert('','Title not allow is blank');return false;
      }
        
      if(sendData['tagname'].length==0)
      {
        showAlert('','Tag name not allow is blank');return false;
      }

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_bbcode', sendData).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
        // console.log(data['error']);
        // $('.txtThumbnail').val('');
        location.reload();
      });      
        
    });
 


    $(document).on('click','.btn-edit',function(){
      var id=$(this).attr('data-id');

        var total=pageData['listData'].length;

        pageData['edit_id']=id;
      for (var i = 0; i < total; i++) {
          if(pageData['listData'][i]['bbcode_id']==id)
          {


            $('.edit-title').val(pageData['listData'][i]['title']);
            $('.edit-tag').val(pageData['listData'][i]['tagname']);
            $('.edit-replacedata').val(pageData['listData'][i]['replace_data']);
            $('.edit-example').val(pageData['listData'][i]['example_str']);
            $('.edit-descriptions').val(pageData['listData'][i]['descriptions']);
            $('.edit-status').val(pageData['listData'][i]['status']).trigger('change');

            $('#modalEdit').modal({backdrop:'static',keyboard:false});

            break;
          }
          
      }
    });


//btn-checkbox
$(document).on('click','.btn-checkbox',function(){
  var checked=$(this).attr('data-checked');

  if(checked=='no')
  {
    $(this).attr('data-checked','yes');
    $(this).html('<i class="fas fa-check-square"></i>').addClass('btn-success');
  }
  else
  {
    $(this).attr('data-checked','no');
    $(this).html('<i class="fas fa-square"></i>').removeClass('btn-success');
  }
});



$(document).on('click','.btn-checkall',function(){
  var checked=$(this).attr('data-checked');

  if(checked=='no')
  {
    $(this).attr('data-checked','yes');
    $(this).html('<i class="fas fa-check-square"></i>').addClass('btn-success');

    $('.btn-checkbox').attr('data-checked','yes').html('<i class="fas fa-check-square"></i>').addClass('btn-success');
  }
  else
  {
    $(this).attr('data-checked','no');
    $(this).html('<i class="fas fa-square"></i>').removeClass('btn-success');

    $('.btn-checkbox').attr('data-checked','no').html('<i class="fas fa-square"></i>').removeClass('btn-success');
  }
});

       
</script>