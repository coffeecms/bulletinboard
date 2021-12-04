<?php

// Routes::get('(:word)/(:word)','basic/$1@$2');

if(!function_exists('bb_load_all_forum_data'))
{
    die('You need install bulletinboard!');
}

require_once(THEMES_PATH.'bb_simple/libs.php');

Routes::get('^f-(.*?)_(:num).html','bb_simple/Forum@index');
Routes::get('^t-(.*?)_(:num).html','bb_simple/Threads@index');
Routes::get('^post-(.*?).html','bb_simple/Posts@index');
Routes::get('^profile-(:word).html','bb_simple/Members@index');
Routes::get('^threadreply/thread-(:num)','bb_simple/ThreadReply@index');
Routes::get('^postedit/id-(:num)','bb_simple/PostEdit@index');
Routes::get('^threadedit/id-(:num)','bb_simple/ThreadEdit@index');
Routes::get('^attach_file/file-(:num)','bb_simple/AttachFile@index');
Routes::get('^forgot_password','bb_simple/ForgotPassword@index');

Routes::get('^rss.rss','bb_taurus/xmlcontent@rss');
Routes::get('^sitemap.xml','bb_taurus/xmlcontent@sitemap');

Routes::get('^rss_forum_(:num).rss','bb_taurus/xmlcontent@rss');
Routes::get('^sitemap_forum_(:num).xml','bb_taurus/xmlcontent@sitemap');

Routes::get('(:word)/(:word)','bb_simple/$1@$2');
Routes::get('(:word)','bb_simple/$1@index');

if(isset(Configs::$_['uri'][1]))
{
    redirect_to(SITE_URL.'notify/notfound');
}
Routes::get('','bb_simple/Home@index');
