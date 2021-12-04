<?php

function bb_delete_attach_files()
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

   $thread_id=addslashes(getPost('thread_id'));
   $file_id=addslashes(getPost('file_id'));

   if(!isset($thread_id[2]))
   {
       return 'Thread url not allow is blank!';
   }

   if(!isset($file_id[2]))
   {
       return 'File not valid!';
   }

   $db=new Database(); 

   $loadData=$db->query("select * from bb_threads_data where thread_id='".$thread_id."' AND user_id='".Configs::$_['user_data']['user_id']."'");

   if(count($loadData) > 0)
   {
        $loadFileData=$db->query("select * from bb_thread_attach_files_data where file_id='".$file_id."' AND post_id='".$thread_id."'");

        if(count($loadFileData) > 0)
        {
            if(file_exists(ROOT_PATH.$loadFileData[0]['file_path']))
            {
                unlink(ROOT_PATH.$loadFileData[0]['file_path']);
            }
            
            $db->nonquery("delete from bb_thread_attach_files_data where file_id='".$file_id."' AND post_id='".$thread_id."'");   
        }
        
   }
   else
   {
        return 'You can not delete this file!';
   }

   return 'Done';
}
