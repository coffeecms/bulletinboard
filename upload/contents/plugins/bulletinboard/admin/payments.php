

<?php
if(!isset(Configs::$_['user_permissions']['BB30016']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

$db=new Database();  

$listThreads=$db->query("select thread_id,title,friendly_url,views,status,ent_dt,upd_dt,author  from bb_threads_data where title<>'' order by ent_dt desc limit 0,50");

$listPostPrefixs=$db->query("select * from bb_post_prefix_data order by title asc");

$listForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
$listSubForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");

$listForums=bb_genListNestedForum($listForums,$listSubForums);


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
        <label><strong><?php echo get_text_by_lang('Username','admin');?></strong></label>
        <input type="text" class="form-control search-username input-size-medium" name="send[Username]" placeholder="Username" />
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
                <h3 class="card-title"><?php echo get_text_by_lang('Payments','admin');?></h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm btn-modal-search">
                    <i class="fas fa-search"></i>
                  </a>
               
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th><button type="button" class="btn btn-default btn-xs btn-checkall" data-checked="no"><i class="fas fa-square"></i></button></th>
                    <th><?php echo get_text_by_lang('Payment Date','admin');?></th>
                    <th><?php echo get_text_by_lang('Username','admin');?></th>
                    <th><?php echo get_text_by_lang('Comments','admin');?></th>
                    <th class='text-right'><?php echo get_text_by_lang('Status','admin');?></th>
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
                          <option value="deactivate"><?php echo get_text_by_lang('Set Pending','admin');?></option>
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
    pageData['listThreads']=<?php echo json_encode($listThreads);?>;
    pageData['listPostPrefixs']=<?php echo json_encode($listPostPrefixs);?>;
    pageData['listForums']=<?php echo json_encode($listForums);?>;

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

function prepareSelectData()
{
  var total=pageData['listPostPrefixs'].length;

  var li='';

  li+='<option value="all">All</option>';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listPostPrefixs'][i]['prefix_id']+'">'+pageData['listPostPrefixs'][i]['title']+'</option>';
  }

  $('.search-post-prefix').html(li).trigger('change');

  li='';
  total=pageData['listForums'].length;

  var li='';

  li+='<option value="all">All</option>';

  for (var i = 0; i < total; i++) {
    li+='<option value="'+pageData['listForums'][i]['forum_id']+'">'+pageData['listForums'][i]['title']+'</option>';
  }

  $('.search-forum-id').html(li).trigger('change');

  li='';

}
function prepareShowPost()
{
  var total=pageData['listThreads'].length;

  var li='';

  var td='';

  $('.body_list_data').html('');

  var postStatus='';

  for (var i = 0; i < total; i++) {

    if(pageData['listThreads'][i]['author']==null)
    {
      pageData['listThreads'][i]['author']='';
    }

    postStatus='<span class="text text-warning text-sm">Pending</span>';
    if(parseInt(pageData['listThreads'][i]['status'])==1)
    {
      postStatus='<span class="text text-success text-sm">Activated</span>';
    }

    li+='<tr class="tr-id-'+pageData['listThreads'][i]['thread_id']+'">';
    li+='<td><button type="button" class="btn btn-default btn-xs btn-checkbox" data-checked="no" data-id="'+pageData['listThreads'][i]['thread_id']+'"><i class="fas fa-square"></i></button></td>';
    li+='<td>'+pageData['listThreads'][i]['title']+'</td>';
    li+='<td>'+pageData['listThreads'][i]['author']+'</td>';
    li+='<td>'+postStatus+'</td>';
    li+='<td class="text-right">'+pageData['listThreads'][i]['views']+'</td>';
    li+='<td class="text-right">'+pageData['listThreads'][i]['upd_dt']+'</td>';
    li+='</tr>';
  }

  $('.body_list_data').html(li);
}



$(document).ready(function(){

  prepareSelectData();
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