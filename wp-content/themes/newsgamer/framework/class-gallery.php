<?php

add_filter( 'post_gallery', 'MipThemeFramework_Post_Gallery_Output', 10, 2 );

if ( ! function_exists( 'MipThemeFramework_Post_Gallery_Output' ) ) {

    function MipThemeFramework_Post_Gallery_Output( $output, $attr ) {

        if ( isset($attr['miptheme_gallery'])&&($attr['miptheme_gallery'] == 'miptheme') ) {



            global $post, $wp_locale;

            static $instance = 0;
            $instance++;

            // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
            if ( isset( $attr['orderby'] ) ) {
                $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
                if ( !$attr['orderby'] )
                    unset( $attr['orderby'] );
            }

            extract(shortcode_atts(array(
                'order'      => 'ASC',
                'orderby'    => 'menu_order ID',
                'id'         => $post->ID,
                'itemtag'    => 'dl',
                'icontag'    => 'dt',
                'captiontag' => 'dd',
                'columns'    => 3,
                'size'       => 'thumbnail',
                'include'    => '',
                'exclude'    => ''
            ), $attr));

            $id = intval($id);
            if ( 'RAND' == $order )
                $orderby = 'none';

            if ( !empty($include) ) {
                $include = preg_replace( '/[^0-9,]+/', '', $include );
                $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

                $attachments = array();
                foreach ( $_attachments as $key => $val ) {
                    $attachments[$val->ID] = $_attachments[$key];
                }
            } elseif ( !empty($exclude) ) {
                $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
                $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
            } else {
                $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
            }

            if ( empty($attachments) )
                return '';

            if ( is_feed() ) {
                $output = "\n";
                foreach ( $attachments as $att_id => $attachment )
                    $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
                return $output;
            }

            $itemtag = tag_escape($itemtag);
            $captiontag = tag_escape($captiontag);
            $columns = intval($columns);
            $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
            $float = is_rtl() ? 'right' : 'left';

            $selector = "gallery-{$instance}";

            $output = apply_filters('gallery_style', "
                <div id='$selector' class='miptheme-photo-gallery miptheme-photo-gallery-one galleryid-{$id}'>");

            $i = 0;

            $attachment_img     = '';
            $attachment_caption = '';

            foreach ( $attachments as $id => $attachment ) {

                $image_attr_full    = wp_get_attachment_image_src( $id, 'full' );
                $image_attr_thumb   = wp_get_attachment_image_src( $id, array(630,430) );

                $attachment_img .=  '<figure>
                                        <a class="pix" href="'. $image_attr_full[0] .'">
                                            <img src="'. $image_attr_thumb[0] .'" width="630" height="430"class="img-responsive" alt="'. wptexturize($attachment->post_excerpt) .'" title="'. wptexturize($attachment->post_title) .'" />
                                            <div class="zoomix"><i class="fa fa-search"></i></div>
                                        </a>
                                    </figure>';

                if ( $i == 0 ) $attachment_caption = wptexturize($attachment->post_excerpt);
                $i++;
            }

            $output =   '<div id="'. $selector .'" class="miptheme-photo-gallery miptheme-photo-gallery-one galleryid-'. $id .'"">
                            <div class="miptheme-gallery-photos owl-carousel">
                                '. $attachment_img .'
                            </div>
                            <div class="gallery-info">
                                <p>'. $attachment_caption .'</p>
                                <span class="nav">
                                    <span class="index"><span class="pos">1</span> of '. count($attachments) .'</span>
                                </span>
                            </div>
                        </div>
                        <script>
                        "use strict";
                        jQuery( document ).ready(function( $ ) {
                            $(\'.galleryid-'. $id .' .miptheme-gallery-photos\').owlCarousel({
                                loop:true,
                                margin:0,
                                items: 1,
                                navText: [ \'<i class="fa fa-chevron-left"></i>\', \'<i class="fa fa-chevron-right"></i>\' ],
                                navContainer: \'.miptheme-photo-gallery .nav\',
                                onTranslated: gallery_callback_'. $id .'
                            })

                            function gallery_callback_'. $id .'(event) {
                                if (event.page.index != -1) {
                                    $(\'.miptheme-photo-gallery.galleryid-'. $id .' .index .pos\').html(event.page.index + 1);
                                    $(\'.miptheme-photo-gallery.galleryid-'. $id .' .gallery-info p\').html( $(\'.miptheme-photo-gallery.galleryid-'. $id .' .active img\').attr(\'alt\') );
                                }

                            }
                        });
                        </script>';

            return $output;

        }

    }

}



add_action( 'print_media_templates', 'MipThemeFramework_Post_Gallery_Settings' );

if ( ! function_exists( 'MipThemeFramework_Post_Gallery_Settings' ) ) {

    function MipThemeFramework_Post_Gallery_Settings( $attr ) {

        // define your backbone template;
        // the "tmpl-" prefix is required,
        // and your input field should have a data-setting attribute
        // matching the shortcode name
        ?>
        <script type="text/html" id="tmpl-miptheme-custom-gallery-setting">
          <label class="setting">
            <span><?php esc_html_e('MipTheme Gallery: ', 'Newsgamer'); ?></span>
            <select name="miptheme_gallery" data-setting="miptheme_gallery">
              <option value="miptheme">MipTheme Gallery</option>
              <option value="default_val">Default WordPress Gallery &nbsp;</option>
            </select>
          </label>
        </script>

        <script>

          jQuery(document).ready(function(){

            // add your shortcode attribute and its default value to the
            // gallery settings list; $.extend should work as well...
            _.extend(wp.media.gallery.defaults, {
              miptheme_gallery: 'default_val'
            });

            // merge default gallery settings template with yours
            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
              template: function(view){
                return wp.media.template('gallery-settings')(view)
                     + wp.media.template('miptheme-custom-gallery-setting')(view);
              }
            });

          });

        </script>
        <?php
    }

}
