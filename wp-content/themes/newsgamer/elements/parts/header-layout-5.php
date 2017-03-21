<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-layout-5">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-sm-4 text-left">
            <div class="ad">
                <?php
                    $miptheme_header_banner       = isset($mipthemeoptions_framework['_mp_header_banner_left'])       ? $mipthemeoptions_framework['_mp_header_banner_left']      : 0;
                    if ( $miptheme_header_banner != 0 ) {
                        $ad_unit        = new MipThemeFramework_Ad();
                        $ad_unit->id    = (int)$mipthemeoptions_framework['_mp_header_banner_left'];

                        $ad_unit->formatBlankAd();
                    }
                ?>
            </div>
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-sm-4 text-center" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <!-- start:logo -->
            <?php echo MipThemeFramework_Util::miptheme_set_logo(); ?>
            <meta itemprop="name" content="<?php bloginfo('name')?>">
            <!-- end:logo -->
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-sm-4 text-right">
            <div class="ad">
                <?php
                    $miptheme_header_banner       = isset($mipthemeoptions_framework['_mp_header_banner_right'])       ? $mipthemeoptions_framework['_mp_header_banner_right']      : 0;
                    if ( $miptheme_header_banner != 0 ) {
                        $ad_unit        = new MipThemeFramework_Ad();
                        $ad_unit->id    = (int)$mipthemeoptions_framework['_mp_header_banner_right'];

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
