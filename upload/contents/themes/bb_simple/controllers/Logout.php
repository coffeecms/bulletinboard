<?php

class logout
{
	public static function index()
	{
        //Set cookie
        setcookie('username', '', time()- 360000, '/');
        setcookie('user_id', '', time()- 360000, '/');
        setcookie('group_c', '', time()- 360000, '/');
        setcookie('level_c', '', time()- 360000, '/');

		removeLoginSession();

		redirect_to(SITE_URL);
	}	
}