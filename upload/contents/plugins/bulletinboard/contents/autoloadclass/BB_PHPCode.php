<?php

class BB_PHPCode
{
    public static function load($zoneName='')
    {
        if(!isset($zoneName[2]))
        {
            return '';
        }

        $zoneName=strtolower($zoneName);

        $savePath=BB_CACHES_PATH.'php_hook_'.$zoneName.'.php';

        if(!file_exists($savePath))
        {
            
            $db=new Database();

            $loadData=$db->query("select * from bb_html_global_data where html_c='".$zoneName."'"); 
                
            // if(!is_array($loadData) || count($loadData)==0)
            // {
            //     return false;
            // }

            if(count($loadData) > 0)
            {
                create_file($savePath,stripslashes($loadData[0]['content']));
            }
            else
            {
                create_file($savePath,'');
            }

            
        }

        require_once($savePath);

    }

    public static function clear($zoneName='')
    {
        $savePath=BB_CACHES_PATH.'php_hook_'.$zoneName.'.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }
}