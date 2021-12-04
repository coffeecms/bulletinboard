<?php 

function bb_get_license()
{
	echo responseData(Configs::$_['bb_license_key'],'no');die();
}