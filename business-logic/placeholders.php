<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}


	//Used to display the "no data because no addon"
	function bwhd_placeholders_nodatanoaddon()
	{

		return __("No data (add on not installed)", "bravowp-helpdesk");

	}


	//Used in admin dashboard to render the "coming soon" panel
	function bwhd_placeholders_comingsoonpanel()
	{


		$content = "";

		$content .= "<div class='text-center'>";
		$content .= "	<i class='fa fa-clock-o' style='font-size: 70px;color:#adadad !important;'></i>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='font-size:20px;margin-top:10px;display:block;'>" . __("Coming Soon!", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='color:#adadad !important;margin-top:10px;display:block;'>" . __("This feature will be soon ready. Please check www.bravowp.com for more information.", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "</div>";

		return $content;

	}


	//Used to display the "feature available as add-on"
	function bwhd_placeholders_addonavailable()
	{


		$content = "";

		$content .= "<div class='text-center'>";
		$content .= "	<i class='fa fa-download' style='font-size: 50px;color:#adadad !important;'></i>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='font-size:20px;margin-top:10px;display:block;'>" . __("Add-on Available!", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='color:#adadad !important;margin-top:10px;display:block;'>" . __("This feature is available as an add-on. Please visit www.bravowp.com for more information.", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "</div>";

		return $content;

	}

	//Used in admin dashboard chart to render the "no data" panel
	function bwhd_placeholders_dashboardchartnodata()
	{

		$content = "";

		$content .= "<div class='text-center'>";
		$content .= "	<i class='fa fa-clock-o' style='font-size: 30px;color:#adadad !important;'></i>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='font-size:14px;margin-top:10px;display:block;'>" . __("No data to show at this time.", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "</div>";

		return $content;

	}


	//Used in admin dashboard last 5 tickets to render the "no data" panel
	function bwhd_placeholders_dashboardlastfiveticketsnodata()
	{

		$content = "";

		$content .= "<div class='text-center'>";
		$content .= "	<i class='fa fa-clock-o' style='font-size: 30px;color:#adadad !important;'></i>";
		$content .= "	<div class='clear'></div>";
		$content .= "	<span style='font-size:14px;margin-top:10px;display:block;'>" . __("No data to show at this time.", "bravowp-helpdesk") . "</span>";
		$content .= "	<div class='clear'></div>";
		$content .= "</div>";

		return $content;

	}





?>