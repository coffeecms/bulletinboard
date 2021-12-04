<?php

class Home
{
	public static function index()
	{
		if(Configs::$_['user_data']['user_id']=='GUEST' && (int)Configs::$_['bb_allow_guest_view_forum']==0)
		{
			redirect_to(SITE_URL.'notify/notfound');
		}

		// BB_System::updateStats();

		Configs::$_['page_url']=SITE_URL;

		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		BB_Annoucement::load();
		bb_load_all_forum_data();

		echo view('header');
		echo view('home',$theData);
		echo view('right');
		echo view('footer');
	}	

}