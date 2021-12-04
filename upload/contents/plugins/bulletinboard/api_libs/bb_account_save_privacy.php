<?php

function bb_account_save_privacy()
{
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $allow_view_profile=addslashes(getPost('allow_view_profile',''));
    $allow_other_write_on_profile=addslashes(getPost('allow_other_write_on_profile',''));
    $allow_receive_message=addslashes(getPost('allow_receive_message',''));
    $is_show_online_status=addslashes(getPost('is_show_online_status',''));
    $is_show_activites=addslashes(getPost('is_show_activites',''));
    $is_show_birthday=addslashes(getPost('is_show_birthday',''));

    $db=new Database(); 

    $queryStr="update bb_user_data set ";
    $queryStr.=" allow_view_profile='".$allow_view_profile."',allow_other_write_on_profile='".$allow_other_write_on_profile."', ";
    $queryStr.=" allow_receive_message='".$allow_receive_message."',is_show_online_status='".$is_show_online_status."',is_show_activites='".$is_show_activites."',is_show_birthday='".$is_show_birthday."'";
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";

    $db->nonquery($queryStr);

    return 'OK';
}