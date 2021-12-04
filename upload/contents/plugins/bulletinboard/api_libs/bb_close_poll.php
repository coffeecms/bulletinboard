<?php

function bb_close_poll()
{
     
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

   $poll_id=addslashes(getPost('poll_id'));
   if(!isset($poll_id[2]))
   {
       return 'Poll not valid';
   }

   $db=new Database(); 

   $pollData=$db->query("select * from bb_poll_data where poll_id='".$poll_id."' AND status='1' and user_id='".Configs::$_['user_data']['user_id']."' AND end_dt>='".date('Y-m-d')."'");

   if(count($pollData)==0)
   {
       return 'Poll not valid!';
   }

   $db->nonquery("update bb_poll_data set end_dt='".date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'))."' where poll_id='".$poll_id."'");
  
    return 'OK';
}