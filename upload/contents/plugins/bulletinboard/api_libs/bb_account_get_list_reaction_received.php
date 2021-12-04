<?php


function bb_account_get_list_reaction_received()
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


    $queryStr=" select a.*,d.title as thread_title,d.friendly_url as thread_friendly_url,c.title as reaction_title,c.image_path as reaction_image_path,u.username as source_username";
    $queryStr.=" from bb_post_reactions_data as a";
    $queryStr.=" left join bb_posts_data as b ON a.post_id=b.post_id";
    $queryStr.=" left join user_mst as u ON u.user_id=a.user_id";
    $queryStr.=" left join bb_threads_data as d ON b.thread_id=d.thread_id";
    $queryStr.=" left join bb_reaction_data as c ON a.reaction_id=c.reaction_id";
    $queryStr.=" where a.user_id='".Configs::$_['user_data']['user_id']."' ";

    $queryStr.=" order by a.ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();
}
