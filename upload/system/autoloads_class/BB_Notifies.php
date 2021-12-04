<?php

class BB_Notifies
{
    public static function add($user_id,$username,$content,$target_url='')
    {

        $db=new Database();

        $queryStr='';

        $id=newID(25);

        $db->nonquery("insert into bb_notifies_data(id,user_id,content,target_url) VALUES('".$id."','".$user_id."','".$username.": ".$content."','".$target_url."')");

        $queryStr=" insert into bb_notifies_user_data(notify_id,source_user_id,target_user_id,target_username)";
        $queryStr.=" select '".$id."','".$user_id."',user_id,user_id  ";
        $queryStr.=" from bb_user_follow_data";
        $queryStr.=" where followed_user_id='".$user_id."'";

        $db->nonquery($queryStr);
    }    

    public static function load($user_id)
    {
        $db=new Database();

        $loadData=$db->query("select a.*,b.content,b.target_url from bb_notifies_user_data as a join bb_notifies_data as b ON a.notify_id=b.id where a.target_user_id='".$user_id."' order by b.ent_dt desc limit 0,50");

        
        $db->nonquery("update bb_notifies_user_data set is_read='1' where target_user_id='".$user_id."' AND is_read='0'");

        $total=count($loadData);

        $count=0;

        for ($i=0; $i < $total; $i++) { 
            if((int)$loadData[$i]['is_read']==0)
            {
                $count+=1;
            }
        }

        Configs::$_['bb_user_data']['total_notifies']=$count;
        Configs::$_['bb_user_data']['list_notifies']=$loadData;


    }
}