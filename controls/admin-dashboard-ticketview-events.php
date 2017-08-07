<div id="bwhd-admin-rightpane-control-ticketview-events">

	<div class="row">

		<div class="col-md-7">

			<div class="bwhd-admin-rightpane-inner-panel">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("MESSAGES AND EVENTS", "bravowp-helpdesk"); ?></div>

				<div class="bwhd-admin-rightpane-inner-panel-body">

					<div id="bwhd-admin-rightpane-ticketmessages-list"></div>	
					<span id="bwhd-admin-rightpane-ticketmessages-listnodata" class="bwhd-admin-rightpane-greyedtext"><?php _e("No messages yet.", "bravowp-helpdesk"); ?></span>

				</div>

			</div>

		</div>

		<div class="col-md-1">
		</div>

		<div class="col-md-4">
			
			<div class="bwhd-admin-rightpane-inner-panel">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("ADD MESSAGE", "bravowp-helpdesk"); ?></div>

				<div class="bwhd-admin-rightpane-inner-panel-body">

					<form>
						<div class="form-group">
							<label class="form-label bwhd-admin-label-required"><?php _e("Message:", "bravowp-helpdesk"); ?></label>
							<textarea id="bwhd-admin-rightpane-control-ticketview-messages-txtmessage" class="form-control" rows="3" style="height:auto !important;"></textarea>
						</div>
						<a class="btn btn-success" onclick="bwhd_admin_ticketsview_addmessage();"><?php _e("Save Message", "bravowp-helpdesk"); ?></a>
						<div id="bwhd-admin-rightpane-control-newmessage-validation" class="alert alert-warning text-center" role="alert" style="display:none;margin-top:20px;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>
					</form>

				</div>

			</div>

		</div>

	</div>

	<div class="clear"></div>

</div>