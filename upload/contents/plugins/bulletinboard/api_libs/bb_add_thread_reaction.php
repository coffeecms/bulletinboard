<?php

function bb_add_thread_reaction()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');


    // Check default post status of user group
   $status='1';

   $thread_id=addslashes(getPost('thread_id'));
   $reaction_txt=addslashes(getPost('reaction_txt',''));
   $reaction_id=addslashes(getPost('reaction_id'));

   $insertData=array(
       'post_id'=>$thread_id,
       'reaction_id'=>$reaction_id,
       'reaction_text'=>$reaction_txt,
       'type'=>'thread',
       'user_id'=>Configs::$_['user_data']['user_id'],
   );

   $db=new Database(); 

   $threadData=$db->query("select * from bb_threads_data where thread_id='".$thread_id."'");

   if(count($threadData)==0)
   {
        return 'NG';
   }

   $queryStr=arrayToInsertStr('bb_post_reactions_data',$insertData);
   
   $db->nonquery("delete from bb_post_reactions_data where type='thread' AND post_id='".$thread_id."' ");   
   $db->nonquery($queryStr);   

   $smilesPath=BB_CACHES_PATH.'reactions_top5_'.$thread_id.'.php';

   if(file_exists($smilesPath))
   {
       unlink($smilesPath);
   }

   saveActivities('bb_thread_add_reaction','Reaction on thread '.$threadData[0]['title'],$username);

   BB_Notifies::add(Configs::$_['user_data']['user_id'],Configs::$_['user_data']['username'],' Add reaction at thread: '.$threadData[0]['title'],thread_url($threadData[0]['friendly_url']));

   BB_Threads::updateThreadStats($thread_id);

   BB_System::updateStats();


   return 'OK';
}
