
<div class="modal fade" id="modalInvite" style='z-index:99999;' data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invite more</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- body -->
        <span class='block'>Type usernames that you want to invite:</span>
        <div class="input-group mt-3 mb-3">
            
          <input type="text" class="form-control invite-list-user"  placeholder="user1, user2, user3" id="invite-list-user"  aria-describedby="basic-addon2">
          <button type='button' class="btn btn-success"  id="basic-addon2"><i class='fas fa-user'></i></button>
      </div>
                        
        <!-- body -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success btnSendInvite" data-dismiss="modal"><i class="fas fa-paper-plane"></i> Send invite</button>
      <button type="button" class="btn btn-danger "  data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

  <div class='container   mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 '>

        <!-- Threads details -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL.'message';?>">Inbox</a></li>
                  </ol>
                </nav>
              </div>
              <div class="card-body">
                <!-- row -->
                <div class='row'>
                  <div class='col-lg-12'>
                    <h4><?php echo $message_data['subject'];?></h4>
                    
                    <!-- row -->
                    <div class='row'>
                      <div class='col-lg-6 col-md-6 '>
                       
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-none btn-sm " data-id="<?php echo $message_data['message_id'];?>"><i class='fas fa-user'></i> <?php echo $message_data['username'];?></button>
                              <button type="button" class="btn btn-none btn-sm " data-id="<?php echo $message_data['message_id'];?>"><i class='fas fa-clock'></i> <?php echo date('m/d/Y',strtotime($message_data['ent_dt']));?></button>
                            </div>                      
                      </div>
                      <div class='col-lg-6 col-md-6 '>
                          <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                          <a href="<?php echo message_url($message_data['message_id']);?>/page-<?php echo $prev_page_no;?>" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></a>
                          <input type='number' class='form-control setGoToPage' style='margin-left: -5px;width:90px;text-align:center;' value="<?php echo $page_no;?>" />
                          <a href="<?php echo message_url($message_data['message_id']);?>/page-<?php echo $next_page_no;?>" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></a>
                          </div>
                      </div>
                    </div>
                    <!-- row -->

                    <hr>
                  </div>                    
                  <!-- <div class='col-lg-12'>
                    <span style='font-size: 10pt;'>Trạng thái: Mở</span>
                  </div>                     -->
                </div>
                <!-- row -->
                <!-- row -->
                <div class='row'>
                  <div class='col-lg-12'>
                    

                   
              
                    <!-- thread item -->
                    <!-- row -->
                    <div class='row' style='display: inline-flex;width:100%;'>
                      <!-- left -->
                      <div class='col-lg-3 col-md-4 '>
                        <div class='thread_author_profile'>
                          <div class="card">
                            <?php echo user_post_avatar($message_data['username'],$message_data['avatar']);?>
                            <div class="card-body text-center">
                              <span class="card-title block"><a href="<?php echo profile_url($message_data['username']);?>"><?php echo $message_data['username'];?></a></span>
                              <span class="card-title block"><a href="#" style='font-size: 10pt;'><?php echo $message_data['group_title'];?></a></span>
                            </div>
                            
                            <div class="card-body d-none d-sm-none d-md-block ">
                              <!-- row -->
                              <div class='row' style='font-size: 9pt;'>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Joined:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo date('M d, Y',strtotime($message_data['user_ent_dt']));?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Threads:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format($message_data['threads']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Replies:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format($message_data['posts']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Reactions:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format($message_data['reactions']);?></span>
                                </div>
                                <div class='col-lg-6 col-md-6 '>
                                  <span>Points:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format($message_data['total_points']);?></span>
                                </div>
                             

                              </div>
                              <!-- row -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- right -->
                      <div class='col-lg-9 col-md-8 '>

                        <!-- row -->
                        <div class='row' style='font-size: 10pt;'>
                          <div class='col-9'>
                            <span><?php echo date('M d, Y H:m:i',strtotime($message_data['ent_dt']));?></span>
                          </div>
                          <div class='col-3 text-end'>
                          </div>
                          
                        </div>
                        <!-- row -->
                        <hr>                      
                        <div class='thread_content thread_<?php echo $message_data['message_id'];?>' data='<?php echo $message_data['message_id'];?>'>
                        <?php echo stripslashes($message_data['content']);?>
                        </div>

                        
                        <?php

                          $totalAttach=0;
                          $list_attach='';

                          $totalAttach=count($message_data['attach_files']);

                          if($totalAttach > 0)
                          {
                            for ($k=0; $k < $totalAttach; $k++) { 
                              $list_attach.='
                              <div class="input-group mb-3">
                              <button type="button" class="btn btn-warning" ><i class="fas fa-file"></i></button>
                              <a href="'.attach_file_download_url($message_data['attach_files'][$k]['file_id']).'" class="btn btn-none">'.$message_data['attach_files'][$k]['file_name'].'</a>
                            </div>                            
                              ';
                            }

                            $list_attach='
                            <!-- attach_files -->
                            <!-- row -->
                            <div class="row margin-top-20 margin-bottom-20" style="font-size: 10pt;">
                              <div class="col-12">
                                <span class="text-danger" style="font-weight: 600; display: block; margin-bottom: 10px;  font-size: 15pt;">Attachments</span>
                              
                                  '.$list_attach.'                             
                            
                              </div>
                            </div>
                            <!-- row -->                        
                            <!-- attach_files -->

                            ';

                          }

                          echo $list_attach;

                        ?>



                        <?php if(strlen($message_data['signature']) > 0){ ?>
                        <!-- signature -->
                        <!-- row -->
                        <div class='row margin-top-20 margin-bottom-20' style='font-size: 10pt;'>
                          <div class='col-12'>
                            <hr>
                          <blockquote><?php echo stripslashes($message_data['signature']);?></blockquote>
                          </div>
                        </div>
                        <!-- row -->                        
                        <!-- signature -->
                        <?php } ?>

                        <!-- row -->
                        <div class='row margin-top-20' style='font-size: 10pt;'>
                          <!-- col -->
                          <div class='col-lg-6 col-md-6 col-sm-6 '>
                         
                          </div>
                          <!-- col -->
                          <!-- col -->
                          <div class='col-lg-6 col-md-6 col-sm-6 text-end'>
                       
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <!--<button type="button" class="btn btn-success btn-sm btn_create_thread_quote" data-id="<?php echo $message_data['message_id'];?>"><i class='fas fa-plus-square'></i> Quote</button>-->
                              <button type='button' class="btn btn-success btn-sm btnPost_Reply" data-post-id="<?php echo $message_data['message_id'];?>" data-username="<?php echo $message_data['username'];?>"><i class='fas fa-reply'></i> Reply</button>
                            </div>
                          </div>
                          <!-- col -->
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class='row margin-top-20 margin-bottom-20' style='font-size: 10pt;'>
                          <!-- col -->
                          <div class='col-lg-12 '>
                            
                          </div>
                          <!-- col -->
                         
                        </div>
                        <!-- row -->
                        
                      </div>

                    </div>
                    <!-- row --><hr>
                    <!-- thread item -->

                    
                    <?php

                    $totalReaction=0;

                    $li_reactions_post='';

                    $left=5;

                    
                    $total=count($list_post);

                    $li='';

                    $totalThreadReactions=0;
                    $thisUserReaction=0;

                    $re_txt='';

                    $list_attach='';

                    $totalAttach=0;

                    $signature='';

                    for ($i=0; $i < $total; $i++) { 

                      $li_reactions_post='';

                      $list_attach='';

                      $signature='';
                      
                      if(strlen($list_post[$i]['signature']) > 0)
                      {
                        $signature='
                        <!-- signature -->
                        <!-- row -->
                        <div class="row margin-top-20 margin-bottom-20" style="font-size: 10pt;">
                          <div class="col-12">
                            <hr>
                          <blockquote>'.stripslashes($list_post[$i]['signature']).'</blockquote>
                          </div>
                        </div>
                        <!-- row -->                        
                        <!-- signature -->                       
                        ';
                      }

                      $totalAttach=count($list_post[$i]['attach_files']);

                      if($totalAttach > 0)
                      {
                        for ($k=0; $k < $totalAttach; $k++) { 
                          $list_attach.='
                          <div class="input-group mb-3">
                          <button type="button" class="btn btn-warning" ><i class="fas fa-file"></i></button>
                          <a href="'.attach_file_download_url($list_post[$i]['attach_files'][$k]['file_id']).'" class="btn btn-none">'.$list_post[$i]['attach_files'][$k]['file_name'].'</a>
                        </div>                            
                          ';
                        }

                        $list_attach='
                        <!-- attach_files -->
                        <!-- row -->
                        <div class="row margin-top-20 margin-bottom-20" style="font-size: 10pt;">
                          <div class="col-12">
                            <span class="text-danger" style="font-weight: 600; display: block; margin-bottom: 10px;  font-size: 15pt;">Attachments</span>
                           
                              '.$list_attach.'                             
                        
                          </div>
                        </div>
                        <!-- row -->                        
                        <!-- attach_files -->

                        ';

                      }

                      $left=5;

                      $li.='
                      <!-- thread item -->
                      <!-- row -->
                      <div class="row" style="display: inline-flex;width: 100%;">
                        <!-- left -->
                        <div class="col-lg-3 col-md-4 ">
                          <div class="thread_author_profile">
                            <div class="card">
                              '.user_post_avatar($list_post[$i]['username'],$list_post[$i]['avatar']).'
                              <div class="card-body text-center">
                                <span class="card-title block"><a href="'.profile_url($list_post[$i]['username']).'">'.$list_post[$i]['username'].'</a></span>
                                <span class="card-title block"><a href="#" style="font-size: 10pt;">'.$list_post[$i]['group_title'].'</a></span>
                              </div>
                              
                              <div class="card-body d-none d-sm-none d-md-block ">
                                <!-- row -->
                                <div class="row" style="font-size: 9pt;">
                                  <div class="col-lg-6 col-md-6">
                                    <span>Joined:</span></span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 text-end">
                                    <span>'.date('M d, Y',strtotime($list_post[$i]['user_ent_dt'])).'</span>
                                  </div>
                                  <div class="col-lg-6 col-md-6">
                                    <span>Threads:</span></span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 text-end">
                                    <span>'.number_format($list_post[$i]['threads']).'</span>
                                  </div>

                                  <div class="col-lg-6 col-md-6">
                                    <span>Replies:</span></span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 text-end">
                                    <span>'.number_format($list_post[$i]['posts']).'</span>
                                  </div>

                                  <div class="col-lg-6 col-md-6">
                                    <span>Reactions:</span></span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 text-end">
                                    <span>'.number_format($list_post[$i]['reactions']).'</span>
                                  </div>

                                  <div class="col-lg-6 col-md-6">
                                    <span>Points:</span></span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 text-end">
                                    <span>'.number_format($list_post[$i]['total_points']).'</span>
                                  </div>

                                  
  
                                </div>
                                <!-- row -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- right -->
                        <div class="col-lg-9 col-md-8 ">

                          <!-- row -->
                          <div class="row" style="font-size: 10pt;">
                            <div class="col-9">
                              <span id="post_'.$list_post[$i]['message_id'].'">'.date('M d, Y H:m:i',strtotime($list_post[$i]['ent_dt'])).'</span>
                            </div>
                            <div class="col-3 text-end">

                            </div>
                            
                          </div>
                          <!-- row -->
                          <hr>                           
                          <div class="thread_content thread_'.$list_post[$i]['message_id'].'"  data="'.$list_post[$i]['message_id'].'">
                          '.$list_post[$i]['content'].'
                          </div>

                          '.$list_attach.'


                          '.$signature.'  
                          <!-- row -->
                          <div class="row margin-top-20" style="font-size: 10pt;">
                            <!-- col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 text-end">

                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-success btn-sm btnPost_Reply" data-post-id="'.$list_post[$i]['message_id'].'" data-username="'.$list_post[$i]['username'].'"><i class="fas fa-reply"></i> Reply</a>
                              </div>
                            </div>
                            <!-- col -->
                          </div>
                          <!-- row -->                                                 
                          <!-- row -->
                          <div class="row margin-top-20 margin-bottom-20" style="font-size: 10pt;">
                            <div class="col-12">

                            </div>
                        
                          </div>
                          <!-- row -->
                          
                        </div>
  
                      </div>
                      <!-- row --><hr>
                      <!-- thread item -->

                      ';
                    }
                    echo $li;
                    ?>
                          <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                          <a href="<?php echo message_url($message_data['message_id']);?>/page-<?php echo $prev_page_no;?>" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></a>
                          <input type='number' class='form-control setGoToPage' style='margin-left: -5px;width:90px;text-align:center;' value="<?php echo $page_no;?>" />
                          <a href="<?php echo message_url($message_data['message_id']);?>/page-<?php echo $next_page_no;?>" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></a>
                          </div>
                  </div>                    
                </div>
                <!-- row -->


                <?php if((int)$message_data['allow_reply']==1){ ?>
                <!-- row -->
                <div class='row row-quick-reply margin-top-10'>
                    <div class='col-lg-12'>
                      <p style='border: 1px solid #cbcbcb;'>
                              <textarea id="editor" rows="15" name="send[content]" class="form-control new-post-content ckeditor"></textarea>
                          </p>
                    </div>
                </div>
                <!-- row -->

                <p>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Attach file</span>
                        <input type="file" class="form-control fileMedias new-attach" multiple placeholder="Attach file" aria-label="Attach file" aria-describedby="basic-addon1">
                      </div>

                        </p>  

                      <?php BB_PHPCode::load('attachment_new_thread_page');?>

                      <div class='wrap_attach_files_data'>

                      </div>
                  <!-- row -->
                  <div class='row margin-top-20'>
                                     
                    <div class='col-12 text-center'>
                    <button type='button' class='btn btn-primary btnSendReply'><i class='fas fa-paper-plane'></i> Send Reply</button>
                    </div>                    
                  </div>
                  <!-- row -->
                  <?php } ?> 

              </div>
            </div>
            
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->
      
      </div>
      <!-- right -->
      <div class='col-lg-3 col-md-3 '>
        <!-- card -->
        <div class="card margin-bottom-20" >
          <div class="card-body">
            <h5 class="card-title" style='font-size: 13pt;'>Conversation Members</h5>
            <?php
                $li='';

                $totalMembers=count($message_data['receivers']);

                for ($i=0; $i < $totalMembers; $i++) { 
                    $li.='<a href="'.profile_url($message_data['receivers'][$i]['target_username']).'" class="card-link" style="font-size: 10pt;">'.$message_data['receivers'][$i]['target_username'].'</a><span style="font-size: 10pt;margin-right:5px;">,</span>';
                }

                echo $li;
            ?>
            

          </div>
          <div class="card-footer text-muted">
            <span style='font-size: 9pt;'>Total: <?php echo number_format($totalMembers);?></span>

            <button type='button' class='btn btn-sm btn-warning btnAddMoreuser' style='float:right;'><i class='fas fa-plus-square'></i> Invite more</button>
          </div>
        </div>
        <!-- card -->
        

      </div>
      <!-- left -->

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
pageData['post_attach_files_data']=[];

pageData['attach_files_upload_status']=0;

    pageData['page_no']='<?php echo $page_no;?>';
    pageData['message_id']='<?php echo $message_id;?>';

    CKEDITOR.replace( 'editor' ,{
      extraPlugins: 'wordcount,notification,texttransform,justify',
      height:250,
    });   


$(document).ready(function(){
  var url=location.href;

  // Scroll to post
  if(url.indexOf('post-')>=0)
  {
    var splitUrl=url.split('post-');

    $('html, body').animate({
                    scrollTop: $('#post_'+splitUrl[1]).offset().top
    }, 500);
    
  }

  new ClipboardJS('.btn');

});


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

  $('.wrap_attach_files_data').html(li);
}

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


$(document).on('click','.btnAddMoreuser',function(){
  $('.invite-list-user').val('');
  $('#modalInvite').modal('show');

});

$(document).on('click','.btnCopyShareUrl',function(){

  if($(this).hasClass('btn-success'))
  {
    $(this).removeClass('btn-success').addClass('btn-primary');
  }
  else
  {
    $(this).removeClass('btn-primary').addClass('btn-success');
  }

});

$(document).on('click','.btnPost_Reply',function(){
  var post_id=$(this).attr('data-post-id');
  var username=$(this).attr('data-username');

  var content=$('.thread_'+post_id).html();


  CKEDITOR.instances.editor.insertHtml('<blockquote class="quote">'+username+' said: <br>'+content+'</blockquote><br><br>');
 
  $([document.documentElement, document.body]).animate({
        scrollTop: $(".btnSendReply").offset().top
    }, 500);
});


$(document).on('click','.btnSendReply',function(){
    var sendData={};

    if(pageData['attach_files_upload_status']==1)
    {
      showAlert('','Waiting for upload attach files...');return false;
    }

    var jsonData={};
      
      jsonData['message_id']=pageData['message_id'];
      jsonData['content']=CKEDITOR.instances.editor.getData();

      jsonData['attach_files']='';
     
      var totalFiles=pageData['attach_files'].length;

      for (let i = 0; i < totalFiles; i++) {
        jsonData['attach_files']+=pageData['attach_files'][i]+'|||';
      }

      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_message_reply', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        
        location.reload();
        // prepareMediaUpload();
      });        
    });
  

$(document).on('click','.btnSendInvite',function(){
    var sendData={};

    var listUsers=$('.invite-list-user').val().trim();

    // if(pageData['attach_files_upload_status']==1)
    // {
    //   showAlert('','Waiting for upload attach files...');return false;
    // }

    if(listUsers.length==0)
    {
        showAlert('','Type username that user want to invite!');
        return false;
    }

    var jsonData={};
      
      jsonData['invite_users']=listUsers;
      jsonData['message_id']=pageData['message_id'];

      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_message_invites', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        
        $('#modalInvite').modal('hide');
        if(data['data']!='Done')
        {
            showAlert('',data['data']);
        }
        else
        {
            location.reload();
        }
        // prepareMediaUpload();
      });        
    });
  

</script>