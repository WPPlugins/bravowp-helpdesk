<?php

	$content_parag_intro_authenticated = __("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button. You can review your existing Support Tickets by clicking on the 'Search Ticket' button.", "bravowp-helpdesk");
	$content_parag_intro_unauthenticated = __("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button.", "bravowp-helpdesk");



?>


<div id="bwhd-frontend-controls-ticketslist" class="bwhd-frontend-panel-default" style="display:none;">

	<div class="bwhd-ajax-loader" id="bwhd-frontend-controls-ticketlist-loader" style="display:none;">
	  <img src="<?php echo bwhd_globals()->loadergif_url; ?>" class="bwhd-ajax-loader">
	</div>

	<div class="bwhd-frontend-panel-default-title">
		<?php _e("Manage your existing Support Tickets", "bravowp-helpdesk");?>
	</div>
	
	<span class="bwhd-frontend-span-margin-bottom">

		<?php 
		
			if ( is_user_logged_in() == true )
			{
				echo $content_parag_intro_authenticated;
			}
			else
			{
				echo $content_parag_intro_unauthenticated;
			}

		?>

	</span>

	<table style="display:none;" id="bwhd-frontend-controls-listticketscontainer-table" class="display" cellspacing="0" width="100%"></table>
	<div  style="display:none;" id="bwhd-frontend-controls-listticketscontainer-noitems" class="alert alert-info"><?php _e("No Support Tickets found.", "bravowp-helpdesk");?></div>

	<div style="margin-top:40px;">
		<a class="btn btn-default" onclick="bwhd_frontend_button_listtickets_click_cancel();"><i class="fa fa-arrow-circle-o-left"></i> <?php _e("Cancel", "bravowp-helpdesk");?></a>
		<a class="btn btn-default" onclick="bwhd_frontend_button_listtickets_click_createnew();"><i class="fa fa-file-text"></i> <?php _e("Create New Support Ticket", "bravowp-helpdesk");?></a>
	</div>	

</div>