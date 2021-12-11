// btn-refresh-captcha
$(document).on('click','.btn-refresh-captcha',function(){

    var jsonData={};
    
    jsonData['type']='1';
    // sendData['save_data']=JSON.stringify(jsonData);

    postData(API_URL+'plugin_api?plugin=bulletinboard&func=frontend_api&api_nm=bb_refresh_captcha', jsonData).then(data => {
      // console.log(data); // JSON data parsed by `data.json()` call
      
      $('.wrap_catpcha_str').html(data['data']);
      
    });      
});


function bb_render_user_group_title(userData={})
{
  var result=userData['username'];
  var groupData=pageData['user_group_mst'][userData['group_c']];

  if(groupData['left_str']!=null && groupData['left_str'].length > 3)
  {
    result=groupData['left_str']+userData['username']+groupData['right_str'];
  }

  return result;
}