<?php

function bb_delete_attach_files_temp()
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

   $file_path=addslashes(getPost('file_path'));
  
   if(!isset($file_path[2]))
   {
       return 'File not valid!';
   }

   $split=explode('uploads',$file_path);

   if(count($split) < 2)
   {
       return 'File not valid!';
   }

   $file_path=str_replace('..','',$file_path);

   $file_path=ROOT_PATH.str_replace(SITE_URL,"",$file_path);

   if(file_exists($file_path))
   {
       unlink($file_path);
   }

   return 'Done';
}
