<?php

function bb_get_list_post_reactions()
{
    //Kiểm tra Cookie, nếu ko đăng nhập thì trả về false
    $cookie_username=isset(Configs::$_['user_data']['user_id'])?Configs::$_['user_data']['user_id']:'';

    if(Configs::$_['user_data']['user_id']=='GUEST')
    {
        echo responseData('{}','no');die();
    }

    $post_id=addslashes(getPost('post_id',''));

    if(!isset($post_id[4]))
    {
        echo responseData('{}','no');die();
    }
   
    $queryStr='';

    $queryStr.="select a.*,c.username,b.image_path,b.title as reaction_title,b.text_color as reaction_color from bb_post_reactions_data as a join bb_reaction_data as b ON a.reaction_id=b.reaction_id  ";
    $queryStr.=" join user_mst as c ON a.user_id=c.user_id  ";
    $queryStr.=" where a.type='post' AND a.post_id='".$post_id."' ";
    $queryStr.=" order by a.ent_dt desc";

    $db=new Database(); 
    $result=$db->query($queryStr);

    echo responseData($result,'no');die();
}