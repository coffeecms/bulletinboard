<?php

function bb_account_get_list_hidebb_send_payment()
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

    $queryStr=" select a.*,b.username,c.title as thread_title,c.friendly_url as thread_friendly_url";
    $queryStr.=" from bb_bbcode_hide_pay_data as a";
    $queryStr.=" left join user_mst as b ON a.seller_id=b.user_id";
    $queryStr.=" left join bb_threads_data as c ON a.post_id=c.thread_id";
    $queryStr.=" where a.buyer_id='".Configs::$_['user_data']['user_id']."' AND a.data_type='thread'";
    $queryStr.=" union ";
    $queryStr=" select a.*,b.username,d.title as thread_title,d.friendly_url as thread_friendly_url";
    $queryStr.=" from bb_bbcode_hide_pay_data as a";
    $queryStr.=" left join user_mst as b ON a.seller_id=b.user_id";
    $queryStr.=" left join bb_posts_data as c ON a.post_id=c.post_id";
    $queryStr.=" left join bb_threads_data as d ON c.thread_id=c.thread_id";
    $queryStr.=" where a.buyer_id='".Configs::$_['user_data']['user_id']."' AND a.data_type='post'";
    
    $queryStr.=" order by a.ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();   
}