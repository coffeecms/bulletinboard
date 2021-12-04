<?php

class BB_Smiles
{
    public static function clearCache()
    {
        $categoryPath=BB_CACHES_PATH.'smiles_categories.php';
        $smilesPath=BB_CACHES_PATH.'smiles_list.php';
        
        if(file_exists($categoryPath))
        {
            unlink($categoryPath);
        }

        if(file_exists($smilesPath))
        {
            unlink($smilesPath);
        }
    }
    
    public static function load()
    {
        Configs::$_['list_smiles_categories']=[];
        Configs::$_['list_smiles']=[];
        
        $categoryPath=BB_CACHES_PATH.'smiles_categories.php';
        $smilesPath=BB_CACHES_PATH.'smiles_list.php';

       
        $db=new Database();

        if(!file_exists($categoryPath))
        {
            
            $queryStr='';

            $loadData=$db->query("select * from bb_smiles_category_data where status='1' order by sort_order asc"); 
                
            if(count($loadData) > 0)
            {
                create_file($categoryPath,"<?php Configs::\$_['list_smiles_categories']='".json_encode($loadData)."';");
            }

            
        }

        if(!file_exists($smilesPath))
        {
            
            $queryStr='';

            $queryStr=" select a.*,b.title as category_title";
            $queryStr.=" from bb_smiles_data as a";
            $queryStr.=" join bb_smiles_category_data as b ON a.category_id=b.category_id";
            $queryStr.=" where b.status='1' order by a.category_id,a.sort_order asc";

            $loadData=$db->query($queryStr); 
                
            if(count($loadData) > 0)
            {
                create_file($smilesPath,"<?php Configs::\$_['list_smiles']='".json_encode($loadData)."';");
            }

            
        }

        require_once($categoryPath);
        require_once($smilesPath);

        Configs::$_['list_smiles_categories']=json_decode(Configs::$_['list_smiles_categories'],true);        
        Configs::$_['list_smiles']=json_decode(Configs::$_['list_smiles'],true);        
    }

    public static function replace_content($inputStr='')
    {
        if(!isset($inputStr[2]))
        {
            return $inputStr;
        }

        if(!isset(Configs::$_['list_smiles']))
        {
            self::load();
        }

        // print_r(Configs::$_['list_smiles']);die();
        

        $total=count(Configs::$_['list_smiles']);

        $replaces=[];

        for ($i=0; $i < $total; $i++) { 
            $replaces[Configs::$_['list_smiles'][$i]['text_replace']]='<img src="'.SITE_URL.Configs::$_['list_smiles'][$i]['image_path'].'" />';
        }

        $inputStr=str_replace(array_keys($replaces),array_values($replaces),$inputStr);

        return $inputStr;
    }

}