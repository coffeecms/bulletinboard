<?php

$key = getGet('key', '');

$canInstall = true;
$keyValid = false;
$expires_dt = '';


$keyValid = true;

$db = new Database();

// $loadData=$db->query("SHOW TABLES LIKE 'bb_poll_data'");

// if(count($loadData) > 0)
// {
//     redirect_to(SITE_URL.'admin/plugin_page_url?plugin=bulletinboard&page=install');die();
// }

$db->nonquery("delete from group_permission_data where permission_c IN (select permission_c from permissions_mst where LEFT(permission_c,2)='BB')");

$db->nonquery("delete from setting_data where LEFT(key_c,2)='bb'");

$db->nonquery("delete from permissions_mst where LEFT(permission_c,2)='BB'");

$db->nonquery("delete from group_permission_data where LEFT(permission_c,2)='BB'");

//Load install.sql then query to install
// if(file_exists(PLUGINS_PATH.'bulletinboard/deactivate.php'))
// {
//     require_once(PLUGINS_PATH.'bulletinboard/deactivate.php');
// }

sleep(10);

if (file_exists(PUBLIC_PATH . 'caches/system_setting.php')) {
    unlink(PUBLIC_PATH . 'caches/system_setting.php');
}

if (is_dir(PUBLIC_PATH . 'bb_contents')) {

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/annoucement.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/annoucement.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/forums.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/forums.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/listForum.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/listForum.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/post_prefix.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/post_prefix.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/reactions.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/reactions.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/smiles_categories.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/smiles_categories.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/smiles_list.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/smiles_list.php');
    } 

    if (file_exists(PUBLIC_PATH . 'bb_contents/caches/user_ranks.php')) {
        unlink(PUBLIC_PATH . 'bb_contents/caches/user_ranks.php');
    } 

}
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
                            <h3 class="card-title">Step 2 - Install BulletinBoard</h3>

                        </div>
                        <div class="card-body table-responsive p-10">
                            <table class='table table-striped'>
                                <tbody>
                                    <?php if ($keyValid == false) {?>
                                    <tr>
                                        <td class='text-danger'>Your license not valid!</td>
                                    </tr>
                                    <?php } else {?>
                                        <tr>
                                        <td class='text-success'>OK! Click 'Next step' button to continue install...</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                            <!-- row -->
                            <div class='row' style='margin-top:20px;'>
                                <div class='col-lg-12'>
                                <a href="<?php echo SITE_URL; ?>admin/plugin_page_url?plugin=bulletinboard&page=install" class='btn btn-info' style=''><i class='fa fa-angle-left'></i> Prev</a>
                                <?php if ($keyValid == true) {?>


                                    <a href="<?php echo SITE_URL; ?>admin/plugin_page_url?plugin=bulletinboard&page=install_step3&key=<?php echo $key; ?>" class='btn btn-success' style='float:right;'>Next step <i class='fa fa-angle-right'></i></a>
                                    <?php }?>
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


<script>



</script>

<script type="text/javascript">

<?php if ($keyValid == true) {?>
setIsLoading();
setTimeout(() => {
    hideLoading();
}, 15000);
<?php }?>

$(document).ready(function(){

});

</script>