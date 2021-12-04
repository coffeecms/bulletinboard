
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

        <!-- List forum threads -->


      <?php 

      $total=count(Configs::$_['forum_breadcum_data']);
      if($total > 0)
      {

        Configs::$_['forum_breadcum_data']=array_reverse(Configs::$_['forum_breadcum_data']);

        $li='';

        for ($i=0; $i < $total; $i++) { 


          $li.='<li class="breadcrumb-item"><a href="'.forum_url(Configs::$_['forum_breadcum_data'][$i]['friendly_url']).'">'.Configs::$_['forum_breadcum_data'][$i]['title'].'</a></li>';
        }       

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


        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <!-- card -->
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum" >
                <ul class="nav nav-pills nav-pills-newthread" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" ><i class='fas fa-comment-alt'></i> Post</button>
                    </li>
                    
                    <?php if((int)Configs::$_['bb_system_poll']==1){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class='fas fa-poll'></i> Poll</button>
                    </li>
                    <?php } ?>
                
                    </ul>
              </div>
              <div class="card-body">
              <?php load_hook('bb_top_write_thread_tools');?>
                <?php BB_PHPCode::load('bb_top_write_thread_tools');?>

                      <div class="input-group mb-3" >
                            <select class='form-control new-thread-type select2js' style='width:220px;max-width:220px;'>
                            <?php 
                              $li='';

                              $total=count(Configs::$_['list_post_prefix']);

                              for ($i=0; $i < $total; $i++) { 
                                $li.='<option value="'.Configs::$_['list_post_prefix'][$i]['prefix_id'].'">'.Configs::$_['list_post_prefix'][$i]['title'].'</option>';
                              }

                              echo $li;

                            ?>
                          </select>
                            <input type="text" class="form-control new-title" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                        </div>

                        <p style='border: 1px solid #cbcbcb;'>
                            <textarea id="editor" rows="15" name="send[content]" class="form-control new-post-content ckeditor"></textarea>
                        </p>
              <?php load_hook('bb_bottom_write_thread_tools');?>
              <?php BB_PHPCode::load('bb_bottom_write_thread_tools');?>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <!-- card -->
                          <div class="card text-dark bg-light mb-3" style=' '>
                            <div class="card-header card-header-forum">
                              <ul class="nav nav-pills nav-pills-emo" id="pills-tab" role="tablist">

                                  <li class="nav-item" role="presentation">
                                      <button class="nav-link link-start" >Smiles</button>
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
                                          <img alt="Emo '.$k.'" data-src="'.SITE_URL.Configs::$_['list_smiles'][$k]['image_path'].'" class="lozad smile_img" />
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

                        <?php if(bb_forum_has_permission($forum_id,'BB20010')==false && bb_forum_has_permission($forum_id,'BB10010')==true){ ?>           
                        <div class="input-group mb-3">
                          <button type="button" class="btn btn-primary pin_thread btn-none"  data-checked="0" style=""><i class="fas fa-square"></i></button>
                          <span class="input-group-text">Pin this thread</span>
                          
                          </div>
                        <div class="input-group mb-3">
                          <button type="button" class="btn btn-primary disallow_reply btn-none"  data-checked="0" style=""><i class="fas fa-square"></i></button>
                          <span class="input-group-text">Disallow reply</span>
                          
                          </div>
                          <?php } ?>
                        <p>
                          <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Tags</span>
                          <input type="text" class="form-control new-tags" aria-label="Tags" aria-describedby="basic-addon1">
                        </div>

                        </p>

                        <p>
                          <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Keywords</span>
                          <input type="text" class="form-control new-keywords" aria-label="Keywords" aria-describedby="basic-addon1">
                        </div>

                        </p>
                        

                    </div>
                    <!-- tab-panel -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <p>
                          <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Question</span>
                          <input type="text" class="form-control add_poll_question" aria-label="Question" aria-describedby="basic-addon1">
                        </div>

                        </p>
                      <div class='wrap_list_poll_answer'>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Answer 1</span>
                            <input type="text" class="form-control answer_poll" aria-label="Answer" aria-describedby="basic-addon1">
                          </div>


                        </div>

                        <p>
                          <span>Choice</span>

                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_choice poll_choice_unique btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-circle"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Unique</span>
                            
                          </div>
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_choice poll_choice_multi_unique btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-circle"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Multi choice</span>
                            
                          </div>
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_choice poll_choice_max btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-circle"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Maximum</span>
                            
                            <input type="number" class="input-control poll_choice_max_number" value="7" style='height: 38px;width:70px;text-align:center;' aria-label="Answer" aria-describedby="basic-addon1">

                            
                          </div>
                        </p>
                        <p>
                          <span>Options</span>

                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_option poll_option_1 btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-square"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Allow member change answer</span>
                            
                          </div>
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_option poll_option_2 btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-square"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Allow guest access</span>
                            
                          </div>
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary poll_option poll_option_3 btn-none" data-value="1" data-checked="0" style=""><i class="fas fa-square"></i></button>
                            <span class="input-group-text multi_lang" data-code="text020">Close poll after</span>
                            
                            <input type="number" class="input-control poll_option_3_number" value="7" style='height: 38px;width:70px;text-align:center;' aria-label="Answer" aria-describedby="basic-addon1">

                            <span class="input-group-text multi_lang" data-code="text020">days</span>
                            
                          </div>


                        </p>
                    </div>
                    <!-- tab-panel -->
                </div>
                <!-- /.tab-content -->

                <?php BB_PHPCode::load('bottom_new_post_options');?>

                <?php if((int)Configs::$_['bb_enable_captcha_in_new_thread']==1){ ?>
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
                                     
                    <div class='col-12 text-center'>
                    <button type='button' class='btn btn-primary btnSubmit'><i class='fas fa-paper-plane'></i> Create new thread</button>
                    </div>                    
                  </div>
                  <!-- row -->                
                

              </div>
            </div>
            <!-- card -->
           
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->
        <?php BB_PHPCode::load('bottom_new_thread_page');?>
        <?php load_hook('bb_bottom_new_thread_page');?>

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

var forum_id='<?php echo $forum_id;?>';
pageData['attach_files']=[];
pageData['post_attach_files_data']=[];

pageData['attach_files_upload_status']=0;
var total_poll_answer=1;
    $(document).ready(function(){
      $('.select2js').select2({
       
      });
    });


    $(document).on('keyup','.answer_poll',function(){
      var total=$('.answer_poll').length-1;

      var theVal=$('.answer_poll:eq('+total.toString()+')').val().trim();

      if(theVal.length > 0)
      {

        total_poll_answer+=1;
        var li='';
        li+='<div class="input-group mb-3">';
        li+='<span class="input-group-text" id="basic-addon1">Answer '+total_poll_answer.toString()+'</span>';
        li+='<input type="text" class="form-control answer_poll" aria-label="Answer" aria-describedby="basic-addon1">';
        li+='</div>';



        $('.wrap_list_poll_answer').append(li);

      }
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

  $(document).on('click','.pin_thread',function(){
    
    if($(this).hasClass('btn-success'))
    {
      $(this).removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-square"></i>');
    }
    else
    {
      $(this).removeClass('btn-none').addClass('btn-success').html('<i class="fas fa-check-square"></i>');
    }
  });
 
  $(document).on('click','.disallow_reply',function(){
    
    if($(this).hasClass('btn-success'))
    {
      $(this).removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-square"></i>');
    }
    else
    {
      $(this).removeClass('btn-none').addClass('btn-success').html('<i class="fas fa-check-square"></i>');
    }
  });
 

  

  $(document).on('click','.btnSubmit',function(){
    var sendData={};


    if(pageData['attach_files_upload_status']==1)
    {
      showAlert('','Waiting for upload attach files...');return false;
    }

    var jsonData={};
      
      jsonData['forum_id']=forum_id;
      jsonData['prefix']=$('.new-thread-type').val();
      jsonData['title']=$('.new-title').val();
      jsonData['content']=CKEDITOR.instances.editor.getData();
      jsonData['tags']=$('.new-tags').val();
      jsonData['keywords']=$('.new-keywords').val();

      jsonData['pin_thread']='0';
      jsonData['allow_reply']='1';

      if($('.pin_thread').length > 0)
      {
        if($('.pin_thread').hasClass('btn-success'))
        {
          jsonData['pin_thread']='1';
        }
      }

      if($('.disallow_reply').length > 0)
      {
        if($('.disallow_reply').hasClass('btn-success'))
        {
          jsonData['allow_reply']='0';
        }
      }
     

      jsonData['poll_choice']='unique';
      jsonData['poll_question']=$('.add_poll_question').val().trim();
      jsonData['poll_choice_max']=$('.poll_choice_max_number').val().trim();
      jsonData['allow_change_answer']='0';
      jsonData['allow_guest_access']='0';
      jsonData['set_close_poll_day']='0';
      jsonData['close_poll_end_dt']='0';
      jsonData['poll_answer']='';
      jsonData['attach_files']='';
      jsonData['close_poll_day_total']=$('.poll_option_3_number').val().trim();

      jsonData['captcha_answer']='';
      jsonData['method']='quickreply';

      if($('.captcha-answer').length==1)
      {
        jsonData['captcha_answer']=$('.captcha-answer').val();
      }


      $('.answer_poll').each(function(){
        if($(this).val().trim().length > 0)
        {
          jsonData['poll_answer']+=$(this).val().trim()+'|||';
        }
        
      });

      if(jsonData['poll_question'].length > 0 && jsonData['poll_answer'].length < 4)
      {
        showAlert('','');
        alert('Poll answer not allow blank!');return false;
      }

      
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

      if($('.poll_choice_multi_unique').hasClass('btn-success'))
      {
        jsonData['poll_choice']='multi';
      }

      if($('.poll_choice_max').hasClass('btn-success'))
      {
        jsonData['poll_choice']='max';
      }

      if($('.poll_option_1').hasClass('btn-success'))
      {
        jsonData['allow_change_answer']='1';
      }

      if($('.poll_option_2').hasClass('btn-success'))
      {
        jsonData['allow_guest_access']='1';
      }

      jsonData['close_poll_end_dt']=moment().add('years',jsonData['close_poll_day_total']).format('YYYY-MM-DD');

      if($('.poll_option_3').hasClass('btn-success'))
      {
        jsonData['set_close_poll_day']='1';
        jsonData['close_poll_end_dt']=moment().add('days',jsonData['close_poll_day_total']).format('YYYY-MM-DD');

      }
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_new_thread', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        if(data['data'].indexOf('http')>=0)
        {
          location.href=data['data'];
        }
        else
        {
          showAlert('',data['data']);
        }        

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
  