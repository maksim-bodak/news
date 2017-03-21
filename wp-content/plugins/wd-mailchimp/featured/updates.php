<?php

/**
 * Admin page
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$upd = MWD_Admin::get_instance();
$upd->check_for_update();
$mwd_plugins=$upd->mwd_plugins;
$updates=$upd->updates;
?>
<link href="<?php echo plugins_url( 'admin.css', __FILE__ )?>" rel="stylesheet"/>

<div class="wrap">
	<?php settings_errors(); ?>
	<div id="mwd-settings">
		<div id="mwd-settings-content">
			<h2 id="add_on_title"><?php echo esc_html( get_admin_page_title() ); ?></h2>


			<div class="main-plugin_desc-cont">
				You can download the latest version of your plugins from your  <a href="https://web-dorado.com" target="_blank"> Web-Dorado.com</a>  account.
				After deactivate and
				delete the current version.
				Install the downloaded latest version of the plugin.
			</div>

			<br/>
			<br/>

			<?php
			if ( $mwd_plugins ) {
				$update = 0;
				if ( isset( $mwd_plugins[31] ) ) {

					$project = $mwd_plugins[31];
					unset( $mwd_plugins[31] );
					if ( isset( $updates[31] ) ) {
						$update = 1;
					}
					?>
					<div class="main-plugin">
						<div class="mwd-add-on">
								<?php if ( $project['mwd_data']['image'] ) { ?>
									<div class="mwd-figure-img">
										<a href="<?php echo $project['mwd_data']['url'] ?>" target="_blank">
											<img src="<?php echo $project['mwd_data']['image'] ?>"/>
										</a>
									</div>
								<?php } ?>

						</div>
						<div class="main-plugin-info">
							<h2>
								<a href="<?php echo $project['mwd_data']['url'] ?>" target="_blank"><?php echo $project['Title'] ?></a>
							</h2>
							<div class="main-plugin_desc-cont">
								<div class="main-plugin-desc"><?php echo $project['mwd_data']['description'] ?></div>
								<div class="main-plugin-desc main-plugin-desc-info">
									<p><a href="<?php echo $project['mwd_data']['url'] ?>" target="_blank">Version <?php echo $project['Version']?></a></p>
								</div>

								<?php if ( isset( $updates[31][0] ) ) { ?>
									<span class="update-info">There is a new  <?php echo $updates[31][0]['version'] ?> version available.</span>
									<p><span>What's new:</span></p>
									<div class="mwd_last_update"><?php echo $updates[31][0]['version'] ?>
										- <?php echo strip_tags( $updates[31][0]['note'] ) ?></div>
									<?php unset( $updates[31][0] ); ?>
									<?php if ( count( $updates[31] ) > 0 ) { ?>

											<div class="mwd_more_updates">
										<?php foreach ( $updates[31] as $update ) {
											?>
											<div class="mwd_update"><?php echo $update['version'] ?>
												- <?php echo strip_tags( $update['note'] ) ?></div>
										<?php
										}
										?>
											</div>
										<a href="#" class="mwd_show_more_updates">More updates</a>
									<?php
									}
								} ?>
								
								
						
								

							</div>
						</div>
					</div>
				<?php
				}?>
				<div class="mwd-addons_updates">
					<?php
					foreach ( $mwd_plugins as $id => $project ) {
						?>
						<div class="mwd-add-on">
							<figure class="mwd-figure">
								<div class="mwd-figure-img">
									<a href="<?php echo $project['mwd_data']['url'] ?>" target="_blank">
										<?php if ( $project['mwd_data']['image'] ) { ?>
											<img src="<?php echo $project['mwd_data']['image'] ?>"/>
										<?php } ?>
									</a>
								</div>
								<figcaption class="mwd-addon-descr mwd-figcaption">
									<?php if ( isset( $updates[ $id ][0] ) ) { ?>
										<p>What's new:</p>
										<?php echo strip_tags( $updates[ $id ][0]['note'] ) ?>
									<?php } else { ?><?php echo $project['Title'] ?> is up to date
									<?php } ?>
								</figcaption>
							</figure>
							<h2><?php echo $project['Title'] ?></h2>
							<div class="main-plugin-desc-info">
								<p><a href="<?php echo $project['mwd_data']['url'] ?>"
								      target="_blank"><?php echo $project['Version'] ?></a> | Web-Dorado</p>
							</div>
							<?php if ( isset( $updates[ $id ] ) ) { ?>
								<div class="mwd-addon-descr-update">
									<span
										class="update-info">There is an new  <?php echo $updates[ $id ][0]['version'] ?>
										version</span><br/>
								</div>
							<?php } ?>
						</div>
					
					<?php
					}?>
				</div>
			<?php
			}
			?>

		</div>
		<!-- #mwd-settings-content -->
	</div>
	<!-- #mwd-settings -->
</div><!-- .wrap -->

<script>
    jQuery('.mwd_show_more_updates').click(function(){
        if( jQuery('.mwd_more_updates').is(':visible') == false) {
            jQuery(this).text('Show less');
        }else{
            jQuery(this).text('More updates');
        }
       jQuery('.mwd_more_updates').slideToggle();
        return false;
    });

</script>
