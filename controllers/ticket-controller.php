<?php


	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}



	//gets a tickets (admin dashboard)
	function bwhd_controllers_tickets_getsingleforeditpagefrontend( $ticket_id ) 
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = " . $ticket_id ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["status_id"] = $dbrows->status_id;
		$result["status_description"] = bwhd_controllers_status_returndescription( $dbrows->status_id );
		$result["ticket_created_date"] = $dbrows->ticket_created_date;
		
		return $result;
	   
	}


	//gets response, solution, and closed status informations for a ticket
	function bwhd_controllers_tickets_getresponseandsolutioninfo( $ticket_id ) 
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = " . $ticket_id ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_is_closed"] = $dbrows->ticket_is_closed;
		$result["ticket_closed_date"] = $dbrows->ticket_closed_date;
		$result["ticket_sla_resp_before"] = $dbrows->ticket_sla_resp_before;
		$result["ticket_sla_solv_before"] = $dbrows->ticket_sla_solv_before;
		$result["ticket_sla_resp_date"] = $dbrows->ticket_sla_resp_date;
		$result["ticket_sla_solv_date"] = $dbrows->ticket_sla_solv_date;
		
		return $result;
	   
	}



	//gets a tickets (admin dashboard)
	function bwhd_controllers_tickets_getsingleforticketdetailspage( $ticket_id ) 
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = " . $ticket_id ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["category_id"] = $dbrows->category_id;
		$result["status_id"] = $dbrows->status_id;
		$result["customer_avatar"] = get_avatar( $dbrows->ticket_customer_userid, 48 );
		$result["customer_name"] = $dbrows->ticket_customer_fullname;
		$result["customer_email"] = $dbrows->ticket_customer_email;

		return $result;
	   
	}


	//gets a ticket row to have the info to send in the emails notification
	function bwhd_controllers_tickets_getforsendingnotification( $ticket_id ) 
	{


		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_id = " . $ticket_id ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["ticket_id"] = $dbrows->ticket_id;
		$result["ticket_title"] = $dbrows->ticket_title;
		$result["ticket_problem"] = $dbrows->ticket_problem;
		$result["category_id"] = $dbrows->category_id;
		$result["status_id"] = $dbrows->status_id;
		$result["customer_avatar"] = get_avatar( $dbrows->ticket_customer_userid, 48 );
		$result["customer_name"] = $dbrows->ticket_customer_fullname;
		$result["customer_email"] = $dbrows->ticket_customer_email;

		return $result;
	   
	}


	//gets a list of tickets for the tickets list page, only the needed fields will be returned
	function bwhd_controllers_tickets_listforticketslistpage() 
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets ";

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = $row->ticket_title;
			$result_new_row["customer_name"] = $row->ticket_customer_fullname;
			$result_new_row["customer_email"] = $row->ticket_customer_email;
			$result_new_row["customer_avatar"] = get_avatar( $row->ticket_customer_userid, 24 );
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );

			array_push($results, $result_new_row); 

		}

		return $results;
	   
	}



	//gets a list of last 3 created tickets
	function bwhd_controllers_tickets_listfordashboardlast5tickets() 
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets ORDER BY ticket_created_date DESC LIMIT 3 ";

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = bwhd_utility_truncatetext( $row->ticket_title, 40 );
			$result_new_row["customer_name"] = $row->ticket_customer_fullname;
			$result_new_row["customer_email"] = $row->ticket_customer_email;
			$result_new_row["customer_avatar"] = get_avatar( $row->ticket_customer_userid, 32 );
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );

			array_push($results, $result_new_row); 

		}

		return $results;
	   
	}



	//gets a list of tickets for the tickets list page on the frond end, only the needed fields will be returned, for the current logged user
	function bwhd_controllers_tickets_listforticketslistpage_frontend() 
	{

		//logs the query text
		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage_frontend", "Start");

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_customer_userid = " . get_current_user_id();

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_listforticketslistpage_frontend","Update Query: " . $query);

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["ticket_id"] = $row->ticket_id;
			$result_new_row["ticket_title"] = $row->ticket_title;
			$result_new_row["status_description"] = bwhd_controllers_status_returndescription( $row->status_id );
			$result_new_row["status_label"] = bwhd_controllers_status_returnlabelclass( $row->status_id );

			array_push($results, $result_new_row); 

		}

		//logs the query text
		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_listforticketslistpage_frontend", "Finish");

		return $results;
	   
	}


	//update a single ticket
	//set the param "ensure_responded" to 1, to make sure that the ticket will
	//be set as responded after the update
	//set the param "check_status_and_closed" to 1, to make sure that the ticket will
	//be set as closed if its status is "closed"
	function bwhd_controllers_tickets_update( $params ) 
	{

		global $wpdb;

		$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";

		$query .= " ticket_title = '" . $params["ticket_title"] . "', ";
		$query .= " ticket_problem = '" . $params["ticket_description"] . "', ";
		$query .= " category_id = '" . $params["category_id"] . "', ";
		$query .= " status_id = '" . $params["status_id"] . "' ";

		$query .= " WHERE ticket_id = " . $params["ticket_id"];

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update","Update Query: " . $query);
		
		$results = $wpdb->query( $query , OBJECT );


		//mark the ticket as responded?
		if ( isset( $params["ensure_responded"] ) )
		{

			if ( $params["ensure_responded"] == 1 )
			{

				$ticket_info = bwhd_controllers_tickets_getresponseandsolutioninfo( $params["ticket_id"] );
				if ( $ticket_info["ticket_sla_resp_date"] == null )
				{

					$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";
					$query .= " ticket_sla_resp_date = '" . date('Y-m-d H:i:s') . "' ";
					$query .= " WHERE ticket_id = " . $params["ticket_id"];

					bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update_setresponded","Update Query: " . $query);

					$wpdb->query( $query , OBJECT );

				}

			}

		}


		//marks the ticket as closed?
		if ( isset( $params["check_status_and_closed"] ) )
		{

			if ( $params["check_status_and_closed"] == 1 )
			{

				if ( $params["status_id"] == 3 )	//3 is the status "closed"
				{

					$ticket_info = bwhd_controllers_tickets_getresponseandsolutioninfo( $params["ticket_id"] );
					if ( $ticket_info["ticket_is_closed"] == 0 )
					{

						$query = "UPDATE " . $wpdb->prefix . "bw_helpdesk_tickets SET ";
						$query .= " ticket_closed_date = '" . date('Y-m-d H:i:s') . "', ";
						$query .= " ticket_is_closed = 1 ";
						$query .= " WHERE ticket_id = " . $params["ticket_id"];

						bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_update_setclosed","Update Query: " . $query);

						$wpdb->query( $query , OBJECT );

					}

				}

			}

		}


	   
	}



	//inserts a ticket
	function bwhd_controllers_tickets_insert( $params ) 
	{

		global $wpdb;

		$query = "INSERT INTO " . $wpdb->prefix . "bw_helpdesk_tickets ";
		$query .= " ( ";
		$query .= " ticket_title, ";
		$query .= " ticket_problem, ";
		$query .= " category_id, ";
		$query .= " priority_id, ";
		$query .= " department_id, ";
		$query .= " customer_contract_id, ";
		$query .= " status_id, ";
		$query .= " ticket_is_closed, ";
		$query .= " ticket_created_date, ";
		$query .= " ticket_created_userid, ";
		$query .= " ticket_assigned_userid, ";
		$query .= " ticket_customer_userid, ";
		$query .= " ticket_customer_fullname, ";
		$query .= " ticket_customer_email, ";
		$query .= " ticket_closed_date, ";
		$query .= " ticket_sla_resp_before, ";
		$query .= " ticket_sla_solv_before, ";
		$query .= " ticket_sla_resp_date, ";
		$query .= " ticket_sla_solv_date ";
		$query .= " ) ";

		$query .= " VALUES ";

		$query .= " ( ";
		$query .= " '" . $params["ticket_title"] . "' , ";
		$query .= " '" . $params["ticket_problem"] . "', ";
		$query .= " " . $params["category_id"] . ", ";
		$query .= " " . "0" . ", ";		//priority id
		$query .= " " . "0" . ", ";		//department id
		$query .= " " . "0" . ", ";		//customer contract id
		$query .= " " . "1" . ", ";		//default status id (1=open)
		$query .= " " . "0" . ", ";		//is closed (0=no)
		$query .= " '" . date('Y-m-d H:i:s') . "', ";		//created date = current date
		$query .= " " . "0" . ", ";		//created user id
		$query .= " " . "0" . ", ";		//assigned user id
		$query .= " " . $params["ticket_customer_userid"] . ", ";		//customer id
		$query .= " '" . $params["ticket_customer_fullname"] . "', ";		
		$query .= " '" . $params["ticket_customer_email"] . "', ";		
		$query .= " null , ";	//closed date
		$query .= " null , ";	//resp before date
		$query .= " null , ";	//solution before date
		$query .= " null , ";	//resp date
		$query .= " null  ";	//solution date
		$query .= " ) ";

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_insert","Insert Query: " . $query);
		
		$results = $wpdb->query( $query );
		$lastid = $wpdb->insert_id;

		bwhd_systemlog_addentry("QUERY","bwhd_controllers_tickets_insert","Ticket ID generated: " . $lastid);

		return $lastid;
	   
	}




	//Gets the total of the tickets assigned to an Agent
	function bwhd_controllers_tickets_gettotalassignedtoagent( $assigned_user_id ) 
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 0 AND ticket_assigned_userid = " . $assigned_user_id ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = "$dbrows->Total";

		return $result;
	   
	}


	//Gets the total of the non responsed tickets 
	function bwhd_controllers_tickets_gettotalopenticket() 
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 0 AND ticket_sla_resp_date IS NULL " ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = $dbrows->Total;

		return $result;
	   
	}


	//Gets the total of the responsed tickets work in progress
	function bwhd_controllers_tickets_gettotalworkinprogressticket() 
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 0 AND ticket_sla_resp_date IS NOT NULL " ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = $dbrows->Total;

		return $result;
	   
	}


	//Gets the total of closed tickets
	function bwhd_controllers_tickets_gettotalclosedticket() 
	{


		global $wpdb;

		$query = "SELECT COUNT(*) as Total FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_is_closed = 1" ;

		$dbrows = $wpdb->get_row( $query , OBJECT );

		$result["Total"] = $dbrows->Total;

		return $result;
	   
	}



	//Gets a list of total of tickets opened and closed for a range of days
	function bwhd_controllers_tickets_getopenedvsclosedperdaterange() 
	{

		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Start");


		$result_data = "";


		//calculates date range
		$date_up_range_limit = date('Y-m-d');
		$date_down_range_limit = date('Y-m-d', strtotime("-10 days"));
		bwhd_systemlog_addentry("INFO","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Date_up: " . $date_up_range_limit);
		bwhd_systemlog_addentry("INFO","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Date_down: " . $date_down_range_limit);


		//getting data from DB, all the tickets that were opened and closed in the date range
		global $wpdb;
		$query = "SELECT ticket_created_date, ticket_closed_date FROM " . $wpdb->prefix . "bw_helpdesk_tickets WHERE ticket_closed_date <= '" . $date_up_range_limit . "' OR ticket_created_date >= '" . $date_down_range_limit . "' " ;
		bwhd_systemlog_addentry("FUNCTION","QUERY", $query);
		$dataset  = $wpdb->get_results( $query, ARRAY_A );
		//$debug = var_export($dataset, true);
		//bwhd_systemlog_addentry("FUNCTION","DEBUG DATASET", $debug);


		//building an array of dates between two dates
		$array_of_dates = bwhd_utility_returndatearray( $date_down_range_limit, $date_up_range_limit );

		//cycle the database result table and adds 1 unit to the full dates list of interal array
		foreach ( $dataset as $row ) 
		{

			if ( is_null($row["ticket_created_date"]) == false)
			{

				if ( bwhd_utility_checkdateinrange( $date_down_range_limit , $date_up_range_limit , $row["ticket_created_date"] ) == true )
				{

					$existing_data_for_date = $array_of_dates[ $row["ticket_created_date"] ];
					$existing_data_for_date["opened"] = $existing_data_for_date["opened"] + 1;
					$array_of_dates[ $row["ticket_created_date"] ] = $existing_data_for_date;

				}

			}

			if ( is_null($row["ticket_closed_date"]) == false)
			{

				if ( bwhd_utility_checkdateinrange( $date_down_range_limit , $date_up_range_limit , $row["ticket_closed_date"] ) == true )
				{

					$existing_data_for_date = $array_of_dates[ $row["ticket_closed_date"] ];
					$existing_data_for_date["closed"] = $existing_data_for_date["closed"] + 1;
					$array_of_dates[ $row["ticket_closed_date"] ] = $existing_data_for_date;

				}

			}

		}

		//$debug = var_export($array_of_dates, true);
		//bwhd_systemlog_addentry("FUNCTION","DEBUG ARRAY OF DATES", $debug);


		bwhd_systemlog_addentry("FUNCTION","bwhd_controllers_tickets_getopenedvsclosedperdaterange", "Finish");

		return $array_of_dates;
	   
	}

?>
