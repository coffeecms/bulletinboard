<?php

function bb_account_save_profile_cover()
{

    if(Configs::$_['user_data']['user_id']=='GUEST')
    {
        return 'NG';
    }
    
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $file_path=addslashes(getPost('file_path',''));

    $file_path=str_replace(SITE_URL,'',$file_path);

    $resize = new ResizeImage(ROOT_PATH.$file_path);
    $resize->resizeTo(1200, 457, 'exact');
    $resize->saveImage(ROOT_PATH.$file_path);

    $db=new Database(); 

    $db->nonquery("update bb_user_data set wall_banner='".$file_path."' where  user_id='".Configs::$_['user_data']['user_id']."' ");

    $savePath=BB_CACHES_PATH.'forums.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    return SITE_URL.$file_path;
}