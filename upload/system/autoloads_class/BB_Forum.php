<?php

class BB_Forum 
{

    
    public static function updateStats($forum_id)
    {
        $db=new Database();

        $queryStr='';

        $queryStr=" update bb_forum_data as a";
        $queryStr.=" left join (select forum_id,count(*) as total from bb_threads_data where forum_id='".$forum_id."' group by forum_id) as b On a.forum_id=b.forum_id";
        $queryStr.=" set a.total_threads=ifnull(b.total,'0')  where a.forum_id='".$forum_id."';";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" left join (select forum_id,count(*) as total from bb_posts_data where forum_id='".$forum_id."' group by forum_id) as b On a.forum_id=b.forum_id";
        $queryStr.=" set a.total_posts=ifnull(b.total,'0')  where a.forum_id='".$forum_id."';";

        $queryStr.=" update bb_forum_data";
        $queryStr.=" set a.last_thread_title='',a.last_thread_friendly_url='',a.last_thread_author_username='',a.last_thread_dt=''";
        $queryStr.=" where a.forum_id='".$forum_id."';";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" left join (select forum_id,author,friendly_url,title as thread_title,MAX(ent_dt) as ent_dt from bb_threads_data where forum_id='".$forum_id."' group by forum_id,author,friendly_url,title) as b";
        $queryStr.=" ON a.forum_id=b.forum_id";
        $queryStr.=" set a.last_thread_title=ifnull(b.thread_title,''),a.last_thread_friendly_url=ifnull(b.friendly_url,''),a.last_thread_author_username=ifnull(b.author,''),a.last_thread_dt=ifnull(b.ent_dt,null)";
        $queryStr.=" where a.forum_id='".$forum_id."';";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" left join user_mst as b";
        $queryStr.=" ON a.last_thread_author_username=ifnull(b.username,'')";
        $queryStr.=" set a.last_thread_author_avatar=ifnull(b.avatar,'')";
        $queryStr.=" where a.forum_id='".$forum_id."';";


        $db->nonquery($queryStr);   

        $savePath=BB_CACHES_PATH.'forums.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }
    }

    public static function updateAllStats()
    {
        $db=new Database();

        $queryStr='';
        $queryStr.=" update bb_forum_data";
        $queryStr.=" set last_thread_title='',last_thread_friendly_url='',last_thread_author_username='',last_thread_dt=NULL,total_threads='0',total_posts='0';";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" join (select forum_id,count(*) as total from bb_threads_data group by forum_id) as b On a.forum_id=b.forum_id";
        $queryStr.=" set a.total_threads=b.total ;";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" join (select forum_id,count(*) as total from bb_posts_data group by forum_id) as b On a.forum_id=b.forum_id";
        $queryStr.=" set a.total_posts=b.total ;";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" join (select forum_id,author,friendly_url,title as thread_title,MAX(ent_dt) as ent_dt from bb_threads_data  group by forum_id,author,friendly_url,title) as b";
        $queryStr.=" ON a.forum_id=b.forum_id";
        $queryStr.=" set a.last_thread_title=b.thread_title,a.last_thread_friendly_url=b.friendly_url,a.last_thread_author_username=b.author,a.last_thread_dt=b.ent_dt;";

        $queryStr.=" update bb_forum_data as a";
        $queryStr.=" join user_mst as b";
        $queryStr.=" ON a.last_thread_author_username=b.username";
        $queryStr.=" set a.last_thread_author_avatar=b.avatar;";


        $db->nonquery($queryStr);   

        $savePath=BB_CACHES_PATH.'forums.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }
    }

    public static function clear_pin_threads($forum_id)
    {
        $savePath=BB_CACHES_PATH.'pin_threads_'.$forum_id.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }

    public static function load_pin_threads($forum_id)
    {
        $db=new Database();
        $queryStr='';

        $queryStr.="select a.status,a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
        $queryStr.=" c.username,c.group_c,d.group_c as group_c_reply,c.fullname,c.avatar,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt ";
        $queryStr.=" from bb_threads_data as a";
        $queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
                $queryStr.=" join user_mst as d ON a.last_username_reply=d.username ";
        $queryStr.=" join user_mst as c ON a.user_id=c.user_id where a.forum_id='".$forum_id."' AND a.is_stick='1' ";

        $queryStr.=" order by ent_dt desc limit 0,30";

        $loadData=$db->query($queryStr); 

        return $loadData;
    }

    
    public static function clear_ads_threads($forum_id)
    {
        $savePath=BB_FORUMS_PATH.'ads_threads_'.$forum_id.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }

    public static function load_ads_threads($forum_id)
    {
        $db=new Database();
        $queryStr='';

        $queryStr.="select a.status,a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
        $queryStr.=" c.username,c.group_c,e.group_c as group_c_reply,c.fullname,c.avatar,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt ";
        $queryStr.=" from bb_threads_data as a";
        $queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
        $queryStr.=" join user_mst as e ON a.last_username_reply=e.username ";
        $queryStr.=" join user_mst as c ON a.user_id=c.user_id";
        $queryStr.=" join bb_ads_thread_data as d ON a.thread_id=d.thread_id where a.forum_id='".$forum_id."' AND a.status='1' AND d.start_date <= '".date('Y-m-d')."' AND d.end_date >= '".date('Y-m-d')."'";
        // $queryStr.=" join user_mst as c ON a.user_id=c.user_id where a.forum_id='".$forum_id."' AND a.status='1' AND a.thread_id IN (select thread_id from bb_ads_thread_data where forum_id='".$forum_id."' AND end_date >= '".date('Y-m-d')."') ";
        $queryStr.=" order by d.sort_order asc limit 0,30";

        $loadData=$db->query($queryStr); 
            
       return $loadData;

    }
}