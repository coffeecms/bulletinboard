<?php

class BB_UserRanks
{
    public static function load()
    {
        $savePath=BB_CACHES_PATH.'user_ranks.php';

        $db=new Database();

        if(!file_exists($savePath))
        {
            
            $queryStr='';

            $queryStr=" select a.*,b.title,b.bg_color_c,b.left_str,b.right_str";
            $queryStr.=" from bb_usergroup_ranks_data as a";
            $queryStr.=" join bb_ranks_data as b ON a.rank_id=b.rank_id";
            $queryStr.=" where b.status='1'";
            

            $loadData=$db->query($queryStr); 
                
            create_file($savePath,"<?php Configs::\$_['user_ranks_data']='".json_encode($loadData)."';");

            
        }

        require_once($savePath);

        if(!is_array(Configs::$_['user_ranks_data']))
        {
            Configs::$_['user_ranks_data']=json_decode(Configs::$_['user_ranks_data'],true);   
        }
                 
    }

    public static function clear_by_userid($user_id)
    {
        $savePath=BB_CACHES_PATH.'user_ranks_'.$user_id.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }
    }
    public static function load_by_userid($user_id)
    {
        // $savePath=BB_CACHES_PATH.'user_ranks_'.$user_id.'.php';

        $db=new Database();

        $queryStr='';

        $queryStr=" select distinct *";
        $queryStr.=" from bb_ranks_data";
        $queryStr.=" where rank_id IN (";
        $queryStr.=" select rank_id from bb_usergroup_ranks_data where group_id IN (select group_c from user_mst where user_id='".$user_id."')";
        $queryStr.=" UNION";
        $queryStr.=" select rank_id from bb_users_rank_data  where user_id='".$user_id."'";
        $queryStr.=" )";

        $result=$db->query($queryStr); 

        return $result;

                 
    }    
    public static function load_by_rankid($rankid)
    {
        if(!isset(Configs::$_['user_ranks_data']))
        {
            self::load();
        }

        $result=[];

        $total=count(Configs::$_['user_ranks_data']);

        for ($i=0; $i < $total; $i++) { 
            if(Configs::$_['user_ranks_data'][$i]['rank_id']==$rankid)
            {
                array_push($result,Configs::$_['user_ranks_data'][$i]);

                break;
            }
        }
        
        // $savePath=BB_CACHES_PATH.'user_ranks_'.$user_id.'.php';

        // $db=new Database();

        //     $queryStr='';

        //     $queryStr=" select a.*,b.title,b.bg_color_c,b.left_str,b.right_str,b.image";
        //     $queryStr.=" from bb_users_rank_data as a";
        //     $queryStr.=" join bb_ranks_data as b ON a.rank_id=b.rank_id";
        //     $queryStr.=" where a.user_id='".$user_id."' order by b.ent_dt asc";
            
        //     $result=$db->query($queryStr); 

        return $result;

                 
    }
}