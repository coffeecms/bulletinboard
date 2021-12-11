<?php

class BB_User
{

    public static function updateFollowCountStats($user_id)
    {
        $db=new Database();

        $queryStr=" update bb_user_data as a";
        $queryStr.=" left join (select user_id,count(*) as total from bb_user_follow_data where  user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        $queryStr.=" set a.total_follows=ifnull(b.total,'0');";

        $queryStr.=" update bb_user_data as a";
        $queryStr.=" left join (select followed_user_id,count(*) as total from bb_user_follow_data where  followed_user_id='".$user_id."' group by followed_user_id) as b On a.user_id=b.followed_user_id";
        $queryStr.=" set a.total_followers=ifnull(b.total,'0');";

        $db->nonquery($queryStr);   


    }

    public static function updateReactionCountStats($user_id)
    {
        $db=new Database();

        $queryStr=" update bb_user_data as a";
        $queryStr.=" left join (select user_id,count(*) as total from bb_post_reactions_data where type='thread' AND user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        $queryStr.=" set a.reactions=ifnull(b.total,'0');";

        $queryStr.=" update bb_user_data as a";
        $queryStr.=" left join (select user_id,count(*) as total from bb_post_reactions_data where type='post' AND user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        $queryStr.=" set a.reactions=a.reactions+ifnull(b.total,'0');";

        $db->nonquery($queryStr);   


    }

    public static function updateStats($user_id)
    {
        $db=new Database();

        $queryStr="";
        
        // $queryStr=" update bb_user_data as a";
        // $queryStr.=" join (select user_id,count(*) as total from bb_threads_data where user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        // $queryStr.=" set a.threads=b.total  where a.user_id='".$user_id."';";

        // $queryStr.=" update bb_user_data as a";
        // $queryStr.=" join (select user_id,count(*) as total from bb_posts_data where user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        // $queryStr.=" set a.posts=b.total  where a.user_id='".$user_id."';";

        // $queryStr.=" update bb_user_data ";
        // $queryStr.=" set created_message=(select count(message_id) as total from bb_message_data where user_id='".$user_id."'),";
        // $queryStr.=" message_unread=(select count(message_id) as total from bb_message_data where user_id='".$user_id."' AND is_read='0'),";
        // $queryStr.=" posts=(select count(post_id) as total from bb_posts_data where user_id='".$user_id."'),";
        // $queryStr.=" threads=(select count(thread_id) as total from bb_threads_data where user_id='".$user_id."') where user_id='".$user_id."';";

        // $db->nonquery($queryStr);   

    }
    public static function updateThreadCountStats($user_id)
    {
        $db=new Database();

        $queryStr=" update bb_user_data as a";
        $queryStr.=" left join (select user_id,count(*) as total from bb_threads_data where user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        $queryStr.=" set a.threads=ifnull(b.total,'0')  where a.user_id='".$user_id."';";

        $queryStr.=" update bb_user_data as a";
        $queryStr.=" left join (select user_id,count(*) as total from bb_posts_data where user_id='".$user_id."' group by user_id) as b On a.user_id=b.user_id";
        $queryStr.=" set a.posts=ifnull(b.total,'0')  where a.user_id='".$user_id."';";

        $db->nonquery($queryStr);   

    }

    public static function updateForumCountStats($forum_id)
    {
        // $db=new Database();

        // $queryStr=" update bb_forum_data as a";
        // $queryStr.=" join (select forum_id,count(*) as total from bb_threads_data where forum_id='".$forum_id."' group by forum_id) as b On a.forum_id=b.forum_id";
        // $queryStr.=" set a.total_threads=b.total  where a.forum_id='".$forum_id."';";

        // $queryStr.=" update bb_forum_data as a";
        // $queryStr.=" join (select forum_id,count(*) as total from bb_posts_data where forum_id='".$forum_id."' group by forum_id) as b On a.forum_id=b.forum_id";
        // $queryStr.=" set a.total_posts=b.total  where a.forum_id='".$forum_id."';";

        // $db->nonquery($queryStr);   

    }

    public static function load_by_username($username)
    {
        $savePath=BB_CONTENTS_PATH.'users/'.$username.'.php';

        Configs::$_['bb_user_mst']=[];
        Configs::$_['bb_user_data']=[];
        
        $db=new Database();

        $queryStr='';
        $queryStr.="select a.user_id,a.username,a.fullname,a.group_c,a.level_c,b.title as group_title,c.title as level_title ";
        $queryStr.=" from user_mst a left join user_group_mst b ON a.group_c=b.group_c ";
        $queryStr.=" left join user_level_mst c ON a.level_c=c.level_id ";
        $queryStr.=" where a.username='".$username."' ";
        
        $userMst=$db->query($queryStr); 
      
        if(!is_array($userMst) || count($userMst)==0)
        {
            return false;
        }

        $bbUserData=$db->query("select * from bb_user_data where user_id='".$userMst[0]['user_id']."'"); 

        Configs::$_['bb_user_mst']=$userMst;
        Configs::$_['bb_user_data']=$bbUserData;

    }

    public static function clear()
    {
        $savePath=BB_CONTENTS_PATH.'users/'.$username.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }

}