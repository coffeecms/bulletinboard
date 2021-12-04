<?php

function bb_refresh_captcha()
{
	$result='
		<img src="'.BB_Captcha_Image::make(6).'" style="margin:0px;padding:0px;" />
		                              <span class="btn btn-success btn-refresh-captcha" title="Refresh" style="position: absolute;right:15px;top:22px;"><i class="fa fa-sync"></i></span>
	';

	echo responseData($result,'no');die();
}