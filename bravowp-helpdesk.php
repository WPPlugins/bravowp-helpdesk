<?php

	/**
	 * @package BravoWP-Helpdesk
	 * @version 2.0.9
	 */
	/*
	Plugin Name: BravoWP's Helpdesk
	Plugin URI: http://wordpress.org/plugins/BravoWP-Helpdesk
	Description: An Helpdesk plugin for Wordpress
	Author: BravoWP.com
	Version: 2.0.9
	Author URI: http://www.BravoWP.com/
	*/
	 


	//-------- Including files ----------

		//Globals
		include('business-logic/globals.php');

		//Utils
		include('business-logic/utilities.php');
		include('utils/logger.php');
		include('business-logic/install.php');

		//Controllers
		include('controllers/ticket-controller.php');
		include('controllers/status-controller.php');
		include('controllers/categories-controller.php');
		include('controllers/messages-controller.php');
		include('controllers/customers-controller.php');

		//Helpers
		include('business-logic/resources.php');
		include('business-logic/placeholders.php');

		//Ajax
		include('ajax/ajax-admin-dashboard.php');
		include('ajax/ajax-frontend.php');
		include('business-logic/ajaxresponse.php');


	//-------- Including files ----------


	//-------- Installation/Update --------------

		add_action( 'plugins_loaded', 'bwhd_install_dbobjects' );
		
	//-------- Installation/Update --------------

	//-------- Hooks ----------
	
		//Adding menu pages in WP dashbaord
		add_action( 'admin_menu', 'bwhd_globals_adddashboardpage' );
		 
	//-------- Hooks ----------


	//-------- Short Codes ----------
	
		//Adding menu pages in WP dashbaord
		add_shortcode( 'bravowp-helpdesk-frontend', 'bwhd_globals_includefrontendpage' );
		 
	//-------- Short Codes ----------


	//-------- Adding Languages ----------
	
		load_plugin_textdomain('bravowp-helpdesk', false, dirname(plugin_basename(__FILE__)) . '/languages/');
		 
	//-------- Adding Languages ----------



	 
 ?>