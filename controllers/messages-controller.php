<?php


	if ( ! defined( 'ABSPATH' ) ) {
		exit; 
	}


	//gets a list of messages for tickets messages pane in the ticket view page in dashboard
	function bwhd_controllers_messages_listfordashboardticketview() 
	{

		$array_return = array();
		
		$category_info = new stdClass();
		$category_info->category_id = '1';
		$category_info->category_description = 'Pre-Sale Question';
		array_push($array_return, $category_info);

		$category_info = new stdClass();
		$category_info->category_id = '2';
		$category_info->category_description = 'Support on Product';
		array_push($array_return, $category_info);

		$category_info = new stdClass();
		$category_info->category_id = '3';
		$category_info->category_description = 'Generic Enquiry';
		array_push($array_return, $category_info);

		return $array_return;
	   
	}


	//update a single ticket
	function bwhd_controllers_messages_insert( $params ) 
	{

		global $wpdb;

		$query = "INSERT INTO " . $wpdb->prefix . "bw_helpdesk_messages ";
		$query .= " ( ";
		$query .= " author_type, ";
		$query .= " author_userid, ";
		$query .= " is_private, ";
		$query .= " is_sendemail, ";
		$query .= " message_date, ";
		$query .= " message_text, ";
		$query .= " ticket_id ";
		$query .= " ) ";

		$query .= " VALUES ";

		$query .= " ( ";
		$query .= " '" . $params["author_type"] . "' , ";
		$query .= " " . $params["author_userid"] . ", ";
		$query .= " " . $params["is_private"] . ", ";
		$query .= " " . $params["is_sendemail"] . ", ";
		$query .= " '" . $params["message_date"] . "', ";
		$query .= " '" . $params["message_text"] . "' , ";
		$query .= " " . $params["ticket_id"] . " ";
		$query .= " ) ";

		//logs the query text
		bwhd_systemlog_addentry("QUERY","bwhd_controllers_messages_insert","Update Query: " . $query);
		
		$results = $wpdb->query( $query , OBJECT );

	   
	}


	//gets a list of messages for the dashboard agent side of ticket view details
	function bwhd_controllers_messages_listforticketsviewpagedashboard( $ticket_id ) 
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_messages WHERE ticket_id = " . $ticket_id . " ORDER BY message_date ";

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["message_text"] = $row->message_text;
			$result_new_row["is_private"] = $row->is_private;
			$myDateTime = DateTime::createFromFormat('Y-m-d', $row->message_date);
			$result_new_row["message_date"] = date_format($myDateTime, 'd/m/Y H:i A');
			$result_new_row["author_userid"] = $row->author_userid;
			$result_new_row["is_my_message"] = ( $row->author_userid == get_current_user_id() );
			$result_new_row["author_avatar"] = get_avatar( $row->author_userid, 32 );

			array_push($results, $result_new_row); 

		}

		return $results;
	   
	}



	//gets a list of messages for the front end part of view ticket details
	function bwhd_controllers_messages_listforticketsviewpagefrontend( $ticket_id ) 
	{

		global $wpdb;

		$query = "SELECT * FROM " . $wpdb->prefix . "bw_helpdesk_messages WHERE ticket_id = " . $ticket_id . " AND is_private=0 ORDER BY message_date ";

		$dbrows = $wpdb->get_results( $query , OBJECT );

		$results = array();

		//filling an array and returning only the needed content
		foreach( $dbrows as $row )
		{

			$result_new_row["message_text"] = $row->message_text;
			$myDateTime = DateTime::createFromFormat('Y-m-d', $row->message_date);
			$result_new_row["message_date"] = date_format($myDateTime, 'd/m/Y H:i A');
			$result_new_row["author_userid"] = $row->author_userid;
			$result_new_row["is_my_message"] = ( $row->author_userid == get_current_user_id() );
			$result_new_row["author_avatar"] = get_avatar( $row->author_userid, 32 );
			if ( $row->author_type == "customer")
			{
				$result_new_row["author_displayname"] = "Me";	
			}
			if ( $row->author_type == "agent")
			{
				$agent_info = get_userdata( $row->author_userid );
				$result_new_row["author_displayname"] = $agent_info->display_name;	
			}
				
			array_push($results, $result_new_row); 

		}

		return $results;
	   
	}



?>