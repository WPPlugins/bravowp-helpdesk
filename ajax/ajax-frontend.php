<?php

	//for captcha
	session_start();

	//hooks
	add_action( 'wp_ajax_ajax_frontend_ticket_list', 'ajax_frontend_ticket_list' );
	add_action( 'wp_ajax_nopriv_ajax_frontend_ticket_list', 'ajax_frontend_ticket_list' );
	add_action( 'wp_ajax_ajax_frontend_ticket_insert', 'ajax_frontend_ticket_insert' );
	add_action( 'wp_ajax_nopriv_ajax_frontend_ticket_insert', 'ajax_frontend_ticket_insert' );
	add_action( 'wp_ajax_ajax_frontend_loadticketeditpage', 'ajax_frontend_loadticketeditpage' );
	add_action( 'wp_ajax_nopriv_ajax_frontend_loadticketeditpage', 'ajax_frontend_loadticketeditpage' );
	add_action( 'wp_ajax_ajax_frontend_loadmessageseditpage', 'ajax_frontend_loadmessageseditpage' );
	add_action( 'wp_ajax_nopriv_ajax_frontend_loadmessageseditpage', 'ajax_frontend_loadmessageseditpage' );
	add_action( 'wp_ajax_ajax_frontend_message_save', 'ajax_frontend_message_save' );
	add_action( 'wp_ajax_nopriv_ajax_frontend_message_save', 'ajax_frontend_message_save' );


	//this function is called to load the ticket details in the edit ticket page
	function ajax_frontend_loadticketeditpage() {

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_tickets_getsingleforeditpagefrontend( $param_ticket_id ); 
		wp_send_json( $result );

	}

	//this function is called to load the messages edit ticket page
	function ajax_frontend_loadmessageseditpage() {

		$param_ticket_id = -1;
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticket_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		$result = bwhd_controllers_messages_listforticketsviewpagefrontend( $param_ticket_id ); 
		wp_send_json( $result );

	}

	//this function is called to list the ticket for the registered user
	function ajax_frontend_ticket_list() {

		$result = bwhd_controllers_tickets_listforticketslistpage_frontend(); 
		wp_send_json( $result );

	}


	//this function is when a ticket is added via frontend
	function ajax_frontend_ticket_insert() {


		bwhd_systemlog_addentry("FUNCTION","ajax_frontend_ticket_insert","Start");

		$result_message = "";

		$param_customer_name = "";
		$param_customer_email = "";
		$param_ticket_title = "";
		$param_ticket_problem = "";
		$param_category_id = -1;
		$param_captcha = "";
		if ( isset( $_POST['customer_name'] ))
		{
			$param_customer_name = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_name']) ));
		}
		if ( isset( $_POST['customer_email'] ))
		{
			$param_customer_email = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['customer_email']) ));
		}
		if ( isset( $_POST['ticket_title'] ))
		{
			$param_ticket_title = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_title']) ));
		}
		if ( isset( $_POST['ticket_problem'] ))
		{
			$param_ticket_problem = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_problem']) ));
		}
		if ( isset( $_POST['category_id'] ))
		{
			$param_category_id = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['category_id']) ));
		}
		if ( isset( $_POST['captcha'] ))
		{
			$param_captcha = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['captcha']) ));
		}

		//validation
		if ( is_user_logged_in() == false )
		{
			if ( $param_customer_name == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcustomername", __("Please type your full name.", "bravowp-helpdesk"), "", "") );
			}
			if ( $param_customer_email == "" )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcustomeremail", __("Please type your email address.", "bravowp-helpdesk"), "", "") );
			}
		}
		if ( $param_ticket_title == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txttickettitle", __("Please enter a Title for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_ticket_problem == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtticketproblem", __("Please enter a Description for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_category_id == "" || $param_category_id == "0"  )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-ddlcategory", __("Please select a Category for this Ticket.", "bravowp-helpdesk"), "", "") );
		}
		if ( $param_captcha == "" && get_option( "bwhd_require_captcha", "no" ) == "yes" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcaptcha", __("Please type the value as shown in the image.", "bravowp-helpdesk"), "", "") );
		}
		if ( get_option( "bwhd_require_captcha", "no" ) == "yes" )
		{
			if ( $param_captcha != $_SESSION['bwhd_captcha_newticket'] )
			{
				wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketnew-txtcaptcha", __("The value you typed and the value shown do not match.", "bravowp-helpdesk"), "", "") );
			}
		}
		//params adjusting
		if ( is_user_logged_in() == true )
		{

			//getting the info for the existing customer
			$customer_info = bwhd_controllers_customers_getsingle( get_current_user_id() );

			$param_customer_name = $customer_info[0]->display_name;
			$param_customer_email = $customer_info[0]->user_email;
		}

		//array to pass to method
		$array_values["ticket_customer_userid"] = get_current_user_id();
		$array_values["ticket_customer_fullname"] = $param_customer_name;
		$array_values["ticket_customer_email"] = $param_customer_email;
		$array_values["ticket_title"] = $param_ticket_title;
		$array_values["ticket_problem"] = $param_ticket_problem;
		$array_values["category_id"] = $param_category_id;
		
		//controller method
		$new_ticket_id = bwhd_controllers_tickets_insert( $array_values );

		//email notification
		if ( bwhd_globals_checkpluginactive("notifications") )
		{
			$notifications_params = array( 'notification_key'=>'newticketconfirmcust', 'ticket_id'=>$new_ticket_id );
			bwhd_controllers_notifications_sendemail( $notifications_params );	
		}

		bwhd_systemlog_addentry("FUNCTION","ajax_frontend_ticket_insert","End");

		//response
		wp_send_json( bwhd_ajax_return_reponse(1, "", "", $new_ticket_id, "") );


	}


	//this function is called to save a new message to a ticket
	function ajax_frontend_message_save() {

		bwhd_systemlog_addentry("FUNCTION","ajax_frontend_message_save","Start");

		$param_ticketId = -1;
		$param_messageText = "";
		if ( isset( $_POST['ticket_id'] ))
		{
			$param_ticketId = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['ticket_id']) ));
		}
		if ( isset( $_POST['message_text'] ))
		{
			$param_messageText = sanitize_text_field(esc_attr(wp_strip_all_tags( $_POST['message_text']) ));
		}
		$param_authorType = "customer";
		$param_isPrivate = 0;
		$param_isEmail = 1;

		//validation
		if ( $param_messageText == "" )
		{
			wp_send_json( bwhd_ajax_return_reponse(0, "bwhd-frontend-controls-ticketedit-txtnewmessage", __("Please type your message.", "bravowp-helpdesk"), "", "") );
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
			$notifications_params = array( 'notification_key'=>'newmessagefromcustomer', 'ticket_id'=>$param_ticketId, 'message'=>$param_messageText );
			bwhd_controllers_notifications_sendemail( $notifications_params );	
		}

		wp_send_json( bwhd_ajax_return_reponse(1, "", "", "", "") );

	}


?>