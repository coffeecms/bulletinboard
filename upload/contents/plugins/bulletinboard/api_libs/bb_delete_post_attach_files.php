<?php

function bb_delete_post_attach_files()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // try {
    //     isValidAccessAPI();
    // } catch (\Exception $e) {
    //     echo responseData($e->getMessage(),'yes');return false;
    // }
    // Check default post status of user group
   $status='1';

   $post_id=addslashes(getPost('post_id'));
   $file_id=addslashes(getPost('file_id'));
   $forum_id=addslashes(getPost('forum_id'));

   if(!isset($post_id[2]))
   {
       return 'Post not valid!';
   }

   if(!isset($file_id[2]))
   {
       return 'File not valid!';
   }

   if(!isset($forum_id[2]))
   {
       return 'Post not valid!';
   }

   $db=new Database(); 

   $loadData=$db->query("select * from bb_posts_data where post_id='".$post_id."'");

   if(count($loadData) > 0)
   {
            
        if(bb_forum_has_permission($forum_id,'BB10010')==false)
        {
            if($loadData[0]['user_id']!=Configs::$_['user_data']['user_id'])
            {
                return 'You can not delete this attach file!';
            }
        }

        $loadFileData=$db->query("select * from bb_thread_attach_files_data where file_id='".$file_id."' AND post_id='".$post_id."'");

        if(count($loadFileData) > 0)
        {
            if(file_exists(ROOT_PATH.$loadFileData[0]['file_path']))
            {
                unlink(ROOT_PATH.$loadFileData[0]['file_path']);
            }
            
            $db->nonquery("delete from bb_thread_attach_files_data where file_id='".$file_id."' AND post_id='".$post_id."'");   
        }
        
   }
   else
   {
        return 'You can not delete this file!';
   }

   BB_Threads::clear_attach_files($post_id);

   return 'Done';
}
