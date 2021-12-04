<?php

class notify
{
	public static function index()
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
		echo view('notify',$theData);
		echo view('footer');
	}	
	public static function nothaspermission()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		echo view('header');
		echo view('notify',$theData);
		echo view('footer');
	}	
	public static function notfound()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	public static function expired()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify_expired',$theData);
		// echo view('footer');
	}	
	public static function permission()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('permission',$theData);
		// echo view('footer');
	}	
	public static function firewall()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	public static function block_ip()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	public static function block_username()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	public static function block_browser()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	public static function block_os()
	{
		
		$theData=array(
			'listCat'=>[],
			'theList'=>[],
			'totalPost'=>0,
			'totalPage'=>0,
			'pages'=>'',
			'alert'=>'',
		);

		header('HTTP/1.1 404 Not found');
		// echo view('header');
		echo view('notify',$theData);
		// echo view('footer');
	}	
	
}