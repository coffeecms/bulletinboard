
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>
  <div class='container  mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>
            <?php BB_PHPCode::load('top_new_thread_page');?>
        <?php load_hook('bb_top_new_thread_page');?>


      <?php 

      $total=count(Configs::$_['forum_breadcum_data']);
      if($total > 0)
      {

        Configs::$_['forum_breadcum_data']=array_reverse(Configs::$_['forum_breadcum_data']);

        $li='';

        for ($i=0; $i < $total; $i++) { 


          $li.='<li class="breadcrumb-item"><a href="'.forum_url(Configs::$_['forum_breadcum_data'][$i]['friendly_url']).'">'.Configs::$_['forum_breadcum_data'][$i]['title'].'</a></li>';
        }       

          $li.='<li class="breadcrumb-item"><a href="'.thread_url($post_data[0]['thread_friendly_url']).'">'.$post_data[0]['thread_title'].'</a></li>';
        echo '
    
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            '.$li.'
          </ol>
        </nav>

        '; 
      }

      ?>       

        <?php BB_PHPCode::load('top_new_post_options');?>

        <!-- List forum threads -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <!-- card -->
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" ><i class='fas fa-comment-alt'></i> Reply</button>
                    </li>
             
                    </ul>
              </div>
              <div class="card-body">

                    

                        <p style='border: 1px solid #cbcbcb;'>
                          
                                <textarea id="editor" rows="15" name="send[content]" class="form-control new-post-content ckeditor"><?php echo stripslashes($post_data[0]['content']);?></textarea>

                        </p>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <!-- card -->
                          <div class="card text-dark bg-light mb-3" style=' '>
                            <div class="card-header" style="background-color: #f8f9fa;padding-top: 13px;padding-bottom: 13px;">
                              <ul class="nav nav-pills" id="pills-tab" role="tablist">

                                  <li class="nav-item" role="presentation">
                                      <button class="nav-link" >Smiles</button>
                                  </li>
                                  
                                  <?php
                                    $total=count(Configs::$_['list_smiles_categories']);
                                    $totalSmiles=count(Configs::$_['list_smiles']);

                                    $li='';

                                    $isActive=' active ';
                                    $isSmilesActive=' show active ';

                                    $smilesContent='';
                                    $listSmiles='';

                                    for ($i=0; $i < $total; $i++) { 


                                      if($i > 0)
                                      {
                                        $isActive='';

                                        $isSmilesActive='';
                                      }


                                      // Category list
                                      $li.='
                                      <li class="nav-item" role="presentation">
                                      <button class="nav-link '.$isActive.'" id="pills-cat-'.Configs::$_['list_smiles_categories'][$i]['category_id'].'-tab" data-bs-toggle="pill" data-bs-target="#pills-cat-'.Configs::$_['list_smiles_categories'][$i]['category_id'].'" type="button" role="tab" aria-controls="pills-cat-'.Configs::$_['list_smiles_categories'][$i]['category_id'].'" aria-selected="false">'.Configs::$_['list_smiles_categories'][$i]['title'].'</button>
                                      </li>
                                      ';

                                      $listSmiles='';
                                      // Smiles in category
                                      for ($k=0; $k < $totalSmiles; $k++) { 
                                        if(Configs::$_['list_smiles'][$k]['category_id']==Configs::$_['list_smiles_categories'][$i]['category_id'])
                                        {
                                          $listSmiles.='
                                          <img src="'.SITE_URL.Configs::$_['list_smiles'][$k]['image_path'].'" class="smile_img" />
                                          ';
                                        }
                                      }

                                      

                                      $smilesContent.='
                                      <!-- tab-panel -->
                                      <div class="tab-pane fade '.$isSmilesActive.'" id="pills-cat-'.Configs::$_['list_smiles_categories'][$i]['category_id'].'" role="tabpanel" aria-labelledby="pills-cat-'.Configs::$_['list_smiles_categories'][$i]['category_id'].'-tab">
                                      '.$listSmiles.'
                                      </div>
                                      <!-- tab-panel -->                                    
                                      ';


                                    }

                                    echo $li;
                                  ?>

                              
                                  </ul>
                            </div>
                            <div class="card-body">

                              <!-- /.tab-content -->
                              <div class="tab-content" id="pills-tabContents">
                                  <?php  echo $smilesContent; ?>                                  
                              </div>
                              <!-- /.tab-content -->


                            </div>
                          </div>
                          <!-- card -->
                      <p>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Attach files</span>
                        <input type="file" name="attach_file[]" multiple class="form-control fileMedias new-attach" placeholder="Attach files" aria-label="Attach files" aria-describedby="basic-addon1">
                      </div>

                        </p> 

                        <?php BB_PHPCode::load('attachment_new_thread_page');?>

                        <div class='wrap_attach_files_data'>

                        </div>

                    </div>
                   
                </div>
                <!-- /.tab-content -->

                <?php BB_PHPCode::load('bottom_new_post_options');?>

                
                <?php if((int)Configs::$_['bb_enable_captcha_quick_reply']==1){ ?>
                <!-- row -->
                <div class='row margin-top-20'>
                                    
                  <div class='col-12'>
                    <strong>Answer below question to verify you not is robot:</strong>
                  </div>                    
                  <div class='col-8'>
                    <?php  if(Configs::$_['bb_system_captcha_method']=='text') { ?>
                    <span><?php echo $captcha_data['title'];?></span>
                      <?php } ?>
                    <?php  if(Configs::$_['bb_system_captcha_method']=='image') { ?>
    <div style="margin:0px;padding:0px;min-width: 280px;min-height:90px;max-width: 280px;max-height:140px;background-color: #2885BF;color:#ffffff;border-radius: 3px;padding:3px;position: relative;">

                          <div class="wrap_catpcha_str" style="margin:0px;padding:0px;float:left;width:100%;min-height:78px;max-height:78px;background-color: #ffffff;border-radius: 3px;">
                              <img src="<?php echo BB_Captcha_Image::make(6);?>" style="margin:0px;padding:0px;" />
                              <span class="btn btn-success btn-refresh-captcha" title="Refresh" style="position: absolute;right:15px;top:22px;"><i class="fa fa-sync"></i></span>
                          </div>
                        </div>
                      <?php } ?>

                  </div>                    
                  <div class='col-4'>
                    <input type='text' placeholder='Type answer here' class='form-control captcha-answer' />
                  </div>                    
                </div>
                <!-- row -->
                <?php } ?>   
                  <!-- row -->
                  <div class='row margin-top-20'>
                                     
                    <div class='col-12'>
                    <button type='button' class='btn btn-primary btnSubmit' style=''><i class='fas fa-paper-plane'></i> Save changes</button>
                    <button type='button' class='btn btn-danger btnDeletePost' style='float:right'><i class='fas fa-trash-alt'></i> Delete this post</button>
                    </div>                    
                  </div>
                  <!-- row -->                
                

              </div>
            </div>
            <!-- card -->
            
            <?php BB_PHPCode::load('bottom_thread_reply_page');?>
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
    CKEDITOR.replace( 'editor' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
  height:500,
});   

var thread_id='<?php echo $post_data[0]['thread_id'];?>';
var forum_id='<?php echo $post_data[0]['forum_id'];?>';

pageData['post_data']=<?php echo json_encode($post_data[0]);?>;
pageData['post_attach_files_data']=[];
pageData['post_attach_files_data']=<?php echo json_encode($post_data[0]['attach_files']);?>;
pageData['attach_files']=[];
pageData['url']='<?php echo post_url($post_data[0]['thread_friendly_url'],$post_data[0]['post_id']);?>';

pageData['attach_files_upload_status']=0;
    $(document).ready(function(){
      $('.select2js').select2({
       
      });

      prepareOldAttachFilesData();
    });

    
function prepareOldAttachFilesData()
{
  var total=pageData['post_attach_files_data'].length;

  var li='';

  for (let i = 0; i < total; i++) {
    li+='<div class="input-group mb-3">';
    li+='<button type="button" title="Delete this file" class="btn btn-danger old_attach_files old_attach_files_'+pageData['post_attach_files_data'][i]['file_id']+' " data-id="'+pageData['post_attach_files_data'][i]['file_id']+'" data-checked="0" style=""><i class="fas fa-trash-alt"></i></button>';
    li+='<span class="input-group-text">'+pageData['post_attach_files_data'][i]['file_name']+'</span>';
    li+='</div>';
  }

  $('.wrap_attach_files_data').html(li);
}

  $(document).on('click','.old_attach_files',function(){
        var id=$(this).attr('data-id');
        var path=$(this).attr('data-path');

        if(confirm('Are you want to delete this file ?'))
        {
          // Delete file

          var jsonData={};
          
          jsonData['forum_id']=pageData['post_data']['forum_id'];
          jsonData['post_id']=pageData['post_data']['post_id'];
          jsonData['file_id']=id;
        
          jsonData['type']='1';
          // sendData['save_data']=JSON.stringify(jsonData);

          postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_delete_post_attach_files', jsonData).then(data => {
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

  $(document).on('click','.new_attach_files',function(){
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
              if($('.new_attach_files_'+id).length > 0)
              {
                $('.new_attach_files_'+id).parent().remove();
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
      li+='<button type="button" title="Delete this file" class="btn btn-danger new_attach_files new_attach_files_'+fileid+'  " data-path="'+pageData['attach_files'][i]+'" data-id="'+fileid+'" data-checked="0" style=""><i class="fas fa-trash-alt"></i></button>';
      li+='<span class="input-group-text">'+fileName+'</span>';
      li+='</div>';
    }

    $('.wrap_attach_files_data').append(li);
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
      // console.log(masterDB['media_list']);return false;
      prepareAttachFilesData();

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

  $(document).on('click','.btnSubmit',function(){
    var sendData={};

    if(pageData['attach_files_upload_status']==1)
    {
      showAlert('','Waiting for upload attach files...');return false;
    }

    var jsonData={};
      
      jsonData['thread_id']=thread_id;
      jsonData['forum_id']=forum_id;
      jsonData['post_id']=pageData['post_data']['post_id'];
      jsonData['content']=CKEDITOR.instances.editor.getData();
      jsonData['captcha_answer']='';
      jsonData['method']='quickreply';
      jsonData['url']='<?php echo post_url($post_data[0]['thread_friendly_url'],$post_data[0]['post_id']);?>';

      if($('.captcha-answer').length==1)
      {
        jsonData['captcha_answer']=$('.captcha-answer').val();
      }

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

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_edit_post', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        if(data['data']!='Done')
        {
            showAlert('',data['data']);
        }
        else
        {
            location.href=pageData['url'];
          
        }

        // prepareMediaUpload();
        
      });        
    });
  
  $(document).on('click','.smile_img',function(){
    var imgUrl=$(this).attr('src');
    // CKEDITOR.instances.editor.insertHTML('<img src="'+imgUrl+'" />');
    CKEDITOR.instances.editor.insertHtml('<img src="'+imgUrl+'" />');

    });
  $(document).on('click','.poll_choice',function(){

    $('.poll_choice').removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-circle"></i>');
    if($(this).hasClass('btn-success'))
    {
      $(this).removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-circle"></i>');
    }
    else
    {
      $(this).removeClass('btn-none').addClass('btn-success').html('<i class="fas fa-dot-circle"></i>');
    }

  });
  $(document).on('click','.poll_option',function(){

    if($(this).hasClass('btn-success'))
    {
      $(this).removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-square"></i>');
    }
    else
    {
      $(this).removeClass('btn-none').addClass('btn-success').html('<i class="fas fa-check-square"></i>');
    }

  });

  </script>
  