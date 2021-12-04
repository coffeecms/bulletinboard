<?php

function bb_bbcode_random_prepare_content($content)
{

    $parseData=parse_shortcode_data('random',$content);

    if(count($parseData) > 0)
    {
        $total=count($parseData);

        $splitLines=[];

        for ($i=0; $i < $total; $i++) { 
            $splitLines=explode('::break::',$parseData[$i]['value']);

            shuffle($splitLines);

            $content=str_replace($parseData[$i]['source'],$splitLines[0],$content);
        }
        
    }


    return $content;
}