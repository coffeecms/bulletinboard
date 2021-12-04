<div class='container container-home '>

  <main>

    <!-- row -->
    <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 '>

        <?php BB_PHPCode::load('top_home_page');?>

        <?php $total=count(Configs::$_['list_annoucement']); $li='';
      // print_r(Configs::$_['list_annoucement']);die();
      for ($i=0; $i < $total; $i++) { 

        if(Configs::$_['list_annoucement'][$i]['forum_id']!='all')
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
              <div class="card-header card-header-annoucement">'.Configs::$_['list_annoucement'][$i]['title'].'</div>
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

        <?php load_hook('bb_top_home_page');?>

        <?php BB_PHPCode::load('before_list_forums');?>

        <?php load_hook('before_list_forums_level2');?>

        <?php $htmlContent=''; $external_url='';$totalSub=0;$total=count(Configs::$_['list_forums']);$forum='';$subforum=''; for ($i=0; $i < $total; $i++) { 

        
            $totalSub=count(Configs::$_['list_forums'][$i]['sub_forums']);

            $forum_type=Configs::$_['list_forums'][$i]['forum_type'];
            $short_content='';
            $external_url='';
            $forum_url='';

            $subforum='';

            $forum_url=SITE_URL.'f-'.Configs::$_['list_forums'][$i]['friendly_url'].'.html';

            if($forum_type=='url')
            {
              $external_url=Configs::$_['list_forums'][$i]['external_url'];

              $forum_url=$external_url;

              $subforum=Configs::$_['list_forums'][$i]['short_content'];
            }
            elseif($forum_type=='html')
            {
              $subforum=Configs::$_['list_forums'][$i]['short_content'];
            }
            elseif($forum_type=='normal')
            {

              $borderBottom='border-bottom:1px solid #dfdfdf;';

              $thumbnail='';
              for ($k=0; $k < $totalSub; $k++) { 

                $borderBottom='';

                $thumbnail='';

                if(($k+1)<$totalSub)
                {
                  $borderBottom='border-bottom:1px solid #dfdfdf;';
                }

                $latestPost='';

                if(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username']!=null && strlen(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username']) > 1)
                {
                  $latestPost='
                  <!-- row -->
                  <div class="row">
                    <div class="col-2">
                      '.user_home_avatar(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username'],Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_avatar']).'
                    </div>
                    <div class="col-10">
                      <div class="home-forum-attr-thread-wrap-thread-details" style="padding-top: 5pxs;">
                        <span  class="fs-10" style="display: block;"><a href="'.thread_url(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_friendly_url']).'">'.substr(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_title'],0,40).'...</a></span>
                        <span style="display: block;font-size: 9pt;">
                          <span>'.date('M d, Y',strtotime(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_dt'])).'</span>
                          <span><a href="'.profile_url(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username']).'">'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username'].'</a></span>
                          
                        </span>
                      </div>
                    </div>
                    
                  </div>
                  <!-- row --> 

                  ';
                }

                $thumbnail='<i class="fas fa-comments" style="font-size: 24pt;"></i>';
                if(strlen(Configs::$_['list_forums'][$i]['sub_forums'][$k]['thumbnail']) > 3)
                {
                  $thumbnail='<img src="'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['thumbnail'].'" style="width:100%;" />';
                }
                
                $subforum.='


                <!-- subforum -->
                <div class="row row-sub-forum">
                  <!-- col -->
                  <div class="col-1   padding-top-10 padding-bottom-10">
                    '.$thumbnail.'
                  </div>
                  <!-- col -->
                  <div class="col-5 padding-top-10 padding-bottom-10">
                    <a href="'.SITE_URL.'f-'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['friendly_url'].'.html"><span>'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['title'].'</span></a>
                    <div class="">
                      <span class="fs-10">Threads:</span>
                      <span class="fs-10">'.number_format(Configs::$_['list_forums'][$i]['sub_forums'][$k]['total_threads']).'</span>
                      <span class="fs-10 ml-15px">Replies:</span>
                      <span class="fs-10">'.number_format(Configs::$_['list_forums'][$i]['sub_forums'][$k]['total_posts']).'</span>
                    </div>
                  </div>
                  
                  <!-- col -->
                  <div class=" col-xxl-6 col-xl-6 col-lg-6  col-md-6 col-sm-6 col-12 ">
                    <div class="home-forum-attr-thread">
                      '.$latestPost.'
                    </div>
                    
                  </div>
                  <!-- col -->
                </div>
                <!-- subforum -->
                ';
              }
            }
            elseif($forum_type=='private')
            {
              $borderBottom='border-bottom:1px solid #dfdfdf;';

              for ($k=0; $k < $totalSub; $k++) { 

                $borderBottom='';

                if(($k+1)<$totalSub)
                {
                  $borderBottom='border-bottom:1px solid #dfdfdf;';
                }

                $latestPost='';

                if(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username']!=null && strlen(Configs::$_['list_forums'][$i]['sub_forums'][$k]['last_thread_author_username']) > 1)
                {
                  $latestPost='
                  <!-- row -->
                  <div class="row">
                    <div class="col-2">
                      &nbsp;
                    </div>
                    <div class="col-10">
                      &nbsp;
                    </div>
                  </div>
                  <!-- row -->                            
                  ';
                }

                
                $subforum.='
                <!-- subforum -->
                <div class="row row-sub-forum">
                  <!-- col -->
                  <div class="col-1   padding-top-10 padding-bottom-10">
                    '.$thumbnail.'
                  </div>
                  <!-- col -->
                  <div class="col-5 padding-top-10 padding-bottom-10">
                    <a href="'.SITE_URL.'f-'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['friendly_url'].'.html"><span>'.Configs::$_['list_forums'][$i]['sub_forums'][$k]['title'].'</span></a>
                    <div class="">
                      <span class="fs-10">Threads:</span>
                      <span class="fs-10">'.number_format(Configs::$_['list_forums'][$i]['sub_forums'][$k]['total_threads']).'</span>
                      <span class="fs-10 ml-15px">Replies:</span>
                      <span class="fs-10">'.number_format(Configs::$_['list_forums'][$i]['sub_forums'][$k]['total_posts']).'</span>
                    </div>
                  </div>
                  
                  <!-- col -->
                  <div class=" col-xxl-6 col-xl-6 col-lg-6  col-md-6 col-sm-6 col-12 ">
                    <div class="home-forum-attr-thread">
                      '.$latestPost.'
                    </div>
                    
                  </div>
                  <!-- col -->
                </div>
                <!-- subforum -->

                ';
              }
            }


              $forum.='          
              '.BB_PHPCode::load('top_of_forum_'.Configs::$_['list_forums'][$i]['forum_id']).'
              <!-- wrap_forum -->
              <div class="row row-forum">
                <!-- left -->
                <div class="col-lg-12 ">
                  <div class="card text-dark bg-light mb-3">
                    <div class="card-header card-header-forum"><a href="'.$forum_url.'">'.Configs::$_['list_forums'][$i]['title'].'</a></div>
                    <div class="card-body">

                      '.$subforum.'

                    </div>
                  </div>
                </div>
                <!-- left -->
              </div>
              <!-- wrap_forum -->
            '.BB_PHPCode::load('bottom_of_forum_'.Configs::$_['list_forums'][$i]['forum_id']);
          } echo $forum; ?>

         

        <?php BB_PHPCode::load('after_list_forums');?>
        <?php load_hook('bb_bottom_home_page');?>

      </div>