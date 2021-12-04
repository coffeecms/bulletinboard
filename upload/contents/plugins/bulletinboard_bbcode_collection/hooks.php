<?php

add_hook('bb_prepare_post_content','bb_bbcode_collection');
add_hook('bb_top_new_thread_page','bb_bbcode_collection_js');

function bb_bbcode_collection($content,$contentData=[])
{
    $filePath=PLUGINS_PATH.'bulletinboard_bbcode_collection/prepare_data.php';

    require_once($filePath);

    $content=bb_bbcode_collection_prepare_content($content,$contentData);

    return $content;
}

function bb_bbcode_collection_js()
{
    $filePath=PLUGINS_PATH.'bulletinboard_bbcode_collection/prepare_data_js.php';

    require_once($filePath);
}


