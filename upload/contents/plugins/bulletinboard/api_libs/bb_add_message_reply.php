<?php

function bb_add_message_reply()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // Check default post status of user group
   $status='1';

   $parent_id=addslashes(getPost('message_id'));
   $content=strip_tags_blacklist(addslashes(getPost('content')),['iframe']);
   $attach_files=addslashes(getPost('attach_files'));

   $totalRe=1;

   $max_message=Configs::$_['bb_user_data']['max_message'];
   $created_message=Configs::$_['bb_user_data']['created_message']+(int)$totalRe;

   if((int)$created_message > (int)$max_message)
   {
        return 'Reach max limit can send message.';
   }

   $useID=rand(6,14);

   $message_id=newID($useID);

   $insertData=array(
       'message_id'=>$message_id,
       'parent_id'=>$parent_id,
       'subject'=>'reply',
       'content'=>$content,
       'username'=>Configs::$_['user_data']['username'],
       'user_id'=>Configs::$_['user_data']['user_id'],
   );

   if(!isset($insertData['content'][1]))
   {
       return 'Content not allow blank!';
   }

   if(!isset($insertData['subject'][1]))
   {
       return 'Subject not allow blank!';
   }

   $db=new Database(); 

   $queryStr=arrayToInsertStr('bb_message_data',$insertData);
   
   $db->nonquery($queryStr);   

    load_hook('after_reply_message',$insertData);

//    $db->nonquery("update bb_message_data set is_read='0',upd_dt=NOW() where message_id='".$parent_id."'");   
   $db->nonquery("update bb_message_user_data set is_read='0',readed_time=NOW() where message_id='".$parent_id."'");   


   // Update Stats
    $queryStr=" update bb_user_data ";
    $queryStr.=" set created_message=(select count(message_id) as total from bb_message_data where user_id='".Configs::$_['user_data']['user_id']."'),";
    $queryStr.=" message_unread=(select count(message_id) as total from bb_message_data where user_id='".Configs::$_['user_data']['user_id']."' AND is_read='0')  where user_id='".Configs::$_['user_data']['user_id']."';";

    $db->nonquery($queryStr);  


    $notify_id=newID(25);

    $db->nonquery("insert into bb_notifies_data(id,user_id,content,target_url) VALUES('".$notify_id."','".Configs::$_['user_data']['user_id']."','".Configs::$_['user_data']['username'].": Reply message','".message_url($parent_id)."')");

    $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
    $queryStr.=" select '".$notify_id."','".Configs::$_['user_data']['user_id']."',target_user_id,target_user_id  ";
    $queryStr.=" from bb_message_user_data";
    $queryStr.=" where message_id='".$parent_id."' AND target_user_id<>'".Configs::$_['user_data']['user_id']."';";
    $db->nonquery($queryStr);

    // $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
    // $queryStr.=" select '".$notify_id."','".Configs::$_['user_data']['user_id']."',user_id,user_id  ";
    // $queryStr.=" from bb_message_data";
    // $queryStr.=" where message_id='".$message_id."';";
    // $db->nonquery($queryStr);

   if(isset($attach_files[5]))
   {
    
        $attachPath='';
        $attachName='';
       $splitFiles=explode('|||',$attach_files);

       $total=count($splitFiles);

       $filePath='';

       $fileID='';

       for ($i=0; $i < $total; $i++) { 

            if(isset($splitFiles[$i][2]))
            {
                $filePath=ROOT_PATH.str_replace(SITE_URL,"",$splitFiles[$i]);

                if(!file_exists($filePath))
                {
                    continue;
                }

                $useID=rand(10,20);

                $fileID=newID($useID);

                $attachName=$fileID.'.data';

                $attachPath=BB_ATTACH_FILES_PATH.$attachName;

                $file_type=mime_content_type(trim($filePath));
                $file_size=filesize(trim($filePath));


                if((float)$file_size > (float)Configs::$_['bb_max_thread_file_size'])
                {
                    continue;
                }
                
                copy($filePath,$attachPath);

                // Remove old file
                if(file_exists($filePath))
                {
                    unlink($filePath);
                }

                $insertData=array(
                    'file_id'=>$fileID,
                    'post_id'=>$message_id,
                    'file_path'=>'public/bb_contents/attach_files/'.$attachName,
                    'file_name'=>basename(trim($filePath)),
                    'data_type'=>'message',
                    'file_type'=>$file_type,
                    'file_size'=>$file_size,
                    'user_id'=>Configs::$_['user_data']['user_id'],
                );
            
                $queryStr=arrayToInsertStr('bb_thread_attach_files_data',$insertData);
            
                $db->nonquery($queryStr); 

                load_hook('after_add_message_attach_files',$insertData);

            }

       }
   }

   BB_Message::updateMessageCountStats(Configs::$_['user_data']['user_id']);
   // BB_Message::updateMessageCountStats_ByMessageId($parent_id);

   return 'Done';
}
