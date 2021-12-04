
<?php
if(!isset(Configs::$_['user_permissions']['BB30014']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	


BB_System::updateStats();

$db=new Database();

if(!isset(Configs::$_['bb_total_users']))
{
  clear_hook();
}
		

// $queryStr=" select MONTH(ent_dt) as work_month,YEAR(ent_dt) as work_year ,count(*) as total";
// $queryStr.=" from user_mst";
// $queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-11 months'))."' AND '".date("Y-m-d")."'";
// $queryStr.=" group by MONTH(ent_dt),YEAR(ent_dt)";
// $queryStr.=" order by MONTH(ent_dt),YEAR(ent_dt) asc";

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from user_mst";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$register_stats_12months=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_threads_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$newthread_stats_30days=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_posts_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$replies_stats_30days=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_message_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$message_stats_30days=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_thread_attach_files_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."' AND data_type='thread'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$thread_attach_files_stats_30days=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_thread_attach_files_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."' AND data_type='post'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$post_attach_files_stats_30days=$db->query($queryStr);

$queryStr=" select CAST(ent_dt as date) as work_date,count(*) as total";
$queryStr.=" from bb_thread_attach_files_data";
$queryStr.=" where CAST(ent_dt as date) BETWEEN '".date("Y-m-d", strtotime('-30 days'))."' AND '".date("Y-m-d")."' AND data_type='message'";
$queryStr.=" group by CAST(ent_dt as date)";
$queryStr.=" order by CAST(ent_dt as date) asc";

$message_attach_files_stats_30days=$db->query($queryStr);

$queryStr=" select a.title,b.total";
$queryStr.=" from user_group_mst as a";
$queryStr.=" join (select group_c,count(*) as total from user_mst group by group_c) as b";
$queryStr.=" ON a.group_c=b.group_c";

$usergroup_stats=$db->query($queryStr);

$queryStr=" select a.title,b.total";
$queryStr.=" from bb_post_prefix_data as a";
$queryStr.=" join (select prefix_id ,count(*) as total from bb_threads_data group by prefix_id) as b";
$queryStr.=" ON a.prefix_id=b.prefix_id";

$postprefix_stats=$db->query($queryStr);

$totalFileSize=$db->query("SELECT sum(file_size) as total FROM bb_thread_attach_files_data");
$file_type_stats=$db->query("SELECT file_type as title,sum(file_size) as total FROM bb_thread_attach_files_data group by file_type");

$total=count($file_type_stats);

for ($i=0; $i < $total; $i++) { 
  $file_type_stats[$i]['title']=explode('/',$file_type_stats[$i]['title'])[1];
}

?>


<link href="<?php echo SITE_URL; ?>public/apexcharts-bundle/dist/apexcharts.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo SITE_URL; ?>public/apexcharts-bundle/dist/apexcharts.min.js"></script>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo get_text_by_lang('Dashboard','admin');?></h1>
            <!-- <h5 class="m-0 text-danger">Your forum will be expired on <?php echo date('M d, Y',strtotime(Configs::$_['bb_license_end_dt']));?></h5> -->
          </div><!-- /.col -->
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
          <?php coffee_content_hook('admin_panel_dashboard_top');?>
          </div>                   
        </div>
        <!-- /.row -->
        <!-- Info boxes -->
        <div class="row">
    
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Users','admin');?></span>
                <span class="info-box-number total_users">
                  <?php echo number_format(Configs::$_['bb_total_users']); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Threads','admin');?></span>
                <span class="info-box-number total_threads"><?php echo number_format(Configs::$_['bb_total_threads']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Posts','admin');?></span>
                <span class="info-box-number total_posts"><?php echo number_format(Configs::$_['bb_total_post']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-comment-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Message','admin');?></span>
                <span class="info-box-number total_message"><?php echo number_format(Configs::$_['bb_total_messages']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->  

        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-comment-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Profile Message','admin');?></span>
                <span class="info-box-number total_profile_message">
                <?php echo number_format(Configs::$_['bb_total_user_wall_messages']); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-link"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Attach Files','admin');?></span>
                <span class="info-box-number total_attach_files"><?php echo number_format(Configs::$_['bb_total_attach_files']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-image"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Threads Deactivate','admin');?></span>
                <span class="info-box-number total_threads_deactivate"><?php echo number_format(Configs::$_['bb_total_threads_deactivate']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Views','admin');?></span>
                <span class="info-box-number total_views"><?php echo number_format(Configs::$_['bb_forum_total_views']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shield-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Guest can download attach files','admin');?></span>
                <span class="info-box-number firewall_status">
                <?php if((int)Configs::$_['bb_allow_guest_download_attach_files']==1){echo 'Enabled';}else{echo 'Disabled';} ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shield-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Guest can view forum','admin');?></span>
                <span class="info-box-number guest_can_view_forum">
                <?php if((int)Configs::$_['bb_allow_guest_view_forum']==1){echo 'Enabled';}else{echo 'Disabled';} ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Allow new register','admin');?></span>
                <span class="info-box-number allow_new_register">
                <?php if(Configs::$_['register_user_status']=='yes'){echo 'Enabled';}else{echo 'Disabled';} ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?php echo get_text_by_lang('Total attachments size','admin');?></span>
                <span class="info-box-number total_attachments_size">
                
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


        </div>
        <!-- /.row -->  

        
        <!-- Info boxes -->
          <!-- Info boxes -->
          <div class="row">
                      <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data">

                      <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                  <h3 class="card-title"><?php echo get_text_by_lang('30 Days Registers Stats','admin');?>

                
                  </h3>
                  <div class="card-tools">
                      
                  
                  </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <div id='register_stats_12months'></div>
              </div>
              </div>
              <!-- /.card -->
                  
                      </form>
                      </div>
                      
                  </div>
          <!-- /.row -->
          <!-- Info boxes -->
          <div class="row">
                      <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data">

                      <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                  <h3 class="card-title"><?php echo get_text_by_lang('30 Days New Thread Stats','admin');?></h3>
                  <div class="card-tools">
                      
                  
                  </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <div id='newthread_stats_30days'></div>
              </div>
              </div>
              <!-- /.card -->
                  
                      </form>
                      </div>
                      
                  </div>
          <!-- /.row -->
          <!-- Info boxes -->
          <div class="row">
                      <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data">

                      <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                  <h3 class="card-title"><?php echo get_text_by_lang('30 Days Replies Stats','admin');?></h3>
                  <div class="card-tools">
                      
                  
                  </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <div id='replies_stats_30days'></div>
              </div>
              </div>
              <!-- /.card -->
                  
                      </form>
                      </div>
                      
                  </div>
          <!-- /.row -->
          <!-- Info boxes -->
          <div class="row">
                      <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data">

                      <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                  <h3 class="card-title"><?php echo get_text_by_lang('30 Days Message Stats','admin');?></h3>
                  <div class="card-tools">
                      
                  
                  </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <div id='message_stats_30days'></div>
              </div>
              </div>
              <!-- /.card -->
                  
                      </form>
                      </div>
                      
                  </div>
          <!-- /.row -->
          
          <!-- Info boxes -->
          <div class="row">
                      <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data">

                      <div class="card" style='margin-top:20px;'>
              <div class="card-header border-0">
                  <h3 class="card-title"><?php echo get_text_by_lang('30 Days Attachments Stats','admin');?></h3>
                  <div class="card-tools">
                      
                  
                  </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <div id='thread_attach_files_stats_30days'></div>
              </div>
              </div>
              <!-- /.card -->
                  
                      </form>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 ">
                <form action="" method="post" enctype="multipart/form-data">

                <div class="card" style='margin-top:20px;'>
                  <div class="card-header border-0">
                      <h3 class="card-title"><?php echo get_text_by_lang('User Group Stats','admin');?></h3>
                      <div class="card-tools">
                          
                      
                      </div>
                  </div>
                  <div class="card-body table-responsive p-0" style='overflow:scroll;min-height:450px;max-height:450px;'> 
                    <div id='usergroup_stats'></div>
                  </div>
                </div>
                <!-- /.card -->
            
                </form>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <form action="" method="post" enctype="multipart/form-data">

                <div class="card" style='margin-top:20px;'>
                  <div class="card-header border-0">
                      <h3 class="card-title"><?php echo get_text_by_lang('Thread Prefix Stats','admin');?></h3>
                      <div class="card-tools">
                          
                      
                      </div>
                  </div>
                  <div class="card-body table-responsive p-0" style='overflow:scroll;min-height:450px;max-height:450px;'> 
                    <div id='postprefix_stats'></div>
                  </div>
                </div>
                <!-- /.card -->
                </form>
              </div>  
              <div class="col-lg-6 col-md-6 col-sm-6 ">
                <form action="" method="post" enctype="multipart/form-data">

                <div class="card" style='margin-top:20px;'>
                  <div class="card-header border-0">
                      <h3 class="card-title"><?php echo get_text_by_lang('Attachments Stats (Megabytes)','admin');?></h3>
                      <div class="card-tools">
                          
                      
                      </div>
                  </div>
                  <div class="card-body table-responsive p-0" style='overflow:scroll;min-height:450px;max-height:450px;'> 
                    <div id='file_type_stats'></div>
                  </div>
                </div>
                <!-- /.card -->
            
                </form>
              </div>                      
                  </div>
          <!-- /.row -->
          
          <!-- Info boxes -->
          <div class="row">

  
                      
          </div>
          <!-- /.row -->
        <!-- /.row -->

        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-12">
          <?php coffee_content_hook('admin_panel_dashboard_bottom');?>
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
pageData['register_stats_12months']=<?php echo json_encode($register_stats_12months);?>;
pageData['newthread_stats_30days']=<?php echo json_encode($newthread_stats_30days);?>;
pageData['replies_stats_30days']=<?php echo json_encode($replies_stats_30days);?>;
pageData['message_stats_30days']=<?php echo json_encode($message_stats_30days);?>;
pageData['thread_attach_files_stats_30days']=<?php echo json_encode($thread_attach_files_stats_30days);?>;
pageData['post_attach_files_stats_30days']=<?php echo json_encode($post_attach_files_stats_30days);?>;
pageData['message_attach_files_stats_30days']=<?php echo json_encode($message_attach_files_stats_30days);?>;
pageData['usergroup_stats']=<?php echo json_encode($usergroup_stats);?>;
pageData['postprefix_stats']=<?php echo json_encode($postprefix_stats);?>;
pageData['totalFileSize']=<?php echo json_encode($totalFileSize);?>;
pageData['file_type_stats']=<?php echo json_encode($file_type_stats);?>;



function file_type_stats()
{

  var listLabel=[];
  var listVal=[];

  var total=pageData['file_type_stats'].length;

  var theSize=0;

  for (let i = 0; i < total; i++) {
    theSize=parseFloat(parseInt(pageData['file_type_stats'][i]['total'])/1024/1024).toFixed(2);
    listLabel.push(pageData['file_type_stats'][i]['title']);
    listVal.push(theSize);
  }

  var options = {
          series: listVal,
          chart: {
          width: '100%',
          type: 'pie',
        },
        labels: listLabel,
        responsive: [{
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
  $("#file_type_stats").html('');
  var chart = new ApexCharts(document.querySelector("#file_type_stats"), options);
  chart.render();

}

function usergroup_stats()
{

  var listLabel=[];
  var listVal=[];

  var total=pageData['usergroup_stats'].length;

  for (let i = 0; i < total; i++) {
    listLabel.push(pageData['usergroup_stats'][i]['title']);
    listVal.push(parseInt(pageData['usergroup_stats'][i]['total']));
    
  }

  var options = {
          series: listVal,
          chart: {
          width: '100%',
          type: 'pie',
        },
        labels: listLabel,
        responsive: [{
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
  $("#usergroup_stats").html('');
  var chart = new ApexCharts(document.querySelector("#usergroup_stats"), options);
  chart.render();

}

function postprefix_stats()
{

  var listLabel=[];
  var listVal=[];

  var total=pageData['postprefix_stats'].length;

  for (let i = 0; i < total; i++) {
    listLabel.push(pageData['postprefix_stats'][i]['title']);
    listVal.push(parseInt(pageData['postprefix_stats'][i]['total']));
    
  }

  var options = {
          series: listVal,
          chart: {
          width: '100%',
          type: 'pie',
        },
        labels: listLabel,
        responsive: [{
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
  $("#postprefix_stats").html('');
  var chart = new ApexCharts(document.querySelector("#postprefix_stats"), options);
  chart.render();

}


function register_stats_12months()
{

    var listMonth=[];
    var listMonth=[];
    var listLabels=[];
    var listSended=[];
    var listReaded=[];
    var listVal=[];

    var theStartDate=moment().add('days',-31).format('YYYY-MM-DD');

    var totalSend=pageData['register_stats_12months'].length;

    var isPush=false;

    var totalIPD=0;

    var isPush=false;

    var listDays=[];

    var listDayAdded={};

    for (var i = 0; i < 32; i++) {

        if(typeof listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]!='undefined')
        {
            continue;
        }

        listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]='';

        listLabels.push(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM'));

        isPush=false;
        for (var k = 0; k < totalSend; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['register_stats_12months'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listVal.push(pageData['register_stats_12months'][k]['total']);
                isPush=true;

                break;
            }
            
        }

        if(isPush==false)
        {
            listVal.push(0);
        }

    }

// console.log(listSended);
// console.log(listReaded);
//     return ;
    var options = {
        colors: ['#40B8E8'],
        series: [
        {
            name: 'Views',
            type: 'column',
            data: listVal
        }
                ],
        chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [2]
      },
      title: {
        text: ''
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [0,1,2]
      },
      labels: listLabels,
      xaxis: {
        type: 'string'
      },
      yaxis: [{
        title: {
          text: 'Total',
        },
      
      }, ]
      };

      

      $("#register_stats_12months").html('');
      var chart = new ApexCharts(document.querySelector("#register_stats_12months"), options);
      chart.render();
}

function newthread_stats_30days()
{

    var listMonth=[];
    var listMonth=[];
    var listLabels=[];
    var listSended=[];
    var listReaded=[];
    var listVal=[];

    var theStartDate=moment().add('days',-31).format('YYYY-MM-DD');

    var totalSend=pageData['newthread_stats_30days'].length;

    var isPush=false;

    var totalIPD=0;

    var isPush=false;

    var listDays=[];

    var listDayAdded={};

    for (var i = 0; i < 32; i++) {

        if(typeof listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]!='undefined')
        {
            continue;
        }

        listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]='';

        listLabels.push(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM'));

        isPush=false;
        for (var k = 0; k < totalSend; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['newthread_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listVal.push(pageData['newthread_stats_30days'][k]['total']);
                isPush=true;

                break;
            }
            
        }

        if(isPush==false)
        {
            listVal.push(0);
        }

    }

// console.log(listSended);
// console.log(listReaded);
//     return ;
    var options = {
        colors: ['#40B8E8'],
        series: [
        {
            name: 'Views',
            type: 'column',
            data: listVal
        }
                ],
        chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [2]
      },
      title: {
        text: ''
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [0,1]
      },
      labels: listLabels,
      xaxis: {
        type: 'string'
      },
      yaxis: [{
        title: {
          text: 'Total',
        },
      
      }, ]
      };

      $("#newthread_stats_30days").html('');
      var chart = new ApexCharts(document.querySelector("#newthread_stats_30days"), options);
      chart.render();
}

function replies_stats_30days()
{

    var listMonth=[];
    var listMonth=[];
    var listLabels=[];
    var listSended=[];
    var listReaded=[];
    var listVal=[];

    var theStartDate=moment().add('days',-31).format('YYYY-MM-DD');

    var totalSend=pageData['replies_stats_30days'].length;

    var isPush=false;

    var totalIPD=0;

    var isPush=false;

    var listDays=[];

    var listDayAdded={};

    for (var i = 0; i < 32; i++) {

        if(typeof listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]!='undefined')
        {
            continue;
        }

        listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]='';

        listLabels.push(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM'));

        isPush=false;
        for (var k = 0; k < totalSend; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['replies_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listVal.push(pageData['replies_stats_30days'][k]['total']);
                isPush=true;

                break;
            }
            
        }

        if(isPush==false)
        {
            listVal.push(0);
        }

    }

// console.log(listSended);
// console.log(listReaded);
//     return ;
    var options = {
        colors: ['#40B8E8'],
        series: [
        {
            name: 'Views',
            type: 'column',
            data: listVal
        }
                ],
        chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [2]
      },
      title: {
        text: ''
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [0,1]
      },
      labels: listLabels,
      xaxis: {
        type: 'string'
      },
      yaxis: [{
        title: {
          text: 'Total',
        },
      
      }, ]
      };

      $("#replies_stats_30days").html('');
      var chart = new ApexCharts(document.querySelector("#replies_stats_30days"), options);
      chart.render();
}

function message_stats_30days()
{

    var listMonth=[];
    var listMonth=[];
    var listLabels=[];
    var listSended=[];
    var listReaded=[];
    var listVal=[];

    var theStartDate=moment().add('days',-31).format('YYYY-MM-DD');

    var totalSend=pageData['message_stats_30days'].length;

    var isPush=false;

    var totalIPD=0;

    var isPush=false;

    var listDays=[];

    var listDayAdded={};

    for (var i = 0; i < 32; i++) {

        if(typeof listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]!='undefined')
        {
            continue;
        }

        listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]='';

        listLabels.push(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM'));

        isPush=false;
        for (var k = 0; k < totalSend; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['message_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listVal.push(pageData['message_stats_30days'][k]['total']);
                isPush=true;

                break;
            }
            
        }

        if(isPush==false)
        {
            listVal.push(0);
        }

    }

// console.log(listSended);
// console.log(listReaded);
//     return ;
    var options = {
        colors: ['#40B8E8'],
        series: [
        {
            name: 'Views',
            type: 'column',
            data: listVal
        }
                ],
        chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [2]
      },
      title: {
        text: ''
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [0,1]
      },
      labels: listLabels,
      xaxis: {
        type: 'string'
      },
      yaxis: [{
        title: {
          text: 'Total',
        },
      
      }, ]
      };

      $("#message_stats_30days").html('');
      var chart = new ApexCharts(document.querySelector("#message_stats_30days"), options);
      chart.render();
}

function thread_attach_files_stats_30days()
{

    var listMonth=[];
    var listMonth=[];
    var listLabels=[];
    var listSended=[];
    var listReaded=[];
    var listThreadStats=[];
    var listPostStats=[];
    var listMessageStats=[];
    var listVal=[];

    var theStartDate=moment().add('days',-31).format('YYYY-MM-DD');

    var totalThread=pageData['thread_attach_files_stats_30days'].length;
    var totalPost=pageData['post_attach_files_stats_30days'].length;
    var totalMessage=pageData['message_attach_files_stats_30days'].length;

    var isPush=false;

    var totalIPD=0;

    var isThreadPush=false;
    var isPostPush=false;
    var isMessagePush=false;

    var listDays=[];

    var listDayAdded={};

    for (var i = 0; i < 32; i++) {

        if(typeof listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]!='undefined')
        {
            continue;
        }

        listDayAdded[moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')]='';

        listLabels.push(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM'));

        isThreadPush=false;
        isPostPush=false;
        isMessagePush=false;
        for (var k = 0; k < totalThread; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['thread_attach_files_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listThreadStats.push(pageData['thread_attach_files_stats_30days'][k]['total']);
                isThreadPush=true;

                break;
            }
            
        }

        if(isThreadPush==false)
        {
            listThreadStats.push(0);
        }
        
        for (var k = 0; k < totalPost; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['post_attach_files_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listPostStats.push(pageData['post_attach_files_stats_30days'][k]['total']);
                isPostPush=true;

                break;
            }
            
        }

        if(isPostPush==false)
        {
            listPostStats.push(0);
        }

        for (var k = 0; k < totalMessage; k++) {
            if(moment(theStartDate,'YYYY-MM-DD').add('days',i).format('DD/MM')==moment(pageData['message_attach_files_stats_30days'][k]['work_date'],'YYYY-MM-DD').format('DD/MM'))
            {
                listMessageStats.push(pageData['message_attach_files_stats_30days'][k]['total']);
                isMessagePush=true;

                break;
            }
            
        }

        if(isMessagePush==false)
        {
            listMessageStats.push(0);
        }

    }


        var options = {
          series: [
            {
            name: "Thread",
            data: listThreadStats
            },
            {
            name: "Post",
            data: listPostStats
            },
            {
            name: "Message",
            data: listMessageStats
            },
        ],
          chart: {
          height: 350,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
          toolbar: {
            show: true
          }
        },
        colors: ['#77B6EA', '#F74C19','#32C972'],
        dataLabels: {
          enabled: true,
        },
        stroke: {
          // curve: 'smooth'
          width:[2,2,2]
        },
        // title: {
        //   text: 'Average High & Low Temperature',
        //   align: 'left'
        // },
        // grid: {
        //   borderColor: '#e7e7e7',
        //   row: {
        //     colors: ['#f3f3f3', '#F74C19','#32C972'], // takes an array which will be repeated on columns
        //     opacity: 0.5
        //   },
        // },
        markers: {
          size: 1
        },
        xaxis: {
          categories: listLabels,
          // title: {
          //   text: 'Day'
          // }
        },
        yaxis: {
          title: {
            text: 'Total'
          },
          // min: 0,
          // max: 40
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
        };

      $("#thread_attach_files_stats_30days").html('');
      var chart = new ApexCharts(document.querySelector("#thread_attach_files_stats_30days"), options);
      chart.render();
}


$(document).ready(function(){

  // prepareChart1_1();

  //pageData['totalFileSize']

  if(pageData['totalFileSize'][0]['total']==null)
  {
    pageData['totalFileSize'][0]['total']=0;
  }

  $('.total_attachments_size').html(bytesToSize(pageData['totalFileSize'][0]['total']));

  usergroup_stats();
  postprefix_stats();
  newthread_stats_30days();
  replies_stats_30days();
  message_stats_30days();
  thread_attach_files_stats_30days();
  register_stats_12months();
  file_type_stats();

});


</script>