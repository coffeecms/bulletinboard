<?php

// BB_System::updateStats();
class BB_System
{


    public static function updateStats()
    {
        $db=new Database();

        $queryStr=" update setting_data ";
        $queryStr.=" set key_value=(select count(*) as total from bb_threads_data)  where key_c='bb_total_threads';";

        $queryStr.=" update setting_data ";
        $queryStr.=" set key_value=(select count(*) as total from bb_posts_data)  where key_c='bb_total_post';";

        $queryStr.=" update setting_data ";
        $queryStr.=" set key_value=(select count(*) as total from bb_message_data)  where key_c='bb_total_messages';";

        $queryStr.=" update setting_data ";
        $queryStr.=" set key_value=(select count(*) as total from bb_threads_reactions_data)  where key_c='bb_total_reactions';";

        $queryStr.=" update setting_data ";
        $queryStr.=" set key_value=(select count(*) as total from user_mst)  where key_c='bb_total_users';";

        $queryStr.=" update setting_data ";
        $queryStr.=" set key_value=(select username from user_mst order by ent_dt desc limit 0,1)  where key_c='bb_latest_username';";


        $db->nonquery($queryStr);   

        $savePath=PUBLIC_PATH.'caches/system_setting.php';

        if(file_exists($savePath))
        {
            unlink($savePath);
        }

    }

    
    public static function load_disallow_words()
    {
        // Configs::$_['list_disallow_words']=[];
        
        $savePath=BB_CACHES_PATH.'disallow_words.php';

        if(!file_exists($savePath))
        {

            $db=new Database();

            $loadData=$db->query("select * from bb_disallow_word_data"); 
                
            if(!is_array($loadData) || count($loadData)==0)
            {
                return false;
            }

            $theList=[];

            $total=count($loadData);

            for ($i=0; $i < $total; $i++) { 
                $theList[]=$loadData[$i]['word'];
            }


  
            create_file($savePath,"<?php Configs::\$_['list_disallow_words']='".json_encode($theList)."';");
        }

        require_once($savePath);

        if(!is_array(Configs::$_['list_disallow_words']))
        {
            Configs::$_['list_disallow_words']=json_decode(Configs::$_['list_disallow_words'],true);

        }
        

    }

    public static function load_disallow_username()
    {
        Configs::$_['list_disallow_username_register']=[];
        
        $savePath=BB_CACHES_PATH.'disallow_username.php';

        if(!file_exists($savePath))
        {
            
            $db=new Database();

            $loadData=$db->query("select * from bb_user_disallow_register"); 
                
            if(!is_array($loadData) || count($loadData)==0)
            {
                return false;
            }

            $total=count($loadData);
            $content=[];

            for ($i=0; $i < $total; $i++) { 
               $content[$loadData[$i]['username']]='';
            }

            create_file($savePath,"<?php Configs::\$_['list_disallow_username_register']='".json_encode($content)."';");
        }

        require_once($savePath);

        Configs::$_['list_disallow_username_register']=json_decode(Configs::$_['list_disallow_username_register'],true);

    }

    public static function render_post_content($content,$contentData=[])
    {
        self::load_disallow_words();

        $content=stripslashes($content);

        $total=count(Configs::$_['list_disallow_words']);

        if($total > 0)
        {
            $listKey=array_values(Configs::$_['list_disallow_words']);

            $content=str_replace($listKey,'***',$content);

        }

        // load prepare bbcode data

        $content=load_hook('bb_prepare_post_content',$content,$contentData);
        // load after post content hook

        return $content;
    }

    public static function rss_create_forum_id($forum_id='')
    {
        $savePath='';
        

        if(!isset($forum_id[2]))
        {
            $savePath=BB_CACHES_PATH.'rss.rss';
        }
        else
        {
            $savePath=BB_CACHES_PATH.'rss_forum_'.$forum_id.'.rss';
           
        }

        if(!file_exists($savePath))
        {
            $db=new Database();

            $loadData=[];

            if(!isset($forum_id[2]))
            {
                $loadData=$db->query("select thread_id,title,friendly_url,upd_dt,ent_dt,content from bb_threads_data where is_stick='0' AND forum_id IN (select forum_id from bb_forum_usergroup_permission_data where group_id='".Configs::$_['user_data']['group_c']."') order by upd_dt desc limit 0,20"); 
            }
            else
            {
                $loadData=$db->query("select thread_id,title,friendly_url,upd_dt,ent_dt,content from bb_threads_data where forum_id='".$forum_id."' AND is_stick='0' AND forum_id IN (select forum_id from bb_forum_usergroup_permission_data where group_id='".Configs::$_['user_data']['group_c']."')  order by upd_dt desc limit 0,20"); 
            }
            

            $li='';

            $total=count($loadData);

            $news_content='';

            for ($i=0; $i < $total; $i++) { 

                $news_content='';

                if(isset($loadData[$i]['content'][5]))
                {
                    // $news_content=stripslashes($loadData[$i]['content']);
                    // $news_content=split_limit_words($loadData[$i]['content'],Configs::$_['bb_news_content_max_len']);
                    
                    $news_content=split_limit_words(BB_System::render_post_content(stripslashes($loadData[$i]['content']),$loadData[$i]),Configs::$_['bb_news_content_max_len']);
                }

                $li.='
                    <item>
                    <title>'.$loadData[$i]['title'].'</title>
                    <pubDate>'.date("D, d M Y H:i:s T", strtotime($loadData[$i]['ent_dt'])).'</pubDate>
                    <link>'.thread_url($loadData[$i]['friendly_url']).'</link>
                    <guid>'.thread_url($loadData[$i]['friendly_url']).'</guid>
                    <author>'.SITE_URL.'</author>
                    <category domain="'.SITE_URL.'"><![CDATA['.Configs::$_['site_title'].']]></category>
                    <content:encoded><![CDATA['.$news_content.']]></content:encoded>
                    <slash:comments>0</slash:comments>
                    </item>
                  ';
            }
            
            $li= '<?xml version="1.0" encoding="utf-8"?>
                <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
                <channel>
                <pubDate>'.date("D, d M Y H:i:s T", time()).'</pubDate>
                <lastBuildDate>'.date("D, d M Y H:i:s T", time()).'</lastBuildDate>
                <generator>'.Configs::$_['site_title'].'</generator>                
                <title>'.Configs::$_['site_title'].'</title>
                <link>'.SITE_URL.'</link>
                <atom:link rel="self" type="application/rss+xml" href="'.SITE_URL.'rss.rss"/>
                <description>'.str_replace('&nbsp;','',stripslashes(strip_tags((htmlspecialchars_decode(Configs::$_['site_description']))))).'</description>
                '.$li.'
                </channel>                  
                </rss>
            ';

            create_file($savePath,$li);
 
        }

        header('Content-type: application/xml; charset=utf-8');

        $content=file_get_contents($savePath);
        echo trim($content);
        die();  

    }

    public static function sitemap_create_forum_id($forum_id='')
    {
        $savePath='';
        $saveTxtPath='';
        $listUrl='';

        if(!isset($forum_id[2]))
        {
            $savePath=BB_CACHES_PATH.'sitemap.xml';
            $saveTxtPath=ROOT_PATH.'sitemap.txt';

        }
        else
        {
            $savePath=BB_CACHES_PATH.'sitemap_forum_'.$forum_id.'.xml';
            $saveTxtPath=ROOT_PATH.'sitemap_forum_'.$forum_id.'.txt';
           
        }

        if(!file_exists($savePath))
        {
            $db=new Database();

            if(!isset($forum_id[2]))
            {
                $loadData=$db->query("select thread_id,title,friendly_url,upd_dt,ent_dt from bb_threads_data order by upd_dt desc limit 0,1000"); 
            }
            else
            {
                $loadData=$db->query("select thread_id,title,friendly_url,upd_dt,ent_dt from bb_threads_data where forum_id='".$forum_id."' order by upd_dt desc limit 0,1000"); 
            }

            $li='';

            $total=count($loadData);

            for ($i=0; $i < $total; $i++) { 
                $li.='
                 <url>
                  <loc>'.thread_url($loadData[$i]['friendly_url']).'</loc>
                  <lastmod>'.date('Y-m-d',strtotime($loadData[$i]['upd_dt'])).'</lastmod>
                 </url>                  
                ';

                $listUrl.=thread_url($loadData[$i]['friendly_url'])."\r\n";
            }

            $li='<?xml version="1.0" encoding="UTF-8"?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                    '.$li.'
                </urlset>';

            create_file($savePath,$li);

            create_file($saveTxtPath,$listUrl);

        }

        header('Content-type: application/xml; charset=utf-8');

        $content=file_get_contents($savePath);
        echo trim($content);
        die();        
    }

    public static function rss_clear_forum_id($forum_id='')
    {
        $savePath='';

        if(!isset($forum_id[2]))
        {
             $savePath=BB_CACHES_PATH.'rss.rss';

        }
        else
        {
             $savePath=BB_CACHES_PATH.'rss_forum_'.$forum_id.'.rss';
           
        }

        if(file_exists($savePath))
        {
            unlink($savePath);
        }
    }

    public static function sitemap_clear_forum_id($forum_id='')
    {
        $savePath='';
        $saveTxtPath='';

        if(!isset($forum_id[2]))
        {
            $savePath=BB_CACHES_PATH.'sitemap.xml';
            $saveTxtPath=ROOT_PATH.'sitemap.txt';

        }
        else
        {
            $savePath=BB_CACHES_PATH.'sitemap_forum_'.$forum_id.'.xml';
            $saveTxtPath=ROOT_PATH.'sitemap_forum_'.$forum_id.'.txt';
         
        }


        if(file_exists($savePath))
        {
            unlink($savePath);
        }

        if(file_exists($saveTxtPath))
        {
            unlink($saveTxtPath);
        }
    }


}