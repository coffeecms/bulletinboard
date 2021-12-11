<?php

class BB_Message
{
    public static function set_is_read($user_id,$message_id)
    {
        $db=new Database();

        $db->nonquery("update bb_message_data set is_read='1',upd_dt=NOW() where message_id='".$message_id."'");
    }
    
    public static function load_receivers($message_id)
    {
        
        $db=new Database();

        $queryStr='';

        $loadData=$db->query("select a.target_username,a.target_username as username,b.group_c,a.target_user_id,a.message_id from bb_message_user_data as a join user_mst as b ON a.target_username=b.username where a.message_id='".$message_id."' limit 0,10"); 


        return $loadData;
    }

    public static function load_attach_files($message_id)
    {
        $db=new Database();

        $queryStr='';

        $loadData=$db->query("select * from bb_thread_attach_files_data where post_id='".$message_id."' AND data_type='message'"); 
                

        return $loadData;
    }

    public static function updateMessageCountStats($user_id)
    {
        $db=new Database();

        $queryStr=" update bb_user_data as a";
        $queryStr.=" left  join (select source_user_id,count(*) as total from bb_message_user_data where source_user_id='".$user_id."' group by source_user_id) as b On a.user_id=b.source_user_id";
        $queryStr.=" set a.created_message=ifnull(b.total,'0')  where a.user_id='".$user_id."';";

        //Update total unread message
        $queryStr=" update bb_user_data as a";
        $queryStr.=" left join (select target_user_id,count(*) as total from bb_message_user_data where target_user_id='".$user_id."' AND is_read='0' group by target_user_id) as b On a.user_id=b.target_user_id";
        $queryStr.=" set a.message_unread=ifnull(b.total,'0')  where a.user_id='".$user_id."';";
     
        $db->nonquery($queryStr);   

    }
    public static function updateMessageCountStats_ByMessageId($user_id)
    {
        // $db=new Database();

        // $queryStr=" update bb_user_data as a";
        // $queryStr.=" join (select source_user_id,count(*) as total from bb_message_user_data where source_user_id='".$user_id."' group by source_user_id) as b On a.user_id=b.source_user_id";
        // $queryStr.=" set a.created_message=b.total  where a.user_id='".$user_id."';";

        // //Update total unread message
        // $queryStr=" update bb_user_data as a";
        // $queryStr.=" join (select target_user_id,count(*) as total from bb_message_user_data where target_user_id='".$user_id."' AND is_read='0' group by target_user_id) as b On a.user_id=b.target_user_id";
        // $queryStr.=" set a.message_unread=b.total  where a.user_id='".$user_id."';";
     
        // $db->nonquery($queryStr);   

    }


}