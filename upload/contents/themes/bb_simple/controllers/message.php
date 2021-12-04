<?php

class message
{
	public static function index()
	{

		if(Configs::$_['user_data']['user_id']=='GUEST')
		{
			redirect_to(SITE_URL.'notify/notfound');
		}
		
		if(!isLogined())
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

		BB_Message::updateMessageCountStats(Configs::$_['user_data']['user_id']);
    

		$db=new Database(); 
		$queryStr='';

		$queryStr.="select a.*,b.subject,b.ent_dt,b.username,b.user_id from bb_message_user_data as a ";
		$queryStr.=" left join bb_message_data as b ON a.message_id=b.message_id where a.target_user_id='".Configs::$_['user_data']['user_id']."' order by b.ent_dt desc limit 0,30";

		$theData['listInbox']=$db->query($queryStr);


		$queryStr="select message_id,subject,allow_reply,ent_dt  from bb_message_data ";
		$queryStr.="  where user_id='".Configs::$_['user_data']['user_id']."' AND subject<>'reply'  order by ent_dt desc limit 0,30";

		$theData['listSended']=$db->query($queryStr);

		$total=count($theData['listSended']);

		$receivers='';
		$receivers='';

		$totalRe=0;

		// for ($i=0; $i < $total; $i++) { 

		// 	$theData['listSended'][$i]['receivers']='';
		// 	$loadData=BB_Message::load_receivers($theData['listSended'][$i]['message_id']);

		// 	$totalRe=count($loadData);

		// 	for ($k=0; $k < $totalRe; $k++) { 
		// 		if(isset($loadData[$k]['target_username'][2]))
		// 		{
		// 			$theData['listSended'][$i]['receivers'].=$loadData[$k]['target_username'].',';
		// 		}
				
		// 	}

		// 	if(isset($theData['listSended'][$i]['receivers'][2]))
		// 	{
		// 		$theData['listSended'][$i]['receivers']=substr($theData['listSended'][$i]['receivers'],0,strlen($theData['listSended'][$i]['receivers'])-1);
		// 	}
		// }

		Configs::$_['site_title']='Messages';	


		echo view('header');
		echo view('message',$theData);
		echo view('footer');
	}	
	public static function read()
	{
		
		if(Configs::$_['user_data']['user_id']=='GUEST')
		{
			redirect_to(SITE_URL.'notify/notfound');
		}
		
		if(!isLogined())
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
			'message_id'=>'',
		);



		if(!preg_match('/\/read\-(\d+)$/i',Configs::$_['uri'],$match))
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		BB_Message::updateMessageCountStats(Configs::$_['user_data']['user_id']);
    

		$theData['message_id']=$match[1];

		$page_no=getGet('page','1');


		if(preg_match('/\/page\-(\d+)$/i',Configs::$_['uri'],$match))
		{
			$page_no=$match[1];
		}

		if((int)$page_no<=1)
		{
			$page_no=0;
		}

		$offset=(int)$page_no*10;

		$limitShow=Configs::$_['bb_max_number_posts_show'];
		$theData['page_no']=$page_no;
		$theData['next_page_no']=(int)$page_no+1;
		$theData['prev_page_no']=((int)$page_no==0)?'0':(int)$page_no;

		$db=new Database(); 

		$loadReceiver=$db->query("select * from bb_message_user_data where message_id='".$theData['message_id']."' AND (target_user_id='".Configs::$_['user_data']['user_id']."' OR source_user_id='".Configs::$_['user_data']['user_id']."')");

		if(count($loadReceiver)==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		$db->nonquery("update bb_message_user_data set is_read='1',readed_time=NOW() where message_id='".$theData['message_id']."' AND target_user_id='".Configs::$_['user_data']['user_id']."'");

		BB_Message::updateMessageCountStats(Configs::$_['user_data']['user_id']);
		
		$queryStr='';

		$queryStr.="select a.*,b.username,b.avatar,b.fullname,b.ent_dt as user_ent_dt, ";
		$queryStr.=" c.threads,c.posts,c.reactions,c.total_points,c.signature,d.title as group_title ";
		$queryStr.=" from bb_message_data as a join user_mst as b ON a.user_id=b.user_id ";
		$queryStr.=" join bb_user_data as c ON a.user_id=c.user_id ";
		$queryStr.=" join user_group_mst as d ON b.group_c=d.group_c ";
		$queryStr.="  where a.message_id='".$theData['message_id']."' ";
		// $queryStr.="  where a.message_id='".$theData['message_id']."' AND a.user_id='".Configs::$_['user_data']['user_id']."' ";

		$loadData=$db->query($queryStr);

		if(count($loadData)==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		$theData['message_data']=$loadData[0];

		// print_r($theData['message_data']);die();

		$theData['message_data']['receivers']='';

		$theData['message_data']['receivers']=BB_Message::load_receivers($theData['message_id']);
		$theData['message_data']['attach_files']=BB_Message::load_attach_files($theData['message_id']);

		BB_Message::set_is_read(Configs::$_['user_data']['user_id'],$theData['message_id']);

		// $totalRe=count($loadData);

		// for ($k=0; $k < $totalRe; $k++) { 
		// 	if(isset($loadData[$k]['target_username'][2]))
		// 	{
		// 		$theData['message_data']['receivers'].=$loadData[$k]['target_username'].',';
		// 	}
			
		// }

		// if(isset($theData['message_data']['receivers'][2]))
		// {
		// 	$theData['message_data']['receivers']=substr($theData['message_data']['receivers'],0,strlen($theData['message_data']['receivers'])-1);
		// }

		// print_r($theData['message_data']);die();

		$queryStr='';

		$queryStr.="select a.*,b.username,b.avatar,b.fullname,b.ent_dt as user_ent_dt, ";
		$queryStr.=" c.threads,c.posts,c.reactions,c.total_points,c.signature,d.title as group_title ";
		$queryStr.=" from bb_message_data as a join user_mst as b ON a.user_id=b.user_id ";
		$queryStr.=" join bb_user_data as c ON a.user_id=c.user_id ";
		$queryStr.=" join user_group_mst as d ON b.group_c=d.group_c ";
		$queryStr.="  where a.parent_id='".$theData['message_id']."' ";
		$queryStr.=" order by a.ent_dt asc";
		$queryStr.=" limit ".$offset.",".$limitShow;

		$theData['list_post']=$db->query($queryStr);

		$total=count($theData['list_post']);

		for ($i=0; $i < $total; $i++) { 
			$theData['list_post'][$i]['attach_files']=BB_Message::load_attach_files($theData['list_post'][$i]['message_id']);
		}

		// print_r($theData['list_post']);die();

		echo view('header');
		echo view('read_message',$theData);
		echo view('footer');
	}	
}