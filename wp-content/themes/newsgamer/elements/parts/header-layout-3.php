<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-layout-3">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-md-8" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <!-- start:logo -->
            <?php echo MipThemeFramework_Util::miptheme_set_logo(); ?>
            <meta itemprop="name" content="<?php bloginfo('name')?>">
            <!-- end:logo -->
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-md-4 text-center">
            <div class="wrap-container">
                <form id="search-form" method="get" action="<?php echo home_url( '/' ); ?>">
                    <input type="text" name="s" placeholder="<?php esc_html_e('Search', 'Newsgamer'); ?> <?php bloginfo('name'); ?>" value="<?php echo get_search_query(); ?>" />
                    <button><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
        <!-- end:col -->

    </div>
    <!-- end:row -->
</div>
<!-- end:header-branding -->
