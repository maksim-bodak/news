<?php
/**
 * WeeklyNews Theme
 *
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */
?>
                </div>
            </div>
            <!-- end:container -->

            <!-- start:ad-bottom-banner -->
            <?php get_template_part('elements/ad-bottom-banner'); ?>
            <!-- end:ad-bottom-banner -->

            <!-- start:page footer -->
            <?php get_template_part('elements/footer-navigation'); ?>
            <!-- end:page footer -->

        </div>
        <!-- end:page inner wrap -->
    </div>
    <!-- end:page outer wrap -->

    <!-- start:wp_footer -->
    <script>
        "use strict";
        <?php
            // set footer variables
            MipThemeFramework_Util::miptheme_set_footer_vars();
        ?>

        var mipthemeLocalCache = {};
        ( function () {
            "use strict";
            mipthemeLocalCache = {
                data: {},
                remove: function (resource_id) {
                    delete mipthemeLocalCache.data[resource_id];
                },
                exist: function (resource_id) {
                    return mipthemeLocalCache.data.hasOwnProperty(resource_id) && mipthemeLocalCache.data[resource_id] !== null;
                },
                get: function (resource_id) {
                    return mipthemeLocalCache.data[resource_id];
                },
                set: function (resource_id, cachedData) {
                    mipthemeLocalCache.remove(resource_id);
                    mipthemeLocalCache.data[resource_id] = cachedData;
                }
            };
        })();
    </script>
    <?php
        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }

        wp_footer();
    ?>
    <!-- end:wp_footer -->

</body>
</html>
