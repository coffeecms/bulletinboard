<?php

function bb_save_disallow_words()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

    $bb_disallow_words=trim(addslashes(getPost('bb_disallow_words')));

    $db=new Database(); 

    $db->nonquery("delete from bb_disallow_word_data"); 

    $splitWords=explode(',',$bb_disallow_words);

    $total=count($splitWords);

    $theWord='';

    for ($i=0; $i < $total; $i++) { 

        $theWord=trim($splitWords[$i]);

        if(isset($theWord[1]))
        {
            $insertData=array(
                'word'=>$theWord,
            );
         
            $queryStr=arrayToInsertStr('bb_disallow_word_data',$insertData);
            
            $db->nonquery($queryStr); 
        }

    }

    $savePath=BB_CACHES_PATH.'disallow_words.php';

    if(file_exists($savePath))
    {
        unlink($savePath);
    }
  

   return 'OK';
}
