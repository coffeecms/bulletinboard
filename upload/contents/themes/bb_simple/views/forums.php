
  <div class='container mt-20px pl-0px pr-0px'>
    
  
  <!-- modal -->
  <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <input type="text" class="form-control search-keywords" >
            </div>
            
            <div class='row'>
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">Start date:</label>
                <input type="text" class="form-control search-start_date datepicker" >          
              </div>        
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">End date:</label>
                <input type="text" class="form-control search-end_date datepicker" >          
              </div>        
            </div>
            <div class='row'>
              <div class='col-lg-12 '>
                <label for="recipient-name" class="col-form-label">Prefix:</label>
                <select class='form-control search-prefix select2js' style='width:100%;'>

                <option value="all">ALL</option>
                  <?php 
                    $li='';

                    $total=count(Configs::$_['list_post_prefix']);

                    for ($i=0; $i < $total; $i++) { 
                      $li.='<option value="'.Configs::$_['list_post_prefix'][$i]['prefix_id'].'">'.Configs::$_['list_post_prefix'][$i]['title'].'</option>';
                    }

                    echo $li;

                  ?>
                </select>
              </div>        
                 
            </div>
          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSearch"><i class='fas fa-search'></i> Search</button>
          <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
    
  <?php if(bb_forum_has_permission($forum_id,'BB20010')==false && bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
  <!-- modal -->
  <div class="modal fade" id="modalMoveThread" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Move thread to another forum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
          
            <div class='row'>
              <div class='col-lg-12 '>
                <label for="recipient-name" class="col-form-label">To forum:</label>
                <select class='form-control search-forumid ' style='width:100%;'>

                <option value="all">ALL</option>
                  <?php 
                    $li='';

                    $total=count($listForums);

                    for ($i=0; $i < $total; $i++) { 
                      $li.='<option value="'.$listForums[$i]['forum_id'].'">'.$listForums[$i]['title'].'</option>';
                    }

                    echo $li;

                  ?>
                </select>
              </div>        
                 
            </div>
          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary btnStartMoveThread"><i class='fas fa-check'></i> Apply</button>
          <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <?php } ?>
    <main>





         

      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 '>

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
      <?php load_hook('bb_top_forums_page');?>

      <?php BB_PHPCode::load('top_forums_page');?>
    

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
      
      <?php $totalSub=0;$total=count(Configs::$_['forum_'.$forum_id]);$forum='';$subforum='';

          $totalSub=count(Configs::$_['forum_'.$forum_id]['sub_forums']);

          $latestPostData='';

          if((int)$totalSub > 0)
          {



            $subforum='';
            for ($k=0; $k < $totalSub; $k++) { 
              if(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username']==null)
              {
                Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username']='';
              }
  
              $latestPostData='';
              
              if(strlen(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username']) > 2)
              {
                $latestPostData='
              <!-- row -->
              <div class="row">
                <div class="col-2">
                  '.user_home_avatar(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username'],Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_avatar']).'
                </div>
                <div class="col-10">
                  <div class="home-forum-attr-thread-wrap-thread-details pt-5px">
                    <span class="width-max fs-10"><a href="'.thread_url(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_friendly_url']).'">'.substr(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_title'],0,40).'...</a></span>
                    <span class="width-max fs-9">
                      <span>'.date('M d, Y',strtotime(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_dt'])).'</span>
                      <span><a href="'.profile_url(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username']).'">'.Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['last_thread_author_username'].'</a></span>
                      
                    </span>
                  </div>
                </div>
                
              </div>
              <!-- row -->                   
                
                ';
              }

                $thumbnail='<i class="fas fa-comments fs-24"></i>';
                if(strlen(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['thumbnail']) > 3)
                {
                  $thumbnail='<img class="width-max" src="'.Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['thumbnail'].'" />';
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
                    <a href="'.SITE_URL.'f-'.Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['friendly_url'].'.html"><span>'.Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['title'].'</span></a>
                    <div class="">
                      <span class="fs-10">Threads:</span>
                      <span class="fs-10">'.number_format(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['total_threads']).'</span>
                      <span class="fs-10 ml-15px">Replies:</span>
                      <span class="fs-10">'.number_format(Configs::$_['forum_'.$forum_id]['sub_forums'][$k]['total_posts']).'</span>
                    </div>
                  </div>
                  
                  <!-- col -->
                  <div class=" col-xxl-6 col-xl-6 col-lg-6  col-md-6 col-sm-6 col-12 ">
                    <div class="home-forum-attr-thread">
                      '.$latestPostData.'
                    </div>
                    
                  </div>
                  <!-- col -->
                </div>
                <!-- subforum -->

                ';
            }
  
              $forum.='          

            <div class="row">
              <!-- left -->
              <div class="col-lg-12 ">
                <div class="card text-dark bg-light mb-3" >
                  <div class="card-header card-header-forum"><a href="'.SITE_URL.'f-'.Configs::$_['forum_'.$forum_id]['friendly_url'].'.html">'.Configs::$_['forum_'.$forum_id]['title'].'</a></div>
                  <div class="card-body">
                  '.$subforum.'
                  </div>
                </div>
              </div>
              <!-- left -->
            </div>

            ';
           echo $forum;
          }

         ?>



        <!-- List forum threads -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>

            <div class="card text-dark bg-light mb-3">
              <div class="card-header card-header-forum">
                <span><?php echo Configs::$_['forum_'.$forum_id]['title'];?></span>

                <?php if(isLogined()){ ?>
                <button type='button' class='btn btn-sm btn-none btn-filter float-right'><i class='fas fa-filter'></i> Filter</button>

                <a href="<?php echo SITE_URL;?>newthread?forum_id=<?php echo $forum_id;?>" class='btn btn-sm btn-none color-black mr-10px float-right' style='color:#000!important;'><i class='fas fa-edit'></i> Create new thread</a>
                <?php } ?>
                
              </div>
              <div class="card-body">
                <!-- row -->
                <div class='row'>
                  <div class='col-lg-6 col-md-6 text-start'>

                        <?php if(bb_forum_has_permission($forum_id,'BB20008')==false && bb_forum_has_permission($forum_id,'BB10008')==true){ ?>
                        <button type="button" class="btn btn-none btn-sm btnSetActivate"><i class="fas fa-check"></i> <?php echo get_text_by_lang('Set activate','admin');?></button>
                        <button type="button" class="btn btn-none btn-sm btnSetDeactivate"><i class="fas fa-check"></i> <?php echo get_text_by_lang('Set deactivate','admin');?></button>
                        <?php } ?>

                        <?php if(bb_forum_has_permission($forum_id,'BB20010')==false && bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
                        <button type="button" class="btn btn-none btn-sm btnMoveThread"><i class="fas fa-exchange-alt"></i> <?php echo get_text_by_lang('Move','admin');?></button>
                        <button type="button" class="btn btn-none btn-sm btnDelete"><i class="fas fa-trash"></i> <?php echo get_text_by_lang('Delete','admin');?></button>
                        <?php } ?>
                  </div>
                  <div class='col-lg-6 col-md-6 text-end'>
                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                        <input type='number' class='form-control txtPageNumber_T' value="1" />
                        <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                      </div>
                  </div>
                </div>
                <!-- row -->

                <!-- row -->
                <div class='row'>
                  <div class='col-lg-12'>


                    <table class='table table-hover' role="table">
                      <thead role="rowgroup">
                        <tr role="row">
                        <?php if(bb_forum_has_permission($forum_id,'BB10008')==true || bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
                          <th role="columnheader"><span class="fas fa-square pointer checkAll"></span></th>
                        <?php } ?>
                          <th role="columnheader">Avatar</th>
                          <th role="columnheader">Title</th>
                          <th role="columnheader" class='text-end'>Replies</th>
                          <th role="columnheader" class='text-end'>Views</th>
                          <th role="columnheader" class='text-end'>Latest Post</th>
                        </tr>
                      </thead>
                      <tbody role="rowgroup" class='list_thread'>
                        
                     
                      </tbody>
                    </table>

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                      <input type='number' class='form-control txtPageNumber_B' value="1" />
                      <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                    </div>

                  </div>                    
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
     
  <script>

    
    pageData['listThread']=<?php echo json_encode($listThread);?>;
    pageData['listPinThread']=<?php echo json_encode($listPinThread);?>;
    pageData['listAdsThread']=<?php echo json_encode($listAdsThread);?>;

    pageData['limitShow']=<?php echo Configs::$_['bb_max_number_threads_show'];?>;
    pageData['forum_id']=<?php echo $forum_id;?>;
    pageData['page_no']='1';

    $(document).ready(function(){
      $('.select2js').select2({
      dropdownParent: $("#modalFilter")
    });
      $('.search-forumid').select2({
      dropdownParent: $("#modalMoveThread")
    });

    $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

        $('.search-start_date').val(moment().add('months',-6).format('MM/DD/YYYY'));
        $('.search-end_date').val(moment().format('MM/DD/YYYY'));

        prepare_show_list_thread();

    });


    $(document).on('click','.btn-filter',function(){
      $('#modalFilter').modal('show');
  });


    $(document).on('click','.checkAll',function(){

      if($(this).hasClass('fa-check-square'))
      {
        $(this).removeClass('fa-check-square').removeClass('text-success').addClass('fa-square');
      $('.check-box').removeClass('fa-check-square').removeClass('text-success').addClass('fa-square');
      }
      else
      {
        $(this).removeClass('fa-square').addClass('fa-check-square').addClass('text-success');
      $('.check-box').removeClass('fa-square').addClass('fa-check-square').addClass('text-success');
      }

  });

    $(document).on('click','.check-box',function(){

      if($(this).hasClass('fa-check-square'))
      {
        $(this).removeClass('fa-check-square').removeClass('text-success').addClass('fa-square');
      }
      else
      {
        $(this).removeClass('fa-square').addClass('fa-check-square').addClass('text-success');
      }

  });

<?php if(bb_forum_has_permission($forum_id,'BB20008')==false && bb_forum_has_permission($forum_id,'BB10008')==true){ ?>
$(document).on('click','.btnSetActivate',function(){

  pageData['list_thread_id_selected']='';
  pageData['action']='activate';
  $('.check-box').each(function(){
    if($(this).hasClass('text-success'))
    {
      pageData['list_thread_id_selected']+=$(this).attr('data-id')+',';
    }
    
  });

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
$(document).on('click','.btnSetDeactivate',function(){

  pageData['list_thread_id_selected']='';
  pageData['action']='deactivate';
  $('.check-box').each(function(){
    if($(this).hasClass('text-success'))
    {
      pageData['list_thread_id_selected']+=$(this).attr('data-id')+',';
    }
    
  });

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

<?php } ?>

<?php if(bb_forum_has_permission($forum_id,'BB20010')==false && bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
$(document).on('click','.btnDelete',function(){

  pageData['list_thread_id_selected']='';
  pageData['action']='delete';
  $('.check-box').each(function(){
    if($(this).hasClass('text-success'))
    {
      pageData['list_thread_id_selected']+=$(this).attr('data-id')+',';
    }
    
  });

  var sendData={};

  sendData['type']='1';

  sendData['list_id']=pageData['list_thread_id_selected'];
  sendData['action']=pageData['action'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_change_thread_status', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    var listSplit=pageData['list_thread_id_selected'].split(',');
    var total=listSplit.length;

    for (let i = 0; i < total; i++) {
        if(listSplit[i].length > 2)
        {
          $('.row-'+listSplit[i]).remove();
        }      
    }

    // location.reload();

    showAlert('','Done!');

  });  

});
$(document).on('click','.btnMoveThread',function(){

    $('#modalMoveThread').modal('show');
});

$(document).on('click','.btnStartMoveThread',function(){

  pageData['list_thread_id_selected']='';
  pageData['action']='delete';
  $('.check-box').each(function(){
    if($(this).hasClass('text-success'))
    {
      pageData['list_thread_id_selected']+=$(this).attr('data-id')+',';
    }
    
  });

  var sendData={};

  sendData['type']='1';

  sendData['list_id']=pageData['list_thread_id_selected'];
  sendData['forum_id']=$('.search-forumid > option:selected').val();
  sendData['source_forum_id']=pageData['forum_id'];

  postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_change_thread_forum', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');

    $('#modalMoveThread').modal('hide');
    showAlert('','Done!');

  });  
    
});
<?php } ?>

  function prepare_show_list_thread()
  {
    prepare_show_list_pin_thread();

    prepare_show_list_ads_thread();


    var li='';

    // $('.list_thread').html('');

    var total=pageData['listThread'].length;

    var status='';

    for (let i = 0; i < total; i++) {
      li+='<tr role="row row-'+pageData['listThread'][i]['thread_id']+'" class="row-'+pageData['listThread'][i]['thread_id']+'">';

      <?php if(bb_forum_has_permission($forum_id,'BB10008')==true || bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
      status='<span class="text-danger">[Deactivated]</span> ';

      if(parseInt(pageData['listThread'][i]['status'])==1)
      {
        status='<span class="text-success">[Activated]</span> ';
      }
      <?php } ?>


      <?php if(bb_forum_has_permission($forum_id,'BB10008')==true || bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
      li+='<td role="cell " style="width:50px;" ><span class="fas fa-square check-box pointer" data-id="'+pageData['listThread'][i]['thread_id']+'"></span></td>';
      <?php } ?>

      li+='<td role="cell" style="width:50px;" >'+user_home_avatar(pageData['listThread'][i]['author'],pageData['listThread'][i]['avatar'])+'</td>';

      li+='<td role="cell" >';
      li+='<span style="display: block;font-size: 12pt;"><a href="'+SITE_URL+'t-'+pageData['listThread'][i]['friendly_url']+'"><span class="thread-prefix" style="background-color:'+pageData['listThread'][i]['prefix_bg_color']+'">'+pageData['listThread'][i]['prefix_title']+'</span> '+status+pageData['listThread'][i]['title']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;"><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['author']+'.html">'+pageData['listThread'][i]['author']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';

      if(parseInt(pageData['limitShow']) < total)
      {
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';

      }

      li+='</td>';
      li+='<td role="cell" class="text-end"><span  class="fs-10">'+pageData['listThread'][i]['total_replies']+'</span></td>';
      li+='<td role="cell" class="text-end"><span  class="fs-10">'+pageData['listThread'][i]['views']+'</span></td>';
      li+='<td role="cell" class="text-end">';
      li+='<span style="display: block;font-size: 11pt;"><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['last_username_reply']+'.html">'+pageData['listThread'][i]['last_username_reply']+'</a></span>';
      li+='<span style="display: block;font-size: 10pt;">'+moment(pageData['listThread'][i]['last_repy_time'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';
      li+='</td>';
      li+='</tr>';
    }

    $('.list_thread').append(li);

    
  }
  

  function prepare_show_list_pin_thread()
  {
    var li='';

    $('.list_thread').html('');

    var total=pageData['listPinThread'].length;

    var status='';

    for (let i = 0; i < total; i++) {
      li+='<tr role="row row-'+pageData['listPinThread'][i]['thread_id']+'" class="row-'+pageData['listPinThread'][i]['thread_id']+'">';

      
      status='<span class="text-danger">[Deactivated]</span> ';

      if(parseInt(pageData['listPinThread'][i]['status'])==1)
      {
        status='<span class="text-success">[Activated]</span> ';
      }


      <?php if(bb_forum_has_permission($forum_id,'BB10008')==true || bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
      li+='<td role="cell " style="width:50px;" ><span class="fas fa-square check-box pointer" data-id="'+pageData['listPinThread'][i]['thread_id']+'"></span></td>';
      <?php } ?>

      li+='<td role="cell" style="width:50px;" >'+user_home_avatar(pageData['listPinThread'][i]['author'],pageData['listPinThread'][i]['avatar'])+'</td>';

      li+='<td role="cell" >';
      li+='<span style="display: block;font-size: 12pt;"><a href="'+SITE_URL+'t-'+pageData['listPinThread'][i]['friendly_url']+'">'+status+pageData['listPinThread'][i]['title']+' <i class="fas fa-thumbtack text-primary"></i></a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;"><a href="'+SITE_URL+'profile-'+pageData['listPinThread'][i]['author']+'.html">'+pageData['listPinThread'][i]['author']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;">'+moment(pageData['listPinThread'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';

      if(parseInt(pageData['limitShow']) < total)
      {
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';

      }

      li+='</td>';
      li+='<td role="cell" class="text-end"><span class="fs-10">'+pageData['listPinThread'][i]['total_replies']+'</span></td>';
      li+='<td role="cell" class="text-end"><span class="fs-10">'+pageData['listPinThread'][i]['views']+'</span></td>';
      li+='<td role="cell" class="text-end">';
      li+='<span style="display: block;font-size: 11pt;"><a href="'+SITE_URL+'profile-'+pageData['listPinThread'][i]['last_username_reply']+'.html">'+pageData['listPinThread'][i]['last_username_reply']+'</a></span>';
      li+='<span style="display: block;font-size: 10pt;">'+moment(pageData['listPinThread'][i]['last_repy_time'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';
      li+='</td>';
      li+='</tr>';
    }


    $('.list_thread').html(li);


    
  }
  

  function prepare_show_list_ads_thread()
  {
    var li='';

    if(parseInt(pageData['page_no'])>1)
    {
      return false;
    }

    var total=pageData['listAdsThread'].length;

    var status='';

    for (let i = 0; i < total; i++) {
      li+='<tr role="row row-'+pageData['listAdsThread'][i]['thread_id']+'" class="row-'+pageData['listAdsThread'][i]['thread_id']+'">';

      
      status='<span class="text-danger">[Deactivated]</span> ';

      if(parseInt(pageData['listAdsThread'][i]['status'])==1)
      {
        status='<span class="text-success">[Activated]</span> ';
      }


      <?php if(bb_forum_has_permission($forum_id,'BB10008')==true || bb_forum_has_permission($forum_id,'BB10010')==true){ ?>
      li+='<td role="cell " style="width:50px;" ><span class="fas fa-square check-box pointer" data-id="'+pageData['listAdsThread'][i]['thread_id']+'"></span></td>';
      <?php } ?>

      li+='<td role="cell" style="width:50px;" >'+user_home_avatar(pageData['listAdsThread'][i]['author'],pageData['listAdsThread'][i]['avatar'])+'</td>';

      li+='<td role="cell" >';
      li+='<span style="display: block;font-size: 12pt;"><a href="'+SITE_URL+'t-'+pageData['listAdsThread'][i]['friendly_url']+'">'+status+pageData['listAdsThread'][i]['title']+' <i class="fas fa-ad text-success"></i></a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;"><a href="'+SITE_URL+'profile-'+pageData['listAdsThread'][i]['author']+'.html">'+pageData['listAdsThread'][i]['author']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;">'+moment(pageData['listAdsThread'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';

      if(parseInt(pageData['limitShow']) < total)
      {
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';

      }

      li+='</td>';
      li+='<td role="cell" class="text-end"><span class="fs-10">'+pageData['listAdsThread'][i]['total_replies']+'</span></td>';
      li+='<td role="cell" class="text-end"><span class="fs-10">'+pageData['listAdsThread'][i]['views']+'</span></td>';
      li+='<td role="cell" class="text-end">';
      li+='<span style="display: block;font-size: 11pt;"><a href="'+SITE_URL+'profile-'+pageData['listAdsThread'][i]['last_username_reply']+'.html">'+pageData['listAdsThread'][i]['last_username_reply']+'</a></span>';
      li+='<span style="display: block;font-size: 10pt;">'+moment(pageData['listAdsThread'][i]['last_repy_time'],'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')+'</span>';
      li+='</td>';
      li+='</tr>';
    }


    $('.list_thread').append(li);

    
  }
  

$(document).on('click','.btnPrev',function(){

var no=$('.txtPageNumber_B').val();

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
$('.txtPageNumber_B').val(sendData['page_no']);
$('.txtPageNumber_T').val(sendData['page_no']);
pageData['page_no']=sendData['page_no'];

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

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
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});

  $(document).on('keyup','.txtPageNumber_T',function(e){

    if (e.key != "Enter") {
      return false;
    }

var no=$('.txtPageNumber_T').val();

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

$('.txtPageNumber_B').val(no);

var sendData={};

sendData['page_no']=parseInt(pageData['page_no']);
// $('.txtPageNumber').val(sendData['page_no']);
pageData['page_no']=sendData['page_no'];

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

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
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});

  $(document).on('keyup','.txtPageNumber_B',function(e){

    if (e.key != "Enter") {
      return false;
    }

var no=$('.txtPageNumber_T').val();

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

$('.txtPageNumber_T').val(no);

var sendData={};

sendData['page_no']=parseInt(pageData['page_no']);
// $('.txtPageNumber').val(sendData['page_no']);
pageData['page_no']=sendData['page_no'];

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

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
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});


$(document).on('click','.btnNext',function(){

var no=$('.txtPageNumber_B').val();

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

pageData['page_no']=sendData['page_no'];

$('.txtPageNumber_B').val(sendData['page_no']);
$('.txtPageNumber_T').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

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
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   
});
   

$(document).on('click','.btnSearch',function(){

  $('.txtPageNumber_B').val('0');
  $('.txtPageNumber_T').val('0');
var no=$('.txtPageNumber_B').val();

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

sendData['page_no']=pageData['page_no'];
pageData['page_no']=sendData['page_no'];


$('.txtPageNumber_B').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

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
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   
});
   

  </script>
  