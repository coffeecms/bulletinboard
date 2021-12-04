<?php

add_hook('bb_prepare_post_content','bb_bbcode_random');
add_hook('bb_prepare_post_content','bb_bbcode_random_number');

function bb_bbcode_random($content)
{
    $filePath=PLUGINS_PATH.'bulletinboard_bbcode_random/prepare_data.php';

    require_once($filePath);

    $content=bb_bbcode_random_prepare_content($content);

    return $content;
}

function bb_bbcode_random_number($content)
{
    $filePath=PLUGINS_PATH.'bulletinboard_bbcode_random/prepare_data_number.php';

    require_once($filePath);

    $content=bb_bbcode_random_number_prepare_content($content);

    return $content;
}


