<?php

function bb_account_save_bookmark()
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

    $url=addslashes(getPost('url',''));
  
    $insertData=array(
        'user_id'=>Configs::$_['user_data']['user_id'],
        'url'=>addslashes(getPost('url')),
    );

    $queryStr=arrayToInsertStr('bb_user_bookmarks_data',$insertData);

    $db=new Database(); 

    $db->nonquery("delete from bb_user_bookmarks_data where  user_id='".Configs::$_['user_data']['user_id']."' AND url='".$url."'");
    $db->nonquery($queryStr);

    return 'OK';
}