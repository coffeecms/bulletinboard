<?php

$key=getGet('key','');

$canInstall=true;
$keyValid=false;

$keyValid=true;
$db=new Database();

$loadData=$db->query("SHOW TABLES LIKE 'bb_poll_data'");

if(count($loadData)==0)
{
    redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=install');die();
}

$queryStr="";
$queryStr.="delete from plugin_mst where plugin_dir='bulletinboard'";

$db->nonquery($queryStr);   

$db->nonquery("delete from plugin_hook_data where plugin_dir='bulletinboard'");        

$queryStr="";
$queryStr.="insert into plugin_mst(plugin_dir,status,user_id) VALUES";
$queryStr.="('bulletinboard','1','11015035')";

$db->nonquery($queryStr);  


$queryStr="insert into bb_user_data(user_id)";
$queryStr.=" select user_id from user_mst where user_id NOT IN (select user_id from bb_user_data);";
$db->nonquery($queryStr);

$db->nonquery("delete from group_permission_data where group_c='11016011' AND  LEFT(permission_c,3)='BB1'");
$db->nonquery("delete from group_permission_data where group_c='11016011' AND  LEFT(permission_c,3)='BB3'");

$queryStr="insert into group_permission_data ";
$queryStr.=" select '11016011',permission_c,'11015035',NOW() from permissions_mst where LEFT(permission_c,3)='BB1';";
$db->nonquery($queryStr);

$queryStr="insert into group_permission_data ";
$queryStr.=" select '11016011',permission_c,'11015035',NOW() from permissions_mst where LEFT(permission_c,3)='BB3';";
$db->nonquery($queryStr);

$db->nonquery("delete from user_permission_menu_data where group_c='11016011'");

$queryStr="insert into user_permission_menu_data  ";
$queryStr.=" select '11016011','admin',menu_id from admin_menu_data;";
$db->nonquery($queryStr);

// Activate BBCode Plugins
$db->nonquery("delete from plugin_mst where plugin_dir IN ('bulletinboard_bbcode_collection','bulletinboard_bbcode_hide','bulletinboard_bbcode_random','bulletinboard_bbcode_you')");  


$queryStr='';

if(is_dir(PLUGINS_PATH.'bulletinboard_bbcode_collection'))
{
    $queryStr="insert into plugin_mst(plugin_dir,status,user_id) VALUES";
    $queryStr.="('bulletinboard_bbcode_collection','1','root');";
}

if(is_dir(PLUGINS_PATH.'bulletinboard_bbcode_random'))
{
    $queryStr.="insert into plugin_mst(plugin_dir,status,user_id) VALUES";
    $queryStr.="('bulletinboard_bbcode_random','1','root');";    
}

if(is_dir(PLUGINS_PATH.'bulletinboard_bbcode_you'))
{
    $queryStr.="insert into plugin_mst(plugin_dir,status,user_id) VALUES";
    $queryStr.="('bulletinboard_bbcode_you','1','root');";
}

$db->nonquery($queryStr);  

$db->nonquery("update setting_data set key_value='1' where key_c='bb_license_key_status'");  
$db->nonquery("update setting_data set key_value='".$key."' where key_c='bb_license_key'");  


if(file_exists(PUBLIC_PATH.'caches/user_group_permissions.php'))
{
    unlink(PUBLIC_PATH.'caches/user_group_permissions.php');
}

if(file_exists(PUBLIC_PATH.'caches/system_setting.php'))
{
    unlink(PUBLIC_PATH.'caches/system_setting.php');
}

if(file_exists(PUBLIC_PATH.'caches/hooks.php'))
{
    unlink(PUBLIC_PATH.'caches/hooks.php');
}


//Load install.sql then query to install
// if(file_exists(PLUGINS_PATH.'bulletinboard/hooks.php'))
// {
//     require_once(PLUGINS_PATH.'bulletinboard/hooks.php');
// }

// $response=file_get_contents("http://coffeecms.net/api/plugin_api?plugin=plugin_notify&func=new_install&key=".$key."&plugin_nm=bulletinboard&url=".urlencode(SITE_URL));

$sendData=array(
    'subject'=>'BulletinBoard - New forum install ',
    'content'=>'Dear,<br> <p>you have new forum install at: '.SITE_URL.'</p>',
    'to'=>'coffeecmsteam@gmail.com',
);

// EmailSystem::send($sendData);

clear_hook();


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
                            <h3 class="card-title">Step 4 - Install bulletinboard</h3>
                            
                        </div>
                        <div class="card-body table-responsive p-10">
                            <table class='table table-striped'>
                                <tbody>
                                    <?php if($keyValid==true){ ?>
                                    <tr>
                                        <td class='text-success'>Install completed. You can use system now or read guide at <a target="_blank" href="https://bulletinboard.coffeecms.net/Document/index.html">https://bulletinboard.coffeecms.net/Document/index.html</a></td>
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
                                    <a href="<?php echo SITE_URL;?>admin/plugin_page_url?plugin=bulletinboard&page=dashboard" class='btn btn-success' style='float:right;'>Back to Dashboard <i class='fa fa-angle-right'></i></a>
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