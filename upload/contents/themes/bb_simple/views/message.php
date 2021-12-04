
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>

  
  <!-- modal -->
  <div class="modal fade" id="modalInboxFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Keywords:</label>
              <input type="text" class="form-control search-keywords" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Username:</label>
              <input type="text" class="form-control search-username" id="recipient-name">
            </div>
            
            <div class='row'>
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">Start date:</label>
                <input type="text" class="form-control search-start_date datepicker" id="recipient-name">          
              </div>        
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">End date:</label>
                <input type="text" class="form-control search-end_date datepicker" id="recipient-name">          
              </div>        
            </div>

          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary btnInboxSearch"><i class='fas fa-search'></i> Search</button>
          <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  
  <!-- modal -->
  <div class="modal fade" id="modalSendedFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Keywords:</label>
              <input type="text" class="form-control search-sended-keywords" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Username:</label>
              <input type="text" class="form-control search-sended-username" id="recipient-name">
            </div>
            
            <div class='row'>
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">Start date:</label>
                <input type="text" class="form-control search-sended-start_date datepicker" id="recipient-name">          
              </div>        
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">End date:</label>
                <input type="text" class="form-control search-sended-end_date datepicker" id="recipient-name">          
              </div>        
            </div>

          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSendedSearch"><i class='fas fa-search'></i> Search</button>
          <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->


  <div class='container  mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>
    
            <?php BB_PHPCode::load('top_new_post_options');?>

      <?php BB_PHPCode::load('top_message_page');?>
        <!-- List forum threads -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum">
                <ul class="nav nav-pills nav-pills-message" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" ><i class='fas fa-comment-alt'></i> Inbox</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-sended-tab" data-bs-toggle="pill" data-bs-target="#pills-sended" type="button" role="tab" aria-controls="pills-sended" aria-selected="true" ><i class='fas fa-paper-plane'></i> Sended</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class='fas fa-edit'></i> Compose</button>
                    </li>
                
                    </ul>
              </div>
              <div class="card-body">


                <div class="tab-content" id="pills-tabContent">
                    <!-- tab-panel -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div style='float:left;'>
                    <button type='button' class='btn btn-danger btn-sm btnSubmit'><i class='fas fa-trash'></i> Delete</button>
                    </div>
                      <div class="btn-group" style="float:right;margin-bottom:10px;" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-none btnPrev_Inbox" style="   "><i class='fas fa-angle-left'></i></button>
                            <input type="number" class="form-control txtPageNumber_Inbox_T" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                            <button type="button" class="btn btn-none btnNext_Inbox" style="   "><i class='fas fa-angle-right'></i></button>
                          </div>


                        <table class='table table-hover'>
                            <thead>
                                <tr style='background-color: #f8f9fa!important;'>
                                    <td><span class='fas fa-square'></span></td>
                                    <td><span>Sender</span></td>
                                    <td><span>Subject</span></td>
                                    <td class='text-end'><span>Time</span></td>
                                </tr>
                            </thead>
                            <tbody class='list_inbox'>
                              <?php
                                $li='';

                                $total=count($listInbox);

                                $is_read=false;

                                for ($i=0; $i < $total; $i++) { 

                                  $is_read=false;
                                  if((int)$listInbox[$i]['is_read']==0)
                                  {
                                    $is_read=false;
                                    $li.="<tr style='background-color: #dfdfdf;'>";
                                  }
                                  else
                                  {
                                    $is_read=true;
                                    $li.="<tr>";
                                  }
                                  
                                  $li.="<td><span class='fas fa-square' dataid='".$listInbox[$i]['message_id']."'></span></td>";
                                  $li.="<td><span>".$listInbox[$i]['username']."</span></td>";
                                  $li.="<td><a href='".SITE_URL."message/read-".$listInbox[$i]['message_id']."'>".$listInbox[$i]['subject']."</a></td>";
                                  $li.="<td class='text-end'><span>".$listInbox[$i]['ent_dt']."</span></td>";
                                  $li.="</tr>";
                                }

                                echo $li;
                              ?>
                               
                            </tbody>


                        </table>
                        <div class="btn-group" style="float:right;" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-none btnPrev_Inbox" style="    "><i class='fas fa-angle-left'></i></button>
                          <input type="number" class="form-control txtPageNumber_Inbox_B" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                          <button type="button" class="btn btn-none btnNext_Inbox" style="    "><i class='fas fa-angle-right'></i></button>
                        </div>

                    </div>
                    <!-- tab-panel -->
                    <!-- tab-panel -->
                    <div class="tab-pane" id="pills-sended" role="tabpanel" aria-labelledby="pills-sended-tab">

                        <div class="btn-group" style="float:right;margin-bottom:10px;" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-none btnPrev_Sended" style="    "><i class='fas fa-angle-left'></i></button>
                          <input type="number" class="form-control txtPageNumber_Sended_T" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                          <button type="button" class="btn btn-none btnNext_Sended" style="    "><i class='fas fa-angle-right'></i></button>
                        </div>


                        <table class='table table-hover'>
                            <thead>
                                <tr style='background-color: #f8f9fa!important;'>
                                    <!-- <td><span>Sent to</span></td> -->
                                    <td><span>Subject</span></td>
                                    <td class='text-end'><span>Time</span></td>
                                </tr>
                            </thead>
                            <tbody class='list_sended'>

                            <?php
                                $li='';

                                $total=count($listSended);

                                for ($i=0; $i < $total; $i++) { 
                                  $li.="<tr>";
                                  //$li.="<td><span>".$listSended[$i]['receivers']."</span></td>";
                                  $li.="<td><a href='".SITE_URL."message/read-".$listSended[$i]['message_id']."'>".$listSended[$i]['subject']."</a></td>";
                                  $li.="<td class='text-end'><span>".$listSended[$i]['ent_dt']."</span></td>";
                                  $li.="</tr>";
                                }

                                echo $li;
                              ?>
                               
                            </tbody>


                        </table>

                        <div class="btn-group" style="float:right;" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-none btnPrev_Sended" style="    "><i class='fas fa-angle-left'></i></button>
                          <input type="number" class="form-control txtPageNumber_Sended_B" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                          <button type="button" class="btn btn-none btnNext_Sended" style="    "><i class='fas fa-angle-right'></i></button>
                        </div>

                    </div>
                    <!-- tab-panel -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                        <p>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Title</span>
                        <input type="text" class="form-control new-title" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                      </div>

                        </p>
                        <p>
                        <div class="input-group">
                        <span class="input-group-text">Receivers (seperate by comma)</span>
                        <textarea class="form-control new-receivers" placeholder="username1,username2,username3..." aria-label="Receivers"><?php echo getGet('to','');?></textarea>
                      </div>
                        </p>

                        <p style='border: 1px solid #cbcbcb;'>
                            <textarea id="editor" rows="15" name="send[content]" class="form-control new-editor ckeditor"></textarea>
                        </p>
                        <p>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Attach file</span>
                        <input type="file" class="form-control fileMedias new-attach" multiple placeholder="Attach file" aria-label="Attach file" aria-describedby="basic-addon1">
                      </div>

                        </p>      
                        <?php BB_PHPCode::load('bottom_new_post_options');?>

                        <?php BB_PHPCode::load('attachment_new_thread_page');?>

                        <div class='wrap_attach_files_data'>

                        </div>                        
                        <!-- row -->
                        <div class='row margin-top-20'>
                                            
                            <div class='col-12'>
                            <button type='button' class='btn btn-primary btnSubmit'><i class='fas fa-paper-plane'></i> Send message</button>
                            </div>                    
                        </div>
                        <!-- row -->    
                    </div>
                    <!-- tab-panel -->
                </div>
                <!-- /.tab-content -->


              </div>
            </div>
            <?php BB_PHPCode::load('bottom_message_page');?>
          </div>
          <!-- left -->
          
        </div>
        <!-- row -->

      
      </div>
      <!-- right -->
      

      </div>
      <!-- row -->


      
    </main>
    
    <footer>
      
    </footer>
    
    
  </div>
  <!-- container -->
  <script src="<?php echo SITE_URL; ?>public/ckeditor/ckeditor.js"></script>

  <script>

pageData['attach_files']=[];

pageData['attach_files_upload_status']=0;
pageData['post_attach_files_data']=[];

    CKEDITOR.replace( 'editor' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
  height:500,
});   

pageData['listInbox']='<?php echo json_encode($listInbox);?>';
pageData['listSended']='<?php echo json_encode($listSended);?>';
pageData['action']='<?php echo getGet('action','inbox');?>';

var total_poll_answer=1;


$(document).on('click','.old_attach_files',function(){
        var id=$(this).attr('data-id');
        var path=$(this).attr('data-path');

        if(confirm('Are you want to delete this file ?'))
        {
          // Delete file

          var jsonData={};
          
          jsonData['file_path']=path;
        
          jsonData['type']='1';
          // sendData['save_data']=JSON.stringify(jsonData);

          postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_delete_attach_files_temp', jsonData).then(data => {
            // console.log(data); // JSON data parsed by `data.json()` call

            if(data['data'].indexOf('Done')>=0)
            {
              if($('.old_attach_files_'+id).length > 0)
              {
                $('.old_attach_files_'+id).parent().remove();
              }
            }
            else
            {
              showAlert('',data['data']);
            }
            
          });

        }

    });

    function prepareAttachFilesData()
  {
    var total=pageData['attach_files'].length;

    var li='';

    var fileName='';

    var fileid='';
    for (let i = 0; i < total; i++) {

      fileid=genNumber(5);

      // fileName=pageData['attach_files'][i].split(['/','\\']).pop();
      fileName=pageData['attach_files'][i].split('/').pop().split('#')[0].split('?')[0];

      li+='<div class="input-group mb-3">';
      li+='<button type="button" title="Delete this file" class="btn btn-danger old_attach_files old_attach_files_'+fileid+'  " data-path="'+pageData['attach_files'][i]+'" data-id="'+fileid+'" data-checked="0" style=""><i class="fas fa-trash-alt"></i></button>';
      li+='<span class="input-group-text">'+fileName+'</span>';
      li+='</div>';
    }

    $('.wrap_attach_files_data').append(li);
  }
function prepareInboxData()
{
    var total=pageData['listInbox'].length;

    var li='';

    $('.list_inbox').html('');

    var is_read='';

    for (let i = 0; i < total; i++) {

      if(parseInt(pageData['listInbox'][i]['is_read'])==0)
      {
        li+="<tr style='background-color: #dfdfdf;'>";
      }
      else
      {
        li+="<tr >";
      }
      
      li+="<td><span class='fas fa-square' dataid='"+pageData['listInbox'][i]['message_id']+"'></span></td>";
      li+="<td><span>"+pageData['listInbox'][i]['username']+"</span></td>";
      li+="<td><a href='"+SITE_URL+"message/read-"+pageData['listInbox'][i]['message_id']+"'>"+pageData['listInbox'][i]['subject']+"</a></td>";
      li+="<td class='text-end'><span>"+pageData['listInbox'][i]['ent_dt']+"</span></td>";
      li+="</tr>";
      
    }

    $('.list_inbox').html(li);

}

function prepareSenedData()
{
    var total=pageData['listSended'].length;

    var li='';

    $('.list_sended').html('');

    for (let i = 0; i < total; i++) {
      li+="<tr>";
      //li+="<td><span>"+pageData['listSended'][i]['receivers']+"</span></td>";
      li+="<td><a href='"+SITE_URL+"message/read-"+pageData['listSended'][i]['message_id']+"'>"+pageData['listSended'][i]['subject']+"</a></td>";
      li+="<td class='text-end'><span>"+pageData['listSended'][i]['ent_dt']+"</span></td>";
      li+="</tr>";
      
    }

    $('.list_sended').html(li);

}


    $(document).ready(function(){
      $('.select2js').select2({
       
      });

      
    $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

        $('.search-start_date').val(moment().add('months',-6).format('MM/DD/YYYY'));
        $('.search-end_date').val(moment().format('MM/DD/YYYY'));

        $('.search-sended-start_date').val(moment().add('months',-6).format('MM/DD/YYYY'));
        $('.search-sended-end_date').val(moment().format('MM/DD/YYYY'));


      if(pageData['action']=='compose')
      {
        $('#pills-profile-tab').trigger('click');
      }
    });


  function attach_files_upload_check()
  {
  if(parseInt(masterDB['media_upload_status'])!=2)
  {
    // console.log('Checking...');
    setTimeout(() => {
      attach_files_upload_check();
    }, 200);
  }
  else if(parseInt(masterDB['media_upload_status'])==2)
  {
    // Upload completed
    pageData['attach_files_upload_status']=2;
    pageData['attach_files']=masterDB['media_list'];
    prepareAttachFilesData();
    // console.log(masterDB['media_list']);return false;
    return false;
  }

  }

  $(document).on('change','.fileMedias',function(){
  masterDB['media_list']=[];
  pageData['attach_files']=[];
  // Uploading...
  pageData['attach_files_upload_status']=1;

  attach_files_upload_check();
  // prepareMediaUpload();
  });

// txtPageNumber_Inbox_T


  $(document).on('keyup','.txtPageNumber_Inbox_T',function(){
    var theVal=$(this).val().trim();

    $('.txtPageNumber_Inbox_B').val(theVal);
  });

  $(document).on('keyup','.txtPageNumber_Inbox_B',function(){
    var theVal=$(this).val().trim();

    $('.txtPageNumber_Inbox_T').val(theVal);
  });

  $(document).on('keyup','.txtPageNumber_Sended_T',function(){
    var theVal=$(this).val().trim();

    $('.txtPageNumber_Sended_B').val(theVal);
  });

  $(document).on('keyup','.txtPageNumber_Sended_B',function(){
    var theVal=$(this).val().trim();

    $('.txtPageNumber_Sended_T').val(theVal);
  });

  
$(document).on('click','.btnPrev_Inbox',function(){

var no=$('.txtPageNumber_Inbox_T').val();

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
$('.txtPageNumber_Inbox_T').val(sendData['page_no']);
$('.txtPageNumber_Inbox_B').val(sendData['page_no']);

sendData['type']='1';

pageData['username']=$('.search-username').val().trim();
pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');

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

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];

pageData['listInbox']=[];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_message_inbox', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    pageData['listInbox']=data['data'];
    prepareInboxData();
  });   

});
  
$(document).on('click','.btnNext_Inbox',function(){

var no=$('.txtPageNumber_Inbox_T').val();

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
$('.txtPageNumber_Inbox_T').val(sendData['page_no']);
$('.txtPageNumber_Inbox_B').val(sendData['page_no']);

sendData['type']='1';

pageData['username']=$('.search-username').val().trim();
pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');

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

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['username']=pageData['username'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_message_inbox', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    pageData['listInbox']=data['data'];
    prepareInboxData();
  });   

});
  

$(document).on('click','.btnNext_Sended',function(){

var no=$('.txtPageNumber_Sended_T').val();

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
$('.txtPageNumber_Sended_T').val(sendData['page_no']);
$('.txtPageNumber_Sended_B').val(sendData['page_no']);

sendData['type']='1';

pageData['username']=$('.search-username').val().trim();
pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-sended-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-sended-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');

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

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['username']=pageData['username'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_message_sended', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    pageData['listSended']=data['data'];
    prepareSenedData();
  });   

});

$(document).on('click','.btnPrev_Sended',function(){

var no=$('.txtPageNumber_Sended_T').val();

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
$('.txtPageNumber_Sended_T').val(sendData['page_no']);
$('.txtPageNumber_Sended_B').val(sendData['page_no']);

sendData['type']='1';

pageData['username']=$('.search-sended-username').val().trim();
pageData['keywords']=$('.search-sended-keywords').val().trim();
pageData['start_date']=moment($('.search-sended-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-sended-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');

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

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['username']=pageData['username'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_message_sended', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    pageData['listSended']=data['data'];
    prepareSenedData();
  });   

});


  $(document).on('click','.btnSubmit',function(){
    var sendData={};


    if(pageData['attach_files_upload_status']==1)
    {
      showAlert('','Waiting for upload attach files...');return false;
    }

    var jsonData={};
      
      jsonData['title']=$('.new-title').val();
      jsonData['receivers']=$('.new-receivers').val();
      jsonData['content']=CKEDITOR.instances.editor.getData();

      jsonData['attach_files']='';

      pageData['attach_files']=[];

      if($('.old_attach_files').length > 0)
      {
        $('.old_attach_files').each(function(){
          pageData['attach_files'].push($(this).attr('data-path'));
        });
      }      

      if($('.new_attach_files').length > 0)
      {
        $('.new_attach_files').each(function(){
          pageData['attach_files'].push($(this).attr('data-path'));
        });
      }
      


      var totalFiles=pageData['attach_files'].length;

      for (let i = 0; i < totalFiles; i++) {
        jsonData['attach_files']+=pageData['attach_files'][i]+'|||';
      }
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_new_message', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        if(data['data']=='Done')
        {
          location.href=SITE_URL+'message';
        }
        else
        {
          showAlert('',data['data']);
        }
        // prepareMediaUpload();
        
      });        
    });

  </script>
  