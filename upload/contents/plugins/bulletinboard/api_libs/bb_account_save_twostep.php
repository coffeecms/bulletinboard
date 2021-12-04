<?php

function bb_account_save_twostep()
{
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $current_password=addslashes(getPost('current_password',''));
    $new_password=addslashes(getPost('new_password',''));
    $confirm_new_password=addslashes(getPost('confirm_new_password',''));
    $is_two_step=addslashes(getPost('is_two_step',''));
   

    $db=new Database(); 


    $queryStr="update bb_user_data set ";
    $queryStr.=" received_news_via_email='".$received_news_via_email."',received_activities_via_email='".$received_activities_via_email."', ";
    $queryStr.=" address='".$address."',website='".$website."',job='".$job."',gender='".$gender."', ";
    $queryStr.=" about='".$about."',facebook='".$facebook."',twitter='".$twitter."',icq='".$icq."', ";
    $queryStr.=" aim='".$aim."',skype='".$skype."',google_talk='".$google_talk."' ";
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";


    $queryStr.="update bb_user_data set ";
    if(isset($birthday[3]))
    {
        $queryStr.=" birthday='".$birthday."' ";
    }
    else
    {
        $queryStr.=" birthday=NULL ";
    }
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";

    
    $queryStr.="update user_mst set ";
    $queryStr.=" email='".$email."' ";
    $queryStr.=" where user_id='".Configs::$_['user_data']['user_id']."'; ";

    $db->nonquery($queryStr);

    return 'OK';
}