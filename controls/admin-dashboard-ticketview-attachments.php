<div id="bwhd-admin-rightpane-control-ticketview-attachments">

	<div class="row">

		<div class="col-md-12 col-lg-12">

			<div class="bwhd-admin-rightpane-inner-panel">

				<div class="bwhd-admin-rightpane-inner-panel-title"><?php _e("Attachments", "bravowp-helpdesk"); ?></div>

				<div class="bwhd-admin-rightpane-inner-panel-body">

					<?php if ( bwhd_globals_checkpluginactive("attachments") ) { 

						include( bwhd_globals()->plugin_url . '../bravowp-helpdesk-attachments/controls/admin-ticket-attachments-list.php' ); 

					} else { ?>

						<?php echo bwhd_placeholders_comingsoonpanel() ?>

					<?php } ?>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</div>

</div>