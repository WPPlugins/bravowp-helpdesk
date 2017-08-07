<div id="bwhd-admin-rightpane-control-dashboard" class="bwhd-admin-rightpane-control">
	
	<div class="bwhd-admin-rightpane-page-header">

		<div class="bwhd-admin-rightpane-page-header-title"><?php _e("Helpdesk Dashboard", "bravowp-helpdesk"); ?></div>
		<a class="btn btn-success pull-right bwhd-admin-rightpane-page-header-bigbuttons" onclick="bwhd_admin_dashboard_newticketclick();">
			<i class="fa fa-file-text"></i> <?php _e("Create Ticket", "bravowp-helpdesk"); ?>
		</a>

	</div>

	<div class="row">

		<div class="col-md-12">

			<div class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

				<ul>

					<li class="col-md-3 text-center">
						<span class="bwhd-admin-dashboard-widget-title"><i class="fa fa-user"></i> <?php _e("My Tickets", "bravowp-helpdesk"); ?></span>
						<span id="bwhd-admin-dashboard-widget-mytickets-span" class="bwhd-admin-dashboard-widget-number">0</span>
						<span class="bwhd-admin-dashboard-widget-subtitle"><?php _e("Assigned to me", "bravowp-helpdesk"); ?></span>
					</li>

					<li class="col-md-3 text-center">
						<span class="bwhd-admin-dashboard-widget-title"><i class="fa fa-file-text"></i> <?php _e("New Tickets", "bravowp-helpdesk"); ?></span>
						<span id="bwhd-admin-dashboard-widget-awaitresponse-span" class="bwhd-admin-dashboard-widget-number">0</span>
						<span class="bwhd-admin-dashboard-widget-subtitle"><?php _e("Awaiting response", "bravowp-helpdesk"); ?></span>
					</li>

					<li class="col-md-3 text-center">
						<span class="bwhd-admin-dashboard-widget-title"><i class="fa fa-clock-o"></i> <?php _e("In Process", "bravowp-helpdesk"); ?></span>
						<span id="bwhd-admin-dashboard-widget-workingon-span" class="bwhd-admin-dashboard-widget-number">0</span>
						<span class="bwhd-admin-dashboard-widget-subtitle"><?php _e("Tickets working on", "bravowp-helpdesk"); ?></span>
					</li>

					<li class="col-md-3 text-center">
						<span class="bwhd-admin-dashboard-widget-title"><i class="fa fa-thumbs-up"></i> <?php _e("Closed so far", "bravowp-helpdesk"); ?></span>
						<span id="bwhd-admin-dashboard-widget-closed-span" class="bwhd-admin-dashboard-widget-number">0</span>
						<span class="bwhd-admin-dashboard-widget-subtitle"><?php _e("Tickets resolved", "bravowp-helpdesk"); ?></span>
					</li>

				</ul>

				<div class="clearfix"></div>

			</div>	

		</div>

	</div>

	<div class="row">

		<div class="col-md-6">

			<div id="bwhd-admin-dashboard-panel-chart" class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Opened Tickets vs Closed Tickets", "bravowp-helpdesk"); ?></div>

				<div class="clearfix"></div>

				<div id="bwhd-admin-dashboard-chart-openvsclosed" class="ct-chart ct-major-eleventh" style="display:none;"></div>
				<div id="bwhd-admin-dashboard-chart-openvsclosed-nodata" style="display:none; height: 200px;padding-top: 50px;"><?php echo bwhd_placeholders_dashboardchartnodata() ?></div>

				<div style="font-size:75%;margin-left: 10px;margin-top: 20px;">
					<i class="fa fa-square" style="color:#337ab7"></i> <?php _e("Created Tickets", "bravowp-helpdesk"); ?>
					&nbsp;&nbsp;&nbsp;
					<i class="fa fa-square" style="color:#4cae4c"></i> <?php _e("Closed Tickets", "bravowp-helpdesk"); ?>
				</div>

			</div>	

		</div>

		<div class="col-md-6">

			<div id="bwhd-admin-dashboard-panel-listlasttickets" class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Last 3 Opened Tickets", "bravowp-helpdesk"); ?></div>

				<div class="clearfix"></div>

				<table id="bwhd-admin-dashboard-lasttickets-table" class="table">

					<thead>
						<tr>
							<th style="width:10%;"><?php _e("Number", "bravowp-helpdesk"); ?></th> 
							<th><?php _e("Ticket / Status", "bravowp-helpdesk"); ?></th>
							<th class="text-center"><?php _e("Customer", "bravowp-helpdesk"); ?></th>
							<th class="text-right"><?php _e("Edit", "bravowp-helpdesk"); ?></th>
						</tr>
					</thead>

					<tbody>
					</tbody>

				</table>

				<div id="bwhd-admin-dashboard-lasttickets-table-nodata" style="display:none; height: 140px;padding-top: 50px;"><?php echo bwhd_placeholders_dashboardlastfiveticketsnodata() ?></div>

			</div>	

		</div>

	</div>

</div>