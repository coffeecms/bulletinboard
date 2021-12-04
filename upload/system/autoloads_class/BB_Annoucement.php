<?php

class BB_Annoucement
{

    public static function load()
    {
        Configs::$_['list_annoucement']=[];
        
        $savePath=BB_CACHES_PATH.'annoucement.php';

        if(!file_exists($savePath))
        {
            
            $db=new Database();

            $loadData=$db->query("select * from bb_annoucement_data where status='1' order by ent_dt desc"); 
                
            if(!is_array($loadData) || count($loadData)==0)
            {
                return false;
            }

            create_file($savePath,"<?php Configs::\$_['list_annoucement']='".base64_encode(json_encode($loadData))."';");
        }

        require_once($savePath);

        Configs::$_['list_annoucement']=json_decode(base64_decode(Configs::$_['list_annoucement']),true);


    }
    public static function clear()
    {
        $savePath=BB_CACHES_PATH.'annoucement.php';

        if(file_exists($savePath))
        {
            
            unlink($savePath);
        }

    }

}