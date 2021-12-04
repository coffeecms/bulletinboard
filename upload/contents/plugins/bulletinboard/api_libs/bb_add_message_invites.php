<?php

function bb_add_message_invites()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // Check default post status of user group
   $status='1';

   $receivers=addslashes(getPost('invite_users'));
   $parent_id=addslashes(getPost('message_id'));

   if(isset($receivers[3]))
   {
        $receivers=str_replace(";",",",$receivers);
        $receivers=trim(str_replace(",,",",",$receivers));
   }

   $splitReceivers=explode(",",$receivers);

   $totalRe=count($splitReceivers);

//    Configs::$_['bb_max_message_receivers']
   if($totalRe > 10)
   {
       return 'Max receivers is 10';
   }

   $db=new Database(); 

   if(isset($receivers[2]))
   {
        $listReceiversIN='';
        for ($i=0; $i < $totalRe; $i++) { 

            if(strlen($splitReceivers[$i]) > 2)
            {
                $listReceiversIN="'".$splitReceivers[$i]."',";
                $listReceiversIN=substr($listReceiversIN,0,strlen($listReceiversIN)-1);

                $insertData=array(
                    'message_id'=>$parent_id,
                    'target_username'=>$splitReceivers[$i],
                    'source_user_id'=>Configs::$_['user_data']['user_id'],
                    'target_user_id'=>'',
                );
    
                $queryStr=arrayToInsertStr('bb_message_user_data',$insertData);
       
                $db->nonquery("delete from bb_message_user_data where target_username='".$splitReceivers[$i]."' AND source_user_id='".Configs::$_['user_data']['user_id']."'");   
    
                $db->nonquery($queryStr);  

                
            }
 

         
        }

        $queryStr=" update bb_message_user_data as a";
        $queryStr.=" join user_mst as b ON a.target_username=b.username";
        $queryStr.=" set a.target_user_id=b.user_id  where a.message_id='".$parent_id."' AND LENGTH(a.target_user_id)='0';";

        $db->nonquery($queryStr);  

        $queryStr=" delete from bb_message_user_data where target_username NOT IN (select username from user_mst) ";
        $queryStr.=" AND message_id='".$parent_id."'";

        $db->nonquery($queryStr);  

        //Delete messages of members which dont want receive message
        $queryStr=" delete from bb_message_user_data where target_username IN";
        $queryStr.=" (select a.username from user_mst as a join bb_user_data as b ON a.user_id=b.user_id";
        $queryStr.=" where b.allow_receive_message='4' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND message_id='".$parent_id."'";

        $db->nonquery($queryStr);  

        //Delete messages of members which only receive message from following users
        $queryStr=" delete from bb_message_user_data where target_username IN ";
        $queryStr.=" (select a.username from user_mst as a join bb_user_data as b ON a.user_id=b.user_id";
        $queryStr.=" where b.allow_receive_message='3' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND target_username IN (select a.username from user_mst as a join bb_user_follow_data as b ON a.user_id=b.user_id ";
        $queryStr.=" where b.followed_user_id='".Configs::$_['user_data']['user_id']."' AND a.username IN (".$listReceiversIN."))";
        $queryStr.=" AND message_id='".$parent_id."'";

        $db->nonquery($queryStr);  

        $savePath=BB_CACHES_PATH.'message_receivers_'.$parent_id.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

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

                $useID=rand(10,14);

                $fileID=newID($useID);

                $attachName=$fileID.'.data';

                $attachPath=BB_ATTACH_FILES_PATH.$attachName;

                $file_type=mime_content_type(trim($filePath));
                $file_size=filesize(trim($filePath));

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
            }

       }
   }

   return 'Done';
}
