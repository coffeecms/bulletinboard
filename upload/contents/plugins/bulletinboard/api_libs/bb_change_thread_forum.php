<?php

function bb_change_thread_forum()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false

    $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $list_id=addslashes(getPost('list_id',''));
    $forum_id=addslashes(getPost('forum_id',''));
    $source_forum_id=addslashes(getPost('source_forum_id',''));

    $split_post_c=explode(',', $list_id);

    $reformat_post_c='';

    $total=count($split_post_c);

    for ($i=0; $i < $total; $i++) { 
        $reformat_post_c.="'".$split_post_c[$i]."',";
    }

    $reformat_post_c=substr($reformat_post_c, 0,strlen($reformat_post_c)-1);
    
    $queryStr='';
    
    $db=new Database(); 

    // die("update bb_threads_data set forum_id='".$forum_id."'  where thread_id IN (".$reformat_post_c.") ");
    $db->nonquery("update bb_threads_data set forum_id='".$forum_id."'  where thread_id IN (".$reformat_post_c.") ");

    BB_Forum::updateStats($forum_id);
    BB_Forum::updateStats($source_forum_id);

    $savePath=BB_CACHES_PATH.'forums.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    return 'OK';

}