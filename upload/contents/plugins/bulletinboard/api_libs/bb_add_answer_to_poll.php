<?php

function bb_add_answer_to_poll()
{
     
   $username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

   $answer=addslashes(getPost('answer'));
   $poll_id=addslashes(getPost('poll_id'));
   if(!isset($poll_id[2]))
   {
       return 'Poll not valid';
   }

   if(!isset($answer[6]))
   {
       return 'Answer not valid!';
   }

   $splitAnswer=explode('|||',$answer);

   $total=count($splitAnswer);

   $db=new Database(); 

   $isGuest=0;

   if(Configs::$_['user_data']['user_id']=='GUEST')
   {
    $isGuest=1;
   }

   $pollData=$db->query("select * from bb_poll_data where poll_id='".$poll_id."' AND status='1' AND end_dt>='".date('Y-m-d')."'");

   if(count($pollData)==0)
   {
       return 'Poll not valid!';
   }

//    return "select count(*) as total from bb_poll_member_answer_data where poll_id='".$poll_id."' and user_id='".Configs::$_['user_data']['user_id']."'";

   $pollUserAnswerData=$db->query("select count(*) as total from bb_poll_member_answer_data where poll_id='".$poll_id."' and user_id='".Configs::$_['user_data']['user_id']."'");

   $pollAnswerData=$db->query("select * from bb_poll_answer_data where poll_id='".$poll_id."'");


   if($pollData[0]['poll_choice']=='unique' && (int)$pollData[0]['allow_change_answer']==0 && (int)$pollUserAnswerData[0]['total'] > 0 )
   {
        return '[Unique] - This poll disallow multiple answer.';
   }
   if($pollData[0]['poll_choice']=='multi' && (int)$pollUserAnswerData[0]['total']>=count($pollAnswerData) )
   {
        return '[Multi] - This poll disallow multiple answer.';
   }
   
   if($pollData[0]['poll_choice']=='max' && (int)$pollUserAnswerData[0]['total']>=(int)$pollData[0]['poll_choice_max'] )
   {
        return '[Max] - This poll disallow multiple answer.';
   }

   $db->nonquery("delete from bb_poll_member_answer_data where poll_id='".$poll_id."' and user_id='".Configs::$_['user_data']['user_id']."'");
        
   for ($i=0; $i < $total; $i++) { 

    if(strlen($splitAnswer[$i]) > 2)
    {
        $insertData=array(
            'visitor_hash'=>Configs::$_['visitor_data']['session_id'],
            'poll_id'=>$poll_id,
            'answer_id'=>$splitAnswer[$i],
            'ip_address'=>Configs::$_['visitor_data']['ip'],
            'user_agent'=>Configs::$_['visitor_data']['user_agent'],
            'is_guest'=>$isGuest,
            'user_id'=>Configs::$_['user_data']['user_id'],
        );
    
        $queryStr=arrayToInsertStr('bb_poll_member_answer_data',$insertData);
    
        $db->nonquery($queryStr);
    }
          
   }

    return 'OK';
}