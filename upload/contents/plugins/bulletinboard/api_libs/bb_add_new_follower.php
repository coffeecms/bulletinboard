<?php

function bb_add_new_follower()
{
     
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

   $followed_id=addslashes(getPost('followed_id'));
   $to_username=addslashes(getPost('to_username'));

   if(!isset($followed_id[2]))
   {
       return 'NG';
   }

   if(!isset($to_username[2]))
   {
       return 'NG';
   }

    $insertData=array(
        'follow_id'=>newID(22) ,
        'user_id'=>Configs::$_['user_data']['user_id'],
        'followed_user_id'=>addslashes(getPost('followed_id')),
    );


    $queryStr=arrayToInsertStr('bb_user_follow_data',$insertData);
    $db=new Database(); 

    $db->nonquery("delete from bb_user_follow_data where user_id='".Configs::$_['user_data']['user_id']."' AND followed_user_id='".$insertData['followed_user_id']."'");   
    
    $db->nonquery($queryStr);   

    $queryStr=" update bb_user_data as a";
    $queryStr.=" join (select user_id,count(*) as total from bb_user_follow_data where  user_id='".Configs::$_['user_data']['user_id']."' group by user_id) as b On a.user_id=b.user_id";
    $queryStr.=" set a.total_follows=b.total;";

    $queryStr.=" update bb_user_data as a";
    $queryStr.=" join (select followed_user_id,count(*) as total from bb_user_follow_data where  followed_user_id='".Configs::$_['user_data']['user_id']."' group by followed_user_id) as b On a.user_id=b.followed_user_id";
    $queryStr.=" set a.total_followers=b.total;";

    $db->nonquery($queryStr); 
    
    $queryStr=" update bb_user_data as a";
    $queryStr.=" join (select user_id,count(*) as total from bb_user_follow_data where  user_id='".$insertData['followed_user_id']."' group by user_id) as b On a.user_id=b.user_id";
    $queryStr.=" set a.total_follows=b.total;";

    $queryStr.=" update bb_user_data as a";
    $queryStr.=" join (select followed_user_id,count(*) as total from bb_user_follow_data where  followed_user_id='".$insertData['followed_user_id']."' group by followed_user_id) as b On a.user_id=b.followed_user_id";
    $queryStr.=" set a.total_followers=b.total;";

    $db->nonquery($queryStr);   

    saveActivities('bb_follow_add','Following user '.$to_username,$username);

    // BB_User::updateFollowCountStats(Configs::$_['user_data']['user_id']);
    // BB_User::updateFollowCountStats($insertData['followed_user_id']);

//    EmailSystem::prepare_send_newuser($insertData);

    return 'OK';
}