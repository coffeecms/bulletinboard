<?php

class BB_Threads
{
    public static function clearCacheByID($thread_id)
    {
        $savePath=BB_THREADS_PATH.$thread_id.'.php';
        
        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }

    public static function add_views($thread_id)
    {
        $db=new Database();

        $db->nonquery("update bb_threads_data set views=views+1 where thread_id='".$thread_id."'");
       
    }
    
    public static function loadByID($thread_id)
    {
        Configs::$_['thread_data']=[];
        
        $savePath=BB_THREADS_PATH.$thread_id.'.php';

        $db=new Database();

        if(!file_exists($savePath))
        {
            
            $queryStr='';

            $queryStr=" select a.*,b.title as forum_title,b.friendly_url as forum_friendly_url,c.title as prefix_title,c.bg_color_c as prefix_bg_color_c,";
            $queryStr.=" e.username,e.group_c,e.last_logined,e.ent_dt as user_ent_dt,d.posts,d.threads,e.avatar,d.reactions,d.created_message,";
            $queryStr.=" d.total_followers,d.total_follows,d.birthday,d.gender,d.phone1,d.icq,d.aim,d.skype,d.facebook,d.twitter";
            $queryStr.=" from bb_threads_data as a";
            $queryStr.=" join bb_forum_data as b ON a.forum_id=b.forum_id";
            $queryStr.=" join bb_user_data as d ON a.user_id=d.user_id";
            $queryStr.=" join user_mst as e ON a.user_id=e.user_id";
            $queryStr.=" join bb_post_prefix_data as c ON a.prefix_id=c.prefix_id";
            $queryStr.=" where a.thread_id='".$thread_id."'";

            $loadData=$db->query($queryStr); 
                
            create_file($savePath,"<?php Configs::\$_['thread_data']='".json_encode($loadData[0])."';");
            
        }

        require_once($savePath);

        Configs::$_['thread_data']=json_decode(Configs::$_['thread_data'],true);        
    }    

    public static function updateThreadStats($thread_id)
    {
        $db=new Database();

        $queryStr=" update bb_threads_data as a";
        $queryStr.=" left join (select thread_id,count(*) as total from bb_posts_data where thread_id='".$thread_id."' group by thread_id) as b On a.thread_id=b.thread_id";
        $queryStr.=" set a.total_replies=ifnull(b.total,'0')  where a.thread_id='".$thread_id."';";

        $queryStr.=" update bb_threads_data as a";
        $queryStr.="  left join (select thread_id,count(*) as total from bb_threads_reactions_data where thread_id='".$thread_id."' group by thread_id) as b On a.thread_id=b.thread_id";
        $queryStr.=" set a.total_reactions=ifnull(b.total,'0')  where a.thread_id='".$thread_id."';";

        $queryStr.=" update bb_threads_data as a";
        $queryStr.=" left join (select a.thread_id,b.username,MAX(a.ent_dt) as ent_dt";
        $queryStr.=" from bb_posts_data as a join user_mst as b";
        $queryStr.=" ON a.user_id=b.user_id";
        $queryStr.=" where a.thread_id='".$thread_id."'";
        $queryStr.=" group by a.thread_id,b.username) as b ON a.thread_id=b.thread_id";
        $queryStr.=" set a.last_repy_time=ifnull(b.ent_dt,null),a.last_username_reply=ifnull(b.username,null)";
        $queryStr.=" where a.thread_id='".$thread_id."'";

        $db->nonquery($queryStr);   

        // $queryStr.=" update bb_threads_data set last_repy_time=NOW(),last_username_reply='".Configs::$_['user_data']['username']."'  where thread_id='".$thread_id."';";

    }
    
    public static function load_top_x_latest($top=10,$forum_id='',$order_by='ent_dt',$order_type='desc')
    {
        $db=new Database();

        // $db->setCache(180);

        $queryStr='';

        $loadData=[];

        $queryStr.="select a.status,a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
        $queryStr.=" c.username,c.fullname,c.avatar,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt, ";
        $queryStr.=" d.title as forum_title,d.friendly_url as forum_friendly_url ";
        $queryStr.=" from bb_threads_data as a";
        $queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
        $queryStr.=" join bb_forum_data as d ON a.forum_id=d.forum_id";
        $queryStr.=" join user_mst as c ON a.user_id=c.user_id where a.is_stick='0' AND a.status='1' ";

        if(isset($forum_id[3]))
        {
            $queryStr.=" AND a.forum_id='".$forum_id."' ";
        }
        
        $queryStr.=" order by a.".$order_by." ".$order_type." limit 0,".$top." ";

        $loadData=$db->query($queryStr); 

        // $db->unsetCache();

        return $loadData;
    }

    public static function load_attach_files($post_id)
    {
        // $savePath=BB_CACHES_PATH.'post_attach_files_'.$post_id.'.php';

        $db=new Database();

        $queryStr='';

        $loadData=$db->query("select * from bb_thread_attach_files_data where post_id='".$post_id."' AND data_type IN ('thread','post')"); 
      
        return $loadData;
    }
    
    public static function clear_attach_files($post_id)
    {
        $savePath=BB_CACHES_PATH.'post_attach_files_'.$post_id.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }
}