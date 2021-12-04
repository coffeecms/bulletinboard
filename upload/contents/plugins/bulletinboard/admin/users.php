<?php
if(!isset(Configs::$_['user_permissions']['BB30016']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

if(!isset(Configs::$_['bb_license_key'][5]))
{
  redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=active_system');
}

$db=new Database();  


// $queryStr="insert into bb_user_data(user_id)";
// $queryStr.="select user_id from user_mst where user_id NOT IN (select user_id from bb_user_data);";
// $db->nonquery($queryStr);

$listGroup=$db->query(" select * from user_group_mst order by title asc");
$listLevel=$db->query("select * from user_level_mst  order by title asc");
$listRanks=$db->query("select * from bb_ranks_data where status='1'  order by title asc");

?>

<!-- Modal -->
<div class="modal fade" id="modalSearch"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Search','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
      <p>
        <label><strong><?php echo get_text_by_lang('From date','admin');?></strong></label>
        <input type="text" class="form-control search-from-date datepicker input-size-medium" name="send[keywords]"  />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('To date','admin');?></strong></label>
        <input type="text" class="form-control search-to-date datepicker input-size-medium" name="send[keywords]"  />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Username','admin');?></strong></label>
        <input type="text" class="form-control search-username input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Username','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Email','admin');?></strong></label>
        <input type="text" class="form-control search-email input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Email','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('IP Address','admin');?></strong></label>
        <input type="text" class="form-control search-ip input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('IP Address','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('User Agent','admin');?></strong></label>
        <input type="text" class="form-control search-useragent input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('User Agent','admin');?>" />
      </p> 
      <p>
      <label><strong><?php echo get_text_by_lang('Group','admin');?>:</strong></label>
      <select class="form-control search-group select2js" name="send[type]">
      
      </select>
      </p>
      <p>
      <label><strong><?php echo get_text_by_lang('Rank','admin');?>:</strong></label>
      <select class="form-control search-ranks select2js" name="send[status]">
     
      </select>
      </p>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnSearch" ><i class="fas fa-search"></i> <?php echo get_text_by_lang('Search','admin');?></button>
        <button type="button" class="btn btn-danger btnCloseAlert" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Add new user','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

      <p >
      <p>
        <label><strong><?php echo get_text_by_lang('Fullname','admin');?></strong></label>
        <input type="text" class="form-control add-fullname input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Fullname','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Username','admin');?></strong></label>
        <input type="text" class="form-control add-username input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Username','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Password','admin');?></strong></label>
        <input type="text" class="form-control add-password input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Password','admin');?>" />
      </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Email','admin');?></strong></label>
        <input type="text" class="form-control add-email input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Email','admin');?>" />
      </p> 
      <p>
      <label><strong><?php echo get_text_by_lang('Group','admin');?>:</strong></label>
      <select class="form-control add-group select2js-add" name="send[type]">
      
      </select>
      </p>
      <p>
      <label><strong><?php echo get_text_by_lang('Ranks','admin');?>:</strong></label>
      <select class="form-control add-ranks select2js-add" multiple name="send[status]">
     
      </select>
      </p>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnAdd" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Add new','admin');?></button>
        <button type="button" class="btn btn-danger btnCloseAlert" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close','admin');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Edit user','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

<div class='row'>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
        <label><strong><?php echo get_text_by_lang('Fullname','admin');?></strong></label>
        <input type="text" class="form-control edit-fullname input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Fullname','admin');?>" />
      </p> 
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
        <label><strong><?php echo get_text_by_lang('Username','admin');?></strong></label>
        <input type="text" class="form-control edit-username input-size-medium" disabled name="send[keywords]" placeholder="<?php echo get_text_by_lang('Username','admin');?>" />
      </p> 
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
        <label><strong><?php echo get_text_by_lang('Email','admin');?></strong></label>
        <input type="text" class="form-control edit-email input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Email','admin');?>" />
      </p> 
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Group','admin');?>:</strong></label>
      <select class="form-control edit-group select2js-edit" name="send[type]">
      
      </select>
      </p>
  </div>
  <div class='col-lg-12 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Latest IP Address','admin');?>:</strong></label>
      <input type="text" readonly class="form-control edit-ip input-size-medium"  />
      </p>
  </div>   <div class='col-lg-12 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Latest User Agent','admin');?>:</strong></label>
      <input type="text" readonly class="form-control edit-ua input-size-medium"  />
      </p>
  </div>  
  <div class='col-lg-12 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Ranks','admin');?>:</strong></label>
      <select class="form-control edit-ranks select2js-edit" multiple name="send[status]">
     
      </select>
      </p>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Max Messages','admin');?>:</strong></label>
      <input type="text" class="form-control edit-max-message input-size-medium" placeholder="<?php echo get_text_by_lang('Max Messages','admin');?>" />
      </p>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Created Messages','admin');?>:</strong></label>
      <input type="text" class="form-control edit-created-message input-size-medium" placeholder="<?php echo get_text_by_lang('Created Messages','admin');?>" />
      </p>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Points','admin');?>:</strong></label>
      <input type="text" class="form-control edit-points input-size-medium" placeholder="<?php echo get_text_by_lang('Points','admin');?>" />
      </p>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
      <label><strong><?php echo get_text_by_lang('Balance','admin');?>:</strong></label>
      <input type="text" class="form-control edit-balance input-size-medium" placeholder="<?php echo get_text_by_lang('Balance','admin');?>" />
      </p>
  </div>
  <div class='col-lg-12 '>

  <p>
        <label><strong><?php echo get_text_by_lang('Password','admin');?></strong></label>
        <input type="password" class="form-control edit-password input-size-medium" autocomplete="newpass"  placeholder="<?php echo get_text_by_lang('Password','admin');?>" />
      </p>  
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
        <label><strong><?php echo get_text_by_lang('New Password','admin');?></strong></label>
        <input type="password" class="form-control edit-new-password input-size-medium" autocomplete="newpass" name="send[keywords]" placeholder="<?php echo get_text_by_lang('New Password','admin');?>" />
      </p>  
  </div>
  <div class='col-lg-6 col-md-6 col-sm-6 '>
  <p>
        <label><strong><?php echo get_text_by_lang('Retype Password','admin');?></strong></label>
        <input type="password" class="form-control edit-new-repassword input-size-medium" autocomplete="newpass"  name="send[keywords]" placeholder="<?php echo get_text_by_lang('Retype Password','admin');?>" />
      </p>     
  </div>
  <div class='col-lg-12 '>
      <p>
        <label><strong><?php echo get_text_by_lang('Website','admin');?></strong></label>
        <input type="text" class="form-control edit-website input-size-medium" autocomplete="newpass"  name="send[keywords]" placeholder="<?php echo get_text_by_lang('Website','admin');?>" />
      </p>  
  </div>
  <div class='col-lg-12 '>
  <p>
        <label><strong><?php echo get_text_by_lang('Signature','admin');?></strong></label>
        <textarea type="text" class="form-control edit-signature input-size-medium" autocomplete="newpass"  name="send[keywords]" placeholder="<?php echo get_text_by_lang('Signature','admin');?>" style='min-height:100px;'></textarea>
      </p> 
  </div>
  <div class='col-lg-12 '>
      <p>
        <label><strong><?php echo get_text_by_lang('About','admin');?></strong></label>
        <textarea type="text" class="form-control edit-about input-size-medium" autocomplete="newpass"  name="send[keywords]" placeholder="<?php echo get_text_by_lang('About','admin');?>" style='min-height:100px;'></textarea>
      </p> 
  </div>
</div>






     

      

  
     
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-info btnEdit" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Save changes','admin');?></button>
        <button type="button" class="btn btn-danger btnBanUser" ><i class="fas fa-lock"></i> <?php echo get_text_by_lang('Ban this user','admin');?></button>
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
                  <a href="#" class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search"></i>
                  </a>
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
                    <th><?php echo get_text_by_lang('Group','admin');?></th>
                    <th><?php echo get_text_by_lang('Username','admin');?></th>
                    <th><?php echo get_text_by_lang('Email','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Update Time','admin');?></th>
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
                                          
                    <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-info btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                      <input type='number' class='form-control txtPageNumber' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                      <button type="button" class="btn btn-info btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
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
    pageData['listGroup']=<?php echo json_encode($listGroup);?>;
    pageData['listLevel']=<?php echo json_encode($listLevel);?>;
    pageData['listRanks']=<?php echo json_encode($listRanks);?>;
    pageData['listUser']=[];
    pageData['page_no']='0';


</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });


function prepareShowPost()
{
  var total=pageData['listUser'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {

    if(pageData['listUser'][i]['author_username']==null)
    {
      pageData['listUser'][i]['author_username']='';
    }

    postStatus='<span class="text text-default text-sm">Deactivated</span>';
    if(parseInt(pageData['listUser'][i]['status'])==1)
    {
      postStatus='<span class="text text-success text-sm">Activated</span>';
    }

    li+='<tr class="tr-id-'+pageData['listUser'][i]['user_id']+' tr-edit-user pointer" data-id="'+pageData['listUser'][i]['user_id']+'" data-email="'+pageData['listUser'][i]['email']+'" data-username="'+pageData['listUser'][i]['username']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listUser'][i]['user_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['listUser'][i]['group_title']+'</td>';
    li+='<td>'+pageData['listUser'][i]['username']+'</td>';
    li+='<td>'+pageData['listUser'][i]['email']+'</td>';
    li+='<td class="text-right">'+pageData['listUser'][i]['upd_dt']+'</td>';
    li+='</tr>';
  }

  $('.body_list_data').html(li);
}

function prepareShowCategories()
{
  var total=pageData['listGroup'].length;

  var li='';

  var td='';


  li+='<option value="all">All</option>';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listGroup'][i]['group_c']+'">'+pageData['listGroup'][i]['title']+'</option>';
  }

  $('.search-group').html(li).trigger('change');
  $('.add-group').html(li).trigger('change');
  $('.edit-group').html(li).trigger('change');

  // total=pageData['listLevel'].length;

  // li='<option value="all">All</option>';
  // // li='';

  // for (var i = 0; i < total; i++) {
  //   li+='<option value="'+pageData['listLevel'][i]['level_id']+'">'+pageData['listLevel'][i]['title']+'</option>';
  // }

  // $('.search-level').html(li).trigger('change');
  // $('.add-level').html(li).trigger('change');
  // $('.edit-level').html(li).trigger('change');

  total=pageData['listRanks'].length;

  // li='<option value="all">All</option>';
  li='';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listRanks'][i]['rank_id']+'">'+pageData['listRanks'][i]['title']+'</option>';
  }

  
  $('.add-ranks').html(li).trigger('change');
  $('.edit-ranks').html(li).trigger('change');

  li='<option value="all">All</option>'+li;
  $('.search-ranks').html(li).trigger('change');

}


$(document).ready(function(){

  prepareShowCategories();
  prepareShowPost();

  $('.select2js').select2({
    dropdownParent: $("#modalSearch")
  });

  $('.select2js-add').select2({
    dropdownParent: $("#modalAdd")
  });

  $('.select2js-edit').select2({
    dropdownParent: $("#modalEdit")
  });

  $('.post-action').select2({
    'width':'200px'
  });

  $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

      $('.search-from-date').val(moment().add('years',-20).format('MM/DD/YYYY'));
      $('.search-to-date').val(moment().format('MM/DD/YYYY'));

  $('.btnSearch').trigger('click');
});

//btn-modal-search
$(document).on('click','.btn-add-user',function(){
  $('#modalAdd').modal({backdrop:'static',keyboard:false});

});
$(document).on('click','.tr-edit-user',function(){
  var user_id=$(this).attr('data-id');
  var username=$(this).attr('data-username');
  var email=$(this).attr('data-email');


  pageData['user_c_edit']=user_id;
  pageData['username_edit']=username;
  pageData['email_edit']=email;
  pageData['edit_user_data']=[];

   
  var sendData={};
 
  sendData['type']='1';
 
  sendData['user_id']=pageData['user_c_edit'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_load_user_edit_info', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call

    pageData['edit_user_data']=data['data'][0];

    $('.edit-fullname').val(pageData['edit_user_data']['fullname']);
    $('.edit-username').val(pageData['edit_user_data']['username']);
    $('.edit-email').val(pageData['edit_user_data']['email']);
    $('.edit-group').val(pageData['edit_user_data']['group_c']).trigger('change');
    $('.edit-website').val(pageData['edit_user_data']['website']);
    $('.edit-signature').val(pageData['edit_user_data']['signature']);
    $('.edit-about').val(pageData['edit_user_data']['about']);
    $('.edit-max-message').val(pageData['edit_user_data']['max_message']);
    $('.edit-created-message').val(pageData['edit_user_data']['created_message']);
    $('.edit-points').val(pageData['edit_user_data']['total_points']);
    $('.edit-balance').val(pageData['edit_user_data']['balance']);
    $('.edit-ip').val(pageData['edit_user_data']['last_user_ip_address']);
    $('.edit-ua').val(pageData['edit_user_data']['last_user_user_agent']);

    var total=pageData['edit_user_data']['list_ranks'].length;

    $('.edit-ranks > option:selected').each(function(){
      $(this).attr('selected',false);
    });


    for (let i = 0; i < total; i++) {
      $('.edit-ranks > option[value="'+pageData['edit_user_data']['list_ranks'][i]['rank_id']+'"]').attr('selected',true);
    }

    $('.edit-ranks').trigger('change');

    $('#modalEdit').modal({backdrop:'static',keyboard:false});   


  });  


});
$(document).on('click','.btn-modal-search',function(){
  $('#modalSearch').modal({backdrop:'static',keyboard:false});

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


$(document).on('click','.btnAdd',function(){
 
  var sendData={};
 
  sendData['type']='1';
 
  sendData['fullname']=$('.add-fullname').val().trim();
  sendData['username']=$('.add-username').val().trim();
  sendData['password']=$('.add-password').val().trim();
  sendData['email']=$('.add-email').val().trim();
  sendData['group_c']=$('.add-group > option:selected').val().trim();
  sendData['level_c']=$('.add-level > option:selected').val().trim();

  if(sendData['group_c']=='all')
  {
    showAlert('','Select a group!');

    return;
  }

  if(sendData['level_c']=='all')
  {
    showAlert('','Select a level!');

    return;
  }

  if(sendData['username'].length==0)
  {
    showAlert('','Type a username!');

    return;
  }

  if(sendData['password'].length==0)
  {
    showAlert('','Set a password!');

    return;
  }

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_new_user', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    if(data['error']=='yes')
    {
    showAlertOK('',data['data']);
    }
    else
    {
        $('#modalSearch').modal('hide');
      $('#modalAdd').modal('hide');
      $('#modalEdit').modal('hide');

      showAlertOK('','Done!');
    }

  });  

});



$(document).on('click','.btnEdit',function(){
  var sendData={};

  pageData['list_ranks']='';
 
  sendData['type']='1';
 
  sendData['user_c']=pageData['user_c_edit'];
  sendData['fullname']=$('.edit-fullname').val().trim();
  sendData['password']=$('.edit-password').val().trim();
  sendData['newpassword']=$('.edit-new-password').val().trim();
  sendData['newrepassword']=$('.edit-new-repassword').val().trim();
  sendData['email']=$('.edit-email').val().trim();
  sendData['website']=$('.edit-website').val().trim();
  sendData['signature']=$('.edit-signature').val().trim();
  sendData['about']=$('.edit-about').val().trim();
  sendData['max_message']=$('.edit-max-message').val().trim();
  sendData['created_message']=$('.edit-created-message').val().trim();
  sendData['total_points']=$('.edit-points').val().trim();
  sendData['balance']=$('.edit-balance').val().trim();
  sendData['group_c']=$('.edit-group > option:selected').val();
  sendData['rank_id']='';

  if(sendData['group_c']=='all')
  {
    showAlert('','Select a group!');

    return;
  }


  if(sendData['password'].length==0 && sendData['newpassword'].length>0)
  {
    showAlert('','Set a password!');

    return;
  }

  if(sendData['newpassword'].length>0 && sendData['newpassword']!=sendData['newrepassword'])
  {
    showAlert('','New password not valid!');

    return;
  }

  $('.edit-ranks > option:selected').each(function(){
    pageData['list_ranks']+=$(this).val()+',';
  });

  sendData['rank_id']=pageData['list_ranks'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_user', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    if(data['error']=='yes')
    {
    showAlertOK('',data['data']);
    }
    else
    {
        $('#modalSearch').modal('hide');
      $('#modalAdd').modal('hide');
      $('#modalEdit').modal('hide');

      showAlertOK('','Done!');
    }

  });  

});

$(document).on('click','.btnSearch',function(){
  var sendData={};

  sendData['page_no']='1';
    $('.txtPageNumber').val(sendData['page_no']);

  sendData['type']='1';
  pageData['group_c']=$('.search-group > option:selected').val().trim();
  pageData['rankd_id']=$('.search-ranks > option:selected').val().trim();
  pageData['username']=$('.search-username').val().trim();
  pageData['email']=$('.search-email').val().trim();
  pageData['start_date']=$('.search-from-date').val().trim();
  pageData['end_date']=$('.search-to-date').val().trim();

  if(pageData['start_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  if(pageData['end_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  sendData['start_date']=moment(pageData['start_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['end_date']=moment(pageData['end_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['group_c']=pageData['group_c'];
  sendData['rankd_id']=pageData['rankd_id'];
  sendData['username']=pageData['username'];
  sendData['email']=pageData['email'];

  sendData['ip']=$('.search-ip').val().trim();
  sendData['useragent']=$('.search-useragent').val().trim();

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_user', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    if(data['error']=='yes')
    {
    showAlertOK('',data['data']);
    }
    else
    {
      $('#modalSearch').modal('hide');

      pageData['listUser']=data['data'];
      prepareShowPost();
    }

  });  

});

$(document).on('click','.btnPrev',function(){

  var no=$('.txtPageNumber').val();

  if(no.length==0)
  {
    showAlert('','Page number not valid.');
    return false;
  }

  pageData['page_no']=no;

  if(parseInt(pageData['page_no'])<=0)
  {
    pageData['page_no']=1;
  }

  var sendData={};

  sendData['page_no']=parseInt(pageData['page_no'])-1;
  $('.txtPageNumber').val(sendData['page_no']);

  sendData['type']='1';
  pageData['group_c']=$('.search-group > option:selected').val().trim();
  pageData['rankd_id']=$('.search-ranks > option:selected').val().trim();
  pageData['username']=$('.search-username').val().trim();
  pageData['email']=$('.search-email').val().trim();
  pageData['start_date']=$('.search-from-date').val().trim();
  pageData['end_date']=$('.search-to-date').val().trim();

  if(pageData['start_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  if(pageData['end_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  sendData['start_date']=moment(pageData['start_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['end_date']=moment(pageData['end_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['group_c']=pageData['group_c'];
  sendData['rankd_id']=pageData['rankd_id'];
  sendData['username']=pageData['username'];
  sendData['email']=pageData['email'];
  
  sendData['ip']=$('.search-ip').val().trim();
  sendData['useragent']=$('.search-useragent').val().trim();

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_user', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    if(data['error']=='yes')
    {
    showAlertOK('',data['data']);
    }
    else
    {
      $('#modalSearch').modal('hide');

      pageData['listUser']=data['data'];
      prepareShowPost();
    }

  });   

});
$(document).on('click','.btnNext',function(){

  var no=$('.txtPageNumber').val();

  if(no.length==0)
  {
    showAlert('','Page number not valid.');
    return false;
  }
  
  pageData['page_no']=no;

  if(parseInt(pageData['page_no'])<=0)
  {
    pageData['page_no']=1;
  }

  var sendData={};

  sendData['page_no']=parseInt(pageData['page_no'])+1;

  $('.txtPageNumber').val(sendData['page_no']);

  sendData['type']='1';
  pageData['group_c']=$('.search-group > option:selected').val().trim();
  pageData['rankd_id']=$('.search-ranks > option:selected').val().trim();
  pageData['username']=$('.search-username').val().trim();
  pageData['email']=$('.search-email').val().trim();
  pageData['start_date']=$('.search-from-date').val().trim();
  pageData['end_date']=$('.search-to-date').val().trim();

  if(pageData['start_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  if(pageData['end_date'].length==0)
  {
    showAlert('','From date not valid!');
    return false;
  }

  sendData['start_date']=moment(pageData['start_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['end_date']=moment(pageData['end_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
  sendData['group_c']=pageData['group_c'];
  sendData['rankd_id']=pageData['rankd_id'];
  sendData['username']=pageData['username'];
  sendData['email']=pageData['email'];
  
  sendData['ip']=$('.search-ip').val().trim();
  sendData['useragent']=$('.search-useragent').val().trim();


  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_user', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    if(data['error']=='yes')
    {
    showAlertOK('',data['data']);
    }
    else
    {
      $('#modalSearch').modal('hide');

      pageData['listUser']=data['data'];
      prepareShowPost();
    }

  });   
});


    $(document).on('click','.btnBanUser',function(){
      var sendData={};

      sendData['email']=pageData['username_edit'];
   
      sendData['type']='1';

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_banned_username', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // console.log(data['error']);

            if(data['error']=='no')
            {
              var sendData={};

              sendData['email']=pageData['email_edit'];
       
              sendData['type']='1';

              postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_banned_email', sendData).then(data => {
                // console.log(data); // JSON data parsed by `data.json()` call
                // console.log(data['error']);
                $('.txtThumbnail').val('');
                location.reload();
              });                
            }

      });      
        
    });

     
</script>