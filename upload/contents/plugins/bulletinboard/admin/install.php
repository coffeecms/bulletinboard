<?php
    $db=new Database();


    $loadData=$db->query("SHOW TABLES LIKE 'bb_poll_data'");

    
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
                            <h3 class="card-title">Install BulletinBoard</h3>
                            
                        </div>
                        <div class="card-body table-responsive p-10">
                            <table class='table'>
                                <tbody>
                                    <?php if(count($loadData)>0){ ?>
                                    <tr>
                                        <td class='text-danger'>Install can not continue because you have been install Bulletin Board</td>
                                    </tr>
                                    <?php }else{ ?>
                                    <!-- <tr>
                                        <td class='text-success'>Ok,your system can be install bulletinboard. Click 'Next step' button to continue install...</td>
                                    </tr> -->
                                    <tr>
                                        <td>
                                            <p>
                                               <span>License (One key One forum & Lifetime support)</span> 
                                            </p>

                                            <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">License key</span>
                                                <input type="text" class="form-control activate_key" value="11111-11111-11111-11111-11111" placeholder="" aria-label="activate_key" aria-describedby="basic-addon1">
                                            </div>
                                        </td>
                                    </tr>
                               

                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- row -->
                            <div class='row' style='margin-top:20px;'>
                                <div class='col-lg-12'>
                                    <a href="<?php echo SITE_URL;?>admin/plugins" class='btn btn-info' style=''><i class='fa fa-angle-left'></i> Prev</a>

                                    <?php if(count($loadData) == 0){ ?>
                                    <button type='button' href="<?php echo SITE_URL;?>admin/plugin_page_url?plugin=bulletinboard&page=install_step2" class='btn btn-success gotoStep2' style='float:right;'>Next step <i class='fa fa-angle-right'></i></a>
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