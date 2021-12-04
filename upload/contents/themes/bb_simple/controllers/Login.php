<?php

class login
{
	public static function index()
	{
		
		if(isLogined())
		{
			redirect_to(SITE_URL);
		}
		Configs::$_['page_url']=SITE_URL.'login';


		$db=new Database(); 


		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		if((int)Configs::$_['bb_enable_captcha_in_login']==1)
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

		Configs::$_['site_title']='Login';	
	
		echo view('header');
		echo view('login',$theData);
		echo view('footer');
	}	
}