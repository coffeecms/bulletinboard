<?php
if(!isset(Configs::$_['user_permissions']['BB30018']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

    $category_id=getGet('category_id','');

    $db=new Database();

    $listSmiles=$db->query("select * from bb_smiles_data where category_id='".$category_id."' order by sort_order asc");

    $theData=$db->query("select * from bb_smiles_category_data where category_id='".$category_id."'");

?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new smile','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
          <div class="col-lg-12">
              <table class="table table-hover table-striped table-valign-middle">
                  <thead>
                    <tr >
                        <th><?php echo get_text_by_lang('Image','admin');?></th>
                        <th><?php echo get_text_by_lang('Text Replace','admin');?></th>
                        <th class='text-right'><?php echo get_text_by_lang('Sort Order','admin');?></th>
                        <th class='text-right'><?php echo get_text_by_lang('Action','admin');?></th>
                    </tr>
                  </thead>
                  <tbody class='list-upload-reactions'>
                    <tr>
                          <td>&nbsp;</td>
                          <td>
                            <input type="text" class="form-control input-size-medium add-title" name="send[title]" placeholder=""  />
                          </td>
                          <td>
                            <input type="text" class="form-control input-size-medium  add-textcolor" value="#46B4D4" name="send[title]" placeholder="" style='width:90px;'  />
                          </td>
                          <td class="text-right">
                            <input type="text" class="form-control input-size-medium add-sortorder" name="send[title]" value="0" placeholder="" style="width:50px;float: right;"  />
                          </td>
                          <td class="text-right">
                          <button  title="Delete" class="btn btn-danger btn-sm btn-delete-image" data-id="sdsd"  style="margin-right:5px;" type="button"><i class="fas fa-trash"></i></button>
                          </td>
                      </tr>                  
                  </tbody>
              </table>            
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">
                          
                        <form action="" method="post" enctype="multipart/form-data"> 
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Text replace','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium edit-textreplace" name="send[title]" placeholder="<?php echo get_text_by_lang('Text replace','admin');?>" id="txtTitle" />
                        </p>
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Sort order','admin');?></strong></label>
                            <input type="text" class="form-control input-size-medium edit-sortorder" name="send[title]" id="txtTitle" />
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
                <h3 class="card-title"><?php echo get_text_by_lang('Category','admin');?>: <?php echo $theData[0]['title'];?></h3>
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
                                              <th><?php echo get_text_by_lang('Image','admin');?></th>
                                              <th><?php echo get_text_by_lang('Text replace','admin');?></th>
                                              <th class="text-right"><?php echo get_text_by_lang('Sort order','admin');?></th>
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
    pageData['listSmiles']=<?php echo json_encode($listSmiles);?>;
    pageData['theData']=<?php echo json_encode($theData);?>;
    pageData['category_id']='<?php echo $category_id;?>';
    pageData['listImages']=[];
    pageData['upload_status']=0;
    pageData['is_show_list_images']=0;
    

</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });


function prepareShowData()
{
  var total=pageData['listSmiles'].length;

  var li='';

  var td='';


  for (var i = 0; i < total; i++) {

    td+='<tr class="tr-id-'+pageData['listSmiles'][i]['smile_id']+'" style="cursor:pointer;">';
    td+='<td style="width:80px;text-align: left;">';
    td+='<button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listSmiles'][i]['smile_id']+'"><i class="fas fa-square"></i></button>';
    td+='</td>';
    td+='<td class="" data-id="'+pageData['listSmiles'][i]['smile_id']+'"><img src="'+SITE_URL+pageData['listSmiles'][i]['image_path']+'" style="border:0px;min-width:32px;max-width:32px;" /></td>';
    td+='<td class="" data-id="'+pageData['listSmiles'][i]['smile_id']+'"><span style="color:'+pageData['listSmiles'][i]['text_replace']+'">'+pageData['listSmiles'][i]['text_replace']+'</span></td>';
    td+='<td class="text-right" data-id="'+pageData['listSmiles'][i]['smile_id']+'">'+pageData['listSmiles'][i]['sort_order']+'</td>';
    
    td+='<td class="text-right" data-id="'+pageData['listSmiles'][i]['smile_id']+'">';
    td+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listSmiles'][i]['smile_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';
    td+='</td>';

    td+='</tr>';

  }

  $('.list-data').html(td);
}



    $(document).ready(function(){

        prepareShowData();
      $('.select2js').select2();

    });
 

    $(document).on('click','.btnAddNew',function(){
      // $('#modalAddnew').modal({backdrop:'static',keyboard:false});

      $('.showModalMediaManagement').trigger('click');

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

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smiles_item_action_apply', sendData).then(data => {
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


$(document).on('click','.btn-edit',function(){
  var theID=$(this).attr('data-id');

  pageData['smile_id']=theID;
  pageData['category_id']='';

  var total=pageData['listSmiles'].length;

  for (var i = 0; i < total; i++) {
    if(pageData['listSmiles'][i]['smile_id']==theID)
    {
        pageData['category_id']=pageData['listSmiles'][i]['category_id'];

      $('.edit-textreplace').val(pageData['listSmiles'][i]['text_replace']);
      $('.edit-sortorder').val(pageData['listSmiles'][i]['sort_order']);
      break;
    }
  }

  $('#modalEdit').modal('show');
});
$(document).on('click','.btnSaveEdit',function(){
  
  var sendData={};

  sendData['type']='1';
  sendData['textreplace']=$('.edit-textreplace').val().trim();
  sendData['sortorder']=$('.edit-sortorder').val().trim();
  sendData['category_id']=pageData['category_id'];
  sendData['smile_id']=pageData['smile_id'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smiles_item_edit', sendData).then(data => {
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

$(document).on('click','.btn-delete-image',function(){
  $(this).parent().parent().remove();
});

$(document).on('click','.btnSaveAdd',function(){
  
  var sendData={};

  sendData['type']='1';
  pageData['images']='';
  pageData['textreplace']='';
  pageData['sortorder']='';


  $('.add-image').each(function(){
    pageData['images']=pageData['images']+$(this).attr('src')+'||';
  });

  $('.add-textreplace').each(function(){
    pageData['textreplace']=pageData['textreplace']+$(this).val().trim()+'||';
  });


  $('.add-sortorder').each(function(){
    pageData['sortorder']=pageData['sortorder']+$(this).val().trim()+'||';
  });

  sendData['images']=pageData['images'];
  sendData['textreplace']=pageData['textreplace'];
  sendData['sortorder']=pageData['sortorder'];
  sendData['category_id']=pageData['category_id'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smile_add', sendData).then(data => {
    location.reload();
  });  

});

// masterDB['media_selected_callback']=function(theMediaUrl){
//     console.log('Added...'+theMediaUrl);
//     // pageData['new_image_path']=theMediaUrl;
//     pageData['is_show_list_images']=0;
//     pageData['listImages'].push(theMediaUrl);

//     // var li='';



//     // $('.list-upload-reactions').append(li);
//     // checkUploadReaction();
// };


setInterval(() => {

  

  if(masterDB['media_upload_status']> 0)
  {
    setIsLoading();
  }
  if(masterDB['media_upload_status']==2)
    {
      hideLoading();
      masterDB['media_upload_status']=0;
      pageData['is_show_list_images']=1;
      pageData['listImages']=masterDB['media_list'];
      $('#modalMedia').modal('hide');
      // $('.modal-backdrop').remove();

      var li='';
      var total=pageData['listImages'].length;

      var textRe='';
      
      for (var i = 0; i < total; i++) {

        textRe=genNumber(6);
        li+='<tr>';
        li+='<td><img src="'+pageData['listImages'][i]+'" class="add-image" style="border:0px;min-width:48px;max-width:48px;" /></td>';
        li+='<td>';
        li+='<input type="text" class="form-control input-size-medium add-textreplace" name="send[title]" value=":'+textRe+':" placeholder=""  />';
        li+='</td>';

        li+='<td class="text-right">';
        li+='<input type="text" class="form-control input-size-medium add-sortorder" name="send[title]" value="'+i.toString()+'" placeholder="" style="width:50px;float: right;"  />';
        li+='</td>';
        li+='<td class="text-right">';
        li+='<button  title="Delete" class="btn btn-danger btn-sm btn-delete-image" data-id="sdsd"  style="margin-right:5px;" type="button"><i class="fas fa-trash"></i></button>';
        li+='</td>';
        li+='</tr>';
      }

      $('.list-upload-reactions').html(li);

      pageData['listImages']=[];


      $('#modalAddnew').modal({backdrop:'static',keyboard:false});
    }

}, 300);





       
</script>