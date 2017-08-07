<?php



	function bwhd_install_dbobjects()
	{

		$curent_installed_ver = "forcerun";
		//$curent_installed_ver = get_option( "bwhd_db_version" );

		if ( bwhd_globals()->plugin_version != $curent_installed_ver )
		{

			global $wpdb;

			$table_name_tickets = $wpdb->prefix . 'bw_helpdesk_tickets';
			$table_name_messages = $wpdb->prefix . 'bw_helpdesk_messages';
			$table_name_notifications = $wpdb->prefix . 'bw_helpdesk_notifications';
			$table_name_attachments = $wpdb->prefix . 'bw_helpdesk_attachments';

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
			$charset_collate = $wpdb->get_charset_collate();

			//TABLE Helpdesk Tickets

			$sql = " CREATE TABLE $table_name_tickets (
		 			ticket_id int(11) NOT NULL AUTO_INCREMENT,
					ticket_title varchar(50) NOT NULL,
					ticket_problem varchar(1000) NOT NULL,
					category_id int(11) DEFAULT NULL,
					priority_id int(11) DEFAULT NULL,
					department_id int(11) DEFAULT NULL,
					customer_contract_id int(11) DEFAULT NULL,
					status_id int(11) DEFAULT NULL,
					ticket_is_closed tinyint(1) NOT NULL,
					ticket_created_date date NOT NULL,
					ticket_created_userid int(11) DEFAULT NULL,
					ticket_assigned_userid int(11) DEFAULT NULL,
					ticket_customer_userid int(11) DEFAULT NULL,
					ticket_customer_fullname varchar(100) NULL,
					ticket_customer_email varchar(100) NULL,
					ticket_closed_date date DEFAULT NULL,
					ticket_sla_resp_before date DEFAULT NULL,
					ticket_sla_solv_before date DEFAULT NULL,
					ticket_sla_resp_date date DEFAULT NULL,
					ticket_sla_solv_date date DEFAULT NULL,
		 			PRIMARY KEY  (ticket_id)
					) $charset_collate ";

			dbDelta( $sql );

			//TABLE Helpdesk Messages

			$sql = " CREATE TABLE $table_name_messages (
					message_id int(11) NOT NULL AUTO_INCREMENT,
					ticket_id int(11) NOT NULL,
					message_date date NOT NULL,
					message_text text NOT NULL,
					author_type varchar(50) NOT NULL,
					author_userid int(11) NOT NULL,
					is_private tinyint(1) NOT NULL,
					is_sendemail tinyint(1) NOT NULL,
					PRIMARY KEY  (message_id)
					) $charset_collate ";

			dbDelta( $sql );


			//TABLE Helpdesk Notifications

			$sql = " CREATE TABLE $table_name_notifications ( 
				   	notification_key VARCHAR(50) NOT NULL, 
				   	notification_name VARCHAR(50) NOT NULL , 
				   	notification_eventdescription VARCHAR(500) NOT NULL , 
				   	notification_subject VARCHAR(500) NOT NULL , 
				   	notification_body text NOT NULL , 
				   	notification_is_enabled BOOLEAN NOT NULL ,
				   	PRIMARY KEY  (notification_key)
				   	) ";

			dbDelta( $sql );


			//TABLE Helpdesk Attachments

			$sql = " CREATE TABLE $table_name_attachments ( 
				   	attachment_id int(11) NOT NULL AUTO_INCREMENT, 
				   	entity_id int(11) NOT NULL, 
				   	attachment_url VARCHAR(500) NOT NULL , 
				   	attachment_path VARCHAR(500) NOT NULL , 
				   	attachment_size int(11) NOT NULL , 
				   	attachment_filename VARCHAR(500) NULL, 
				   	uploaded_user_id int(11) NULL,
				   	uploaded_user_type VARCHAR(50) NOT NULL,
				   	uploaded_date date DEFAULT NULL, 
				   	PRIMARY KEY  (attachment_id)
				   	)  $charset_collate  ";

			dbDelta( $sql );


			add_option( 'bwhd_db_version', bwhd_globals()->plugin_version, '', 'yes'  );
			update_option( 'bwhd_db_version', bwhd_globals()->plugin_version, '', 'yes'  );

		}


		//to be checked always
		bwhd_install_default_notification_records();



	}



	//This function checks that the defaults notification records are present
	function bwhd_install_default_notification_records()
	{


		if ( bwhd_globals_checkpluginactive("notifications") ) 
		{

			bwhd_notifications_install_default();

		}

	}



?>