<?php


	//hooks
	add_action( 'wp_ajax_ajax_admin_dashboard_ticket_list', 'ajax_admin_dashboard_ticket_list' );
	add_action( 'wp_ajax_ajax_admin_dashboard_ticket_loadsingle', 'ajax_admin_dashboard_ticket_loadsingle' );
	add_action( 'wp_ajax_ajax_admin_dashboard_ticket_save', 'ajax_admin_dashboard_ticket_save' );
	add_action( 'wp_ajax_ajax_admin_dashboard_message_save', 'ajax_admin_dashboard_message_save' );
	add_action( 'wp_ajax_ajax_admin_dashboard_ticket_insert', 'ajax_admin_dashboard_ticket_insert' );
	add_action( 'wp_ajax_ajax_admin_settings_save', 'ajax_admin_settings_save' );
	add_action( 'wp_ajax_ajax_admin_dashboard_message_loadlist', 'ajax_admin_dashboard_message_loadlist' );
	add_action( 'wp_ajax_ajax_admin_dashboard_getcounters', 'ajax_admin_dashboard_getcounters' );
	add_action( 'wp_ajax_ajax_admin_dashboard_loadopenedvsclosedchart', 'ajax_admin_dashboard_loadopenedvsclosedchart' );
	add_action( 'wp_ajax_ajax_admin_dashboard_ticket_listlast5fordashboard', 'ajax_admin_dashboard_ticket_listlast5fordashboard' );
	
	


	//this function is called to list tickets and search in the database
	function ajax_admin_dashboard_ticket_list() {

		$result = bwhd_controllers_tickets_listforticketslistpage(); 
		wp_send_json($result);

	}


	//this function is called to list tickets and search in the database
	function ajax_admin_dashboard_ticket_listlast5fordashboard() {

		$result = bwhd_controllers_tickets_listfordashboardlast5tickets(); 
		wp_send_json($result);

	}


	//this function is called to load a single ticket detail
	function ajax_admin_dashboard_ticket_loadsingle() {

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_tickets_getsingleforticketdetailspage( $param_ticket_id ); 
		wp_send_json($result);

	}


	//this function is called to save a single ticket detail (update)
	function ajax_admin_dashboard_ticket_save() {

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$param_ticketTitle = "";
		if ( isset( $_POST['ticket_title'] ))
		{
			$param_ticketTitle = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_title']) ));
		}
		$param_ticketDescription = "";
		if ( isset( $_POST['ticket_problem'] ))
		{
			$param_ticketDescription = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_problem']) ));
		}
		$param_ticketCategoryId = -1;
		if ( isset( $_POST['category_id'] ))
		{
			$param_ticketCategoryId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}
		$param_ticketStatusId = -1;
		if ( isset( $_POST['status_id'] ))
		{
			$param_ticketStatusId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['status_id']) ));
		}


		if ( $param_ticketTitle == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketview-details-txttitle", __("Please type a title for this Ticket.", "bravowp-helpdesk"), "", "") );
		}			
		if ( $param_ticketDescription == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketview-details-txtdescription", __("Please type a description for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		
		$array_values["ticket_id"] = $param_ticketId;
		$array_values["ticket_title"] = $param_ticketTitle;
		$array_values["ticket_description"] = $param_ticketDescription;
		$array_values["category_id"] = $param_ticketCategoryId;
		$array_values["status_id"] = $param_ticketStatusId;

		$array_values["ensure_responded"] = 1;	//indicates to set the ticket as responded in case
		$array_values["check_status_and_closed"] = 1;	//indicates to set the ticket as closed if the given status is closed
		
		bwhd_controllers_tickets_update( $array_values );

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", "", "") );

	}



	//this function is called to save a single ticket detail (ticket new page)
	function ajax_admin_dashboard_ticket_insert() {

		$result_message = "";

		$param_customer_type = "";
		if ( isset( $_POST['customer_type'] ))
		{
			$param_customer_type = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_type']) ));
		}
		$param_customer_existing_id = -1;
		if ( isset( $_POST['customer_existing_id'] ))
		{
			$param_customer_existing_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_existing_id']) ));
		}
		$param_customer_new_name = "";
		if ( isset( $_POST['customer_new_name'] ))
		{
			$param_customer_new_name = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_new_name']) ));
		}
		$param_customer_new_email = "";
		if ( isset( $_POST['customer_new_email'] ))
		{
			$param_customer_new_email = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_new_email']) ));
		}
		$param_ticket_title = "";
		if ( isset( $_POST['ticket_title'] ))
		{
			$param_ticket_title = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_title']) ));
		}
		$param_ticket_problem = "";
		if ( isset( $_POST['ticket_problem'] ))
		{
			$param_ticket_problem = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_problem']) ));
		}
		$param_category_id = -1;
		if ( isset( $_POST['category_id'] ))
		{
			$param_category_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}


		//validation
		if ( $param_customer_type == "new" )
		{
			if ( $param_customer_new_name == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-txtcustomername", __("Please type a name for the Customer.", "bravowp-helpdesk"), "", "") );
			}
			if ( $param_customer_new_email == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-txtcustomeremail", __("Please type an email for the Customer.", "bravowp-helpdesk"), "", "") );
			}
		}
		else
		{

			if ( $param_customer_existing_id == "" || $param_customer_existing_id == "0" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-ddlexistingcustomer", __("Please select a Customer.", "bravowp-helpdesk"), "", "") );
			}

		}

		if ( $param_ticket_title == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-txttitle", __("Please type a title for this Ticket.", "bravowp-helpdesk"), "", "") );
		}			
		if ( $param_ticket_problem == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-txtdescription", __("Please type a description for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_category_id == "" || $param_category_id == "0" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketnew-ddlcategory", __("Please select a Category.", "bravowp-helpdesk"), "", "") );
		}


		//params adjusting
		if ( $param_customer_type == "existing" )
		{

			//getting the info for the existing customer
			$customer_info = bwhd_controllers_customers_getsingle( $param_customer_existing_id );

			$param_customer_new_name = $customer_info[0]->display_name;
			$param_customer_new_email = $customer_info[0]->user_email;
			
		}

		//array to pass to method
		$array_values["ticket_customer_userid"] = $param_customer_existing_id;
		$array_values["ticket_customer_fullname"] = $param_customer_new_name;
		$array_values["ticket_customer_email"] = $param_customer_new_email;
		$array_values["ticket_title"] = $param_ticket_title;
		$array_values["ticket_problem"] = $param_ticket_problem;
		$array_values["category_id"] = $param_category_id;
		
		//controller method
		$new_ticket_id = bwhd_controllers_tickets_insert( $array_values );

		//email notification
		if ( bwhd_globals_checkpluginactive("notifications") )
		{
			$notifications_params = array( 'notification_key'=>'newticketconfirmadmin', 'ticket_id'=>$new_ticket_id );
			bwhd_controllers_notifications_sendemail( $notifications_params );	
		}

		//response
		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $new_ticket_id, "") );

	}


	//this function is called to load a list of ticket's messages in the dashboard for agents
	function ajax_admin_dashboard_message_loadlist() {

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_messages_listforticketsviewpagedashboard( $param_ticketId ); 
		wp_send_json($result);

	}


	//this function is called to save a new message to a ticket
	function ajax_admin_dashboard_message_save() {

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_message_save","Start");

		$param_ticketId = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$param_messageText = -1;
		if ( isset( $_POST['message_text'] ))
		{
			$param_messageText = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['message_text']) ));
		}
		$param_authorType = -1;
		if ( isset( $_POST['author_type'] ))
		{
			$param_authorType = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['author_type']) ));
		}
		$param_isPrivate = -1;
		if ( isset( $_POST['is_private'] ))
		{
			$param_isPrivate = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['is_private']) ));
		}
		$param_isEmail = -1;
		if ( isset( $_POST['is_sendemail'] ))
		{
			$param_isEmail = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['is_sendemail']) ));
		}

		if ( $param_messageText == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-admin-rightpane-control-ticketview-messages-txtmessage", __("Please type a Message.", "bravowp-helpdesk"), "", "") );
		}
		
		$array_values["author_type"] = $param_authorType;
		$array_values["author_userid"] = get_current_user_id();
		$array_values["is_private"] = $param_isPrivate;
		$array_values["is_sendemail"] = $param_isEmail;
		$array_values["message_date"] = current_time('mysql');
		$array_values["message_text"] = $param_messageText;
		$array_values["ticket_id"] = $param_ticketId;

		bwhd_controllers_messages_insert( $array_values );

		if ( bwhd_globals_checkpluginactive("notifications") )
		{
			$notifications_params = array( 'notification_key'=>'newmessagefromadmin', 'ticket_id'=>$param_ticketId, 'message'=>$param_messageText);
			bwhd_controllers_notifications_sendemail( $notifications_params );	
		}

		wp_send_json("ok");

	}



	//this function is called to save the generic settings
	function ajax_admin_settings_save() {

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_message_save","Start");
		
		$post_allowunregistered = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['allowticketunregistered']) ));
		$post_requirecaptcha = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['require_captcha']) ));
		$post_log_enable = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['enablelog']) ));
		$post_helpdeskemail = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['helpdeskemail']) ));
		
		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_allowticketunregistered:" . $setting_allowunregistered );
		update_option( "bwhd_allowticketunregistered", $post_allowunregistered, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_require_captcha:" . $setting_requirecaptcha );
		update_option( "bwhd_require_captcha", $post_requirecaptcha, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_log_enable:" . $setting_log_enable );
		update_option( "bwhd_log_enable", $post_log_enable, "yes" );

		//bwhd_log_addentry( "INFO", "Form Submit: Settings Generic Update", "Saving bwhd_helpdeskemail:" . $setting_log_helpdeskemail );
		update_option( "bwhd_helpdeskemail", $post_helpdeskemail, "yes" );
		
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_message_save","End");

	}



	//this function is called to get the counters on the dashboard
	function ajax_admin_dashboard_getcounters() {

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_getcounters","Start");
		
		$counter_mytickets = bwhd_controllers_tickets_gettotalassignedtoagent( get_current_user_id() );
		$counter_opentickets = bwhd_controllers_tickets_gettotalopenticket( );
		$counter_workinprogresstickets = bwhd_controllers_tickets_gettotalworkinprogressticket( );
		$counter_closedtickets = bwhd_controllers_tickets_gettotalclosedticket( );

		$result_data = $counter_mytickets["Total"] . "-" . $counter_opentickets["Total"] . "-" . $counter_workinprogresstickets["Total"] . "-" . $counter_closedtickets["Total"];

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result_data, "") );
		
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_getcounters","End");

	}


	function ajax_admin_dashboard_loadopenedvsclosedchart()
	{

		//logging that this function was called
		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_loadopenedvsclosedchart","Start");

		$result = bwhd_controllers_tickets_getopenedvsclosedperdaterange();

		bwhd_systemlog_addentry("FUNCTION","ajax_admin_dashboard_loadopenedvsclosedchart","End");

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $result, "") );
		

	}



?>