

<?php
if(!isset(Configs::$_['user_permissions']['BB30016']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

$db=new Database();  

$listThreads=$db->query("select a.*,b.username from bb_report_page_data as a left join user_mst as b ON a.user_id=b.user_id order by a.ent_dt desc limit 0,500");


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
      <p >
      <p>
        <label><strong><?php echo get_text_by_lang('Keywords','admin');?></strong></label>
        <input type="text" class="form-control search-keywords input-size-medium" name="send[keywords]" placeholder="Keywords" />
    </p> 
      <label><strong><?php echo get_text_by_lang('Forum','admin');?></strong></label>
      <select name="send[catid]" class="form-control search-forum-id  select2js ">
          
      </select>

      </p> 
      <p>
      <label><strong><?php echo get_text_by_lang('Post prefix','admin');?>:</strong></label>
      <select class="form-control search-post-prefix select2js" name="send[type]">

      </select>
      </p>
      
      <p>
      <label><strong><?php echo get_text_by_lang('Status','admin');?>:</strong></label>
      <select class="form-control search-post-status select2js" name="send[status]">
      <option value="all"><?php echo get_text_by_lang('All','admin');?></option>
      <option value="1"><?php echo get_text_by_lang('Activated','admin');?></option>
        <option value="0"><?php echo get_text_by_lang('Pending','admin');?></option>

      </select>
      </p>
      <p>
        <label><strong><?php echo get_text_by_lang('Author','admin');?></strong></label>
        <input type="text" class="form-control search-author input-size-medium" name="send[keywords]" placeholder="Author" />
    </p> 
      <p>
        <label><strong><?php echo get_text_by_lang('Tags','admin');?></strong></label>
        <input type="text" class="form-control search-tags input-size-medium" name="send[keywords]" placeholder="Tags" />
    </p>     
    
    <p>
      <label><strong><?php echo get_text_by_lang('Order by','admin');?>:</strong></label>
      <select class="form-control search-order-by select2js" name="send[type]">
      <option value="ent_dt">Create Date</option>
      <option value="upd_dt">Mofify Date</option>
      <option value="views">Views</option>
      </select>
      </p>    
    
    <p>
      <label><strong><?php echo get_text_by_lang('Order type','admin');?>:</strong></label>
      <select class="form-control search-order-type select2js" name="send[type]">
      <option value="desc">Desc</option>
      <option value="asc">Asc</option>
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
                <h3 class="card-title"><?php echo get_text_by_lang('Reports','admin');?></h3>
                <div class="card-tools">
                 
               
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('From','admin');?></th>
                    <th><?php echo get_text_by_lang('Title','admin');?></th>
                    <th><?php echo get_text_by_lang('Url','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Date Time','admin');?></th>
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
    pageData['listThreads']=<?php echo json_encode($listThreads);?>;

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
  var total=pageData['listThreads'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {

 
    li+='<tr class="tr-id-'+pageData['listThreads'][i]['id']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listThreads'][i]['id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['listThreads'][i]['username']+'</td>';
    li+='<td>'+pageData['listThreads'][i]['title']+'</td>';
    li+='<td><a href="'+pageData['listThreads'][i]['url']+'" target="_blank">'+pageData['listThreads'][i]['url']+'</a></td>';
    li+='<td class="text-right">'+pageData['listThreads'][i]['ent_dt']+'</td>';
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

//btn-modal-search
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

$(document).on('click','.btnApply',function(){
  pageData['list_thread_id']='';

  $('.btn-checkbox').each(function(){
    var id=$(this).attr('data-id');
    var checked=$(this).attr('data-checked');

    if(checked=='yes')
    {
      pageData['list_thread_id']+=id+',';
    }
    
  });

  var sendData={};

 

  sendData['type']='1';
 
  sendData['list_thread_id']=pageData['list_thread_id'];
  pageData['action']=$('.post-action > option:selected').val().trim();
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_thread_action_apply', sendData).then(data => {
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
  pageData['forum_id']=$('.search-forum-id > option:selected').val().trim();
  pageData['status']=$('.search-post-status > option:selected').val().trim();
  pageData['post_prefix']=$('.search-post-prefix > option:selected').val().trim();
  pageData['order_by']=$('.search-order-by > option:selected').val().trim();
  pageData['order_type']=$('.search-order-type > option:selected').val().trim();
  pageData['title']=$('.search-keywords').val().trim();
  pageData['tags']=$('.search-tags').val().trim();
  pageData['username']=$('.search-author').val().trim();

  sendData['forum_id']=pageData['forum_id'];
  sendData['status']=pageData['status'];
  sendData['post_prefix']=pageData['post_prefix'];
  sendData['title']=pageData['title'];
  sendData['tags']=pageData['tags'];
  sendData['username']=pageData['username'];
  sendData['order_by']=pageData['order_by'];
  sendData['order_type']=pageData['order_type'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_threads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listThreads']=data['data'];
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
  pageData['forum_id']=$('.search-forum-id > option:selected').val().trim();
  pageData['status']=$('.search-post-status > option:selected').val().trim();
  pageData['post_prefix']=$('.search-post-prefix > option:selected').val().trim();
  pageData['order_by']=$('.search-order-by > option:selected').val().trim();
  pageData['order_type']=$('.search-order-type > option:selected').val().trim();
  pageData['title']=$('.search-keywords').val().trim();
  pageData['tags']=$('.search-tags').val().trim();
  pageData['username']=$('.search-author').val().trim();

  sendData['forum_id']=pageData['forum_id'];
  sendData['status']=pageData['status'];
  sendData['post_prefix']=pageData['post_prefix'];
  sendData['title']=pageData['title'];
  sendData['tags']=pageData['tags'];
  sendData['username']=pageData['username'];
  sendData['order_by']=pageData['order_by'];
  sendData['order_type']=pageData['order_type'];


  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_threads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listThreads']=data['data'];
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

  pageData['forum_id']=$('.search-forum-id > option:selected').val().trim();
  pageData['status']=$('.search-post-status > option:selected').val().trim();
  pageData['post_prefix']=$('.search-post-prefix > option:selected').val().trim();
  pageData['order_by']=$('.search-order-by > option:selected').val().trim();
  pageData['order_type']=$('.search-order-type > option:selected').val().trim();
  pageData['title']=$('.search-keywords').val().trim();
  pageData['tags']=$('.search-tags').val().trim();
  pageData['username']=$('.search-author').val().trim();

  sendData['forum_id']=pageData['forum_id'];
  sendData['status']=pageData['status'];
  sendData['post_prefix']=pageData['post_prefix'];
  sendData['title']=pageData['title'];
  sendData['tags']=pageData['tags'];
  sendData['username']=pageData['username'];
  sendData['order_by']=pageData['order_by'];
  sendData['order_type']=pageData['order_type'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_get_list_threads', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    $('#modalSearch').modal('hide');

    pageData['listThreads']=data['data'];
    prepareShowPost();
  });   
});
     
</script>