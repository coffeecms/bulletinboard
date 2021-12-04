<?php


function bb_theme_genListNestedForum($listCategories = array(), $listSubCategories = array()) {

    if(!isset(Configs::$_['list_forum_data']))
    {
        Configs::$_['list_forum_data']=[];
    }

    $result = array();

    $total = count($listCategories);
    // $totalSub = count($listSubCategories);

    for ($i = 0; $i < $total; $i++) {
            array_push(Configs::$_['list_forum_data'], $listCategories[$i]);
            // array_push($result, $listCategories[$i]);

            bb_theme_genListSubNestedForum($listCategories[$i]['forum_id'], $listSubCategories,'-- ');
    
    }

    // return $result;
}

function bb_theme_genListSubNestedForum($forum_id, $listSubCategories = array(),$levelStr='-- ') {

    $total = count($listSubCategories);

    for ($i = 0; $i < $total; $i++) {

        if ($forum_id == $listSubCategories[$i]['parent_id']) {
        
            $listSubCategories[$i]['title']=$levelStr.$listSubCategories[$i]['title'];

            array_push(Configs::$_['list_forum_data'], $listSubCategories[$i]);

            bb_theme_genListSubNestedForum($listSubCategories[$i]['forum_id'],$listSubCategories,$levelStr.'-- ');
        }
    }
}


function user_post_avatar($fullname,$avatar_img='')
{
    $result='';

    if($avatar_img==null)
    {
        $avatar_img='';
    }

    if(!isset($avatar_img[3]))
    {
        $result='<div class="wrap_post_avatar"><span class="avartar-dymamic avartar-dymamic-'.strtolower($fullname[0]).' post-avatar" style="">'.strtoupper($fullname[0]).'</span></div>';
    }
    else
    {
        // <img src="..." class="card-img-top" alt="...">
        $result='<img src="'.SITE_URL.$avatar_img.'" class="card-img-top" alt="'.$fullname[0].'">';
    }


    return $result;
}


function user_home_avatar($fullname,$avatar_img='')
{
    $result='';

    if($avatar_img==null)
    {
        $avatar_img='';
    }

    if(!isset($avatar_img[3]))
    {
        $result='<span class="avartar-dymamic avartar-dymamic-'.strtolower($fullname[0]).'" style="">'.strtoupper($fullname[0]).'</span>';
    }
    else
    {
        // <img src="..." class="card-img-top" alt="...">
        $result='<img src="'.SITE_URL.$avatar_img.'" class="card-img-top" alt="'.$fullname[0].'">';
    }


    return $result;
}

function frontend_menu_hasChild($menu_id)
{
    $total=count(Configs::$_['sub_menu_data']);

    for ($i=0; $i < $total; $i++) { 
        if(Configs::$_['sub_menu_data'][$i]['parent_menu_id']==$menu_id)
        {
            return true;
        }
    }

    return false;
}    

function frontend_menu_allChild($menu_id)
{
    $total=count(Configs::$_['sub_menu_data']);

    $result=array();

    for ($i=0; $i < $total; $i++) { 
        if(Configs::$_['sub_menu_data'][$i]['parent_menu_id']==$menu_id)
        {
            array_push($result, Configs::$_['sub_menu_data'][$i]);
        }
    }

    return $result;
}
