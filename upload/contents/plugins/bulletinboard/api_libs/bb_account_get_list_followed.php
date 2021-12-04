<?php

function bb_account_get_list_followed()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }
    
    $limit=addslashes(getPost('limit','100'));
    $page_no=addslashes(getPost('page_no','1'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    $offset=(int)$page_no*100;

    $queryStr='';

    $queryStr=" select a.*,b.username,b.fullname,b.avatar,c.title as group_title";
    $queryStr.=" from bb_user_follow_data as a";
    $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
    $queryStr.=" left join user_group_mst as c ON b.group_c=c.group_c";
    $queryStr.=" where a.followed_user_id='".Configs::$_['user_data']['user_id']."'";
    $queryStr.=" order by a.ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();   
}