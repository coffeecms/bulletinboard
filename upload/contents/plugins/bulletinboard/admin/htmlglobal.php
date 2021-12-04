<?php
		if(!isset(Configs::$_['user_permissions']['BB30023']))
		{
			redirect_to(SITE_URL.'admin/notfound');
		}	

        
    $db=new Database();

    $listData=$db->query("select html_c,title,content from bb_html_global_data order by title asc");

?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new PHP Hook','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">
                          
                        <form action="" method="post" enctype="multipart/form-data"> 
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Key name','admin');?></strong></label>
                            <input type="text" class="form-control add-code input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                           
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Title','admin');?></strong></label>
                            <input type="text" class="form-control add-title input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                           

                            <p>
                            <label><strong><?php echo get_text_by_lang('PHP code (allow HTML content)','admin');?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' class="form-control add-html input-size-medium" name="send[descriptions]"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit PHP Hook','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">
                          
                        <form action="" method="post" enctype="multipart/form-data"> 
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Key name','admin');?></strong></label>
                            <input type="text" disabled class="form-control edit-code input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                           
       
                        <p>
                            <label><strong><?php echo get_text_by_lang('Title','admin');?></strong></label>
                            <input type="text" class="form-control edit-title input-size-medium " name="send[title]"  id="txtTitle" />
                        </p>
                           

                            <p>
                            <label><strong><?php echo get_text_by_lang('PHP code (allow HTML content)','admin');?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' class="form-control edit-html input-size-medium" name="send[descriptions]"></textarea>
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
                <h3 class="card-title"><?php echo get_text_by_lang('PHP Hook','admin');?></h3>
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
                    <th><?php echo get_text_by_lang('Key','admin');?></th>
                    <th><?php echo get_text_by_lang('Title','admin');?></th>
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

<script>
    pageData['listData']=<?php echo json_encode($listData);?>;

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

    li+='<tr class="tr-id-'+pageData['listData'][i]['html_c']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listData'][i]['html_c']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['listData'][i]['html_c']+'</td>';
    li+='<td>'+pageData['listData'][i]['title']+'</td>';
    li+='<td class="text-right">';

        li+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listData'][i]['html_c']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';
        

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
  $('.post-action').select2({
    'width':'200px'
  });

});


$(document).on('click','.btn-edit',function(){
    var html_c=$(this).attr('data-id');

    var total=pageData['listData'].length;

    pageData['editData']={};

    pageData['html_c']='';

    for (var i = 0; i < total; i++) {
        if(html_c==pageData['listData'][i]['html_c'])
        {
            pageData['editData']=pageData['listData'][i];

            pageData['html_c']=pageData['editData']['html_c'];

            $('.edit-code').val(pageData['editData']['html_c']);
            $('.edit-html').val(pageData['editData']['content']);
            $('.edit-title').val(pageData['editData']['title']);
            
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
  pageData['list_html_c']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_html_c']+=id+',';
    }
    
  });

  var sendData={};

 

  sendData['type']='1';
 
  sendData['list_html_c']=pageData['list_html_c'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_html_global_action_apply', sendData).then(data => {
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

    sendData['code']=$('.add-code').val().trim();
    sendData['title']=$('.add-title').val().trim();
    sendData['content']=$('.add-html').val();
    sendData['type']='1';


    if(sendData['code'].length==0)
    {
    showAlert('','Key name not allow is blank');return false;
    }

    if(sendData['title'].length==0)
    {
    showAlert('','Title not allow is blank');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_new_htmlglobal', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });      
    
});
     

$(document).on('click','.btnSaveEdit',function(){
    var sendData={};

    sendData['code']=pageData['html_c'];
    sendData['title']=$('.edit-title').val().trim();
    sendData['content']=$('.edit-html').val();
    sendData['type']='1';


    if(sendData['code'].length==0)
    {
    showAlert('','Key name not allow is blank');return false;
    }

    if(sendData['title'].length==0)
    {
    showAlert('','Title not allow is blank');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_htmlglobal', sendData).then(data => {
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