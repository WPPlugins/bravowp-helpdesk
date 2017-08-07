<div id="bwhd-admin-rightpane-control-ticketview-details">

<div id="bwhd-admin-rightpane-control-createticket-confirm" class="alert alert-success text-center" role="alert" style="margin-top:20px;"><span><?php _e("The new ticket was created. You can add now more details to it, by using the panels above.", "bravowp-helpdesk"); ?></span></div>

	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="bwhd-admin-rightpane-inner-panel">
				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Ticket Details", "bravowp-helpdesk"); ?></div>
				<div class="bwhd-admin-rightpane-inner-panel-body">
					<form>
						<div class="form-group">
							<label class="form-label bwhd-admin-label-required"><?php _e("Ticket Title", "bravowp-helpdesk"); ?></label>
							<input id="bwhd-admin-rightpane-control-ticketview-details-txttitle" class="form-control" type="text">
						</div>
						<div class="form-group">
							<label class="form-label bwhd-admin-label-required"><?php _e("Ticket Description", "bravowp-helpdesk"); ?></label>
							<textarea id="bwhd-admin-rightpane-control-ticketview-details-txtdescription" class="form-control" rows="3" style="height:auto !important;"></textarea>
						</div>
						<div class="col-md-6 form-group no-gutter">
							<label class="form-label bwhd-admin-label-required"><?php _e("Ticket Status", "bravowp-helpdesk"); ?></label>
							<div class="clear"></div>
							<select id="bwhd-admin-rightpane-control-ticketview-details-ddlstatus" class="selectpicker">
								<?php

									$status_array = bwhd_controllers_status_list();
									foreach( $status_array as $status_info ) 
									{
										echo "<option value='" . $status_info->status_id . "'>" . $status_info->status_description . "</option>";
									}

								?>    
							</select>
						</div>
						<div class="col-md-6 form-group no-gutter-right">
							<label class="form-label bwhd-admin-label-required"><?php _e("Ticket Category", "bravowp-helpdesk"); ?></label>
							<div class="clear"></div>
							<select id="bwhd-admin-rightpane-control-ticketview-details-ddlcategory" class="selectpicker">
								<?php

									$categories_array = bwhd_controllers_categories_list();
									foreach( $categories_array as $categories_info ) 
									{
										echo "<option value='" . $categories_info->category_id . "'>" . $categories_info->category_description . "</option>";
									}

								?>    
							</select>
						</div>
						<a class="btn btn-success" onclick="bwhd_admin_ticketsview_savesingleticket();"><?php _e("Save Details", "bravowp-helpdesk"); ?></a>
						<div id="bwhd-admin-rightpane-control-saveticket-validation" class="alert alert-warning text-center" role="alert" style="display:none;margin-top:20px;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>
						<div id="bwhd-admin-rightpane-control-saveticket-success" class="alert alert-success text-center" role="alert" style="display:none;margin-top:20px;"><span><?php _e("Ticket Details were updated", "bravowp-helpdesk"); ?>.</span></div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-1 col-lg-1">
		</div>
		<div class="col-md-11 col-lg-5">
			<div class="bwhd-admin-rightpane-inner-panel-with-bottom-border clearfix">
				<div class="bwhd-admin-rightpane-inner-panel-title"> <?php _e("Customer", "bravowp-helpdesk"); ?> </div>
				<div class="bwhd-admin-rightpane-inner-panel-body">
					<div class="col-md-1 no-gutter" id="bwhd-admin-rightpane-control-ticketview-details-divcustomeravatar" style="min-width:52px;">

					</div>
					<div class="col-md-10">
						<span class="clearfix" id="bwhd-admin-rightpane-control-ticketview-details-lblcustomername"></span>
						<span id="bwhd-admin-rightpane-control-ticketview-details-lblcustomeremail"></span>
					</div>
				</div>
			</div>
			<div class="bwhd-admin-rightpane-inner-panel-with-bottom-border clearfix">
				<div class="bwhd-admin-rightpane-inner-panel-title"> <?php _e("Resolution Process", "bravowp-helpdesk"); ?> </div>
				<div class="bwhd-admin-rightpane-inner-panel-body">
					<span class="bwhd-admin-rightpane-greyedtext"><?php echo bwhd_placeholders_nodatanoaddon() ?></span>
				</div>
			</div>
			<div class="bwhd-admin-rightpane-inner-panel clearfix">
				<div class="bwhd-admin-rightpane-inner-panel-title"> <?php _e("Support Contract", "bravowp-helpdesk"); ?> </div>
				<div class="bwhd-admin-rightpane-inner-panel-body">
					<span class="bwhd-admin-rightpane-greyedtext"><?php echo bwhd_placeholders_nodatanoaddon() ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="clear"></div>

</div>