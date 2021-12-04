<?php

if(!isset(Configs::$_['user_permissions']['BB30015']))
{
  redirect_to(SITE_URL.'admin/notfound');
}

		$db=new Database();

    $forum_id=getGet('forum_id','');

    $queryStr=" SELECT a.forum_id,a.user_id,b.username,b.email,b.fullname,c.total_per";
    $queryStr.=" FROM bb_forum_user_permission_data as a join user_mst as b ON a.user_id=b.user_id";
    $queryStr.=" join (";
    $queryStr.=" select user_id,forum_id,count(*) as total_per";
    $queryStr.=" from bb_forum_user_permission_data group by user_id,forum_id ";
    $queryStr.=" ) as c ON a.user_id=c.user_id AND a.forum_id=c.forum_id";
    $queryStr.=" where a.forum_id='".$forum_id."'";
    // $queryStr.=" group by a.forum_id,a.user_id";

    $theList=$db->query($queryStr);

    $listPermissions=$db->query("select * from permissions_mst where LEFT(permission_c,3)='BB2' order by title asc");
    $listUserPermissions=$db->query("select * from bb_forum_user_permission_data where forum_id='".$forum_id."'");

   

?>

<!-- Modal -->
<div class="modal fade" id="modalAdd"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Add permission to user','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

      <p>
        <label><strong><?php echo get_text_by_lang('Username or email','admin');?></strong></label>
          <input type='text' class='form-control add-username' />
      </p> 

      <p>
        <label><strong><?php echo get_text_by_lang('Permissions','admin');?></strong></label> <button type='button' class='btn btn-primary btnSetAllPerAdd btn-xs'><?php echo get_text_by_lang('All','admin');?></button>
          <select class="form-control add-permissions add-select2js" multiple="multiple" name="send[type]">
          
          </select>
      </p> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnAddUserPer" ><i class="fas fa-ok"></i> <?php echo get_text_by_lang('Add new','admin');?></button>
        <button type="button" class="btn btn-danger btnCloseAlert" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Edit user permission','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

      <p>
        <label><strong><?php echo get_text_by_lang('Permissions','admin');?></strong></label> <button type='button' class='btn btn-primary btnSetAllPerEdit btn-xs'><?php echo get_text_by_lang('All','admin');?></button>
          <select class="form-control edit-permissions edit-select2js" multiple="multiple" name="send[type]">
          
          </select>
      </p> 


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnSaveUserPer" ><i class="fas fa-ok"></i> <?php echo get_text_by_lang('Save changes','admin');?></button>
        <button type="button" class="btn btn-danger btnCloseAlert" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
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
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                  <!-- <a href="#" class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search"></i>
                  </a> -->
                  <a href="#" class="btn btn-tool btn-sm btn-add-user" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </a>               
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Username','admin');?></th>
                    <th><?php echo get_text_by_lang('Email','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Total Permission','admin');?></th>
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
    pageData['theList']=<?php echo json_encode($theList);?>;
    pageData['listPermissions']=<?php echo json_encode($listPermissions);?>;
    pageData['listUserPermissions']=<?php echo json_encode($listUserPermissions);?>;
    pageData['forum_id']=<?php echo $forum_id;?>;


</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });

function prepareShowEditUserData()
{
  if(typeof pageData['user_data']=='object' && typeof pageData['user_data'][0]=='object')
  {
    $('.edit-fullname').val(pageData['user_data'][0]['fullname']);
    $('.edit-username').val(pageData['user_data'][0]['username']);
    $('.edit-password').val('');
    $('.edit-email').val(pageData['user_data'][0]['email']);
    $('.edit-group').val(pageData['user_data'][0]['group_c']).trigger('change');
    $('.edit-level').val(pageData['user_data'][0]['level_c']).trigger('change');

    pageData['user_c_edit']=pageData['user_data'][0]['user_id'];

    $('#modalEdit').modal({backdrop:'static',keyboard:false});
  }
}
function preparelistData()
{
  var total=pageData['theList'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {


    li+='<tr class="tr-id-'+pageData['theList'][i]['user_id']+' ">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['theList'][i]['user_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td class="tr-edit-user pointer" data-id="'+pageData['theList'][i]['user_id']+'">'+pageData['theList'][i]['username']+' ('+pageData['theList'][i]['fullname']+')</td>';
    li+='<td class="tr-edit-user pointer" data-id="'+pageData['theList'][i]['user_id']+'">'+pageData['theList'][i]['email']+'</td>';
    li+='<td class="text-right">'+pageData['theList'][i]['total_per']+'</td>';
    li+='</tr>';
  }

  $('.body_list_data').html(li);
}

function preparePermissionsData()
{
  var total=pageData['listPermissions'].length;

  var li='';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listPermissions'][i]['permission_c']+'">'+pageData['listPermissions'][i]['title']+'</option>';
  }

  $('.add-permissions').html(li).trigger('change');
  $('.edit-permissions').html(li).trigger('change');
}

$(document).ready(function(){

  preparePermissionsData();

  preparelistData();

  

  $('.select2js').select2({
    dropdownParent: $("#modalSearch")
  });

  $('.select2js-add').select2({
    dropdownParent: $("#modalAdd")
  });

  $('.select2js-edit').select2({
    dropdownParent: $("#modalEdit")
  });


  $('.add-permissions').select2({
        dropdownParent: $("#modalAdd")
  });
  $('.edit-permissions').select2({
        dropdownParent: $("#modalEdit")
  });
  $('.post-action').select2({
    'width':'200px'
  });

});

//btn-modal-search
$(document).on('click','.btn-add-user',function(){
  $('#modalAdd').modal({backdrop:'static',keyboard:false});

});
$(document).on('click','.tr-edit-user',function(){
  var user_id=$(this).attr('data-id');
  var total=pageData['listUserPermissions'].length;

  for (var i = 0; i < total; i++) {

 
    if(user_id==pageData['listUserPermissions'][i]['user_id'])
    {

      $('.edit-permissions > option[value="'+pageData['listUserPermissions'][i]['permission_c']+'"]').attr('selected',true);
    }
  }

  $('.edit-permissions').trigger('change');

  pageData['user_c_edit']=user_id;

$('#modalEdit').modal({backdrop:'static',keyboard:false});   


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
  pageData['list_user_id']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_user_id']+=id+',';
    }
    
  });

  var sendData={};

 

  sendData['type']='1';
 
  sendData['forum_id']=pageData['forum_id'];
  sendData['list_user_id']=pageData['list_user_id'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_forum_user_permission_apply', sendData).then(data => {
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

    showAlert('','Done!');
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



$(document).on('click','.btnSetAllPerAdd',function(){
  $('.add-permissions > option').each(function(){
    $(this).attr('selected',true);
  });  
  
  $('.add-permissions').trigger('change');
});


$(document).on('click','.btnSetAllPerEdit',function(){
  $('.edit-permissions > option').each(function(){
    $(this).attr('selected',true);
  });  
  
  $('.edit-permissions').trigger('change');
});


$(document).on('click','.btnSaveUserPer',function(){
  var sendData={};

 
  sendData['type']='1';
 
  sendData['user_id']=pageData['user_c_edit'];
  sendData['forum_id']=pageData['forum_id'];

  pageData['add_per']='';

  $('.edit-permissions > option:selected').each(function(){
    pageData['add_per']+=$(this).val()+',';
  });

  sendData['permission_list']=pageData['add_per'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_update_user_permission', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    location.reload();

  });  

});

$(document).on('click','.btnAddUserPer',function(){
  var sendData={};

 
  sendData['type']='1';
 
  sendData['username']=$('.add-username').val().trim();
  sendData['forum_id']=pageData['forum_id'];

  pageData['add_per']='';

  $('.add-permissions > option:selected').each(function(){
    pageData['add_per']+=$(this).val()+',';
  });

  sendData['permission_list']=pageData['add_per'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_user_permission', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    location.reload();

  });  

});

     
</script>