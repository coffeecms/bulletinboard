<?php

function bb_genListNestedForum($listCategories = array(), $listSubCategories = array()) {

	if(!isset(Configs::$_['list_forum_data']))
	{
		Configs::$_['list_forum_data']=[];
	}

	$result = array();

	$total = count($listCategories);
	// $totalSub = count($listSubCategories);

	for ($i = 0; $i < $total; $i++) {
			array_push(Configs::$_['list_forum_data'], $listCategories[$i]);
			// array_push($result, $listCategories[$i]);

			bb_genListSubNestedForum($listCategories[$i]['forum_id'], $listSubCategories,'-- ');
	
	}

	// return $result;
}

function bb_genListSubNestedForum($forum_id, $listSubCategories = array(),$levelStr='-- ') {

	$total = count($listSubCategories);

	for ($i = 0; $i < $total; $i++) {

		if ($forum_id == $listSubCategories[$i]['parent_id']) {
		
			$listSubCategories[$i]['title']=$levelStr.$listSubCategories[$i]['title'];

			array_push(Configs::$_['list_forum_data'], $listSubCategories[$i]);

			bb_genListSubNestedForum($listSubCategories[$i]['forum_id'],$listSubCategories,$levelStr.'-- ');
		}
	}
}
