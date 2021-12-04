<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo Configs::$_['site_description']; ?>">
  <meta name="keywords" content="<?php echo Configs::$_['site_keywords']; ?>">
  <meta name="author" content="bulletinboard">
  <meta name="generator" content="CoffeeCMS">
  <title><?php echo Configs::$_['site_title']; ?></title>

  <link rel="icon" type="image/png" href="<?php echo SITE_URL;?>favicon.ico"/>
  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

 
  <link href="<?php echo THEMES_URL;?>bb_simple/assets/fontawesome/css/all.min.css" rel="stylesheet" />
 
  <link rel="stylesheet" href="<?php echo CoffeeMinifier::load([THEMES_PATH.'bb_simple/assets/css/bootstrap.min.css',THEMES_PATH.'bb_simple/assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',ROOT_PATH.'public/admin_theme/plugins/select2/css/select2.min.css',ROOT_PATH.'public/admin_theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',THEMES_PATH.'bb_simple/assets/css/custom.css',PLUGINS_PATH.'bulletinboard/css/global.css'],'style.css'); ?>?v=<?php echo time();?>">

  <!--FACEBOOK-->
  <?php if (strlen(Configs::$_['bb_site_logo']) > 5) {?>
    <meta property="og:image" content="<?php echo SITE_URL . Configs::$_['bb_site_logo']; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta name="twitter:image" content="<?php echo SITE_URL . Configs::$_['bb_site_logo']; ?>">
  <meta name="twitter:card" content="summary_large_image">
  <?php }?>
  <meta content="article" property="og:type">
  <meta name="robots" content="all">
  <meta name="twitter:card" value="summary">
  <meta name="twitter:title" content="<?php echo Configs::$_['site_title']; ?>">
  <meta name="twitter:description" content="<?php echo Configs::$_['site_description']; ?>">

  <meta property="og:site_name" content="<?php echo Configs::$_['site_title']; ?>">
  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?php echo Configs::$_['uri']; ?>"/>
  <meta property="og:title" content="<?php echo Configs::$_['site_title']; ?>" />
  <meta property="og:description" content="<?php echo Configs::$_['site_description']; ?>" />

  <!-- Scripts
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
 
  <script src="<?php echo CoffeeMinifier::load([THEMES_PATH.'bb_simple/assets/js/jquery.min.js',THEMES_PATH.'bb_simple/assets/js/popper.min.js',THEMES_PATH.'bb_simple/assets/js/bootstrap.min.js',THEMES_PATH.'bb_simple/assets/moment/min/moment.min.js',THEMES_PATH.'bb_simple/assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',THEMES_PATH.'bb_simple/assets/js/lozad.min.js',ROOT_PATH.'public/admin_theme/plugins/select2/js/select2.full.min.js',ROOT_PATH.'public/admin_theme/plugins/numeraljs/min/numeral.min.js',ROOT_PATH.'public/js/clipboard.min.js',ROOT_PATH.'contents/plugins/bulletinboard/js/core.js',THEMES_PATH.'bb_simple/assets/js/custom.js'],'script.js'); ?>?v=<?php echo time();?>"></script>

<script>
var SITE_URL='<?php echo SITE_URL; ?>';
var API_URL='<?php echo SITE_URL; ?>api/';
</script>
  <script src="<?php echo base_url(); ?>/public/js/system.js?v=<?php echo date('Hms'); ?>"></script>
  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <?php BB_PHPCode::load('theme_header_content');?>
<?php load_hook('theme_header_content');?>


</head>

<body>
<button type='button' class='btn btn-primary btnToggerSidebar d-block d-sm-none'  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button" data-target="show"><i class='fa fa-chevron-right'></i></button>
<!-- Modal -->
<div class="modal index-max" id="modalLoading" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal-loading" id="exampleModalLabel"><?php echo get_text_by_lang('Loading data', 'admin'); ?>...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <span class='fas fa-mug-hot loading-icon-el'></span>
      <div class="modal-loading-content margin-bottom-30"><?php echo get_text_by_lang('Wait a second', 'admin'); ?>...</div>

      <div class="lds-roller style1"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal index-max fade" id="modalAlert" data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notify</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="modal-alert-content"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger btnCloseAlert"  data-bs-dismiss="modal" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade index-max" id="modalReport"  data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label>Reason</label>
        <input type='text' class='form-control report_reason' placeholder='Type reason here...' />
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success btnSendReport" data-dismiss="modal"><i class="fas fa-save"></i> Send</button>
      <button type="button" class="btn btn-danger "  data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modalNotifies"  data-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notifies</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="wrap_list_notifies" style="min-height: 400px;    max-height: 400px;overflow: scroll;overflow-x: hidden;">
          <table class='table table-striped table-hover'>
            <tbody class='tbody_list_notifies'>
              <?php
if (!isset(Configs::$_['bb_user_data']['list_notifies'])) {
	Configs::$_['bb_user_data']['list_notifies'] = [];
}

$total = count(Configs::$_['bb_user_data']['list_notifies']);

$li = '';

for ($i = 0; $i < $total; $i++) {
	$li .= '
                  <tr>
                  <td><a href="' . Configs::$_['bb_user_data']['list_notifies'][$i]['target_url'] . '"><span class="text-primary">(' . date('M d, Y H:i:s', strtotime(Configs::$_['bb_user_data']['list_notifies'][$i]['ent_dt'])) . ')</span> <span>' . Configs::$_['bb_user_data']['list_notifies'][$i]['content'] . '</span></a></td>
                  </tr>
                  ';
}

echo $li;
?>

            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger "  data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<div class='container container-custom'>
    <header>
      <!-- row -->
      <div class='row'>
        <div class='col-lg-12'>
          <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand navbar-light bg-blue font-14">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="navbar-brand" href="#">
										<?php if (strlen(Configs::$_['bb_site_logo']) > 5) {?>
											<img src="<?php echo SITE_URL . Configs::$_['bb_site_logo']; ?>" />
										<?php }?>
                    </a>
                  </li>


                </ul>
                <form class="d-flex" method="post" action="<?php echo SITE_URL; ?>search">
                <div class="search"> <input type="text" name="keywords" class="form-control" placeholder="Search"> <button type='submit' class="btn btn-primary" style='    background-color: #579DDF;border-color: #579DDF;'><i class="fa fa-search"></i></button> </div>
                </form>
              </div>
            </div>
          </nav>
          <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-light font-14">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL;?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL;?>news">News</a>
                    </li>                      
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL;?>">Forums</a>
                    </li>                       
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL;?>memberslist">Members</a>
                    </li>           

                    <?php if(isset(Configs::$_['user_permissions']['BB30016'])){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL;?>admin">ModCP</a>
                    </li>
                    <?php } ?>                    
                            

                  </ul>
                  <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                      <?php if (isLogined()) {?>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>account"><i class='fa fa-home'></i> <?php echo Configs::$_['user_data']['username']; ?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link bb_add_bookmark" title="Add to bookmark" aria-current="page" href="#"><i class='fa fa-bookmark'></i> <span class='d-xl-none d-lg-none d-md-none d-sm-none'>Add bookmark</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link bb_show_notifies" title="Notifies" aria-current="page" href="#"><i class='fa fa-bell'></i> <span class='d-xl-none  d-lg-none  d-md-none d-sm-none '>notifies</span></a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" title="Profile" aria-current="page" href="<?php echo SITE_URL; ?>profile-<?php echo Configs::$_['user_data']['username']; ?>.html"><i class='fa fa-id-badge'></i> <span class='d-xl-none  d-lg-none  d-md-none d-sm-none '>Profile</span></a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><i class='fa fa-bell'></i> Notify</a>
                      </li> -->
                      <li class="nav-item">
                        <a class="nav-link " title="Messages" href="<?php echo SITE_URL; ?>message"><i class='fas fa-comment-alt'></i> <span style='font-size:8pt;'><?php echo number_format(Configs::$_['bb_user_data']['message_unread']); ?></span> <span class='d-xl-none  d-lg-none  d-md-none d-sm-none '>Messages</span></a>
                      </li>     

                      <li class="nav-item">
                        <a class="nav-link" title="Logout" href="<?php echo SITE_URL; ?>logout"><i class='fas fa-door-open'></i> <span class='d-xl-none  d-lg-none  d-md-none  d-sm-none '>Logout</span></a>
                      </li>
                      <?php } else {?>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" title="Login" href="<?php echo SITE_URL; ?>login"><i class='fa fa-key'></i> Login</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" title="Register" href="<?php echo SITE_URL; ?>register"><i class='fas fa-calendar'></i> Register</a>
                        </li>

                      <?php }?>

                      </ul>
                    </form>


                  </div>
                </div>
            </nav>
          </div>
        </div>
        <!-- row -->
      </header>




    </div>
    <!-- container -->
