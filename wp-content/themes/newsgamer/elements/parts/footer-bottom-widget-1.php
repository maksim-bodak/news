<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:footer-section-bottom -->
<section id="footer-section-bottom" class="footer-section-bottom-1">
    <!-- start:container -->
    <div class="container">

        <!-- start:row -->
        <div class="row">

            <!-- start:col -->
            <div class="col-sm-12 table <?php echo esc_attr($mipthemeoptions_framework['_mp_footer_two_widget_column_1_align']); ?>">
                <?php
                    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
                        dynamic_sidebar($mipthemeoptions_framework['_mp_footer_two_widget_column_1_source']);
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
