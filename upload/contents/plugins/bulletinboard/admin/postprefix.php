<?php

if(!isset(Configs::$_['user_permissions']['BB30023']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

    $db=new Database();

    $listData=$db->query("select * from bb_post_prefix_data order by title asc");

?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new prefix','admin');?></h5>
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
                            <input type="text" class="form-control input-size-medium add-title" name="send[title]" placeholder="<?php echo get_text_by_lang('Title','admin');?>" />
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Color','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium add-color" name="send[title]" />
                        </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Status','admin');?></strong></label>
                            <select type="text" class="form-control input-size-medium add-status" name="send[title]">
                                <option value="1">Activate</option>
                                <option value="0">Deactivate</option>
                            </select>
                        </p>
                          
                        </form>     
            
                    
                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSaveAdd" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Add new','admin');?></button>
        <button type="button" class="btn btn-danger " data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit prefix','admin');?></h5>
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
                            <label><strong><?php echo get_text_by_lang('Color','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium edit-color" name="send[title]" />
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
                <h3 class="card-title"><?php echo get_text_by_lang('Post Prefixs','admin');?></h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm btnAddNew" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </a>
                 
                </div>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-hover table-striped table-valign-middle">
                  <thead>
                    <tr >
                                              <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                                              <th><?php echo get_text_by_lang('Title','admin');?></th>
                                              <th><?php echo get_text_by_lang('Color','admin');?></th>
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
 
                    <div class='col-lg-12 ' >
                      <div class="btn-group" style='float:left;' role="group" aria-label="Basic example">
                        <select class="form-control post-action select2js-nomodal" name="send[type]">
                        <option value=""><?php echo get_text_by_lang('Select an action','admin');?></option>
                        <option value="delete"><?php echo get_text_by_lang('Delete','admin');?></option>
                          
                        </select>
                        <button type="button" class="btn btn-info btnApply"><?php echo get_text_by_lang('Apply','admin');?></button>
                    </div>                      
                    


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

    td+='<tr class="tr-id-'+pageData['listData'][i]['prefix_id']+'" style="cursor:pointer;">';
    td+='<td style="width:80px;text-align: left;">';
    td+='<button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listData'][i]['prefix_id']+'"><i class="fas fa-square"></i></button>';
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['prefix_id']+'">'+pageData['listData'][i]['title'];
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['prefix_id']+'"><span style="color:'+pageData['listData'][i]['bg_color_c']+'">'+pageData['listData'][i]['bg_color_c']+'</span>';
    td+='</td>';
    td+='<td  data-id="'+pageData['listData'][i]['prefix_id']+'">'+statusCl;
    td+='</td>';

    td+='<td class="text-right">';

    td+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listData'][i]['prefix_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';

    td+='</td>';

    td+='</tr>';

  }

  $('.list-data').html(td);
}



    $(document).ready(function(){

        prepareShowData();
      $('.select2js').select2();
      $('.post-action').select2({
    'width':'200px'
  });
    });

    $(document).on('click','.btnSaveAdd',function(){
      var sendData={};

      sendData['title']=$('.add-title').val().trim();
      sendData['color']=$('.add-color').val().trim();
      sendData['status']=$('.add-status > option:selected').val().trim();
   
      sendData['type']='1';

        
      if(sendData['title'].length==0)
      {
        showAlert('','Title not allow is blank');return false;
      }
      if(sendData['color'].length==0)
      {
        showAlert('','Color not allow is blank');return false;
      }

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_post_prefix', sendData).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
        // console.log(data['error']);
        // $('.txtThumbnail').val('');
        location.reload();
      });      
        
    });

    $(document).on('click','.btnSaveEdit',function(){
      var sendData={};

      sendData['title']=$('.edit-title').val().trim();
      sendData['color']=$('.edit-color').val().trim();
      sendData['status']=$('.edit-status > option:selected').val().trim();
      sendData['prefix_id']=pageData['edit_id'];
   
      sendData['type']='1';

        
      if(sendData['title'].length==0)
      {
        showAlert('','Title not allow is blank');return false;
      }
      if(sendData['color'].length==0)
      {
        showAlert('','Color not allow is blank');return false;
      }

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_post_prefix', sendData).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
        // console.log(data['error']);
        // $('.txtThumbnail').val('');
        location.reload();
      });      
        
    });
 

    $(document).on('click','.btnAddNew',function(){
      $('#modalAddnew').modal({backdrop:'static',keyboard:false});
    });

    $(document).on('click','.btn-edit',function(){
      var id=$(this).attr('data-id');

        var total=pageData['listData'].length;

        pageData['edit_id']=id;
      for (var i = 0; i < total; i++) {
          if(pageData['listData'][i]['prefix_id']==id)
          {

            if(pageData['listData'][i]['bg_color_c']==null)
            {
                pageData['listData'][i]['bg_color_c']='';
            }

            $('.edit-title').val(pageData['listData'][i]['title']);
            $('.edit-color').val(pageData['listData'][i]['bg_color_c']);
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

$(document).on('click','.btnApply',function(){
  pageData['list_id']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_id']+=id+',';
    }
    
  });

  var sendData={};

 

  sendData['type']='1';
 
  sendData['list_id']=pageData['list_id'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_post_prefix_action_apply', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    if(pageData['action']=='delete')
    {
      $('.btn-checkbox').each(function(){
        var id=$(this).attr('data-id');
        var checked=$(this).attr('data-checked');

        // if(checked=='yes')
        // {
        //   $('.tr-id-'+id).remove();
        // }
      });
    }

    location.reload();
  });  

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