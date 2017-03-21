<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-widget header-layout-widget-3">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-md-4 <?php echo esc_attr($mipthemeoptions_framework['_mp_header_widget_column_1_align']); ?>">
            <?php
                if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
                    dynamic_sidebar($mipthemeoptions_framework['_mp_header_widget_column_1_source']);
                endif;
            ?>
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-md-4 <?php echo esc_attr($mipthemeoptions_framework['_mp_header_widget_column_2_align']); ?>">
            <?php
                if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
                    dynamic_sidebar($mipthemeoptions_framework['_mp_header_widget_column_2_source']);
                endif;
            ?>
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-md-4 <?php echo esc_attr($mipthemeoptions_framework['_mp_header_widget_column_3_align']); ?>">
            <?php
                if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
                    dynamic_sidebar($mipthemeoptions_framework['_mp_header_widget_column_3_source']);
                endif;
            ?>
        </div>
        <!-- end:col -->

    </div>
    <!-- end:row -->
</div>
<!-- end:header-branding -->
