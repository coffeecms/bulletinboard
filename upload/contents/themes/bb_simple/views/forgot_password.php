
  <div class='container   mt-20px pl-0px pr-0px' >
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>

     
      <?php load_hook('bb_top_login_page');?>

        <!-- Login -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL;?>">Home</a></li>
                    <li class="breadcrumb-item"><a >Forgot Password</a></li>
                  </ol>
                </nav>
              </div>
              <div class="card-body">
                

              <?php BB_PHPCode::load('top_login_page');?>

                <!-- row -->
                <div class='row'>
                  <div class='col-5'>
                    <span>Username or email:</span>
                  </div>                    
                  <div class='col-7'>
                    <input type='text' class='form-control login-username' />
                  </div>                    
                </div>
                <!-- row -->
             
                <?php if((int)Configs::$_['bb_enable_captcha_in_login']==1){ ?>
                <!-- row -->
                <div class='row margin-top-20'>
                  <div class='col-12'>
                    <strong>Answer below question to verify you not is robot:</strong>
                  </div>                    
                  <div class='col-8'>
                    
                      <?php  if(Configs::$_['bb_system_captcha_method']=='text') { ?>
                        <span><?php echo $captcha_data['title'];?></span>
                          <?php } ?>
                        <?php  if(Configs::$_['bb_system_captcha_method']=='image') { ?>
    <div style="margin:0px;padding:0px;min-width: 280px;min-height:90px;max-width: 280px;max-height:140px;background-color: #2885BF;color:#ffffff;border-radius: 3px;padding:3px;position: relative;">

                          <div class="wrap_catpcha_str" style="margin:0px;padding:0px;float:left;width:100%;min-height:78px;max-height:78px;background-color: #ffffff;border-radius: 3px;">
                              <img src="<?php echo BB_Captcha_Image::make(6);?>" style="margin:0px;padding:0px;" />
                              <span class="btn btn-success btn-refresh-captcha" title="Refresh" style="position: absolute;right:15px;top:22px;"><i class="fa fa-sync"></i></span>
                          </div>
                        </div>
                      <?php } ?>
                    
                    
                  </div>                    
                  <div class='col-4'>
                    <input type='text' placeholder='Type answer here' class='form-control captcha_answer' />
                  </div>                    
                </div>
                <!-- row -->
                <?php } ?>
                
                <!-- row -->
                <div class='row margin-top-20'>
                  <div class='col-5'>
                  
                  </div>                    
                  <div class='col-7'>
                  <button type='button' class='btn btn-success btnLogin'><i class='fas fa-paper-plane'></i> Send reset password link</button>
                  </div>                    
                </div>
                <!-- row -->
               
                <!-- row -->
                <div class='row margin-top-20'>
                  <div class='col-5'>
                    &nbsp;
                  </div>                    
                  <div class='col-7'>
                    <span>Not have an account ?</span>
                    <a  href="<?php echo SITE_URL;?>register" class='btn btn-primary '><i class='fas fa-lock'></i> Register now</a>
                  </div>                    
                </div>
                <!-- row -->

                <?php BB_PHPCode::load('bottom_login_page');?>
                <?php load_hook('bb_bottom_login_page');?>

              </div>
            </div>
            
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->

      
      </div>
      <!-- right -->
 

      </div>
      <!-- row -->


      
    </main>
    
    <footer>
      
    </footer>
    
    
  </div>
  <!-- container -->
  
  <script>

    $(document).on('click','.btnLogin',function(){
    var sendData={};

    var jsonData={};
      
      jsonData['username']=$('.login-username').val();
      jsonData['captcha_answer']=$('.captcha_answer').val();
        if(sendData['username'].length < 3)
        {
        showAlert('Check your username again,pls!',data['data']);
        return false;
        }
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=user_forgot_password', jsonData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        
        if(data['data']!='OK')
        {
          showAlert('',data['data']);
          return false;
        }

        showAlertOK('Check your email then click to verify url',data['data']);
      });        
    });


  </script>

  