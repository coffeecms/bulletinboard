<?php

class account
{
	public static function index()
	{
		if(Configs::$_['user_data']['user_id']=='GUEST')
		{
			redirect_to(SITE_URL.'notify/notfound');
		}
	
		if(!isLogined())
		{
			redirect_to(SITE_URL);
		}

		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

	

		$db=new Database(); 
		$queryStr='';

		
		// 5 mins
		// $db->setCache(60);


		$queryStr=" select * from bb_user_data where user_id='".Configs::$_['user_data']['user_id']."' ";
		
		$loadData=$db->query($queryStr);

		$theData['bb_user_profile_data']=$loadData[0];

		$queryStr=" select email,fullname from user_mst where user_id='".Configs::$_['user_data']['user_id']."' ";
		
		$loadData=$db->query($queryStr);

		$theData['bb_user_profile_mst']=$loadData[0];

		// $db->unsetCache();

		echo view('header');
		echo view('account',$theData);
		echo view('footer');
	}	
	
}