
<?php
if(!isset(Configs::$_['user_permissions']['BB30024']))
{
  redirect_to(SITE_URL.'admin/notfound');
}	

$db=new Database();  


$listForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
$listSubForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");
// $listPermissions=$db->query("select * from permissions_mst where LEFT(permission_c,2)='BB'");
$listUserGroups=$db->query("select * from user_group_mst order by title asc");

$listForums=bb_genListNestedForum($listForums,$listSubForums);

$listPostPrefixs=$db->query("select * from bb_post_prefix_data order by title asc");


?>

<style>
.tab-content>.active {
    display: block;
    /* padding: 0px; */
    /* margin-left: 10px; */
}


#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */


</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo get_text_by_lang('Clean Data','admin');?></h1>
          </div><!-- /.col -->
      
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-md-12 col-sm-12">

		  <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <!-- <h3 class="card-title p-3">Tabs</h3> -->
                <ul class="nav nav-pills  p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><?php echo get_text_by_lang('Threads','admin');?></a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab"><?php echo get_text_by_lang('Messages','admin');?></a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab"><?php echo get_text_by_lang('Attach Files','admin');?></a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab"><?php echo get_text_by_lang('Activities','admin');?></a></li>
                  
                  
                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">

					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Start date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_start_date" class="form-control thread_start_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('End date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_end_date" class="form-control thread_end_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Username','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_username" class="form-control thread_username setting-page1 " />
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6">
								<span><?php echo get_text_by_lang('User group','admin');?></span>
								</div>
								<div class="col-lg-6">
									<select name="general[thread_group_id]" id="thread_group_id" class="form-control thread_group_id setting-page1 select2js">
									</select>								
								</div>

							</div>
											
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6">
								<span><?php echo get_text_by_lang('Forum','admin');?></span>
								</div>
								<div class="col-lg-6">
									<select name="general[thread_forum_id]" id="thread_forum_id" class="form-control thread_forum_id setting-page1 select2js">
									</select>								
								</div>

							</div>

							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-8">
								<span><?php echo get_text_by_lang('Post Prefix','admin');?></span>
								</div>
								<div class="col-lg-4">
									<select name="general[thread_prefix_id]" id="thread_prefix_id" class="form-control thread_prefix_id setting-page1 select2js">
									</select>								
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Min views','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_min_views" value="0" class="form-control thread_min_views setting-page1 " />
								</div>

							</div>


							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Max views','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_max_views" value="10000000000"  class="form-control thread_max_views setting-page1 " />
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Replies small than','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="thread_total_replies" value="10000"  class="form-control thread_total_replies setting-page1 " />
								</div>

							</div>



					<p>
					<button type="button" name="btnSave" class="btn btn-info btnSavePage1" style='float:right;'><i class='fas fa-broom'></i> <?php echo get_text_by_lang('Start clean data','admin');?></button>
					</p>
                  </div>
                  <!-- /.tab-pane -->
               
                  <div class="tab-pane" id="tab_3">
				  <div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Start date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="message_start_date" class="form-control message_start_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('End date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="message_end_date" class="form-control message_end_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Username','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="message_username" class="form-control message_username setting-page1 " />
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6">
								<span><?php echo get_text_by_lang('User group','admin');?></span>
								</div>
								<div class="col-lg-6">
									<select name="general[mess_group_id]" id="mess_group_id" class="form-control mess_group_id setting-page1 select2js">
									</select>								
								</div>

							</div>
							
				
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('Is readed','admin');?> ?</span>
								</div>
								<div class="col-lg-2">
									<select name="general[message_is_readed]" id="message_is_readed" class="form-control message_is_readed setting-page1 select2js">
									<option value="0"><?php echo get_text_by_lang('No','admin');?></option>
									<option value="1" ><?php echo get_text_by_lang('Yes','admin');?></option>
									</select>								
								</div>

							</div>
						


						<p>
						<button type="button" name="btnSave" class="btn btn-info btnSavePage3" style='float:right;'><i class='fas fa-broom'></i> <?php echo get_text_by_lang('Start clean data','admin');?></button>
						</p>
                  </div>
                  <!-- /.tab-pane -->
                  
               
                  <div class="tab-pane" id="tab_4">
				  <div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Start date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="attachfiles_start_date" class="form-control attachfiles_start_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('End date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="attachfiles_end_date" class="form-control attachfiles_end_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Username','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="attachfiles_username" class="form-control attachfiles_username setting-page1 " />
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6">
								<span><?php echo get_text_by_lang('User group','admin');?></span>
								</div>
								<div class="col-lg-6">
									<select name="general[attachfiles_group_id]" id="attachfiles_group_id" class="form-control attachfiles_group_id setting-page1 select2js">
									</select>								
								</div>

							</div>
							
				
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('File type','admin');?></span>
								</div>
								<div class="col-lg-2">
								<input type='text' name="" id="attachfiles_file_type" class="form-control attachfiles_file_type setting-page1 " />							
								</div>
							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('File size (KB) min','admin');?></span>
								</div>
								<div class="col-lg-2">
								<input type='text' name="" id="attachfiles_file_size_min" class="form-control attachfiles_file_size_min setting-page1 " />							
								</div>
							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('File size (KB) max','admin');?></span>
								</div>
								<div class="col-lg-2">
								<input type='text' name="" id="attachfiles_file_size_max" class="form-control attachfiles_file_size_max setting-page1 " />							
								</div>
							</div>
				
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-10">
								<span><?php echo get_text_by_lang('Total downloads','admin');?></span>
								</div>
								<div class="col-lg-2">
								<input type='text' name="" id="attachfiles_total_download" class="form-control attachfiles_total_download setting-page1 " />							
								</div>

							</div>
						


						<p>
						<button type="button" name="btnSave" class="btn btn-info btnSavePage4" style='float:right;'><i class='fas fa-broom'></i> <?php echo get_text_by_lang('Start clean data','admin');?></button>
						</p>
                  </div>
                  <!-- /.tab-pane -->
               
				  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_5">
				  <div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Start date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="activities_start_date" class="form-control activities_start_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('End date','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="activities_end_date" class="form-control activities_end_date setting-page1 " />
								</div>

							</div>
					
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-9">
								<span><?php echo get_text_by_lang('Username','admin');?></span>
								</div>
								<div class="col-lg-3">
									<input type='text' name="" id="activities_username" class="form-control activities_username setting-page1 " />
								</div>

							</div>
							<div class="row" style="margin-top:10px;margin-bottom:10px;">
								<div class="col-lg-6">
								<span><?php echo get_text_by_lang('User group','admin');?></span>
								</div>
								<div class="col-lg-6">
									<select name="general[activities_group_id]" id="activities_group_id" class="form-control activities_group_id setting-page1 select2js">
									</select>								
								</div>

							</div>
						

						<p>
						<button type="button" name="btnSave" class="btn btn-info btnSavePage5" style='float:right;'><i class='fas fa-broom'></i> <?php echo get_text_by_lang('Start clean data','admin');?></button>
						</p>
                  </div>
                  <!-- /.tab-pane -->
                  



                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
   
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>

	pageData['listUserGroups']=<?php echo json_encode($listUserGroups);?>;
	pageData['listForums']=<?php echo json_encode($listForums);?>;
	pageData['listPostPrefixs']=<?php echo json_encode($listPostPrefixs);?>;

function prepareData()
{
	var total=pageData['listUserGroups'].length;
	var li='';

	li+='<option value="all">ALL</option>';
	for (let i = 0; i < total; i++) {
		li+='<option value="'+pageData['listUserGroups'][i]['group_c']+'">'+pageData['listUserGroups'][i]['title']+'</option>';
	}

	$('.thread_group_id').html(li).trigger('change');
	$('.mess_group_id').html(li).trigger('change');
	$('.attachfiles_group_id').html(li).trigger('change');
	$('.activities_group_id').html(li).trigger('change');

	li='';

	total=pageData['listForums'].length;

	li+='<option value="all">ALL</option>';
	for (let i = 0; i < total; i++) {
		li+='<option value="'+pageData['listForums'][i]['forum_id']+'">'+pageData['listForums'][i]['title']+'</option>';
	}

	$('.thread_forum_id').html(li).trigger('change');

	li='';

	total=pageData['listPostPrefixs'].length;

	li+='<option value="all">ALL</option>';
	for (let i = 0; i < total; i++) {
		li+='<option value="'+pageData['listPostPrefixs'][i]['prefix_id']+'">'+pageData['listPostPrefixs'][i]['title']+'</option>';
	}

	$('.thread_prefix_id').html(li).trigger('change');

}
$(document).ready(function(){

	prepareData();
	// prepareSettingData();
	$('.select2js').select2();

	$('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

      $('.thread_start_date').val(moment().format('MM/DD/YYYY'));
      $('.thread_end_date ').val(moment().add('days',30).format('MM/DD/YYYY'));

      $('.message_start_date').val(moment().format('MM/DD/YYYY'));
      $('.message_end_date ').val(moment().add('days',30).format('MM/DD/YYYY'));

      $('.attachfiles_start_date').val(moment().format('MM/DD/YYYY'));
      $('.attachfiles_end_date ').val(moment().add('days',30).format('MM/DD/YYYY'));

      $('.activities_start_date').val(moment().format('MM/DD/YYYY'));
      $('.activities_end_date ').val(moment().add('days',30).format('MM/DD/YYYY'));

});

function setSelect(id,value)
{
	$('#'+id+' option').each(function(){
		var thisVal=$(this).val();

		if(thisVal==value)
		{
			$(this).attr('selected',true);
		}


	});
}

//btnSavePage1
$(document).on('click','.btnSavePage1',function(){
    var sendData={};

	var jsonData={};
    jsonData['thread_start_date']=$('.thread_start_date').val();
    jsonData['thread_end_date']=$('.thread_end_date').val();
    jsonData['thread_username']=$('.thread_username').val();
    jsonData['thread_group_id']=$('.thread_group_id > option:selected').val();
    jsonData['thread_forum_id']=$('.thread_forum_id > option:selected').val();
    jsonData['thread_prefix_id']=$('.thread_prefix_id > option:selected').val();
    jsonData['thread_min_views']=$('.thread_min_views').val();
    jsonData['thread_max_views']=$('.thread_max_views').val();
    jsonData['thread_total_replies']=$('.thread_total_replies').val();
   
    jsonData['type']='1';

	if(jsonData['thread_start_date'].length==0)
	{
		showAlert('','Start date not allow blank!');
		return;
	}

	if(jsonData['thread_end_date'].length==0)
	{
		showAlert('','End date not allow blank!');
		return;
	}

	jsonData['thread_start_date']=moment(jsonData['thread_start_date'],'MM/DD/YYYY').format('YYYY-MM-DD');
    jsonData['thread_end_date']=moment(jsonData['thread_end_date'],'MM/DD/YYYY').format('YYYY-MM-DD');

    // sendData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_clean_thread_data', jsonData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage2',function(){
    var sendData={};

	var jsonData={};
    jsonData['site_title']=$('.site_title').val();
    jsonData['site_description']=$('.site_description').val();
    jsonData['site_keywords']=$('.site_keywords').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage3',function(){
    var sendData={};

	var jsonData={};
    jsonData['default_adminpage_url']=$('.default_adminpage_url').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage7',function(){
    var sendData={};

	var jsonData={};
    jsonData['post_back_when_add_new_user']=$('.post_back_when_add_new_user').val();
    jsonData['post_back_when_change_user_group']=$('.post_back_when_change_user_group').val();
    jsonData['post_back_when_change_user_level']=$('.post_back_when_change_user_level').val();
    jsonData['post_back_when_change_post_status']=$('.post_back_when_change_post_status').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnSavePage4',function(){
    var sendData={};

	var jsonData={};
    jsonData['default_page']=$('.default_page').val();
    jsonData['email_smtp']=$('.email_smtp > option:selected').val();
    jsonData['smtp_host']=$('.smtp_host').val();
    jsonData['smtp_username']=$('.smtp_username').val();
    jsonData['smtp_password']=$('.smtp_password').val();
    jsonData['smtp_port']=$('.smtp_port').val();
    jsonData['email_sender_name']=$('.email_sender_name').val();
    jsonData['email_sender']=$('.email_sender').val();
    
    sendData['type']='1';
    sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'system_setting_update', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnClearSystemCache',function(){
    var sendData={};

    sendData['type']='1';

    postData(API_URL+'system_cache_clear', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnClearViewsData3Month',function(){
    var sendData={};

    sendData['type']='1';

    postData(API_URL+'clear_view_data_last_months', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnClearActivitiesData1Month',function(){
    var sendData={};

    sendData['type']='1';

    postData(API_URL+'clear_activities_data_last_months', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      showAlertOK('','Done!');
    });        
});

$(document).on('click','.btnClearShortUrlNotWorking',function(){
    var sendData={};

    sendData['type']='1';

    postData(API_URL+'clear_shorturls_not_working', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      showAlertOK('','Done!');
    });        
});


$(document).on('click','.btnUpdateSystem',function(){
    var sendData={};

    sendData['type']='1';

    postData(API_URL+'update_system', sendData).then(data => {
      console.log(data); // JSON data parsed by `data.json()` call
      showAlertOK('','Done!');
    });        
});



</script>