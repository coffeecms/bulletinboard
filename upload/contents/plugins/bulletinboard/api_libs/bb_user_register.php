<?php

function bb_user_register()
{
    useClass('EmailSystem');

    $useID=rand(12,18);

    $user_id=newID($useID);
 
    // $user_id=newID(Configs::$_['system_user_id_len']);

    $captcha_answer=trim(addslashes(getPost('captcha_answer','')));

    // if((int)Configs::$_['bb_enable_captcha_in_register']==1)
    // {
    //     if(strlen($captcha_answer)==0)
    //     {
    //         return 'CAPTCHA_NG_1';
    //     }
    // }

    
    // Captcha process
    // if((int)Configs::$_['bb_enable_captcha_in_register']==1)
    // {
    //     $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

    //     if($captcha_answer!=$result[0]['answer'])
    //     {
    //         return 'CAPTCHA_NG_2';   
    //     }
    // }

    $status='1';

    if(Configs::$_['register_verify_email']!='no')
    {
        $status='0';
    }

    if((int)Configs::$_['bb_enable_captcha_in_register']==1)
    {
        if(strlen($captcha_answer)==0)
        {
            return 'You must type captcha characters!';
        }
    }



    $username=strtolower(trim(addslashes(getPost('username'))));

    BB_System::load_disallow_username();

    if(isset(Configs::$_['list_disallow_username_register'][$username]))
    {
        return 'We disallow this username!';
    }

    $insertData=array(
        'user_id'=>$user_id,
        'group_c'=>Configs::$_['default_member_groupid'],
        'level_c'=>Configs::$_['default_member_levelid'],
        'email'=>addslashes(getPost('email')),
        'password'=>md5(addslashes(getPost('password'))),
        'username'=>$username,
        'fullname'=>addslashes(getPost('username','')),
        'status'=>$status,
    );

    if(!isset($insertData['username'][1]))
    {
        return 'Username not allow blank!';
    }

    if(!isset($insertData['email'][5]))
    {
        return 'Email not allow blank!';
    }

    if(!isset($insertData['password'][1]))
    {
        return 'Password not allow blank!';
    }

    $queryStr=arrayToInsertStr('user_mst',$insertData);
    $db=new Database(); 

    // Captcha process
    if((int)Configs::$_['bb_enable_captcha_in_register']==1)
    {
        $result=$db->query("select answer from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        if($captcha_answer!=$result[0]['answer'])
        {
            return 'Your captcha answer is wrong!';   
        }
    }

    $loadData=$db->query("select count(*) as total from user_mst where username='".$username."' OR email='".$insertData['email']."'");

    if((int)$loadData[0]['total'] > 0)
    {
        return 'This username or email existed in our system.';
    }


    $db->nonquery($queryStr); 
    
    $insertBBData=array(
        'user_id'=>$user_id,
    );

    $queryStr=arrayToInsertStr('bb_user_data',$insertBBData);

    $db->nonquery($queryStr); 
   
    BB_System::updateStats();

    load_hook('after_insert_user',$insertData);

    saveActivities('user_add','New member registered '.$insertData['username'],$username);

    $savePath=PUBLIC_PATH.'caches/system_setting.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }
    
    EmailSystem::prepare_send_newuser($insertData);


    return 'OK';

}