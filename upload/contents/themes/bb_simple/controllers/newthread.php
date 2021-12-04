<?php

class newthread
{
	public static function index()
	{

		if(Configs::$_['user_data']['user_id']=='GUEST')
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

		$theData['forum_id']=trim(getGet('forum_id',''));

		if(strlen($theData['forum_id'])==0)
		{
			redirect_to(SITE_URL);
		}

		bb_load_forum_data_by_id($theData['forum_id']);

		// print_r($theData['forum_id']);die();
		$theData['forum_data']=Configs::$_['forum_'.$theData['forum_id']];

		bb_gen_breadcum_forum_data_global($theData['forum_id']);


		// print_r($theData['forum_id']);die();

		// Configs::$_['list_post_prefix']
		bb_load_all_post_prefix();

		BB_Smiles::load();

		$db=new Database(); 

		if((int)Configs::$_['bb_enable_captcha_in_new_thread']==1)
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

		Configs::$_['site_title']='New Thread';	


		echo view('header');
		echo view('new_thread',$theData);
		echo view('footer');
	}	
	
}