<?php

function bb_add_comment_on_profile_page()
{
     
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

   $content=strip_tags_blacklist(addslashes(getPost('content')),['iframe']);
   $target_user_id=addslashes(getPost('target_user_id'));
   $target_username=addslashes(getPost('target_username'));
   $captcha_answer=trim(addslashes(getPost('captcha_answer','')));
   if(!isset($content[2]))
   {
       return 'Content not allow blank';
   }

   if(!isset($target_user_id[2]))
   {
       return 'Receiver not valid!';
   }

   if(!isset($target_username[2]))
   {
       return 'Receiver not valid!';
   }

   
   if((int)Configs::$_['bb_enable_captcha_when_send_wall_message']==1)
   {
       if(strlen($captcha_answer)==0)
       {
           return 'You must type captcha characters!';
       }
   }


    $insertData=array(
        'message_id'=>newID(22),
        'author_id'=>Configs::$_['user_data']['user_id'],
        'wall_user_id'=>$target_user_id,
        'content'=>$content,
    );

    $queryStr=arrayToInsertStr('bb_user_wall_comment_data',$insertData);
    $db=new Database(); 

    
    // Captcha process
    if((int)Configs::$_['bb_enable_captcha_when_send_wall_message']==1)
    {
        $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        if($captcha_answer!=$result[0]['answer'])
        {
            return 'Your captcha answer is wrong!';   
        }
    }

    $db->nonquery($queryStr);   

    saveActivities('bb_user_wall_comment_add','Add comment on  '.$target_username,$username);

//    EmailSystem::prepare_send_newuser($insertData);

    return 'OK';
}