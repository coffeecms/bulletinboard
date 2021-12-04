<?php


function bb_get_list_message_inbox()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    try {
        isValidAccessAPI();
    } catch (\Exception $e) {
        echo responseData($e->getMessage(),'yes');return false;
    }

    $keywords=addslashes(getPost('keywords',''));
    $start_date=addslashes(getPost('start_date',''));
    $end_date=addslashes(getPost('end_date',''));
    $username=addslashes(getPost('username',''));

    $limit=addslashes(getPost('limit','30'));
    $page_no=addslashes(getPost('page_no','1'));

    if((int)$page_no > 0)
    {
        $page_no=(int)$page_no-1;
    }
    if((int)$page_no<=0)
    {
        $page_no=0;
    }

    $offset=(int)$page_no*30;
  
    $queryStr='';

    $queryStr="select a.*,b.subject,b.ent_dt,b.username,b.user_id from bb_message_user_data as a ";
    $queryStr.=" left join bb_message_data as b ON a.message_id=b.message_id WHERE  CAST(b.ent_dt as date) BETWEEN '".$start_date."' AND '".$end_date."' AND a.target_user_id='".Configs::$_['user_data']['user_id']."' ";


    if(isset($keywords[2]))
    {
        $queryStr.=" AND (b.subject LIKE '%".$keywords."%' OR b.content LIKE '%".$keywords."%') ";
    }

    if(isset($username[1]))
    {
        $queryStr.=" AND b.username='".$username."' ";
    }

    $queryStr.=" order by b.ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);

    return $result;
}
