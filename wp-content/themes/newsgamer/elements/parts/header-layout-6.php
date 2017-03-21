<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-layout-6">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-md-6" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <!-- start:logo -->
            <?php echo MipThemeFramework_Util::miptheme_set_logo(); ?>
            <meta itemprop="name" content="<?php bloginfo('name')?>">
            <!-- end:logo -->
        </div>
        <!-- end:col -->

        <?php
            if ( isset($mipthemeoptions_framework['_mp_header_weather_location']) && ($mipthemeoptions_framework['_mp_header_weather_location'] != '') ) {
        ?>
        <!-- start:col -->
        <div class="col-md-6">
            <div class="wrap-container text-right">
                <div class="weather" id="weather">
                    <i class="icon"></i>
                    <h3><span class="glyphicon glyphicon-map-marker"></span> <span class="location"><?php echo esc_html( $mipthemeoptions_framework['_mp_header_weather_location'] ); ?></span> <span class="temp"></span></h3>
                    <span class="date"><?php if ( isset($mipthemeoptions_framework['_mp_header_weather_show_date']) && (bool)$mipthemeoptions_framework['_mp_header_weather_show_date']) echo date_i18n(MIPTHEME_DATE_HEADER); ?> <?php if ( isset($mipthemeoptions_framework['_mp_header_weather_show_desc']) && (bool)$mipthemeoptions_framework['_mp_header_weather_show_desc']) echo '<span class="desc"></span>'; ?></span>
                </div>
            </div>
        </div>
        <!-- end:col -->
        <script>
            "use strict";
            var weather_widget      = true;
            var weather_lang        = '<?php echo esc_js( ( isset($mipthemeoptions_framework['_mp_header_weather_lang']) && ($mipthemeoptions_framework['_mp_header_weather_lang'] != '') ) ? $mipthemeoptions_framework['_mp_header_weather_lang'] : '' ); ?>';
            var weather_location    = '<?php echo esc_js($mipthemeoptions_framework['_mp_header_weather_location']); ?>';
            var weather_unit        = '<?php echo esc_js($mipthemeoptions_framework['_mp_header_weather_temperature']); ?>';
        </script>
        <?php
            }
        ?>
    </div>
    <!-- end:row -->
</div>
<!-- end:header-branding -->
