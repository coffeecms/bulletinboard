<?php

function bb_account_save_info()
{
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(!isset($cookie_username[1]))
    {
        return 'NG';
    }

    $email=strip_tags(addslashes(getPost('email','')));
    $received_news_via_email=strip_tags(addslashes(getPost('received_news_via_email','')));
    $received_activities_via_email=strip_tags(addslashes(getPost('received_activities_via_email','')));
    $birthday=strip_tags(addslashes(getPost('birthday','')));
    $address=strip_tags(addslashes(getPost('address','')));
    $website=strip_tags(addslashes(getPost('website','')));
    $job=strip_tags(addslashes(getPost('job','')));
    $gender=strip_tags(addslashes(getPost('gender','')));
    $about=strip_tags_blacklist(addslashes(getPost('about','')),['iframe']);
    $facebook=strip_tags(addslashes(getPost('facebook','')));
    $twitter=strip_tags(addslashes(getPost('twitter','')));
    $icq=strip_tags(addslashes(getPost('icq','')));
    $aim=strip_tags(addslashes(getPost('aim','')));
    $skype=strip_tags(addslashes(getPost('skype','')));
    $google_talk=strip_tags(addslashes(getPost('google_talk','')));

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