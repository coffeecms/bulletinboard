<?php

function bb_close_thread()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // $maxID=Configs::$_['bb_thread_id_length'];
    // $minID=(int)$maxID-6;

    // Check default post status of user group
   $status='1';

    $thread_id=addslashes(getPost('thread_id'));
    $forum_id=addslashes(getPost('forum_id'));
    $author_id=addslashes(getPost('author_id'));

    $queryStr='';

    $db=new Database(); 

    $threadData=$db->query("select * from bb_threads_data where thread_id='".$thread_id."'");

    if(count($threadData)==0)
    {
        return 'Thread not valid!';
    }

    if($threadData[0]['user_id']!=Configs::$_['user_data']['user_id'] )
    {
        // Disallow delete thread
        if(bb_forum_has_permission($forum_id,'BB20010')==true)
        {
            return '[BB20010] - You can not close this thread!';
        }

        // Can delete thread
        if(bb_forum_has_permission($forum_id,'BB10010')==false)
        {
            return '[BB10010] - You can not close this thread!';
        }
        
    }

   $db->nonquery("update bb_threads_data set allow_reply='0',upd_dt=NOW() where thread_id='".$thread_id."'");   

   BB_Forum::updateStats($forum_id);

   $savePath=BB_CACHES_PATH.'forums.php';

   if(file_exists($savePath))
   {
       unlink($savePath);
   }
   
   return 'Done';
}
