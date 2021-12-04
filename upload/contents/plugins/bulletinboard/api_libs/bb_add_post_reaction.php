<?php

function bb_add_post_reaction()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');


    // Check default post status of user group
   $status='1';

   $post_id=addslashes(getPost('post_id'));
   $reaction_txt=addslashes(getPost('reaction_txt',''));
   $reaction_id=addslashes(getPost('reaction_id'));
   $title=addslashes(getPost('title'));

   $insertData=array(
       'post_id'=>$post_id,
       'reaction_id'=>$reaction_id,
       'reaction_text'=>$reaction_txt,
       'type'=>'post',
       'user_id'=>Configs::$_['user_data']['user_id'],
   );

   $db=new Database(); 

   $queryStr=arrayToInsertStr('bb_post_reactions_data',$insertData);
   
   $db->nonquery("delete from bb_post_reactions_data where type='post' AND post_id='".$post_id."' ");   
   $db->nonquery($queryStr);   

   $smilesPath=BB_CACHES_PATH.'reactions_top5_'.$post_id.'.php';

   if(file_exists($smilesPath))
   {
       unlink($smilesPath);
   }

   

   BB_System::updateStats();

   return 'OK';
}
