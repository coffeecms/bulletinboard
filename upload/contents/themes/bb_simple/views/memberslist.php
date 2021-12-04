
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>
  <div class='container mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>
    
      <?php BB_PHPCode::load('top_memberslist_page');?>
        <!-- List forum threads -->
        
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum" >
                Members
              </div>
              <div class="card-body">
                    <!-- d-flex -->
                    <div class="align-items-start">
                        <div class='row'>
                            <div class='col-lg-3 '>
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- <button class="nav-link active text-start" id="v-notifies-tab" data-bs-toggle="pill" data-bs-target="#v-notifies" type="button" role="tab" aria-controls="v-notifies" aria-selected="false">Notifies</button> -->
                                    <button class="nav-link text-start" id="v-allmembers-tab" data-bs-toggle="pill" data-bs-target="#v-allmembers" type="button" role="tab" aria-controls="v-allmembers" aria-selected="false">All Members</button>
                                    <button class="nav-link text-start" id="v-mostpoints-tab" data-bs-toggle="pill" data-bs-target="#v-mostpoints" type="button" role="tab" aria-controls="v-mostpoints" aria-selected="false">Most Points</button>
                                    <button class="nav-link text-start" id="v-mostfollowers-tab" data-bs-toggle="pill" data-bs-target="#v-mostfollowers" type="button" role="tab" aria-controls="v-mostfollowers" aria-selected="false">Most Followers</button>
                                    <button class="nav-link text-start" id="v-mostfollowings-tab" data-bs-toggle="pill" data-bs-target="#v-mostfollowings" type="button" role="tab" aria-controls="v-mostfollowings" aria-selected="false">Most Followings</button>
                                    <button class="nav-link text-start" id="v-mostreactions-tab" data-bs-toggle="pill" data-bs-target="#v-mostreactions" type="button" role="tab" aria-controls="v-mostreactions" aria-selected="false">Most Reactions</button>
                                    <button class="nav-link text-start" id="v-threads-tab" data-bs-toggle="pill" data-bs-target="#v-threads" type="button" role="tab" aria-controls="v-threads" aria-selected="false">Most Threads</button>
                                    <button class="nav-link text-start" id="v-mostreplies-tab" data-bs-toggle="pill" data-bs-target="#v-mostreplies" type="button" role="tab" aria-controls="v-mostreplies" aria-selected="false">Most Replies</button>
                                    <!-- <button class="nav-link text-start" id="v-preferences-tab" data-bs-toggle="pill" data-bs-target="#v-preferences" type="button" role="tab" aria-controls="v-preferences" aria-selected="false">Preferences</button> -->
                                    <button class="nav-link text-start" id="v-todaybirthday-tab" data-bs-toggle="pill" data-bs-target="#v-todaybirthday" type="button" role="tab" aria-controls="v-todaybirthday" aria-selected="false">Today's Birthday</button>
                                  
                                </div>
                            </div>
                            <div class='col-lg-9 '>
                                        <div class="tab-content" id="v-pills-tabContent">


                                        <div class="tab-pane fade" id="v-allmembers" role="tabpanel" aria-labelledby="v-allmembers-tab">

                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Register Date</td>
                                            </tr>
                                            </thead>

                                            <tbody class='newest_member_body'>
                                    

                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-mostpoints" role="tabpanel" aria-labelledby="v-bookmarks-tab">

                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Points</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_points_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-mostfollowings" role="tabpanel" aria-labelledby="v-bookmarks-tab">

                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Followings</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_followings_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-mostfollowers" role="tabpanel" aria-labelledby="v-bookmarks-tab">

                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Followers</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_followers_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-mostreactions" role="tabpanel" aria-labelledby="v-informations-tab">
                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Reactions</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_reactions_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>                                           
                                        </div>
                                       
                                        <div class="tab-pane fade" id="v-threads" role="tabpanel" aria-labelledby="v-password-tab">
                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Threads</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_threads_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div> 

                                            
                                        </div>
                                        <div class="tab-pane fade" id="v-mostreplies" role="tabpanel" aria-labelledby="v-privacy-tab">
                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Replies</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_replies_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>  

                                        </div>
                                      
                                        <div class="tab-pane fade" id="v-todaybirthday" role="tabpanel" aria-labelledby="v-signature-tab">
                                            
                                            <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Birthday</td>
                                            </tr>
                                            </thead>

                                            <tbody class='most_replies_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group float-right"  role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T'  value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>                                           
                                        </div>
                                        <!-- tab panel -->
                                      
                                    </div>
                                </div>
                            </div>
                        </div>


                    <!-- d-flex -->

              </div>
            </div>
            <?php BB_PHPCode::load('bottom_memberslist_page');?>
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

    pageData['bb_members_data']=[];
    pageData['page_no']='0';
    pageData['tab_active']='';
    pageData['method']='newest_member';


function prepare_show_data()
{
    var total=pageData['bb_members_data'].length;

    var li='';

    if(pageData['method']=='newest_member')
    {
        for (var i = 0; i < total; i++) {
            li+='<tr>';
            li+='<td>';
            li+='<span class="block"><a href="'+SITE_URL+'profile-'+pageData['bb_members_data'][i]['username']+'.html">'+pageData['bb_members_data'][i]['username']+'</a></span>';
            li+='<span class="block fs-10" >'+pageData['bb_members_data'][i]['group_title']+'</span>';
            li+='</td>';
            li+='<td class="text-end">'+moment(pageData['bb_members_data'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
            li+='</tr> ';            
        }
    }
    else if(pageData['method']=='today_birthday')
    {
        for (var i = 0; i < total; i++) {
            li+='<tr>';
            li+='<td>';
            li+='<span class="block"><a href="'+SITE_URL+'profile-'+pageData['bb_members_data'][i]['username']+'.html">'+pageData['bb_members_data'][i]['username']+'</a></span>';
            li+='<span class="block fs-10" >'+pageData['bb_members_data'][i]['group_title']+'</span>';
            li+='</td>';
            li+='<td class="text-end">'+moment(pageData['bb_members_data'][i]['birthday'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY')+'</td>';
            li+='</tr> ';            
        }
    }
    else
    {
        for (var i = 0; i < total; i++) {
            li+='<tr>';
            li+='<td>';
            li+='<span class="block"><a href="'+SITE_URL+'profile-'+pageData['bb_members_data'][i]['username']+'.html">'+pageData['bb_members_data'][i]['username']+'</a></span>';
            li+='<span class="block fs-10" >'+pageData['bb_members_data'][i]['group_title']+'</span>';
            li+='</td>';
            li+='<td class="text-end">'+numeral(pageData['bb_members_data'][i]['total']).format('0,000')+'</td>';
            li+='</tr> ';            
        }
    }
    


    $('.'+pageData['method']+'_body').html(li);
}


    $(document).ready(function(){
      $('.select2js').select2({
       
      });

    });


function bb_load_most_data()
{
        var sendData={};

        sendData['page_no']=pageData['page_no'];
        sendData['method']=pageData['method'];

        sendData['type']='1';

        pageData['bb_members_data']=[];

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_memberlist_filter', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

            pageData['bb_members_data']=data['data'];
            prepare_show_data();
        });       
}

    $(document).on('click','#v-allmembers-tab',function(){

        pageData['tab_active']='v-allmembers';
        pageData['method']='newest_member';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });  
    $(document).on('click','#v-mostpoints-tab',function(){

        pageData['tab_active']='v-mostpoints';
        pageData['method']='most_points';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });     
    $(document).on('click','#v-mostfollowers-tab',function(){

        pageData['tab_active']='v-mostfollowers';
        pageData['method']='most_followers';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });      
    $(document).on('click','#v-mostfollowings-tab',function(){

        pageData['tab_active']='v-mostfollowings';
        pageData['method']='most_followings';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });  
    $(document).on('click','#v-mostreactions-tab',function(){

        pageData['tab_active']='v-mostreactions';
        pageData['method']='most_reactions';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });  
    $(document).on('click','#v-threads-tab',function(){

        pageData['tab_active']='v-threads';
        pageData['method']='most_threads';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });  
    $(document).on('click','#v-mostreplies-tab',function(){

        pageData['tab_active']='v-mostreplies';
        pageData['method']='most_replies';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });      
    $(document).on('click','#v-todaybirthday-tab',function(){

        pageData['tab_active']='v-todaybirthday';
        pageData['method']='today_birthday';

        pageData['page_no']=1;
        $('.txtPageNumber_T').val('1');

        bb_load_most_data();
    });  
  
    $(document).on('keyup','.txtPageNumber_T',function(){
        var page_no=$('.txtPageNumber_T').val();

        if(parseInt(page_no) >= 1)
        {
            pageData['page_no']=parseInt(page_no)-1;
            $('.txtPageNumber_T').val(pageData['page_no']);
        }
        else
        {
            pageData['page_no']=1;
            $('.txtPageNumber_T').val('1');
        }

        // $('.txtPageNumber_T').val(pageData['page_no']);

        bb_load_most_data();
    });  
  
    $(document).on('click','.btnPrev',function(){
        var page_no=$('.txtPageNumber_T').val();

        if(parseInt(page_no) >= 1)
        {
            pageData['page_no']=parseInt(page_no)-1;
            $('.txtPageNumber_T').val(pageData['page_no']);
        }
        else
        {
            pageData['page_no']=1;
            $('.txtPageNumber_T').val('1');
        }

        bb_load_most_data();
    });  
  

    $(document).on('click','.btnNext',function(){
        var page_no=$('.txtPageNumber_T').val();

        if(parseInt(page_no) >= 1)
        {
            pageData['page_no']=parseInt(page_no)+1;
            $('.txtPageNumber_T').val(pageData['page_no']);
        }
        else
        {
            pageData['page_no']=1;
            $('.txtPageNumber_T').val('1');
        }

        bb_load_most_data();
    });  



  </script>
  