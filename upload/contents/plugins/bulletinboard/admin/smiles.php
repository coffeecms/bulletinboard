<?php

if(!isset(Configs::$_['user_permissions']['BB30018']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

		$db=new Database();

    $queryStr=" SELECT a.category_id,a.sort_order,a.title,a.status,ifnull(c.total_smiles,'0') as total_smiles";
    $queryStr.=" FROM bb_smiles_category_data as a ";
    $queryStr.=" left join (";
    $queryStr.=" select category_id,count(*) as total_smiles";
    $queryStr.=" from bb_smiles_data group by category_id";
    $queryStr.=" ) as c ON a.category_id=c.category_id";
    $queryStr.=" group by a.category_id,a.title,a.status order by a.sort_order asc";

    $theList=$db->query($queryStr);



?>

<!-- Modal -->
<div class="modal fade" id="modalAddnew" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo get_text_by_lang('Add new category','admin');?></h5>
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
                            <input type="text" class="form-control input-size-medium add-title" name="send[title]" placeholder="<?php echo get_text_by_lang('Title','admin');?>" id="txtTitle" />
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
                            <label><strong><?php echo get_text_by_lang('Title','admin');?></strong></label>
                            <input type="hidden" class="form-control input-size-medium edit-category_c"  />
                            <input type="text" class="form-control input-size-medium edit-title" name="send[title]" placeholder="<?php echo get_text_by_lang('Title','admin');?>" id="txtTitle" />
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
                <h3 class="card-title"><?php echo get_text_by_lang('Smiles categories','admin');?></h3>
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
                                              <th class='text-right'><?php echo get_text_by_lang('Smiles','admin');?></th>
                                              <th style="width:110px;text-align: right;"><?php echo get_text_by_lang('Status','admin');?></th>
                                              <th style="width:160px;text-align: right;"><?php echo get_text_by_lang('Action','admin');?></th>
                                          </tr>
                  </thead>
                  <tbody class='list-categories'>
                  
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
                        <option value="activate"><?php echo get_text_by_lang('Activate','admin');?></option>
                        <option value="deactivate"><?php echo get_text_by_lang('Deactivate','admin');?></option>
                          
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

</script>

<script type="text/javascript">


   // postData('http://localhost/coffeecms/api/index', { answer: 42 })
 // .then(data => {
  //  console.log(data); // JSON data parsed by `data.json()` call
  //  console.log(data['error']);
  // });

function prepareShowData()
{
  var total=pageData['theList'].length;

  var li='';

  var td='';


  var postStatus='';
  for (var i = 0; i < total; i++) {


    postStatus='<span class="text text-default text-sm">Deactivated</span>';
    if(parseInt(pageData['theList'][i]['status'])==1)
    {
      postStatus='<span class="text text-success text-sm">Activated</span>';
    }

    td+='<tr class="tr-id-'+pageData['theList'][i]['category_id']+'" style="cursor:pointer;">';
    td+='<td style="width:80px;text-align: left;">';
    td+='<button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['theList'][i]['category_id']+'"><i class="fas fa-square"></i></button>';
    td+='</td>';
    td+='<td data-id="'+pageData['theList'][i]['category_id']+'"><a href="'+SITE_URL+'admin/plugin_page_url?plugin=bulletinboard&page=smiles_item&category_id='+pageData['theList'][i]['category_id']+'" style="color:#000;" >'+pageData['theList'][i]['title']+'</a></td>';
    td+='<td class="text-right">'+pageData['theList'][i]['total_smiles'];
    td+='</td>';
    td+='<td class="text-right">'+postStatus;
    td+='</td>';
    td+='<td class="text-right">';

    td+='<button title="Sort up" class="btn btn-info btn-sm btn-sort-up" data-id="'+pageData['theList'][i]['category_id']+'" data-sortorder="'+pageData['theList'][i]['sort_order']+'"  style="margin-right:5px;" type="button"><i class="fas fa-chevron-up"></i></button>';
    td+='<button title="Sort down" class="btn btn-info btn-sm btn-sort-down" data-id="'+pageData['theList'][i]['category_id']+'"  data-sortorder="'+pageData['theList'][i]['sort_order']+'"  style="margin-right:5px;" type="button"><i class="fas fa-chevron-down"></i></button>';

    td+='<button title="Edit" class="btn btn-info btn-sm td-category" data-id="'+pageData['theList'][i]['category_id']+'" style="margin-right:5px;" type="button"><i class="fas fa-edit"></i></button>';
    td+='</td>';


    td+='</tr>';

  }

  $('.list-categories').html(td);
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
      sendData['type']='1';

        
      if(sendData['title'].length==0)
      {
        showAlert('','Title not allow is blank');return false;
      }


      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_add_smile_category', sendData).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
        // console.log(data['error']);
        location.reload();
      });      
        
    });
    $(document).on('click','.btnSaveEdit',function(){
      var sendData={};

      sendData['category_id']=pageData['category_id'];
      sendData['title']=$('.edit-title').val().trim();
      sendData['type']='1';

              
      if(sendData['title'].length==0)
      {
        showAlert('','Title not allow is blank');return false;
      }

      
      postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_update_smile_category', sendData).then(data => {
        location.reload();
      });      
        
    });

    
    $(document).on('click','.td-category',function(){
      var sendData={};

      sendData['category_id']=$(this).attr('data-id');
      sendData['type']='1';

      pageData['category_id']=sendData['category_id'];

      var total=pageData['theList'].length;

      for (var i = 0; i < total; i++) {
        if(pageData['theList'][i]['category_id']==sendData['category_id'])
        {
          $('.edit-title').val(pageData['theList'][i]['title']);
      
          $('#modalEdit').modal({backdrop:'static',keyboard:false});

          break;
        }
        
      }


        
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
  pageData['list_category_id']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_category_id']+=id+',';
    }
    
  });

  var sendData={};

 

  sendData['type']='1';
 
  sendData['list_category_id']=pageData['list_category_id'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smile_category_action_apply', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

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



$(document).on('click','.btn-sort-up',function(){
    var sendData={};

    sendData['category_id']=$(this).attr('data-id');
    sendData['sort_order']=$(this).attr('data-sortorder');
    
    sendData['type']='1';



    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smile_category_sort_up', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });      
    
});
     

$(document).on('click','.btn-sort-down',function(){
    var sendData={};

    sendData['category_id']=$(this).attr('data-id');
    sendData['sort_order']=$(this).attr('data-sortorder');
    
    sendData['type']='1';


    postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_smile_category_sort_down', sendData).then(data => {
    console.log(data); // JSON data parsed by `data.json()` call
    // console.log(data['error']);
        location.reload();
    });      
    
});
     
       
</script>