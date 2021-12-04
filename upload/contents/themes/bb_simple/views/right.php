        <!-- right -->
        <div class='col-lg-3 col-md-3 '>
        <?php load_hook('bb_before_forum_right_widgets');?>

          <?php BB_PHPCode::load('before_forum_right_widgets');?>


          <!-- card -->
          <div class="card margin-bottom-20">
            <div class="card-body">
              <h5 class="card-title fs-13">Forum statistics</h5>
              <div class='row fs-11'  >
                <div class='col-lg-9 col-lg-9 '>Threads:</div>
                <div class='col-lg-3 col-lg-3 text-end' ><?php echo Configs::$_['bb_total_threads'];?></div>
              </div>
              <div class='row fs-11'  >
                <div class='col-lg-9 col-lg-9 '>Posts:</div>
                <div class='col-lg-3 col-lg-3 text-end' ><?php echo Configs::$_['bb_total_post'];?></div>
              </div>
              <div class='row'  >
                <div class='col-lg-9 col-lg-9 '>Members:</div>
                <div class='col-lg-3 col-lg-3 text-end' ><?php echo Configs::$_['bb_total_users'];?></div>
              </div>
              <div class='row'  >
                <div class='col-lg-7 col-lg-7 '>Latest member:</div>
                <div class='col-lg-5 col-lg-5 text-end' ><a href="<?php echo SITE_URL.'profile-'.Configs::$_['bb_latest_username'];?>.html" class="card-link fs-10"><?php echo Configs::$_['bb_latest_username'];?></a></div>
              </div>

            </div>
          </div>
          <!-- card -->
          <!-- card -->
          <div class="card margin-bottom-20">
            <div class="card-body">
              <h5 class="card-title fs-13">Share this page</h5>
              
              <!-- <a href="#" class="card-link" style='font-size: 24pt;'><i class='fab fa-facebook'></i></a>
              <a href="#" class="card-link" style='font-size: 24pt;'><i class='fab fa-twitter'></i></a>
              <a href="#" class="card-link" style='font-size: 24pt;'><i class='fab fa-facebook'></i></a> -->

                <div class="effect aeneas">
                  <div class="buttons">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(SITE_URL);?>" class="fb" title="Join us on Facebook"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                    <a href="https://reddit.com/submit?url=<?php echo urlencode(SITE_URL);?>" class="reddit" title="Join us on Reddit"><i class="fab fa-reddit" aria-hidden="true"></i></a>
                    <a href="https://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(SITE_URL);?>" class="pinterest" title="Join us on Pinterest"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(SITE_URL);?>" class="whatsapp" title="Join us on Whatsapp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                  
                  </div>
                </div>
            </div>
          </div>
          <!-- card -->
          <?php BB_PHPCode::load('after_forum_right_widgets');?>
          <?php load_hook('bb_after_forum_right_widgets');?>

        </div>
        <!-- left -->

        </div>
        <!-- row -->


        
      </main>
      
      <footer>
        
      </footer>
      
      
    </div>
    <!-- container -->
    