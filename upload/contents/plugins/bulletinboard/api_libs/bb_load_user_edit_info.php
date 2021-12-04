<?php


function bb_load_user_edit_info()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $user_id=addslashes(getPost('user_id',''));
   
    $queryStr="select a.*,b.username,b.fullname,b.email,b.email,b.group_c,a.last_user_ip_address,a.last_user_user_agent,ifnull(banned.username,'') as banned ";
    $queryStr.=" from bb_user_data as a";
    $queryStr.=" join user_mst as b ON a.user_id=b.user_id";
    $queryStr.=" left join (select username from bb_banned_user_data where data_method='username') banned ON b.username=banned.username ";
    $queryStr.="  WHERE a.user_id='".$user_id."' ";



    $db=new Database(); 
    $result=$db->query($queryStr);

    $result[0]['list_ranks']=$db->query("select * from bb_users_rank_data where user_id='".$user_id."'");


    echo responseData($result,'no');die();
}
