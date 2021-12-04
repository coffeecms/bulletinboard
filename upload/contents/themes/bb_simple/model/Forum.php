<?php

function bb_genListNestedForum($listCategories=array(),$listSubCategories=array())
{

    $result=array();

    $total=count($listCategories);
    $totalSub=count($listSubCategories);

    for ($i=0; $i < $total; $i++) { 
        if($listCategories[$i]['parent_id']==null || strlen($listCategories[$i]['parent_id'])==0)
        {
            array_push($result,$listCategories[$i]);
        }
        
        for ($j=0; $j < $totalSub; $j++) { 
            if($listCategories[$i]['forum_id']==$listSubCategories[$j]['parent_id'])
            {
                $listSubCategories[$j]['title']='Sub -> '.$listSubCategories[$j]['title'];

                array_push($result,$listSubCategories[$j]);
            }
        }
    }

    return $result;
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


