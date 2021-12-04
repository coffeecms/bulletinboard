<?php

function bb_add_thread_reply()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // Check default post status of user group
   $status='1';

   $thread_id=addslashes(getPost('thread_id'));
   $forum_id=addslashes(getPost('forum_id',''));
   $thread_title=addslashes(getPost('thread_title'));
   $attach_files=addslashes(getPost('attach_files'));
   $captcha_answer=trim(addslashes(getPost('captcha_answer','')));
   $method=trim(addslashes(getPost('method','reply')));

   $useID=rand(10,15);

   $post_id=newID($useID);

   $user_id=Configs::$_['user_data']['user_id'];

   if((int)Configs::$_['bb_enable_captcha_quick_reply']==1)
   {
       if(strlen($captcha_answer)==0)
       {
           return 'You must type captcha characters!';
       }
   }


    // Detect last time send reply
    // Mysql TIMESTAMPDIFF(MINUTE,T.runTime,NOW()) > 20



   $insertData=array(
       'post_id'=>$post_id,
       'thread_id'=>$thread_id,
       'forum_id'=>$forum_id,
       // 'friendly_url'=>$threadData[0]['friendly_url'].'/post-'.$post_id,
       'content'=>strip_tags_blacklist(addslashes(getPost('content')),['iframe']),
       'user_id'=>Configs::$_['user_data']['user_id'],
   );

   if(!isset($insertData['content'][1]))
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

   $threadData=$db->query("select * from bb_threads_data where thread_id='".$thread_id."'");

   if(count($threadData)==0)
   {
        return 'Thread that you reply not exist!';
   }


   $insertData['content']=str_replace(' src=', ' alt="Image"  class="img-fluid lozad" data-src=', $insertData['content']);

   // $insertData['title']=load_hook('bb_parse_post_content_before_db',$insertData['title']);
   $insertData['content']=load_hook('bb_parse_post_content_before_db',$insertData['content']);



   $insertData['friendly_url']=$threadData[0]['friendly_url'].'/post-'.$post_id;

   $loadData=$db->query("select count(*) as total from bb_posts_data where thread_id='".$thread_id."'");

   $totalPost=(int)$loadData[0]['total']+1;

   $insertData['sort_order']=$totalPost;

   $queryStr=arrayToInsertStr('bb_posts_data',$insertData);
   
   $db->nonquery($queryStr);

    load_hook('after_reply_thread',$insertData);

   // BB_Threads::updateThreadStats($thread_id);
   // BB_Forum::updateStats($forum_id);

   // BB_System::updateStats();

   $userData=$db->query("select * from user_mst where user_id='".Configs::$_['user_data']['user_id']."'");

   $db->nonquery("update bb_forum_data set last_thread_title='".$threadData[0]['title']."',last_thread_friendly_url='".$insertData['friendly_url']."',last_thread_author_avatar='".$userData[0]['avatar']."',last_thread_author_username='".Configs::$_['user_data']['username']."',last_thread_dt=NOW() where forum_id='".$forum_id."'");   

   $db->nonquery("update bb_threads_data set last_username_reply='".$userData[0]['username']."',last_repy_time=NOW(),upd_dt=NOW(),last_reply_author_avatar='".$userData[0]['avatar']."',last_reply_friendly_url='".$threadData[0]['friendly_url']."/post-".$post_id."' where thread_id='".$thread_id."'");   


    $queryStr=" update bb_user_data ";
    $queryStr.=" set ";
    $queryStr.=" posts=(select count(post_id) as total from bb_posts_data where user_id='".Configs::$_['user_data']['user_id']."'),";
    $queryStr.=" threads=(select count(thread_id) as total from bb_threads_data where user_id='".Configs::$_['user_data']['user_id']."') where user_id='".Configs::$_['user_data']['user_id']."';";

    $db->nonquery($queryStr); 

    $queryStr=" update bb_user_data ";
    $queryStr.=" set ";
    $queryStr.=" posts=(select count(post_id) as total from bb_posts_data where user_id='".$threadData[0]['user_id']."'),";
    $queryStr.=" threads=(select count(thread_id) as total from bb_threads_data where user_id='".$threadData[0]['user_id']."') where user_id='".$threadData[0]['user_id']."';";

    $db->nonquery($queryStr); 

    BB_System::updateStats();


   $thread_url='';

   $thread_url=SITE_URL."t-".$threadData[0]['friendly_url'].'/post-'.$post_id;

   saveActivities('bb_thread_add_reply','Reply thread '.$thread_title,$username);

   BB_Notifies::add(Configs::$_['user_data']['user_id'],Configs::$_['user_data']['username'],' Reply thread: '.$thread_title,thread_url($threadData[0]['friendly_url']));

   $notify_id=newID(25);

    $db->nonquery("insert into bb_notifies_data(id,user_id,content,target_url) VALUES('".$notify_id."','".$user_id."','".$username.": Reply thread ".$thread_title."','".thread_url($threadData[0]['friendly_url'])."')");

    $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
    $queryStr.=" select '".$notify_id."','".$user_id."',user_id,user_id  ";
    $queryStr.=" from bb_posts_data";
    $queryStr.=" where thread_id='".$thread_id."';";
    $db->nonquery($queryStr);

    $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
    $queryStr.=" select '".$notify_id."','".$user_id."',user_id,user_id  ";
    $queryStr.=" from bb_threads_data";
    $queryStr.=" where thread_id='".$thread_id."';";
    $db->nonquery($queryStr);
    

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
   }

   // BB_User::updateThreadCountStats(Configs::$_['user_data']['user_id']);
   // BB_User::updateForumCountStats($forum_id);

   $savePath=BB_CACHES_PATH.'forums.php';

   if(file_exists($savePath))
   {
       unlink($savePath);
   }
   BB_System::rss_clear_forum_id($forum_id);
   BB_System::rss_clear_forum_id();
    BB_System::sitemap_clear_forum_id($forum_id);
   BB_System::sitemap_clear_forum_id();
   
   return $thread_url;
}
