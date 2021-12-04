<?php

function bb_bbcode_random_number_prepare_content($content)
{

    $parseData=parse_shortcode_data('random_number',$content);

    if(count($parseData) > 0)
    {
        $total=count($parseData);

        for ($i=0; $i < $total; $i++) { 

            if(strlen($parseData[$i]['value']) > 0 && is_numeric($parseData[$i]['value']))
            {
                $parseData[$i]['value']=(int)$parseData[$i]['value'];
            }
            else
            {
                $parseData[$i]['value']=1;
            }
            
            $content=str_replace($parseData[$i]['source'],randNumber($parseData[$i]['value']),$content);
            
        }
        
    }


    return $content;
}