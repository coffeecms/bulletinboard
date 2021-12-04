<?php

function bb_clean_thread_data()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $thread_start_date=addslashes(getPost('thread_start_date'));
    $thread_end_date=addslashes(getPost('thread_end_date'));
    $thread_username=addslashes(getPost('thread_username'));
    $thread_group_id=addslashes(getPost('thread_group_id'));
    $thread_forum_id=addslashes(getPost('thread_forum_id'));
    $thread_prefix_id=addslashes(getPost('thread_prefix_id'));
    $thread_min_views=addslashes(getPost('thread_min_views'));
    $thread_max_views=addslashes(getPost('thread_max_views'));
    $thread_total_replies=addslashes(getPost('thread_total_replies'));

    if(strlen($thread_min_views)==0)
    {
        $thread_min_views=0;
    }
    if(strlen($thread_max_views)==0)
    {
        $thread_max_views=10000000;
    }
    if(strlen($thread_total_replies)==0)
    {
        $thread_total_replies=100000;
    }
    
    $queryStr='';

    $db=new Database(); 

    $queryStr="delete from bb_post_reactions_data where thread_id IN (select thread_id from bb_threads_data where CAST(ent_dt as date) BETWEEN '".$thread_start_date."' AND  '".$thread_end_date."'";

    if(isset($thread_username[2]))
    {
        $queryStr.=" AND author='".$thread_username."'";
    }

    if(isset($thread_prefix_id[2]))
    {
        $queryStr.=" AND prefix_id='".$thread_prefix_id."'";
    }

    if(isset($thread_forum_id[2]))
    {
        $queryStr.=" AND forum_id='".$thread_forum_id."'";
    }

    $queryStr.=" AND views BETWEEN '".$thread_min_views."' AND '".$thread_max_views."'";
    $queryStr.=" AND total_replies<='".$thread_total_replies."')";
  
    $db->nonquery($queryStr);
    

    $queryStr="select file_path from bb_thread_attach_files_data where data_type='thread' AND thread_id IN (select thread_id from bb_threads_data where CAST(ent_dt as date) BETWEEN '".$thread_start_date."' AND  '".$thread_end_date."'";

    if(isset($thread_username[2]))
    {
        $queryStr.=" AND author='".$thread_username."'";
    }

    if(isset($thread_prefix_id[2]))
    {
        $queryStr.=" AND prefix_id='".$thread_prefix_id."'";
    }

    if(isset($thread_forum_id[2]))
    {
        $queryStr.=" AND forum_id='".$thread_forum_id."'";
    }

    $queryStr.=" AND views BETWEEN '".$thread_min_views."' AND '".$thread_max_views."'";
    $queryStr.=" AND total_replies<='".$thread_total_replies."')";
  
    $loadData=$db->query($queryStr);

    $total=count($loadData);

    for ($i=0; $i < $total; $i++) { 
        if(file_exists(ROOT_PATH.$loadData[$i]['file_path']))
        {
            unlink(ROOT_PATH.$loadData[$i]['file_path']);
        }
    }

    $queryStr="delete from bb_thread_attach_files_data where data_type='thread' AND thread_id IN (select thread_id from bb_threads_data where CAST(ent_dt as date) BETWEEN '".$thread_start_date."' AND  '".$thread_end_date."'";

    if(isset($thread_username[2]))
    {
        $queryStr.=" AND author='".$thread_username."'";
    }

    if(isset($thread_prefix_id[2]))
    {
        $queryStr.=" AND prefix_id='".$thread_prefix_id."'";
    }

    if(isset($thread_forum_id[2]))
    {
        $queryStr.=" AND forum_id='".$thread_forum_id."'";
    }

    $queryStr.=" AND views BETWEEN '".$thread_min_views."' AND '".$thread_max_views."'";
    $queryStr.=" AND total_replies<='".$thread_total_replies."')";
  
    $db->nonquery($queryStr);
    

    $queryStr="delete from bb_thread_tag_data where thread_id IN (select thread_id from bb_threads_data where CAST(ent_dt as date) BETWEEN '".$thread_start_date."' AND  '".$thread_end_date."'";

    if(isset($thread_username[2]))
    {
        $queryStr.=" AND author='".$thread_username."'";
    }

    if(isset($thread_prefix_id[2]))
    {
        $queryStr.=" AND prefix_id='".$thread_prefix_id."'";
    }

    if(isset($thread_forum_id[2]))
    {
        $queryStr.=" AND forum_id='".$thread_forum_id."'";
    }

    $queryStr.=" AND views BETWEEN '".$thread_min_views."' AND '".$thread_max_views."'";
    $queryStr.=" AND total_replies<='".$thread_total_replies."')";
  
    $db->nonquery($queryStr);
    

    $queryStr="delete from bb_threads_data where CAST(ent_dt as date) BETWEEN '".$thread_start_date."' AND  '".$thread_end_date."'";

    if(isset($thread_username[2]))
    {
        $queryStr.=" AND author='".$thread_username."'";
    }

    if(isset($thread_prefix_id[2]))
    {
        $queryStr.=" AND prefix_id='".$thread_prefix_id."'";
    }

    if(isset($thread_forum_id[2]))
    {
        $queryStr.=" AND forum_id='".$thread_forum_id."'";
    }

    $queryStr.=" AND views BETWEEN '".$thread_min_views."' AND '".$thread_max_views."'";
    $queryStr.=" AND total_replies<='".$thread_total_replies."'";

    //    Replies
    $repliesAttachData=$db->query("select file_path from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id NOT IN (select thread_id from bb_threads_data)) ");

    $total=count($repliesAttachData);

    for ($i=0; $i < $total; $i++) { 
        if(file_exists(ROOT_PATH.$repliesAttachData[$i]['file_path']))
        {
            unlink(ROOT_PATH.$repliesAttachData[$i]['file_path']);
        }
    }

    $db->query("delete from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id NOT IN (select thread_id from bb_threads_data)) ");

    $db->nonquery("delete from bb_post_reactions_data where type='post' AND post_id IN (select post_id from bb_posts_data where thread_id  NOT IN (select thread_id from bb_threads_data))");       
    
    $db->nonquery($queryStr);
    
    BB_Forum::updateStats($thread_forum_id);
    BB_Forum::clear_pin_threads($thread_forum_id);
    BB_Forum::clear_ads_threads($thread_forum_id);
 
    BB_System::updateStats();
    return 'OK';
}