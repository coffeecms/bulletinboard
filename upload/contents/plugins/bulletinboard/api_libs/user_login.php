<?php

function user_login()
{
    $result='NG';

    $username=trim(addslashes(getPost('username','')));
        
    $password=trim(addslashes(getPost('password','')));

    $captcha_answer=trim(addslashes(getPost('captcha_answer','')));

    if(!isset($username[1]) || !isset($password[1]))
    {
        return 'Username or password not valid!';
    }

    if(isset($username[155]) || isset($password[155]))
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

    $result=$db->query("select user_id,username,group_c,level_c from user_mst where (username='".$username."' OR email='".$username."') AND password='".$rePassword."'");

    if(!isset($result[0]))
    {
        // saveActivities('user_login','Login failed',$username);
        return 'Username not valid';        
    }

    $db->nonquery("delete from bb_visitor_views_data where ent_dt < '".date('Y-m-d H:i:s',time()-86400)."'");

    //Set cookie
    $parse=parse_url(SITE_URL);
    setcookie('cf_u', $username, time()+ 360000,'/', $parse['host']);
    setcookie('cf_p', $rePassword, time()+ 360000,'/', $parse['host']);

    
    $db->nonquery("update user_mst set last_logined=now() where (username='".$username."' OR email='".$username."') AND password='".$rePassword."'");
    $db->nonquery("update bb_user_data set last_user_online=now(),last_user_ip_address='".Configs::$_['visitor_data']['ip']."',last_user_user_agent='".Configs::$_['visitor_data']['user_agent']."' where user_id='".$result[0]['user_id']."'");

    createLoginSession($username,$rePassword);

    saveActivities('user_login','Login success',$username);

    BB_Message::updateMessageCountStats($result[0]['user_id']);
    BB_User::updateFollowCountStats($result[0]['user_id']);
    BB_User::updateReactionCountStats($result[0]['user_id']);
    BB_User::updateThreadCountStats($result[0]['user_id']);
    
    return 'OK';
}