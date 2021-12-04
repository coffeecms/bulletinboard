<?php

class Threads
{


	public static function index()
	{
		
		if(!preg_match('/t\-.*?\_(\d+)\.html/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}

		if(Configs::$_['user_data']['user_id']=='GUEST' && (int)Configs::$_['bb_allow_guest_view_forum']==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		$thread_id=$match[1];

		// print_r(Configs::$_['user_data']);die();


		$db=new Database(); 

		$page_no=getGet('page','1');

		$post_id='';
		
		if(preg_match('/\/post\-(\d+)$/i',Configs::$_['uri'],$match))
		{
			$post_id=$match[1];

			$loadPageOfPost=$db->query("select count(*)/10 as total from bb_posts_data where thread_id='".$thread_id."' AND ent_dt < (select ent_dt from bb_posts_data where post_id='".$post_id."')");

			$page_no=(float)$loadPageOfPost[0]['total']<1?'1':(int)$loadPageOfPost[0]['total'];

			// if((float)$page_no > (int)$page_no)
			// {
			// 	$page_no=(int)$page_no+1;
			// }

			// print_r((int)$page_no);die();
			
		}

		Configs::$_['page_url']=SITE_URL.Configs::$_['uri'];

		if(preg_match('/\/page\-(\d+)$/i',Configs::$_['uri'],$match))
		{
			$page_no=$match[1];
		}

		$page_no=(int)$page_no-1;

		// if((int)$page_no > 0)
		// {
		// 	$page_no=(int)$page_no-1;
		// }
		if((int)$page_no<0)
		{
			$page_no=0;
		}

		$offset=(int)$page_no*10;

		$limitShow=Configs::$_['bb_max_number_posts_show'];

		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		$theData['thread_id']=$thread_id;

		if((int)$page_no==0)
		{
			$page_no=1;
		}

		$theData['post_id']=$post_id;
		$theData['page_no']=$page_no;
		$theData['next_page_no']=(int)$page_no+1;
		$theData['prev_page_no']=(int)$page_no-1;

		BB_Annoucement::load();

		BB_Reactions::load();

		BB_UserRanks::load();


		$queryStr='';
		// 30 seconds
		// $db->setCache(30);



		$queryStr=" select a.*,b.title as forum_title,b.friendly_url as forum_friendly_url,c.title as prefix_title,c.bg_color_c as prefix_bg_color_c,";
		$queryStr.=" e.username,e.fullname,e.group_c,d.total_points,d.balance,d.reputation,e.last_logined,e.ent_dt as user_ent_dt,d.posts,d.threads,e.avatar,d.reactions,d.created_message,";
		$queryStr.=" d.total_followers,d.total_follows,d.last_user_online,d.birthday,d.signature,d.gender,d.phone1,d.icq,d.aim,d.skype,d.facebook,d.twitter,";
		$queryStr.=" h.title as group_title";
		$queryStr.=" from bb_threads_data as a";
		$queryStr.=" join bb_forum_data as b ON a.forum_id=b.forum_id";
		$queryStr.=" join bb_user_data as d ON a.user_id=d.user_id";
		$queryStr.=" join user_mst as e ON a.user_id=e.user_id";
		$queryStr.=" join user_group_mst as h ON e.group_c=h.group_c";
		$queryStr.=" join bb_post_prefix_data as c ON a.prefix_id=c.prefix_id";
		$queryStr.=" where a.thread_id='".$thread_id."'";


		$loadData=$db->query($queryStr);

		if(count($loadData) == 0)
		{
			redirect_to(SITE_URL.'notify/notfound');			
		}

		Configs::$_['thread_data']=$loadData[0]; 
		Configs::$_['site_title']=$loadData[0]['title']; 


		// $listForums = $db->query("select forum_id,title,parent_id,friendly_url from bb_forum_data ");

		// bb_gen_breadcum_forum_data($loadData[0]['forum_id'],$listForums);
		bb_gen_breadcum_forum_data_global($loadData[0]['forum_id']);

		// BB_Forum::updateStats(Configs::$_['thread_data']['forum_id']);die();

		Configs::$_['thread_data']['content']=BB_System::render_post_content(Configs::$_['thread_data']['content'],Configs::$_['thread_data']);

		BB_Threads::add_views($thread_id);

		// Check GUEST can view forum or not ?
		if(bb_forum_has_permission(Configs::$_['thread_data']['forum_id'],'BB10001')==false || bb_forum_has_permission(Configs::$_['thread_data']['forum_id'],'BB20001')==true)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		Configs::$_['thread_data']['attach_files']=BB_Threads::load_attach_files($thread_id);

		// Thread reactions
		$loadData=$db->query("select count(*) as totalReactions from bb_post_reactions_data where post_id='".$thread_id."' and type='thread'");
		
		$theData['totalReactions']=$loadData[0]['totalReactions'];

		$theData['list_thread_reactions']=BB_Reactions::loadTop5ByThreadId($thread_id);

		$theData['user_reaction_on_thread']=$db->query("select a.user_id,a.reaction_id,b.username,c.title,c.image_path from bb_post_reactions_data as a join user_mst as b ON a.user_id=b.user_id join bb_reaction_data as c ON a.reaction_id=c.reaction_id where a.post_id='".$thread_id."' AND a.user_id='".Configs::$_['user_data']['user_id']."' and a.type='thread'");

		$theData['poll_data']=$db->query("select * from bb_poll_data where thread_id='".$thread_id."' and status='1'");
		
		$theData['poll_answer_data']=$db->query("select a.* from bb_poll_answer_data as a join bb_poll_data as b ON a.poll_id=b.poll_id where b.thread_id='".$thread_id."' order by a.sort_order asc");

		$theData['poll_user_answer_data']=[];
		$theData['poll_members_answer_data']=[];

		if(count($theData['poll_data']) > 0)
		{
			$queryStr="select a.*,b.content ";
			$queryStr.=" from bb_poll_member_answer_data as a join bb_poll_answer_data as b ON a.poll_id=b.poll_id AND a.answer_id=b.answer_id";
			$queryStr.=" where a.poll_id='".$theData['poll_data'][0]['poll_id']."' AND a.user_id='".Configs::$_['user_data']['user_id']."' limit 0,1";

			$theData['poll_user_answer_data']=$db->query($queryStr);
	
			$queryStr="select a.answer_id,b.content,count(*) as total ";
			$queryStr.=" from bb_poll_member_answer_data as a join bb_poll_answer_data as b ON a.poll_id=b.poll_id AND a.answer_id=b.answer_id";
			$queryStr.=" where a.poll_id='".$theData['poll_data'][0]['poll_id']."' group by a.answer_id,b.content order by total asc ";

			$theData['poll_members_answer_data']=$db->query($queryStr);
	
		}

		// print_r(Configs::$_);die();

		// End Thread reactions

		// List posts
		$queryStr=" select a.*,c.username,c.fullname,c.group_c,b.total_points,b.balance,b.reputation,c.last_logined,c.ent_dt as user_ent_dt,b.posts,b.threads,c.avatar,b.reactions,b.created_message,";
		$queryStr.=" b.total_followers,b.total_follows,b.last_user_online,b.birthday,b.gender,b.signature,b.phone1,b.icq,b.aim,b.skype,b.facebook,b.twitter, ";
		$queryStr.=" h.title as group_title ";
		$queryStr.=" from bb_posts_data as a join bb_user_data as b ON a.user_id=b.user_id";
		$queryStr.=" join user_mst as c ON a.user_id=c.user_id";
		$queryStr.=" join user_group_mst as h ON c.group_c=h.group_c";
		$queryStr.=" where a.thread_id='".$thread_id."'";
		$queryStr.=" order by a.ent_dt asc";
		$queryStr.=" limit ".$offset.",".$limitShow;

		$theData['list_post']=$db->query($queryStr);

		// Post reactions
		$total=count($theData['list_post']);

		if((int)$total > 0)
		{
			for ($i=0; $i < $total; $i++) { 
				$theData['list_post'][$i]['attach_files']=BB_Threads::load_attach_files($theData['list_post'][$i]['post_id']);
				$theData['list_post'][$i]['list_reactions']=BB_Reactions::loadTop5ByPostId($theData['list_post'][$i]['post_id']);
				$theData['list_post'][$i]['user_reaction_on_post']=$db->query("select a.user_id,a.reaction_id,b.username,c.title,c.image_path from bb_post_reactions_data as a join user_mst as b ON a.user_id=b.user_id join bb_reaction_data as c ON a.reaction_id=c.reaction_id where a.post_id='".$theData['list_post'][$i]['post_id']."' AND a.user_id='".Configs::$_['user_data']['user_id']."' and a.type='post'");

				$theData['list_post'][$i]['content']=BB_System::render_post_content($theData['list_post'][$i]['content'],$theData['list_post'][$i]);

			}			


		}

		if((int)Configs::$_['bb_enable_captcha_quick_reply']==1)
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
		echo view('threads',$theData);
		echo view('right');
		echo view('footer');
	}	
	
}