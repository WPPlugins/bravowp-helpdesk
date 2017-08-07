<div id="bwhd-admin-rightpane-control-settings"  class="bwhd-admin-rightpane-control">
	
	<div class="bwhd-admin-rightpane-page-header">

		<div class="bwhd-admin-rightpane-page-header-title"><?php _e("Helpdesk Settings", "bravowp-helpdesk"); ?></div>

	</div>

	<div class="row">

		<div class="col-md-12">

			<div class="clearfix">

				<div class="bwhd-admin-rightpane-horizontalsubmenu">
					<ul class="menu" id="bwhd-admin-rightpane-horizontalsubmenu-settings">
						<li id="bwhd-admin-rightpane-horizontalsubmenu-settings-li-details" class="bwhd-admin-rightpane-horizontalsubmenu-selecteditem" onclick="bwhd_admin_settings_menuclick('general');">
							<a><i class="fa fa-cogs"></i> <?php _e("General", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-rightpane-horizontalsubmenu-settings-li-notifications" onclick="bwhd_admin_settings_menuclick('notifications');">
							<a><i class="fa fa-envelope-o"></i> <?php _e("Notifications", "bravowp-helpdesk"); ?></a>
						</li>
						<li id="bwhd-admin-rightpane-horizontalsubmenu-settings-li-attachments" onclick="bwhd_admin_settings_menuclick('attachments');">
							<a><i class="fa fa-upload"></i> <?php _e("Attachments", "bravowp-helpdesk"); ?></a>
						</li>
					</ul>
				</div>

			</div>

			<div id="bwhd-admin-settingspanel-general" class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default">

				<form class="form-horizontal col-sm-12">

					<div class="form-group bwhd-admin-settings-group">
						<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Allow UnRegistered User to create Tickets?", "bravowp-helpdesk"); ?></label>
						<div class="col-sm-5">
						  <select class="form-control form-control-force-auto-width" id="bwhd-admin-rightpane-control-settings-allowticketunregistered" >
							<option value="no" <?php if ( get_option( "bwhd_allowticketunregistered", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_allowticketunregistered", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						  </select>
						</div>
						<div class="col-sm-5">
							<?php _e("Use this settings to restrict the use of front-end Helpdesk to registered users only. Default: No.", "bravowp-helpdesk"); ?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group bwhd-admin-settings-group">
						<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Require CAPTCHA on Ticket Creation?", "bravowp-helpdesk"); ?></label>
						<div class="col-sm-5">
						  <select class="form-control form-control-force-auto-width" id="bwhd-admin-rightpane-control-settings-requirecaptcha" >
							<option value="no" <?php if ( get_option( "bwhd_require_captcha", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_require_captcha", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						  </select>
						</div>
						<div class="col-sm-5">
							<?php _e("Set this yes to require a CAPTCHA validation when users create new Support Tickets. Default: No.", "bravowp-helpdesk"); ?>
						</div>
						<div class="clear"></div>
					</div>
				
					<div class="form-group bwhd-admin-settings-group">
						<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Enable System Events Log?", "bravowp-helpdesk"); ?></label>
						<div class="col-sm-5">
						  <select class="form-control form-control-force-auto-width" id="bwhd-admin-rightpane-control-settings-enableeventslog" >
							<option value="no" <?php if ( get_option( "bwhd_log_enable", "no" ) == "no" ) { echo "selected"; } ?>><?php _e("No", "bravowp-helpdesk"); ?></option>
							<option value="yes"<?php if ( get_option( "bwhd_log_enable", "no" ) == "yes" ) { echo "selected"; } ?>><?php _e("Yes", "bravowp-helpdesk"); ?></option>
						  </select>
						</div>
						<div class="col-sm-5">
							<?php _e("Enable the logging of system activity only for debug purpouses or in case of errors. Logging will slow down loading times. Default: No.", "bravowp-helpdesk"); ?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group bwhd-admin-settings-group">
						<label class="col-sm-2 control-label bwhd-admin-setting-label"><?php _e("Helpdesk Email", "bravowp-helpdesk"); ?></label>
						<div class="col-sm-5">
						  <input type='text' id="bwhd-admin-rightpane-control-settings-helpdeskemail" class="form-control form-control-force-auto-width" style="width:80%;" value="<?php echo get_option( "bwhd_helpdeskemail", "" ); ?>" ></input>
						</div>
						<div class="col-sm-5">
							<?php _e("The email address used to receive notifications and that will be used as sender email address. Note: requires BravoWP Email Notifications add-on installed in order to be used.", "bravowp-helpdesk"); ?>
						</div>
						<div class="clear"></div>
					</div>
			  
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a class="btn btn-success" onclick="bwhd_admin_settings_save();"><?php _e("Save Settings", "bravowp-helpdesk"); ?></a>
						</div>
					</div>
				  
				</form>

				<div class="clear"></div>

			</div>

			<div id="bwhd-admin-settingspanel-notifications" class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default" style="display:none;">

				<?php if ( bwhd_globals_checkpluginactive("notifications") ) { 

					include( bwhd_globals()->plugin_url . '../bravowp-helpdesk-notifications/controls/settings-list.php' ); 
					include( bwhd_globals()->plugin_url . '../bravowp-helpdesk-notifications/controls/settings-edit.php' ); 	

				} else { ?>

					<div style="height:40px;"></div>
					<?php echo bwhd_placeholders_addonavailable() ?>
					<div style="height:40px;"></div>

				<?php } ?>

			</div>

			<div id="bwhd-admin-settingspanel-attachments" class="bwhd-admin-rightpane-panel bwhd-admin-rightpane-panel-default" style="display:none;">

				<?php if ( bwhd_globals_checkpluginactive("attachments") ) { 

					include( bwhd_globals()->plugin_url . '../bravowp-helpdesk-attachments/controls/settings-edit.php' ); 	

				} else { ?>

					<div style="height:40px;"></div>
					<?php echo bwhd_placeholders_addonavailable() ?>
					<div style="height:40px;"></div>

				<?php } ?>

			</div>

		</div>	

	</div>

</div>