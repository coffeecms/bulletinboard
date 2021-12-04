<?php

function bb_memberlist_filter()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    // Allow to view member list
    if(!isset(Configs::$_['user_permissions']['BB10018']))
    {
        echo responseData('ERROR_1','yes');die();   
    }   

    $limit=addslashes(getPost('limit','50'));
    $page_no=addslashes(getPost('page_no','1'));
    $method=addslashes(getPost('method','1'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    $offset=(int)$page_no*50;

    $queryStr='';

    if($method=='most_followers')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(c.total,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" left join (SELECT followed_user_id,count(user_id) as total FROM bb_user_follow_data WHERE followed_user_id='".Configs::$_['user_data']['user_id']."' group by followed_user_id)  as c";
        $queryStr.=" left join (SELECT followed_user_id,count(user_id) as total FROM bb_user_follow_data group by followed_user_id)  as c";
        $queryStr.=" ON a.user_id=c.followed_user_id";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by c.total desc limit ".$offset.",".$limit;
    }
    if($method=='most_followings')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(c.total,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" left join (SELECT user_id,count(followed_user_id) as total FROM bb_user_follow_data WHERE user_id='".Configs::$_['user_data']['user_id']."' group by user_id)  as c";
        $queryStr.=" left join (SELECT user_id,count(followed_user_id) as total FROM bb_user_follow_data  group by user_id)  as c";
        $queryStr.=" ON a.user_id=c.user_id";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by c.total desc limit ".$offset.",".$limit;        
    }
    if($method=='most_points')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.total_points,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by a.total_points desc limit ".$offset.",".$limit;             
    }
    if($method=='most_reactions')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.reactions,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by a.reactions desc limit ".$offset.",".$limit;          
    }
    if($method=='most_messages')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.created_message,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by a.created_message desc limit ".$offset.",".$limit;            
    }
    if($method=='most_threads')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.threads,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by a.threads desc limit ".$offset.",".$limit;         
    }
    if($method=='most_replies')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.posts,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by a.posts desc limit ".$offset.",".$limit;         
    }    
    if($method=='newest_member')
    {
        $queryStr=" select a.*,b.ent_dt,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.posts,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        // $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."'";
        $queryStr.=" order by b.ent_dt desc limit ".$offset.",".$limit;         
    }    
    if($method=='today_birthday')
    {
        $queryStr=" select a.*,b.username,ifnull(b.avatar,'') as avatar,d.title as group_title,ifnull(a.posts,'0') as total";
        $queryStr.=" from bb_user_data as a";
        $queryStr.=" left join user_mst as b ON a.user_id=b.user_id";
        $queryStr.=" left join user_group_mst as d ON b.group_c=d.group_c";
        $queryStr.=" where ifnull(a.birthday,'')<>'' AND CAST(a.birthday as date)='".date('Y-m-d')."'";
        $queryStr.=" order by b.username asc limit ".$offset.",".$limit;         
    }

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();   
}