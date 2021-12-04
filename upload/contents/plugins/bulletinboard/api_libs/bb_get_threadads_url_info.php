<?php


function bb_get_threadads_url_info()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $url=addslashes(getPost('url',''));
  
    $thread_id='';

    if(!preg_match('/t\-.*?\_(\d+)\.html/i',$url,$match))
    {
        // redirect to 404 page
        return 'NG';
    }

    $thread_id=$match[1];

    $queryStr='';


    $queryStr.=" select * from bb_threads_data where thread_id='".$thread_id."'";

    $db=new Database(); 
    $result=$db->query($queryStr);


    echo responseData($result,'no');die();
}
