<?php
    if(!isset(Configs::$_['user_permissions']['BB30023']))
    {
        redirect_to(SITE_URL.'admin/notfound');
    }	


    $db=new Database();

    $queryStr='';
    $queryStr.="select a.a_id,a.title,a.status,a.content,a.forum_id,a.group_id,c.title as forum_title,b.title as group_title from bb_annoucement_data as a ";
    $queryStr.=" left join user_group_mst as b ON a.group_id=b.group_c  ";
    $queryStr.=" left join bb_forum_data as c ON a.forum_id=c.forum_id   ";
    $queryStr.=" order by a.ent_dt desc limit 0,30  ";

    $listData=$db->query($queryStr);


    $listForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
    $listSubForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");
    $listUserGroups=$db->query("select * from user_group_mst order by title asc");

    $listForums=bb_genListNestedForum($listForums,$listSubForums);

    // print_r(Configs::$_['list_forum_data']);die();

?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new annoucement','admin');?></h5>
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
                            <input type="text" class="form-control add-title input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                           
                        <p id='wrap-add-forum-id'>
                                <label><strong><?php echo get_text_by_lang('Forum','admin');?></strong></label>
                            <select name="send[parentid]" class="form-control select2js add-forum-id   ">
                            <option value="all">ALL</option>
                                <?php 
                                $li='';

                                $total=count(Configs::$_['list_forum_data']);

                                for ($i=0; $i < $total; $i++) { 
                                    $li.='<option value="'.Configs::$_['list_forum_data'][$i]['forum_id'].'">'.Configs::$_['list_forum_data'][$i]['title'].'</option>';
                                }

                                echo $li;

                                ?>
                            </select>
                        </p>
                           
                        <p id="wrap-add-usergroup-id">
                                <label><strong><?php echo get_text_by_lang('User Group','admin');?></strong></label>
                            <select name="send[parentid]" class="form-control select2js add-usergroup-id ">
                            <option value="all">ALL</option>
                            <?php 
                                $li='';

                                $total=count($listUserGroups);

                                for ($i=0; $i < $total; $i++) { 
                                    $li.='<option value="'.$listUserGroups[$i]['group_c'].'">'.$listUserGroups[$i]['title'].'</option>';
                                }

                                echo $li;

                                ?>                            
                            </select>
                        </p>
                            <p>
                            <label><strong><?php echo get_text_by_lang('Content (allow HTML content)','admin');?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' id="editor1" class="form-control add-contents  input-size-medium" name="send[descriptions]"></textarea>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit annoucement','admin');?></h5>
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
                            <input type="text" class="form-control edit-title input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                        <p id='wrap-edit-forum-id'>
                                <label><strong><?php echo get_text_by_lang('Forum','admin');?></strong></label>
                            <select name="send[parentid]" class="form-control select2js edit-forum-id  ">
                            <option value="all">ALL</option>
                                <?php 
                                $li='';

                                $total=count(Configs::$_['list_forum_data']);

                                for ($i=0; $i < $total; $i++) { 
                                    $li.='<option value="'.Configs::$_['list_forum_data'][$i]['forum_id'].'">'.Configs::$_['list_forum_data'][$i]['title'].'</option>';
                                }

                                echo $li;

                                ?>
                            </select>
                        </p>
                           
                        <p id="wrap-edit-usergroup-id">
                                <label><strong><?php echo get_text_by_lang('User Group','admin');?></strong></label>
                            <select name="send[parentid]" class="form-control select2js edit-usergroup-id ">
                            <option value="all">ALL</option>
                            <?php 
                                $li='';

                                $total=count($listUserGroups);

                                for ($i=0; $i < $total; $i++) { 
                                    $li.='<option value="'.$listUserGroups[$i]['group_c'].'">'.$listUserGroups[$i]['title'].'</option>';
                                }

                                echo $li;

                                ?>                            
                            </select>
                        </p>                           

                            <p>
                            <label><strong><?php echo get_text_by_lang('Content (allow HTML content)','admin');?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' id="editor2" class="form-control edit-html input-size-medium" name="send[descriptions]"></textarea>
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
                <h3 class="card-title"><?php echo get_text_by_lang('Annoucements','admin');?></h3>
                <div class="card-tools">
                  <!-- <a href="#" class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search"></i>
                  </a> -->
                  <span class="btn btn-tool btn-sm btnAddNew" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </span>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Title','admin');?></th>
                    <th><?php echo get_text_by_lang('Forum','admin');?></th>
                    <th><?php echo get_text_by_lang('User Group','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Action','admin');?></th>
                  </tr>
                  </thead>
                  <tbody class='body_list_data'>
                  
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
  <script src="<?php echo SITE_URL; ?>public/ckeditor/ckeditor.js"></script>

  <script>
    CKEDITOR.replace( 'editor1' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
});   
    CKEDITOR.replace( 'editor2' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
});   

    pageData['listData']=<?php echo json_encode($listData);?>;
    pageData['listUserGroups']=<?php echo json_encode($listUserGroups);?>;
    pageData['listForums']=<?php echo json_encode(Configs::$_['list_forum_data']);?>;

    pageData['page_no']='1';
    pageData['category_c']='all';
    pageData['post_c']='';
    pageData['tags']='';
    pageData['status']='all';
    pageData['post_type']='all';
    pageData['author_id']='all';
    pageData['username']='';
    pageData['title']='';
    pageData['content']='';
    pageData['tags']='';


</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });


function prepareShowPost()
{
  var total=pageData['listData'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {

    if(pageData['listData'][i]['forum_title']==null)
    {
        pageData['listData'][i]['forum_title']='ALL';
    }
    if(pageData['listData'][i]['group_title']==null)
    {
        pageData['listData'][i]['group_title']='ALL';
    }
    li+='<tr class="tr-id-'+pageData['listData'][i]['a_id']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listData'][i]['a_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['listData'][i]['title']+'</td>';
    li+='<td>'+pageData['listData'][i]['forum_title']+'</td>';
    li+='<td>'+pageData['listData'][i]['group_title']+'</td>';
    li+='<td class="text-right">';

        li+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listData'][i]['a_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';
        

    li+='</td>';
    li+='</tr>';
  }

  $('.body_list_data').html(li);
}


$(document).ready(function(){


  prepareShowPost();

  $('.select2js').select2({
    dropdownParent: $("#modalSearch")
  });

  $('.add-forum-id').select2({
    dropdownParent: $("#wrap-add-forum-id")
  });

  $('.add-usergroup-id').select2({
    dropdownParent: $("#wrap-add-usergroup-id")
  });

  $('.edit-forum-id').select2({
    dropdownParent: $("#wrap-edit-forum-id")
  });

  $('.edit-usergroup-id').select2({
    dropdownParent: $("#wrap-edit-usergroup-id")
  });


  $('.post-action').select2({
    'width':'200px'
  });

});


$(document).on('click','.btn-edit',function(){
    var a_id=$(this).attr('data-id');

    var total=pageData['listData'].length;

    pageData['editData']={};

    pageData['a_id']='';

    for (var i = 0; i < total; i++) {
        if(a_id==pageData['listData'][i]['a_id'])
        {
            pageData['editData']=pageData['listData'][i];

            pageData['a_id']=pageData['editData']['a_id'];


            if(pageData['editData']['forum_id']!='all')
            {
                $('.edit-forum-id').val(pageData['editData']['forum_id']).trigger('change');
            }
            if(pageData['editData']['group_id']!='all')
            {
                $('.edit-usergroup-id').val(pageData['editData']['group_id']).trigger('change');
            }
            
            $('.edit-title').val(pageData['editData']['title']);


            setTimeout(() => {
                CKEDITOR.instances.editor2.insertHtml(pageData['editData']['content']);
               
            }, 500);

            
            break;
        }
    }



  $('#modalEdit').modal({backdrop:'static',keyboard:false});

});
$(document).on('click','.btnAddNew',function(){
      $('#modalAddnew').modal({backdrop:'static',keyboard:false});
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

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_annoucement_action_apply', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    if(pageData['action']=='delete')
    {
      $('.btn-checkbox').each(function(){
        var id=$(this).attr('data-id');
        var checked=$(this).attr('data-checked');

        if(checked=='yes')
        {
          $('.tr-id-'+id).remove();
        }
      });
    }

    showAlert('','Action completed!');
  });  

});


$(document).on('click','.btnSaveAdd',function(){
    var sendData={};

    sendData['forum_id']=$('.add-forum-id').val().trim();
    sendData['usergroup_id']=$('.add-usergroup-id').val().trim();
    sendData['title']=$('.add-title').val().trim();
    sendData['content']=CKEDITOR.instances.editor1.getData();
    sendData['type']='1';


    if(sendData['content'].length==0)
    {
    showAlert('','Content not allow blank');return false;
    }

    if(sendData['title'].length==0)
    {
    showAlert('','Title not allow blank');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_new_annoucement', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });      
    
});
     

$(document).on('click','.btnSaveEdit',function(){
    var sendData={};

    sendData['a_id']=pageData['a_id'];
    sendData['forum_id']=$('.edit-forum-id').val().trim();
    sendData['usergroup_id']=$('.edit-usergroup-id').val().trim();
    sendData['title']=$('.edit-title').val().trim();
    sendData['content']=CKEDITOR.instances.editor2.getData();
    sendData['type']='1';


    if(sendData['content'].length==0)
    {
    showAlert('','Content not allow blank');return false;
    }

    if(sendData['title'].length==0)
    {
    showAlert('','Title not allow blank');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_annoucement', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
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