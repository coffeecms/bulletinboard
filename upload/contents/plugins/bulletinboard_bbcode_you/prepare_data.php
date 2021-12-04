<?php

function bb_bbcode_you_prepare_content($content)
{

    $parseData=parse_shortcode_data('you',$content);

    if(count($parseData) > 0)
    {
        $content=str_replace('[you]',Configs::$_['user_data']['username'],$content);
    }


    return $content;
}