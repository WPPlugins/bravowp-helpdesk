<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}

	
	//gets all fields from customer table
	function bwhd_controllers_customers_getsingle( $customer_id )
	{
		
		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION", "bwhd_controllers_customers_getsingle", "Start");
		
		global $wpdb;

		$query = "SELECT $wpdb->users.* FROM $wpdb->users WHERE ID = " . $customer_id;

		bwhd_systemlog_addentry("QUERY", "bwhd_controllers_customers_getsingle", $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		bwhd_systemlog_addentry("RESULT", "bwhd_controllers_customers_getsingle", "Result contains: " . count( $dbrows ) );

		return $dbrows;
		
	}



	//getting a list of customers for the admin dropdown list
	function bwhd_controllers_customers_listfordashboardticketcreate()
	{
		
		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION", "bwhd_controllers_customers_listfordashboardticketcreate", "Start");
		
		global $wpdb;

		$query = "SELECT $wpdb->users.* FROM $wpdb->users WHERE $wpdb->users.user_status = 0 ORDER BY $wpdb->users.display_name ";

		bwhd_systemlog_addentry("QUERY", "bwhd_controllers_customers_listfordashboardticketcreate", $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["id"] =  $row->ID ;
			$result_new_row["display_name"] =  $row->display_name ;

			array_push($results, $result_new_row); 

		}

		bwhd_systemlog_addentry("RESULT", "bwhd_controllers_customers_listfordashboardticketcreate", "Result contains: " . count($query) );

		return $results;
		
	}
	


?>