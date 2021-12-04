
<?php


if(!isset(Configs::$_['user_permissions']['BB30023']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

    $db=new Database();

		$queryStr="SELECT a.*,ifnull(b.Total,'0') as Total ";
		$queryStr.=" FROM user_group_mst as a left join ";
		$queryStr.=" (select group_id ,count(rank_id) as Total ";
		$queryStr.=" from bb_usergroup_ranks_data group by group_id) as b ";
		$queryStr.=" ON a.group_c=b.group_id";
		$queryStr.=" order by a.title asc";

    $theList=$db->query($queryStr);

    $listRanks=$db->query("select * from bb_ranks_data where status='1' order by title asc");
    $listGroupsRanks=$db->query("select * from bb_usergroup_ranks_data");


?>



<!-- Modal -->
<div class="modal fade" id="modalEdit"  style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Edit group','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

      <p>
        <label><strong><?php echo get_text_by_lang('Title','admin');?></strong></label>
        <input type="text" disabled class="form-control edit-title input-size-medium" name="send[keywords]" placeholder="<?php echo get_text_by_lang('Title','admin');?>" />
      </p> 
    
      <p>
        <label><strong><?php echo get_text_by_lang('Ranks','admin');?></strong></label> <button type='button' class='btn btn-primary btnSetAllPerEdit btn-xs'><?php echo get_text_by_lang('All','admin');?></button><button type='button' class='btn btn-primary btnUnSetAllPerEdit btn-xs' style="margin-left:10px;"><?php echo get_text_by_lang('Unset all','admin');?></button>
          <select class="form-control edit-permissions edit-select2js" multiple="multiple" name="send[type]">
          
          </select>
      </p> 

          
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnSaveGroup" ><i class="fas fa-save"></i> <?php echo get_text_by_lang('Save changes','admin');?></button>
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
                <h3 class="card-title"><?php echo get_text_by_lang('Groups','admin');?></h3>
                <div class="card-tools">
                  <!-- <a href="#" class="btn btn-tool btn-sm btn-add-group" title="Add new" style='font-size:18pt;'>
                    <i class="fas fa-plus-square"></i>
                  </a>
                  -->
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped table-valign-middle">
                  <thead>
                  <tr>
                  <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Title','admin');?></th>
                    <th class="text-right"><?php echo get_text_by_lang('Total Ranks','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Actions','admin');?></th>
                  </tr>
                  </thead>
                  <tbody class='the-list'>
                  
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
    pageData['theList']=<?php echo json_encode($theList);?>;
    pageData['listRanks']=<?php echo json_encode($listRanks);?>;
    pageData['listGroupsRanks']=<?php echo json_encode($listGroupsRanks);?>;

</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });

function preparePermissionsData()
{
  var total=pageData['listRanks'].length;

  var li='';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listRanks'][i]['rank_id']+'">'+pageData['listRanks'][i]['title']+'</option>';
  }

  $('.add-permissions').html(li).trigger('change');
  $('.edit-permissions').html(li).trigger('change');
}

function prepareShowData()
{
  var total=pageData['theList'].length;

  var li='';

  var td='';
  $('.the-list').html('');

  for (var i = 0; i < total; i++) {
    li+='<tr class="tr-id-'+pageData['theList'][i]['group_c']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['theList'][i]['group_c']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['theList'][i]['title']+'</td>';
    li+='<td class="text-right">'+pageData['theList'][i]['Total']+'</td>';

    li+='<td class="text-right">';

    li+='<button title="Edit" class="btn btn-info btn-sm edit-group" data-id="'+pageData['theList'][i]['group_c']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';

    li+='</td>';


    li+='</tr> ';
  }

  $('.the-list').html(li);
}

    $(document).ready(function(){

        prepareShowData();
        preparePermissionsData();
      $('.select2js').select2();

      $('.add-permissions').select2({
            dropdownParent: $("#modalAdd")
      });
      $('.edit-permissions').select2({
            dropdownParent: $("#modalEdit")
      });
     

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


$(document).on('click','.edit-group',function(){
  //modalAdd
  var id=$(this).attr('data-id');

  var total=pageData['theList'].length;

  var totalGPer=pageData['listGroupsRanks'].length;

  $('.edit-permissions > option:selected').each(function(){
    $(this).attr('selected',false);
  });


  for (var i = 0; i < total; i++) {
      if(pageData['theList'][i]['group_c']==id)
      {
        pageData['edit_c']=id;
        $('.edit-title').val(pageData['theList'][i]['title']);

        for (var j = 0; j < totalGPer; j++) {
            if(pageData['listGroupsRanks'][j]['group_id']==id)
            {
              // console.log(pageData['listGroupsRanks'][j]['permission_c']);
              $('.edit-permissions > option[value="'+pageData['listGroupsRanks'][j]['rank_id']+'"]').attr('selected',true);
            }
        }

        $('.edit-permissions').trigger('change');

        break;
      }
  }

  $('#modalEdit').modal({backdrop:'static',keyboard:false});

});


$(document).on('click','.btnSetAllPer',function(){
  $('.add-permissions > option').each(function(){
    $(this).attr('selected',true);
  });  
  
  $('.add-permissions').trigger('change');
});

$(document).on('click','.btnUnSetAllPer',function(){
  $('.add-permissions > option:selected').each(function(){
    $(this).attr('selected',false);
  });  
  
  $('.add-permissions').trigger('change');
});



$(document).on('click','.btnSetAllPerEdit',function(){
  $('.edit-permissions > option').each(function(){
    $(this).attr('selected',true);
  });  
  
  $('.edit-permissions').trigger('change');
});

$(document).on('click','.btnUnSetAllPerEdit',function(){
  $('.edit-permissions > option:selected').each(function(){
    $(this).attr('selected',false);
  });  
  
  $('.edit-permissions').trigger('change');
});


$(document).on('click','.btnSaveGroup',function(){

  var sendData={};

  sendData['type']='1';
 
  sendData['title']=$('.edit-title').val().trim();
  sendData['group_id']=pageData['edit_c'];

  pageData['add_per']='';

  $('.edit-permissions > option:selected').each(function(){
    pageData['add_per']+=$(this).val()+',';
  });

  sendData['ranks_list']=pageData['add_per'];

  if(sendData['title'].length==0)
  {
    showAlert('','Title not allow is blank');return false;
  }

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_edit_group_ranks', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

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