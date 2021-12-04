<?php


$db=new Database(); 

$canShowHidePaymentData=true;
$canApproveThread=false;

$loadData=$db->query("SHOW TABLES LIKE 'bb_bbcode_hide_pay_data'");

if(count($loadData)==0)
{
    $canShowHidePaymentData=false;
}

?>
<style>
.select2-container .select2-selection--single
{
  height: 38px;
}
  </style>
  <div class='container   mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-12 '>
    
      <?php BB_PHPCode::load('top_account_page');?>
        <!-- List forum threads -->
        
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3" style=' '>
              <div class="card-header card-header-forum">
                Account information
              </div>
              <div class="card-body">
                    <!-- d-flex -->
                    <div class="align-items-start">
                        <div class='row'>
                            <div class='col-lg-3 '>
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- <button class="nav-link active text-start" id="v-notifies-tab" data-bs-toggle="pill" data-bs-target="#v-notifies" type="button" role="tab" aria-controls="v-notifies" aria-selected="false">Notifies</button> -->
                                    <button class="nav-link text-start" id="v-reactions-received-tab" data-bs-toggle="pill" data-bs-target="#v-reactions-received" type="button" role="tab" aria-controls="v-reactions-received" aria-selected="false">Reactions received</button>
                                    <button class="nav-link text-start" id="v-bookmarks-tab" data-bs-toggle="pill" data-bs-target="#v-bookmarks" type="button" role="tab" aria-controls="v-bookmarks" aria-selected="false">Bookmarks</button>
                                    <button class="nav-link text-start" id="v-informations-tab" data-bs-toggle="pill" data-bs-target="#v-informations" type="button" role="tab" aria-controls="v-informations" aria-selected="false">Account Details</button>
                                    <button class="nav-link text-start" id="v-password-tab" data-bs-toggle="pill" data-bs-target="#v-password" type="button" role="tab" aria-controls="v-password" aria-selected="false">Password & Security</button>
                                    <button class="nav-link text-start" id="v-privacy-tab" data-bs-toggle="pill" data-bs-target="#v-privacy" type="button" role="tab" aria-controls="v-privacy" aria-selected="false">Privacy</button>
                                    <!-- <button class="nav-link text-start" id="v-preferences-tab" data-bs-toggle="pill" data-bs-target="#v-preferences" type="button" role="tab" aria-controls="v-preferences" aria-selected="false">Preferences</button> -->
                                    <button class="nav-link text-start" id="v-signature-tab" data-bs-toggle="pill" data-bs-target="#v-signature" type="button" role="tab" aria-controls="v-signature" aria-selected="false">Signature</button>
                                    <button class="nav-link text-start" id="v-following-tab" data-bs-toggle="pill" data-bs-target="#v-following" type="button" role="tab" aria-controls="v-following" aria-selected="false">Following</button>
                                    <button class="nav-link text-start" id="v-followers-tab" data-bs-toggle="pill" data-bs-target="#v-followers" type="button" role="tab" aria-controls="v-followers" aria-selected="false">Followers</button>

                                    <?php if($canShowHidePaymentData==true){ ?>
                                        <button class="nav-link text-start" id="v-hidepayment-tab" data-bs-toggle="pill" data-bs-target="#v-hidepayment" type="button" role="tab" aria-controls="v-hidepayment" aria-selected="false">[Hide] Received Payments</button>
                                        <button class="nav-link text-start" id="v-hidesendpayment-tab" data-bs-toggle="pill" data-bs-target="#v-hidesendpayment" type="button" role="tab" aria-controls="v-hidesendpayment" aria-selected="false">[Hide] Send Payments</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class='col-lg-9 '>
                                        <div class="tab-content" id="v-pills-tabContent">
                                        

                                        <div class="tab-pane fade show active" id="v-notifies" role="tabpanel" aria-labelledby="v-notifies-tab">
                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        <table class='table table-hover'>
                                            <thead>
                                            <tr>
                                            <td>Title</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>
                                        </thead>

                                        <tbody class='comment_body'>
                                        <tr>
                                            <td>Content</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>                              
                                        </tbody>
                                        </table>

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="v-reactions-received" role="tabpanel" aria-labelledby="v-reactions-received-tab">

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Threads</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>
                                            </thead>

                                            <tbody class='reactions_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-bookmarks" role="tabpanel" aria-labelledby="v-bookmarks-tab">

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>Title</td>
                                                <td class="text-end">Url</td>
                                            </tr>
                                            </thead>

                                            <tbody class='bookmarks_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-informations" role="tabpanel" aria-labelledby="v-informations-tab">
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Email</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' value='<?php echo $bb_user_profile_mst['email'];?>' class='form-control edit-email' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Email Options</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                    <button type="button" class="btn btn-primary btn-none received_news_via_email" data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                    <span class="input-group-text">Receive news and update emails</span>
                                                    
                                                    </div>
                                                    <div class="input-group mb-3">
                                                    <button type="button" class="btn btn-primary btn-none received_activities_via_email" data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                    <span class="input-group-text">Receive activity summary email</span>
                                                    
                                                    </div>

                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Avartar</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='file' class='form-control fileMedias edit-avartar' data-type='avatar' />

                                                    <div class='wrap_show_avatar' style='margin-top:10px;'></div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Profile Cover Image</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='file' class='form-control fileMedias edit-profilebanner' data-type='cover' />
                                                    <div class='wrap_show_cover' style='margin-top:10px;'></div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Points</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' value="<?php echo $bb_user_profile_data['total_points'];?>" disabled class='form-control edit-points' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                              
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Balance</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' value="<?php echo $bb_user_profile_data['balance'];?>" disabled class='form-control edit-balance' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Birthday</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-birthday' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Location</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-location' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Website</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-website' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Occupation</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-occupation' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Gender</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-none edit_gender" data-value="none">None</button>
                                                    <button type="button" class="btn btn-none edit_gender" data-value="male">Male</button>
                                                    <button type="button" class="btn btn-none edit_gender" data-value="female">Female</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>About</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <textarea id="editor1" rows="15" name="send[content]" class="form-control new-editor ckeditor"><?php echo $bb_user_profile_data['about'];?></textarea>
                                                </div>                                                
                                            </div>
                                            <!-- row -->
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Facebook</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-facebook' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Twitter</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-twitter' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>ICQ</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-icq' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>AIM</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-aim' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Skype</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-skype' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Google Talk</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <input type='text' class='form-control edit-googletalk' />
                                                </div>                                                
                                            </div>
                                            <!-- row -->     
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <button type="button" class="btn  btn-primary btnSaveAccountDetails"><i class="fas fa-paper-plane"></i> Save changes</button>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                              
                                            
                                        </div>
                                       
                                        <div class="tab-pane fade" id="v-password" role="tabpanel" aria-labelledby="v-password-tab">

                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Two-step verification</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-primary  btn-none edit-two-step-verify " data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                        <span class="input-group-text">Receive verify pin number via email</span>
                                                        
                                                        </div>
                                                </div>                                                
                                            </div>
                                            <!-- row --> 
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Your current password</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                    <input type="password" class="form-control edit-current-password" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                    <button type="button" class="btn  btn-none btn_view_current_password" data-value="ho" data-checked="0" style=""><i class="fas fa-eye"></i></button>
                                                    </div>

                                                </div>                                                
                                            </div>
                                            <!-- row -->  
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>New password</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                    <input type="password" class="form-control edit-new-password" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                    <button type="button" class="btn  btn-none btn_view_new_password" data-value="ho" data-checked="0" style=""><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->  
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Confirm new password</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                    <input type="password" class="form-control edit-confirm-new-password" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                    <button type="button" class="btn  btn-none btn_view_confirm_new_password" data-value="ho" data-checked="0" style=""><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->  
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <button type="button" class="btn  btn-primary btnSaveTwoStepVerify"><i class="fas fa-paper-plane"></i> Save changes</button>
                                                </div>                                                
                                            </div>
                                            <!-- row -->  

                                            
                                        </div>
                                        <div class="tab-pane fade" id="v-privacy" role="tabpanel" aria-labelledby="v-privacy-tab">
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Privacy options</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-primary  btn-none edit-show-online-status" data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                        <span class="input-group-text">Show your online status</span>
                                                        
                                                        </div>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn  btn-primary btn-none edit-show-activities" data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                        <span class="input-group-text">Show your activities</span>
                                                        
                                                        </div>
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn  btn-primary btn-none edit-show-birthday" data-value="ho" data-checked="0" style=""><i class="fas fa-square"></i></button>
                                                        <span class="input-group-text">Show your birthday</span>
                                                        
                                                        </div>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                             
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Allow users to</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    
                                                    <!-- row -->
                                                    <div class='row margin-bottom-10'>
                                                        <div class='col-lg-4 col-md-4 col-sm-4 '>
                                                        <span>View your details on your profile page:</span>
                                                        </div>                                                
                                                        <div class='col-lg-8 col-md-8 col-sm-8 '>
                                                            <select class='form-control select2js select-view-detail-profile-page' style='width:100%;'>
                                                                <option value="1">All visitors</option>
                                                                <option value="2">Members only</option>
                                                                <option value="3">People you follow</option>
                                                                <option value="4">Nobody</option>
                                                            </select>
                                                        </div>                                                
                                                    </div>
                                                    <!-- row -->                                                      
                                                    <!-- row -->
                                                    <div class='row margin-bottom-10'>
                                                        <div class='col-lg-4 col-md-4 col-sm-4 '>
                                                        <span>Post messages on your profile page:</span>
                                                        </div>                                                
                                                        <div class='col-lg-8 col-md-8 col-sm-8 '>
                                                            <select class='form-control select2js select-post-message-profile-page' style='width:100%;'>
                                                                <option value="2">Members only</option>
                                                                <option value="3">People you follow</option>
                                                                <option value="4">Nobody</option>
                                                            </select>
                                                        </div>                                                
                                                    </div>
                                                    <!-- row -->                                                      
                                                    <!-- row -->
                                                    <div class='row margin-bottom-10'>
                                                        <div class='col-lg-4 col-md-4 col-sm-4 '>
                                                        <span>Start conversations with you:</span>
                                                        </div>                                                
                                                        <div class='col-lg-8 col-md-8 col-sm-8 '>
                                                            <select class='form-control select2js select-conversation' style='width:100%;'>
                                                                <option value="2">Members only</option>
                                                                <option value="3">People you follow</option>
                                                                <option value="4">Nobody</option>
                                                            </select>
                                                        </div>                                                
                                                    </div>
                                                    <!-- row -->                                                      
                                                                                                       
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                             
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <button type="button" class="btn  btn-primary btnSavePrivacy"><i class="fas fa-paper-plane"></i> Save changes</button>
                                                </div>                                                
                                            </div>
                                            <!-- row -->  

                                        </div>
                                        <div class="tab-pane fade" id="v-preferences" role="tabpanel" aria-labelledby="v-preferences-tab">
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                <span>Time zone:</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <select class='form-control select2js select-timezone' style='width:100%;'>
                                                    <option value="Pacific/Midway">(UTC-11:00) American Samoa</option>
                                                    <option value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
                                                    <option value="Pacific/Marquesas">(UTC-09:30) Marquesas Islands</option>
                                                    <option value="America/Anchorage">(UTC-09:00) Alaska</option>
                                                    <option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US &amp; Canada)</option>
                                                    <option value="America/Santa_Isabel">(UTC-08:00) Baja California</option>
                                                    <option value="America/Tijuana">(UTC-08:00) Tijuana</option>
                                                    <option value="America/Denver">(UTC-07:00) Mountain Time (US &amp; Canada)</option>
                                                    <option value="America/Chihuahua">(UTC-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                    <option value="America/Phoenix">(UTC-07:00) Arizona</option>
                                                    <option value="America/Chicago">(UTC-06:00) Central Time (US &amp; Canada)</option>
                                                    <option value="America/Belize">(UTC-06:00) Saskatchewan, Central America</option>
                                                    <option value="America/Mexico_City">(UTC-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                    <option value="Pacific/Easter">(UTC-06:00) Easter Island</option>
                                                    <option value="America/New_York">(UTC-05:00) Eastern Time (US &amp; Canada)</option>
                                                    <option value="America/Havana">(UTC-05:00) Cuba</option>
                                                    <option value="America/Bogota">(UTC-05:00) Bogota, Lima, Quito</option>
                                                    <option value="America/Caracas">(UTC-04:30) Caracas</option>
                                                    <option value="America/Halifax">(UTC-04:00) Atlantic Time (Canada)</option>
                                                    <option value="America/Goose_Bay">(UTC-04:00) Atlantic Time (Goose Bay)</option>
                                                    <option value="America/Asuncion">(UTC-04:00) Asuncion</option>
                                                    <option value="America/Santiago">(UTC-04:00) Santiago</option>
                                                    <option value="America/Cuiaba">(UTC-04:00) Cuiaba</option>
                                                    <option value="America/La_Paz">(UTC-04:00) Georgetown, La Paz, Manaus, San Juan</option>
                                                    <option value="America/St_Johns">(UTC-03:30) Newfoundland</option>
                                                    <option value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
                                                    <option value="America/Argentina/San_Luis">(UTC-03:00) San Luis</option>
                                                    <option value="America/Argentina/Mendoza">(UTC-03:00) Argentina, Cayenne, Fortaleza</option>
                                                    <option value="Atlantic/Stanley">(UTC-03:00) Falkland Islands</option>
                                                    <option value="America/Godthab">(UTC-03:00) Greenland</option>
                                                    <option value="America/Montevideo">(UTC-03:00) Montevideo</option>
                                                    <option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
                                                    <option value="America/Miquelon">(UTC-03:00) Saint Pierre and Miquelon</option>
                                                    <option value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
                                                    <option value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
                                                    <option value="Atlantic/Azores">(UTC-01:00) Azores</option>
                                                    <option value="Europe/London">(UTC) Dublin, Edinburgh, Lisbon, London</option>
                                                    <option value="Africa/Casablanca">(UTC) Casablanca</option>
                                                    <option value="Atlantic/Reykjavik">(UTC) Monrovia, Reykjavik</option>
                                                    <option value="Europe/Amsterdam">(UTC+01:00) Central European Time</option>
                                                    <option value="Africa/Algiers">(UTC+01:00) West Central Africa</option>
                                                    <option value="Africa/Windhoek">(UTC+01:00) Windhoek</option>
                                                    <option value="Africa/Tunis">(UTC+01:00) Tunis</option>
                                                    <option value="Europe/Athens">(UTC+02:00) Eastern European Time</option>
                                                    <option value="Africa/Johannesburg">(UTC+02:00) South Africa Standard Time</option>
                                                    <option value="Europe/Kaliningrad">(UTC+02:00) Kaliningrad</option>
                                                    <option value="Asia/Amman">(UTC+02:00) Amman</option>
                                                    <option value="Asia/Beirut">(UTC+02:00) Beirut</option>
                                                    <option value="Africa/Cairo">(UTC+02:00) Cairo</option>
                                                    <option value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
                                                    <option value="Asia/Gaza">(UTC+02:00) Gaza</option>
                                                    <option value="Asia/Damascus">(UTC+02:00) Syria</option>
                                                    <option value="Europe/Moscow">(UTC+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                    <option value="Europe/Minsk">(UTC+03:00) Minsk</option>
                                                    <option value="Africa/Nairobi">(UTC+03:00) Nairobi, Baghdad, Kuwait, Qatar, Riyadh</option>
                                                    <option value="Asia/Tehran">(UTC+03:30) Tehran</option>
                                                    <option value="Asia/Dubai">(UTC+04:00) Abu Dhabi, Muscat, Tbilisi</option>
                                                    <option value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
                                                    <option value="Asia/Baku">(UTC+04:00) Baku</option>
                                                    <option value="Indian/Mauritius">(UTC+04:00) Mauritius</option>
                                                    <option value="Asia/Kabul">(UTC+04:30) Kabul</option>
                                                    <option value="Asia/Yekaterinburg">(UTC+05:00) Ekaterinburg</option>
                                                    <option value="Asia/Tashkent">(UTC+05:00) Tashkent, Karachi</option>
                                                    <option value="Asia/Kolkata">(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                    <option value="Asia/Kathmandu">(UTC+05:45) Kathmandu</option>
                                                    <option value="Asia/Novosibirsk">(UTC+06:00) Novosibirsk</option>
                                                    <option value="Asia/Dhaka">(UTC+06:00) Astana, Dhaka</option>
                                                    <option value="Asia/Almaty">(UTC+06:00) Almaty, Bishkek, Qyzylorda</option>
                                                    <option value="Asia/Yangon">(UTC+06:30) Yangon (Rangoon)</option>
                                                    <option value="Asia/Krasnoyarsk">(UTC+07:00) Krasnoyarsk</option>
                                                    <option value="Asia/Bangkok" selected="selected">(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
                                                    <option value="Asia/Irkutsk">(UTC+08:00) Irkutsk</option>
                                                    <option value="Asia/Hong_Kong">(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                    <option value="Asia/Singapore">(UTC+08:00) Kuala Lumpur, Singapore</option>
                                                    <option value="Australia/Perth">(UTC+08:00) Perth</option>
                                                    <option value="Asia/Yakutsk">(UTC+09:00) Yakutsk</option>
                                                    <option value="Asia/Tokyo">(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                                                    <option value="Asia/Seoul">(UTC+09:00) Seoul</option>
                                                    <option value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
                                                    <option value="Australia/Darwin">(UTC+09:30) Darwin</option>
                                                    <option value="Asia/Vladivostok">(UTC+10:00) Vladivostok</option>
                                                    <option value="Asia/Magadan">(UTC+10:00) Magadan</option>
                                                    <option value="Australia/Brisbane">(UTC+10:00) Brisbane, Guam</option>
                                                    <option value="Australia/Sydney">(UTC+10:00) Sydney, Melbourne, Hobart</option>
                                                    <option value="Pacific/Noumea">(UTC+11:00) Solomon Is., New Caledonia</option>
                                                    <option value="Pacific/Norfolk">(UTC+11:30) Norfolk Island</option>
                                                    <option value="Asia/Anadyr">(UTC+12:00) Anadyr, Kamchatka</option>
                                                    <option value="Pacific/Auckland">(UTC+12:00) Auckland, Wellington</option>
                                                    <option value="Pacific/Fiji">(UTC+12:00) Fiji</option>
                                                    <option value="Pacific/Chatham">(UTC+12:45) Chatham Islands</option>
                                                    <option value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
                                                    <option value="Pacific/Apia">(UTC+13:00) Apia, Samoa</option>
                                                    <option value="Pacific/Kiritimati">(UTC+14:00) Kiritimati</option>
                                                    </select>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                           
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <button type="button" class="btn  btn-primary btnSavePreferences"><i class="fas fa-paper-plane"></i> Save changes</button>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                          
                                        </div>
                                        <div class="tab-pane fade" id="v-signature" role="tabpanel" aria-labelledby="v-signature-tab">
                                            
                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    <span>Signature</span>
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <textarea id="editor2" rows="15" name="send[content]" class="form-control new-editor ckeditor"><?php echo $bb_user_profile_data['signature'];?></textarea>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                            

                                            <!-- row -->
                                            <div class='row margin-bottom-10'>
                                                <div class='col-lg-3 col-md-3 col-sm-3 '>
                                                    
                                                </div>                                                
                                                <div class='col-lg-9 col-md-9 col-sm-9 '>
                                                    <button type="button" class="btn  btn-primary btnSaveSign"><i class="fas fa-paper-plane"></i> Save changes</button>
                                                </div>                                                
                                            </div>
                                            <!-- row -->                                         
                                        </div>
                                        <div class="tab-pane fade" id="v-following" role="tabpanel" aria-labelledby="v-following-tab">

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        <table class='table table-hover'>
                                            <thead>
                                            <tr>
                                            <td>User</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>
                                        </thead>

                                        <tbody class='following_body'>
                                        <tr>
                                            <td>Content</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>                              
                                        </tbody>
                                        </table>

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="v-followers" role="tabpanel" aria-labelledby="v-followers-tab">

                                        <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                        <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                        <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                        </div>
                                        <table class='table table-hover'>
                                            <thead>
                                            <tr>
                                            <td>User</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>
                                        </thead>

                                        <tbody class='followed_body'>
                                        <tr>
                                            <td>Content</td>
                                            <td class="text-end">Date Time</td>
                                        </tr>                              
                                        </tbody>
                                        </table>

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                        </div>
                                      

                                        <?php if($canShowHidePaymentData==true){ ?>
                                            <div class="tab-pane fade" id="v-hidepayment" role="tabpanel" aria-labelledby="v-hidepayment-tab">

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>User</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>
                                            </thead>

                                            <tbody class='received_payments_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                                <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                                <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                                </div>
                                            </div>                                            

                                            <div class="tab-pane fade" id="v-hidesendpayment" role="tabpanel" aria-labelledby="v-hidesendpayment-tab">

                                            <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                            <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                            <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                            </div>
                                            <table class='table table-hover'>
                                                <thead>
                                                <tr>
                                                <td>User</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>
                                            </thead>

                                            <tbody class='send_payments_body'>
                                            <tr>
                                                <td>Content</td>
                                                <td class="text-end">Date Time</td>
                                            </tr>                              
                                            </tbody>
                                            </table>

                                                <div class="btn-group" style='float:right;' role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-none btnPrev"><?php echo get_text_by_lang('Previous','admin');?></button>
                                                <input type='number' class='form-control txtPageNumber_T' style='margin-left: -5px;width:90px;text-align:center;' value="1" />
                                                <button type="button" class="btn btn-none btnNext"><?php echo get_text_by_lang('Next','admin');?></button>
                                                </div>
                                            </div>



                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <!-- d-flex -->

              </div>
            </div>
            <?php BB_PHPCode::load('bottom_account_page');?>
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
  <script src="<?php echo SITE_URL; ?>public/ckeditor/ckeditor.js"></script>

  <script>

    pageData['bb_user_profile_mst']=<?php echo json_encode($bb_user_profile_mst);?>;
    pageData['bb_user_profile_data']=<?php echo json_encode($bb_user_profile_data);?>;
    pageData['attach_files']=[];
pageData['post_attach_files_data']=[];
pageData['upload_type']='avatar';

pageData['attach_files_upload_status']=0;

    CKEDITOR.replace( 'editor1' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
});   
    CKEDITOR.replace( 'editor2' ,{
  extraPlugins: 'wordcount,notification,texttransform,justify',
});   


function prepareAttachFilesData()
{
    masterDB['media_upload_status']=0;
    
    if(pageData['upload_type']=='avatar')
    {
        if(pageData['attach_files'].length==0)
        {
            $('.fileMedias').each(function(){
                $(this).val('');
            });
            showAlert('','Data not valid, try upload again!');return false;
        }
        console.log('avatar');
        var sendData={};

        sendData['file_path']=pageData['attach_files'][0];

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_avatar', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

            if(data['data'].indexOf('http'))
            {
                showAlert('',data['data']);return;
            }

            $('.wrap_show_avatar').html('<img src="'+data['data']+'" />');

        });          

    }
    else if(pageData['upload_type']=='cover')
    {
        if(pageData['attach_files'].length==0)
        {
            $('.fileMedias').each(function(){
                $(this).val('');
            });
            showAlert('','Data not valid, try upload again!');return false;
        }

        console.log('cover');
        var sendData={};

        sendData['file_path']=pageData['attach_files'][0];

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_profile_cover', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        if(data['data'].indexOf('http'))
        {
        showAlert('',data['data']);return;
        }

        $('.wrap_show_cover').html('<img src="'+data['data']+'" style="width:100%;" />');

        });   
    }


}

function attach_files_upload_check()
{
    if(parseInt(masterDB['media_upload_status'])!=2)
    {
        // console.log('Checking...');
        setTimeout(() => {
        attach_files_upload_check();
        }, 200);
    }
    else if(parseInt(masterDB['media_upload_status'])==2)
    {
        // Upload completed
        pageData['attach_files_upload_status']=2;
        pageData['attach_files']=masterDB['media_list'];
        prepareAttachFilesData();

        // $('.fileMedias').each(function(){
        //     // $(this).val('');
        // });

        // console.log(masterDB['media_list']);return false;
        return false;
    }

}

$(document).on('change','.fileMedias',function(){
pageData['upload_type']=$(this).attr('data-type');

masterDB['media_list']=[];
pageData['attach_files']=[];
// Uploading...
pageData['attach_files_upload_status']=1;

attach_files_upload_check();
// prepareMediaUpload();
});

function prepareProfileData()
{
    if(parseInt(pageData['bb_user_profile_data']['received_news_via_email'])==1)
    {
        $('.received_news_via_email').trigger('click');
    }
    if(parseInt(pageData['bb_user_profile_data']['received_activities_via_email'])==1)
    {
        $('.received_activities_via_email').trigger('click');
    }
    if(parseInt(pageData['bb_user_profile_data']['is_show_online_status'])==1)
    {
        $('.edit-show-online-status').trigger('click');
    }
    if(parseInt(pageData['bb_user_profile_data']['is_show_activites'])==1)
    {
        $('.edit-show-activities').trigger('click');
    }
    if(parseInt(pageData['bb_user_profile_data']['is_show_birthday'])==1)
    {
        $('.edit-show-birthday').trigger('click');
    }

    if(pageData['bb_user_profile_data']['timezone']!=null)
    {
        $('.select-timezone').val(pageData['bb_user_profile_data']['timezone']).trigger('change');
    }
    
    $('.select-view-detail-profile-page').val(pageData['bb_user_profile_data']['allow_view_profile']).trigger('change');
    $('.select-post-message-profile-page').val(pageData['bb_user_profile_data']['allow_other_write_on_profile']).trigger('change');
    $('.select-conversation').val(pageData['bb_user_profile_data']['allow_receive_message']).trigger('change');


    $('.edit-birthday').val(moment(pageData['bb_user_profile_data']['birthday'],'YYYY-MM-DD').format('MM/DD/YYYY'));
    $('.edit-location').val(pageData['bb_user_profile_data']['address']);
    $('.edit-website').val(pageData['bb_user_profile_data']['website']);
    $('.edit-occupation').val(pageData['bb_user_profile_data']['job']);
    $('.edit-facebook').val(pageData['bb_user_profile_data']['facebook']);
    $('.edit-twitter').val(pageData['bb_user_profile_data']['twitter']);
    $('.edit-icq').val(pageData['bb_user_profile_data']['icq']);
    $('.edit-aim').val(pageData['bb_user_profile_data']['aim']);
    $('.edit-skype').val(pageData['bb_user_profile_data']['skype']);

    if(pageData['bb_user_profile_data']['job']=='none')
    {
        $('.edit_gender[data-value="none"]').trigger('click');
    }
    if(pageData['bb_user_profile_data']['job']=='male')
    {
        $('.edit_gender[data-value="male"]').trigger('click');
    }
    if(pageData['bb_user_profile_data']['job']=='female')
    {
        $('.edit_gender[data-value="female"]').trigger('click');
    }



    setTimeout(() => {
        // CKEDITOR.instances.editor1.insertHtml(pageData['bb_user_profile_data']['about']);
    }, 500);

}

function prepare_show_reaction_received()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td>'+pageData['listThread'][i]['source_username']+' send a reaction '+pageData['listThread'][i]['reaction_text']+' to your post</td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.reactions_body').html(li);
}

function prepare_show_bookmarks()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td><a href="'+pageData['listThread'][i]['url']+'" target="_blank">'+pageData['listThread'][i]['url']+'</a></td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.bookmarks_body').html(li);
}

function prepare_show_following()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['username']+'.html" target="_blank">'+pageData['listThread'][i]['username']+'</a></td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.following_body').html(li);
}

function prepare_show_followers()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['username']+'.html" target="_blank">'+pageData['listThread'][i]['username']+'</a></td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.followed_body').html(li);
}

function prepare_show_hidebb_received_payment()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td>'+pageData['listThread'][i]['username']+' send '+pageData['listThread'][i]['item_cost']+' unit to you on thread <a href="'+SITE_URL+'t-'+pageData['listThread'][i]['thread_friendly_url']+'">'+pageData['listThread'][i]['thread_title']+'</a></td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.received_payments_body').html(li);
}

function prepare_show_hidebb_send_payment()
{
    var total=pageData['listThread'].length;

    var li='';

    for (var i = 0; i < total; i++) {
        li+='<tr>';
        li+='<td>You have been send '+pageData['listThread'][i]['item_cost']+' unit to '+pageData['listThread'][i]['username']+' on thread <a href="'+SITE_URL+'t-'+pageData['listThread'][i]['thread_friendly_url']+'">'+pageData['listThread'][i]['thread_title']+'</a></td>';
        li+='<td class="text-end">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD hh:mm:ss').format('MMM DD, YYYY HH:mm:ss')+'</td>';
        li+='</tr>  ';
    }

    $('.send_payments_body').html(li);
}


    $(document).ready(function(){
      $('.select2js').select2({
       
      });

      prepareProfileData();
    });


    $(document).on('click','#v-reactions-received-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_reaction_received', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
        prepare_show_reaction_received();
        });           
    });  



    $(document).on('click','#v-hidepayment-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_hidebb_received_payment', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
        prepare_show_hidebb_received_payment();
        });           
        
    });  
    $(document).on('click','#v-hidesendpayment-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_hidebb_send_payment', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
            prepare_show_hidebb_send_payment();
        });           
        
    });  

    $(document).on('click','#v-bookmarks-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_bookmark', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
        prepare_show_bookmarks();
        });           
    });  

    $(document).on('click','#v-following-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_following', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
        prepare_show_following();
        });           
    });  

    $(document).on('click','#v-followers-tab',function(){

        var sendData={};

        sendData['page_no']=1;

        sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_get_list_followed', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');

        pageData['listThread']=data['data'];
        prepare_show_followers();
        });           
    });  

    $(document).on('click','.received_news_via_email',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    });  
    $(document).on('click','.edit-two-step-verify',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    });  
    $(document).on('click','.edit-show-online-status',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    });  
    $(document).on('click','.edit-show-activities',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    });  
    $(document).on('click','.edit-show-birthday',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    });  
    $(document).on('click','.received_activities_via_email',function(){
        if($(this).hasClass('btn-success')==true)
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-none').html("<i class='fas fa-square'></i>").attr('data-checked','0');
        }
        else
        {
            $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success').html("<i class='fas fa-check-square'></i>").attr('data-checked','1');
        }
        
    }); 

    $(document).on('click','.edit_gender',function(){

        $('.edit_gender').removeClass('btn-success').addClass('btn-none');

        $(this).removeClass('btn-none').removeClass('btn-success').addClass('btn-success');
        
    });  

    $(document).on('click','.btnSaveAccountDetails',function(){

        var sendData={};

        sendData['email']=$('.edit-email').val().trim();

        sendData['received_news_via_email']='0';

        if($('.received_news_via_email').hasClass('btn-success'))
        {
            sendData['received_news_via_email']='1';
        }

        sendData['received_activities_via_email']='0';

        if($('.received_activities_via_email').hasClass('btn-success'))
        {
            sendData['received_activities_via_email']='1';
        }

        sendData['birthday']=$('.edit-birthday').val().trim();
        sendData['address']=$('.edit-location').val().trim();
        sendData['website']=$('.edit-website').val().trim();
        sendData['job']=$('.edit-occupation').val().trim();
        sendData['gender']='none';

        $('.edit_gender').each(function(){
            if($(this).hasClass('btn-success'))
            {
                sendData['gender']=$(this).attr('data-value');
            }
        });

        // sendData['about']=$('#editor1').val().trim();
        sendData['about']=CKEDITOR.instances.editor1.getData();
        sendData['facebook']=$('.edit-facebook').val().trim();
        sendData['twitter']=$('.edit-twitter').val().trim();
        sendData['icq']=$('.edit-icq').val().trim();
        sendData['aim']=$('.edit-aim').val().trim();
        sendData['skype']=$('.edit-skype').val().trim();
        sendData['google_talk']=$('.edit-googletalk').val().trim();

        // sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_info', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');
            // alert('Done!');
            showAlertOK('','Done!');
        
        });           
    });  

    $(document).on('click','.btnSavePrivacy',function(){

        var sendData={};

        sendData['allow_view_profile']=$('.select-view-detail-profile-page > option:selected').val();
        sendData['allow_other_write_on_profile']=$('.select-post-message-profile-page > option:selected').val();
        sendData['allow_receive_message']=$('.select-conversation > option:selected').val();

        sendData['is_show_online_status']='0';
        sendData['is_show_activites']='0';
        sendData['is_show_birthday']='0';

        if($('.edit-show-online-status').hasClass('btn-success'))
        {
            sendData['is_show_online_status']='1';
        }
        if($('.edit-show-activities').hasClass('btn-success'))
        {
            sendData['is_show_activites']='1';
        }
        if($('.edit-show-birthday').hasClass('btn-success'))
        {
            sendData['is_show_birthday']='1';
        }


        // sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_privacy', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');
            // alert('Done!');
            showAlertOK('','Done!');
        
        });           
    });  

    $(document).on('click','.btnSavePreferences',function(){

        var sendData={};

        sendData['timezone']=$('.select-timezone > option:selected').val();

        // sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_preferences', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');
            // alert('Done!');
            showAlertOK('','Done!');
        
        });           
    });  

    $(document).on('click','.btnSaveSign',function(){

        var sendData={};

        sendData['signature']=CKEDITOR.instances.editor2.getData();

        // sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_signature', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');
            // alert('Done!');
            showAlertOK('','Done!');
        
        });           
    });  


    $(document).on('click','.btnSaveTwoStepVerify',function(){

        var sendData={};

        sendData['current_password']=$('.edit-current-password').val().trim();
        sendData['new_password']=$('.edit-new-password').val().trim();
        sendData['confirm_new_password']=$('.edit-confirm-new-password').val().trim();

        sendData['is_two_step']='0';

        if($('.edit-two-step-verify').hasClass('btn-success'))
        {
            sendData['is_two_step']='1';
        }

        if(sendData['current_password'].length > 0)
        {
            if(sendData['new_password'].length==0 || sendData['confirm_new_password'].length==0)
            {
                sendData['current_password']='';
            }

        }

        if(sendData['new_password']!=sendData['confirm_new_password'])
        {
            showAlert('','Your confirm new password not same as New Password');return false;
        }
        
        if(sendData['new_password']==sendData['confirm_new_password'] && sendData['current_password'].length==0)
        {
            showAlert('','Type your current password');return false;
        }
        
        // sendData['type']='1';

        postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_account_save_twostep', sendData).then(data => {
        // console.log(data); // JSON data parsed by `data.json()` call
        // $('#modalSearch').modal('hide');
            showAlertOK('','Done!');
        
        });           
    });  


    $(document).on('click','.btn_view_current_password',function(){
        if($('.edit-current-password').attr('type')=='password')
        {
            $('.edit-current-password').attr('type','text');
        }
        else
        {
            $('.edit-current-password').attr('type','password');
        }
              
    });  
    $(document).on('click','.btn_view_new_password',function(){
        if($('.edit-new-password').attr('type')=='password')
        {
            $('.edit-new-password').attr('type','text');
        }
        else
        {
            $('.edit-new-password').attr('type','password');
        }
              
    });  
    $(document).on('click','.btn_view_confirm_new_password',function(){
        if($('.edit-confirm-new-password').attr('type')=='password')
        {
            $('.edit-confirm-new-password').attr('type','text');
        }
        else
        {
            $('.edit-confirm-new-password').attr('type','password');
        }
              
    });  


  </script>
  