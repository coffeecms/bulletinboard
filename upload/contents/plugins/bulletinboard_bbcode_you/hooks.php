<?php

add_hook('bb_prepare_post_content','bb_bbcode_you');

function bb_bbcode_you($content)
{
    $filePath=PLUGINS_PATH.'bulletinboard_bbcode_you/prepare_data.php';

    require_once($filePath);

    $content=bb_bbcode_you_prepare_content($content);

    return $content;
}


