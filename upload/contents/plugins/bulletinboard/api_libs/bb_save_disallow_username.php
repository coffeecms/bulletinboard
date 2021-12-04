<?php

function bb_save_disallow_username()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    $bb_disallow_username_register=trim(addslashes(getPost('bb_disallow_username_register')));

    $db=new Database(); 

    $db->nonquery("delete from bb_user_disallow_register"); 

    $splitWords=explode(',',$bb_disallow_username_register);

    $total=count($splitWords);

    $theWord='';

    for ($i=0; $i < $total; $i++) { 

        $theWord=trim($splitWords[$i]);

        if(isset($theWord[1]))
        {
            $insertData=array(
                'username'=>$theWord,
            );
         
            $queryStr=arrayToInsertStr('bb_user_disallow_register',$insertData);
            
            $db->nonquery($queryStr); 
        }

    }
  
    $savePath=BB_CACHES_PATH.'disallow_username.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }

   return 'OK';
}
