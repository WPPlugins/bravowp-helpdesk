<div id="bwhd-admin-rightpane-control-ticketview"  class="bwhd-admin-rightpane-control">
	
	<div class="bwhd-admin-rightpane-page-header">

		<div class="bwhd-admin-rightpane-page-header-title"><span id="bwhd_admin_rightpane_page_header_title_span"></span></div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<div class="clearfix">

				<div id="bwhd-admin-rightpane-horizontalsubmenu-ticketview" class="bwhd-admin-rightpane-horizontalsubmenu">
					<ul class="menu">
						<li id="bwhd-admin-rightpane-horizontalsubmenu-li-details">
							<a onclick="bwhd_admin_ticketsview_submenuclick('details');"><i class="fa fa-inbox"></i> <?php _e("Details", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-rightpane-horizontalsubmenu-li-events">
							<a onclick="bwhd_admin_ticketsview_submenuclick('events');"><i class="fa fa-flag-o"></i> <?php _e("Messages & Events", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-rightpane-horizontalsubmenu-li-attachments">
							<a onclick="bwhd_admin_ticketsview_submenuclick('attachments');"><i class="fa fa-paper-plane-o"></i> <?php _e("Attachments", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-rightpane-horizontalsubmenu-li-tasks">
							<a onclick="bwhd_admin_ticketsview_submenuclick('tasks');"><i class="fa fa-trash"></i> <?php _e("Tasks", "bravowp-helpdesk"); ?></a>
						</li>
					</ul>
				</div>

			</div>

			<div class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

				<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-details.php" ); ?>
				<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-events.php" ); ?>
				<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-tasks.php" ); ?>
				<?php include( $globals->plugin_url . "/controls/admin-dashboard-ticketview-attachments.php" ); ?>


			</div>

		</div>	

	</div>

</div>