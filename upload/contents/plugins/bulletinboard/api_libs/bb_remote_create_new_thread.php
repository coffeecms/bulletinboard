<?php

function bb_remote_create_new_thread()
{

//    useClass('EmailSystem');

    // $maxID=Configs::$_['bb_thread_id_length'];
    // $minID=(int)$maxID-6;

    $useID=rand(16,20);

    $thread_id=newID($useID);

    // Check default post status of user group
   $status='1';

   $username=strip_tags(addslashes(getPost('username')));
   $title=strip_tags(addslashes(getPost('title')));
   $pin_thread=addslashes(getPost('pin_thread','0'));
   $allow_reply=addslashes(getPost('allow_reply','1'));
   $thumbnail=addslashes(getPost('thumbnail'));

   $attach_files=addslashes(getPost('attach_files'));

   $forum_id=addslashes(getPost('forum_id'));

   if(bb_forum_has_permission($forum_id,'BB10010')==false)
   {
    $pin_thread='0';
    $allow_reply='1';
   }
   if(bb_forum_has_permission($forum_id,'BB20010')==true)
   {
    $pin_thread='0';
    $allow_reply='1';
   }


   if(isset($thumbnail[5]))
   {
    $thumbnail=str_replace(SITE_URL, '', $thumbnail);
   }


   $db=new Database(); 

   $loadUserData=$db->query("select user_id,email from user_mst where username='".$username."' AND group_c IN (select group_c from group_permission_data where permission_c='BB30028')");

   if(count($loadUserData)==0)
   {
        echo responseData('User not have permission to access this api','yes');die();
   }

   $user_id=$loadUserData[0]['user_id'];

   $insertData=array(
       'thread_id'=>$thread_id ,
       'forum_id'=>$forum_id,
       'prefix_id'=>addslashes(getPost('prefix')),
       'title'=>$title,
       'is_stick'=>$pin_thread,
       'thumbnail'=>$thumbnail,
       'allow_reply'=>$allow_reply,
       'friendly_url'=>friendlyString(getPost('title'),'_')."_".$thread_id.'.html',
       'content'=>strip_tags_blacklist(addslashes(getPost('content')),['iframe']),
       'tags'=>addslashes(getPost('tags','')),
       'keywords'=>addslashes(getPost('keywords','')),
       'author'=>$username,
       'last_username_reply'=>$username,
       'last_repy_time'=>'NOW()',
       'user_id'=>$user_id,
       'status'=>$status,
   );

   if(!isset($insertData['title'][2]))
   {
       echo responseData('Title not allow blank','yes');die();
   }

      $insertData['content']=str_replace(' src=', ' alt="Image"  class="lozad" data-src=', $insertData['content']);


   $insertData['title']=load_hook('bb_parse_post_content_before_db',$insertData['title']);
   $insertData['content']=load_hook('bb_parse_post_content_before_db',$insertData['content']);


   $queryStr=arrayToInsertStr('bb_threads_data',$insertData);

   $db->nonquery($queryStr);   


    $queryStr=" update bb_user_data ";
    $queryStr.=" set ";
    $queryStr.=" posts=(select count(post_id) as total from bb_posts_data where user_id='".Configs::$_['user_data']['user_id']."'),";
    $queryStr.=" threads=(select count(thread_id) as total from bb_threads_data where user_id='".Configs::$_['user_data']['user_id']."') where user_id='".Configs::$_['user_data']['user_id']."';";

    $db->nonquery($queryStr);  


   if((int)$insertData['is_stick']==1)
   {
        BB_Forum::clear_pin_threads($forum_id);
   }

   $thread_url=SITE_URL."t-".$insertData['friendly_url'];

   $userData=$db->query("select * from user_mst where user_id='".$user_id."'");

   $db->nonquery("update bb_forum_data set last_thread_title='".$insertData['title']."',last_thread_friendly_url='".$insertData['friendly_url']."',last_thread_author_avatar='".$userData[0]['avatar']."',last_thread_author_username='".$username."',last_thread_dt=NOW(),total_threads=total_threads+1 where forum_id='".$forum_id."'");

   $tagArray=array();

   $tagArray=bb_tagsToInsertStr($thread_id,addslashes(getPost('tags')));

   $total=count($tagArray);

   for ($i=0; $i < $total; $i++) { 
       $db->nonquery($tagArray[$i]);
   }

   saveActivities('bb_thread_add','Add new thread by api '.$title,$username);

   BB_Notifies::add(Configs::$_['user_data']['user_id'],Configs::$_['user_data']['username'],' Write new thread: '.$title,thread_url($insertData['friendly_url']));

   $poll_choice_max=addslashes(getPost('poll_choice_max'));
   $set_close_poll_day=addslashes(getPost('set_close_poll_day'));
   $poll_answer=addslashes(getPost('poll_answer'));
   $poll_question=addslashes(getPost('poll_question'));


   if(isset($poll_question[3]))
   {
       $poll_id=newID(22);

        $insertData=array(
            'poll_id'=>$poll_id,
            'thread_id'=>$thread_id,
            'question'=>$poll_question,
            'poll_choice'=>addslashes(getPost('poll_choice')),
            'allow_change_answer'=>addslashes(getPost('allow_change_answer')),
            'allow_guest_access'=>addslashes(getPost('allow_guest_access')),
            'set_close_poll_day'=>$set_close_poll_day,
            'poll_choice_max'=>$poll_choice_max,
            'user_id'=>$user_id,
        );

        if((int)$set_close_poll_day==1)
        {
            $insertData['end_dt']=addslashes(getPost('close_poll_end_dt'));
        }

        $queryStr=arrayToInsertStr('bb_poll_data',$insertData);

        $db->nonquery($queryStr);   

        $splitAnswer=explode('|||',$poll_answer);

        $total=count($splitAnswer);

        for ($i=0; $i < $total; $i++) { 

            if(strlen(trim($splitAnswer[$i])) > 0)
            {
                $insertData=array(
                    'answer_id'=>newID(22),
                    'poll_id'=>$poll_id,
                    'content'=>trim($splitAnswer[$i]),
                    'sort_order'=>$i,
                );
            
                $queryStr=arrayToInsertStr('bb_poll_answer_data',$insertData);
            
                $db->nonquery($queryStr);    
            }
     
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

                copy($filePath,$attachPath);

                // Remove old file
                if(file_exists($filePath))
                {
                    unlink($filePath);
                }

                $insertData=array(
                    'file_id'=>$fileID,
                    'post_id'=>$thread_id,
                    'file_path'=>'public/bb_contents/attach_files/'.$attachName,
                    'file_name'=>basename(trim($filePath)),
                    'file_type'=>$file_type,
                    'data_type'=>'thread',
                    'file_size'=>$file_size,
                    'user_id'=>$user_id,
                );
            
                $queryStr=arrayToInsertStr('bb_thread_attach_files_data',$insertData);
            
                $db->nonquery($queryStr); 
            }

       }
   }

   // BB_User::updateThreadCountStats($user_id);
   // BB_User::updateForumCountStats($forum_id);
   BB_Forum::updateStats($forum_id);
   BB_System::updateStats();

   $savePath=BB_CACHES_PATH.'forums.php';

   if(file_exists($savePath))
   {
       unlink($savePath);
   }

   BB_System::rss_clear_forum_id($forum_id);
   BB_System::rss_clear_forum_id();
    BB_System::sitemap_clear_forum_id($forum_id);
   BB_System::sitemap_clear_forum_id();
   
   echo responseData($thread_url,'no');die();
}

function bb_tagsToInsertStr($post_c,$tags='')
{
    $result=array();

    $queryStr="";

    if(isset($tags[1]))
    {
        $splitTags=explode(',',$tags);

        $total=count($splitTags);

        for ($i=0; $i < $total; $i++) { 
            $queryStr=arrayToInsertStr('bb_thread_tag_data',array(
                'thread_id'=>$post_c,
                'tag'=>trim($splitTags[$i])
            ));

            array_push($result,$queryStr);
        }
    }

    return $result;
}