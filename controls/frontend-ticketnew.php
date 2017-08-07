<?php

	$content_parag_intro_authenticated = __("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button. You can review your existing Support Tickets by clicking on the 'Search Ticket' button.", "bravowp-helpdesk");
	$content_parag_intro_unauthenticated = __("Welcome to our Helpdesk. If you have a problem, a question or a request for help, you can create a New Support Ticket by clicking on the following button.", "bravowp-helpdesk");



?>


<div id="bwhd-frontend-controls-ticketnew" class="bwhd-frontend-panel-default" style="display:none;">

	<div class="bwhd-ajax-loader" id="bwhd-frontend-controls-ticketnew-loader" style="display:none;">
	  <img src="<?php echo bwhd_globals()->loadergif_url; ?>" class="bwhd-ajax-loader">
	</div>

	<div class="bwhd-frontend-panel-default-title">
		<?php _e("Create a new Support Ticket", "bravowp-helpdesk");?>
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

	<form>

			<?php 

				if ( is_user_logged_in() == false)
				{

					?>

						<div class="form-group">

							<label class="bwhd-frontend-label-required"><?php _e("Your Name", "bravowp-helpdesk");?></label>
							<input id="bwhd-frontend-controls-ticketnew-txtcustomername" class="form-control" type="text" maxlength="100">

						</div>

					<?php

				}

			?>


			<?php 

				if ( is_user_logged_in() == false)
				{

					?>

						<div class="form-group">

							<label class="bwhd-frontend-label-required"><?php _e("Your Email", "bravowp-helpdesk");?></label>
							<input id="bwhd-frontend-controls-ticketnew-txtcustomeremail" class="form-control" type="text" maxlength="100">

						</div>

					<?php

				}

			?>

		<div class="form-group">

			<label class="bwhd-frontend-label-required"><?php _e("Ticket Title", "bravowp-helpdesk");?></label>
			<input type="text" class="form-control" id="bwhd-frontend-controls-ticketnew-txttickettitle" maxlength="50" />

		</div>

		<div class="form-group">

			<label class="bwhd-frontend-label-required"><?php _e("Problem / Request Description", "bravowp-helpdesk");?></label>
			<textarea class="form-control" id="bwhd-frontend-controls-ticketnew-txtticketproblem" rows="3" style="height:auto !important;" ></textarea>

		</div>

		<div class="form-group">

			<label class="bwhd-frontend-label-required"><?php _e("Category", "bravowp-helpdesk");?></label>
			<div class="clear"></div>
			<select id="bwhd-frontend-controls-ticketnew-ddlcategory" class="selectpicker">
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

		<?php 

			if ( get_option( "bwhd_require_captcha", "no" ) == "yes" )
			{

				?>

					<div class="form-group">

						<label class="bwhd-frontend-label-required"><?php _e("Please type the following value", "bravowp-helpdesk");?></label>

						<div class="clearfix"></div>
						
						<div class=" col-sm-2 no-gutter ">
							<input type="text" class="form-control" id="bwhd-frontend-controls-ticketnew-txtcaptcha" maxlength="5" />
						</div>
						<div class=" col-sm-10 ">
							<img src='<?php echo $globals->plugin_httpurl . "/utils/captcha.php"; ?>'>
						</div>		

						<div class="clearfix"></div>			

					</div>

				<?php

			}

		?>

		<div class="form-group">
			<a class="btn btn-success" onclick="bwhd_frontend_button_newticket_click_save();"><i class="fa fa-floppy-o"></i> <?php _e("Save Ticket", "bravowp-helpdesk");?></a>
			<a class="btn btn-default" onclick="bwhd_frontend_button_newticket_click_cancel();"><i class="fa fa-arrow-circle-o-left"></i> <?php _e("Cancel", "bravowp-helpdesk");?></a>
		</div>

		<div id="bwhd-frontend-ticketnew-validation" class="alert alert-warning text-center" role="alert" style="display:none;"><i class="fa fa-exclamation bhwd-alert-redicon"></i><span></span></div>

	</form>

</div>