<?php

class Members
{
	public static function index()
	{
		// if(Configs::$_['user_data']['user_id']=='GUEST')
		// {
		// 	redirect_to(SITE_URL.'notify/notfound');
		// }
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		if(!preg_match('/^profile-(\w+)\.html/i',Configs::$_['uri'],$matches))
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		Configs::$_['page_url']=SITE_URL.Configs::$_['uri'];


		$theData['profile_username']=$matches[1];

		Configs::$_['site_title']=$theData['profile_username'].' profile';	


		// Check username exists ?

		$db=new Database(); 
		$queryStr='';

		// 1 mins
		// $db->setCache(60);

		$queryStr="select a.user_id,a.username,a.last_logined,a.left_str,a.right_str,a.ent_dt as register_dt,a.fullname,a.group_c,a.level_c,b.title as group_title,c.title as level_title ";
		$queryStr.=" from user_mst a left join user_group_mst b ON a.group_c=b.group_c ";
		$queryStr.=" left join user_level_mst c ON a.level_c=c.level_id ";
		$queryStr.=" where a.username='".$theData['profile_username']."' ";
		
		$loadData=$db->query($queryStr);


		$theData['bb_user_profile_mst']=$loadData[0];

		$loadData=$db->query("select * from bb_user_data where user_id='".$theData['bb_user_profile_mst']['user_id']."'");

		$theData['bb_user_profile_data']=$loadData[0];
		
		$queryStr="select title,friendly_url,ent_dt,views ";
		$queryStr.=" from bb_threads_data where user_id='".Configs::$_['user_data']['user_id']."' order by ent_dt desc limit 0,30";

		$theData['listThreads']=$db->query($queryStr);

		$queryStr="select * ";
		$queryStr.=" from activities_data where user_id='".Configs::$_['user_data']['user_id']."' order by ent_dt desc limit 0,30";

		if((int)$theData['bb_user_profile_data']['is_show_activites']==1)
		{
			$theData['listActivities']=$db->query($queryStr);
		}
		else
		{
			$theData['listActivities']=[];
		}

		$queryStr="select a.*,b.username ";
		$queryStr.=" from bb_user_wall_comment_data as a left join user_mst as b ON a.wall_user_id=b.user_id where a.wall_user_id='".$theData['bb_user_profile_mst']['user_id']."' order by a.ent_dt desc limit 0,50";

		$theData['listWallPosts']=$db->query($queryStr);
		
		$theData['follow_data']=$db->query("select * from bb_user_follow_data where user_id='".Configs::$_['user_data']['user_id']."' AND followed_user_id='".$theData['bb_user_profile_mst']['user_id']."'");
		
		$loadData=$db->query("select * from bb_user_follow_data where user_id='".Configs::$_['user_data']['user_id']."'");

		$theData['following_data']=[];
		$total=count($loadData);

		for ($i=0; $i < $total; $i++) { 
			$theData['following_data'][$loadData[$i]['followed_user_id']]='';
		}

		if(Configs::$_['user_data']['user_id']!='GUEST' && (int)Configs::$_['bb_enable_captcha_when_send_wall_message']==1)
		{
			$db->nonquery("delete from bb_captcha_session_data where ent_dt > NOW() - INTERVAL 1 DAY");
			$db->nonquery("delete from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

			if(Configs::$_['bb_system_captcha_method']=='text')
			{
				$theData['captcha_data']=bb_captcha_load_question_text();
			
			}
			elseif(Configs::$_['bb_system_captcha_method']=='image')
			{
				$theData['captcha_data']=BB_Captcha_Image::make(6);
	
			}
		}

		// $db->unsetCache();

		echo view('header');
		echo view('member',$theData);
		echo view('right');
		echo view('footer');
	}	
	
}