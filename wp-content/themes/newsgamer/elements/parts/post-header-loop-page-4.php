<?php
    $mip_current_page   = mipthemeframework_get_mip_current_page();
?>
<!-- start:single full header -->
<div id="single-post-header-full" class="article-post animated fadeIn header-<?php echo esc_attr($mip_current_page->page_template); ?>">
    <?php
    // ads section one
    if ( $mip_current_page->ads_post_section_one ) {
        $ad_unit        = new MipThemeFramework_Ad();
        $ad_unit->id    = (int)$mip_current_page->ads_post_section_one;
        // display ad unit
        $ad_unit->formatLayoutAd('row ad ad-section-one');
    }
    ?>
    <!-- start:article post header -->
    <?php get_template_part( 'elements/parts/post-header-title' ); ?>
    <!-- end:article post header -->
</div>
<!-- end:single full header -->
