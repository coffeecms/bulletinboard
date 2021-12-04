<?php

function bb_account_save_preferences()
{
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $timezone=strip_tags(addslashes(getPost('timezone','')));
   
    $db=new Database(); 

    $queryStr="update bb_user_data set ";
    $queryStr.=" timezone='".$timezone."' ";
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";

    $db->nonquery($queryStr);

    return 'OK';
}