<?php

	//This page is used in the WP Administration Dashboard
	
	//Loading client resources, like style sheets and scripts
	bwhd_globals_includeresources_adminpages();

?>



<div class="bwhd bwhd-admin-container">

	<div class="bwhd-ajax-loader" id="bwhd-admin-dashboard-loader" style="display:none;">
	  <img src="<?php echo bwhd_globals()->loadergif_url; ?>" class="bwhd-ajax-loader">
	</div>

	<?php include( $globals->plugin_url . "/controls/admin-dashboard-topbar.php" ); ?>

	<?php include( $globals->plugin_url . "/controls/admin-dashboard-menu.php" ); ?>
	
	<div class="bwhd-admin-rightpane">
		
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-dashboard.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketslist.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketnew.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-settings.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-about.php" ); ?>
		<?php include( $globals->plugin_url . "/controls/admin-dashboard-help.php" ); ?>

		<div class="clear"></div>

	</div>

</div>

<div class="clear"></div>

<div style="display:none;">
	Zone:<span id="bwhd_admin_dashboard_var_currentzone">dashboard</span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	Zone Settings:<span id="bwhd_admin_dashboard_var_currentzonesettings">general</span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	Current Settings Notification Key:<span id="bwhd_admin_dashboard_var_currentnotificationkeysettings"></span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	CurrentTicketId:<span id="bwhd_admin_dashboard_var_currentticketid">0</span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	CurrentTicketZone:<span id="bwhd_admin_dashboard_var_currentticketzone">details</span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	NotificationPluginEnabled:<span id="bwhd_admin_dashboard_var_pluginnotificationsenabled"><?php echo bwhd_globals_checkpluginactive("notifications"); ?></span>
	&nbsp;&nbsp;||&nbsp;&nbsp;
	AttachmentsPluginEnabled:<span id="bwhd_admin_dashboard_var_pluginattachmentsenabled"><?php echo bwhd_globals_checkpluginactive("attachments"); ?></span>
</div>

