<?php

class Forum
{
	public static function index()
	{
		if(Configs::$_['user_data']['user_id']=='GUEST' && (int)Configs::$_['bb_allow_guest_view_forum']==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		if(!preg_match('/f\-(.*?)\.html/i',Configs::$_['uri'],$match))
		{
			// redirect to 404 page
			redirect_to(SITE_URL.'notify/notfound');
		}

		Configs::$_['page_url']=SITE_URL.Configs::$_['uri'];

		Configs::$_['list_forums']=[];

	
		$friendly_url=$match[1];

		$theData['forum_id']=bb_load_forum_data_by_friendly_url($friendly_url);


		// Check Member && GUEST can view forum or not ?

		if(bb_forum_has_permission($theData['forum_id'],'BB10001')==false || bb_forum_has_permission($theData['forum_id'],'BB20001')==true)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}


		$db=new Database(); 

		// bb_gen_breadcum_forum_data($theData['forum_id'],$listForums);
		bb_gen_breadcum_forum_data_global($theData['forum_id']);


		$queryStr='';


		$theData['listPinThread']=BB_Forum::load_pin_threads($theData['forum_id']);
		$theData['listAdsThread']=BB_Forum::load_ads_threads($theData['forum_id']);

		// print_r($theData['listAdsThread']);die();

		$queryStr='';

		$queryStr.="select a.status,a.thread_id,a.forum_id,a.prefix_id,b.title as prefix_title,b.bg_color_c as prefix_bg_color,";
		$queryStr.=" c.username,c.fullname,c.avatar,a.title,a.views,a.total_replies,a.author,a.last_repy_time,a.last_username_reply,a.friendly_url,a.ent_dt,a.upd_dt ";
		$queryStr.=" from bb_threads_data as a";
		$queryStr.=" join bb_post_prefix_data as b ON a.prefix_id=b.prefix_id";
		$queryStr.=" join user_mst as c ON a.user_id=c.user_id where a.forum_id='".$theData['forum_id']."' AND a.is_stick='0' ";

		if(bb_forum_has_permission($theData['forum_id'],'BB10008')==false && bb_forum_has_permission($theData['forum_id'],'BB10010')==false){
			$queryStr.=" AND a.status='1'";
		}

		$queryStr.=" order by upd_dt desc limit 0,30";

		$theData['listThread']=$db->query($queryStr);

		// print_r($queryStr);die();

		bb_load_all_post_prefix();

		BB_Annoucement::load();
		
		$listForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')='' order by sort_order asc");
		$listSubForums=$db->query("select * from bb_forum_data where ifnull(parent_id,'')<>'' order by parent_id,sort_order asc");
	
		$theData['listForums']=bb_genListNestedForum($listForums,$listSubForums);

		Configs::$_['site_title']=Configs::$_['forum_'.$theData['forum_id']]['title'];	

		echo view('header');
		echo view('forums',$theData);
		echo view('right');
		echo view('footer');
	}	
}