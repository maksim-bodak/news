<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Img_Widget' ) ) {

    class MipThemeFramework_Img_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_img_widget', // Base ID
                esc_html__('MipTheme [Image]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display image', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $img_source             = apply_filters( 'widget_img_source', $instance['img_source'] );
            $img_source_retina      = apply_filters( 'widget_img_source_retina', $instance['img_source_retina'] );
            $img_link               = apply_filters( 'widget_img_link', $instance['img_link'] );
            $img_padding            = apply_filters( 'widget_img_padding', $instance['img_padding'] );
            $img_responsive         = apply_filters( 'img_responsive',  esc_textarea($instance['img_responsive']) );
            if (! empty( $instance['img_link_target'] ) ) { $img_link_target = apply_filters( 'widget_img_link_target', $instance['img_link_target'] ); } else { $img_link_target = false; }
            $img_linkTarget         = ( $img_link_target ) ? ' target="_blank"' : '';

            if ( !empty( $img_source ) ) {
                if ( !empty( $img_link ) ) {
                    echo '<aside class="widget"><div'. ( !empty( $img_padding ) ? ' style="padding:'. esc_attr($img_padding) .';"'  : '' ) .'><a href="'. esc_url($img_link) .'"'. $img_linkTarget .'><img src="'. esc_url($img_source) .'" alt=""'. ( !empty( $img_responsive ) ? ' class="img-responsive"'  : '' ) .''. ( !empty( $img_source_retina ) ? ' data-retina="'. esc_url($img_source_retina) .'"'  : '' ) .' /></a></div></aside>';
                } else {
                    echo '<aside class="widget"><div'. ( !empty( $img_padding ) ? ' style="padding:'. esc_attr($img_padding) .';"'  : '' ) .'><img src="'. esc_url($img_source) .'" alt=""'. ( !empty( $img_responsive ) ? ' class="img-responsive"'  : '' ) .''. ( !empty( $img_source_retina ) ? ' data-retina="'. esc_url($img_source_retina) .'"'  : '' ) .' /></div></aside>';
                }
            }
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'img_source' ] ) ) { $img_source = $instance[ 'img_source' ];       } else { $img_source = ''; }
            if ( isset( $instance[ 'img_source_retina' ] ) ) { $img_source_retina = $instance[ 'img_source_retina' ];       } else { $img_source_retina = ''; }
            if ( isset( $instance[ 'img_link' ] ) ) { $img_link = $instance[ 'img_link' ];       } else { $img_link = ''; }
            if ( isset( $instance[ 'img_link_target' ] ) ) { $img_link_target = esc_textarea($instance[ 'img_link_target' ]);       } else { $img_link_target = ''; }
            if ( isset( $instance[ 'img_padding' ] ) ) { $img_padding = $instance[ 'img_padding' ];       } else { $img_padding = ''; }
            if ( isset( $instance[ 'img_responsive' ] ) ) { $img_responsive = esc_textarea($instance[ 'img_responsive' ]);       } else { $img_responsive = ''; }


            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'img_source' ) ); ?>"><?php esc_html_e( 'Image source:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_source' ) ); ?>" type="text" value="<?php echo esc_attr( $img_source ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'img_source_retina' ) ); ?>"><?php esc_html_e( 'Image Retina source:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_source_retina' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_source_retina' ) ); ?>" type="text" value="<?php echo esc_attr( $img_source_retina ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>"><?php esc_html_e( 'Image link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_link' ) ); ?>" type="text" value="<?php echo esc_attr( $img_link ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'img_padding' ) ); ?>"><?php esc_html_e( 'Image padding: (optional)', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_padding' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_padding' ) ); ?>" type="text" value="<?php echo esc_attr( $img_padding ); ?>"><br />
                <i>* e.g. 10px 15px 20px 30px</i>
            </p>
            <p><input id="<?php echo esc_attr( $this->get_field_id( 'img_link_target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_link_target' ) ); ?>" type="checkbox"<?php if ($img_link_target) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'img_link_target' ) ); ?>"><?php esc_html_e( 'Open in new window', 'Newsgamer' ); ?></label></p>
            <p><input id="<?php echo esc_attr( $this->get_field_id( 'img_responsive' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_responsive' ) ); ?>" type="checkbox"<?php if ($img_responsive) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'img_responsive' ) ); ?>"><?php esc_html_e( 'Responsive image', 'Newsgamer' ); ?></label></p>

            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['img_source'] = ( ! empty( $new_instance['img_source'] ) ) ? strip_tags( $new_instance['img_source'] ) : '';
            $instance['img_source_retina'] = ( ! empty( $new_instance['img_source_retina'] ) ) ? strip_tags( $new_instance['img_source_retina'] ) : '';
            $instance['img_link'] = ( ! empty( $new_instance['img_link'] ) ) ? strip_tags( $new_instance['img_link'] ) : '';
            $instance['img_link_target'] = ( ! empty( $new_instance['img_link_target'] ) ) ? strip_tags( $new_instance['img_link_target'] ) : '';
            $instance['img_padding'] = ( ! empty( $new_instance['img_padding'] ) ) ? strip_tags( $new_instance['img_padding'] ) : '';
            $instance['img_responsive'] = ( ! empty( $new_instance['img_responsive'] ) ) ? strip_tags( $new_instance['img_responsive'] ) : '';

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_AdsImg_Widget' ) ) {

    class MipThemeFramework_AdsImg_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_ads_img_widget', // Base ID
                esc_html__('MipTheme [Image Ad]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display ads - max 300px', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $ad_source          = apply_filters( 'widget_ad_source', $instance['ad_source'] );
            //$ad_link            = apply_filters( 'widget_ad_link', $instance['ad_link'] );
            if (! empty( $instance['ad_link'] ) ) { $ad_link = apply_filters( 'widget_ad_link', $instance['ad_link'] ); } else { $ad_link = ''; }
            if (! empty( $instance['ad_link_target'] ) ) { $ad_link_target = apply_filters( 'widget_ad_link_target', $instance['ad_link_target'] ); } else { $ad_link_target = false; }
            $ad_background      = apply_filters( 'widget_ad_background', $instance['ad_background'] );
            $ad_backgroundClass = ( $ad_background ) ? ' ad-separator' : '';
            $ad_linkTarget      = ( $ad_link_target ) ? ' target="_blank"' : '';

            if ( !empty( $ad_source ) ) {
                echo '<div class="widget ad'. esc_attr($ad_backgroundClass) .'"><a href="'. esc_url($ad_link) .'"'. $ad_linkTarget .'><img src="'. esc_url($ad_source) .'" alt="" /></a></div>';
            }
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'ad_source' ] ) ) { $ad_source = $instance[ 'ad_source' ];       } else { $ad_source = ''; }
            if ( isset( $instance[ 'ad_link' ] ) ) { $ad_link = $instance[ 'ad_link' ];       } else { $ad_link = ''; }
            if ( isset( $instance[ 'ad_link_target' ] ) ) { $ad_link_target = $instance[ 'ad_link_target' ];       } else { $ad_link_target = ''; }
            if ( isset( $instance[ 'ad_background' ] ) ) { $ad_background = $instance[ 'ad_background' ];       } else { $ad_background = ''; }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>"><?php esc_html_e( 'Image source:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_source' ) ); ?>" type="text" value="<?php echo esc_attr( $ad_source ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'ad_link' ) ); ?>"><?php esc_html_e( 'Image link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ad_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_link' ) ); ?>" type="text" value="<?php echo esc_attr( $ad_link ); ?>">
            </p>
            <p><input id="<?php echo esc_attr( $this->get_field_id( 'ad_link_target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_link_target' ) ); ?>" type="checkbox"<?php if ($ad_link_target) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'ad_link_target' ) ); ?>"><?php esc_html_e( 'Open in new window', 'Newsgamer' ); ?></label></p>
            <!--p><input id="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_background' ) ); ?>" type="checkbox"<?php if ($ad_background) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>"><?php esc_html_e( 'Show with background color', 'Newsgamer' ); ?></label></p-->
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['ad_source']      = ( ! empty( $new_instance['ad_source'] ) )         ? strip_tags( $new_instance['ad_source'] ) : '';
            $instance['ad_link']        = ( ! empty( $new_instance['ad_link'] ) )           ? strip_tags( $new_instance['ad_link'] ) : '';
            $instance['ad_link_target'] = ( ! empty( $new_instance['ad_link_target'] ) )    ? strip_tags( $new_instance['ad_link_target'] ) : '';
            $instance['ad_background']  = ( ! empty( $new_instance['ad_background'] ) )     ? strip_tags( $new_instance['ad_background'] ) : '';

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_AdsEmbed_Widget' ) ) {

    class MipThemeFramework_AdsEmbed_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_ads_embed_widget', // Base ID
                esc_html__('MipTheme [Embed Ad]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display ads - max 300px', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $ad_source          = apply_filters( 'widget_ad_source', $instance['ad_source'] );
            $ad_background      = apply_filters( 'widget_ad_background',  esc_textarea($instance['ad_background']) );
            $ad_backgroundClass = ( $ad_background ) ? ' ad-separator' : '';

            if ( ! empty( $ad_source ) ) {
                echo '<div class="ad'. esc_attr($ad_backgroundClass) .'">'. $ad_source .'</div>';
            }
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'ad_source' ] ) ) { $ad_source = $instance[ 'ad_source' ];       } else { $ad_source = ''; }
            if ( isset( $instance[ 'ad_background' ] ) ) { $ad_background = esc_textarea($instance[ 'ad_background' ]);       } else { $ad_background = ''; }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>"><?php esc_html_e( 'Ad source:', 'Newsgamer' ); ?></label>
                <textarea class="widefat" rows="10" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_source' ) ); ?>"><?php echo esc_attr( $ad_source ); ?></textarea>
            </p>
            <!--p><input id="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_background' ) ); ?>" type="checkbox"<?php if ($ad_background) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>"><?php esc_html_e( 'show with background color', 'Newsgamer' ); ?></label></p-->
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['ad_source'] = ( ! empty( $new_instance['ad_source'] ) ) ? $new_instance['ad_source'] : '';
            $instance['ad_background'] = ( ! empty( $new_instance['ad_background'] ) ) ? strip_tags( $new_instance['ad_background'] ) : '';

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_AdsSystem_Widget' ) ) {

    class MipThemeFramework_AdsSystem_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_ads_system_widget', // Base ID
                esc_html__('MipTheme [Ads System]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display ads from Ads System', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $ad_source          = apply_filters( 'widget_ad_source', $instance['ad_source'] );
            $ad_background      = apply_filters( 'widget_ad_background', $instance['ad_background'] );
            $ad_backgroundClass = ( $ad_background ) ? ' ad-separator' : '';

            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$ad_source;

            $ad_unit->formatLayoutAd( 'widget ad'. $ad_backgroundClass .'' );
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'ad_source' ] ) ) { $ad_source = $instance[ 'ad_source' ];       } else { $ad_source = ''; }
            if ( isset( $instance[ 'ad_background' ] ) ) { $ad_background = $instance[ 'ad_background' ];       } else { $ad_background = ''; }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>"><?php esc_html_e( 'Ad source:', 'Newsgamer' ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ad_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_source' ) ); ?>">
            <?php

            $args   = array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'no_found_rows' => true, );
            $r      = new WP_Query( $args );
            while ( $r->have_posts() ) : $r->the_post();
                echo '<option value="'. get_the_ID() .'"'. ( ( esc_attr( $ad_source ) == get_the_ID() ) ? ' selected' : '' ) .'>'. get_the_title() .'</option>';
            endwhile;
            wp_reset_postdata();
            ?>
                </select>
            </p>
            <!--p><input id="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_background' ) ); ?>" type="checkbox"<?php if ($ad_background) echo ' checked="checked"'; ?>>&nbsp;<label for="<?php echo esc_attr( $this->get_field_id( 'ad_background' ) ); ?>"><?php esc_html_e( 'show with background color', 'Newsgamer' ); ?></label></p-->
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['ad_source'] = ( ! empty( $new_instance['ad_source'] ) ) ? strip_tags( $new_instance['ad_source'] ) : '';
            $instance['ad_background'] = ( ! empty( $new_instance['ad_background'] ) ) ? strip_tags( $new_instance['ad_background'] ) : '';

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_Quote_Widget' ) ) {

    class MipThemeFramework_Quote_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_quote_widget', // Base ID
                esc_html__('MipTheme [Quote]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display quote with author and source', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $title          = apply_filters( 'widget_title', $instance['title'] );
            $quote_text     = apply_filters( 'widget_quote', $instance['quote_text'] );
            $quote_source   = apply_filters( 'widget_source', $instance['quote_source'] );
            $no_margin_class  = ( isset( $instance['no_margin'] ) && (bool)$instance['no_margin']  ) ? ' no-bottom-margin' : '';

            echo '<aside class="widget module-quote'. $no_margin_class .'">';
            if ( ! empty( $title ) ) {
                echo mipthemeframework_get_string_prefix() . $args['before_title'] . $title . $args['after_title'];
            }
            if ( ! empty( $quote_text ) ) {
                echo '<blockquote><p>' . $quote_text .'</p>';
                if ( ! empty( $quote_source ) ) {
                    echo '<footer>' . $quote_source .'</footer>';
                }
                echo '</blockquote>';
            }
            echo '</aside>';
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ];       } else { $title = esc_html__( 'Weekly Quote', 'Newsgamer' ); }
            if ( isset( $instance[ 'quote_text' ] ) ) { $quote_text = $instance[ 'quote_text' ];       } else { $quote_text = ''; }
            if ( isset( $instance[ 'quote_source' ] ) ) { $quote_source = $instance[ 'quote_source' ];       } else { $quote_source = ''; }
            $nomargin       = isset( $instance['no_margin'] ) ? (bool) $instance['no_margin'] : false;
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'quote_text' ) ); ?>"><?php esc_html_e( 'Quote:', 'Newsgamer' ); ?></label>
                <textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'quote_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quote_text' ) ); ?>"><?php echo esc_attr( $quote_text ); ?></textarea>

                <label for="<?php echo esc_attr( $this->get_field_id( 'quote_source' ) ); ?>"><?php esc_html_e( 'Source:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quote_source' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quote_source' ) ); ?>" type="text" value="<?php echo esc_attr( $quote_source ); ?>">
            </p>

            <!--p><input class="checkbox" type="checkbox" <?php checked( $nomargin ); ?> id="<?php echo esc_attr( $this->get_field_id( 'no_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_margin' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'no_margin' ) ); ?>"><?php esc_html_e( 'No spacing after this widget', 'Newsgamer' ); ?></label></p-->
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['quote_text'] = ( ! empty( $new_instance['quote_text'] ) ) ? strip_tags( $new_instance['quote_text'] ) : '';
            $instance['quote_source'] = ( ! empty( $new_instance['quote_source'] ) ) ? strip_tags( $new_instance['quote_source'] ) : '';
            $instance['no_margin'] = isset( $new_instance['no_margin'] ) ? (bool) $new_instance['no_margin'] : false;

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_RecentPosts_Widget' ) ) {

    class MipThemeFramework_RecentPosts_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_recent_entries_widget', 'description' => esc_html__( "Your site&#8217;s most recent Posts.", 'Newsgamer') );
            parent::__construct('mp_recent_posts_widget', esc_html__('MipTheme [Recent Posts]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_recent_entries_widget';

        }

        function widget($args, $instance) {

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $include_categories = ( ! empty( $instance['include_categories'] ) ) ? $instance['include_categories'] : '';
            $exclude_categories =( ! empty( $instance['exclude_categories'] ) ) ? $instance['exclude_categories'] : '';
            $include_tags       = ( ! empty( $instance['include_tags'] ) ) ? $instance['include_tags'] : '';
            $sort_order         = ( ! empty( $instance['sort_order'] ) ) ? $instance['sort_order'] : '';

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number = 5;
            if ( ! $offset ) $offset = 0;
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';
            $layout = isset( $instance['layout'] ) ? $instance['layout'] : 'layout_one';

            //$show_images = isset( $instance['show_images'] ) ? $instance['show_images'] : false;
            $show_views = isset( $instance['show_views'] ) ? $instance['show_views'] : 0;
            $show_comments = isset( $instance['show_comments'] ) ? $instance['show_comments'] : false;
            $show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : false;
            $show_mid_column = isset( $instance['show_mid_column'] ) ? $instance['show_mid_column'] : false;

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 3.4.0
             *
             * @see WP_Query::get_posts()
             *
             * @param array $args An array of arguments used to retrieve the recent posts.
             */

            $args1 = array(
                'posts_per_page'        => $number,
                'no_found_rows'         => true,
                'post_status'           => 'publish',
                'offset'                => $offset,
                'ignore_sticky_posts'   => true,
                'tag'                   => $include_tags,
                'orderby'               => ( (in_array($sort_order, array('mip_post_views_count', '_mip_post_views_count_7_day_total', '_mip_post_views_count_24_hours_total'))) ? 'meta_value_num' : $sort_order ),
                'meta_key'              => ( (in_array($sort_order, array('mip_post_views_count', '_mip_post_views_count_7_day_total', '_mip_post_views_count_24_hours_total'))) ? $sort_order : '' )
            );

            $args2  = array();
            if ($include_categories) {
                //$include_categories = explode(",", $include_categories);
                $args2 = array(
                    'cat'      => $include_categories
                );
            }

            $args3  = array();
            if ($exclude_categories) {
                $exclude_categories = explode(",", $exclude_categories);
                $args3 = array(
                    'category__not_in'      => $exclude_categories
                );
            }

            $args   = array_merge($args1, $args2, $args3);

            $r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );

            if ($r->have_posts()) :
    ?>
                <?php echo '<aside class="widget module-news">'; ?>
                <?php if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title; ?>
                <!-- start:article-container -->
                <div class="article-container">
                <?php
                    $post_counter   = 1;
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $att_img_src_1    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-5');
                        $curr_post_img_1  = ( has_post_thumbnail() ) ? $att_img_src_1[0] : '';

                        $att_img_src_2    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-7');
                        $curr_post_img_2  = ( has_post_thumbnail() ) ? $att_img_src_2[0] : '';

                        $category                                       = get_the_category();

                        $post_article                                   = new MipThemeFramework_Article();
                        $post_article->article_link                     = $r->post->ID;
                        $post_article->article_title                    = $r->post->post_title;
                        $post_article->article_thumb                    = $curr_post_img_1;
                        $post_article->article_post_date                = get_the_date( MIPTHEME_DATE_SIDEBAR );
                        $post_article->article_post_date_iso            = get_the_time('c');

                        if ( $category && $show_category ) :
                            $tmpCatID   = get_post_meta( $r->post->ID, '_yoast_wpseo_primary_category', true );
                            if ( ($display_cats == 'yoast_seo')&&($tmpCatID) ) :
                                $post_article->cat_ID                           = $tmpCatID;
                                $post_article->cat_name                         = get_cat_name($tmpCatID);
                            elseif ( $display_cats == 'root_category' ) :
                                //$curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id($category[0]->term_id);
                                $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id_post_in($category[0]->term_id, $r->post);
                                $curr_cat_obj       = get_category($curr_cat_id_tmp);
                                $post_article->cat_ID                           = $curr_cat_id_tmp;
                                $post_article->cat_name                         = $curr_cat_obj->name;
                            else :
                                $curr_cat_id        = MipThemeFramework_Util::get_category_last_child_id($category);
                                $post_article->cat_ID                           = $curr_cat_id;
                                $post_article->cat_name                         = get_cat_name($curr_cat_id);
                            endif;
                        endif;

                        echo mipthemeframework_get_string_prefix() . $post_article->formatArticleForRecentPostWidget( $layout, $post_counter, $show_date, $show_category, $show_views, $curr_post_img_2, $show_comments );

                        $post_counter++;
                    endwhile;
                ?>
                </div>
                <!-- end:article-container -->
                <?php echo '</aside>'; ?>
    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['include_categories'] = strip_tags($new_instance['include_categories']);
            $instance['exclude_categories'] = strip_tags($new_instance['exclude_categories']);
            $instance['include_tags'] = strip_tags($new_instance['include_tags']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['offset'] = (int) $new_instance['offset'];
            $instance['sort_order']         = strip_tags($new_instance['sort_order']);
            $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
            $instance['display_cats'] = $new_instance['display_cats'];
            $instance['layout'] = $new_instance['layout'];

            //$instance['show_images'] = isset( $new_instance['show_images'] ) ? (bool) $new_instance['show_images'] : false;
            $instance['show_views'] = strip_tags($new_instance['show_views']);
            $instance['show_comments'] = isset( $new_instance['show_comments'] ) ? (bool) $new_instance['show_comments'] : false;
            $instance['show_category'] = isset( $new_instance['show_category'] ) ? (bool) $new_instance['show_category'] : false;
            $instance['show_mid_column'] = isset( $new_instance['show_mid_column'] ) ? (bool) $new_instance['show_mid_column'] : false;

            return $instance;
        }


        function form( $instance ) {
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $include_categories = isset( $instance['include_categories'] ) ? esc_attr( $instance['include_categories'] ) : '';
            $exclude_categories = isset( $instance['exclude_categories'] ) ? esc_attr( $instance['exclude_categories'] ) : '';
            $include_tags       = isset( $instance['include_tags'] ) ? esc_attr( $instance['include_tags'] ) : '';
            $number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset             = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $show_date          = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
            $layout             = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : 'layout_one';
            $display_cats       = isset( $instance['display_cats'] ) ? esc_attr( $instance['display_cats'] ) : 'root_category';
            //$show_images        = isset( $instance['show_images'] ) ? (bool) $instance['show_images'] : false;
            $show_views         = isset( $instance['show_views'] ) ? esc_attr($instance['show_views']) : 0;
            $show_comments      = isset( $instance['show_comments'] ) ? (bool) $instance['show_comments'] : false;
            $show_category      = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : false;
            $show_mid_column    = isset( $instance['show_mid_column'] ) ? (bool) $instance['show_mid_column'] : false;
            $sort_order         = isset( $instance['sort_order'] ) ? esc_attr( $instance['sort_order'] ) : '';
    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'include_categories' ) ); ?>"><?php esc_html_e( 'Include categories (separate ID by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $include_categories ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>"><?php esc_html_e( 'Exclude categories (separate ID by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude_categories ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'include_tags' ) ); ?>"><?php esc_html_e( 'Include tags (separate tag slugs by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_tags' ) ); ?>" type="text" value="<?php echo esc_attr( $include_tags ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>"><?php esc_html_e( 'Widget Layout:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>" type="text">
                        <option value='layout_one'<?php echo ($layout=='layout_one')?'selected':''; ?>><?php esc_html_e( 'Layout 1 (all small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_two'<?php echo ($layout=='layout_two')?'selected':''; ?>><?php esc_html_e( 'Layout 2 (one big + small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_three'<?php echo ($layout=='layout_three')?'selected':''; ?>><?php esc_html_e( 'Layout 3 (all big images)', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>"><?php esc_html_e( 'Display category as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_cats') ); ?>" type="text">
                        <option value='root_category'<?php echo ($display_cats=='root_category')?'selected':''; ?>><?php esc_html_e( 'Root Category', 'Newsgamer' ); ?></option>
                        <option value='all'<?php echo ($display_cats=='all')?'selected':''; ?>><?php esc_html_e( 'Subcategories', 'Newsgamer' ); ?></option>
                        <option value='yoast_seo'<?php echo ($display_cats=='yoast_seo')?'selected':''; ?>><?php esc_html_e( 'YoastSEO Primary Category', 'weeklynews' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>"><?php esc_html_e( 'Sort order:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_order') ); ?>" type="text">
                        <option value='date'<?php echo ($sort_order=='date')?'selected':''; ?>><?php esc_html_e( 'Latest', 'Newsgamer' ); ?></option>
                        <option value='rand'<?php echo ($sort_order=='rand')?'selected':''; ?>><?php esc_html_e( 'Random posts', 'Newsgamer' ); ?></option>
                        <option value='name'<?php echo ($sort_order=='name')?'selected':''; ?>><?php esc_html_e( 'By name', 'Newsgamer' ); ?></option>
                        <option value='modified'<?php echo ($sort_order=='modified')?'selected':''; ?>><?php esc_html_e( 'Last Modified', 'Newsgamer' ); ?></option>
                        <option value='comment_count'<?php echo ($sort_order=='comment_count')?'selected':''; ?>><?php esc_html_e( 'Most Commented', 'Newsgamer' ); ?></option>
                        <option value='mip_post_views_count'<?php echo ($sort_order=='mip_post_views_count')?'selected':''; ?>><?php esc_html_e( 'Most Viewed', 'Newsgamer' ); ?></option>
                        <option value='_mip_post_views_count_24_hours_total'<?php echo ($sort_order=='_mip_post_views_count_24_hours_total')?'selected':''; ?>><?php esc_html_e( 'Most Viewed Last 24 Hours', 'Newsgamer' ); ?></option>
                        <option value='_mip_post_views_count_7_day_total'<?php echo ($sort_order=='_mip_post_views_count_7_day_total')?'selected':''; ?>><?php esc_html_e( 'Most Viewed Last 7 Days', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>"><?php esc_html_e( 'Display Views:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_views') ); ?>" type="text">
                        <option value='0'<?php echo ($show_views=='0')?'selected':''; ?>><?php esc_html_e( 'Do not display views', 'Newsgamer' ); ?></option>
                        <option value='mip_post_views_count'<?php echo ($show_views=='mip_post_views_count')?'selected':''; ?>><?php esc_html_e( 'Display all views for post', 'Newsgamer' ); ?></option>
                        <option value='_mip_post_views_count_24_hours_total'<?php echo ($show_views=='_mip_post_views_count_24_hours_total')?'selected':''; ?>><?php esc_html_e( 'Display only last 24 hours views for post', 'Newsgamer' ); ?></option>
                        <option value='_mip_post_views_count_7_day_total'<?php echo ($show_views=='_mip_post_views_count_7_day_total')?'selected':''; ?>><?php esc_html_e( 'Display only last 7 days views for post', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_category ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_category' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>"><?php esc_html_e( 'Display category?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_comments ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Display comments?', 'Newsgamer' ); ?></label></p>

    <?php
        }
    }

}


if ( ! class_exists( 'MipThemeFramework_Timeline_Widget' ) ) {

    class MipThemeFramework_Timeline_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_timeline_widget', 'description' => esc_html__( "Your site&#8217;s most recent Posts in timeline.", 'Newsgamer') );
            parent::__construct('mp_timeline_widget', esc_html__('MipTheme [Timeline]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_timeline_entries_widget';

        }

        function widget($args, $instance) {
            $cache = array();
            if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( 'mp_timeline_entries_widget', 'widget' );
            }

            if ( ! is_array( $cache ) ) {
                    $cache = array();
            }

            if ( ! isset( $args['widget_id'] ) ) {
                    $args['widget_id'] = $this->id;
            }

            if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo $cache[ $args['widget_id'] ];
                    return;
            }

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Timeline', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number = 5;
            if ( ! $offset ) $offset = 0;
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';

            $tmp_cats = isset( $instance['cats'] ) ? $instance['cats'] : '';
            if( ! $cats = $tmp_cats )  $cats='';

            /**
             * @param array $args An array of arguments used to retrieve the recent posts.
             */
            $r = new WP_Query( apply_filters( 'widget_posts_args', array(
                    'posts_per_page'      => $number,
                    'category__in'        => $cats,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'offset'      => $offset,
                    'ignore_sticky_posts' => true
            ) ) );

            if ($r->have_posts()) :
    ?>
                <?php echo '<aside class="widget module-timeline">'; ?>
                <?php if ( $title ) echo $before_title . $title . $after_title; ?>
                <!-- start:articles -->
                <div class="articles">
                <?php
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $category = get_the_category();
                ?>

                    <!-- start:article -->
                    <article class="def">
                        <span class="published"><?php the_time( MIPTHEME_DATE_TIMELINE ) ?></span>
                        <span class="published-time"><?php the_time( MIPTHEME_TIME_DEFAULT ) ?></span>
                        <div class="cnt">

                            <?php
                                if ( $category ) :
                                    $tmpCatID   = get_post_meta( $r->post->ID, '_yoast_wpseo_primary_category', true );
                                    if ( ($display_cats == 'yoast_seo')&&($tmpCatID) ) :
                                        echo '<i class="bullet parent-bullet-'. MipThemeFramework_Util::get_category_top_parent_id($tmpCatID) .' bullet-' . $tmpCatID . '"></i><span class="category parent-cat-'. MipThemeFramework_Util::get_category_top_parent_id($tmpCatID) .' cat-' . $tmpCatID . '"><a href="' . get_category_link( $tmpCatID ) . '">'. get_cat_name($tmpCatID) .'</a></span>';
                                    elseif ( $display_cats == 'root_category' ) :
                                        $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id_post_in($category[0]->term_id, $r->post);
                                        $curr_cat_obj       = get_category($curr_cat_id_tmp);
                                        echo '<i class="bullet parent-bullet-'. MipThemeFramework_Util::get_category_top_parent_id($curr_cat_id_tmp) .' bullet-' . $curr_cat_id_tmp . '"></i><span class="category parent-cat-'. MipThemeFramework_Util::get_category_top_parent_id($curr_cat_id_tmp) .' cat-' . $curr_cat_id_tmp . '"><a href="' . get_category_link( $curr_cat_obj->term_id ) . '">'. $curr_cat_obj->name .'</a></span>';
                                    else :
                                        $curr_cat_id    = MipThemeFramework_Util::get_category_last_child_id($category);
                                        echo '<i class="bullet parent-bullet-'. MipThemeFramework_Util::get_category_top_parent_id($curr_cat_id) .' bullet-' . $curr_cat_id . '"></i><span class="category parent-cat-'. MipThemeFramework_Util::get_category_top_parent_id($curr_cat_id) .' cat-' . $curr_cat_id . '"><a href="' . get_category_link( $curr_cat_id ) . '">'. get_cat_name($curr_cat_id) .'</a></span>';
                                    endif;
                                endif;
                            ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h3>
                        </div>
                    </article>
                    <!-- end:article -->
                <?php endwhile; ?>
                </div>
                <!-- end:article-container -->
                <?php echo '</aside>'; ?>

    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;

            if ( ! $this->is_preview() ) {
                $cache[ $args['widget_id'] ] = ob_get_flush();
                wp_cache_set( 'mp_timeline_entries_widget', $cache, 'widget' );
            } else {
                ob_end_flush();
            }
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['offset'] = (int) $new_instance['offset'];
            $instance['cats'] = $new_instance['cats'];
            $instance['display_cats'] = $new_instance['display_cats'];

            return $instance;
        }

        function form( $instance ) {
            $title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset         = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $iCats          = isset( $instance['cats'] ) ?  $instance['cats'] : '';
            $display_cats   = isset( $instance['display_cats'] ) ? esc_attr( $instance['display_cats'] ) : 'root_category';
    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>"><?php esc_html_e( 'Display category as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_cats') ); ?>" type="text">
                        <option value='root_category'<?php echo ($display_cats=='root_category')?'selected':''; ?>><?php esc_html_e( 'Root Category', 'Newsgamer' ); ?></option>
                        <option value='all'<?php echo ($display_cats=='all')?'selected':''; ?>><?php esc_html_e( 'Subcategories', 'Newsgamer' ); ?></option>
                        <option value='yoast_seo'<?php echo ($display_cats=='yoast_seo')?'selected':''; ?>><?php esc_html_e( 'YoastSEO Primary Category', 'weeklynews' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cats') ); ?>"><?php esc_html_e('Select categories to include in your timeline:', 'Newsgamer');?> </label>

                    <?php
                        $categories=  get_categories('hide_empty=0');
                        echo "<br/>";
                        foreach ($categories as $cat) {
                            $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (is_array($iCats)) {
                                foreach ($iCats as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
                            $option .= '&nbsp;';
                            $option .= $cat->cat_name;
                            $option .= '<br />';
                            echo mipthemeframework_get_string_prefix() . $option;
                        }

                    ?>

            </p>

    <?php
        }
    }

}


if ( ! class_exists( 'MipThemeFramework_AudioPosts_Widget' ) ) {

    class MipThemeFramework_AudioPosts_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_audio_posts_widget', 'description' => esc_html__( "Your site&#8217;s most recent Audio Posts.", 'Newsgamer') );
            parent::__construct('mp_audio_posts_widget', esc_html__('MipTheme [Audio Posts]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_audio_posts_entries_widget';
        }

        function widget($args, $instance) {
            $cache = array();
            if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( 'mp_timeline_entries_widget', 'widget' );
            }

            if ( ! is_array( $cache ) ) {
                    $cache = array();
            }

            if ( ! isset( $args['widget_id'] ) ) {
                    $args['widget_id'] = $this->id;
            }

            if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo $cache[ $args['widget_id'] ];
                    return;
            }

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Audio Posts', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number    = 5;
            if ( ! $offset ) $offset    = 0;
            $no_margin_class  = ( isset( $instance['no_margin'] ) && (bool)$instance['no_margin']  ) ? ' no-bottom-margin' : '';

            /**
             * @param array $args An array of arguments used to retrieve the recent posts.
             */
            $r = new WP_Query( apply_filters( 'widget_posts_args', array(
                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'offset'                => $offset,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field'    => 'slug',
                        'terms'    => array( 'post-format-audio' ),
                    ),
            ),
            ) ) );

            if ($r->have_posts()) :
    ?>
                <?php echo '<aside class="widget module-singles'. $no_margin_class .'">'; ?>
                <?php if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title; ?>
                <!-- start:singles-container -->
                <ul class="singles-container">
                <?php
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $audio_title = MipThemeFramework_Util::get_meta( '_mp_featured_audio_title', $r->post->ID, '' );
                        $audio_author = MipThemeFramework_Util::get_meta( '_mp_featured_audio_author', $r->post->ID, '' );
                        if ( $audio_title != '' ) :
                ?>
                    <li>
                        <span class="glyphicon glyphicon-play-circle"></span>
                        <a href="<?php the_permalink(); ?>"><?php echo esc_htnl( $audio_title ); ?></a>
                        <?php if ( $audio_author != '' ) echo '<span class="author">'. $audio_author .'</span>'; ?>
                    </li>
                <?php
                        endif;
                    endwhile;
                ?>
                </ul>
                <!-- end:singles-container -->
                <?php echo '</aside>'; ?>
    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;

            if ( ! $this->is_preview() ) {
                $cache[ $args['widget_id'] ] = ob_get_flush();
                wp_cache_set( 'mp_audio_posts_entries_widget', $cache, 'widget' );
            } else {
                ob_end_flush();
            }
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['offset'] = (int) $new_instance['offset'];
            $instance['no_margin'] = isset( $new_instance['no_margin'] ) ? (bool) $new_instance['no_margin'] : false;

            return $instance;
        }

        function form( $instance ) {
            $title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset         = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $nomargin       = isset( $instance['no_margin'] ) ? (bool) $instance['no_margin'] : false;
    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $nomargin ); ?> id="<?php echo esc_attr( $this->get_field_id( 'no_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_margin' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'no_margin' ) ); ?>"><?php esc_html_e( 'No spacing after this widget', 'Newsgamer' ); ?></label></p>

    <?php
        }
    }

}


if ( ! class_exists( 'MipThemeFramework_Gallery_Widget' ) ) {

    class MipThemeFramework_Gallery_Widget extends WP_Widget {

        const THUMB_SIZE 		= 45;

        function __construct() {
            $widget_ops = array('classname' => 'mp_gallery_widget', 'description' => esc_html__( "Your site&#8217;s most recent Audio Posts.", 'Newsgamer') );
            parent::__construct('mp_gallery_widget', esc_html__('MipTheme [Gallery]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_gallery_entries_widget';

            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        public function defaults() {
            return array(
                'title'		=> '',
                'ids'		=> ''
            );
        }

        function widget($args, $instance) {
            $cache = array();
            if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( 'mp_timeline_entries_widget', 'widget' );
            }

            if ( ! is_array( $cache ) ) {
                    $cache = array();
            }

            if ( ! isset( $args['widget_id'] ) ) {
                    $args['widget_id'] = $this->id;
            }

            if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo $cache[ $args['widget_id'] ];
                    return;
            }

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Gallery Thumbs', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $attachments = $this->get_attachments( $instance );
            if ($attachments) {
                $count = 0;

                echo '<aside class="widget module-photos">';
                if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title;
                echo '  <div id="weekly-gallery" class="weekly-gallery article-container">';
                //echo '      <div class="row">';

                foreach( $attachments as $attachment ){
                    //$post_thumb_first_format    = array(300,200, 'quality' => BFI_QUALITY, 'bfi_thumb' => true);

                    $att_img_src_thumb_first    = wp_get_attachment_image_src( $attachment->ID, 'miptheme-post-thumb-5');
                    $att_img_src_thumb          = wp_get_attachment_image_src( $attachment->ID, 'miptheme-post-thumb-7');
                    $att_img_src_zoom           = wp_get_attachment_image_src( $attachment->ID, 'full');

                    $url_thumb_first            = $att_img_src_thumb_first[0];
                    $url_thumb                  = $att_img_src_thumb[0];
                    $url_zoom                   = $att_img_src_zoom[0];

                    if ($count == 0) {
                        //echo '          <div class="col-xs-12">';
                        echo '              <article class="relative clearfix">';
                        echo '                  <a href="'. esc_url($url_zoom) .'" title="'. esc_attr( $attachment->post_title ) .'"><img src="'. $url_thumb_first .'" width="350" height="245" alt="'. esc_attr( $attachment->post_title ) .'" class="img-responsive"><div class="zoomix"><i class="fa fa-search"></i></div></a>';
                        echo '              </article>';
                        //echo '          </div>';
                        //echo '      </div>';
                        echo '      <div class="row">';
                    } else {
                        echo '      <div class="col-xs-6">';
                        echo '          <article class="clearfix">';
                        echo '              <a href="'. esc_url($url_zoom) .'" title="'. esc_attr( $attachment->post_title ) .'"><img src="'. $url_thumb .'" width="100" height="80" alt="'. esc_attr( $attachment->post_title ) .'" class="img-responsive"><div class="zoomix"><i class="fa fa-search"></i></div></a>';
                        echo '          </article>';
                        echo '      </div>';
                    }
                    $count++;
                }

                echo '      </div>';
                echo '  </div>';
                echo '</aside>';
            }

            if ( ! $this->is_preview() ) {
                $cache[ $args['widget_id'] ] = ob_get_flush();
                wp_cache_set( 'mp_gallery_entries_widget', $cache, 'widget' );
            } else {
                ob_end_flush();
            }
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['ids'] = $new_instance['ids'];

            return $instance;
        }


        function form( $instance ) {
            $defaults 	= $this->defaults();
            $instance 	= wp_parse_args( (array) $instance, $defaults );
    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

            <p><label><?php esc_html_e( 'Images:', 'Newsgamer' ); ?></label></p>
            <div class="mp-gallery-widget-thumbs">
            <?php
                // Add the thumbnails to the widget box
                $attachments = $this->get_attachments( $instance );

                foreach( $attachments as $attachment ){
                    $url = add_query_arg( array(
                            'w' 	=> self::THUMB_SIZE,
                            'h' 	=> self::THUMB_SIZE,
                            'crop'	=> 'true'
                    ), wp_get_attachment_url( $attachment->ID ) );
            ?>
                    <img src="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $attachment->post_title ); ?>" alt="<?php echo esc_attr( $attachment->post_title ); ?>"
                            width="<?php echo self::THUMB_SIZE; ?>" height="<?php echo self::THUMB_SIZE; ?>" style="display:inline-block;border: 1px solid #aaa;padding: 2px;background-color: #fff;margin: 0 6px 6px 0;" />
            <?php } ?>
            </div>
            <p>
                <a class="button mp-gallery-choose-images"><?php esc_html_e( 'Choose Images', 'Newsgamer' ); ?></a>
            </p>
            <input type="hidden" class="mp-gallery-widget-ids" name="<?php echo esc_attr( $this->get_field_name( 'ids' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>" value="<?php echo esc_attr( $instance['ids'] ); ?>" />

    <?php
        }

        // Fetch the images attached to the gallery Widget
        public function get_attachments( $instance ){
            $ids = explode( ',', $instance['ids'] );

            $attachments_query = new WP_Query( array(
                'post__in' 			=> $ids,
                'post_status' 		=> 'inherit',
                'post_type' 		=> 'attachment',
                'post_mime_type' 	=> 'image',
                'posts_per_page'	=> -1,
                'no_found_rows'     => true,
            ) );

            $attachments = $attachments_query->get_posts();

            wp_reset_postdata();

            return $attachments;
        }


        public function admin_init() {
            global $pagenow;

            if ( 'widgets.php' == $pagenow ) {
                wp_enqueue_media();

                wp_enqueue_script( 'mp-gallery-widget-admin', get_template_directory_uri() . '/framework/js/admin.js', array(
                    'media-models',
                    'media-views'
                ) );

                $js_settings = array(
                    'thumbSize' => self::THUMB_SIZE
                );

                wp_localize_script( 'mp-gallery-widget-admin', '_wpGalleryWidgetAdminSettings', $js_settings );
            }
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_Reviews_Widget' ) ) {

    class MipThemeFramework_Reviews_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_reviews_widget', 'description' => esc_html__( "Your site&#8217;s lates reviews.", 'Newsgamer') );
            parent::__construct('mp_reviews_widget', esc_html__('MipTheme [Reviews]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_reviews_widget_widget';

        }

        function widget($args, $instance) {

            global $post;

            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest Reviews', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $include_categories = ( ! empty( $instance['include_categories'] ) ) ? $instance['include_categories'] : '';
            $exclude_categories =( ! empty( $instance['exclude_categories'] ) ) ? $instance['exclude_categories'] : '';
            $include_tags       = ( ! empty( $instance['include_tags'] ) ) ? $instance['include_tags'] : '';

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number = 5;
            if ( ! $offset ) $offset = 0;
            $show_views = isset( $instance['show_views'] ) ? 'mip_post_views_count' : 0;
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            $show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : false;
            $mid_column = isset( $instance['mid_column'] ) ? $instance['mid_column'] : false;
            $sort_reviews = isset( $instance['sort_reviews'] ) ? $instance['sort_reviews'] : 'meta_value_num';
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';
            $layout = isset( $instance['layout'] ) ? $instance['layout'] : 'layout_one';


            /**
             * @param array $args An array of arguments used to retrieve the recent posts.
             */

            $args1 = array(
                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'tag'                   => $include_tags,
                'orderby' => $sort_reviews,
                'offset'      => $offset,
                //'meta_key' => '_mp_review_post_total_score',
                'meta_query' => array(
                    array(
                        'key' => '_mp_review_post_total_score',
                    ),
                    array(
                        'key' => '_mp_enable_review_post',
                    )
                )

            );

            $args2  = array();
            if ($include_categories) {
                //$include_categories = explode(",", $include_categories);
                $args2 = array(
                    'cat'      => $include_categories
                );
            }

            $args3  = array();
            if ($exclude_categories) {
                $exclude_categories = explode(",", $exclude_categories);
                $args3 = array(
                    'category__not_in'      => $exclude_categories
                );
            }

            $args   = array_merge($args1, $args2, $args3);

            $r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );

            if ($r->have_posts()) :
    ?>
                <?php echo '<aside class="widget module-reviews">'; ?>
                <?php if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title; ?>
                <!-- start:article-container -->
                <div class="article-container">
                <?php
                    $post_counter   = 1;
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $att_img_src_1    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-5');
                        $curr_post_img_1  = ( has_post_thumbnail() ) ? $att_img_src_1[0] : '';

                        $att_img_src_2    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-7');
                        $curr_post_img_2  = ( has_post_thumbnail() ) ? $att_img_src_2[0] : '';

                        $category                                       = get_the_category();

                        $post_article                                   = new MipThemeFramework_Article();
                        $post_article->article_link                     = $r->post->ID;
                        $post_article->article_title                    = $r->post->post_title;
                        $post_article->article_thumb                    = $curr_post_img_1;
                        $post_article->article_post_date                = get_the_date( MIPTHEME_DATE_SIDEBAR );
                        $post_article->article_post_date_iso            = get_the_time('c');

                        if ( $category && $show_category ) :
                            $tmpCatID   = get_post_meta( $r->post->ID, '_yoast_wpseo_primary_category', true );
                            if ( ($display_cats == 'yoast_seo')&&($tmpCatID) ) :
                                $post_article->cat_ID                           = $tmpCatID;
                                $post_article->cat_name                         = get_cat_name($tmpCatID);
                            elseif ( $display_cats == 'root_category' ) :
                                //$curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id($category[0]->term_id);
                                $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id_post_in($category[0]->term_id, $r->post);
                                $curr_cat_obj       = get_category($curr_cat_id_tmp);
                                $post_article->cat_ID                           = $curr_cat_id_tmp;
                                $post_article->cat_name                         = $curr_cat_obj->name;
                            else :
                                $curr_cat_id        = MipThemeFramework_Util::get_category_last_child_id($category);
                                $post_article->cat_ID                           = $curr_cat_id;
                                $post_article->cat_name                         = get_cat_name($curr_cat_id);
                            endif;
                        endif;

                        echo mipthemeframework_get_string_prefix() . $post_article->formatArticleForRecentPostWidget( $layout, $post_counter, $show_date, $show_category, $show_views, $curr_post_img_2 );

                        $post_counter++;

                    endwhile;
                ?>
                </div>
                <!-- end:article-container -->
                <?php echo '</aside>'; ?>

    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['include_categories'] = strip_tags($new_instance['include_categories']);
            $instance['exclude_categories'] = strip_tags($new_instance['exclude_categories']);
            $instance['include_tags'] = strip_tags($new_instance['include_tags']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['offset'] = (int) $new_instance['offset'];
            $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
            //$instance['show_images'] = isset( $new_instance['show_images'] ) ? (bool) $new_instance['show_images'] : false;
            $instance['show_views'] = isset( $new_instance['show_views'] ) ? (bool) $new_instance['show_views'] : false;
            $instance['show_category'] = isset( $new_instance['show_category'] ) ? (bool) $new_instance['show_category'] : false;
            $instance['mid_column'] = isset( $new_instance['mid_column'] ) ? (bool) $new_instance['mid_column'] : false;
            $instance['sort_reviews'] = $new_instance['sort_reviews'];
            $instance['display_cats'] = $new_instance['display_cats'];
            $instance['layout'] = $new_instance['layout'];

            return $instance;
        }


        function form( $instance ) {
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $include_categories = isset( $instance['include_categories'] ) ? esc_attr( $instance['include_categories'] ) : '';
            $exclude_categories = isset( $instance['exclude_categories'] ) ? esc_attr( $instance['exclude_categories'] ) : '';
            $include_tags       = isset( $instance['include_tags'] ) ? esc_attr( $instance['include_tags'] ) : '';
            $number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset             = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $show_date          = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
            //$show_images        = isset( $instance['show_images'] ) ? (bool) $instance['show_images'] : false;
            $show_views         = isset( $instance['show_views'] ) ? (bool) $instance['show_views'] : false;
            $show_category      = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : false;
            $mid_column         = isset( $instance['mid_column'] ) ? (bool) $instance['mid_column'] : false;
            $sort_reviews       = isset( $instance['sort_reviews'] ) ? esc_attr( $instance['sort_reviews'] ) : 'meta_value_num';
            $layout             = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : 'layout_one';
            $display_cats       = isset( $instance['display_cats'] ) ? esc_attr( $instance['display_cats'] ) : 'root_category';

    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'include_categories' ) ); ?>"><?php esc_html_e( 'Include categories (separate by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $include_categories ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>"><?php esc_html_e( 'Exclude categories (separate by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude_categories ); ?>" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'include_tags' ) ); ?>"><?php esc_html_e( 'Include tags (separate tag slugs by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include_tags' ) ); ?>" type="text" value="<?php echo esc_attr( $include_tags ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sort_reviews') ); ?>"><?php esc_html_e( 'Sort reviews by:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('sort_reviews') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_reviews') ); ?>" type="text">
                        <option value='meta_value_num'<?php echo ($sort_reviews=='meta_value_num')?'selected':''; ?>><?php esc_html_e( 'Best Score Reviews', 'Newsgamer' ); ?></option>
                        <option value='date'<?php echo ($sort_reviews=='date')?'selected':''; ?>><?php esc_html_e( 'Latest reviews', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>"><?php esc_html_e( 'Widget Layout:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>" type="text">
                        <option value='layout_one'<?php echo ($layout=='layout_one')?'selected':''; ?>><?php esc_html_e( 'Layout 1 (all small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_two'<?php echo ($layout=='layout_two')?'selected':''; ?>><?php esc_html_e( 'Layout 2 (one big + small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_three'<?php echo ($layout=='layout_three')?'selected':''; ?>><?php esc_html_e( 'Layout 3 (all big images)', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>"><?php esc_html_e( 'Display category as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_cats') ); ?>" type="text">
                        <option value='root_category'<?php echo ($display_cats=='root_category')?'selected':''; ?>><?php esc_html_e( 'Root Category', 'Newsgamer' ); ?></option>
                        <option value='all'<?php echo ($display_cats=='all')?'selected':''; ?>><?php esc_html_e( 'Subcategories', 'Newsgamer' ); ?></option>
                        <option value='yoast_seo'<?php echo ($display_cats=='yoast_seo')?'selected':''; ?>><?php esc_html_e( 'YoastSEO Primary Category', 'weeklynews' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_category ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_category' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>"><?php esc_html_e( 'Display category?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_views ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_views' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>"><?php esc_html_e( 'Display Views?', 'Newsgamer' ); ?></label></p>

    <?php
        }
    }

}


if ( ! class_exists( 'MipThemeFramework_About_Widget' ) ) {

    class MipThemeFramework_About_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_about_widget', // Base ID
                esc_html__('MipTheme [About]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display text with social share buttons', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $title          = apply_filters( 'widget_title', $instance['title'] );
            $about_text           = apply_filters( 'widget_about_text', $instance['about_text'] );
            $link_facebook   = apply_filters( 'widget_link_facebook', $instance['link_facebook'] );
            $link_twitter   = apply_filters( 'widget_link_twitter', $instance['link_twitter'] );
            $link_linkedin   = apply_filters( 'widget_link_linkedin', $instance['link_linkedin'] );
            $link_googleplus   = apply_filters( 'widget_link_googleplus', $instance['link_googleplus'] );
            $link_pinterest   = apply_filters( 'widget_link_pinterest', $instance['link_pinterest'] );
            $link_vimeo   = apply_filters( 'widget_link_vimeo', $instance['link_vimeo'] );
            $link_youtube   = apply_filters( 'widget_link_youtube', $instance['link_youtube'] );
            $link_instagram   = isset( $instance[ 'link_instagram' ] ) ? apply_filters( 'widget_link_instagram', $instance['link_instagram'] ) : 0;

            echo '<aside class="widget module-about">';
            if ( ! empty( $title ) ) {
                echo mipthemeframework_get_string_prefix() . $args['before_title'] . $title . $args['after_title'];
            }
            if ( ! empty( $about_text ) ) echo '<p>'. $about_text .'</p>';
            if ( ! empty( $link_facebook ) ) echo '<a class="social" href="'. esc_url($link_facebook) .'"><i class="fa fa-facebook"></i></a>';
            if ( ! empty( $link_twitter ) ) echo '<a class="social" href="'. esc_url($link_twitter) .'"><i class="fa fa-twitter"></i></a>';
            if ( ! empty( $link_googleplus ) ) echo '<a class="social" href="'. esc_url($link_googleplus) .'"><i class="fa fa-google-plus"></i></a>';
            if ( ! empty( $link_linkedin ) ) echo '<a class="social" href="'. esc_url($link_linkedin) .'"><i class="fa fa-linkedin"></i></a>';
            if ( ! empty( $link_pinterest ) ) echo '<a class="social" href="'. esc_url($link_pinterest) .'"><i class="fa fa-pinterest"></i></a>';
            if ( ! empty( $link_youtube ) ) echo '<a class="social" href="'. esc_url($link_youtube) .'"><i class="fa fa-youtube"></i></a>';
            if ( ! empty( $link_vimeo ) ) echo '<a class="social" href="'. esc_url($link_vimeo) .'"><i class="fa fa-vimeo"></i></a>';
            if ( ! empty( $link_instagram ) ) echo '<a class="social" href="'. esc_url($link_instagram) .'"><i class="fa fa-instagram"></i></a>';

            echo '</aside>';
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ];       } else { $title = esc_html__( 'About us...', 'Newsgamer' ); }
            if ( isset( $instance[ 'about_text' ] ) ) { $about_text = $instance[ 'about_text' ];       } else { $about_text = ''; }
            if ( isset( $instance[ 'link_facebook' ] ) ) { $link_facebook = $instance[ 'link_facebook' ];       } else { $link_facebook = ''; }
            if ( isset( $instance[ 'link_twitter' ] ) ) { $link_twitter = $instance[ 'link_twitter' ];       } else { $link_twitter = ''; }
            if ( isset( $instance[ 'link_googleplus' ] ) ) { $link_googleplus = $instance[ 'link_googleplus' ];       } else { $link_googleplus = ''; }
            if ( isset( $instance[ 'link_linkedin' ] ) ) { $link_linkedin = $instance[ 'link_linkedin' ];       } else { $link_linkedin = ''; }
            if ( isset( $instance[ 'link_pinterest' ] ) ) { $link_pinterest = $instance[ 'link_pinterest' ];       } else { $link_pinterest = ''; }
            if ( isset( $instance[ 'link_vimeo' ] ) ) { $link_vimeo = $instance[ 'link_vimeo' ];       } else { $link_vimeo = ''; }
            if ( isset( $instance[ 'link_youtube' ] ) ) { $link_youtube = $instance[ 'link_youtube' ];       } else { $link_youtube = ''; }
            if ( isset( $instance[ 'link_instagram' ] ) ) { $link_instagram = $instance[ 'link_instagram' ];       } else { $link_instagram = ''; }
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'about_text' ) ); ?>"><?php esc_html_e( 'Text:', 'Newsgamer' ); ?></label>
                <textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'about_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'about_text' ) ); ?>"><?php echo esc_attr( $about_text ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'link_facebook' ) ); ?>"><?php esc_html_e( 'Facebook Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $link_facebook ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_twitter' ) ); ?>"><?php esc_html_e( 'Twitter Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $link_twitter ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $link_linkedin ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_googleplus' ) ); ?>"><?php esc_html_e( 'Google+ Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_googleplus' ) ); ?>" type="text" value="<?php echo esc_attr( $link_googleplus ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $link_pinterest ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_vimeo' ) ); ?>"><?php esc_html_e( 'Vimeo Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_vimeo' ) ); ?>" type="text" value="<?php echo esc_attr( $link_vimeo ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_youtube' ) ); ?>"><?php esc_html_e( 'Youtube Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $link_youtube ); ?>">

                <label for="<?php echo esc_attr( $this->get_field_id( 'link_instagram' ) ); ?>"><?php esc_html_e( 'Instagram Link:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $link_instagram ); ?>">
            </p>
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['about_text'] = ( ! empty( $new_instance['about_text'] ) ) ? strip_tags( $new_instance['about_text'] ) : '';
            $instance['link_facebook'] = ( ! empty( $new_instance['link_facebook'] ) ) ? strip_tags( $new_instance['link_facebook'] ) : '';
            $instance['link_twitter'] = ( ! empty( $new_instance['link_twitter'] ) ) ? strip_tags( $new_instance['link_twitter'] ) : '';
            $instance['link_linkedin'] = ( ! empty( $new_instance['link_linkedin'] ) ) ? strip_tags( $new_instance['link_linkedin'] ) : '';
            $instance['link_googleplus'] = ( ! empty( $new_instance['link_googleplus'] ) ) ? strip_tags( $new_instance['link_googleplus'] ) : '';
            $instance['link_pinterest'] = ( ! empty( $new_instance['link_pinterest'] ) ) ? strip_tags( $new_instance['link_pinterest'] ) : '';
            $instance['link_vimeo'] = ( ! empty( $new_instance['link_vimeo'] ) ) ? strip_tags( $new_instance['link_vimeo'] ) : '';
            $instance['link_youtube'] = ( ! empty( $new_instance['link_youtube'] ) ) ? strip_tags( $new_instance['link_youtube'] ) : '';
            $instance['link_instagram'] = ( ! empty( $new_instance['link_instagram'] ) ) ? strip_tags( $new_instance['link_instagram'] ) : '';

            return $instance;
        }

    }

}


if ( ! class_exists( 'MipThemeFramework_RelatedPosts_Widget' ) ) {

    class MipThemeFramework_RelatedPosts_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_related_entries_widget', 'description' => esc_html__( "Your site&#8217;s related Posts.", 'Newsgamer') );
            parent::__construct('mp_related_posts_widget', esc_html__('MipTheme [Related Posts]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_related_entries_widget';

        }

        function widget($args, $instance) {

            if ( !is_single() ) return;

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Related Posts', 'Newsgamer' );

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $filter_related = ( ! empty( $instance['filter_related'] ) ) ? $instance['filter_related'] : '';
            $sort_order     = ( ! empty( $instance['sort_order'] ) ) ? $instance['sort_order'] : '';

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number = 5;
            if ( ! $offset ) $offset = 0;
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            //$show_images = isset( $instance['show_images'] ) ? $instance['show_images'] : false;
            $show_views = isset( $instance['show_views'] ) ? $instance['show_views'] : 0;
            $show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : false;
            $show_mid_column = isset( $instance['show_mid_column'] ) ? $instance['show_mid_column'] : false;
            $layout = isset( $instance['layout'] ) ? $instance['layout'] : 'layout_one';
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';

            // set args
            $args = array();
            global $post;

            if ( $filter_related == 'category' ) {
                // if filter by cat
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args = array(
                        'category__in'          => $category_ids,
                        'post__not_in'          => array($post->ID),
                        'posts_per_page'        => $number,
                        'ignore_sticky_posts'   => 1,
                        'orderby'               => $sort_order,
                        'offset'                => $offset,
                        'meta_key'              => ( ($sort_order == 'meta_value_num') ? 'mip_post_views_count' : '' ),
                        'no_found_rows'         => true,
                    );
                }
            } else {
                // if filter by tags
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids    = array();
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id;
                    }
                    $args=array(
                        'tag__in'               => $tag_ids,
                        'post__not_in'          => array($post->ID),
                        'posts_per_page'        => $number,
                        'ignore_sticky_posts '  => 1,
                        'orderby'               => $sort_order,
                        'offset'                => $offset,
                        'meta_key'              => ( ($sort_order == 'meta_value_num') ? 'mip_post_views_count' : '' ),
                        'no_found_rows'         => true,
                    );
                }
            }

            $r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );

            if ($r->have_posts()) :
    ?>
                <?php echo '<aside class="widget module-news">'; ?>
                <?php if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title; ?>
                <!-- start:article-container -->
                <div class="article-container">
                <?php
                    $post_counter   = 1;
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $att_img_src_1    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-5');
                        $curr_post_img_1  = ( has_post_thumbnail() ) ? $att_img_src_1[0] : '';

                        $att_img_src_2    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-7');
                        $curr_post_img_2  = ( has_post_thumbnail() ) ? $att_img_src_2[0] : '';

                        $category                                       = get_the_category();

                        $post_article                                   = new MipThemeFramework_Article();
                        $post_article->article_link                     = $r->post->ID;
                        $post_article->article_title                    = $r->post->post_title;
                        $post_article->article_thumb                    = $curr_post_img_1;
                        $post_article->article_post_date                = get_the_date( MIPTHEME_DATE_SIDEBAR );

                        if ( $category && $show_category ) :
                            $tmpCatID   = get_post_meta( $r->post->ID, '_yoast_wpseo_primary_category', true );
                            if ( ($display_cats == 'yoast_seo')&&($tmpCatID) ) :
                                $post_article->cat_ID                           = $tmpCatID;
                                $post_article->cat_name                         = get_cat_name($tmpCatID);
                            elseif ( $display_cats == 'root_category' ) :
                                //$curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id($category[0]->term_id);
                                $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id_post_in($category[0]->term_id, $r->post);
                                $curr_cat_obj       = get_category($curr_cat_id_tmp);
                                $post_article->cat_ID                           = $curr_cat_id_tmp;
                                $post_article->cat_name                         = $curr_cat_obj->name;
                            else :
                                $curr_cat_id        = MipThemeFramework_Util::get_category_last_child_id($category);
                                $post_article->cat_ID                           = $curr_cat_id;
                                $post_article->cat_name                         = get_cat_name($curr_cat_id);
                            endif;
                        endif;

                        echo mipthemeframework_get_string_prefix() . $post_article->formatArticleForRecentPostWidget( $layout, $post_counter, $show_date, $show_category, $show_views, $curr_post_img_2 );

                        $post_counter++;
                    endwhile;
                ?>
                </div>
                <!-- end:article-container -->
                <?php echo '</aside>'; ?>
    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;


        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title']              = strip_tags($new_instance['title']);
            $instance['filter_related']     = strip_tags($new_instance['filter_related']);
            $instance['sort_order']         = strip_tags($new_instance['sort_order']);
            $instance['number']             = (int) $new_instance['number'];
            $instance['offset']             = (int) $new_instance['offset'];
            $instance['show_date']          = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
            //$instance['show_images'] = isset( $new_instance['show_images'] ) ? (bool) $new_instance['show_images'] : false;
            $instance['show_category']      = isset( $new_instance['show_category'] ) ? (bool) $new_instance['show_category'] : false;
            $instance['show_mid_column']    = isset( $new_instance['show_mid_column'] ) ? (bool) $new_instance['show_mid_column'] : false;
            $instance['layout']             = $new_instance['layout'];
            $instance['show_views']         = strip_tags($new_instance['show_views']);
            $instance['display_cats']       = $new_instance['display_cats'];

            return $instance;
        }


        function form( $instance ) {
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $filter_related     = isset( $instance['filter_related'] ) ? esc_attr( $instance['filter_related'] ) : '';
            $sort_order         = isset( $instance['sort_order'] ) ? esc_attr( $instance['sort_order'] ) : '';
            $number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset             = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $show_date          = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
            $show_category      = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : false;
            $show_mid_column    = isset( $instance['show_mid_column'] ) ? (bool) $instance['show_mid_column'] : false;
            $layout             = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : 'layout_one';
            $show_views         = isset( $instance['show_views'] ) ? esc_attr($instance['show_views']) : 0;
            $display_cats       = isset( $instance['display_cats'] ) ? esc_attr( $instance['display_cats'] ) : 'root_category';
    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('filter_related') ); ?>"><?php esc_html_e( 'Filter related posts by:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('filter_related') ); ?>" name="<?php echo esc_attr( $this->get_field_name('filter_related') ); ?>" type="text">
                        <option value='category'<?php echo ($filter_related=='category')?'selected':''; ?>><?php esc_html_e( 'Category', 'Newsgamer' ); ?></option>
                        <option value='tag'<?php echo ($filter_related=='tag')?'selected':''; ?>><?php esc_html_e( 'Tag', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

             <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>"><?php esc_html_e( 'Sort order:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_order') ); ?>" type="text">
                        <option value='date'<?php echo ($sort_order=='date')?'selected':''; ?>><?php esc_html_e( 'Latest', 'Newsgamer' ); ?></option>
                        <option value='rand'<?php echo ($sort_order=='rand')?'selected':''; ?>><?php esc_html_e( 'Random posts', 'Newsgamer' ); ?></option>
                        <option value='name'<?php echo ($sort_order=='name')?'selected':''; ?>><?php esc_html_e( 'By name', 'Newsgamer' ); ?></option>
                        <option value='modified'<?php echo ($sort_order=='modified')?'selected':''; ?>><?php esc_html_e( 'Last Modified', 'Newsgamer' ); ?></option>
                        <option value='comment_count'<?php echo ($sort_order=='comment_count')?'selected':''; ?>><?php esc_html_e( 'Most Commented', 'Newsgamer' ); ?></option>
                        <option value='meta_value_num'<?php echo ($sort_order=='meta_value_num')?'selected':''; ?>><?php esc_html_e( 'Most Viewed', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>"><?php esc_html_e( 'Widget Layout:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>" type="text">
                        <option value='layout_one'<?php echo ($layout=='layout_one')?'selected':''; ?>><?php esc_html_e( 'Layout 1 (all small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_two'<?php echo ($layout=='layout_two')?'selected':''; ?>><?php esc_html_e( 'Layout 2 (one big + small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_three'<?php echo ($layout=='layout_three')?'selected':''; ?>><?php esc_html_e( 'Layout 3 (all big images)', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>"><?php esc_html_e( 'Display category as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_cats') ); ?>" type="text">
                        <option value='root_category'<?php echo ($display_cats=='root_category')?'selected':''; ?>><?php esc_html_e( 'Root Category', 'Newsgamer' ); ?></option>
                        <option value='all'<?php echo ($display_cats=='all')?'selected':''; ?>><?php esc_html_e( 'Subcategories', 'Newsgamer' ); ?></option>
                        <option value='yoast_seo'<?php echo ($display_cats=='yoast_seo')?'selected':''; ?>><?php esc_html_e( 'YoastSEO Primary Category', 'weeklynews' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>"><?php esc_html_e( 'Display Views:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('show_views') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_views') ); ?>" type="text">
                        <option value='0'<?php echo ($show_views=='0')?'selected':''; ?>><?php esc_html_e( 'Do not display views', 'Newsgamer' ); ?></option>
                        <option value='mip_post_views_count'<?php echo ($show_views=='mip_post_views_count')?'selected':''; ?>><?php esc_html_e( 'Display all views for post', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_category ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_category' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>"><?php esc_html_e( 'Display category?', 'Newsgamer' ); ?></label></p>

            <!--p><input class="checkbox" type="checkbox" <?php checked( $show_mid_column ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_mid_column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_mid_column' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_mid_column' ) ); ?>"><?php esc_html_e( 'Style it for mid column?', 'Newsgamer' ); ?></label></p-->
    <?php
        }
    }

}


if ( ! class_exists( 'MipThemeFramework_Tags_Widget' ) ) {

    class MipThemeFramework_Tags_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'mp_tags_widget', // Base ID
                esc_html__('MipTheme [Tags]', 'Newsgamer'), // Name
                array( 'description' => esc_html__( 'Display tags', 'Newsgamer' ), ) // Args
            );
        }

        public function widget( $args, $instance ) {
            $title                  = apply_filters( 'widget_title', $instance['title'] );
            $show_posts_count       = isset( $instance['show_posts_count'] ) ? $instance['show_posts_count'] : false;
            $number                 = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
            $html                   = '';

            echo '<aside class="widget module-tags">';
            if ( ! empty( $title ) ) {
                echo mipthemeframework_get_string_prefix() . $args['before_title'] . $title . $args['after_title'];
            }

            $args = array(
                'number'    => $number,
                'orderby'    => 'count',
                'order'    => 'DESC'
            );
            $tags = get_tags( $args );

            foreach ( $tags as $tag ) {
                $tag_link = get_tag_link( $tag->term_id );

                $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                if ($show_posts_count) $html .= "<span>{$tag->count}</span> ";
                $html .= "{$tag->name}</a></li>";
            }
            echo '<ul class="tags">'. $html .'</ul>';
            echo '</aside>';
        }

        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ];       } else { $title = esc_html__( 'Weekly Tags', 'Newsgamer' ); }
            $show_posts_count           = isset( $instance['show_posts_count'] ) ? (bool) $instance['show_posts_count'] : false;
            $number                     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p><input class="checkbox" type="checkbox" <?php checked( $show_posts_count ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_posts_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_posts_count' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_posts_count' ) ); ?>"><?php esc_html_e( 'Display post count?', 'Newsgamer' ); ?></label></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of tags to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['show_posts_count']   = isset( $new_instance['show_posts_count'] ) ? (bool) $new_instance['show_posts_count'] : false;
            $instance['number']             = (int) $new_instance['number'];

            return $instance;
        }

    }

}



if ( ! class_exists( 'MipThemeFramework_Author_Widget' ) ) {

    class MipThemeFramework_Author_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array('classname' => 'mp_author_widget', 'description' => esc_html__( "Author&#8217;s most recent Posts.", 'Newsgamer') );
            parent::__construct('mp_author_widget', esc_html__('MipTheme [Authors posts]', 'Newsgamer'), $widget_ops);
            $this->alt_option_name = 'mp_author_widget';

        }

        function widget($args, $instance) {

            ob_start();
            extract($args);

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $exclude_posts =( ! empty( $instance['exclude_posts'] ) ) ? $instance['exclude_posts'] : '';
            $sort_order     = ( ! empty( $instance['sort_order'] ) ) ? $instance['sort_order'] : '';

            $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
            $offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
            if ( ! $number ) $number = 5;
            if ( ! $offset ) $offset = 0;
            $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';
            $display_avatar = isset( $instance['display_avatar'] ) ? $instance['display_avatar'] : 'no-avatar';
            $select_author = isset( $instance['select_author'] ) ? $instance['select_author'] : 0;

            //$show_images = isset( $instance['show_images'] ) ? $instance['show_images'] : false;
            $show_views = isset( $instance['show_views'] ) ? $instance['show_views'] : false;
            $show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : false;
            $show_mid_column = isset( $instance['show_mid_column'] ) ? $instance['show_mid_column'] : false;
            $layout = isset( $instance['layout'] ) ? $instance['layout'] : 'layout_one';
            $display_cats = isset( $instance['display_cats'] ) ? $instance['display_cats'] : 'root_category';


            $title          = ( $title != '' ) ? '<em>'. $title .'</em>' : $title;
            $title          = $title . '<a href="'. get_author_posts_url($select_author) .'">'. get_the_author_meta( 'display_name', $select_author ) .'</a>';

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 3.4.0
             *
             * @see WP_Query::get_posts()
             *
             * @param array $args An array of arguments used to retrieve the recent posts.
             */

            $args1 = array(
                'posts_per_page'        => $number,
                'author'                => $select_author,
                'no_found_rows'         => true,
                'post_status'           => 'publish',
                'offset'                => $offset,
                'ignore_sticky_posts'   => true,
                'orderby'               => $sort_order,
                'meta_key'              => ( ($sort_order == 'meta_value_num') ? 'mip_post_views_count' : '' )
            );

            $args2  = array();
            if ($exclude_posts) {
                $exclude_posts = explode(",", $exclude_posts);
                $args2 = array(
                    'post__not_in'      => $exclude_posts
                );
            }

            $args   = array_merge($args1, $args2);

            $r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );

            if ($r->have_posts()) :
    ?>
                <aside class="widget module-news module-author <?php echo esc_attr( $display_avatar ); ?>">
                <?php
                    if ($display_avatar == 'avatar-mid') echo '<div class="avatar-wrap"><a href="'. get_author_posts_url($select_author) .'">'. get_avatar($select_author, 85) .'</a></div>';
                    if ($display_avatar == 'avatar-right') echo '<a href="'. get_author_posts_url($select_author) .'">'. get_avatar($select_author, 55) .'</a>';

                    if ( $title ) echo mipthemeframework_get_string_prefix() . $before_title . $title . $after_title;
                ?>
                <!-- start:article-container -->
                <div class="article-container">
                <?php
                    $post_counter   = 1;
                    while ( $r->have_posts() ) :
                        $r->the_post();
                        $att_img_src_1    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-5');
                        $curr_post_img_1  = ( has_post_thumbnail() ) ? $att_img_src_1[0] : '';

                        $att_img_src_2    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-7');
                        $curr_post_img_2  = ( has_post_thumbnail() ) ? $att_img_src_2[0] : '';

                        $category                                       = get_the_category();

                        $post_article                                   = new MipThemeFramework_Article();
                        $post_article->article_link                     = $r->post->ID;
                        $post_article->article_title                    = $r->post->post_title;
                        $post_article->article_thumb                    = $curr_post_img_1;
                        $post_article->article_post_date                = get_the_date( MIPTHEME_DATE_SIDEBAR );
                        $post_article->article_post_date_iso            = get_the_time('c');

                        if ( $category && $show_category ) :
                            $tmpCatID   = get_post_meta( $r->post->ID, '_yoast_wpseo_primary_category', true );
                            if ( ($display_cats == 'yoast_seo')&&($tmpCatID) ) :
                                $post_article->cat_ID                           = $tmpCatID;
                                $post_article->cat_name                         = get_cat_name($tmpCatID);
                            elseif ( $display_cats == 'root_category' ) :
                                //$curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id($category[0]->term_id);
                                $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id_post_in($category[0]->term_id, $r->post);
                                $curr_cat_obj       = get_category($curr_cat_id_tmp);
                                $post_article->cat_ID                           = $curr_cat_id_tmp;
                                $post_article->cat_name                         = $curr_cat_obj->name;
                            else :
                                $curr_cat_id        = MipThemeFramework_Util::get_category_last_child_id($category);
                                $post_article->cat_ID                           = $curr_cat_id;
                                $post_article->cat_name                         = get_cat_name($curr_cat_id);
                            endif;
                        endif;

                        echo mipthemeframework_get_string_prefix() . $post_article->formatArticleForRecentPostWidget( $layout, $post_counter, $show_date, $show_category, $show_views, $curr_post_img_2 );

                        $post_counter++;
                    endwhile;
                ?>
                </div>
                <!-- end:article-container -->
                <?php echo '</aside>'; ?>
    <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

            endif;

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['exclude_posts'] = strip_tags($new_instance['exclude_posts']);
            $instance['number'] = (int) $new_instance['number'];
            $instance['offset'] = (int) $new_instance['offset'];
            $instance['sort_order']         = strip_tags($new_instance['sort_order']);
            $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
            $instance['display_cats'] = $new_instance['display_cats'];
            $instance['display_avatar'] = $new_instance['display_avatar'];
            $instance['select_author'] = $new_instance['select_author'];
            $instance['layout']             = $new_instance['layout'];

            //$instance['show_images'] = isset( $new_instance['show_images'] ) ? (bool) $new_instance['show_images'] : false;
            $instance['show_views'] = isset( $new_instance['show_views'] ) ? (bool) $new_instance['show_views'] : false;
            $instance['show_category'] = isset( $new_instance['show_category'] ) ? (bool) $new_instance['show_category'] : false;
            $instance['show_mid_column'] = isset( $new_instance['show_mid_column'] ) ? (bool) $new_instance['show_mid_column'] : false;

            return $instance;
        }

        function form( $instance ) {
            global $mipthemeoptions_framework;

            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $exclude_posts = isset( $instance['exclude_posts'] ) ? esc_attr( $instance['exclude_posts'] ) : '';
            $number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
            $offset             = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;
            $show_date          = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
            $display_cats       = isset( $instance['display_cats'] ) ? esc_attr( $instance['display_cats'] ) : 'root_category';
            $display_avatar     = isset( $instance['display_avatar'] ) ? esc_attr( $instance['display_avatar'] ) : 'no-avatar';
            $select_author       = isset( $instance['select_author'] ) ? esc_attr( $instance['select_author'] ) : 0;
            //$show_images        = isset( $instance['show_images'] ) ? (bool) $instance['show_images'] : false;
            $show_views         = isset( $instance['show_views'] ) ? (bool) $instance['show_views'] : false;
            $show_category      = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : false;
            $show_mid_column    = isset( $instance['show_mid_column'] ) ? (bool) $instance['show_mid_column'] : false;
            $sort_order         = isset( $instance['sort_order'] ) ? esc_attr( $instance['sort_order'] ) : '';
            $authors_exclude    = isset( $mipthemeoptions_framework['_mp_authorteampage_exclude'] ) ? $mipthemeoptions_framework['_mp_authorteampage_exclude'] : '';
            $layout             = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : 'layout_one';

            $args = array(
                'role__in' => array('Administrator', 'Editor', 'Author'),
                //'role' => 'Author',
                'exclude' => array( $authors_exclude ),
                'orderby' => 'display_name',
                'order' => 'DESC'
            );

            // The Query
            $user_query  = new WP_User_Query( $args );
            foreach ( $user_query->results as $user ) {

            }

    ?>
            <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('select_author') ); ?>"><?php esc_html_e( 'Select author:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('select_author') ); ?>" name="<?php echo esc_attr( $this->get_field_name('select_author') ); ?>" type="text">
                        <?php foreach ( $user_query->results as $user ) { ?>
                        <option value='<?php echo esc_attr( $user->ID ); ?>'<?php echo ($select_author== $user->ID)?' selected':''; ?>><?php echo esc_html( $user->display_name ); ?></option>
                        <?php } ?>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_avatar') ); ?>"><?php esc_html_e( 'Display avatar as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_avatar') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_avatar') ); ?>" type="text">
                        <option value='no-avatar'<?php echo ($display_avatar=='no-avatar')?'selected':''; ?>><?php esc_html_e( 'No Avatar', 'Newsgamer' ); ?></option>
                        <option value='avatar-mid'<?php echo ($display_avatar=='avatar-mid')?'selected':''; ?>><?php esc_html_e( 'Avatar on top', 'Newsgamer' ); ?></option>
                        <option value='avatar-right'<?php echo ($display_avatar=='avatar-right')?'selected':''; ?>><?php esc_html_e( 'Avatar on right', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'exclude_posts' ) ); ?>"><?php esc_html_e( 'Exclude posts (separate ID by commas):', 'Newsgamer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude_posts ); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>"><?php esc_html_e( 'Widget Layout:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>" type="text">
                        <option value='layout_one'<?php echo ($layout=='layout_one')?'selected':''; ?>><?php esc_html_e( 'Layout 1 (all small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_two'<?php echo ($layout=='layout_two')?'selected':''; ?>><?php esc_html_e( 'Layout 2 (one big + small images)', 'Newsgamer' ); ?></option>
                        <option value='layout_three'<?php echo ($layout=='layout_three')?'selected':''; ?>><?php esc_html_e( 'Layout 3 (all big images)', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>"><?php esc_html_e( 'Display category as:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('display_cats') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_cats') ); ?>" type="text">
                        <option value='root_category'<?php echo ($display_cats=='root_category')?'selected':''; ?>><?php esc_html_e( 'Root Category', 'Newsgamer' ); ?></option>
                        <option value='all'<?php echo ($display_cats=='all')?'selected':''; ?>><?php esc_html_e( 'Subcategories', 'Newsgamer' ); ?></option>
                        <option value='yoast_seo'<?php echo ($display_cats=='yoast_seo')?'selected':''; ?>><?php esc_html_e( 'YoastSEO Primary Category', 'weeklynews' ); ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>"><?php esc_html_e( 'Sort order:', 'Newsgamer' ); ?>
                    <select class='widefat' id="<?php echo esc_attr( $this->get_field_id('sort_order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('sort_order') ); ?>" type="text">
                        <option value='date'<?php echo ($sort_order=='date')?'selected':''; ?>><?php esc_html_e( 'Latest', 'Newsgamer' ); ?></option>
                        <option value='rand'<?php echo ($sort_order=='rand')?'selected':''; ?>><?php esc_html_e( 'Random posts', 'Newsgamer' ); ?></option>
                        <option value='name'<?php echo ($sort_order=='name')?'selected':''; ?>><?php esc_html_e( 'By name', 'Newsgamer' ); ?></option>
                        <option value='modified'<?php echo ($sort_order=='modified')?'selected':''; ?>><?php esc_html_e( 'Last Modified', 'Newsgamer' ); ?></option>
                        <option value='comment_count'<?php echo ($sort_order=='comment_count')?'selected':''; ?>><?php esc_html_e( 'Most Commented', 'Newsgamer' ); ?></option>
                        <option value='meta_value_num'<?php echo ($sort_order=='meta_value_num')?'selected':''; ?>><?php esc_html_e( 'Most Viewed', 'Newsgamer' ); ?></option>
                    </select>
                </label>
            </p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

            <p><label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Post offset:', 'Newsgamer' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" size="3" /></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_category ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_category' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>"><?php esc_html_e( 'Display category?', 'Newsgamer' ); ?></label></p>

            <p><input class="checkbox" type="checkbox" <?php checked( $show_views ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_views' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_views' ) ); ?>"><?php esc_html_e( 'Display post views?', 'Newsgamer' ); ?></label></p>



    <?php
            wp_reset_postdata();
        }
    }

}

# Load Widget Classes
add_action( 'widgets_init', 'mipthemeframework_load_widgets' );
function mipthemeframework_load_widgets() {

    global $mipthemeoptions_framework;

    register_widget( 'MipThemeFramework_Img_Widget' );
    register_widget( 'MipThemeFramework_AdsImg_Widget' );
    register_widget( 'MipThemeFramework_AdsEmbed_Widget' );
    register_widget( 'MipThemeFramework_AdsSystem_Widget' );
    register_widget( 'MipThemeFramework_Quote_Widget' );
    register_widget( 'MipThemeFramework_RecentPosts_Widget' );
    register_widget( 'MipThemeFramework_Timeline_Widget' );
    //register_widget( 'MipThemeFramework_AudioPosts_Widget' );
    register_widget( 'MipThemeFramework_Gallery_Widget' );
    register_widget( 'MipThemeFramework_Reviews_Widget' );
    register_widget( 'MipThemeFramework_About_Widget' );
    register_widget( 'MipThemeFramework_RelatedPosts_Widget' );
    register_widget( 'MipThemeFramework_Tags_Widget' );
    register_widget( 'MipThemeFramework_Author_Widget' );

    // add primary widget
    register_sidebar(
        array(
            'name' =>  esc_html__( 'Primary Widget Area', 'Newsgamer' ),
            'id' => 'primary-widget-area',
            'description' => esc_html__( 'The Primary widget area (Main Sidebar)', 'Newsgamer' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
            'after_widget' => '</aside>',
            'before_title' => '<header><div class="title"><span>',
            'after_title' => '</span></div></header>'
        )
    );

    $dynamic_sidebars   = get_option('_miptheme_sidebars');
    if (!empty($dynamic_sidebars)) {
        foreach($dynamic_sidebars as $sidebar) {
            register_sidebar(
                array(
                    'name' => $sidebar,
                    'id' => mipthemeframework_generate_slug($sidebar, 45),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
                    'after_widget' => '</aside>',
                    'before_title' => '<header><div class="title"><span>',
                    'after_title' => '</span></div></header>'
                )
            );
        }
    }


}
