<?php

// Get Grid properties
$mip_top_grid   = new MipThemeFramework_Grid();

// Shortcode Top Grid
if ( $mip_top_grid->top_grid_enabled == 2 ) echo do_shortcode( $mip_top_grid->top_grid_shortcode );

// Top Grid
if ( $mip_top_grid->top_grid_enabled == 1 ) {

    $r = new WP_Query(
        apply_filters( 'top_grid_args', array(
                'category__in'          => $mip_top_grid->top_grid_categories,
                'posts_per_page'        => $mip_top_grid->get_posts_per_page(),
                //'offset'                => $post_offset,
                'tag__in'               => $mip_top_grid->top_grid_tags,
                'no_found_rows'         => true,
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => true,
                'orderby'               => $mip_top_grid->top_grid_sort,
                'meta_key'              => '_thumbnail_id',
                'post_type'             => $mip_top_grid->top_grid_posttypes,
            )
        )
    );

    if ($r->have_posts()) :
        echo '<div id="top-grid" class="'. $mip_top_grid->top_grid_layout .' '. $mip_top_grid->top_grid_full_width .''. $mip_top_grid->top_grid_verge_style .' clearfix">';
        echo '  <div class="row">';
        include_once( get_template_directory() . '/elements/parts/'. $mip_top_grid->top_grid_layout .'.php' );
        echo '  </div>';
        echo '</div>';
    endif;
    wp_reset_postdata();

}
?>
