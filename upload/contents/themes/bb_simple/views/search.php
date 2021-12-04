

  <!-- modal -->
  <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Keywords:</label>
              <input type="text" class="form-control search-keywords" value="<?php echo $keywords;?>" id="recipient-name">
            </div>            
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Username:</label>
              <input type="text" class="form-control search-username" value="" id="recipient-name">
            </div>
            
            <div class='row'>
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">Start date:</label>
                <input type="text" class="form-control search-start_date datepicker" id="recipient-name">          
              </div>        
              <div class='col-lg-6 col-md-6 '>
                <label for="recipient-name" class="col-form-label">End date:</label>
                <input type="text" class="form-control search-end_date datepicker" id="recipient-name">          
              </div>        
            </div>
            <div class='row'>
              <div class='col-lg-12 '>
                <label for="recipient-name" class="col-form-label">Prefix:</label>
                <select class='form-control search-prefix select2js' style='width:100%;'>

                <option value="all">ALL</option>
                  <?php 
                    $li='';

                    $total=count(Configs::$_['list_post_prefix']);

                    for ($i=0; $i < $total; $i++) { 
                      $li.='<option value="'.Configs::$_['list_post_prefix'][$i]['prefix_id'].'">'.Configs::$_['list_post_prefix'][$i]['title'].'</option>';
                    }

                    echo $li;

                  ?>
                </select>
              </div>        
                 
            </div>
          </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSearch"><i class='fas fa-search'></i> Search</button>
          <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal"><i class='fas fa-times'></i> Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->

  <div class='container mt-20px pl-0px pr-0px'>
    
    <main>
      <!-- row -->
      <div class='row'>
      <!-- left -->
      <div class='col-lg-9 col-md-9 '>

      <?php BB_PHPCode::load('top_search_page');?>
        <!-- List forum threads -->
        <!-- row -->
        <div class='row'>
          
          <!-- left -->
          <div class='col-lg-12 '>
            <div class="card text-dark bg-light mb-3">
              <div class="card-header card-header-forum">
                <span>Search results</span>

                <?php if(isLogined()){ ?>
                <button type='button' class='btn btn-sm btn-none btn-filter float-right'><i class='fas fa-filter'></i> Filter</button>
                <?php } ?>
              </div>
              <div class="card-body">

                <!-- row -->
                <div class='row'>
                  <div class='col-lg-12'>

                        <div class="btn-group mb-10px float-right mb-10px" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-none btnPrev" style=""><i class='fas fa-angle-left'></i></button>
                          <input type="number" class="form-control txtPageNumber_T" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                          <button type="button" class="btn btn-none btnNext" style=""><i class='fas fa-angle-right'></i></button>
                        </div>

                    <table class='table table-hover' role="table">
                      <thead role="rowgroup">
                        <tr role="row">
                          <th role="columnheader">Title</th>
                          <th role="columnheader" class='text-end'>Replies</th>
                          <th role="columnheader" class='text-end'>Views</th>
                          <th role="columnheader" class='text-end'>Latest Post</th>
                        </tr>
                      </thead>
                      <tbody class='list_thread' role="rowgroup">
                        
                     
                      </tbody>
                    </table>

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-none btnPrev" style=""><i class='fas fa-angle-left'></i></button>
                          <input type="number" class="form-control txtPageNumber_B" style="margin-left: -5px;width:70px;text-align:center;" value="1">
                          <button type="button" class="btn btn-none btnNext" style=""><i class='fas fa-angle-right'></i></button>
                        </div>
                  </div>                    
                </div>
                <!-- row -->

              </div>
            </div>
            
            <?php BB_PHPCode::load('bottom_search_page');?>
          </div>
          <!-- left -->
          
          
        </div>
        <!-- row -->

      
      </div>
      <!-- right -->
    
  
  <script>

  pageData['keywords']='<?php echo $keywords;?>';
  pageData['username']='<?php echo getGet('username');?>';
  pageData['listThread']=<?php echo json_encode($listThread);?>;

  pageData['limitShow']=<?php echo Configs::$_['bb_max_number_threads_show'];?>;


    $(document).ready(function(){
      $('.select2js').select2({
      dropdownParent: $("#modalFilter")
    });

    $('.datepicker').datepicker({
          autoclose: true,
          format: 'mm/dd/yyyy',
        });

        $('.search-start_date').val(moment().add('months',-6).format('MM/DD/YYYY'));
        $('.search-end_date').val(moment().format('MM/DD/YYYY'));

        if(pageData['username'].length > 1)
        {
          $('.search-username').val(pageData['username']);
          $('.btnSearch').trigger('click');
        }
        else
        {
          prepare_show_list_thread();
        }

    });


    $(document).on('click','.btn-filter',function(){
      $('#modalFilter').modal('show');
  });

  function prepare_show_list_thread()
  {
    var li='';

    $('.list_thread').html('');

    var total=pageData['listThread'].length;

    for (let i = 0; i < total; i++) {
      li+='<tr role="row">';
      li+='<td role="cell" >';
      li+='<span style="display: block;font-size: 12pt;"><a href="'+SITE_URL+'t-'+pageData['listThread'][i]['friendly_url']+'"><span class="thread-prefix" style="background-color:'+pageData['listThread'][i]['prefix_bg_color']+'">'+pageData['listThread'][i]['prefix_title']+'</span> '+pageData['listThread'][i]['title']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;"><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['author']+'.html">'+pageData['listThread'][i]['author']+'</a></span>';
      li+='<span style="font-size: 10pt;margin-right:10px;">'+moment(pageData['listThread'][i]['ent_dt'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY')+'</span>';

      if(parseInt(pageData['limitShow']) < total)
      {
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';
        li+='<span class="badge bg-secondary" style="font-size: 7pt;margin-right:3px;"><a href="fgfg" style="color: #ffffff;">2</a></span>';

      }

      li+='</td>';
      li+='<td role="cell" class="text-end"><span style="font-size: 10pt;">'+pageData['listThread'][i]['total_replies']+'</span></td>';
      li+='<td role="cell" class="text-end"><span style="font-size: 10pt;">'+pageData['listThread'][i]['views']+'</span></td>';
      li+='<td role="cell" class="text-end">';
      li+='<span style="display: block;font-size: 11pt;"><a href="'+SITE_URL+'profile-'+pageData['listThread'][i]['last_username_reply']+'.html">'+pageData['listThread'][i]['last_username_reply']+'</a></span>';
      li+='<span style="display: block;font-size: 10pt;">'+moment(pageData['listThread'][i]['last_repy_time'],'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY')+'</span>';
      li+='</td>';
      li+='</tr>';
    }


    $('.list_thread').html(li);
  }
  

$(document).on('change','.txtPageNumber_B',function(){

  $('.txtPageNumber_T').val($(this).val().trim());

});

$(document).on('change','.txtPageNumber_T',function(){

  $('.txtPageNumber_B').val($(this).val().trim());

});

$(document).on('click','.btnPrev',function(){

var no=$('.txtPageNumber_B').val();

if(no.length==0)
{
  showAlert('','Page number not valid.');
  return false;
}

pageData['page_no']=no;

if(parseInt(pageData['page_no'])<=0)
{
  pageData['page_no']=1;
}

var sendData={};

sendData['page_no']=parseInt(pageData['page_no'])-1;
$('.txtPageNumber_B').val(sendData['page_no']);
$('.txtPageNumber_T').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

if(pageData['start_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

if(pageData['end_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});

  $(document).on('keyup','.txtPageNumber_T',function(e){

    if (e.key != "Enter") {
      return false;
    }

var no=$('.txtPageNumber_T').val();

if(no.length==0)
{
  showAlert('','Page number not valid.');
  return false;
}

pageData['page_no']=no;

if(parseInt(pageData['page_no'])<=0)
{
  pageData['page_no']=1;
}

$('.txtPageNumber_B').val(no);

var sendData={};

sendData['page_no']=parseInt(pageData['page_no']);
// $('.txtPageNumber').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

if(pageData['start_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

if(pageData['end_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});

  $(document).on('keyup','.txtPageNumber_B',function(e){

    if (e.key != "Enter") {
      return false;
    }

var no=$('.txtPageNumber_T').val();

if(no.length==0)
{
  showAlert('','Page number not valid.');
  return false;
}

pageData['page_no']=no;

if(parseInt(pageData['page_no'])<=0)
{
  pageData['page_no']=1;
}

$('.txtPageNumber_T').val(no);

var sendData={};

sendData['page_no']=parseInt(pageData['page_no']);
// $('.txtPageNumber').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

if(pageData['start_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

if(pageData['end_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   

});


$(document).on('click','.btnNext',function(){

var no=$('.txtPageNumber_B').val();

if(no.length==0)
{
  showAlert('','Page number not valid.');
  return false;
}

pageData['page_no']=no;

if(parseInt(pageData['page_no'])<=0)
{
  pageData['page_no']=1;
}

var sendData={};

sendData['page_no']=parseInt(pageData['page_no'])+1;

$('.txtPageNumber_B').val(sendData['page_no']);
$('.txtPageNumber_T').val(sendData['page_no']);

sendData['type']='1';

pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

if(pageData['start_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

if(pageData['end_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  // $('#modalSearch').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   
});
   

$(document).on('click','.btnSearch',function(){

var no=$('.txtPageNumber_B').val();

if(no.length==0)
{
  showAlert('','Page number not valid.');
  return false;
}

pageData['page_no']=no;

if(parseInt(pageData['page_no'])<=0)
{
  pageData['page_no']=1;
}

var sendData={};

sendData['page_no']=pageData['page_no'];

$('.txtPageNumber_B').val(sendData['page_no']);

sendData['type']='1';

pageData['username']=$('.search-username').val().trim();
pageData['keywords']=$('.search-keywords').val().trim();
pageData['start_date']=moment($('.search-start_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['end_date']=moment($('.search-end_date').val().trim(),'MM/DD/YYYY').format('YYYY-MM-DD');
pageData['prefix']=$('.search-prefix > option:selected').val().trim();

if(pageData['start_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

if(pageData['end_date'].length==0)
{
  showAlert('','From date not valid!');
  return false;
}

sendData['username']=pageData['username'];
sendData['keywords']=pageData['keywords'];
sendData['start_date']=pageData['start_date'];
sendData['end_date']=pageData['end_date'];
sendData['prefix']=pageData['prefix'];

postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_get_list_thread', sendData).then(data => {
  // console.log(data); // JSON data parsed by `data.json()` call
  $('#modalFilter').modal('hide');

  pageData['listThread']=data['data'];
  prepare_show_list_thread();
});   
});

  </script>
