<?php

function bb_edit_thread()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    // $maxID=Configs::$_['bb_thread_id_length'];
    // $minID=(int)$maxID-6;

    // Check default post status of user group
   $status='1';

   $thread_id=addslashes(getPost('thread_id'));
   $title=strip_tags(addslashes(getPost('title')));
   $pin_thread=addslashes(getPost('pin_thread','0'));
   $poll_id=addslashes(getPost('poll_id',''));
   $friendly_url=addslashes(getPost('friendly_url',''));
   $status_thread=addslashes(getPost('status_thread','0'));
   $thumbnail=addslashes(getPost('thumbnail'));


   $attach_files=addslashes(getPost('attach_files'));

   $forum_id=addslashes(getPost('forum_id'));

   $captcha_answer=trim(addslashes(getPost('captcha_answer','')));

   if((int)Configs::$_['bb_enable_captcha_in_new_thread']==1)
   {
       if(strlen($captcha_answer)==0)
       {
           return 'You must type captcha characters!';
       }
   }
   if(isset($thumbnail[5]))
   {
    $thumbnail=str_replace(SITE_URL, '', $thumbnail);
   }


   $updateData=array(
       'forum_id'=>$forum_id,
       'prefix_id'=>addslashes(getPost('prefix')),
       'title'=>$title,
       'thumbnail'=>$thumbnail,
    //    'is_stick'=>$pin_thread,
    //    'friendly_url'=>friendlyString(getPost('title'),'_')."_".$thread_id.'.html',
       'content'=>strip_tags_blacklist(addslashes(getPost('content')),['iframe']),
       'tags'=>addslashes(getPost('tags','')),
       'author'=>Configs::$_['user_data']['username'],
       // 'last_username_reply'=>Configs::$_['user_data']['username'],
       // 'last_repy_time'=>'NOW()',
       // 'upd_dt'=>'NOW()',
       'user_id'=>Configs::$_['user_data']['user_id'],
    //    'status'=>$status,
   );

   $updateData['content']=str_replace(' src=', ' alt="Image"  class="img-fluid lozad" data-src=', $updateData['content']);


   // $updateData['title']=load_hook('bb_parse_post_content_before_db',$updateData['title']);
   $updateData['content']=load_hook('bb_parse_post_content_before_db',$updateData['content']);


   if(!isset($updateData['title'][2]))
   {
       return 'Title not allow blank';
   }

   
   if(bb_forum_has_permission($forum_id,'BB10010')==true)
   {
    $updateData['is_stick']=$pin_thread;
    $updateData['status']=$status_thread;
   }
   if(bb_forum_has_permission($forum_id,'BB20010')==false)
   {
    $updateData['is_stick']=$pin_thread;
    $updateData['status']=$status_thread;
   }


    $insertData=array(
        'update'=>$updateData,
        'where'=>array(
            'thread_id'=>"='".$thread_id."'",
        )
    );  
   
   $queryStr=arrayToUpdateStr('bb_threads_data',$insertData);

   $db=new Database(); 

   
    // Captcha process
    if((int)Configs::$_['bb_enable_captcha_in_new_thread']==1)
    {
        $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        if($captcha_answer!=$result[0]['answer'])
        {
            return 'Your captcha answer is wrong!';   
        }
    }

   $db->nonquery($queryStr);   



   
    load_hook('after_edit_thread',$insertData);

   if((int)$updateData['is_stick']==1)
   {
        BB_Forum::clear_pin_threads($forum_id);
   }

//    $thread_url=SITE_URL."t-".$updateData['friendly_url'];
   $thread_url='';

   $friendly_url=str_replace(SITE_URL,'',$friendly_url);

   $db->nonquery("update bb_forum_data set last_thread_title='".$updateData['title']."',last_thread_friendly_url='".$friendly_url."',last_thread_author_username='".Configs::$_['user_data']['username']."',last_thread_dt=NOW(),total_threads=total_threads+1 where forum_id='".$forum_id."'");

   $tagArray=array();

   $tagArray=bb_tagsToInsertStr($thread_id,addslashes(getPost('tags')));

   $total=count($tagArray);

   for ($i=0; $i < $total; $i++) { 
       $db->nonquery($tagArray[$i]);
   }

   BB_Threads::clear_attach_files($thread_id);

   saveActivities('bb_thread_add','Add new thread '.$title,$username);

   $poll_choice_max=addslashes(getPost('poll_choice_max'));
   $set_close_poll_day=addslashes(getPost('set_close_poll_day'));
   $poll_answer=addslashes(getPost('poll_answer'));
   $poll_answer_id=addslashes(getPost('poll_answer_id'));
   $poll_question=addslashes(getPost('poll_question'));



   if(isset($poll_question[3]))
   {
       if(strlen($poll_id)==0)
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
                'user_id'=>Configs::$_['user_data']['user_id'],
            );

            if((int)$set_close_poll_day==1)
            {
                $insertData['end_dt']=addslashes(getPost('close_poll_end_dt'));
            }

            $queryStr=arrayToInsertStr('bb_poll_data',$insertData);

            $db->nonquery($queryStr);   

            $splitAnswer=explode('|||',$poll_answer);
            $splitAnswerID=explode('|||',$poll_answer_id);

            $total=count($splitAnswer);

            $answer_id='';

            for ($i=0; $i < $total; $i++) { 

                if(strlen(trim($splitAnswer[$i])) > 0)
                {
                    if(strlen(trim($splitAnswerID[$i]))>0)
                    {
                        $answer_id=$splitAnswerID[$i];
                        $db->nonquery("update bb_poll_answer_data set content='".trim($splitAnswer[$i])."' where poll_id='".$poll_id."' AND answer_id='".$answer_id."'");  
                    }
                    else
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
       }
       else
       {

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
                    'post_id'=>$thread_id,
                    'file_path'=>'public/bb_contents/attach_files/'.$attachName,
                    'file_name'=>basename(trim($filePath)),
                    'file_type'=>$file_type,
                    'data_type'=>'thread',
                    'file_size'=>$file_size,
                    'user_id'=>Configs::$_['user_data']['user_id'],
                );
            
                $queryStr=arrayToInsertStr('bb_thread_attach_files_data',$insertData);
            

       
                $db->nonquery($queryStr); 

                load_hook('after_add_post_attach_files',$insertData);

            }

       }
   }

   BB_User::updateThreadCountStats(Configs::$_['user_data']['user_id']);
   BB_User::updateForumCountStats($forum_id);
   BB_Forum::updateStats($forum_id);
   BB_System::updateStats();

   return SITE_URL.$friendly_url;
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