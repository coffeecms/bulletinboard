<?php

// $inputData['payment_method']=$payment_method;
// $inputData['trans_id']=$trans_id;
// $inputData['user_id']=$user_id;
// $inputData['amount']=$amount;

function bb_payment_process($inputData=[])
{
	$group_c=trim(addslashes(getGet('group_c','')));

	if(!isset($group_c[2]))
	{
		echo responseData('ERROR_1','yes');die();
	}

	
}