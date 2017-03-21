<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-layout-1">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-md-4" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <!-- start:logo -->
            <?php echo MipThemeFramework_Util::miptheme_set_logo(); ?>
            <meta itemprop="name" content="<?php bloginfo('name')?>">
            <!-- end:logo -->
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="hidden-xs col-md-8 text-right">
            <div class="ad">
                <?php
                    $miptheme_header_banner       = isset($mipthemeoptions_framework['_mp_header_banner'])       ? $mipthemeoptions_framework['_mp_header_banner']      : 0;
                    if ( $miptheme_header_banner != 0 ) {
                        $ad_unit        = new MipThemeFramework_Ad();
                        $ad_unit->id    = (int)$mipthemeoptions_framework['_mp_header_banner'];

                        $ad_unit->formatBlankAd();
                    }
                ?>
            </div>
        </div>
        <!-- end:col -->

    </div>
    <!-- end:row -->
</div>
<!-- end:header-branding -->
