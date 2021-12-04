<?php

function bb_delete_thread()
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
    $queryStr.="delete from bb_threads_data where thread_id='".$thread_id."'";

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
            return '[BB20010] - You can not delete this thread!';
        }

        // Can delete thread
        if(bb_forum_has_permission($forum_id,'BB10010')==false)
        {
            return '[BB10010] - You can not delete this thread!';
        }
        
    }


    $db->nonquery("delete from bb_post_reactions_data where type='post' AND post_id IN (select post_id from bb_posts_data where thread_id='".$thread_id."')");   

    $db->nonquery("delete from bb_post_reactions_data where type='thread' AND post_id='".$thread_id."'");   
  
   $attachData=$db->query("select file_path from bb_thread_attach_files_data where data_type='thread' AND post_id='".$thread_id."' ");

   $total=count($attachData);

   for ($i=0; $i < $total; $i++) { 
       if(file_exists(ROOT_PATH.$attachData[$i]['file_path']))
       {
           unlink(ROOT_PATH.$attachData[$i]['file_path']);
       }
   }

   $db->nonquery("delete from bb_thread_tag_data where thread_id='".$thread_id."' ");

   $db->nonquery("delete from bb_thread_attach_files_data where data_type='thread' AND post_id='".$thread_id."' ");


   $pollData=$db->query("select * from bb_poll_data where thread_id='".$thread_id."' ");

   $total=count($pollData);

   if($total > 0)
   {
    $db->nonquery("delete from bb_poll_data where thread_id='".$thread_id."' ");
    $db->nonquery("delete from bb_poll_answer_data where poll_id='".$pollData[0]['poll_id']."' ");
    $db->nonquery("delete from bb_poll_member_answer_data where poll_id='".$pollData[0]['poll_id']."' ");
   }
 
//    Replies
   $repliesAttachData=$db->query("select file_path from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id='".$thread_id."') ");

   $total=count($repliesAttachData);

   for ($i=0; $i < $total; $i++) { 
    if(file_exists(ROOT_PATH.$repliesAttachData[$i]['file_path']))
    {
        unlink(ROOT_PATH.$repliesAttachData[$i]['file_path']);
    }
   }

   $db->nonquery("delete from bb_thread_attach_files_data where data_type='post' AND post_id IN (select post_id from bb_posts_data where thread_id='".$thread_id."') ");

   $db->nonquery($queryStr);   


   $db->nonquery("delete from bb_posts_data where thread_id='".$thread_id."'");   

   BB_Forum::updateStats($forum_id);
   BB_Forum::clear_pin_threads($forum_id);
   BB_Forum::clear_ads_threads($forum_id);

   BB_System::updateStats();

   $savePath=BB_CACHES_PATH.'forums.php';

   if(file_exists($savePath))
   {
       unlink($savePath);
   }
   
   return 'Done';
}
