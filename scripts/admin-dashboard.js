
//Document load
jQuery(document).ready(function(){

	bwhd_admin_menu_click( "dashboard" );

	jQuery("#bwhd-admin-rightpane-control-ticketnew-optcustomerexisting").change(function () {
		bwhd_admin_ticketsview_switchcustomermode();
     });
	 
	jQuery("#bwhd-admin-rightpane-control-ticketnew-optcustomernew").change(function () {
		bwhd_admin_ticketsview_switchcustomermode();
     });


	
});



//Called on menu click
function bwhd_admin_menu_click( menuKey )
{

	//sets the current zone
	jQuery("#bwhd_admin_dashboard_var_currentzone").text( menuKey );

	//remove the "active" status from the menu items
	jQuery(".bwhd-admin-leftpane-menu li").removeClass("bwhd-admin-leftpane-menu-active-li");

	//shows the right control
	bwhd_admin_display_control_zone();

	//executes the default action after button click, if any
	if ( currentZone == "dashboard")
	{
		jQuery("#bwhd-admin-leftpane-menu-dashboard").addClass("bwhd-admin-leftpane-menu-active-li");
		bwhd_admin_dashboard_loadcounters();
		bwhd_admin_dashboard_loadopenedvsclosedchart();
	}
	if ( currentZone == "ticketslist")
	{
		jQuery("#bwhd-admin-leftpane-menu-supporttickets").addClass("bwhd-admin-leftpane-menu-active-li");
		bwhd_admin_ticketslist_load();
	}
	if ( currentZone == "taskslist")
	{
		jQuery("#bwhd-admin-leftpane-menu-tasks").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "agentslist")
	{
		jQuery("#bwhd-admin-leftpane-menu-agents").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "contractslist")
	{
		jQuery("#bwhd-admin-leftpane-menu-contracts").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "tables")
	{
		jQuery("#bwhd-admin-leftpane-menu-tables").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "emailnotifications")
	{
		jQuery("#bwhd-admin-leftpane-menu-emails").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "settings")
	{
		jQuery("#bwhd-admin-leftpane-menu-settings").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "help")
	{
		jQuery("#bwhd-admin-leftpane-menu-help").addClass("bwhd-admin-leftpane-menu-active-li");
	}
	if ( currentZone == "about")
	{
		jQuery("#bwhd-admin-leftpane-menu-about").addClass("bwhd-admin-leftpane-menu-active-li");
	}

}


//Shows the right control according to the current zone
function bwhd_admin_display_control_zone()
{

	//get the current zone
	currentZone = jQuery("#bwhd_admin_dashboard_var_currentzone").text();

	//hides all controls
	bwhd_admin_hide_allcontrols();

	//shows the right controlo according to the current zone
	if ( currentZone == "dashboard")
	{
		jQuery("#bwhd-admin-rightpane-control-dashboard").show();
	}
	if ( currentZone == "ticketslist")
	{
		jQuery("#bwhd-admin-rightpane-control-ticketslist").show();	
	}
	if ( currentZone == "ticketview")
	{
		jQuery("#bwhd-admin-rightpane-control-ticketview").show();	
	}
	if ( currentZone == "ticketnew")
	{
		bwhd_admin_ticketsnew_clearcontent();
		jQuery("#bwhd-admin-rightpane-control-ticketnew").show();	
	}
	if ( currentZone == "settings")
	{
		jQuery("#bwhd-admin-rightpane-control-settings").show();	
	}
	if ( currentZone == "about")
	{
		jQuery("#bwhd-admin-rightpane-control-about").show();	
	}
	if ( currentZone == "help")
	{
		jQuery("#bwhd-admin-rightpane-control-help").show();	
	}

}


//hides all controls in the content pane, called before showing the current control
function bwhd_admin_hide_allcontrols()
{

	jQuery("#bwhd-admin-rightpane-control-dashboard").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketslist").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketview").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketnew").hide();
	jQuery("#bwhd-admin-rightpane-control-settings").hide();
	jQuery("#bwhd-admin-rightpane-control-about").hide();
	jQuery("#bwhd-admin-rightpane-control-help").hide();

}


//loads the tickets list in the tickets list section
function bwhd_admin_ticketslist_load()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_ticket_list',
					security : bwhdVars.ajaxNonce
				},
			success : function( response ) 
			{
			
			    jQuery('#bwhd_admin_rightpane_ticketslist_table').DataTable( 
			    	{
			    		"bDestroy": true,
			        	data: response,
				        columns: 
				        [
				            { "width": "1%", className: "text-center", "orderable": false, data: "ticket_id", render: function ( data, type, full, meta ) { return "<span class='fa fa-pencil bwhd-admin-rightpane-datatable-editicon' onclick='bwhd_admin_ticketslist_editticketclick(" + data + ");'></span>"; } },
				            { "width": "5%", className: "text-center", title: "N", data: "ticket_id", render: function ( data, type, full, meta ) { return "<strong># " + data + "</strong>"; } },
				            { "width": "49%", title: "Title", data: "ticket_title" },
				            { "width": "30%", title: "Customer", data: "ticket_title", render: function ( data, type, full, meta ) { return "<div class='col-md-2 no-gutter-left'>" + full.customer_avatar + "</div><div class='col-md-10 no-gutter-left'>" + full.customer_name + "</div>" ; } },
				            { "width": "15%", className: "text-center", title: "Status", data: "status_description", render: function ( data, type, full, meta ) { return "<div class='" + full.status_label + "'>" + data + "</div>" ; } }
				        ],
				        "order": [[ 1, "desc" ]]
    				
			    	} 
			    );

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);


}




//Called on click of the edit icon in the table of tickets
function bwhd_admin_ticketslist_editticketclick( ticket_id)
{

	//setting the variable on the ticket id that was clicked
	jQuery("#bwhd_admin_dashboard_var_currentticketid").text( ticket_id );

	//change current zone
	jQuery("#bwhd_admin_dashboard_var_currentzone").text( "ticketview" );
	bwhd_admin_display_control_zone();

	//settint title of this section
	jQuery("#bwhd_admin_rightpane_page_header_title_span").text("Ticket Details: #" + ticket_id );

	//sets the first tab (details) as active
	bwhd_admin_ticketsview_submenuclick("details");

	//load details data
	bwhd_admin_ticketsview_loadsingleticket();

}


//Click on the New Ticket button on the Tickets List page
function bwhd_admin_ticketslist_newticketclick()
{

	//setting the variable on the ticket id that was clicked
	jQuery("#bwhd_admin_dashboard_var_currentticketid").text( "0" );

	//change current zone
	jQuery("#bwhd_admin_dashboard_var_currentzone").text( "ticketnew" );
	bwhd_admin_display_control_zone();

	//sets the first tab (details) as active
	bwhd_admin_ticketsview_submenuclick("details");

}



//Called on ticket view page submenu click
function bwhd_admin_ticketsview_submenuclick( subMenuKey )
{

	//sets the current ticket zone
	jQuery("#bwhd_admin_dashboard_var_currentticketzone").text( subMenuKey );

	//removes the selection class from all tabs of submenu
	jQuery("#bwhd-admin-rightpane-horizontalsubmenu-ticketview .menu li").removeClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");

	//hides all panels of tickets view page content
	jQuery("#bwhd-admin-rightpane-control-ticketview-details").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketview-events").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketview-attachments").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketview-tasks").hide();

	//sets the selected menu
	if ( subMenuKey == "details" )
	{
		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-li-details").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-rightpane-control-ticketview-details").show();
	}
	if ( subMenuKey == "events" )
	{
		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-li-events").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-rightpane-control-ticketview-events").show();
		bwhd_admin_ticketsview_listmessages();
	}
	if ( subMenuKey == "attachments" )
	{
		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-li-attachments").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-rightpane-control-ticketview-attachments").show();
		if (jQuery("#bwhd_admin_dashboard_var_pluginattachmentsenabled").text() == "1")
		{
			bwhd_admin_ticketsview_attachments_loadlist();
		}
	}
	if ( subMenuKey == "tasks" )
	{
		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-li-tasks").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-rightpane-control-ticketview-tasks").show();
	}

}



//Loads an existing ticket detail in the details pages, taking the id from the current ticket variable
function bwhd_admin_ticketsview_loadsingleticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-rightpane-control-saveticket-validation").hide();
	jQuery("#bwhd-admin-rightpane-control-saveticket-success").hide();
	jQuery("#bwhd-admin-rightpane-control-createticket-confirm").hide();
	jQuery("#bwhd-admin-rightpane-control-ticketview-details-txttitle").removeClass("bwhd-admin-errorinputborder");
	jQuery("#bwhd-admin-rightpane-control-ticketview-details-txtdescription").removeClass("bwhd-admin-errorinputborder");

	//reading current ticket variable
	currentTicketId = jQuery("#bwhd_admin_dashboard_var_currentticketid").text();

	//setting the ticket id in the hidden form value of the upload file form
	//it will not throw an error in case of the add on is not installed
	jQuery("#bwhd-admin-rightpane-control-ticketview-attachments-hiddenuploadticketid").val(currentTicketId);

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_ticket_loadsingle',
					security : bwhdVars.ajaxNonce,
					ticket_id : currentTicketId
				},
			success : function( response ) 
			{
			
			    //binding data
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-txttitle").val( response.ticket_title );
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-txtdescription").val( response.ticket_problem );
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-ddlstatus").val( response.status_id );
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-ddlcategory").val( response.category_id );
			    jQuery('.selectpicker').selectpicker('render');
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-lblcustomername").text( response.customer_name );
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-lblcustomeremail").text( response.customer_email );
			    jQuery("#bwhd-admin-rightpane-control-ticketview-details-divcustomeravatar").html( response.customer_avatar );

			    jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}




//Save a ticket details page to the database (update only)
function bwhd_admin_ticketsview_savesingleticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	//reading current ticket variable
	currentTicketId = jQuery("#bwhd_admin_dashboard_var_currentticketid").text();

	//reading controls values
	value_ticket_title = jQuery("#bwhd-admin-rightpane-control-ticketview-details-txttitle").val();
	value_ticket_problem = jQuery("#bwhd-admin-rightpane-control-ticketview-details-txtdescription").val();
	value_status_id = jQuery("#bwhd-admin-rightpane-control-ticketview-details-ddlstatus").val();
	value_category_id = jQuery("#bwhd-admin-rightpane-control-ticketview-details-ddlcategory").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_ticket_save',
					security : bwhdVars.ajaxNonce,
					ticket_id : currentTicketId,
					ticket_title : value_ticket_title,
					ticket_problem : value_ticket_problem,
					status_id : value_status_id,
					category_id : value_category_id
				},
			success : function( response ) 
			{

				jQuery("#bwhd-admin-rightpane-control-saveticket-validation").hide();
				jQuery("#bwhd-admin-rightpane-control-ticketview-details-txttitle").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-rightpane-control-ticketview-details-txtdescription").removeClass("bwhd-admin-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-admin-rightpane-control-saveticket-validation").show();
					jQuery("#bwhd-admin-rightpane-control-saveticket-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-admin-errorinputborder");
					jQuery("#bwhd-admin-dashboard-loader").hide();
					return;

				}
			
				jQuery("#bwhd-admin-rightpane-control-saveticket-success").show();
				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}


//putting defaults to the add new ticket form
function bwhd_admin_ticketsnew_clearcontent()
{
		
	jQuery("#bwhd-admin-rightpane-control-ticketnew-optcustomerexisting").attr("checked", "");
	jQuery('#bwhd-admin-rightpane-control-ticketnew-customername').hide();
	jQuery('#bwhd-admin-rightpane-control-ticketnew-customeremail').hide();
	jQuery('#bwhd-admin-rightpane-control-ticketnew-customerexisting').show();
	jQuery("#bwhd-admin-rightpane-control-ticketnew-ddlexistingcustomer").val(0);
	jQuery('#bwhd-admin-rightpane-control-ticketnew-txtcustomername').val('');
	jQuery('#bwhd-admin-rightpane-control-ticketnew-txtcustomeremail').val('');
	jQuery('#bwhd-admin-rightpane-control-ticketnew-txttitle').val('');
	jQuery('#bwhd-admin-rightpane-control-ticketnew-txtdescription').val('');
	jQuery('#bwhd-admin-rightpane-control-ticketnew-ddlcategory').val(0);
	jQuery("#bwhd-admin-rightpane-control-ticketnew-validation").hide();

}


//Save a ticket details page to the database (ticket NEW page)
function bwhd_admin_ticketsnew_insertticket()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	//reading controls values
	if ( jQuery("#bwhd-admin-rightpane-control-ticketnew-optcustomerexisting").is(":checked") )
	{
		value_customer_type = "existing";
	}
	else
	{
		value_customer_type = "new";
	}

	value_customer_existing_id = jQuery("#bwhd-admin-rightpane-control-ticketnew-ddlexistingcustomer").val();
	value_customer_new_name = jQuery("#bwhd-admin-rightpane-control-ticketnew-txtcustomername").val();
	value_customer_new_email = jQuery("#bwhd-admin-rightpane-control-ticketnew-txtcustomeremail").val();
	
	value_ticket_title = jQuery("#bwhd-admin-rightpane-control-ticketnew-txttitle").val();
	value_ticket_problem = jQuery("#bwhd-admin-rightpane-control-ticketnew-txtdescription").val();
	value_category_id = jQuery("#bwhd-admin-rightpane-control-ticketnew-ddlcategory").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_ticket_insert',
					security : bwhdVars.ajaxNonce,
					customer_type : value_customer_type,
					customer_existing_id : value_customer_existing_id,
					customer_new_name : value_customer_new_name,
					customer_new_email : value_customer_new_email,
					ticket_title : value_ticket_title,
					ticket_problem : value_ticket_problem,
					category_id : value_category_id
				},
			success : function( response ) 
			{
			
				jQuery("#bwhd-admin-rightpane-control-ticketnew-validation").hide();
				jQuery("#bwhd-admin-rightpane-control-ticketnew-txtcustomername").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-rightpane-control-ticketnew-txtcustomeremail").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-rightpane-control-ticketnew-txttitle").removeClass("bwhd-admin-errorinputborder");
				jQuery("#bwhd-admin-rightpane-control-ticketnew-txtdescription").removeClass("bwhd-admin-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-admin-rightpane-control-ticketnew-validation").show();
					jQuery("#bwhd-admin-rightpane-control-ticketnew-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-admin-errorinputborder");
					jQuery("#bwhd-admin-dashboard-loader").hide();
					return;

				}

				bwhd_admin_ticketsnew_clearcontent();

				bwhd_admin_ticketslist_editticketclick( response.extra_data_1 );
				jQuery("#bwhd-admin-rightpane-control-createticket-confirm").show();

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}




//Save a new message for this ticket
function bwhd_admin_ticketsview_addmessage()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-rightpane-control-newmessage-validation").hide();

	//reading current ticket variable
	currentTicketId = jQuery("#bwhd_admin_dashboard_var_currentticketid").text();

	//reading controls values
	value_message_text = jQuery("#bwhd-admin-rightpane-control-ticketview-messages-txtmessage").val();
	value_is_private = false;
	value_is_sendemail = false;

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_message_save',
					security : bwhdVars.ajaxNonce,
					ticket_id : currentTicketId,
					message_text : value_message_text,
					author_type : 'agent',
					is_private : value_is_private,
					is_sendemail : value_is_sendemail
				},
			success : function( response ) 
			{
			
				jQuery("#bwhd-admin-rightpane-control-ticketview-messages-txtmessage").removeClass("bwhd-admin-errorinputborder");

				//checking validation
				if (response.success == 0)
				{

					jQuery("#bwhd-admin-rightpane-control-newmessage-validation").show();
					jQuery("#bwhd-admin-rightpane-control-newmessage-validation span").html( response.error_message );
					jQuery("#" + response.error_field_key).addClass("bwhd-admin-errorinputborder");
					jQuery("#bwhd-admin-dashboard-loader").hide();
					return;

				}

				jQuery("#bwhd-admin-rightpane-control-ticketview-messages-txtmessage").val('');
				bwhd_admin_ticketsview_listmessages();

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}





//List the messages for a ticket 
function bwhd_admin_ticketsview_listmessages()
{

	jQuery("#bwhd-admin-dashboard-loader").show();
	jQuery("#bwhd-admin-rightpane-control-ticketview-messages-txtmessage").removeClass("bwhd-admin-errorinputborder");
	jQuery("#bwhd-admin-rightpane-control-newmessage-validation").hide();

	//reading current ticket variable
	currentTicketId = jQuery("#bwhd_admin_dashboard_var_currentticketid").text();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_message_loadlist',
					security : bwhdVars.ajaxNonce,
					ticket_id : currentTicketId
				},
			success : function( response ) 
			{
			

				if ( response.length > 0 )
				{

					jQuery("#bwhd-admin-rightpane-ticketmessages-listnodata").hide();

					var htmlContent = "";

					jQuery.each(response, function(index) {
			            
						htmlContent += "<div class='bwhd-admin-rightpane-ticketmessages-message'>"

						if ( response[index].is_my_message == true )
						{

							htmlContent += "<div class='col-md-2'></div>";
				           	htmlContent += "<div class='col-md-9 no-gutter text-right'>";
				            htmlContent += "<span class='bwhd-admin-rightpane-ticketmessages-message-text '><span class='bwhd-admin-rightpane-ticketmessages-message-date'>" + response[index].message_date + "</span>" + response[index].message_text + "</span>";
				            htmlContent += "</div>";
				            htmlContent += "<div class='col-md-1'>";
				            htmlContent += response[index].author_avatar;
				            htmlContent += "</div>";

			            }
			            else
			            {

			           		htmlContent += "<div class='col-md-1 no-gutter'>";
				            htmlContent += response[index].author_avatar;
				            htmlContent += "</div>";
			         		htmlContent += "<div class='col-md-9 no-gutter-left'>";
				            htmlContent += "<span class='bwhd-admin-rightpane-ticketmessages-message-text bwhd-admin-rightpane-ticketmessages-message-text-blue'><span class='bwhd-admin-rightpane-ticketmessages-message-date'>" + response[index].message_date + "</span>" + response[index].message_text + "</span>";
				            htmlContent += "</div>";

			            }

			            htmlContent += "</div>";

						htmlContent += "<div class='clear' style='height:20px;'></div>";		            

			        });

			        jQuery("#bwhd-admin-rightpane-ticketmessages-list").html( htmlContent );


		        }
	        	else
	        	{

					jQuery("#bwhd-admin-rightpane-ticketmessages-list").html( '' );
        			jQuery("#bwhd-admin-rightpane-ticketmessages-listnodata").show();

	        	}		        

	        	jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}



//Switch between customers modes in dashboard creation ticket
function bwhd_admin_ticketsview_switchcustomermode()
{
		
	if ( jQuery("#bwhd-admin-rightpane-control-ticketnew-optcustomerexisting").attr("checked") ) 
	{
		
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customername').hide();
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customeremail').hide();
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customerexisting').show();
		
    }
    else 
	{
		
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customername').show();
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customeremail').show();
		jQuery('#bwhd-admin-rightpane-control-ticketnew-customerexisting').hide();
		
    }
	

}





//Handles the clicks menu from settings sub menu
function bwhd_admin_settings_menuclick( menuKey )
{

	//sets the current zone
	jQuery("#bwhd_admin_dashboard_var_currentzonesettings").text( menuKey );

	//remove the "active" status from the menu items
	jQuery("#bwhd-admin-rightpane-horizontalsubmenu-settings li").removeClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");

	//hiding panels
	jQuery("#bwhd-admin-settingspanel-general").hide();
	jQuery("#bwhd-admin-settingspanel-notifications").hide();
	jQuery("#bwhd-admin-settingspanel-attachments").hide();

	//executes the default action after button click, if any
	if ( menuKey == "general")
	{
		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-settings-li-details").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-general").show();
	}
	if ( menuKey == "notifications")
	{

		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-settings-li-notifications").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-notifications").show();
		if (jQuery("#bwhd_admin_dashboard_var_pluginnotificationsenabled").text() == "1")
		{
			bwhd_notifications_settings_list_load();
		}
		
	}
	if ( menuKey == "attachments")
	{

		jQuery("#bwhd-admin-rightpane-horizontalsubmenu-settings-li-attachments").addClass("bwhd-admin-rightpane-horizontalsubmenu-selecteditem");
		jQuery("#bwhd-admin-settingspanel-attachments").show();
		
	}

}

//Save a new message for this ticket
function bwhd_admin_settings_save()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	value_allowticketunregistered = jQuery("#bwhd-admin-rightpane-control-settings-allowticketunregistered").val();
	value_require_captcha = jQuery("#bwhd-admin-rightpane-control-settings-requirecaptcha").val();
	value_enablelog = jQuery("#bwhd-admin-rightpane-control-settings-enableeventslog").val();
	value_helpdeskemail = jQuery("#bwhd-admin-rightpane-control-settings-helpdeskemail").val();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_settings_save',
					security : bwhdVars.ajaxNonce,
					allowticketunregistered : value_allowticketunregistered,
					require_captcha : value_require_captcha,
					enablelog : value_enablelog,
					helpdeskemail : value_helpdeskemail
				},
			success : function( response ) 
			{
			
				//jQuery("#bwhd-admin-rightpane-control-ticketview-messages-txtmessage").val('');
				//bwhd_admin_ticketsview_listmessages();

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
		}
	);

}





function bwhd_admin_dashboard_newticketclick()
{

	//setting the variable on the ticket id that was clicked
	jQuery("#bwhd_admin_dashboard_var_currentticketid").text( "0" );

	//change current zone
	bwhd_admin_menu_click( "ticketslist" );
	jQuery("#bwhd_admin_dashboard_var_currentzone").text( "ticketnew" );
	bwhd_admin_display_control_zone();

	//sets the first tab (details) as active
	bwhd_admin_ticketsview_submenuclick("details");

}

function bwhd_admin_dashboard_loadcounters()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_getcounters',
					security : bwhdVars.ajaxNonce
				},
			success : function( response ) 
			{
			
				var datacounters = response.extra_data_1.split("-");

				jQuery("#bwhd-admin-dashboard-widget-mytickets-span").text(datacounters[0]);
				jQuery("#bwhd-admin-dashboard-widget-awaitresponse-span").text(datacounters[1]);
				jQuery("#bwhd-admin-dashboard-widget-workingon-span").text(datacounters[2]);
				jQuery("#bwhd-admin-dashboard-widget-closed-span").text(datacounters[3]);

			}
		}
	);


}

function bwhd_admin_dashboard_loadopenedvsclosedchart()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_loadopenedvsclosedchart',
					security : bwhdVars.ajaxNonce
				},
			success : function( response ) 
			{

				
				if ( response.extra_data_1 != "" )
				{


					var days = [];
					var opened = [];
					var closed = [];
					jQuery.each(response.extra_data_1, function(index) 
						{

							if ( response.extra_data_1[index].opened > 0 || response.extra_data_1[index].closed > 0)
							{
								days.push( response.extra_data_1[index].date );
								opened.push( response.extra_data_1[index].opened );
								closed.push( response.extra_data_1[index].closed );
							}

						}
					);

					var data = {
					  labels: days,
					  series: [ opened, closed ]
					};
					new Chartist.Bar('#bwhd-admin-dashboard-chart-openvsclosed', data, {axisX: {position: 'start'}, axisY: {position: 'end', onlyInteger: true} });

					jQuery("#bwhd-admin-dashboard-chart-openvsclosed").show();
					jQuery("#bwhd-admin-dashboard-chart-openvsclosed-nodata").hide();


				}	
				else
				{

					jQuery("#bwhd-admin-dashboard-chart-openvsclosed").hide();
					jQuery("#bwhd-admin-dashboard-chart-openvsclosed-nodata").show();

				}

				bwhd_admin_dashboard_loadlast5tickets();


			}
			
		}
	);


}


function bwhd_admin_dashboard_loadlast5tickets()
{

	jQuery("#bwhd-admin-dashboard-loader").show();

	jQuery.ajax
	(
		{
			url : bwhdVars.ajaxAdminUrl,
			type : 'post',
			dataType: 'json',
			data : 
				{
					action : 'ajax_admin_dashboard_ticket_listlast5fordashboard',
					security : bwhdVars.ajaxNonce
				},
			success : function( response ) 
			{


				if ( response.length > 0 )
				{

					jQuery("#bwhd-admin-dashboard-lasttickets-table").find("tr:gt(0)").remove();

					var trs_to_add = "";

					jQuery.each(response, function(index) 
						{

							trs_to_add = trs_to_add + "<tr>";

							trs_to_add = trs_to_add + "<td class='bwhd-admin-dashboard-lasttickets-table-tdticketid'><span>" + response[index].ticket_id + "</span></td>";
							trs_to_add = trs_to_add + "<td>" + response[index].ticket_title + "<div class='clear'></div><div class='" + response[index].status_label + "'>" + response[index].status_description + "</div></td>";
							trs_to_add = trs_to_add + "<td class='bwhd-admin-dashboard-lasttickets-table-tdavatar text-center'>" + response[index].customer_avatar + "</td>";
							trs_to_add = trs_to_add + "<td class='text-right'><span onclick='bwhd_admin_ticketslist_editticketclick(" + response[index].ticket_id + ");' style='margin-top:8px;margin-right:5px;' class='fa fa-pencil bwhd-admin-rightpane-datatable-editicon'></span></td>";

							trs_to_add = trs_to_add + "</tr>";

						}
					);

					jQuery('#bwhd-admin-dashboard-lasttickets-table > tbody:last-child').append(trs_to_add);

					jQuery("#bwhd-admin-dashboard-lasttickets-table").show();
					jQuery("#bwhd-admin-dashboard-lasttickets-table-nodata").hide();

				}
				else
				{

					jQuery("#bwhd-admin-dashboard-lasttickets-table").hide();
					jQuery("#bwhd-admin-dashboard-lasttickets-table-nodata").show();

				}

				jQuery("#bwhd-admin-dashboard-panel-listlasttickets").height( jQuery("#bwhd-admin-dashboard-panel-chart").height() );

				jQuery("#bwhd-admin-dashboard-loader").hide();

			}
			
		}
	);


}







