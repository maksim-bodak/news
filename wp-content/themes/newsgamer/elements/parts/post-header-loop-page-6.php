<?php
$mip_current_page   = mipthemeframework_get_mip_current_page();
$format             = get_post_format();
?>
<!-- start:single full header -->
<div id="single-post-header-full" class="article-post animated fadeIn header-background <?php echo 'header-'. $mip_current_page->page_template; ?>">
    <?php
    $att_img_src                = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
    $curr_post_img              = $att_img_src[0];


    echo    '<div class="relative">';
    echo    '<div class="img-parallax" data-image="'. esc_url($curr_post_img) .'"></div>';

    get_template_part( 'elements/parts/post-header-title' );

    echo    '</div>';

    // ads section one
    /*if ( $mip_current_page->ads_post_section_one ) {
        $ad_unit        = new MipThemeFramework_Ad();
        $ad_unit->id    = (int)$mip_current_page->ads_post_section_one;
        // display ad unit
        $ad_unit->formatLayoutAd('row ad ad-section-one');
    }*/
    ?>
</div>
<!-- end:single full header -->
