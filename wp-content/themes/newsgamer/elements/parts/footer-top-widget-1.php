<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:footer-section-top -->
<section id="footer-section-top" class="footer-section-top-1">
    <!-- start:container -->
    <div class="container">

        <!-- start:row -->
        <div class="row">

            <!-- start:col -->
            <div class="col col-sm-12 table <?php echo esc_attr($mipthemeoptions_framework['_mp_footer_one_widget_column_1_align']); ?>">
                <?php
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
                        dynamic_sidebar($mipthemeoptions_framework['_mp_footer_one_widget_column_1_source']);
                    endif;
                ?>
            </div>
            <!-- end:col -->

        </div>
        <!-- end:row -->

    </div>
    <!-- end:container -->
</section>
<!-- end:footer-section-top -->
