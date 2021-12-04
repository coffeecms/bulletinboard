<?php


function bb_get_list_message_sended()
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

    $queryStr="select message_id,subject,allow_reply,ent_dt  from bb_message_data ";
    $queryStr.="  where user_id='".Configs::$_['user_data']['user_id']."' AND CAST(ent_dt as date) BETWEEN '".$start_date."' AND '".$end_date."'";

    if(isset($keywords[2]))
    {
        $queryStr.=" AND (subject LIKE '%".$keywords."%' OR content LIKE '%".$keywords."%') ";
    }

    if(isset($username[1]))
    {
        $queryStr.=" AND username='".$username."' ";
    }

    $queryStr.=" order by ent_dt desc limit ".$offset.",".$limit;

    $db=new Database(); 
    $result=$db->query($queryStr);



    $total=count($result);

    $receivers='';
    $receivers='';

    $totalRe=0;

    for ($i=0; $i < $total; $i++) { 

        $result[$i]['receivers']='';
        $loadData=BB_Message::load_receivers($result[$i]['message_id']);

        $totalRe=count($loadData);

        for ($k=0; $k < $totalRe; $k++) { 
            if(isset($loadData[$k]['target_username'][2]))
            {
                $result[$i]['receivers'].=$loadData[$k]['target_username'].',';
            }
            
        }

        if(isset($result[$i]['receivers'][2]))
        {
            $result[$i]['receivers']=substr($result[$i]['receivers'],0,strlen($result[$i]['receivers'])-1);
        }
    }
    
    return $result;
}
