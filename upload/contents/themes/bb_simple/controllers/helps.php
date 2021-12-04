<?php

class helps
{
	public static function index()
	{
		redirect_to(SITE_URL.'notify/notfound');
	}	
	public static function bbcode()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		echo view('header');
		echo view('help_bbcode',$theData);
		echo view('footer');
	}	
	public static function terms()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		echo view('header');
		echo view('help_terms',$theData);
		echo view('footer');
	}	

	
}