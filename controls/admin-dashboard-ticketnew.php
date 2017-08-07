<div id="bwhd-admin-rightpane-control-ticketnew"  class="bwhd-admin-rightpane-control">
	
	<div class="bwhd-admin-rightpane-page-header">

		<div class="bwhd-admin-rightpane-page-header-title"><?php _e("Create New Support Ticket", "bravowp-helpdesk"); ?></div>

	</div>

	<div class="row">

		<div class="col-md-8">

		<div class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

			<div class="bwhd-admin-rightpane-inner-panel">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Customer Information", "bravowp-helpdesk"); ?></div>

					<div class="bwhd-admin-rightpane-inner-panel-body">

						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer type", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<label class="radio-inline"><input class="radio-input-fix" checked type="radio" value="existing" name="bwhd-admin-rightpane-control-ticketnew-optcustomertype" id="bwhd-admin-rightpane-control-ticketnew-optcustomerexisting"><?php _e("Existing", "bravowp-helpdesk"); ?></label>
									<label class="radio-inline"><input class="radio-input-fix" type="radio" value="new" name="bwhd-admin-rightpane-control-ticketnew-optcustomertype"  id="bwhd-admin-rightpane-control-ticketnew-optcustomernew"><?php _e("New Customer", "bravowp-helpdesk"); ?></label>
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group" id="bwhd-admin-rightpane-control-ticketnew-customername" style="display:none;">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer Name", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<input id="bwhd-admin-rightpane-control-ticketnew-txtcustomername" class="form-control" type="text">
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group" id="bwhd-admin-rightpane-control-ticketnew-customeremail" style="display:none;">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Customer Email", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<input id="bwhd-admin-rightpane-control-ticketnew-txtcustomeremail" class="form-control" type="text">
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group" id="bwhd-admin-rightpane-control-ticketnew-customerexisting">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Select Customer", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<select id="bwhd-admin-rightpane-control-ticketnew-ddlexistingcustomer" class="selectpicker">
										<option value="0">(...)</option>
										<?php

											$customer_array = bwhd_controllers_customers_listfordashboardticketcreate();
											foreach( $customer_array as $customer_info ) 
											{
												echo "<option value='" . $customer_info["id"] . "'>" .$customer_info["display_name"] . "</option>";
											}

										?>    
									</select>
								</div>
								<div class="clear"></div>
							</div>
						</form>

					</div>

					<div class="clear" style="height:30px;"></div>

					<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Ticket Information", "bravowp-helpdesk"); ?></div>

					<div class="bwhd-admin-rightpane-inner-panel-body">

						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label bwhd-admin-label-required"><?php _e("Ticket Title", "bravowp-helpdesk"); ?></label>
								<div class="col-sm-9">
									<input id="bwhd-admin-rightpane-control-ticketnew-txttitle" class="form-control" type="text">
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Ticket Description", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<textarea id="bwhd-admin-rightpane-control-ticketnew-txtdescription" class="form-control" rows="3" style="height:auto !important;"></textarea>
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label bwhd-admin-label-required"><?php _e("Ticket Category", "bravowp-helpdesk"); ?></label>
								<div class="col-md-9">
									<select id="bwhd-admin-rightpane-control-ticketnew-ddlcategory" class="selectpicker">
										<option value="0">(...)</option>
										<?php

											$categories_array = bwhd_controllers_categories_list();
											foreach( $categories_array as $categories_info ) 
											{
												echo "<option value='" . $categories_info->category_id . "'>" . $categories_info->category_description . "</option>";
											}

										?>    
									</select>
								</div>
								<div class="clear"></div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
								</div>
								<div class="col-md-9">
									<a class="btn btn-success" onclick="bwhd_admin_ticketsnew_insertticket();"><?php _e("Save Ticket", "bravowp-helpdesk"); ?></a>
								</div>
								<div class="clear"></div>
							</div>

							<div id="bwhd-admin-rightpane-control-ticketnew-validation" class="alert alert-warning text-center" role="alert" style="display:none;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>