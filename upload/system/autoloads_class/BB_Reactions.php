<?php

class BB_Reactions
{
    public static function clearCache()
    {
        $smilesPath=BB_CACHES_PATH.'reactions.php';
        
        if(file_exists($smilesPath))
        {
            unlink($smilesPath);
        }
    }
    public static function load()
    {
        Configs::$_['list_reactions']=[];
        
        $smilesPath=BB_CACHES_PATH.'reactions.php';

        $db=new Database();

        if(!file_exists($smilesPath))
        {
            
            $queryStr='';

            $loadData=$db->query("select * from bb_reaction_data order by sort_order asc"); 

            create_file($smilesPath,"<?php Configs::\$_['list_reactions']='".json_encode($loadData)."';");
            
        }

        require_once($smilesPath);

        Configs::$_['list_reactions']=json_decode(Configs::$_['list_reactions'],true);        
    }

    public static function clearCacheByThreadId($thread_id)
    {
        $smilesPath=BB_CACHES_PATH.'reactions_'.$thread_id.'.php';
        
        if(file_exists($smilesPath))
        {
            unlink($smilesPath);
        }
    }

    public static function clearTop5ByThreadId($thread_id)
    {
        $smilesPath=BB_CACHES_PATH.'reactions_top5_'.$thread_id.'.php';

        if(file_exists($smilesPath))
        {
            unlink($smilesPath);
        }
    }

    public static function loadTop5ByThreadId($thread_id)
    {
        $result=[];
       $db=new Database();
     

        $result=$db->query("select a.user_id,a.reaction_id,b.username,c.title,c.image_path from bb_post_reactions_data as a join user_mst as b ON a.user_id=b.user_id join bb_reaction_data as c ON a.reaction_id=c.reaction_id where a.post_id='".$thread_id."' and a.type='thread' order by a.ent_dt desc limit 0,5");    

        return $result;
        
    }

    public static function loadTop5ByPostId($thread_id)
    {
        $result=[];
       $db=new Database();
     
        $result=$db->query("select a.user_id,a.reaction_id,b.username,c.title,c.image_path from bb_post_reactions_data as a join user_mst as b ON a.user_id=b.user_id join bb_reaction_data as c ON a.reaction_id=c.reaction_id where a.post_id='".$thread_id."' and a.type='post' order by a.ent_dt desc limit 0,5");     

        return $result;
        
    }

}