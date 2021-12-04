<?php

class register
{
	public static function index()
	{
		if(Configs::$_['user_data']['user_id']=='GUEST' && (int)Configs::$_['bb_allow_guest_view_forum']==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}		
		
		// if(Configs::$_['register_user_status']=='no')
		// {
		// 	redirect_to(SITE_URL.'notify/notfound');
		// }



		if(isLogined())
		{
			redirect_to(SITE_URL);
		}

		Configs::$_['page_url']=SITE_URL.'register';



		$db=new Database(); 

		if((int)Configs::$_['bb_enable_captcha_in_register']==1)
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
	
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);



		Configs::$_['site_title']='Register an account';	


		echo view('header');
		echo view('register',$theData);
		echo view('footer');
	}	
}