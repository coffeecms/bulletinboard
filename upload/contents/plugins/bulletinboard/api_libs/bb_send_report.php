<?php

function bb_send_report()
{
    
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

//    useClass('EmailSystem');

   $insertData=array(
       'reason'=>addslashes(getPost('reason')),
       'type'=>addslashes(getPost('type')),
       'url'=>addslashes(getPost('url')),
       'title'=>addslashes(getPost('title')),
       'reason'=>addslashes(getPost('reason')),
       'target_id'=>addslashes(getPost('target_id')),
       'user_id'=>Configs::$_['user_data']['user_id']
   );

   $db=new Database(); 

   $queryStr=arrayToInsertStr('bb_report_page_data',$insertData);
   
   $db->nonquery($queryStr);   

   return 'OK';
}
