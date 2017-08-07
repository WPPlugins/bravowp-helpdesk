<?php


	//This function is called from the main page and enqueue css and js 
	//Will work on administration pages only
	function bwhd_globals_includeresources_adminpages() {
	    
		wp_enqueue_style( 'bootstrap-css', plugins_url( '../css/bootstrap.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-theme-css', plugins_url( '../css/bootstrap-theme.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-helper-css', plugins_url( '../css/bootstrap-helper.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'datatable-css', plugins_url( '../css/datatable.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-select-css', plugins_url( '../css/bootstrap-select.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'font-awesome', plugins_url( '../css/font-awesome.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'chartist', plugins_url( '../css/chartist.min.css', __FILE__ ), array(), '', 'all' );

		wp_enqueue_style( 'bwhd-css', plugins_url( '../css/admin-dashboard.css', __FILE__ ), array(), '', 'all' );
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js', plugins_url( '../scripts/bootstrap.min.js', __FILE__ ) );
		wp_enqueue_script( 'datatable-js', plugins_url( '../scripts/datatable.min.js', __FILE__ ) );
		wp_enqueue_script( 'bootstrap-select-js', plugins_url( '../scripts/bootstrap-select.min.js', __FILE__ ) );
		wp_enqueue_script( 'chartist-js', plugins_url( '../scripts/chartist.min.js', __FILE__ ) );
		
		wp_register_script( 'bwhd-admin-js', plugins_url( '../scripts/admin-dashboard.js', __FILE__ ) );


		require_once(ABSPATH .'wp-includes/pluggable.php');
		$ajax_nonce = wp_create_nonce( "my-special-string" ); //TO DO
		wp_localize_script( 'bwhd-admin-js', 'bwhdVars', array(	'ajaxAdminUrl' => admin_url( 'admin-ajax.php' ), 'ajaxNonce' => $ajax_nonce	));
		wp_enqueue_script( 'bwhd-admin-js' );


	        
	}  



	//This function is called from the rendering of the front end page
	//Call for front end only
	function bwhd_globals_includeresources_frontendpages() {
	    
		wp_enqueue_style( 'bootstrap-css', plugins_url( '../css/bootstrap.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-theme-css', plugins_url( '../css/bootstrap-theme.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-helper-css', plugins_url( '../css/bootstrap-helper.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'datatable-css', plugins_url( '../css/datatable.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'bootstrap-select-css', plugins_url( '../css/bootstrap-select.min.css', __FILE__ ), array(), '', 'all' );
		wp_enqueue_style( 'font-awesome', plugins_url( '../css/font-awesome.min.css', __FILE__ ), array(), '', 'all' );

		wp_enqueue_style( 'bwhd-css', plugins_url( '../css/frontend.css', __FILE__ ), array(), '', 'all' );
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js', plugins_url( '../scripts/bootstrap.min.js', __FILE__ ) );
		wp_enqueue_script( 'datatable-js', plugins_url( '../scripts/datatable.min.js', __FILE__ ) );
		wp_enqueue_script( 'bootstrap-select-js', plugins_url( '../scripts/bootstrap-select.min.js', __FILE__ ) );
		
		wp_register_script( 'bwhd-frontend-js', plugins_url( '../scripts/frontend.js', __FILE__ ) );


		require_once(ABSPATH .'wp-includes/pluggable.php');
		$ajax_nonce = wp_create_nonce( "my-special-string" ); //TO DO
		wp_localize_script( 'bwhd-frontend-js', 'bwhdVars', array(	'ajaxAdminUrl' => admin_url( 'admin-ajax.php' ), 'ajaxNonce' => $ajax_nonce	));
		wp_enqueue_script( 'bwhd-frontend-js' );
	        
	} 


?>