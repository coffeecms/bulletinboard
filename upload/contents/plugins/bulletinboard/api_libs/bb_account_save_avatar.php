<?php

function bb_account_save_avatar()
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
    $resize->resizeTo(256, 256, 'exact');
    $resize->saveImage(ROOT_PATH.$file_path);

    $new_path='public/uploads/users/'.basename($file_path);

    copy($file_path,ROOT_PATH.$new_path);

    $db=new Database(); 

    $db->nonquery("update user_mst set avatar='".$new_path."' where  user_id='".Configs::$_['user_data']['user_id']."' ");

    if(file_exists($file_path))
    {
        unlink($file_path);
    }

    $savePath=BB_CACHES_PATH.'forums.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

    return SITE_URL.$new_path;
}