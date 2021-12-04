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

