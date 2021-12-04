
<?php
if(!isset(Configs::$_['user_permissions']['BB30023']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

if(!isset(Configs::$_['bb_license_key'][5]))
{
	redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=active_system');
}

$db=new Database();

$settingData=$db->query('select * from setting_data');

$disallowWords=$db->query("select * from bb_disallow_word_data order by ent_dt asc");
$disallowUsernameRegister=$db->query("select * from bb_user_disallow_register order by ent_dt asc");

$listForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
$listSubForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");

bb_genListNestedForum($listForums, $listSubForums);

?>

<style>
.tab-content>.active {
    display: block;
    /* padding: 0px; */
    /* margin-left: 10px; */
}


#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */


</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo get_text_by_lang('Bulletin Board Settings','admin');?> - You can read guide <a class="" href="https://bulletinboard.coffeecms.net/Document/index.html" target="_blank" >here</a></h1>
            <!-- <h5 class="m-0 text-danger">Your forum will be expired on <?php echo date('M d, Y',strtotime(Configs::$_['bb_license_end_dt']));?></h5> -->
          </div><!-- /.col -->
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-md-12 col-sm-12">

		  <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <!-- <h3 class="card-title p-3">Tabs</h3> -->
                <ul class="nav nav-pills  p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><?php echo get_text_by_lang('General','admin');?></a></li>

                  <li class="nav-item"><a class="nav-link" href="#tab_10" data-toggle="tab"><?php echo get_text_by_lang('Disallow words','admin');?></a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_11" data-toggle="tab"><?php echo get_text_by_lang('Disallow user register','admin');?></a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_14" data-toggle="tab"><?php echo get_text_by_lang('Captcha','admin');?></a></li>
                  
                  

				  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><?php echo get_text_by_lang('Firewall','admin');?></a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#tab_9" data-toggle="tab"><?php echo get_text_by_lang('Renew license','admin');?></a></li> -->
                  <li class="nav-item"><a class="nav-link" href="#tab_16" data-toggle="tab"><?php echo get_text_by_lang('News','admin');?></a></li>

                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">


                  <div class="tab-pane active" id="tab_1">

							<div class="row" style="margin-top:10px;margin-bottom:20px;">
								<div class="col-lg-12 ">
									<strong class='text-success'><?php echo get_text_by_lang('Your license key','admin');?>: <?php echo Configs::$_['bb_license_key'];?></strong>
								</div>

							</div>						
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<span><?php echo get_text_by_lang('System status','admin');?>:</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[system_status]" id="system_status" class="form-control system_status setting-page1 select2js">
										<option value="working"><?php echo get_text_by_lang('Working','admin');?></option>
										<option value="underconstruction"><?php echo get_text_by_lang('Under construction','admin');?></option>
										<option value="comingsoon"><?php echo get_text_by_lang('Coming soon','admin');?></option>
										<option value="closed"><?php echo get_text_by_lang('Closed','admin');?></option>
									</select>
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<span><?php echo get_text_by_lang('News system status','admin');?>:</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_news_system]" id="bb_enable_news_system" class="form-control bb_enable_news_system setting-page1 select2js">
										<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
										<option value="0"><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>
								</div>

							</div>

							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<span>Site logo:</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='file' class='form-control fileMedias site-logo' />

									<div class='wrap_show_logo' style='margin-top:10px;'>
										<?php if(strlen(Configs::$_['bb_site_logo']) > 5){ ?>
											<img src="<?php echo SITE_URL.Configs::$_['bb_site_logo'];?>" style='width:100%;' />
										<?php } ?>
									</div>
								</div>
							</div>
							
							
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow guest to view forum','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_guest_view_forum]" id="bb_allow_guest_view_forum" class="form-control bb_allow_guest_view_forum setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
							
							
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow socials login','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_socials_login]" id="bb_allow_socials_login" class="form-control bb_allow_socials_login setting-page1 select2js">
									<option value="yes"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="no" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
							
								<!-- <div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('Enable auto detect autobot','admin');?> ?</span>
								</div>
								<div class="col-lg-2">
									<select name="general[bb_system_auto_detect_bot]" id="bb_system_auto_detect_bot" class="form-control bb_system_auto_detect_bot setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div> -->

							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Maximum attach files size allow (KB)','admin');?> </span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='text' name="general[bb_max_thread_file_size]" id="bb_max_thread_file_size" class="form-control bb_max_thread_file_size setting-page1" />
													
								</div>
							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow members upload attach files','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_member_upload_attach_files]" id="bb_allow_member_upload_attach_files" class="form-control bb_allow_member_upload_attach_files setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>							
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow guest download attach files','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_guest_download_attachments]" id="bb_allow_guest_download_attachments" class="form-control bb_allow_guest_download_attachments setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>	
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow guest see members online status','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_guest_see_member_onlines]" id="bb_allow_guest_see_member_onlines" class="form-control bb_allow_guest_see_member_onlines setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>	
							<h5>Forums</h5>
							<hr>			
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow guest to access search page','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_guest_access_search_page]" id="bb_allow_guest_access_search_page" class="form-control bb_allow_guest_access_search_page setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>										
							<h5>Threads</h5>
							<hr>
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable poll (users can create poll)','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_system_poll]" id="bb_system_poll" class="form-control bb_system_poll setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
							
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Default url user must view after login','admin');?> </span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='text' name="general[bb_default_post_require_view]" id="bb_default_post_require_view" class="form-control bb_default_post_require_view setting-page1" />
													
								</div>

							</div>
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Maximum threads show in forums','admin');?> </span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='text' name="general[bb_max_number_threads_show]" id="bb_max_number_threads_show" class="form-control bb_max_number_threads_show setting-page1" />
													
								</div>

							</div>
								<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Maximum posts show in thread','admin');?> </span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='text' name="general[bb_max_number_posts_show]" id="bb_max_number_posts_show" class="form-control bb_max_number_posts_show setting-page1" />
													
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Author info box type','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_thread_author_info_type]" id="bb_thread_author_info_type" class="form-control bb_thread_author_info_type setting-page1 select2js">
									<option value="vertical"><?php echo get_text_by_lang('Vertical','admin');?></option>
									<option value="horizontal" ><?php echo get_text_by_lang('Horizontal','admin');?></option>
									</select>								
								</div>

							</div>							
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable quick reply','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_quick_reply]" id="bb_enable_quick_reply" class="form-control bb_enable_quick_reply setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>							
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Allow member upload image when write post','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_allow_member_upload_image]" id="bb_allow_member_upload_image" class="form-control bb_allow_member_upload_image setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Yes','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('No','admin');?></option>
									</select>								
								</div>

							</div>	

							<h5>Messages</h5>
							<hr>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Maximum receivers when send new message','admin');?> </span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type='text' name="general[bb_max_message_receivers]" id="bb_max_message_receivers" class="form-control bb_max_message_receivers setting-page1" />
													
								</div>

							</div>
					<p>
					<button type="button" name="btnSave" class="btn btn-info btnSavePage1"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
				  		<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable ban email','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_banned_email_status]" id="bb_banned_email_status" class="form-control bb_banned_email_status setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
				  		<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable ban ip address','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_banned_ip_status]" id="bb_banned_ip_status" class="form-control bb_banned_ip_status setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
				  		<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable ban user','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_banned_users_status]" id="bb_banned_users_status" class="form-control bb_banned_users_status setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
				  		<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable ban browser','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_banned_browsers_status]" id="bb_banned_browsers_status" class="form-control bb_banned_browsers_status setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>
				  		<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable ban operating system','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_banned_os_status]" id="bb_banned_os_status" class="form-control bb_banned_os_status setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0" ><?php echo get_text_by_lang('Disabled','admin');?></option>
									</select>								
								</div>

							</div>


					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnSavePage2"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->
                
				  <div class="tab-pane" id="tab_9">
				  	<p><?php echo get_text_by_lang('License key','admin');?>:</p>
					<p>
					<input type="text" class="form-control bb_renew_license "  name="general[title]" id="title" value="" />
					</p>
				  
					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnRenewLicense"><i class='fas fa-paper-plane'></i> <?php echo get_text_by_lang('Check & renew','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->
                
				  <div class="tab-pane" id="tab_10">
				  	<p><?php echo get_text_by_lang('Enter disallow words (seperate by comma)','admin');?>:</p>
					<p>
					<textarea type="text" class="form-control bb_disallow_words " style="height:350px;" name="general[title]" id="title"></textarea>
					</p>
				  
					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnSavePage10"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->
                
				  <div class="tab-pane" id="tab_11">
				  	<p><?php echo get_text_by_lang('Enter disallow username register (seperate by comma)','admin');?>:</p>
					<p>
					<textarea type="text" class="form-control bb_disallow_username_register " style="height:350px;" name="general[title]" id="title"></textarea>
					</p>
				  
					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnSavePage11"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->
                
				  <div class="tab-pane" id="tab_14">

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Captcha method','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_system_captcha_method]" id="bb_system_captcha_method" class="form-control bb_system_captcha_method setting-page1 select2js">
									<option value="disable"><?php echo get_text_by_lang('Disable','admin');?></option>
									<option value="text"><?php echo get_text_by_lang('Text','admin');?></option>
									<option value="image" ><?php echo get_text_by_lang('Image','admin');?></option>
									</select>								
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable captcha in register page','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_captcha_in_register]" id="bb_enable_captcha_in_register" class="form-control bb_enable_captcha_in_register setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable captcha in login page','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_captcha_in_login]" id="bb_enable_captcha_in_login" class="form-control bb_enable_captcha_in_login setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable captcha in new thread','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_captcha_in_new_thread]" id="bb_enable_captcha_in_new_thread" class="form-control bb_enable_captcha_in_new_thread setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable captcha in reply','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_captcha_quick_reply]" id="bb_enable_captcha_quick_reply" class="form-control bb_enable_captcha_quick_reply setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>

				  			<!-- <div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('Enable captcha when send message','admin');?> ?</span>
								</div>
								<div class="col-lg-2">
									<select name="general[bb_enable_captcha_when_send_message]" id="bb_enable_captcha_when_send_message" class="form-control bb_enable_captcha_when_send_message setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div> -->

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Enable captcha when send message on profile wall','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_enable_captcha_when_send_wall_message]" id="bb_enable_captcha_when_send_wall_message" class="form-control bb_enable_captcha_when_send_wall_message setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>

				  
					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnSavePage14"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->
                
				  <div class="tab-pane" id="tab_16">

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Select forums which will show content in news page','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_news_forums_id_show_content]" multiple id="bb_news_forums_id_show_content" class="form-control bb_news_forums_id_show_content setting-page1 select2js">
									
									
									</select>								
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('News content max length','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type="number" class="form-control bb_news_content_max_len " value=""  name="general[title]" id="title" value="" />							
								</div>

							</div>
				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('Limit number news will show','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<input type="number" class="form-control bb_news_limitshow " value=""  name="general[title]" id="title" value="" />							
								</div>

							</div>

				  			<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6 col-md-6 col-sm-6 ">
								<span><?php echo get_text_by_lang('News pagination','admin');?> ?</span>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 ">
									<select name="general[bb_news_content_pagination]" id="bb_news_content_pagination" class="form-control bb_news_content_pagination setting-page1 select2js">
									<option value="1"><?php echo get_text_by_lang('Enable','admin');?></option>
									<option value="0"><?php echo get_text_by_lang('Disable','admin');?></option>
									
									</select>								
								</div>

							</div>


				  
					<p>
					<button type="submit" name="btnSave" class="btn btn-info btnSavePage16"><?php echo get_text_by_lang('Save Changes','admin');?></button>
					</p>
				
                  </div>
                  <!-- /.tab-pane -->


                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
   
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

pageData['settingData']=<?php echo json_encode($settingData);?>;
pageData['disallowWords']=<?php echo json_encode($disallowWords);?>;
pageData['disallowUsernameRegister']=<?php echo json_encode($disallowUsernameRegister);?>;
pageData['listForums']=<?php echo json_encode(Configs::$_['list_forum_data']); ?>;
pageData['attach_files']=[];
pageData['post_attach_files_data']=[];

pageData['attach_files_upload_status']=0;



function prepareShowForums()
{
  var total=pageData['listForums'].length;

  var li='';

  var td='';

  $('.bb_news_forums_id_show_content').html('').trigger('change');


  var postStatus='';

  var option='<option value=""></option>';

  for (var i = 0; i < total; i++) {

    option+='<option value="'+pageData['listForums'][i]['forum_id']+'">'+pageData['listForums'][i]['title']+'</option>';

  }

  $('.bb_news_forums_id_show_content').html(option).trigger('change');

}


function prepareSettingData()
{
	var total=0;
	var li='';


	total=pageData['settingData'].length;

	var splitStr=[];

	var totalStr=0;

	for (var i = 0; i < total; i++) {
		pageData['settingData'][i]['key_c']=pageData['settingData'][i]['key_c'].trim();

		// bb_news_forums_id_show_content

		splitStr=[];
		if(pageData['settingData'][i]['key_c']=='bb_news_forums_id_show_content')
		{
			splitStr=pageData['settingData'][i]['key_value'].split('||');

			totalStr=splitStr.length;

			for (var k = 0; k < totalStr; k++) {

				if(splitStr[k].length > 2)
				{
					$('.bb_news_forums_id_show_content > option').each(function(){
						if($(this).val()==splitStr[k])
						{
							$(this).attr('selected',true);
						}
					});					
				}

			}

			$('.bb_news_forums_id_show_content').trigger('change');
		}
		else
		{
				$('.'+pageData['settingData'][i]['key_c']).val(pageData['settingData'][i]['key_value']).trigger('change');
		}
		
	}


	total=pageData['disallowWords'].length;
	li='';

	for (var i = 0; i < total; i++) {
		li+=pageData['disallowWords'][i]['word']+',';
	}

	$('.bb_disallow_words').val(li);

	total=pageData['disallowUsernameRegister'].length;
	li='';

	for (var i = 0; i < total; i++) {
		li+=pageData['disallowUsernameRegister'][i]['username']+',';
	}

	$('.bb_disallow_username_register').val(li);

}

$(document).ready(function(){
prepareShowForums();
	prepareSettingData();
	$('.select2js').select2();



});

function setSelect(id,value)
{
	$('#'+id+' option').each(function(){
		var thisVal=$(this).val();

		if(thisVal==value)
		{
			$(this).attr('selected',true);
		}


	});
}


function prepareAttachFilesData()
{
    masterDB['media_upload_status']=0;
    
	if(pageData['attach_files'].length==0)
	{
		$('.fileMedias').each(function(){
			$(this).val('');
		});
		showAlert('','Data not valid, try upload again!');return false;
	}
	// console.log('avatar');
	var sendData={};

	sendData['file_path']=pageData['attach_files'][0];

	sendData['type']='1';

	postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_site_logo', sendData).then(data => {
	// console.log(data); // JSON data parsed by `data.json()` call
	// $('#modalSearch').modal('hide');

		if(data['data'].indexOf('http'))
		{
			showAlert('',data['data']);return;
		}

		$('.wrap_show_logo').html('<img src="'+data['data']+'" />');

	});   
   


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

        // $('.fileMedias').each(function(){
        //     // $(this).val('');
        // });

        // console.log(masterDB['media_list']);return false;
        return false;
    }

}

$(document).on('change','.fileMedias',function(){
pageData['upload_type']=$(this).attr('data-type');

masterDB['media_list']=[];
pageData['attach_files']=[];
// Uploading...
pageData['attach_files_upload_status']=1;

attach_files_upload_check();
// prepareMediaUpload();
});


//btnSavePage1
$(document).on('click','.btnSavePage1',function(){
    var sendData={};

	var jsonData={};
    jsonData['system_status']=$('.system_status > option:selected').val();
    jsonData['bb_enable_news_system']=$('.bb_enable_news_system > option:selected').val();
    jsonData['bb_allow_guest_view_forum']=$('.bb_allow_guest_view_forum > option:selected').val();
    jsonData['bb_allow_socials_login']=$('.bb_allow_socials_login > option:selected').val();
    // jsonData['bb_system_captcha_method']=$('.bb_system_captcha_method > option:selected').val();
    jsonData['bb_system_auto_detect_bot']=$('.bb_system_auto_detect_bot > option:selected').val();
    jsonData['bb_system_poll']=$('.bb_system_poll > option:selected').val();
    jsonData['bb_default_post_require_view']=$('.bb_default_post_require_view').val();
    jsonData['bb_max_number_threads_show']=$('.bb_max_number_threads_show').val();
    jsonData['bb_max_number_posts_show']=$('.bb_max_number_posts_show').val();

    jsonData['bb_max_thread_file_size']=$('.bb_max_thread_file_size').val();
    jsonData['bb_allow_member_upload_attach_files']=$('.bb_allow_member_upload_attach_files > option:selected').val();
    jsonData['bb_allow_guest_download_attachments']=$('.bb_allow_guest_download_attachments > option:selected').val();
    jsonData['bb_allow_guest_see_member_onlines']=$('.bb_allow_guest_see_member_onlines > option:selected').val();
    jsonData['bb_allow_guest_access_search_page']=$('.bb_allow_guest_access_search_page > option:selected').val();
    jsonData['bb_allow_member_upload_image']=$('.bb_allow_member_upload_image > option:selected').val();
    jsonData['bb_thread_author_info_type']=$('.bb_thread_author_info_type > option:selected').val();
    jsonData['bb_enable_quick_reply']=$('.bb_enable_quick_reply > option:selected').val();
    jsonData['bb_system_poll']=$('.bb_system_poll > option:selected').val();
    jsonData['bb_default_post_require_view']=$('.bb_default_post_require_view').val();
    jsonData['bb_max_number_threads_show']=$('.bb_max_number_threads_show').val();
    jsonData['bb_max_message_receivers']=$('.bb_max_message_receivers').val();
   
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

//btnSavePage1
$(document).on('click','.btnSavePage16',function(){
    var sendData={};

    pageData['news_forum_id']='';

    $('.bb_news_forums_id_show_content > option:selected').each(function(){
    	pageData['news_forum_id']+=$(this).val()+'||';
    });


	var jsonData={};
    jsonData['bb_news_content_max_len']=$('.bb_news_content_max_len').val();
    jsonData['bb_news_content_pagination']=$('.bb_news_content_pagination > option:selected').val();
    jsonData['bb_news_forums_id_show_content']=pageData['news_forum_id'];
   
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});


$(document).on('click','.btnSavePage14',function(){
    var sendData={};

	var jsonData={};
    jsonData['bb_system_captcha_method']=$('.bb_system_captcha_method > option:selected').val();
    jsonData['bb_enable_captcha_in_register']=$('.bb_enable_captcha_in_register > option:selected').val();
    jsonData['bb_enable_captcha_in_login']=$('.bb_enable_captcha_in_login > option:selected').val();
    jsonData['bb_enable_captcha_in_new_thread']=$('.bb_enable_captcha_in_new_thread > option:selected').val();
    jsonData['bb_enable_captcha_quick_reply']=$('.bb_enable_captcha_quick_reply > option:selected').val();
    jsonData['bb_enable_captcha_when_send_message']=$('.bb_enable_captcha_when_send_message > option:selected').val();
    jsonData['bb_enable_captcha_when_send_wall_message']=$('.bb_enable_captcha_when_send_wall_message > option:selected').val();
   
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});
$(document).on('click','.btnSavePage10',function(){
    var sendData={};

	var jsonData={};
    jsonData['bb_disallow_words']=$('.bb_disallow_words').val();
   
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_save_disallow_words', jsonData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});
$(document).on('click','.btnSavePage11',function(){
    var sendData={};

	var jsonData={};
    jsonData['bb_disallow_username_register']=$('.bb_disallow_username_register').val();
   
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_save_disallow_username', jsonData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage2',function(){
    var sendData={};

	var jsonData={};
    jsonData['bb_banned_email_status']=$('.bb_banned_email_status > option:selected').val();
    jsonData['bb_banned_ip_status']=$('.bb_banned_ip_status > option:selected').val();
    jsonData['bb_banned_users_status']=$('.bb_banned_users_status > option:selected').val();
    jsonData['bb_banned_browsers_status']=$('.bb_banned_browsers_status > option:selected').val();
    jsonData['bb_banned_os_status']=$('.bb_banned_os_status > option:selected').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage9',function(){
    var sendData={};

	var jsonData={};
    jsonData['bb_thread_id_length']=$('.bb_thread_id_length').val();
    jsonData['bb_post_id_length']=$('.bb_post_id_length').val();
    jsonData['bb_forum_id_length']=$('.bb_forum_id_length').val();
    jsonData['bb_message_id_length']=$('.bb_message_id_length').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnRenewLicense',function(){
	var sendData={};


	sendData['type']='1';

	sendData['bb_renew_license']=$('.bb_renew_license').val().trim();

	if(sendData['bb_renew_license'].length==0)
	{
		showAlert('','Your license not valid!');return false;
	}



	postData(API_URL+'plugin_api?plugin=bulletinboard&func=bb_check_license', sendData).then(data => {
		// console.log(data); // JSON data parsed by `data.json()` call

		if(data['error']=='yes')
		{
			showAlert('','Your license not valid!');
		}
		else
		{
			showAlertOK('','Your license renew success!');
		}
	
	});   
});




</script>