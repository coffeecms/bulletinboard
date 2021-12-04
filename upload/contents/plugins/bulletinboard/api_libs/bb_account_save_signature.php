<?php

function bb_account_save_signature()
{
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $signature=strip_tags_blacklist(addslashes(getPost('signature','')),['iframe']);
 
    $db=new Database(); 

    $queryStr="update bb_user_data set ";
    $queryStr.=" signature='".$signature."'";
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";

    $db->nonquery($queryStr);

    return 'OK';
}