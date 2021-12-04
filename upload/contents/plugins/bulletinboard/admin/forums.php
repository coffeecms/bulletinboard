
<?php

if (!isset(Configs::$_['user_permissions']['BB30015'])) {
	redirect_to(SITE_URL . 'admin/notfound');
}


if(!isset(Configs::$_['bb_license_key'][5]))
{
    redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=active_system');
}

$db = new Database();

$listForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
$listSubForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");
$listPermissions = $db->query("select * from permissions_mst where LEFT(permission_c,2)='BB'");
$listUserGroups = $db->query("select * from user_group_mst order by title asc");

bb_genListNestedForum($listForums, $listSubForums);

// print_r(Configs::$_['list_forum_data']);die();
?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new forum', 'admin'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">

                        <form action="" method="post" enctype="multipart/form-data">

                        <p>
                            <label><strong><?php echo get_text_by_lang('Title', 'admin'); ?></strong></label>
                            <input type="text" class="form-control add-title input-size-medium " name="send[title]" placeholder="<?php echo get_text_by_lang('Title', 'admin'); ?>" id="txtTitle" />
                        </p>
                            <p class="pChosen">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Parent', 'admin'); ?></strong></label>
                            <select name="send[parentid]" class="form-control select2js add-parentid add-parentlist">

                            </select>
                            </div>
                            </div>

                            </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Thumbnail url', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control add-thumbnail input-size-medium" name="send[descriptions]" placeholder="<?php echo get_text_by_lang('Thumbnail url', 'admin'); ?>" />
                        </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Descriptions', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control add-descriptions input-size-medium" name="send[descriptions]" placeholder="<?php echo get_text_by_lang('Descriptions', 'admin'); ?>" />
                        </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Keywords', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control add-keywords input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Keywords', 'admin'); ?>" />
                        </p>

                        <p class="pChosenAddType">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Type', 'admin'); ?></strong></label>
                            <select class="form-control add-select2js add-type">
                                <option value="normal">Normal</option>
                                <option value="private">Private</option>
                                <option value="url">Url</option>
                                <option value="html">HTML</option>
                            </select>
                            </div>
                            </div>

                            </p>

                            <p>
                            <label><strong><?php echo get_text_by_lang('HTML Content', 'admin'); ?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' class="form-control add-html input-size-medium" name="send[descriptions]"></textarea>
                          </p>

                        <p class="pChosenStatus">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Status', 'admin'); ?></strong></label>
                            <select class="form-control add-status">
                                <option value="1">Activate</option>
                                <option value="0">Deactivate</option>
                            </select>
                            </div>
                            </div>

                            </p>

                        <p class="pChosenAllowNewThread">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('User can create new thread ', 'admin'); ?></strong></label>
                            <select class="form-control  add-allow_create_thread">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                            </div>
                            </div>

                            </p>

                        </form>


                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSaveAdd" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Add new', 'admin'); ?></button>
        <button type="button" class="btn btn-danger " data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close', 'admin'); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Edit forum', 'admin'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
        <div class="col-lg-12">

                        <form action="" method="post" enctype="multipart/form-data">

                        <p>
                            <label><strong><?php echo get_text_by_lang('Title', 'admin'); ?></strong></label>
                            <input type="text" class="form-control edit-title input-size-medium title" name="send[title]" placeholder="<?php echo get_text_by_lang('Title', 'admin'); ?>" id="txtTitle" />
                        </p>
                            <p class="pChosen">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Parent', 'admin'); ?></strong></label>
                            <select name="send[parentid]" class="form-control select2js edit-parentid edit-parentlist">

                            </select>
                            </div>
                            </div>

                            </p>
                            <p>
                            <label><strong><?php echo get_text_by_lang('Thumbnail url', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control edit-thumbnail input-size-medium" name="send[descriptions]" placeholder="<?php echo get_text_by_lang('Thumbnail url', 'admin'); ?>" />
                        </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Descriptions', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control edit-descriptions input-size-medium" name="send[descriptions]" placeholder="<?php echo get_text_by_lang('Descriptions', 'admin'); ?>" />
                        </p>
                        <p>
                            <label><strong><?php echo get_text_by_lang('Keywords', 'admin'); ?></strong> </label>
                            <input type="text" class="form-control edit-keywords input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Keywords', 'admin'); ?>" />
                        </p>

                        <p class="pChosenEditType">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Type', 'admin'); ?></strong></label>
                            <select class="form-control edit-select2js edit-type">
                                <option value="normal">Normal</option>
                                <option value="private">Private</option>
                                <option value="url">Url</option>
                                <option value="html">HTML</option>
                            </select>
                            </div>
                            </div>

                            </p>

                            <p>
                            <label><strong><?php echo get_text_by_lang('HTML Content', 'admin'); ?></strong> </label>
                            <textarea rows="10" style='min-height:150px;' class="form-control edit-html input-size-medium" name="send[descriptions]"></textarea>
                        </p>

                        <p class="pChosenEditStatus">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('Status', 'admin'); ?></strong></label>
                            <select class="form-control edit-status">
                                <option value="1">Activate</option>
                                <option value="0">Deactivate</option>
                            </select>
                            </div>
                            </div>

                            </p>

                            <p class="pChosenEditNewThread">
                            <div class="row">
                            <div class="col-lg-12">
                            <label><strong><?php echo get_text_by_lang('User can create new thread ', 'admin'); ?></strong></label>
                            <select class="form-control edit-allow_create_thread">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                            </div>
                            </div>

                            </p>

                        </form>


                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSaveEdit" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Save changes', 'admin'); ?></button>
        <button type="button" class="btn btn-danger " data-dismiss="modal"><i class="fas fa-times"></i> <?php echo get_text_by_lang('Close', 'admin'); ?></button>
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
                <h3 class="card-title"><?php echo get_text_by_lang('Forums', 'admin'); ?></h3>
                <div class="card-tools">
                <span class="btn btn-tool btn-sm btnAddNew" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </span>
                  <!-- <span class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search"></i>
                  </span> -->

                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Title', 'admin'); ?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Status', 'admin'); ?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Action', 'admin'); ?></th>
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
                        <option value=""><?php echo get_text_by_lang('Select an action', 'admin'); ?></option>
                        <option value="delete"><?php echo get_text_by_lang('Delete', 'admin'); ?></option>
                          <option value="deactivate"><?php echo get_text_by_lang('Set Deactivate', 'admin'); ?></option>
                          <option value="activate"><?php echo get_text_by_lang('Set Activate', 'admin'); ?></option>

                        </select>
                        <button type="button" class="btn btn-info btnApply"><?php echo get_text_by_lang('Apply', 'admin'); ?></button>
                    </div>
                    <!-- <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-info btnPrev"><?php echo get_text_by_lang('Previous', 'admin'); ?></button>
                      <input type='number' class='form-control txtPageNumber' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                      <button type="button" class="btn btn-info btnNext"><?php echo get_text_by_lang('Next', 'admin'); ?></button>
                    </div> -->


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
    pageData['listForums']=<?php echo json_encode(Configs::$_['list_forum_data']); ?>;
    pageData['listPermissions']=<?php echo json_encode($listPermissions); ?>;
    pageData['listUserGroups']=<?php echo json_encode($listUserGroups); ?>;
    pageData['page_no']='1';
    pageData['forum_id']='all';
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


function prepareShowForums()
{
  var total=pageData['listForums'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  var option='<option value=""></option>';

  for (var i = 0; i < total; i++) {

    option+='<option value="'+pageData['listForums'][i]['forum_id']+'">'+pageData['listForums'][i]['title']+'</option>';

    postStatus='<span class="text text-default text-sm">Deactivated</span>';
    if(parseInt(pageData['listForums'][i]['status'])==1)
    {
      postStatus='<span class="text text-success text-sm">Activated</span>';
    }

    li+='<tr class="tr-id-'+pageData['listForums'][i]['forum_id']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listForums'][i]['forum_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td><span class="btn-edit" data-id="'+pageData['listForums'][i]['forum_id']+'" target="_blank" title="'+pageData['listForums'][i]['title']+'">'+pageData['listForums'][i]['title']+'</span></td>';
    li+='<td class="text-right">'+postStatus+'</td>';
    li+='<td class="text-right">';

        li+='<button title="Add sub forum" class="btn btn-info btn-sm btn-addsub" data-id="'+pageData['listForums'][i]['forum_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-plus-square"></i></button>';
        li+='<button title="Edit" class="btn btn-info btn-sm btn-edit" data-id="'+pageData['listForums'][i]['forum_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';
        li+='<button title="Sort up" class="btn btn-info btn-sm btn-sort-up" data-id="'+pageData['listForums'][i]['forum_id']+'" data-sortorder="'+pageData['listForums'][i]['sort_order']+'" data-parentid="'+pageData['listForums'][i]['parent_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-chevron-up"></i></button>';
        li+='<button title="Sort down" class="btn btn-info btn-sm btn-sort-down" data-id="'+pageData['listForums'][i]['forum_id']+'"  data-sortorder="'+pageData['listForums'][i]['sort_order']+'" data-parentid="'+pageData['listForums'][i]['parent_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-chevron-down"></i></button>';
        li+='<a title="User permissions" href="'+SITE_URL+'admin/plugin_page_url?plugin=bulletinboard&page=user_permissions&forum_id='+pageData['listForums'][i]['forum_id']+'" class="btn btn-info btn-sm btn-user-per" data-id="'+pageData['listForums'][i]['forum_id']+'"  style="margin-right:5px;"><i class="fas fa-user-cog"></i></a>';
        li+='<a title="User group permissions" href="'+SITE_URL+'admin/plugin_page_url?plugin=bulletinboard&page=usergroup_permissions&forum_id='+pageData['listForums'][i]['forum_id']+'" class="btn btn-info btn-sm btn-user-group-per" data-id="'+pageData['listForums'][i]['forum_id']+'"  style="margin-right:5px;"><i class="fas fa-users-cog"></i></a>';
        // li+='<button  title="Messages" class="btn btn-info btn-sm btn-message-manager" data-id="'+pageData['listForums'][i]['forum_id']+'"  style="margin-right:5px;" type="button"><i class="fas fa-file-alt"></i></button>';

    li+='</td>';
    li+='</tr>';
  }

  $('.body_list_data').html(li);

  $('.add-parentid').html(option).trigger('change');
  $('.edit-parentid').html(option).trigger('change');
}


$(document).ready(function(){


//   prepareShowCategories();
  prepareShowForums()

  $('.select2js').select2({
    dropdownParent: $("#modalSearch")
  });

  $('.add-status').select2({
    dropdownParent: $(".pChosenStatus")
  });
  $('.edit-status').select2({
    dropdownParent: $(".pChosenEditStatus")
  });
  $('.add-allow_create_thread').select2({
    dropdownParent: $(".pChosenAllowNewThread")
  });
  $('.edit-allow_create_thread').select2({
    dropdownParent: $(".pChosenEditNewThread")
  });
  $('.add-parentid').select2({
    dropdownParent: $("#modalAddnew")
  });
  $('.add-type').select2({
    dropdownParent: $(".pChosenAddType")
  });

  $('.edit-type').select2({
    dropdownParent: $(".pChosenEditType")
  });

  $('.edit-parentid').select2({
    dropdownParent: $("#modalEdit")
  });

  $('.post-action').select2({
    'width':'200px'
  });

});

$(document).on('click','.btnAddNew',function(){

        $('.add-parentlist').val('').trigger('change');

      $('#modalAddnew').modal({backdrop:'static',keyboard:false});
    });
//btn-modal-search
$(document).on('click','.btn-modal-search',function(){
  $('#modalSearch').modal({backdrop:'static',keyboard:false});

});

$(document).on('click','.btn-edit',function(){
    var forum_id=$(this).attr('data-id');

    var total=pageData['listForums'].length;

    pageData['editData']={};

    for (var i = 0; i < total; i++) {
        if(forum_id==pageData['listForums'][i]['forum_id'])
        {
            pageData['editData']=pageData['listForums'][i];


            $('.edit-title').val(pageData['editData']['title']);
            $('.edit-descriptions').val(pageData['editData']['descriptions']);
            $('.edit-keywords').val(pageData['editData']['keywords']);
            $('.edit-type').val(pageData['editData']['forum_type']).trigger('change');
            $('.edit-html').val(pageData['editData']['short_content']);
            $('.edit-status').val(pageData['editData']['status']).trigger('change');
            $('.edit-allow_create_thread').val(pageData['editData']['allow_create_thread']).trigger('change');

            if(pageData['editData']['forum_type']=='url')
            {
              $('.edit-html').val(pageData['editData']['external_url']);
            }

            $('.edit-parentid').val('').trigger('change');
            if(pageData['editData']['parent_id']!=null && pageData['editData']['parent_id'].length > 0)
            {
                $('.edit-parentid').val(pageData['editData']['parent_id']).trigger('change');
            }

            break;
        }
    }



  $('#modalEdit').modal({backdrop:'static',keyboard:false});

});

$(document).on('click','.btn-addsub',function(){
    var forum_id=$(this).attr('data-id');

    $('.add-parentlist').val(forum_id).trigger('change');

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
  pageData['list_forum_id']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_forum_id']+=id+',';
    }

  });

  var sendData={};



  sendData['type']='1';

  sendData['list_forum_id']=pageData['list_forum_id'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_action_apply', sendData).then(data => {
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



$(document).on('click','.btnSaveAdd',function(){
    var sendData={};

    sendData['title']=$('.add-title').val().trim();
    sendData['parent_id']=$('.add-parentid > option:selected').val();
    sendData['forum_type']=$('.add-type > option:selected').val();
    sendData['thumbnail']=$('.add-thumbnail').val();
    sendData['short_content']=$('.add-html').val();
    sendData['descriptions']=$('.add-descriptions').val().trim();
    sendData['keywords']=$('.add-keywords').val().trim();
    sendData['status']=$('.add-status').val().trim();
    sendData['allow_create_thread']=$('.add-allow_create_thread').val().trim();
    sendData['type']='1';



    if(typeof sendData['parent_id']=='undefined')
    {
        sendData['parent_id']='';
    }

    if(sendData['title'].length==0)
    {
      showAlert('','Title not allow is blank');return false;
    }

    if(sendData['forum_type']=='url' && sendData['short_content'].trim().length==0)
    {
      showAlert('','Type url into HTML Content field, please!');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_new_forum', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });

});


$(document).on('click','.btn-sort-up',function(){
    var sendData={};

    sendData['forum_id']=$(this).attr('data-id');
    sendData['parent_id']=$(this).attr('data-parentid');
    sendData['sort_order']=$(this).attr('data-sortorder');

    sendData['type']='1';

    if(typeof sendData['parent_id']=='undefined')
    {
        sendData['parent_id']='';
    }


    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_forum_sort_up', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });

});


$(document).on('click','.btn-sort-down',function(){
    var sendData={};

    sendData['forum_id']=$(this).attr('data-id');
    sendData['parent_id']=$(this).attr('data-parentid');
    sendData['sort_order']=$(this).attr('data-sortorder');

    sendData['type']='1';

    if(typeof sendData['parent_id']=='undefined')
    {
        sendData['parent_id']='';
    }


    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_forum_sort_down', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });

});


$(document).on('click','.btnSaveEdit',function(){
    var sendData={};

    sendData['forum_id']=pageData['editData']['forum_id'];

    sendData['title']=$('.edit-title').val().trim();
    sendData['parent_id']=$('.edit-parentid > option:selected').val();
    sendData['forum_type']=$('.edit-type > option:selected').val();
    sendData['descriptions']=$('.edit-descriptions').val().trim();
    sendData['thumbnail']=$('.edit-thumbnail').val();
    sendData['short_content']=$('.edit-html').val().trim();
    sendData['keywords']=$('.edit-keywords').val().trim();
    sendData['status']=$('.edit-status').val().trim();
    sendData['allow_create_thread']=$('.edit-allow_create_thread').val().trim();
    sendData['type']='1';

    if(typeof sendData['parent_id']=='undefined')
    {
        sendData['parent_id']='';
    }

    if(sendData['title'].length==0)
    {
        showAlert('','Title not allow is blank');return false;
    }

    if(sendData['forum_type']=='url' && sendData['short_content'].trim().length==0)
    {
      showAlert('','Type url into HTML Content field, please!');return false;
    }

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_forum', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });

});

</script>