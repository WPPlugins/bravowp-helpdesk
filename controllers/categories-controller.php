<?php


	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}


	//gets a list of categories for tickets
	function bwhd_controllers_categories_list() 
	{

		$array_return = array();
		
		$category_info = new stdClass();
		$category_info->category_id = '1';
		$category_info->category_description = __('Pre-Sale Question', "bravowp-helpdesk");
		array_push($array_return, $category_info);

		$category_info = new stdClass();
		$category_info->category_id = '2';
		$category_info->category_description = __('Support on Product', "bravowp-helpdesk");
		array_push($array_return, $category_info);

		$category_info = new stdClass();
		$category_info->category_id = '3';
		$category_info->category_description = __('Generic Enquiry', "bravowp-helpdesk");
		array_push($array_return, $category_info);

		return $array_return;
	   
	}



?>