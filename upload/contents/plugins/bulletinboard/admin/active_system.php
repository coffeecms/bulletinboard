<?php
    $db=new Database();

    $activate_key=getPost('activate_key','');

    $keyValid=false;

    if(isset($activate_key[2]))
    {
        $response=file_get_contents(BB_SERVER_API_URL."plugin_api?plugin=plugin_notify&plugin_nm=bulletinboard&func=verify_license&key=".trim($activate_key)."&url=".urlencode(SITE_URL));

        $responseData=json_decode($response);

        if($responseData->error=='yes')
        {
            $keyValid=false;
        }
        else
        {
            $db=new Database();

            sleep(3);

            $queryStr='';

            $keyValid=true;

            $db->nonquery("update setting_data set key_value='1' where key_c='bb_license_key_status'");  
            $db->nonquery("update setting_data set key_value='".$activate_key."' where key_c='bb_license_key'");  


            if(!is_dir(ROOT_PATH.'public/bb_contents'))
            {
                mkdir(ROOT_PATH.'public/bb_contents');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/captcha'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/captcha');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/smiles'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/smiles');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/attach_files'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/attach_files');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/reactions'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/reactions');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/caches'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/caches');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/php_hook'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/php_hook');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/users'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/users');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/threads'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/threads');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/thread_replies'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/thread_replies');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/forums'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/forums');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/forum_ads'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/forum_ads');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/notices'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/notices');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/ip'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall/ip');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/email'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall/email');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/username'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall/username');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/browser'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall/browser');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/firewall/os'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/firewall/os');
            }

            if(!is_dir(ROOT_PATH.'public/bb_contents/phpcode'))
            {
                mkdir(ROOT_PATH.'public/bb_contents/phpcode');
            }

            copy(PLUGINS_PATH.'bulletinboard/contents/.htaccess',ROOT_PATH.'public/bb_contents/.htaccess');


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
                            <h3 class="card-title">Activate BulletinBoard</h3>
                            
                        </div>
                        <div class="card-body table-responsive p-10">
                            <table class='table'>
                                <tbody>
                                    
                                    <!-- <tr>
                                        <td class='text-success'>Ok,your system can be install bulletinboard. Click 'Next step' button to continue install...</td>
                                    </tr> -->
                                    <?php if(isset($activate_key[5]) && $keyValid==true){ ?>
                                    <tr>
                                        <td class='text-success'>Active your forum successfull!</td>
                                    </tr>
                                    <?php }elseif(isset($activate_key[5]) && $keyValid==false){ ?>
                                    <tr>
                                        <td class='text-danger'>License key not valid</td>
                                    </tr>

                                        <?php } ?>

                                    <?php if(!isset($activate_key[5])){ ?>
                                    <tr>
                                        <td>
                                            <p>
                                               <span>License (One key One forum & Lifetime support)</span> 
                                            </p>

                                            <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">License key</span>
                                                <input type="text" name="activate_key" value="<?php echo $activate_key;?>" class="form-control activate_key" placeholder="" aria-label="activate_key" aria-describedby="basic-addon1">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                            <!-- row -->
                            <div class='row' style='margin-top:20px;'>
                                <div class='col-lg-12'>
                                    <a href="<?php echo SITE_URL;?>admin/plugin_page_url?plugin=bulletinboard&page=active_system" class='btn btn-info' style=''><i class='fa fa-angle-left'></i> Prev</a>

                                    <?php if(!isset($activate_key[5])){ ?>
                                    <button type='submit' class='btn btn-success gotoStep2' style='float:right;'>Active your forum <i class='fa fa-angle-right'></i></a>
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


<script>

    

</script>

<script type="text/javascript">


$(document).on('click','.gotoStep2',function(){
    var key=$('.activate_key').val().trim();

    if(key.length < 10)
    {
        showAlert('','License key disallow blank!');return false;
    }

    var url=SITE_URL+'admin/plugin_page_url?plugin=bulletinboard&page=install_step2&key='+key;
    location.href=url;
});
   

       
</script>