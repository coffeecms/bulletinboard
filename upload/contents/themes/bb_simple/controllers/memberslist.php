<?php

class memberslist
{
	public static function index()
	{
		// Allow to view member list
		if(!isset(Configs::$_['user_permissions']['BB10018']))
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


		// $db->unsetCache();

		Configs::$_['site_title']='Members';
		echo view('header');
		echo view('memberslist',$theData);
		echo view('footer');
	}	

}