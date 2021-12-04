<?php
		if(!isset(Configs::$_['user_permissions']['BB30013']))
		{
			redirect_to(SITE_URL.'admin/notfound');
		}	

    
if(!isset(Configs::$_['bb_license_key'][5]))
{
    redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=active_system');
}


        $db=new Database();  

        $queryStr='';

        $queryStr.="select a.*,b.title,b.author ";
        $queryStr.=" from bb_ads_thread_data as a join bb_threads_data as b ON a.thread_id=b.thread_id ";
        $queryStr.=" order by a.ent_dt desc limit 0,50 ";

        $listPost=$db->query($queryStr);
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
        <label><strong><?php echo get_text_by_lang('Thread url','admin');?></strong></label>
        <input type="text" class="form-control search-keywords input-size-medium" name="send[keywords]" placeholder="Thread url" />
    </p> 
    <p>
        <label><strong><?php echo get_text_by_lang('From date','admin');?></strong></label>
        <input type="text" class="form-control search-from-date datepicker input-size-medium" name="send[keywords]"  />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('To date','admin');?></strong></label>
        <input type="text" class="form-control search-to-date datepicker input-size-medium" name="send[keywords]"  />
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
        <h5 class="modal-title " id="exampleModalLabel"><?php echo get_text_by_lang('Add new ads','admin');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
      <p>
        <label><strong><?php echo get_text_by_lang('Thread url','admin');?></strong></label>
        <input type="text" class="form-control add-threadurl input-size-medium" name="send[keywords]" placeholder="Thread url" />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Thread title','admin');?></strong></label>
        <input type="text" disabled class="form-control add-thread-title input-size-medium" name="send[keywords]"  />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Thread author','admin');?></strong></label>
        <input type="text" disabled class="form-control add-thread-author input-size-medium" name="send[keywords]"  />
    </p> 
    <p>
        <label><strong><?php echo get_text_by_lang('From date','admin');?></strong></label>
        <input type="text" class="form-control add-from-date datepicker input-size-medium" name="send[keywords]"  />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('To date','admin');?></strong></label>
        <input type="text" class="form-control add-to-date datepicker input-size-medium" name="send[keywords]"  />
    </p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btnCreateAds" ><i class="fas fa-plus"></i> <?php echo get_text_by_lang('Create ads','admin');?></button>
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
                <h3 class="card-title"><?php echo get_text_by_lang('Thread Ads','admin');?></h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm btn-modal-add">
                    <i class="fas fa-plus-square" style='font-size: 16pt;'></i>
                  </a>
               
                  <!-- <a href="#" class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search" style='font-size: 16pt;'></i>
                  </a> -->
               
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Title','admin');?></th>
                    <th><?php echo get_text_by_lang('Author','admin');?></th>
                    <th><?php echo get_text_by_lang('From date','admin');?></th>
                    <th><?php echo get_text_by_lang('To date','admin');?></th>
                    <th class="text-right"><?php echo get_text_by_lang('Status','admin');?></th>
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
                          <option value="deactivate"><?php echo get_text_by_lang('Set Deactivate','admin');?></option>
                          <option value="activate"><?php echo get_text_by_lang('Set Activate','admin');?></option>
                          
                        </select>
                        <button type="button" class="btn btn-info btnApply"><?php echo get_text_by_lang('Apply','admin');?></button>
                    </div>                      
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
    pageData['listPost']=<?php echo json_encode($listPost);?>;

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
  var total=pageData['listPost'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {


    postStatus='<span class="text text-default text-sm">Deactivated</span>';
    if(parseInt(pageData['listPost'][i]['status'])==1)
    {
      postStatus='<span class="text text-success text-sm">Activated</span>';
    }

    li+='<tr class="tr-id-'+pageData['listPost'][i]['ads_id']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listPost'][i]['ads_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td><a style="color:#000;" href="'+SITE_URL+'admin/edit_post?ads_id='+pageData['listPost'][i]['ads_id']+'" target="_blank" title="'+pageData['listPost'][i]['title']+'">'+pageData['listPost'][i]['title']+'</td>';
    li+='<td>'+pageData['listPost'][i]['author']+'</td>';
    li+='<td>'+moment(pageData['listPost'][i]['start_date'],'YYYY-MM-DD').format('MM/DD/YYYY')+'</td>';
    li+='<td>'+moment(pageData['listPost'][i]['end_date'],'YYYY-MM-DD').format('MM/DD/YYYY')+'</td>';
    
    li+='<td class="text-right">'+postStatus+'</td>';
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

  $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

      $('.search-from-date').val(moment().format('MM/DD/YYYY'));
      $('.search-to-date').val(moment().add('days',30).format('MM/DD/YYYY'));
      $('.add-from-date').val(moment().format('MM/DD/YYYY'));
      $('.add-to-date').val(moment().add('days',30).format('MM/DD/YYYY'));
});

//btn-modal-search
$(document).on('click','.btn-modal-search',function(){
  $('#modalSearch').modal({backdrop:'static',keyboard:false});

});

$(document).on('keyup','.add-threadurl',function(){
  var url=$(this).val().trim();

  pageData['url_data']=[];

  if(url.length > 5)
  {
    var sendData={};

    sendData['type']='1';
    sendData['url']=url;

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_threadads_url_info', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call

    pageData['url_data']=data['data'];

    $('.add-thread-title').val(pageData['url_data'][0]['title']);
    $('.add-thread-author').val(pageData['url_data'][0]['author']);
    
    });      
  }

});
$(document).on('click','.btnCreateAds',function(){

    if(typeof pageData['url_data']=='undefined')
    {
        showAlert('','Thread url not allow is blank!');
        return;       
    }

    if(pageData['url_data'].length==0)
    {
        showAlert('','Thread url not allow is blank!');
        return;        
    }

    var sendData={};

    sendData['type']='1';
    sendData['thread_id']=pageData['url_data'][0]['thread_id'];
    sendData['forum_id']=pageData['url_data'][0]['forum_id'];
    sendData['start_date']=$('.add-from-date').val().trim();
    sendData['end_date']=$('.add-to-date').val().trim();

    if(sendData['start_date'].length==0)
    {
        showAlert('','From date not allow is blank!');
        return;
    }
    if(sendData['end_date'].length==0)
    {
        showAlert('','To date not allow is blank!');
        return;
    }

    sendData['start_date']=moment(sendData['start_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
    sendData['end_date']=moment(sendData['end_date'],'MM/DD/YYYY').format('YYYY-MM-DD');

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_thread_ads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalAdd').modal('hide');

        showAlert('','Done!');

    });  

});

//btn-modal-add
$(document).on('click','.btn-modal-add',function(){
  $('#modalAdd').modal({backdrop:'static',keyboard:false});

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

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_thread_ads_action_apply', sendData).then(data => {
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
$(document).on('click','.btnSearch',function(){
  var sendData={};

  sendData['page_no']='1';
    $('.txtPageNumber').val(sendData['page_no']);

  sendData['type']='1';

  postData(API_URL+'get_list_post', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listPost']=data['data'];
    prepareShowPost();
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


  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread_ads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listPost']=data['data'];
    prepareShowPost();
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


  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread_ads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listPost']=data['data'];
    prepareShowPost();
  });   
});
     
</script>