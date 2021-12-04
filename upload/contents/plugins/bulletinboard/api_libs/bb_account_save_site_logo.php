<?php

function bb_account_save_site_logo()
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

    // $resize = new ResizeImage(ROOT_PATH.$file_path);
    // $resize->resizeTo(256, 256, 'exact');
    // $resize->saveImage(ROOT_PATH.$file_path);

    $new_path='public/bb_contents/'.basename($file_path);

    copy($file_path,ROOT_PATH.$new_path);

    $db=new Database(); 

    $db->nonquery("update setting_data set key_value='".$new_path."' where key_c='bb_site_logo' ");

    if(file_exists($file_path))
    {
        unlink($file_path);
    }

    clear_hook();


    return SITE_URL.$new_path;
}