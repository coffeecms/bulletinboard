<?php


function bb_get_list_thread()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $keywords=addslashes(getPost('keywords',''));
    $start_date=addslashes(getPost('start_date',''));
    $end_date=addslashes(getPost('end_date',''));
    $user_id=trim(addslashes(getPost('user_id','')));
    $username=trim(addslashes(getPost('username','')));
    $prefix=addslashes(getPost('prefix',''));

    $limit=addslashes(getPost('limit','30'));
    $page_no=addslashes(getPost('page_no','1'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    $offset=(int)$page_no*30;

    if($user_id=='all')
    {
        $user_id='';
    }
  


    $queryStr='';


    $queryStr.="select distinct a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
    $queryStr.=" c.username,c.fullname,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt ";
    $queryStr.=" from bb_threads_data as a";
    $queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
    $queryStr.=" join user_mst as c ON a.user_id=c.user_id";
    $queryStr.="  WHERE  CAST(a.ent_dt as date) BETWEEN '".$start_date."' AND '".$end_date."' AND a.is_stick='0' ";

    if(isset($keywords[2]))
    {
        $queryStr.=" AND (a.title LIKE '%".$keywords."%' OR a.content LIKE '%".$keywords."%') ";
    }

    if(isset($user_id[5]))
    {
        $queryStr.=" AND a.user_id='".$user_id."' ";
    }
    if(isset($username[1]))
    {
        $queryStr.=" AND c.username='".$username."' ";

        if(Configs::$_['user_data']['username']!=$username)
        {
            if(!isset(Configs::$_['user_permissions']['BB10008']))
            {
                $queryStr.=" AND a.status IN ('1') ";
            }
        }
    }



    if($prefix=='all')
    {
        $prefix='';
    }
    if(isset($prefix[1]))
    {
        $queryStr.=" AND a.prefix_id='".$prefix."' ";
    }


    $queryStr.=" order by a.ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);


    echo responseData($result,'no');die();
}
