
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>
  <div class='container   mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 '>
    
      <?php BB_PHPCode::load('top_profile_page');?>
        <!-- List forum threads -->

        
        <!-- row -->
        <div class='row'>
          
            <!-- cover image -->
            <div class='col-lg-12 margin-bottom-20'>
                <div class="card">
                    <?php 
                    if(isset($bb_user_profile_data['wall_banner'][5]))
                    {
                      echo '<img src="'.SITE_URL.$bb_user_profile_data['wall_banner'].'" class="card-img-top" alt="Cover image">';
                    }
                    ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $bb_user_profile_mst['username'];?></h5>
                        <p class="card-text"><?php echo $bb_user_profile_mst['group_title'];?></p>
                    </div>
                    <ul class="list-group list-group-flush" style='font-size:11pt;'>
                        <li class="list-group-item">Register date: <span class='profile-register-dt'><?php echo date('M d, Y',strtotime($bb_user_profile_mst['register_dt']));?></span></li>
                        <li class="list-group-item">Latest login: <span class='profile-latestlogin-dt'><?php echo date('M d, Y H:m:i',strtotime($bb_user_profile_mst['last_logined']));?></span></li>
                        <li class="list-group-item">Threads: <span class='profile-threads'><?php echo number_format($bb_user_profile_data['threads']);?></span></li>
                        <li class="list-group-item">Posts: <span class='profile-posts'><?php echo number_format($bb_user_profile_data['posts']);?></span></li>
                        <li class="list-group-item">Reactioneds: <span class='profile-reactioneds'><?php echo number_format($bb_user_profile_data['reactions']);?></span></li>
                        <li class="list-group-item">Followers: <span class='profile-reactioneds'><?php echo number_format($bb_user_profile_data['total_followers']);?></span></li>
                        <li class="list-group-item">Followings: <span class='profile-reactioneds'><?php echo number_format($bb_user_profile_data['total_follows']);?></span></li>

                        <li class="list-group-item">
                            <?php $total=count($follow_data); if($total > 0) { ?>
                              <button type='button' class='btn btn-sm btn-success btnFollow' data-id='<?php echo $bb_user_profile_mst['user_id'];?>' data-username='<?php echo $bb_user_profile_mst['username'];?>'><i class='fas fa-plus-square'></i> Followed</button>
                            <?php }else { ?>
                              <button type='button' class='btn btn-sm btn-primary btnFollow' data-id='<?php echo $bb_user_profile_mst['user_id'];?>' data-username='<?php echo $bb_user_profile_mst['username'];?>'><i class='fas fa-plus-square'></i> Follow</button>
                            <?php } ?>

                            <a href='<?php echo SITE_URL;?>message?to=<?php echo $bb_user_profile_mst['username'];?>&action=compose' class='btn btn-sm btn-primary btnSendMessage'><i class='fas fa-comment-alt'></i> Send a message</a>
                        </li>
                    </ul>
                    
                </div>
                <?php BB_PHPCode::load('bottom_profile_page');?>
            </div>
            <!-- cover image -->
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum" >
                <ul class="nav nav-pills nav-pills-profile" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" ><i class='fas fa-comment-alt'></i> Wall</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-activities-tab" data-bs-toggle="pill" data-bs-target="#pills-activities" type="button" role="tab" aria-controls="pills-activities" aria-selected="false"><i class='fas fa-poll'></i> Activities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-latestthread-tab" data-bs-toggle="pill" data-bs-target="#pills-latestthread" type="button" role="tab" aria-controls="pills-latestthread" aria-selected="false"><i class='fas fa-file-alt'></i> Latest threads</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-about-tab" data-bs-toggle="pill" data-bs-target="#pills-about" type="button" role="tab" aria-controls="pills-about" aria-selected="false"><i class='fas fa-id-badge'></i> About</button>
                    </li>
                
                    </ul>
              </div>
              <div class="card-body">

                    
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                   
                        <?php if(Configs::$_['user_data']['username']!='GUEST'){ ?>
                          <?php 
                          
                          if((int)$bb_user_profile_data['allow_other_write_on_profile']==3){
                              if(!isset($theData['following_data'][Configs::$_['user_data']['user_id']]))
                              {
                                return '';
                              }
                          }
  
                          ?>
                          <p>
                            <textarea id="editor" rows="15" name="send[content]" class="form-control post-content ckeditor"></textarea>
                        </p>
                        <?php if((int)Configs::$_['bb_enable_captcha_when_send_wall_message']==1){ ?>
                        <!-- row -->
                        <div class='row margin-top-20 margin-bottom-20'>
                                            
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
                        <div class="col-12">
                        <button type="button" class="btn btn-primary btnSubmit"><i class="fas fa-paper-plane"></i> Create new message</button>
                        </div>  
                        <?php } ?>

                        


                        <table class='table table-hover'>
                            <thead>
                            <tr>
                            <th>Title</th>
                            <th class="text-end">Date Time</th>
                          </tr>
                          </thead>

                          <tbody class='comment_body'>
                          <tr>
                            <td>Content</td>
                            <td class="text-end">Date Time</td>
                          </tr>                              
                          </tbody>
                        </table>
                    </div>
                    <!-- tab-panel -->
                    <div class="tab-pane fade " id="pills-activities" role="tabpanel" aria-labelledby="pills-activities-tab">
                      <table class='table table-hover'>
                          <thead>
                          <tr>
                          <th>Content</th>
                          <th class="text-end">Date Time</th>
                        </tr>
                        </thead>

                        <tbody class='activities_body'>
                        <tr>
                          <td>Content</td>
                          <td class="text-end">Date Time</td>
                        </tr>                              
                        </tbody>
                      </table>
                    </div>
                    <!-- tab-panel -->
                    <div class="tab-pane fade" id="pills-latestthread" role="tabpanel" aria-labelledby="pills-latestthread-tab">
                      <table class='table table-hover'>
                            <thead>
                            <tr>
                            <th>Title</th>
                            <th class="text-end">Date Time</th>
                          </tr>
                          </thead>

                          <tbody class='threads_body'>
                          <tr>
                            <td>Content</td>
                            <td class="text-end">Date Time</td>
                          </tr>                              
                          </tbody>
                        </table>
                    </div>
                    <!-- tab-panel -->
                    <div class="tab-pane fade" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                        <!-- Sign -->
                        <div class='row'>
                          <div class='col-lg-12'>
                          <label>Signature</label>
                            <?php echo $bb_user_profile_data['signature'];?>

                            <hr>


                          </div>
                        </div>
                        <!-- Sign -->
                        <div class='row'>
                          <div class='col-lg-12'>
                            <label>About</label>
                            <?php echo $bb_user_profile_data['about'];?>

                            <hr>


                          </div>
                        </div>
                        <!-- row   -->

                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Birthday:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['birthday'];?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Website:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['website']; ?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Address:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['address']; ?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Phone:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['phone1']; ?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Gender:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['gender']; ?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Skills:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <?php echo $bb_user_profile_data['skills']; ?>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Facebook:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['facebook']; ?>"><?php echo $bb_user_profile_data['facebook']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Twitter:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['twitter']; ?>"><?php echo $bb_user_profile_data['twitter']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>ICQ:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['icq']; ?>"><?php echo $bb_user_profile_data['icq']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>AIM:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['aim']; ?>"><?php echo $bb_user_profile_data['aim']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Skype:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['skype']; ?>"><?php echo $bb_user_profile_data['skype']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Occupation:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['job']; ?>"><?php echo $bb_user_profile_data['job']; ?></a>
                          </div>
                        </div>
                        <!-- row -->
                        <!-- row   -->
                        <div class='row'>
                          <div class='col-lg-2 col-md-2 col-sm-4 '>
                            <span>Google Talk:</span>
                          </div>
                          <div class='col-lg-2 col-md-2 col-sm-8 '>
                            <a href="<?php echo $bb_user_profile_data['google_talk']; ?>"><?php echo $bb_user_profile_data['google_talk']; ?></a>
                          </div>
                        </div>
                        <!-- row -->


                    </div>
                    <!-- tab-panel -->
                </div>
                <!-- /.tab-content -->

                  <!-- row -->
                  <div class='row margin-top-20'>
                                     
                  
                  </div>
                  <!-- row -->                
                

              </div>
            </div>
            
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->

      
      </div>
      <!-- right -->
     
  <script src="<?php echo SITE_URL; ?>public/ckeditor/ckeditor.js"></script>

  <script>
    CKEDITOR.replace( 'editor' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
});   

pageData['bb_user_profile_mst']=<?php echo json_encode($bb_user_profile_mst);?>;
pageData['bb_user_profile_data']=<?php echo json_encode($bb_user_profile_data);?>;
pageData['listActivities']=<?php echo json_encode($listActivities);?>;
pageData['listThreads']=<?php echo json_encode($listThreads);?>;
pageData['listWallPosts']=<?php echo json_encode($listWallPosts);?>;

var total_poll_answer=1;

function prepareProfileData()
{
  $('.profile-register-dt').html(moment(pageData['bb_user_profile_mst']['register_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY'));
  $('.profile-latestlogin-dt').html(moment(pageData['bb_user_profile_mst']['last_logined'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY hh:mm:ss'));

  $('.profile-threads').html(numeral(pageData['bb_user_profile_data']['threads']).format('0,0'));
  $('.profile-posts').html(numeral(pageData['bb_user_profile_data']['posts']).format('0,0'));
  $('.profile-reactioneds').html(numeral(pageData['bb_user_profile_data']['reactions']).format('0,0'));

  var total=pageData['listActivities'].length;

  var li='';

  for (let i = 0; i < total; i++) {
      li+='<tr>';
      li+='<td>'+pageData['listActivities'][i]['activity_content']+'</td>';
      li+='<td class="text-end">'+moment(pageData['listActivities'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY hh:mm:ss')+'</td>';
      li+='</tr>';
    
  }

  $('.activities_body').html(li);


  total=pageData['listThreads'].length;

  li='';

  for (let i = 0; i < total; i++) {
      li+='<tr>';
      li+='<td><a href="'+SITE_URL+'t-'+pageData['listThreads'][i]['friendly_url']+'">'+pageData['listThreads'][i]['title']+'</a></td>';
      li+='<td class="text-end">'+moment(pageData['listThreads'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY hh:mm:ss')+'</td>';
      li+='</tr>';
    
  }

  $('.threads_body').html(li);

  total=pageData['listWallPosts'].length;

  li='';

  for (let i = 0; i < total; i++) {
      li+='<tr>';
      li+='<td><a href="'+SITE_URL+'profile-'+pageData['listWallPosts'][i]['username']+'">'+pageData['listWallPosts'][i]['username']+'</a> - '+moment(pageData['listThreads'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY hh:mm:ss');
      li+='<div>'+pageData['listWallPosts'][i]['content']+'</div>';
      li+='</td>';
      li+='<td class="text-end">'+moment(pageData['listWallPosts'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY hh:mm:ss')+'</td>';
      li+='</tr>';
    
  }

  $('.comment_body').html(li);




}

    $(document).ready(function(){
      $('.select2js').select2({
       
      });

      prepareProfileData();
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
  

    $(document).on('click','.btnFollow',function(){

        if($(this).hasClass('btn-success'))
        {
          return false;
        }

        var id=$(this).attr('data-id');
        var username=$(this).attr('data-username');

        var sendData={};

        sendData['followed_id']=id;
        sendData['to_username']=username;

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_new_follower', sendData).then(data => {
          // console.log(data); // JSON data parsed by `data.json()` call
          // $('#modalSearch').modal('hide');

          $('.btnFollow').removeClass('btn-primary').addClass('btn-success');
          
        });           
    });
  

    $(document).on('click','.btnSubmit',function(){

        var sendData={};

        sendData['type']='1';
        sendData['content']=CKEDITOR.instances.editor.getData();
        sendData['target_user_id']='<?php echo $bb_user_profile_mst['user_id'];?>';
        sendData['target_username']='<?php echo $bb_user_profile_mst['username'];?>';
        sendData['captcha_answer']='';
        sendData['method']='quickreply';

        if($('.captcha-answer').length==1)
        {
          sendData['captcha_answer']=$('.captcha-answer').val();
        }
        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_comment_on_profile_page', sendData).then(data => {
          // console.log(data); // JSON data parsed by `data.json()` call
          // $('#modalSearch').modal('hide');
          
          if(data['data']=='OK')
          {
            location.reload();
          }
          else
          {
            showAlert('',data['data']);
          }          
        });           
    });
  


  </script>
  