 <link href="<?php echo THEMES_URL;?>bb_taurus/assets/fotorama/fotorama.css" rel="stylesheet" />
 <script src="<?php echo THEMES_URL;?>bb_taurus/assets/fotorama/fotorama.js"></script>

<div class="modal fade index-max" id="modalShareLink" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <ul class='share-url-list'>
          <li>
            <a href="#" class='share-url-fb'><img alt="fb" src="<?php echo THEMES_URL;?>bb_simple/assets/images/fb.JPG" style='width:45px;' /></a>
            <a href="#" class='share-url-fb'><img alt="twitter" src="<?php echo THEMES_URL;?>bb_simple/assets/images/twitter.JPG" style='width:45px;' /></a>
          </li>
        </ul> -->
        <!-- body -->
        <div class="input-group mt-3 mb-3">
          <input type="text" class="form-control txt_share_url" id="txt_share_url"  aria-describedby="basic-addon2">
          <button type='button' class="btn btn-primary btnCopyShareUrl" data-clipboard-target="#txt_share_url" id="basic-addon2"><i class='fas fa-copy'></i></button>
        </div>
                        
        <!-- body -->
      </div>
      <div class="modal-footer">
      <!-- <button type="button" class="btn btn-success btnSendReport" data-dismiss="modal"><i class="fas fa-save"></i> Send</button> -->
      <button type="button" class="btn btn-danger "  data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade index-max" id="modalReactions" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reactions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-reaction-body" style="    overflow: scroll;max-height: 500px;">
        
        <table class='table table-striped table-hover'>
          <thead>
            <tr>
              <th>Username</th>
              <th class='text-end'>Reaction</th>
            </tr>
          </thead>
          <tbody class='list_reaction_on_modal'>

            
          </tbody>
          
        </table>
        
      </div>
      <div class="modal-footer">
      <!-- <button type="button" class="btn btn-success btnSendReport" data-dismiss="modal"><i class="fas fa-save"></i> Send</button> -->
      <button type="button" class="btn btn-danger "  data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>


<link href="<?php echo SITE_URL; ?>public/apexcharts-bundle/dist/apexcharts.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo SITE_URL; ?>public/apexcharts-bundle/dist/apexcharts.min.js"></script>


  <div class='container mt-20px pl-0px pr-0px'>
    
    <main>


      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 col-sm-12 col-12'>


      <?php $total=count(Configs::$_['list_annoucement']); $li='';
      
      for ($i=0; $i < $total; $i++) { 

        if(Configs::$_['list_annoucement'][$i]['forum_id']!='all' && Configs::$_['list_annoucement'][$i]['forum_id']!=$forum_id)
        {
          continue;
        }

        if(Configs::$_['list_annoucement'][$i]['group_id']!='all' && Configs::$_['list_annoucement'][$i]['group_id']!=Configs::$_['user_data']['group_c'])
        {
          continue;
        }        

        $li.='
        <!-- row -->
        <div class="row margin-bottom-20">
          <!-- left -->
          <div class="col-lg-12 ">
            <div class="card text-dark bg-light mb-3">
              <div class="card-header  card-header-forum">'.Configs::$_['list_annoucement'][$i]['title'].'</div>
              <div class="card-body">
              '.stripslashes(Configs::$_['list_annoucement'][$i]['content']).'
              </div>
            </div>
          </div>
          <!-- left -->
          
        </div>
        <!-- row -->
        ';

        
      }

      echo $li;
      
      ?>     

      <?php 

      $total=count(Configs::$_['forum_breadcum_data']);
      if($total > 0)
      {

        Configs::$_['forum_breadcum_data']=array_reverse(Configs::$_['forum_breadcum_data']);

        $li='';

        for ($i=0; $i < $total; $i++) { 


          $li.='<li class="breadcrumb-item"><a href="'.forum_url(Configs::$_['forum_breadcum_data'][$i]['friendly_url']).'">'.Configs::$_['forum_breadcum_data'][$i]['title'].'</a></li>';
        }       

          $li.='<li class="breadcrumb-item"><a href="'.thread_url(Configs::$_['thread_data']['friendly_url']).'">'.Configs::$_['thread_data']['title'].'</a></li>';
        echo '
    
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            '.$li.'
          </ol>
        </nav>

        '; 
      }

      ?>
      

      <?php if(count($poll_data) > 0){ 



        $poll_answer='';
        $poll_body='';
        $poll_result_chart='
        <!-- row -->
        <div class="row row-poll-result margin-bottom-10" style="display:none;">
          <!-- left -->
          <div class="col-lg-12 ">
            <div class="card text-dark bg-light mb-3" >
              <div class="card-header card-header-forum">Poll Result - '.$poll_data[0]['question'].'</div>
              <div class="card-body poll_result_chart">
                  <div id="the_chart"></div>
              </div>
            </div>
          </div>
          <!-- left -->
        </div>
        <!-- row -->          
        ';
        
        $total=count($poll_answer_data);

        for ($i=0; $i < $total; $i++) { 
          $poll_answer.='
          <div class="row">
            <div class="col-lg-12">
              <div class="input-group mb-3">
                <button type="button" class="btn btn-primary btn-none poll_answer" data-id="'.$poll_answer_data[$i]['answer_id'].'"><i class="fas fa-square"></i></button>
                <span class="form-control bg-light" >'.$poll_answer_data[$i]['content'].'</span>
              </div>             
            </div>          
          </div>  
          ';
        }

        $btn_close='<button type="button" class="btn btn-danger btnSendClosePoll" style="margin-left:20px;"><i class="fa fa-window-close"></i> Close Poll</button>     ';

        if(Configs::$_['user_data']['user_id']!=$poll_data[0]['user_id'])
        {
          $btn_close='';
        }

        $btn_send='
        <div class="row">
        <div class="col-lg-12">
          <button type="button" class="btn btn-success btnSendPollAnswer"><i class="fa fa-paper-plane"></i> Send answer</button>  
          
          '.$btn_close.'
        </div>          
        </div>           
        ';

        if(Configs::$_['user_data']['user_id']=='GUEST' && (int)$poll_data[0]['allow_guest_access']==0)
        {
          $btn_send='';
        }

        $poll_body='
          <!-- row -->
          <div class="row row-poll-question margin-bottom-10">
            <!-- left -->
            <div class="col-lg-12 ">
              <div class="card text-dark bg-light mb-3">
                <div class="card-header card-header-forum">Poll - '.$poll_data[0]['question'].'</div>
                <div class="card-body">
                    '.$poll_answer.'
                    '.$btn_send.'
                </div>
              </div>
            </div>
            <!-- left -->
          </div>
          <!-- row -->        
        ';

        if(Configs::$_['user_data']['user_id']=='GUEST' && (int)$poll_data[0]['allow_guest_access']==0)
        {
          // show answer chart
          $poll_body='';
        }

        // Check expires
        if(strtotime($poll_data[0]['end_dt']) < strtotime(date('Y-m-d')))
        {
          $poll_body='';
        }

        echo $poll_result_chart;
        echo $poll_body;
        
      ?>

      <?php } ?>

      <?php load_hook('bb_top_thread_details_page');?>

      <?php BB_PHPCode::load('top_thread_details_page');?>
        <!-- Threads details -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>

            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum" >
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL.'f-'.Configs::$_['thread_data']['forum_friendly_url'];?>.html"><?php echo Configs::$_['thread_data']['forum_title'];?></a></li>
                  </ol>
                </nav>
              </div>
              <div class="card-body">
                <!-- row -->
                <div class='row'>
                  <div class='col-lg-12'>
                    <h4 class='thread-title'><?php echo Configs::$_['thread_data']['title'];?></h4>

                    <!-- row -->
                    <div class='row'>
                      <div class='col-lg-6 col-md-6 '>
                       
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-none btn-sm " data-id="<?php echo Configs::$_['thread_data']['thread_id'];?>"><i class='fas fa-user'></i> <?php echo Configs::$_['thread_data']['author'];?></button>
                              <button type="button" class="btn btn-none btn-sm " data-id="<?php echo Configs::$_['thread_data']['thread_id'];?>"><i class='fas fa-clock'></i> <?php echo date('m/d/Y',strtotime(Configs::$_['thread_data']['ent_dt']));?></button>
                            </div>                      
                      </div>
                      <div class='col-lg-6 col-md-6 '>
                          <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                          <a href="<?php echo thread_page_url(Configs::$_['thread_data']['friendly_url'],$prev_page_no);?>" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></a>
                          <input type='number' class='form-control setGoToPage' value="<?php echo $page_no;?>" />
                          <a href="<?php echo thread_page_url(Configs::$_['thread_data']['friendly_url'],$next_page_no);?>" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></a>
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
                    <div class='row row-thread-item'>

                      <?php
                      $author_details_class='';
                      $post_content_class='';

                      if(Configs::$_['bb_thread_author_info_type']=='vertical')
                      {
                        $author_details_class='col-lg-3 col-md-4 ';
                        $post_content_class='col-lg-9 col-md-8 ';
                      }
                      else
                      {
                        $author_details_class='col-12 mb-3';
                        $post_content_class='col-lg-12 ';
                      }
                      ?>

                      <!-- left -->
                      <?php if(Configs::$_['bb_thread_author_info_type']=='vertical'){ ?>
                        <!-- vertical -->
                      <div class='<?php echo $author_details_class;?>'>
                        <div class='thread_author_profile'>
                          <div class="card">
                            <?php echo user_post_avatar(Configs::$_['thread_data']['username'],Configs::$_['thread_data']['avatar']);?>
                            <div class="card-body text-center">
                              <span class="card-title block"><a href="<?php echo profile_url(Configs::$_['thread_data']['username']);?>"><?php echo Configs::$_['thread_data']['username'];?> 
                              <?php if(isOnline(Configs::$_['thread_data']['last_user_online'])){
                                echo "<i title='Online' class='fas fa-circle user-online-status text-success'></i>";
                              }
                              else{
                                echo "<i title='Offline' class='fas fa-circle user-online-status text-danger'></i>";
                              } ;?></a></span> 
                              <span class="card-title block"><a href="#" class='fs-10'><?php echo Configs::$_['thread_data']['group_title'];?></a></span>
                              <?php echo user_ranks_render(Configs::$_['thread_data']['user_id']);?>
                            </div>
                            
                            <div class="card-body d-none d-sm-none d-md-block ">
                              <?php load_hook('bb_top_post_user_details',Configs::$_['thread_data']['user_id']);?>
                              <!-- row -->
                              <div class='row fs-9'>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Joined:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo date('M d, Y',strtotime(Configs::$_['thread_data']['user_ent_dt']));?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Threads:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['threads']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Replies:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['posts']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 '>
                                  <span>Reactions:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['reactions']);?></span>
                                </div>
                                <div class='col-lg-6 col-md-6 '>
                                  <span>Points:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['total_points']);?></span>
                                </div>
                             

                              </div>
                              <!-- row -->
                              <?php load_hook('bb_bottom_post_user_details',Configs::$_['thread_data']['user_id']);?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- vertical -->
                      <?php }else{ ?>
                        <!-- horizontal -->
                      <div class='<?php echo $author_details_class;?>'>
                        <div class='thread_author_profile'>
                          <!-- row -->
                          <div class='row'>
                            <!-- col -->
                            <div class='col-lg-3 col-md-3 col-sm-5 col-4'>
                              <?php echo user_post_avatar(Configs::$_['thread_data']['username'],Configs::$_['thread_data']['avatar']);?>
                            </div>
                            <!-- col -->                            
                            <!-- col -->
                            <div class='col-lg-9 col-md-9 col-sm-7 col-8'>
                              <span class=""><a href="<?php echo profile_url(Configs::$_['thread_data']['username']);?>"><?php echo Configs::$_['thread_data']['username'];?>
                              <?php if(isOnline(Configs::$_['thread_data']['last_user_online'])){
                                echo "<i title='Online' class='fas fa-circle user-online-status text-success'></i>";
                              }
                              else{
                                echo "<i title='Offline' class='fas fa-circle user-online-status text-danger'></i>";
                              } ;?></a></span> (<span class=""><a href="#" style='font-size: 10pt;'><?php echo Configs::$_['thread_data']['group_title'];?></a></span>)
                              
                              <?php echo user_ranks_render(Configs::$_['thread_data']['user_id']);?>

                              <?php load_hook('bb_top_post_user_details',Configs::$_['thread_data']['user_id']);?>
                              <!-- row -->
                              <div class='row fs-9'>

                                <div class='col-lg-6 col-md-6 col-6'>
                                  <span>Joined:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6  text-end'>
                                  <span><?php echo date('M d, Y',strtotime(Configs::$_['thread_data']['user_ent_dt']));?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 col-6 '>
                                  <span>Threads:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['threads']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 col-6 '>
                                  <span>Replies:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['posts']);?></span>
                                </div>

                                <div class='col-lg-6 col-md-6 col-6 '>
                                  <span>Reactions:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['reactions']);?></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6 '>
                                  <span>Points:</span></span>
                                </div>
                                <div class='col-lg-6 col-md-6 col-6 text-end'>
                                  <span><?php echo number_format(Configs::$_['thread_data']['total_points']);?></span>
                                </div>
                             

                              </div>
                              <!-- row -->
                               <?php load_hook('bb_bottom_post_user_details',Configs::$_['thread_data']['user_id']);?>                             
                            </div>
                            <!-- col -->
                          </div>
                          <!-- row -->
                        </div>
                      </div>
                      <!-- horizontal -->

                      <?php } ?>
                      <!-- right -->
                      <div class='<?php echo $post_content_class;?>'>

                        <!-- row -->
                        <div class='row fs-10'>
                          <div class='col-9'>
                            <span><?php echo date('M d, Y H:m:i',strtotime(Configs::$_['thread_data']['ent_dt']));?></span>
                          </div>
                          <div class='col-3 text-end'>
                            <button type='button' class='btn btn-sm btn-success btn-share-thread-url' ><i class='fas fa-share-alt-square'></i></button>
                          </div>
                          
                        </div>
                        <!-- row -->
                        <hr>                      
                        <div class='thread_content thread_<?php echo Configs::$_['thread_data']['thread_id'];?>' data='<?php echo Configs::$_['thread_data']['thread_id'];?>'>

                        <?php BB_PHPCode::load('before_1st_post_content');?>

                        <span class='thread-title-sub'><?php echo Configs::$_['thread_data']['title'];?></span>
                        <?php echo BB_Smiles::replace_content(stripslashes(Configs::$_['thread_data']['content']));?>

                        <?php BB_PHPCode::load('after_1st_post_content');?>

                        <?php if(Configs::$_['thread_data']['upd_dt']!=Configs::$_['thread_data']['ent_dt']){ ?>
                          <i>Last edit: <?php echo date('M d, Y H:m:i',strtotime(Configs::$_['thread_data']['upd_dt']));?></i>
                        <?php } ?>

                        </div>

                        <?php

                          $totalAttach=0;
                          $list_attach='';

                          $totalAttach=count(Configs::$_['thread_data']['attach_files']);

                          if($totalAttach > 0)
                          {
                            for ($k=0; $k < $totalAttach; $k++) { 
                              $list_attach.='
                              <div class="input-group mb-3">
                              <button type="button" class="btn btn-warning" ><i class="fas fa-file"></i></button>
                              <a href="'.attach_file_download_url(Configs::$_['thread_data']['attach_files'][$k]['file_id']).'" class="btn btn-none">'.Configs::$_['thread_data']['attach_files'][$k]['file_name'].'</a>
                            </div>                            
                              ';
                            }

                            $list_attach='
                            <!-- attach_files -->
                            <!-- row -->
                            <div class="row margin-top-20 margin-bottom-20 fs-10">
                              <div class="col-12">
                                <span class="text-danger text-attachments">Attachments</span>
                              
                                  '.$list_attach.'                             
                            
                              </div>
                            </div>
                            <!-- row -->                        
                            <!-- attach_files -->

                            ';

                          }

                          echo $list_attach;

                        ?>
                        <?php BB_PHPCode::load('after_1st_post_attach_files');?>
 
                        <?php if(strlen(Configs::$_['thread_data']['signature']) > 0){ ?>
                        <!-- signature -->
                        <!-- row -->
                        <div class='row margin-top-20 margin-bottom-20 fs-10'>
                          <div class='col-12'>
                            <hr>
                          <?php if(isset(Configs::$_['thread_data']['signature'][2])){echo load_hook('prepare_member_signature',stripslashes(Configs::$_['thread_data']['signature']));};?>
                          </div>
                        </div>
                        <!-- row -->                        
                        <!-- signature -->
                        <?php } ?>
                        
                        <!-- row -->
                        <div class='row margin-top-20 fs-10'>
                          <!-- col -->
                          <div class='col-lg-6 col-md-6 col-sm-6 '>
                          <button type="button" class="btn btn-warning btn-sm btn-report-thread" data-thread-id="<?php echo Configs::$_['thread_data']['thread_id'];?>"><i class='fas fa-flag'></i> Report</button>
                          </div>
                          <!-- col -->
                          <!-- col -->
                          <div class='col-lg-6 col-md-6 col-sm-6 text-end'>
                       
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <!--<button type="button" class="btn btn-success btn-sm btn_create_thread_quote" data-id="<?php echo Configs::$_['thread_data']['thread_id'];?>"><i class='fas fa-plus-square'></i> Quote</button>-->

                              <?php if((int)Configs::$_['thread_data']['status']==1){ ?>
                                <a href="<?php echo thread_reply_url(Configs::$_['thread_data']['thread_id']);?>" class="btn btn-primary btn-sm"><i class='fas fa-reply'></i> Reply</a>

                                <?php if(Configs::$_['thread_data']['author']==Configs::$_['user_data']['username']){ ?>
                                <a href="<?php echo thread_edit_url(Configs::$_['thread_data']['thread_id']);?>" class="btn btn-primary btn-sm"><i class='fas fa-edit'></i> Edit</a>

                                <button type='button' class='btn btn-sm btn-primary btnCloseThread' data-id="<?php echo Configs::$_['thread_data']['thread_id'];?>" data-forumid="<?php echo Configs::$_['thread_data']['forum_id'];?>" style='float:right;'><i class='fas fa-window-close'></i> Close</button>
                                <button type='button' class='btn btn-sm btn-primary btnDeleteThread' data-id="<?php echo Configs::$_['thread_data']['thread_id'];?>" data-forumid="<?php echo Configs::$_['thread_data']['forum_id'];?>" style='float:right;'><i class='fas fa-trash'></i> Delete</button>
                                <?php } ?>
                              <?php }else{ ?>
                                <?php if(isset(Configs::$_['user_permissions']['BB10008'])){ ?>
                                <button type="button" data-threadid="<?php echo Configs::$_['thread_data']['thread_id'];?>" class="btn btn-primary btn-sm btnSetApproveThread"><i class='fas fa-check-square'></i> Set Approve</a>
                                <?php } ?>
                              <?php } ?>

                            </div>
                          </div>
                          <!-- col -->
                        </div>
                        <!-- row -->
                        <!-- row -->
                        <div class='row margin-top-20 margin-bottom-20 fs-10'>
                          <!-- col -->
                          <div class='col-lg-12 '>

                              <!-- Reaction system start -->
                              <div class="facebook-reaction"><!-- container div for reaction system -->
                                <span class="like-btn"> <!-- Default like button -->
                                <span class="like-btn-emo "><img alt="Like" class="like-btn-img" src="<?php echo THEMES_URL;?>bb_simple/assets/images/like.png"/></span> <!-- Default like button emotion-->
                                    <span class="like-btn-text">Like</span> <!-- Default like button text,(Like, wow, sad..) default:Like  -->
                                    <ul class="reactions-box"> <!-- Reaction buttons container-->

                                      <?php
                                          $total=count(Configs::$_['list_reactions']);

                                          $li_reactions='';

                                          $left=5;

                                          for ($i=0; $i < $total; $i++) { 
                                              $li_reactions.='<li class="reaction reaction-thread" data-thread-id="'.Configs::$_['thread_data']['thread_id'].'" data-reaction-txt="'.Configs::$_['list_reactions'][$i]['title'].'" data-reaction-id="'.Configs::$_['list_reactions'][$i]['reaction_id'].'" data-reaction="'.Configs::$_['list_reactions'][$i]['title'].'" style="left:'.$left.'px"><img src="'.SITE_URL.Configs::$_['list_reactions'][$i]['image_path'].'" /></li>';

                                              $left=(int)$left+40;
                                          }

                                          echo $li_reactions;
                                      ?>
                                    
                                    </ul>
                                </span>
                                
                              </div>
                              <!-- Reaction system end -->     
                            
                            <span class='wrap_list_reaction_1'>
                            <?php
                              $totalThreadReactions=count($list_thread_reactions);
                              $thisUserReaction=count($user_reaction_on_thread);
                              
                              $re_txt='';
                              if($thisUserReaction > 0)
                              {
                                 $re_txt='<a href="'.profile_url(Configs::$_['user_data']['username']).'"><img class="reaction-item" src="'.SITE_URL.$user_reaction_on_thread[0]['image_path'].'" /> '.Configs::$_['user_data']['username'].'</a>';

                                if($thisUserReaction > $thisUserReaction)
                                {
                                  $re_txt.=' <span>and</span> ';
                                }
                              }
                              
                              // $re_txt=$re_txt.'<span class="show_list_thread_reactions" data-thread-id="'.Configs::$_['thread_data']['thread_id'].'" style="margin-left:15px;cursor:pointer;">'.number_format($totalThreadReactions).' others reactions</span> ';
                              if($totalThreadReactions > $thisUserReaction)
                              {
                                $re_txt=$re_txt.'<span class="show_list_thread_reactions" data-thread-id="'.Configs::$_['thread_data']['thread_id'].'">'.number_format($totalThreadReactions).' others reactions</span> ';
                              }     
                              
                              echo $re_txt;
                            ?>
                            </span>

                            

                            
                          </div>
                          <!-- col -->
                         
                        </div>
                        <!-- row -->
                        
                      </div>

                    </div>
                    <!-- row --><hr>
                    <!-- thread item -->
                    <?php BB_PHPCode::load('after_1st_post');?>
                    <?php load_hook('bb_after_1st_post');?>
                    
                    <?php

                    $totalReaction=count(Configs::$_['list_reactions']);

                    $li_reactions_post='';

                    $left=5;

                    
                    $total=count($list_post);

                    $li='';

                    $totalThreadReactions=0;
                    $thisUserReaction=0;

                    $re_txt='';

                    $list_attach='';

                    $totalAttach=0;

                    $online_status='';

                    $edit_post='';
                    $delete_post='';

                    $last_edit='';

                    $post_author_box='';


                    for ($i=0; $i < $total; $i++) { 
                      $edit_post='';
                      $delete_post='';

                      $last_edit='';

                      if($list_post[$i]['upd_dt']!=$list_post[$i]['ent_dt'])
                      {
                        $last_edit='<i>Last edit: '.date('M d, Y H:m:i',strtotime($list_post[$i]['upd_dt'])).'</i>';
                      }

                      if(isOnline($list_post[$i]['last_user_online'])){
                        $online_status="<i title='Online' class='fas fa-circle user-online-status text-success'></i>";
                      }
                      else
                      {
                        $online_status="<i title='Offline' class='fas fa-circle user-online-status text-danger'></i>";
                      }

                      if($list_post[$i]['username']==Configs::$_['user_data']['username'])
                      {
                        $edit_post='
                        <a href="'.post_edit_url($list_post[$i]['post_id']).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        ';
                        $delete_post='
                        <button type="button" class="btn btn-sm btn-primary float-right btnDeletePost" data-id="'.$list_post[$i]['post_id'].'" data-forumid="'.Configs::$_["thread_data"]["forum_id"].'" data-threadid="'.Configs::$_["thread_data"]["thread_id"].'"><i class="fas fa-trash"></i> Delete</button>
                        ';
                      }


                      $li_reactions_post='';

                      $left=5;

                      
                      $list_attach='';

                      $totalAttach=count($list_post[$i]['attach_files']);


                      if($totalAttach > 0)
                      {
                        for ($k=0; $k < $totalAttach; $k++) { 
                          $list_attach.='
                          <div class="input-group mb-3">
                          <button type="button" class="btn btn-primary" ><i class="fas fa-file"></i></button>
                          <a href="'.attach_file_download_url($list_post[$i]['attach_files'][$k]['file_id']).'" class="btn btn-none">'.$list_post[$i]['attach_files'][$k]['file_name'].'</a>
                        </div>                            
                          ';
                        }

                        $list_attach='
                        <!-- attach_files -->
                        <!-- row -->
                        <div class="row margin-top-20 margin-bottom-20 fs-10" >
                          <div class="col-12">
                            <span class="text-danger block mb-10px fs-15 fw-600">Attachments</span>
                           
                              '.$list_attach.'                             
                        
                          </div>
                        </div>
                        <!-- row -->                        
                        <!-- attach_files -->

                        ';

                      }

                      $totalThreadReactions=count($list_post[$i]['list_reactions']);

                      $thisUserReaction=count($list_post[$i]['user_reaction_on_post']);

                      $re_txt='';
                      if($thisUserReaction > 0)
                      {
                         $re_txt='<a href="'.profile_url($list_post[$i]['username']).'"><img class="reaction-item" src="'.SITE_URL.$list_post[$i]['user_reaction_on_post'][0]['image_path'].'" /> '.$list_post[$i]['username'].'</a>';

                        if($thisUserReaction > $thisUserReaction)
                        {
                          $re_txt.=' <span>and</span> ';
                        }
                      }
                      
                      // $re_txt=$re_txt.'<span class="show_list_post_reactions" style="margin-left:15px;cursor:pointer;" data-post-id="'.$list_post[$i]['post_id'].'">'.number_format($totalThreadReactions).' others reactions</span> ';
                      if($totalThreadReactions > $thisUserReaction)
                      {
                        $re_txt=$re_txt.'<span class="show_list_post_reactions" data-post-id="'.$list_post[$i]['post_id'].'">'.number_format($totalThreadReactions).' others reactions</span> ';
                      }    

                      for ($k=0; $k < $totalReaction; $k++) { 
                          $li_reactions_post.='<li class="reaction reaction-post" data-post-id="'.$list_post[$i]['post_id'].'" data-reaction-txt="'.Configs::$_['list_reactions'][$k]['title'].'" data-reaction-id="'.Configs::$_['list_reactions'][$k]['reaction_id'].'" data-reaction="'.Configs::$_['list_reactions'][$k]['title'].'" style="left:'.$left.'px"><img src="'.SITE_URL.Configs::$_['list_reactions'][$k]['image_path'].'" /></li>';
  
                          $left=(int)$left+40;
                      }            

                      $author_details_class='';
                      $post_content_class='';

                      if(Configs::$_['bb_thread_author_info_type']=='vertical')
                      {
                        $author_details_class='col-lg-3 col-md-4 ';
                        $post_content_class='col-lg-9 col-md-8 ';

                        $post_author_box='
                  <!-- vertical -->
                      <div class="'.$author_details_class.'">
                        <div class="thread_author_profile">
                          <div class="card">
                            '.user_post_avatar($list_post[$i]['username'],$list_post[$i]['avatar']).'
                            <div class="card-body text-center">
                              <span class="card-title block"><a href="'.profile_url($list_post[$i]['username']).'">'.$list_post[$i]['username'].' '.$online_status.'</a></span> 
                              <span class="card-title block"><a href="#" class="fs-10">'.$list_post[$i]['group_title'].'</a></span>
                              '.user_ranks_render($list_post[$i]['user_id']).'
                            </div>
                            
                            <div class="card-body d-none d-sm-none d-md-block ">
                              
                              <!-- row -->
                              <div class="row fs-9">

                                <div class="col-lg-6 col-md-6 ">
                                  <span>Joined:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 text-end">
                                  <span>'.date('M d, Y',strtotime($list_post[$i]['user_ent_dt'])).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 ">
                                  <span>Threads:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 text-end">
                                  <span>'.number_format($list_post[$i]['threads']).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 ">
                                  <span>Replies:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 text-end">
                                  <span>'.number_format($list_post[$i]['posts']).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 ">
                                  <span>Reactions:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 text-end">
                                  <span>'.number_format($list_post[$i]['reactions']).'</span>
                                </div>
                                <div class="col-lg-6 col-md-6 ">
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
                      <!-- vertical -->

                        ';
                      }
                      else
                      {
                        $author_details_class='col-12 mb-3';
                        $post_content_class='col-lg-12 ';

                        $post_author_box='
                        <!-- horizontal -->
                      <div class="'.$author_details_class.'">
                        <div class="thread_author_profile">
                          <!-- row -->
                          <div class="row">
                            <!-- col -->
                            <div class="col-lg-3 col-md-3 col-sm-5 col-4">
                              '.user_post_avatar($list_post[$i]['username'],$list_post[$i]['avatar']).'
                            </div>
                            <!-- col -->                            
                            <!-- col -->
                            <div class="col-lg-9 col-md-9 col-sm-7 col-8">
                              <span class=""><a href="'.profile_url($list_post[$i]['username']).'">'.$list_post[$i]['username'].' '.$online_status.'</a></span> (<span class=""><a href="#" style="font-size: 10pt;">'.$list_post[$i]['group_title'].'</a></span>)
                              
                              '.user_ranks_render($list_post[$i]['user_id']).'

                              
                              <!-- row -->
                              <div class="row fs-9">

                                <div class="col-lg-6 col-md-6 col-6">
                                  <span>Joined:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6  text-end">
                                  <span>'.date('M d, Y',strtotime($list_post[$i]['user_ent_dt'])).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 col-6 ">
                                  <span>Threads:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 text-end">
                                  <span>'.number_format($list_post[$i]['threads']).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 col-6 ">
                                  <span>Replies:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 text-end">
                                  <span>'.number_format($list_post[$i]['posts']).'</span>
                                </div>

                                <div class="col-lg-6 col-md-6 col-6 ">
                                  <span>Reactions:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 text-end">
                                  <span>'.number_format($list_post[$i]['reactions']).'</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 ">
                                  <span>Points:</span></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 text-end">
                                  <span>'.number_format($list_post[$i]['total_points']).'</span>
                                </div>
                             

                              </div>
                              <!-- row -->
                                                          
                            </div>
                            <!-- col -->
                          </div>
                          <!-- row -->
                        </div>
                      </div>
                      <!-- horizontal -->
                        ';
                      }

                      $li.='

                      <!-- thread item -->
                      <!-- row -->
                      <div class="row row-thread-item">
                        <!-- left -->
                        '.$post_author_box.'
                        <!-- right -->
                        <div class="'.$post_content_class.'">

                          <!-- row -->
                          <div class="row fs-10">
                            <div class="col-9">
                              <span id="post_'.$list_post[$i]['post_id'].'">'.date('M d, Y H:m:i',strtotime($list_post[$i]['ent_dt'])).'</span>
                            </div>
                            <div class="col-3 text-end">
                              <button type="button" class="btn btn-sm btn-success btn-share-post-url" data-url="'.post_url(Configs::$_['thread_data']['friendly_url'],$list_post[$i]['post_id']).'"><i class="fas fa-share-alt-square"></i></button>
                            </div>
                            
                          </div>
                          <!-- row -->
                          <hr>                           
                          <div class="thread_content thread_'.$list_post[$i]['post_id'].'"  data="'.$list_post[$i]['post_id'].'">
                          '.BB_PHPCode::load('before_posts_content').'
                          '.BB_Smiles::replace_content(stripslashes($list_post[$i]['content'])).'
                          '.BB_PHPCode::load('after_posts_content').'
                          '.$last_edit.'
                          </div>
  
                          '.$list_attach.'
                          '.BB_PHPCode::load('after_posts_attach_files').'
                          <!-- signature -->
                          <!-- row -->
                          <div class="row margin-top-20 margin-bottom-20 fs-10">
                            <div class="col-12">
                              <hr>
                            '.load_hook('prepare_member_signature',stripslashes($list_post[$i]['signature'])).'
                            '.BB_PHPCode::load('after_posts_signature').'
                            </div>
                          </div>
                          <!-- row -->                        
                          <!-- signature -->   
                          <!-- row -->
                          <div class="row margin-top-20 fs-10">
                            <!-- col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                            <button type="button" class="btn btn-warning btn-sm btn-report-post" data-post-id="'.$list_post[$i]['post_id'].'"><i class="fas fa-flag"></i> Report</button>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 text-end">
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <!--<button type="button" class="btn btn-success btn-sm btn_create_thread_quote"><i class="fas fa-plus-square"></i> Quote</button>-->
                                <a href="'.post_reply_url(Configs::$_['thread_data']['thread_id'],$list_post[$i]['post_id']).'" class="btn btn-primary btn-sm"><i class="fas fa-reply"></i> Reply</a>
                                '.$edit_post.$delete_post.'
                              </div>
                            </div>
                            <!-- col -->
                          </div>
                          <!-- row -->                                                 
                          <!-- row -->
                          <div class="row margin-top-20 margin-bottom-20 fs-10" >
                            <div class="col-12">

                            <!-- Reaction system start -->
                            <div class="facebook-reaction"><!-- container div for reaction system -->
                              <span class="like-btn"> <!-- Default like button -->
                              <span class="like-btn-emo "><img class="like-btn-img" src="'.THEMES_URL.'bb_simple/assets/images/like.png"/></span>
                              <span class="like-btn-text">Like</span>
                                  <ul class="reactions-box"> <!-- Reaction buttons container-->

                                    '.$li_reactions_post.'
                                  
                                  </ul>
                              </span>
                              
                            </div>
                            <!-- Reaction system end -->
                              <span class="wrap_list_reaction_2 wrap_list_reaction_2_'.$list_post[$i]['post_id'].'">
                              '.$re_txt.' 
                              </span>
                            </div>
                        
                          </div>
                          <!-- row -->
                          
                        </div>
  
                      </div>
                      <!-- row --><hr>
                      <!-- thread item -->
                      '.BB_PHPCode::load('bottom_posts_content').load_hook('bb_bottom_posts_content').'
                      ';
                    }
                    echo $li;
                    ?>
                          <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                          <a href="<?php echo thread_page_url(Configs::$_['thread_data']['friendly_url'],$prev_page_no);?>" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></a>
                          <input type='number' class='form-control setGoToPage' style='margin-left: -5px;width:90px;text-align:center;' value="<?php echo $page_no;?>" />
                          <a href="<?php echo thread_page_url(Configs::$_['thread_data']['friendly_url'],$next_page_no);?>" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></a>
                          </div>
                  </div>                    
                </div>
                <!-- row -->
                <?php if((int)Configs::$_['thread_data']['allow_reply']==1) { ?>
                <?php if(Configs::$_['user_data']['user_id']!='GUEST' && (int)Configs::$_['bb_enable_quick_reply']==1){ ?>
                <!-- row -->
                <div class='row row-quick-reply margin-top-10'>
                    <div class='col-lg-12'>
                    <span>Quick reply</span>
                    <hr>
                          <p style='border: 1px solid #cbcbcb;'>
                              <textarea id="editor" rows="15" name="send[content]" class="form-control new-post-content ckeditor"></textarea>
                          </p>

                          <p>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1" title="Attach Files"><i class='fa fa-paperclip'></i></span>
                              <input type="file" name="attach_file[]" multiple class="form-control fileMedias new-attach" placeholder="Attach files" aria-label="Attach files" aria-describedby="basic-addon1">
                            </div>
                          </p> 

                        <?php BB_PHPCode::load('attachment_new_thread_page');?>

                        <div class='wrap_attach_files_data'>

                        </div>

                    </div>
                </div>
                <!-- row -->

                <?php if((int)Configs::$_['thread_data']['allow_reply']==1){ ?>
                  <?php if(Configs::$_['user_data']['user_id']!='GUEST' && (int)Configs::$_['bb_enable_captcha_quick_reply']==1){ ?>
                  <!-- row -->
                  <div class='row margin-top-20'>
                                      
                    <div class='col-12'>
                      <span>Answer below question to verify you not is robot:</span>
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
                <?php } ?>       

                <?php BB_PHPCode::load('bottom_thread_quick_reply');?>         
                  <!-- row -->
                  <div class='row margin-top-20'>
                                     
                    <div class='col-12 text-center'>
                    <button type='button' class='btn btn-primary btnSendReply'><i class='fas fa-paper-plane'></i> Send Reply</button>
                    </div>                    
                  </div>
                  <!-- row --> 
                  <?php } ?>         
                <?php } ?>         

              </div>
            </div>
            <?php BB_PHPCode::load('bottom_thread_details_page');?>
            <?php load_hook('bb_bottom_thread_details_page');?>
 
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->
      
      </div>
      <!-- right -->
    
  
  <script src="<?php echo SITE_URL; ?>public/ckeditor/ckeditor.js"></script>

  <script>

    pageData['page_no']='<?php echo $page_no;?>';
    pageData['thread_id']='<?php echo $thread_id;?>';
    pageData['poll_data']=<?php echo json_encode($poll_data);?>;
    pageData['poll_user_answer_data']=<?php echo json_encode($poll_user_answer_data);?>;
    pageData['poll_members_answer_data']=<?php echo json_encode($poll_members_answer_data);?>;
    pageData['forum_id']='<?php echo Configs::$_['thread_data']['forum_id'];?>';
    pageData['forum_url']='<?php echo forum_url(array_reverse(Configs::$_['forum_breadcum_data'])[0]['friendly_url']);?>';

    pageData['post_attach_files_data']=[];

pageData['attach_files']=[];

pageData['attach_files_upload_status']=0;


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

  if(pageData['poll_members_answer_data'].length > 0)
  {
    $('.row-poll-result').css({
      'display':'block'
    });

    preparePollResultChart();
  }
  else
  {
    $('.row-poll-result').css({
      'display':'none'
    });
  }

  if(pageData['poll_user_answer_data'].length > 0)
  {
    $('.row-poll-question').css({
      'display':'none'
    });    
  }

});

$(document).on('click','.btnSetApproveThread',function(){

  pageData['list_thread_id_selected']='';
  pageData['action']='activate';
  
  pageData['list_thread_id_selected']=$(this).attr('data-threadid')+',';
  var sendData={};

  sendData['type']='1';

  sendData['list_id']=pageData['list_thread_id_selected'];
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_change_thread_status', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    showAlert('','Done!');

  });  

});

$(document).on('click','.btnCloseThread',function(){
    if(confirm('Are you want to close this post ?'))
    {
      // Delete file

      var jsonData={};
      
      jsonData['thread_id']=$(this).attr('data-id');
      jsonData['forum_id']=$(this).attr('data-forumid');
      jsonData['author_id']='<?php echo Configs::$_['user_data']['user_id'];?>';
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_close_thread', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call

        if(data['data'].indexOf('Done')>=0)
        {
          location.reload();
        }
        else
        {
          showAlert('',data['data']);
        }
        
      });

    }    
});

$(document).on('click','.btnDeleteThread',function(){
    if(confirm('Are you want to delete this thread ?'))
    {
      // Delete file

      var jsonData={};
      
      jsonData['thread_id']=$(this).attr('data-id');
      jsonData['forum_id']=$(this).attr('data-forumid');
      jsonData['author_id']='<?php echo Configs::$_['user_data']['user_id'];?>';
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_delete_thread', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call

        if(data['data'].indexOf('Done')>=0)
        {
          // location.reload();
          location.href=pageData['forum_url'];
        }
        else
        {
          showAlert('',data['data']);
        }
        
      });

    }    
});
$(document).on('click','.btnDeletePost',function(){
    if(confirm('Are you want to delete this post ?'))
    {
      // Delete file

      var jsonData={};
      
      jsonData['post_id']=$(this).attr('data-id');
      jsonData['thread_id']=$(this).attr('data-threadid');
      jsonData['forum_id']=$(this).attr('data-forumid');
      jsonData['author_id']='<?php echo Configs::$_['user_data']['user_id'];?>';
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_delete_post', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call

        if(data['data'].indexOf('Done')>=0)
        {
          location.reload();
        }
        else
        {
          showAlert('',data['data']);
        }
        
      });

    }    
});

function preparePollResultChart()
{
  if($('.poll_result_chart').length > 0)
  {

    var listVal=[];
    var listKey=[];

    var total=pageData['poll_members_answer_data'].length;

    for (let i = 0; i < total; i++) {
      listKey.push(pageData['poll_members_answer_data'][i]['content']);
      listVal.push(parseInt(pageData['poll_members_answer_data'][i]['total']));
      
    }

    var setHeight=150;

    if(pageData['poll_members_answer_data'].length > 5)
    {
      setHeight=250;
    }

    if(pageData['poll_members_answer_data'].length > 8)
    {
      setHeight=300;
    }

    if(pageData['poll_members_answer_data'].length > 10)
    {
      setHeight=330;
    }
    var options = {
          series: [{
          data: listVal
        }],
          chart: {
          type: 'bar',
          height: setHeight
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        xaxis: {
          categories: listKey,
        }
        };
        $(".poll_result_chart").html('<div id="the_chart"></div>');
        var chart = new ApexCharts(document.querySelector("#the_chart"), options);
        chart.render();
          
  }
}

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
      li+='<button type="button" title="Delete this file" class="btn btn-danger old_attach_files old_attach_files_'+fileid+'  " data-path="'+pageData['attach_files'][i]+'" data-id="'+fileid+'" data-checked="0"><i class="fas fa-trash-alt"></i></button>';
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

  $(document).on('click','.poll_answer',function(){

    if(pageData['poll_data'][0]['poll_choice']=='unique')
    {
      $('.poll_answer').removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-square"></i>');
    } 

    if(pageData['poll_data'][0]['poll_choice']=='max')
    {
      if($('.poll_answer.btn-success').length==parseInt(pageData['poll_data'][0]['poll_choice_max']))
      {
        showAlert('','We disallow this action!');
        return false;
      }
    }
    
    if($(this).hasClass('btn-success'))
    {
      $(this).removeClass('btn-success').addClass('btn-none').html('<i class="fas fa-square"></i>');
    }
    else
    {
      $(this).removeClass('btn-none').addClass('btn-success').html('<i class="fas fa-check-square"></i>');
    }
  });
 

$(document).on('click','.btnSendReply',function(){
    var sendData={};


    var jsonData={};
      
      jsonData['forum_id']=pageData['forum_id'];
      jsonData['thread_id']=pageData['thread_id'];
      jsonData['content']=CKEDITOR.instances.editor.getData();
      jsonData['thread_title']=$('title').text();
      jsonData['captcha_answer']='';
      jsonData['method']='quickreply';

      if($('.captcha-answer').length==1)
      {
        jsonData['captcha_answer']=$('.captcha-answer').val();
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

      
      jsonData['attach_files']='';


      
      var totalFiles=pageData['attach_files'].length;

      for (let i = 0; i < totalFiles; i++) {
        jsonData['attach_files']+=pageData['attach_files'][i]+'|||';
      }

    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_thread_reply', jsonData).then(data => {
        console.log(data); // JSON data parsed by `data.json()` call
        
        // location.href=data['data'];
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


$(document).on('click','.reaction-thread',function(){
   var thread_id=$(this).attr('data-thread-id');           
   var reaction_txt=$(this).attr('data-reaction-txt');           
   var reaction_id=$(this).attr('data-reaction-id');    
   
   var reaction_img=$(this).children('img').attr('src');
   var jsonData={};
    
    jsonData['thread_id']=thread_id;
    jsonData['reaction_txt']=reaction_txt;
    jsonData['reaction_id']=reaction_id;
        jsonData['title']=$('title').text();
    
  
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_thread_reaction', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      $('.wrap_list_reaction_1').html('<img src="'+reaction_img+'" class="reaction-item" /> you');
      

      // $('.reactions-box').css({
      //   'display':'none'
      // });
      
    });      
});
$(document).on('click','.btnSendPollAnswer',function(){

    pageData['answer']='';

    $('.poll_answer.btn-success').each(function(){
      pageData['answer']+=$(this).attr('data-id').trim()+'|||';
    });

    var jsonData={};
    
    jsonData['answer']=pageData['answer'];
    jsonData['poll_id']=pageData['poll_data'][0]['poll_id'];
    
  
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_answer_to_poll', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      if(data['data']!='OK')
      {
        showAlert('',data['data']);
      }
      else
      {
        location.reload();
      }
      
    });      
});

$(document).on('click','.show_list_thread_reactions',function(){

  var thread_id=$(this).attr('data-thread-id');

    var jsonData={};
    
    jsonData['thread_id']=thread_id;
    
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread_reactions', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      $('.list_reaction_on_modal').html('');
      if(data['data'].length > 0)
      {
        var li='';

        var total=data['data'].length;

        for (let i = 0; i < total; i++) {
          li+='<tr>';
          li+='<td><a href="'+SITE_URL+'profile-'+data['data'][i]['username']+'.html">'+data['data'][i]['username']+'</a></td>';
          li+='<td class="text-end"><img src="'+SITE_URL+data['data'][i]['image_path']+'" style="max-height:18px;" alt="'+data['data'][i]['reaction_title']+'" /></td>';
          li+='</tr>          ';
          
        }

        $('.list_reaction_on_modal').html(li);
      }

      $('#modalReactions').modal('show');
     
      
    });      
});

$(document).on('click','.show_list_post_reactions',function(){

  var post_id=$(this).attr('data-post-id');

    var jsonData={};
    
    jsonData['post_id']=post_id;
    
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_post_reactions', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      $('.list_reaction_on_modal').html('');
      if(data['data'].length > 0)
      {
        var li='';

        var total=data['data'].length;

        for (let i = 0; i < total; i++) {
          li+='<tr>';
          li+='<td><a href="'+SITE_URL+'profile-'+data['data'][i]['username']+'.html">'+data['data'][i]['username']+'</a></td>';
          li+='<td class="text-end"><img src="'+SITE_URL+data['data'][i]['image_path']+'" style="max-height:18px;" alt="'+data['data'][i]['reaction_title']+'" /></td>';
          li+='</tr>          ';
          
        }

        $('.list_reaction_on_modal').html(li);
      }

      $('#modalReactions').modal('show');
     
      
    });      
});
$(document).on('click','.btnSendClosePoll',function(){

    var jsonData={};
    
    jsonData['poll_id']=pageData['poll_data'][0]['poll_id'];
    
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_close_poll', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      if(data['data']!='OK')
      {
        showAlert('',data['data']);
      }
      else
      {
        location.reload();
      }
      
    });      
});

$(document).on('click','.reaction-post',function(){
   var post_id=$(this).attr('data-post-id');           
   var reaction_txt=$(this).attr('data-reaction-txt');           
   var reaction_id=$(this).attr('data-reaction-id');    
   var reaction_img=$(this).children('img').attr('src');
   var jsonData={};
    
    jsonData['post_id']=post_id;
    jsonData['reaction_txt']=reaction_txt;
    jsonData['reaction_id']=reaction_id;
       jsonData['title']=$('title').text();
     
    // console.log($(this).parent().parent().parent().parent().html());
  
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_add_post_reaction', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      $('.wrap_list_reaction_2_'+jsonData['post_id']).html('<img src="'+reaction_img+'" class="reaction-item" /> you');
        

      // $('.reactions-box').css({
      //   'display':'none'
      // });
      
    });      
});

$(document).on('click','.btn-report-thread',function(){
  pageData['report_type']='thread';
  $('.report_reason').val('');
   $('#modalReport').modal('show');      
});


$(document).on('click','.btn-share-thread-url',function(){

  $('.txt_share_url').val(location.href);
  $('#modalShareLink').modal('show');

});

$(document).on('click','.btn-share-post-url',function(){
  var url=$(this).attr('data-url');
  $('.txt_share_url').val(url);
  $('#modalShareLink').modal('show');

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

$(document).on('click','.btn-report-post',function(){
  pageData['report_type']='post';
  pageData['post_id']=$(this).attr('data-post-id');
  $('.report_reason').val('');
   $('#modalReport').modal('show');      
});

$(document).on('click','.btnSendReport',function(){
  var jsonData={};
    
    jsonData['reason']=$('.report_reason').val().trim();

    if(pageData['report_type']=='post')
    {
      jsonData['target_id']=pageData['post_id'];
      jsonData['type']='post';
    }

    if(pageData['report_type']=='thread')
    {
      jsonData['target_id']=pageData['thread_id'];
      jsonData['type']='thread';
    }
    
    jsonData['title']=$('title').text();
    
    jsonData['url']=location.href;
    
    // console.log($(this).parent().parent().parent().parent().html());
  
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_send_report', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call

      $('#modalReport').modal('hide');   
      showAlertOK('','Done!') 
     
      
    });       
});
</script>