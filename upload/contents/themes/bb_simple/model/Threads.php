<?php

function user_ranks_render($user_id)
{
    $rankData=BB_UserRanks::load_by_userid($user_id);

    // print_r($rankData);die();

    $total=count($rankData);

    $li='';
    for ($i=0; $i < $total; $i++) { 

        if($rankData[$i]['image']!=null && strlen($rankData[$i]['image']) > 5)
        {
            $li.='<div style="img-fluid"><img class="img-fluid" title="'.$rankData[$i]['title'].'" alt="'.$rankData[$i]['title'].'" src="'.SITE_URL.$rankData[$i]['image'].'"  /></div>';
        }
        else
        {
            $li.='<span class="card-title user-rank-title pointer" title="'.$rankData[$i]['title'].'" style="background-color:'.$rankData[$i]['bg_color_c'].'">'.$rankData[$i]['title'].'</span>';
        }
        
    }

    return $li;
}


function bb_gen_breadcum_forum_data($forum_id,$listCategories=array())
{
    if(!isset(Configs::$_['forum_breadcum_data']))
    {
        Configs::$_['forum_breadcum_data']=[];
    }

    $total=count($listCategories);

    for ($i=0; $i < $total; $i++) { 
        if($forum_id==$listCategories[$i]['forum_id'])
        {
            array_push(Configs::$_['forum_breadcum_data'],$listCategories[$i]);

            bb_gen_breadcum_forum_data($listCategories[$i]['parent_id'],$listCategories);
        }
    }
}


