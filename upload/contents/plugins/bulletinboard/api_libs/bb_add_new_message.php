<?php

function bb_add_new_message()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // Check default post status of user group
   $status='1';

   $title=addslashes(getPost('title'));
   $receivers=addslashes(getPost('receivers',''));
   $content=strip_tags_blacklist(addslashes(getPost('content')),['iframe','embed']);
   $attach_files=addslashes(getPost('attach_files'));

   if(isset($receivers[2]))
   {
        $receivers=str_replace(";",",",$receivers);
        $receivers=trim(str_replace(",,",",",$receivers));
   }
   else
   {
    return 'Receivers disallow blank';
   }

   $splitReceivers=explode(",",$receivers);

   $totalRe=count($splitReceivers);

//    Configs::$_['bb_max_message_receivers']
   if($totalRe > 10)
   {
       return 'Max receivers is 10';
   }
   
   $max_message=Configs::$_['bb_user_data']['max_message'];
   $created_message=Configs::$_['bb_user_data']['created_message']+(int)$totalRe;

   if((int)$created_message > (int)$max_message)
   {
        return 'Reach max limit can send message.';
   }


   $useID=rand(6,20);

   $message_id=newID($useID);

   $insertData=array(
       'message_id'=>$message_id,
       'subject'=>$title,
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

    $queryStr=" update bb_user_data ";
    $queryStr.=" set created_message=(select count(message_id) as total from bb_message_data where user_id='".Configs::$_['user_data']['user_id']."'),";
    $queryStr.=" message_unread=(select count(message_id) as total from bb_message_data where user_id='".Configs::$_['user_data']['user_id']."' AND is_read='0')  where user_id='".Configs::$_['user_data']['user_id']."';";

    $db->nonquery($queryStr);  

    load_hook('after_add_message',$insertData);

   saveActivities('bb_message_add','Send new message '.$title,$username);

   if(isset($receivers[3]))
   {
       $listReceiversIN='';

        $insertData=array(
            'message_id'=>$message_id,
            'target_username'=>Configs::$_['user_data']['username'],
            'source_user_id'=>Configs::$_['user_data']['user_id'],
            'target_user_id'=>'',
        );

        $queryStr=arrayToInsertStr('bb_message_user_data',$insertData);

        $db->nonquery($queryStr); 

        for ($i=0; $i < $totalRe; $i++) { 

            if(strlen($splitReceivers[$i]) > 2)
            {
                $listReceiversIN="'".$splitReceivers[$i]."',";
                $listReceiversIN=substr($listReceiversIN,0,strlen($listReceiversIN)-1);

                $insertData=array(
                    'message_id'=>$message_id,
                    'target_username'=>$splitReceivers[$i],
                    'source_user_id'=>Configs::$_['user_data']['user_id'],
                    'target_user_id'=>'',
                );
    
                $queryStr=arrayToInsertStr('bb_message_user_data',$insertData);
       
                $db->nonquery($queryStr); 
            }
  
         
        }

        $queryStr=" update bb_message_user_data as a";
        $queryStr.=" join user_mst as b ON a.target_username=b.username";
        $queryStr.=" set a.target_user_id=b.user_id  where a.message_id='".$message_id."' AND LENGTH(a.target_user_id)='0';";

        $db->nonquery($queryStr);  

        //Delete messages of members which dont want receive message
        $queryStr=" delete from bb_message_user_data where target_username IN";
        $queryStr.=" (select a.username from user_mst as a join bb_user_data as b ON a.user_id=b.user_id";
        $queryStr.=" where b.allow_receive_message='4' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND message_id='".$message_id."'";

        $db->nonquery($queryStr);  

        //Delete messages of members which only receive message from following users
        $queryStr=" delete from bb_message_user_data where target_username IN ";
        $queryStr.=" (select a.username from user_mst as a join bb_user_data as b ON a.user_id=b.user_id";
        $queryStr.=" where b.allow_receive_message='3' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND target_username IN (select a.username from user_mst as a join bb_user_follow_data as b ON a.user_id=b.user_id ";
        $queryStr.=" where b.followed_user_id='".Configs::$_['user_data']['user_id']."' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND message_id='".$message_id."'";

        $db->nonquery($queryStr); 

        $notify_id=newID(25);

        $db->nonquery("insert into bb_notifies_data(id,user_id,content,target_url) VALUES('".$notify_id."','".Configs::$_['user_data']['user_id']."','".Configs::$_['user_data']['username'].": New message ".$title."','".message_url($message_id)."')");

        $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
        $queryStr.=" select '".$notify_id."','".Configs::$_['user_data']['user_id']."',target_user_id,target_user_id  ";
        $queryStr.=" from bb_message_user_data";
        $queryStr.=" where message_id='".$message_id."';";
        $db->nonquery($queryStr);


   }

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

   BB_System::updateStats();

   return 'Done';
}
