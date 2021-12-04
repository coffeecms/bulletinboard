<?php

function bb_edit_post()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // Check default post status of user group
   $status='1';

   $thread_id=addslashes(getPost('thread_id'));
   $post_id=addslashes(getPost('post_id'));
   $forum_id=addslashes(getPost('forum_id',''));
   $attach_files=addslashes(getPost('attach_files'));
   $content=strip_tags_blacklist(trim(addslashes(getPost('content',''))),['iframe']);
   $captcha_answer=trim(addslashes(getPost('captcha_answer','')));
   $method=trim(addslashes(getPost('method','thread')));

   if((int)Configs::$_['bb_enable_captcha_quick_reply']==1)
   {
       if(strlen($captcha_answer)==0)
       {
           return 'You must type captcha characters!';
       }
   }


    // Detect last time send reply
    // Mysql TIMESTAMPDIFF(MINUTE,T.runTime,NOW()) > 20

//    $insertData=array(
//        'post_id'=>$post_id,
//        'thread_id'=>$thread_id,
//        'forum_id'=>$forum_id,
//        'content'=>addslashes(getPost('content')),
//        'user_id'=>Configs::$_['user_data']['user_id'],
//    );

   if(!isset($content[1]))
   {
       return 'Content not allow blank!';
   }



   $db=new Database(); 


    // Captcha process
    if((int)Configs::$_['bb_enable_captcha_quick_reply']==1)
    {
        $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        if($captcha_answer!=$result[0]['answer'])
        {
            return 'Your captcha answer is wrong!';   
        }
    }

    $threadData=$db->query("select title,friendly_url from bb_threads_data where thread_id='".$thread_id."'");

    if(count($threadData)==0)
    {
         return 'Thread which you editting not exist!';
    }

    $postData=$db->query("select post_id from bb_posts_data where post_id='".$post_id."'");
    
    if(count($postData)==0)
    {
         return 'Post which you editting not exist!';
    }

    
   $content=str_replace(' src=', ' alt="Image"  class="img-fluid lozad" data-src=', $content);

   $content=load_hook('bb_parse_post_content_before_db',$content);

    $queryStr='';
    $queryStr.="update bb_posts_data";
    $queryStr.=" set content='".$content."',upd_dt=NOW() ";
    $queryStr.=" where post_id='".$post_id."' AND thread_id='".$thread_id."'";

    $db->nonquery($queryStr);
    load_hook('after_edit_thread',$insertData);

   $db->nonquery("update bb_forum_data set last_thread_title='".$threadData[0]['title']."',last_thread_friendly_url='".$threadData[0]['friendly_url']."',last_thread_author_username='".Configs::$_['user_data']['username']."',last_thread_dt=NOW(),total_posts=total_posts+1 where forum_id='".$forum_id."'");   

   $thread_url='';

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


                if(stristr($filePath, 'bb_contents')!=false)
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
                    'post_id'=>$post_id,
                    'file_path'=>'public/bb_contents/attach_files/'.$attachName,
                    'file_name'=>basename(trim($filePath)),
                    'data_type'=>'post',
                    'file_type'=>$file_type,
                    'file_size'=>$file_size,
                    'user_id'=>Configs::$_['user_data']['user_id'],
                );
            
                $queryStr=arrayToInsertStr('bb_thread_attach_files_data',$insertData);
            
                $db->nonquery($queryStr); 

                load_hook('after_add_post_attach_files',$insertData);

            }

       }

       BB_Threads::clear_attach_files($post_id);

   }



   return 'Done';
}
