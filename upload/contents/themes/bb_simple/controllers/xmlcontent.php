<?php

class xmlcontent
{
	public static function index()
	{
		die('NOTFOUND');
	}	
	public static function rss()
	{
		$forum_id='';

		$match=[];

		if(!preg_match('/rss\.rss/i',Configs::$_['uri'],$match) && !preg_match('/rss_forum_(\d+)\.rss/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}		

		if(count($match) > 1)
		{
			$forum_id=$match[1];
		}

        BB_System::rss_create_forum_id($forum_id);		
		
	}	
	public static function sitemap()
	{
		$forum_id='';

		$match=[];

		if(!preg_match('/sitemap\.xml/i',Configs::$_['uri'],$match) && !preg_match('/sitemap_forum_(\d+)\.xml/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}		

		if(count($match) > 1)
		{
			$forum_id=$match[1];
		}

        BB_System::sitemap_create_forum_id($forum_id);		
		
		
	}	
	
	
}