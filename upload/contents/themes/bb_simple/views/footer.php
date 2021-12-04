<div class="offcanvas offcanvas-start w-30" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title" id="offcanvas">Menu</h6>
        <button type="button" class="btn-close btn-close-sidebar text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0 sidebar-body-scroll">
        <ul class="nav nav-pills nav-pills-sidebar flex-column mb-sm-auto mb-0 align-items-start" id="menu">

            <li class="nav-item">
                <a href="<?php echo SITE_URL;?>" class="nav-link text-truncate">
                    <i class="fa fa-home"></i><span class="ms-1 ">Home</span>
                </a>
            </li>

            <?php 

            $db = new Database();

            $listForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
            $listSubForums = $db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");

            bb_theme_genListNestedForum($listForums, $listSubForums);

            $li='';
            $total=count(Configs::$_['list_forum_data']);

            for ($i=0; $i < $total; $i++) { 
              $li.='
              <li>
                  <a href="'.SITE_URL.'f-'.Configs::$_['list_forum_data'][$i]['friendly_url'].'.html'.'" class="nav-link text-truncate">
                      <span class="ms-1 ">'.Configs::$_['list_forum_data'][$i]['title'].'</span> </a>
              </li>
              ';
            }

            echo $li;
            ?>


            <li class="nav-item">
            <a href="<?php echo SITE_URL;?>logout" class="nav-link text-truncate">
            <i class="fa fa-sign-out-alt"></i><span class="ms-1 ">Logout</span>
            </a>
            </li>

        </ul>
    </div>
</div>

<!-- row -->
<div class='container container-fluid pl-0px pr-0px' >

  <?php if(strlen(Configs::$_['uri'])==0 || stristr(Configs::$_['uri'], "allforums")==true || stristr(Configs::$_['uri'], "f-")==true || stristr(Configs::$_['uri'], "t-")==true){ ?>
  <!-- row -->
  <div class='row' >  
    <div class='col-12' >  
    <?php  prepare_visitor_online_data(100); ?>
    <!-- card -->
    <div class="card margin-bottom-20" >
      <div class="card-body">
        <h5 class="card-title fs-13">Members online</h5>
        <?php 

          $li='';

          for ($i=0; $i < Configs::$_['visitor_data']['total_users_online']; $i++) { 
            $li.='<a href="'.SITE_URL.'profile-'.Configs::$_['visitor_data']['users_online'][$i]['user_id'].'.html" class="card-link fs-10">'.Configs::$_['visitor_data']['users_online'][$i]['username'].'</a><span class="fs-10">,</span>';
          }

          echo $li;

        ?>
       

      </div>
      <div class="card-footer text-muted">
        <span class='fs-9'>Total: <?php echo Configs::$_['visitor_data']['total_online'];?> (members: <?php echo Configs::$_['visitor_data']['total_users_online'];?>, guests: <?php echo Configs::$_['visitor_data']['total_guest_online'];?>)</span>
      </div>
    </div>
    <!-- card -->
      </div>
    </div>
   <!-- row -->
 <?php } ?>
  <!-- row -->
  <div class='row' >
    <div class='col-lg-12'>
          <div class="card margin-bottom-20">
            <div class="card-body">
              <!-- row -->
              <div class='row'>
                <div class='col-lg-3 col-md-3 col-sm-3 col-12'>
                  Your logo / descriptions
                </div>                
                <div class='col-lg-3 col-md-3 col-sm-3 col-12'>
                <div class="card width-max" >
                  <div class="card-header  card-header-forum">
                    Text link
                  </div>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">Text link 1</li>
                  <li class="list-group-item">Text link 2</li>
                  <li class="list-group-item">Text link 3</li>
                  </ul>
                  </div>
                </div>                
                <div class='col-lg-3 col-md-3 col-sm-3 col-12'>
                <div class="card width-max" >
                  <div class="card-header  card-header-forum">
                    Text link
                  </div>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">Text link 1</li>
                  <li class="list-group-item">Text link 2</li>
                  <li class="list-group-item">Text link 3</li>
                  </ul>
                  </div>
                </div>                
                <div class='col-lg-3 col-md-3 col-sm-3 col-12'>
                  <div class="card width-max" >
                  <div class="card-header  card-header-forum">
                    Text link
                  </div>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">Text link 1</li>
                  <li class="list-group-item">Text link 2</li>
                  <li class="list-group-item">Text link 3</li>
                  </ul>
                  </div>
                </div>                
              </div>
              <!-- row -->
            </div>
            <div class="card-footer text-muted">
              <span class='fs-11'>Forum software by BulletinBoard ©2020-2021 CoffeeCMS</span>

              <div class='float-right'>
                <a href="<?php echo SITE_URL;?>helps/terms" class=" fs-11 mr-10px color-6c757d">Terms</a>
                <a href="<?php echo SITE_URL;?>rss.rss" class=" fs-11 mr-10px color-6c757d">RSS Feed</a>
                <a href="<?php echo SITE_URL;?>sitemap.xml" class=" fs-11 mr-10px color-6c757d">Site Map</a>
                <a href="<?php echo SITE_URL;?>helps/bbcode" class=" fs-11 mr-10px color-6c757d">BBCode</a>
                <a href="#" class='goToTop fs-11 color-6c757d'>Go to top</a>
              </div>
            </div>
          </div>
    </div>
  </div>
  <!-- row -->
</div>
<!-- row -->

  <?php BB_PHPCode::load('theme_footer_content');?>

<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
  $(document).on('click','.bb_add_bookmark',function(){

    var sendData={};

    sendData['url']=location.href;

    // sendData['type']='1';

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_bookmark', sendData).then(data => {
    // console.log(data); // JSON data parsed by `data.json()` call
    // $('#modalSearch').modal('hide');
    alert('Done!');

    });           
  });  

</script>
  <script>
  /*!
   * JavaScript Cookie v2.0.3
   * https://github.com/js-cookie/js-cookie
   *
   * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
   * Released under the MIT license
   */
  !function(e){if("function"==typeof define&&define.amd)define(e);else if("object"==typeof exports)module.exports=e();else{var n=window.Cookies,o=window.Cookies=e(window.jQuery);o.noConflict=function(){return window.Cookies=n,o}}}(function(){function e(){for(var e=0,n={};e<arguments.length;e++){var o=arguments[e];for(var t in o)n[t]=o[t]}return n}function n(o){function t(n,r,i){var c;if(arguments.length>1){if(i=e({path:"/"},t.defaults,i),"number"==typeof i.expires){var s=new Date;s.setMilliseconds(s.getMilliseconds()+864e5*i.expires),i.expires=s}try{c=JSON.stringify(r),/^[\{\[]/.test(c)&&(r=c)}catch(a){}return r=encodeURIComponent(String(r)),r=r.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),n=encodeURIComponent(String(n)),n=n.replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent),n=n.replace(/[\(\)]/g,escape),document.cookie=[n,"=",r,i.expires&&"; expires="+i.expires.toUTCString(),i.path&&"; path="+i.path,i.domain&&"; domain="+i.domain,i.secure?"; secure":""].join("")}n||(c={});for(var p=document.cookie?document.cookie.split("; "):[],u=/(%[0-9A-Z]{2})+/g,d=0;d<p.length;d++){var f=p[d].split("="),l=f[0].replace(u,decodeURIComponent),m=f.slice(1).join("=");'"'===m.charAt(0)&&(m=m.slice(1,-1));try{if(m=o&&o(m,l)||m.replace(u,decodeURIComponent),this.json)try{m=JSON.parse(m)}catch(a){}if(n===l){c=m;break}n||(c[l]=m)}catch(a){}}return c}return t.get=t.set=t,t.getJSON=function(){return t.apply({json:!0},[].slice.call(arguments))},t.defaults={},t.remove=function(n,o){t(n,"",e(o,{expires:-1}))},t.withConverter=n,t}return n()});
  </script>
<script type="text/javascript">
    // Run the cookie notification functions once the page has loaded
    $( document ).ready( function() {
      


      const observer = lozad(); // lazy loads elements with default selector as '.lozad'
      observer.observe();
    });



$(document).on('click','.btnToggerSidebar',function(){
  $(this).css({
    'visibility':'hidden'
  });
});
$(document).on('click','.btn-close-sidebar',function(){
  $('.btnToggerSidebar').css({
    'visibility':'unset'
  });
});
   
  </script>
<?php load_hook('bb_footer');?>
<?php coffee_content_hook('bb_footer_content');?>


</body>
  
  </html>