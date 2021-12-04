<?php

function user_forgot_password()
{
    $result='NG';

    $username=trim(addslashes(getPost('username','')));
        
    $captcha_answer=trim(addslashes(getPost('captcha_answer','')));

    if(!isset($username[1]))
    {
        return 'Username or password not valid!';
    }

    if(isset($username[155]))
    {
        return 'Username or password not valid!';
    }

    $savePath=PUBLIC_PATH.'bb_contents/firewall/username/'.md5(strtoupper($username));

    if(file_exists($savePath))
    {
        return 'Your username disallow login to forum';
    }

    if((int)Configs::$_['bb_enable_captcha_in_login']==1)
    {
        if(strlen($captcha_answer)==0)
        {
            return 'Your captcha result is wrong';
        }
    }


    $rePassword=md5($password);
    $db=new Database(); 

    // Captcha process
    if((int)Configs::$_['bb_enable_captcha_in_login']==1)
    {
        $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        if($captcha_answer!=$result[0]['answer'])
        {
            return 'Your captcha result is wrong';
        }
    }

    $result=$db->query("select user_id,username,group_c,level_c from user_mst where (username='".$username."' OR email='".$username."')");

    if(!isset($result[0]))
    {
        // saveActivities('user_login','Login failed',$username);
        return 'Username not valid';        
    }

    $loadData=$db->query("select user_id,username,group_c,level_c from user_mst where (username='".$username."' OR email='".$username."')");   

    EmailSystem::prepare_send_forgot_password($username,$loadData[0]['email']);

    
    return 'OK';
}