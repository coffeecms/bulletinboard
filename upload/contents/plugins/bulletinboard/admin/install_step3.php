<?php

$key=getGet('key','');

$canInstall=true;
$keyValid=true;

if(!isset(Configs::$_['bb_license_key']) || strlen(Configs::$_['bb_license_key']) < 10)
{
    // redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=install');die();
    $keyValid=false;
}

$db=new Database();

sleep(3);

$queryStr='';

$keyValid=true;


//Load install.sql then query to install
if(file_exists(PLUGINS_PATH.'bulletinboard/activate.php'))
{
    require_once(PLUGINS_PATH.'bulletinboard/activate.php');
}


$queryStr="
INSERT INTO `permissions_mst` (`permission_c`, `title`, `status`, `user_id`, `ent_dt`) VALUES
('BB10001', 'Bulletinboard - Can view forum ', 1, '', '2021-03-28 10:07:14'),
('BB10002', 'Bulletinboard - Guest can register account ', 1, '', '2021-03-28 10:07:14'),
('BB10003', 'Bulletinboard - Can create new thread ', 1, '', '2021-03-28 10:07:14'),
('BB10004', 'Bulletinboard - Can reply post ', 1, '', '2021-03-28 10:07:14'),
('BB10005', 'Bulletinboard - Can send message to others ', 1, '', '2021-03-28 10:07:14'),
('BB10006', 'Bulletinboard - Can view thread ', 1, '', '2021-03-28 10:07:14'),
('BB10007', 'Bulletinboard - Can publish thread after submit ', 1, '', '2021-03-28 10:07:14'),
('BB10008', 'Bulletinboard - Can change status of other threads ', 1, '', '2021-03-28 10:07:14'),
('BB10009', 'Bulletinboard - Can change user group ', 1, '', '2021-03-28 10:07:14'),
('BB10010', 'Bulletinboard - Can delete thread', 1, '', '2021-03-28 10:07:14'),
('BB10011', 'Bulletinboard - Can add new sticky thread in forum ', 1, '', '2021-03-28 10:07:14'),
('BB10012', 'Bulletinboard - Can moderator in all forums ', 1, '', '2021-03-28 10:07:14'),
('BB10013', 'Bulletinboard - Can receive message from others ', 1, '', '2021-03-28 10:07:14'),
('BB10014', 'Bulletinboard - Can create poll ', 1, '', '2021-03-28 10:07:14'),
('BB10015', 'Bulletinboard - Guest can view thread ', 1, '', '2021-03-28 10:07:14'),
('BB10016', 'Bulletinboard - Guest can view reply ', 1, '', '2021-03-28 10:07:14'),
('BB10017', 'Bulletinboard - Can download attach files ', 1, '', '2021-03-28 10:07:14'),
('BB10018', 'Bulletinboard - Can views member list ', 1, '', '2021-03-28 10:07:14'),
('BB10019', 'Bulletinboard - Can views resources list ', 1, '', '2021-03-28 10:07:14'),
('BB20001', 'Bulletinboard - Disallow view forum ', 1, '', '2021-03-28 10:07:14'),
('BB20003', 'Bulletinboard - Disallow create new thread ', 1, '', '2021-03-28 10:07:14'),
('BB20004', 'Bulletinboard - Disallow reply post ', 1, '', '2021-03-28 10:07:14'),
('BB20005', 'Bulletinboard - Disallow send message to others ', 1, '', '2021-03-28 10:07:14'),
('BB20006', 'Bulletinboard - Disallow view thread ', 1, '', '2021-03-28 10:07:14'),
('BB20007', 'Bulletinboard - Disallow publish thread after submit ', 1, '', '2021-03-28 10:07:14'),
('BB20008', 'Bulletinboard - Disallow change status of other threads ', 1, '', '2021-03-28 10:07:14'),
('BB20009', 'Bulletinboard - Disallow change user group ', 1, '', '2021-03-28 10:07:14'),
('BB20010', 'Bulletinboard - Disallow delete thread', 1, '', '2021-03-28 10:07:14'),
('BB20011', 'Bulletinboard - Disallow add new sticky thread in forum ', 1, '', '2021-03-28 10:07:14'),
('BB20012', 'Bulletinboard - Disallow moderator in all forums ', 1, '', '2021-03-28 10:07:14'),
('BB20013', 'Bulletinboard - Disallow receive message from others ', 1, '', '2021-03-28 10:07:14'),
('BB20014', 'Bulletinboard - Disallow download attach files ', 1, '', '2021-03-28 10:07:14'),
('BB30013', 'Bulletinboard - Can manage ads', 1, '', '2021-03-28 10:07:14'),
('BB30014', 'Bulletinboard - Can view dashboard', 1, '', '2021-03-28 10:07:14'),
('BB30015', 'Bulletinboard - Can manage forums', 1, '', '2021-03-28 10:07:14'),
('BB30016', 'Bulletinboard - Can manage threads', 1, '', '2021-03-28 10:07:14'),
('BB30017', 'Bulletinboard - Can manage reactions', 1, '', '2021-03-28 10:07:14'),
('BB30018', 'Bulletinboard - Can manage smiles', 1, '', '2021-03-28 10:07:14'),
('BB30029', 'Bulletinboard - Can manage ranks', 1, '', '2021-03-28 10:07:14'),
('BB30030', 'Bulletinboard - Can manage annoucements', 1, '', '2021-03-28 10:07:14'),
('BB30031', 'Bulletinboard - Can manage captcha questions', 1, '', '2021-03-28 10:07:14'),
('BB30032', 'Bulletinboard - Can manage post prefix', 1, '', '2021-03-28 10:07:14'),
('BB30026', 'Bulletinboard - Can manage users', 1, '', '2021-03-28 10:07:14'),
('BB30019', 'Bulletinboard - Can manage banned users', 1, '', '2021-03-28 10:07:14'),
('BB30020', 'Bulletinboard - Can manage banned email', 1, '', '2021-03-28 10:07:14'),
('BB30021', 'Bulletinboard - Can manage banned ip address', 1, '', '2021-03-28 10:07:14'),
('BB30027', 'Bulletinboard - Can manage firewall', 1, '', '2021-03-28 10:07:14'),
('BB30028', 'Bulletinboard - Can access remote api', 1, '', '2021-03-28 10:07:14'),
('BB30022', 'Bulletinboard - Can manage attach files', 1, '', '2021-03-28 10:07:14'),
('BB30023', 'Bulletinboard - Can setting system', 1, '', '2021-03-28 10:07:14'),
('BB30024', 'Bulletinboard - Can clean data', 1, '', '2021-03-28 10:07:14'),
('BB30025', 'Bulletinboard - Can view admin panel', 1, '', '2021-03-28 10:07:14');
";

$db->nonquery($queryStr);

$queryStr="
INSERT INTO `setting_data` (`key_c`, `title`, `key_value`, `status`) VALUES
('bb_allow_socials_login', 'Allow login from socials', 'no', 1),
('bb_forum_status', 'Forum status', 'working', 1),
('bb_fb_url', 'Facebook fanpage url', '', 1),
('bb_forum_total_views', 'Total forum views', '0', 1),
('bb_github_url', 'Github url', '', 1),
('bb_thread_total_views', 'Total thread views', '0', 1),
('bb_today_total_users', 'Total users registed today', '0', 1),
('bb_total_ads', 'Total ads', '0', 1),
('bb_total_ads_activated', 'Total ads activated', '0', 1),
('bb_total_ads_pending', 'Total ads pending', '0', 1),
('bb_total_post', 'Total posts', '0', 1),
('bb_total_threads', 'Total threads', '0', 1),
('bb_total_threads_deactivate', 'Total threads deactivate', '0', 1),
('bb_total_forums', 'Total forums', '0', 1),
('bb_total_users', 'Total users', '0', 1),
('bb_total_visitors', 'Total visitors', '0', 1),
('bb_total_reactions', 'Total visitors', '0', 1),
('bb_total_shop_orders_completed', 'Total visitors', '0', 1),
('bb_total_attach_files', 'Total visitors', '0', 1),
('bb_total_messages', 'Total visitors', '0', 1),
('bb_total_user_wall_messages', 'Total visitors', '0', 1),
('bb_twitter_url', 'Twitter url', '', 1),
('bb_system_captcha_method', 'Captcha method', 'image', 1),
('bb_system_auto_detect_bot', 'Auto Bot detector', '0', 0),
('bb_system_poll', 'Allow user create poll', '1', 0),
('bb_allow_guest_view_forum', 'Allow guest view forum', '1', 0),
('bb_banned_email_status', 'Banned email status', '1', 0),
('bb_banned_ip_status', 'Banned ip status', '1', 0),
('bb_banned_users_status', 'Banned users status', '1', 0),
('bb_banned_browsers_status', 'Banned browsers status', '1', 0),
('bb_banned_os_status', 'Banned os status', '1', 0),
('bb_default_post_require_view', 'Default post url require view after login', '', 0),
('bb_firewall_require_refer_to_view_forum', 'Require refer inside to view forum', '1', 0),
('bb_thread_id_length', 'Thread id length', '12', 0),
('bb_post_id_length', 'Post id length', '12', 0),
('bb_forum_id_length', 'Forum id length', '12', 0),
('bb_message_id_length', 'Message id length', '12', 0),
('bb_latest_username', 'Latest member', '', 0),
('bb_latest_user_id', 'Latest user id', '', 0),
('bb_max_number_threads_show', 'Max number threads show in forum', '30', 0),
('bb_max_number_posts_show', 'Max number posts show in thread', '10', 0),
('bb_enable_captcha_in_new_thread', 'Enable captcha in new thread', '1', 0),
('bb_enable_captcha_in_register', 'Enable captcha in new thread', '1', 0),
('bb_enable_captcha_in_login', 'Enable captcha in login page', '1', 0),
('bb_enable_news_system', 'bb_enable_news_system', '0', 0),
('bb_news_content_max_len', 'bb_news_content_max_len', '500', 0),
('bb_news_limitshow', 'bb_news_limitshow', '20', 0),
('bb_news_content_pagination', 'bb_news_content_pagination', '0', 0),
('bb_news_forums_id_show_content', 'bb_news_forums_id_show_content', '', 0),
('bb_enable_blog_system', 'bb_enable_blog_system', '0', 0),
('bb_thread_in_forum_order_by', 'bb_thread_in_forum_order_by', 'upd_dt', 0),
('bb_thread_author_info_type', 'bb_thread_author_info_type', 'vertical', 0),
('bb_site_logo', 'bb_site_logo', '', 0),
('bb_max_thread_file_size', 'bb_max_thread_file_size', '10000', 0),
('bb_max_profile_cover_image_size', 'bb_max_thread_file_size', '512', 0),
('bb_max_avatar_image_size', 'bb_max_thread_file_size', '512', 0),
('bb_max_message_receivers', 'bb_max_message_receivers', '10', 0),
('bb_enable_quick_reply', 'bb_enable_quick_reply', '1', 0),
('bb_enable_captcha_quick_reply', 'bb_enable_captcha_quick_reply', '1', 0),
('bb_enable_captcha_when_send_message', 'bb_enable_captcha_when_send_message', '1', 0),
('bb_enable_captcha_when_send_wall_message', 'bb_enable_captcha_when_send_wall_message', '1', 0),
('bb_allow_member_upload_image', 'bb_allow_member_upload_image', '1', 0),
('bb_allow_guest_access_search_page', 'bb_allow_guest_access_search_page', '0', 0),
('bb_allow_guest_download_attach_files', 'bb_allow_guest_download_attach_files', '0', 0),
('bb_allow_guest_see_member_onlines', 'bb_allow_guest_see_member_onlines', '0', 0),
('bb_show_member_online_status', 'bb_show_member_online_status', '1', 0),
('bb_allow_member_upload_attach_files', 'bb_allow_member_upload_attach_files', '1', 0),
('bb_site_icon', 'bb_site_icon', '', 0),
('bb_youtube_url', 'Youtube channel url', '', 1);
";

$db->nonquery($queryStr);

$queryStr="INSERT INTO `setting_data` (`key_c`, `title`, `key_value`, `status`) VALUES
('bb_license_end_dt', 'bb_license_end_dt', '2050-01-01', 1),
('bb_license_key', 'license_key', '".$key."', 1),
('bb_license_key_status', 'bb_license_key_status', '1', 1);";

$db->nonquery($queryStr);

// Administrator
$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016011') AND LEFT(a.permission_c,3) IN ('BB1','BB3')";
// $queryStr.=" where b.group_c NOT IN ('11016017','11016014','11016015','11016013') AND LEFT(a.permission_c,3) IN ('BB1','BB3')";
$db->nonquery($queryStr);

$db->nonquery("delete from group_permission_data where group_c NOT IN ('11016011','11016018') AND permission_c IN ('menu03','menu01','menu04','menu05','menu06','menu07','menu09','category01')");

// Mod
$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016012') AND LEFT(a.permission_c,3) IN ('BB1')";
$db->nonquery($queryStr);

$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016012') AND a.permission_c IN ('BB30015','BB30016','BB30019','BB30020','BB30021','BB30027','BB30028','BB30014','BB30013','BB30026')";
$db->nonquery($queryStr);


// Super Moderator
$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016018') AND LEFT(a.permission_c,3) IN ('BB1')";
$db->nonquery($queryStr);

$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016018') AND a.permission_c IN ('BB30015','BB30016','BB30019','BB30020','BB30021','BB30027','BB30028','BB30014','BB30013','BB30025','BB30026','BB30030','BB30027')";
$db->nonquery($queryStr);

// Member
$queryStr=" insert into group_permission_data";
$queryStr.=" select distinct b.group_c,a.permission_c,'11015035',NOW() from permissions_mst as a";
$queryStr.=" join user_group_mst as b";
$queryStr.=" where b.group_c IN ('11016013') AND a.permission_c IN ('BB10001','BB10003','BB10004','BB10005','BB10006','BB10007','BB10010','BB10013','BB10014','BB10017','BB10018')";
// $queryStr.=" where b.group_c NOT IN ('11016017','11016014','11016015','11016013') AND LEFT(a.permission_c,3) IN ('BB1','BB3')";
$db->nonquery($queryStr);


sleep(10);




?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row  justify-content-center">
                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                    <form action="" method="post" enctype="multipart/form-data">

                    <div class="card" style='margin-top:20px;'>
                        <div class="card-header border-0">
                            <h3 class="card-title">Step 3 - Install bulletinboard</h3>
                            
                        </div>
                        <div class="card-body table-responsive p-10">
                            <table class='table table-striped'>
                                <tbody>
                                    <?php if($keyValid==true){ ?>
                                    <tr>
                                        <td class='text-success'>Create database completed! Click 'Next step' button to continue install...</td>
                                    </tr>
                                    <?php }else{ ?>
                                    <tr>
                                        <td class='text-danger'>License key not valid</td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>

                            <!-- row -->
                            <div class='row' style='margin-top:20px;'>
                                <div class='col-lg-12'>
                                    <?php if($keyValid==true){ ?>
                                    <a href="<?php echo SITE_URL;?>admin/plugin_page_url?plugin=bulletinboard&page=install_step4&key=<?php echo $key;?>" class='btn btn-success' style='float:right;'>Next step <i class='fa fa-angle-right'></i></a>
                                    <?php } ?>

                                </div>                                
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <!-- /.card -->
                
                    </form>
                    </div>
 
                          
                    
                </div>
        <!-- /.row -->


        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
setIsLoading();

setTimeout(() => {
    hideLoading();
}, 10000);
$(document).ready(function(){

});
       
</script>