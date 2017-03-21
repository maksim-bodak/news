<!-- start:article post breadcrumb -->
<div class="breadcrumb hidden-xs">
<?php 
    if ( function_exists('yoast_breadcrumb') ) {
        $yoast_options             = get_option( 'wpseo_internallinks' );
		if ( $yoast_options['breadcrumbs-enable'] == true ) {
            yoast_breadcrumb();
        } else {
            breadcrumbs_plus();
        }
    } else {
        breadcrumbs_plus();
    }
?>
</div>
<!-- end:article post header -->
