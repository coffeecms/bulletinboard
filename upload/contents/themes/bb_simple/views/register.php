
  <div class='container   mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>

      <?php load_hook('bb_top_register_page');?>

          <!-- Register -->
          <!-- row -->
          <div class='row'>
            
            <!-- left -->
            <div class='col-lg-12 '>
              <div class="card text-dark bg-light mb-3" style=' '>
                <div class="card-header card-header-forum">
                  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo SITE_URL;?>">Home</a></li>
                      <li class="breadcrumb-item"><a >Register account</a></li>
                    </ol>
                  </nav>
                </div>
                <div class="card-body">
                <?php BB_PHPCode::load('top_register_page');?>

                  <?php if(Configs::$_['register_user_status']=='yes'){ ?>

                  <!-- row -->
                  <div class='row margin-bottom-20'>
                    <div class='col-5'>
                      <span>Username:</span>
                    </div>                    
                    <div class='col-7'>
                      <input type='text' class='form-control add-username' />
                    </div>                    
                  </div>
                  <!-- row -->
                  
                  <!-- row -->
                  <div class='row margin-bottom-20'>
                    <div class='col-5'>
                      <span>Email:</span>
                    </div>                    
                    <div class='col-7'>
                      <input type='email' class='form-control add-email' placeholder='youremail@gmail.com'  />
                    </div>                    
                  </div>
                  <!-- row -->
                  <!-- row -->
                  <div class='row margin-bottom-20'>
                    <div class='col-5'>
                      <span>Password:</span>
                    </div>                    
                    <div class='col-7'>
                      <input type='password' class='form-control add-password' />
                    </div>                    
                  </div>
                  <!-- row -->
                  <!-- row -->
                  <div class='row margin-bottom-20'>
                    <div class='col-5'>
                      <span>Birthday:</span>
                    </div>                    
                    <div class='col-7'>
                    <input type='text' class='input-control datepicker add-birthday' style='width:150px;' />
                    </div>                    
                  </div>
                  <!-- row -->
                    <!-- row -->
                    <div class='row margin-bottom-20'>
                    <div class='col-5'>
                      <span>Address:</span>
                    </div>                    
                    <div class='col-7'>
                      <input type='text' class='form-control add-address' />
                    </div>                    
                  </div>
                  <!-- row -->    
                  
                <?php if((int)Configs::$_['bb_enable_captcha_in_register']==1){ ?>
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
                    <input type='text' placeholder='Type answer here' class='form-control register-answer' />
                  </div>                    
                </div>
                <!-- row -->
                <?php } ?>

                  <!-- row -->
                  <div class='row margin-top-20'>
                    <div class='col-5'>
                      &nbsp;
                    </div>                    
                    <div class='col-7'>
                      <button type='button' class='btn btn-primary btnRegister'><i class='fas fa-key'></i> Register</button>
                    </div>                    
                  </div>
                  <!-- row -->

              <?php }else{ ?>

                  <!-- row -->
                  <div class='row'>
                                   
                    <div class='col-12'>
                      <span class='text-danger'>Current, We disallow new member register.</span>
                    </div>                    
                  </div>
                  <!-- row -->
              <?php } ?>
                  <?php BB_PHPCode::load('bottom_register_page');?>
                  <?php load_hook('bb_bottom_register_page');?>


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

        var default_url='<?php echo Configs::$_['bb_default_post_require_view'];?>';

document.onkeyup = KeyCheck;

function KeyCheck(e) {

    e.key=e.key.toUpperCase();

    if (e.key == "Enter") {

      $('.btnRegister').trigger('click'); 
       
    }
}


    $(document).ready(function(){
      $('.select2js').select2({
       
      });

      $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });
    });

    $(document).on('click','.btnRegister',function(){
    var sendData={};

    var jsonData={};
      
      jsonData['username']=$('.add-username').val();
      jsonData['email']=$('.add-email').val();
      jsonData['password']=$('.add-password').val();
      jsonData['birthday']=$('.add-birthday').val();
      jsonData['day']=$('.add-day').val();
      jsonData['address']=$('.add-address').val();
      jsonData['captcha_answer']=$('.register-answer').val();
    
      jsonData['type']='1';
      // sendData['save_data']=JSON.stringify(jsonData);

      postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_user_register', jsonData).then(data => {
          // console.log(data); // JSON data parsed by `data.json()` call
          
          if(data['data']!='OK')
          {
            showAlert('',data['data']);
            return false;
          }

          if(default_url.length > 10)
          {
              location.href=default_url;
          }
          else
          {
              location.href=SITE_URL+'login';
          }

          
      });        
  });


  </script>