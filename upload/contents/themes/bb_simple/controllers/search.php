<?php

class search
{
	public static function index()
	{

		if(Configs::$_['user_data']['user_id']=='GUEST' && (int)Configs::$_['bb_allow_guest_view_forum']==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		Configs::$_['page_url']=SITE_URL.'search';

		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		$keywords=getPost('keywords','');

		$theData['keywords']=$keywords;

		bb_load_all_post_prefix();

		$db=new Database(); 

		
		$queryStr="select distinct a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
		$queryStr.=" c.username,c.fullname,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt ";
		$queryStr.=" from bb_threads_data as a";
		$queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
		$queryStr.=" join user_mst as c ON a.user_id=c.user_id";
		$queryStr.="  WHERE  (a.title LIKE '%".$keywords."%' OR a.content LIKE '%".$keywords."%') ";
	
		$theData['listThread']=$db->query($queryStr);

		Configs::$_['site_title']='Search';	

		echo view('header');
		echo view('search',$theData);
		echo view('right');
		echo view('footer');
	}	

}