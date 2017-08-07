<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}




	//defines the globals scope and consts used in the plugin
	function bwhd_globals() 
	{

		//usage example:
		//echo bwhd_globals()->plugin_version;
		
	   static $bwhd_globals_bag;
	   
	   if ( !isset ( $bwhd_globals_bag ) ) 
	   {
	   	
			$bwhd_globals_bag = new stdClass();

			$bwhd_globals_bag -> plugin_version = "2.0.9";
			
			//TO DO description
			$mainPluginFile = dirname(dirname(__FILE__)) . '/bravowp-helpdesk.php';
			$bwhd_globals_bag -> plugin_url = plugin_dir_path($mainPluginFile); 
			
			//TO DO description
			$bwhd_globals_bag -> plugin_httpurl = plugins_url() . '/bravowp-helpdesk';

			//TO DO description
			$bwhd_globals_bag -> loadergif_url = plugins_url() . '/bravowp-helpdesk/images/loader.gif';

			$bwhd_globals_bag -> headerpng_url = plugins_url() . '/bravowp-helpdesk/images/header.png';

			$bwhd_globals_bag -> uploadhandler_url = plugins_url() . '/bravowp-helpdesk-attachments/business-logic/upload-handler.php';		
			$bwhd_globals_bag -> uploadhandler_url_public = plugins_url() . '/bravowp-helpdesk-attachments/business-logic/upload-handler-public.php';		

	    
	   } 
	   
	   return $bwhd_globals_bag;
	   
	}





	//Adding menu page in Wordpress Dashboard, on WP hook (main .php file)
	function bwhd_globals_adddashboardpage() {
		
		add_menu_page( 'Helpdesk', 'BWP Helpdesk', 'manage_options', 'bwhd_helpdesk', 'bwhd_globals_adddashboardpage_callback', plugin_dir_url( __FILE__ ) . '../images/dashboard-icon.png', 73 );
		
	}
	function bwhd_globals_adddashboardpage_callback() {
		
		$globals = bwhd_globals();
		include( $globals->plugin_url . "/pages/admin.php" );
		
	}




	//Includes front end page for short code
	function bwhd_globals_includefrontendpage(){

		$globals = bwhd_globals();
		include( $globals->plugin_url . "/pages/frontend.php" );

	}




	//This checks for a plugin to be installed, returns false if not.
	//$plugin_key = (string) "notifications", "attachments"...
	function bwhd_globals_checkpluginactive( $plugin_key )
	{

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( $plugin_key == "notifications" )
		{

			if ( is_plugin_active( "bravowp-helpdesk-notifications/bravowp-helpdesk-notifications.php" ) )
			{

				return true;

			}

		}

		if ( $plugin_key == "attachments" )
		{

			if ( is_plugin_active( "bravowp-helpdesk-attachments/bravowp-helpdesk-attachments.php" ) )
			{

				return true;

			}

		}

		return false;
		
	}




?>