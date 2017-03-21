<?php
/**
 * @package nav-menu-custom-fields
 * @version 0.1.0
 */
/*
Plugin Name: Nav Menu Custom Fields
*/


if(basename( $_SERVER['PHP_SELF']) == "nav-menus.php" ) {
    add_action('admin_menu', 'miptheme_menu_style');
}

if ( ! function_exists( 'miptheme_menu_style' ) ) {
function miptheme_menu_style()
{
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'mp_menus_scripts', get_template_directory_uri() . '/wp-admin/js/admin.js');
}
}

/*
 * Saves new field to postmeta for navigation
 */

if ( ! function_exists( 'mipthemeframework_custom_nav_update' ) ) {
    function mipthemeframework_custom_nav_update($menu_id, $menu_item_db_id, $args ) {

        if (isset($_REQUEST['menu-item-menu-type']) ) {
            if ( is_array($_REQUEST['menu-item-menu-type']) ) {
                if ( isset($_REQUEST['menu-item-menu-type'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-menu-type'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-menu-type', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-type']) ) {
            if ( is_array($_REQUEST['menu-item-articles-type']) ) {
                if ( isset($_REQUEST['menu-item-articles-type'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-type'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-type', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-cats']) ) {
            if ( is_array($_REQUEST['menu-item-articles-cats']) ) {
                if ( isset($_REQUEST['menu-item-articles-cats'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-cats'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-cats', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-tag']) ) {
            if ( is_array($_REQUEST['menu-item-articles-tag']) ) {
                if ( isset($_REQUEST['menu-item-articles-tag'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-tag'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-tag', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-offset']) ) {
            if ( is_array($_REQUEST['menu-item-articles-offset']) ) {
                if ( isset($_REQUEST['menu-item-articles-offset'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-offset'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-offset', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-order']) ) {
            if ( is_array($_REQUEST['menu-item-articles-order']) ) {
                if ( isset($_REQUEST['menu-item-articles-order'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-order'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-order', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-articles-sort']) ) {
            if ( is_array($_REQUEST['menu-item-articles-sort']) ) {
                if ( isset($_REQUEST['menu-item-articles-sort'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-articles-sort'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu-item-articles-sort', $custom_value );
                }
            }
        }

        if (isset($_REQUEST['menu-item-nav-color']) ) {
            if ( is_array($_REQUEST['menu-item-nav-color']) ) {
                if ( isset($_REQUEST['menu-item-nav-color'][$menu_item_db_id]) ) {
                    $custom_value = $_REQUEST['menu-item-nav-color'][$menu_item_db_id];
                    update_post_meta( $menu_item_db_id, '_menu_item_nav_color', $custom_value );
                }
            }
        }
    }
}


/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
if ( ! function_exists( 'mipthemeframework_custom_nav_item' ) ) {
    function mipthemeframework_custom_nav_item($menu_item) {
        $menu_item->menu_type           = get_post_meta( $menu_item->ID, '_menu-item-menu-type', true );
        $menu_item->articles_type       = get_post_meta( $menu_item->ID, '_menu-item-articles-type', true );
        $menu_item->articles_cat_filter = get_post_meta( $menu_item->ID, '_menu-item-articles-cats', true );
        $menu_item->articles_tag_filter = get_post_meta( $menu_item->ID, '_menu-item-articles-tag', true );
        $menu_item->articles_offset     = get_post_meta( $menu_item->ID, '_menu-item-articles-offset', true );
        $menu_item->articles_order      = get_post_meta( $menu_item->ID, '_menu-item-articles-order', true ) ? get_post_meta( $menu_item->ID, '_menu-item-articles-order', true ) : 'date';
        $menu_item->articles_sort       = get_post_meta( $menu_item->ID, '_menu-item-articles-sort', true ) ? get_post_meta( $menu_item->ID, '_menu-item-articles-sort', true ) : 'DESC';
        //$menu_item->articles_order      = get_post_meta( $menu_item->ID, '_menu-item-articles-order', true );
        //$menu_item->articles_sort       = get_post_meta( $menu_item->ID, '_menu-item-articles-sort', true );
        $menu_item->nav_color           = get_post_meta( $menu_item->ID, '_menu_item_nav_color', true );

        return $menu_item;
    }
}


if ( ! function_exists( 'mipthemeframework_custom_nav_edit_walker' ) ) {
    function mipthemeframework_custom_nav_edit_walker($walker,$menu_id) {
        return 'MipThemeFramework_Walker_Nav_Menu_Edit_Custom';
    }
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
if ( ! class_exists( 'MipThemeFramework_Walker_Nav_Menu_Edit_Custom' ) ) {
    class MipThemeFramework_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
        /**
         * @see Walker_Nav_Menu::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         */
        function start_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * @see Walker_Nav_Menu::end_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         */
        function end_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param object $args
         */

        function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $_wp_nav_menu_max_depth;
            $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            ob_start();
            $item_id = esc_attr( $item->ID );
            $removed_args = array(
                'action',
                'customlink-tab',
                'edit-menu-item',
                'menu-item',
                'page-tab',
                '_wpnonce',
            );

            $original_title = '';
            if ( 'taxonomy' == $item->type ) {
                $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
                if ( is_wp_error( $original_title ) )
                    $original_title = false;
            } elseif ( 'post_type' == $item->type ) {
                $original_object = get_post( $item->object_id );
                $original_title = $original_object->post_title;
            }

            $classes = array(
                'menu-item menu-item-depth-' . $depth,
                'menu-item-' . esc_attr( $item->object ),
                'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
            );

            $title = $item->title;

            if ( ! empty( $item->_invalid ) ) {
                $classes[] = 'menu-item-invalid';
                /* translators: %s: title of menu item which is invalid */
                $title = sprintf( esc_html__( '%s (Invalid)', 'Newsgamer' ), $item->title );
            } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( esc_html__('%s (Pending)', 'Newsgamer'), $item->title );
            }

            $title = empty( $item->label ) ? $title : $item->label;

    ?>
            <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
                <dl class="menu-item-bar">
                    <dt class="menu-item-handle">
                        <span class="item-title"><?php echo esc_html( $title ); ?></span>
                        <span class="item-controls">
                            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                            <span class="item-order hide-if-js">
                                <a href="<?php
                                    echo wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-up-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-up"><abbr title="<?php esc_attr( esc_html_e('Move up', 'Newsgamer') ); ?>">&#8593;</abbr></a>
                                |
                                <a href="<?php
                                    echo wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-down-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-down"><abbr title="<?php esc_attr( esc_html_e('Move down', 'Newsgamer') ); ?>">&#8595;</abbr></a>
                            </span>
                            <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr( esc_html_e('Edit Menu Item', 'Newsgamer') ); ?>" href="<?php
                                echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) )) );
                            ?>"><?php esc_html_e( 'Edit Menu Item', 'Newsgamer' ); ?></a>
                        </span>
                    </dt>
                </dl>

                <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
                    <?php if( 'custom' == $item->type ) : ?>
                        <p class="field-url description description-wide">
                            <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                                <?php esc_html_e( 'URL', 'Newsgamer' ); ?><br />
                                <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                            </label>
                        </p>
                    <?php endif; ?>
                    <p class="description description-thin">
                        <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Navigation Label', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                        </label>
                    </p>
                    <p class="description description-thin">
                        <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Title Attribute', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                        </label>
                    </p>
                    <p class="field-link-target description">
                        <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                            <?php esc_html_e( 'Open link in a new window/tab', 'Newsgamer' ); ?>
                        </label>
                    </p>
                    <p class="field-css-classes description description-thin">
                        <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'CSS Classes (optional)', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                        </label>
                    </p>
                    <p class="field-xfn description description-thin">
                        <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Link Relationship (XFN)', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                        </label>
                    </p>
                    <p class="field-description description description-wide">
                        <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Description', 'Newsgamer' ); ?><br />
                            <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                            <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'Newsgamer'); ?></span>
                        </label>
                    </p>
                    <?php
                    /*
                     * This are the added fields
                     */
                    if ( $depth == 0 ) {
                    ?>

                    <p class="menu-type description-wide">
                        <label for="edit-menu-item-menu-type-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Dropdown Type', 'Newsgamer' ); ?><br />
                            <select id="edit-menu-item-menu-type-<?php echo esc_attr($item_id); ?>" class="widefat" name="menu-item-menu-type[<?php echo esc_attr($item_id); ?>]">
                                <option value="" <?php selected( $item->menu_type, '' ); ?>><?php esc_html_e( 'Default Menu', 'Newsgamer' ); ?></option>
                                <option value="cat" <?php selected( $item->menu_type, 'cat' ); ?>><?php esc_html_e( 'Category Mega Menu', 'Newsgamer' ); ?></option>
                            </select>
                        </label>
                    </p>

                    <!--p class="field-custom description description-wide">
                        <label for="edit-menu-item-megamenu-related-posts-<?php echo esc_attr($item_id); ?>">
                            <input type="checkbox" id="edit-menu-item-megamenu-related-posts-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-megamenu-related-posts[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->megamenu, '_blank' ); ?> />
                            <?php esc_html_e( 'Show megamenu with latest posts', 'Newsgamer' ); ?>
                        </label>
                    </p-->

                    <p class="menu-color description description-wide">
                        <label for="edit-menu-item-nav-color-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Menu Item Color', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-nav-color-<?php echo esc_attr($item_id); ?>" class="widefat mp-color-field edit-menu-item-nav-color" name="menu-item-nav-color[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->nav_color ); ?>" />
                            <br><span class="description cat_only"><?php esc_html_e('Use this only on pages and custom links.', 'Newsgamer'); ?></span>
                        </label>
                    </p>

                    <?php
                    }

                    if ( $depth == 1 ) {
                    ?>

                    <p class="articles-type description-wide">
                        <label for="edit-menu-item-articles-type-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Articles Display', 'Newsgamer' ); ?><br />
                            <select id="edit-menu-item-articles-type-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-type" name="menu-item-articles-type[<?php echo esc_attr($item_id); ?>]">
                                <option value="" <?php selected( $item->articles_type, '' ); ?>><?php esc_html_e( '---', 'Newsgamer' ); ?></option>
                                <option value="default" <?php selected( $item->articles_type, 'default' ); ?>><?php esc_html_e( 'Default Articles (if this is a category)', 'Newsgamer' ); ?></option>
                                <option value="custom" <?php selected( $item->articles_type, 'custom' ); ?>><?php esc_html_e( 'Custom Articles', 'Newsgamer' ); ?></option>
                                <option value="review" <?php selected( $item->articles_type, 'review' ); ?>><?php esc_html_e( 'Review Articles Only', 'Newsgamer' ); ?></option>
                            </select>
                            <?php esc_html_e( 'Use only if parent is selected as "Category Mega Menu"', 'Newsgamer' ); ?>
                        </label>
                    </p>

                    <p class="articles-cats description-wide hide">
                        <label for="edit-menu-item-articles-cats-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Category filter', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-articles-cats-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-cats" name="menu-item-articles-cats[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->articles_cat_filter ); ?>" />
                        </label>
                    </p>

                    <p class="articles-tag description-thin hide">
                        <label for="edit-menu-item-articles-tag-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Filter by tag slug', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-articles-tag-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-tag" name="menu-item-articles-tag[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->articles_tag_filter ); ?>" />
                        </label>
                    </p>

                    <p class="articles-offset description-thin hide">
                        <label for="edit-menu-item-articles-offset-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Offset', 'Newsgamer' ); ?><br />
                            <input type="text" id="edit-menu-item-articles-offset-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-offset" name="menu-item-articles-offset[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->articles_offset ); ?>" />
                        </label>
                    </p>

                    <p class="articles-tag description-thin hide">
                        <label for="edit-menu-item-articles-order-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Order by', 'Newsgamer' ); ?><br />
                            <select id="edit-menu-item-articles-order-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-order" name="menu-item-articles-order[<?php echo esc_attr($item_id); ?>]">
                                <option value="date" <?php selected( $item->articles_order, 'date' ); ?>><?php esc_html_e( 'Published Date', 'Newsgamer' ); ?></option>
                                <option value="ID" <?php selected( $item->articles_order, 'ID' ); ?>><?php esc_html_e( 'Post ID', 'Newsgamer' ); ?></option>
                                <option value="rand" <?php selected( $item->articles_order, 'rand' ); ?>><?php esc_html_e( 'Random order', 'Newsgamer' ); ?></option>
                                <option value="modified" <?php selected( $item->articles_order, 'modified' ); ?>><?php esc_html_e( 'Last modified date', 'Newsgamer' ); ?></option>
                                <option value="menu_order" <?php selected( $item->articles_order, 'menu_order' ); ?>><?php esc_html_e( 'Number of comments', 'Newsgamer' ); ?></option>
                            </select>
                        </label>
                    </p>

                    <p class="articles-offset description-thin hide">
                        <label for="edit-menu-item-articles-sort-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Sort order', 'Newsgamer' ); ?><br />
                            <select id="edit-menu-item-articles-sort-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-articles-sort" name="menu-item-articles-sort[<?php echo esc_attr($item_id); ?>]">
                                <option value="DESC" <?php selected( $item->articles_sort, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'Newsgamer' ); ?></option>
                                <option value="ASC" <?php selected( $item->articles_sort, 'ASC' ); ?>><?php esc_html_e( 'Ascending ', 'Newsgamer' ); ?></option>
                            </select>
                        </label>
                    </p>

                    <?php
                    }
                    /*
                     * end added field
                     */
                    ?>
                    <div class="menu-item-actions description-wide submitbox">
                        <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                            <p class="link-to-original">
                                <?php printf( esc_html__('Original: %s', 'Newsgamer'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                            </p>
                        <?php endif; ?>
                        <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'delete-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'delete-menu_item_' . $item_id
                        ); ?>"><?php esc_html_e('Remove', 'Newsgamer'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                            ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'Newsgamer'); ?></a>
                    </div>

                    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
                    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                </div><!-- .menu-item-settings-->
                <ul class="menu-item-transport"></ul>
    <?php
            $output .= ob_get_clean();
        }
    }
}


if ( ! function_exists( 'mipthemeframework_wpa_category_nav_class' ) ) {
    function mipthemeframework_wpa_category_nav_class( $classes, $item ){
        if( 'category' == $item->object ){
            $classes[] = 'menu-category-' . $item->object_id;
        }
        return $classes;
    }
}


if ( ! class_exists( 'MipThemeFramework_Head_Desktop_Walker_Nav_Menu' ) ) {
    class MipThemeFramework_Head_Desktop_Walker_Nav_Menu extends Walker_Nav_Menu {

        private $curr_menu_type;
        private $curr_articles_type;
        private $curr_articles_cat_filter;
        private $curr_articles_tag_filter;
        private $curr_articles_offset;
        private $curr_articles_order;
        private $curr_articles_sort;

        // add classes to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            if ($this->curr_menu_type) {
                $output .= "\n$indent<div class=\"subnav-container\"><ul class=\"subnav-menu\">\n";
            } else {
                if ($depth == 0) {
                    $output .= "\n$indent<div class=\"dropnav-container\"><ul class=\"dropnav-menu\">\n";
                } else {
                    $output .= "\n$indent<ul>\n";
                }
            }
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            if ($this->curr_menu_type) {
                $output .= "</ul></div>\n";
            } else {
                if ($depth == 0) {
                    $output .= "</ul></div>\n";
                } else {
                    $output .= "</ul>\n";
                }
            }
        }


        // add main/sub classes to li's and links
        function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query, $mipthemeoptions_framework;

            $posts_per_menu = (isset( $mipthemeoptions_framework['_mpgl_header_nav_type'] ) && ($mipthemeoptions_framework['_mpgl_header_nav_type'] == '0') ) ? 6 : 4;
            $posts_class    = ( $posts_per_menu == 4 )  ? 'col-sm-6 col-md-3'   : 'col-sm-4 col-md-2';
            $indent         = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

            $this->curr_menu_type               = $item->menu_type;
            $this->curr_articles_type           = $item->articles_type;
            $this->curr_articles_cat_filter     = $item->articles_cat_filter;
            $this->curr_articles_tag_filter     = $item->articles_tag_filter;
            $this->curr_articles_offset         = $item->articles_offset;
            $this->curr_articles_order          = $item->articles_order;
            $this->curr_articles_sort           = $item->articles_sort;

            // depth dependent classes
            $depth_classes = array(
                ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
                ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                'menu-item-depth-' . $depth
            );
            $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

            // passed classes
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
            $cat_name       = ( is_category( esc_attr( $item->attr_title ) ) ) ? 'category' : '';

            // build html
            $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $cat_name .'">';

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

            $menu_list  = '';

            if ( $this->curr_articles_type ) {

                $menu_list .= '<div class="subnav-posts">';

                switch ( $this->curr_articles_type ) {
                    case 'default':
                        $query_args = array(
                            'cat'                   => $item->object_id,
                            'tag'                   => $this->curr_articles_tag_filter,
                            'offset'                => $this->curr_articles_offset,
                            'orderby'               => $this->curr_articles_order,
                            'order'                 => $this->curr_articles_sort,
                            'no_found_rows'         => true,
                            'post_status'           => 'publish',
                            'ignore_sticky_posts'   => true,
                            'posts_per_page'        => $posts_per_menu,
                        );
                    break;
                    case 'custom':
                        $query_args = array(
                            'cat'                  => ( $this->curr_articles_cat_filter ? $this->curr_articles_cat_filter : '' ),
                            'tag'                  => $this->curr_articles_tag_filter,
                            'offset'               => $this->curr_articles_offset,
                            'orderby'               => $this->curr_articles_order,
                            'order'                 => $this->curr_articles_sort,
                            'posts_per_page'       => $posts_per_menu,
                            'no_found_rows'        => true,
                            'post_status'          => 'publish',
                            'ignore_sticky_posts'  => true,
                        );
                    break;
                    case 'review':
                        $query_args = array(
                            'cat'                  => ( $this->curr_articles_cat_filter ? $this->curr_articles_cat_filter : '' ),
                            'tag'                  => $this->curr_articles_tag_filter,
                            'offset'               => $this->curr_articles_offset,
                            'orderby'               => $this->curr_articles_order,
                            'order'                 => $this->curr_articles_sort,
                            'posts_per_page'       => $posts_per_menu,
                            'no_found_rows'        => true,
                            'post_status'          => 'publish',
                            'ignore_sticky_posts'  => true,
                            'meta_key'             => '_mp_review_post_total_score'
                        );
                    break;

                }


                $r = new WP_Query( $query_args );

                // The Loop
                while ( $r->have_posts() ) {
                    $r->the_post();
                    $image_post_format                  = 'miptheme-post-thumb-6';//277, 190
                    $post_article                       = new MipThemeFramework_Article();
                    $post_article->article_link         = $r->post->ID;
                    $post_article->article_title        = $r->post->post_title;
                    $post_article->article_thumb_width  = 277;
                    $post_article->article_thumb_height = 190;

                    $att_img_src                        = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format );
                    $post_article->article_thumb        = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

                    $menu_list .= '<div class="'. $posts_class .'">'. $post_article->formatArticleForMegaMenu() .'</div>';
                }
                wp_reset_postdata();

                $menu_list .= '</div>';

            } else if ( $this->curr_menu_type && !$item->hasChildren ) {
                $query_args = array(
                    'cat'                   => $item->object_id,
                    'no_found_rows'         => true,
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => true,
                    'posts_per_page'        => $posts_per_menu,
                );
                $r = new WP_Query( $query_args );
                $menu_list .= '<div class="subnav-container subnav-full"><div class="subnav-posts"><div class="row">';

                // The Loop
                while ( $r->have_posts() ) {
                    $r->the_post();
                    $image_post_format                  = 'miptheme-post-thumb-6';
                    $post_article                       = new MipThemeFramework_Article();
                    $post_article->article_link         = $r->post->ID;
                    $post_article->article_title        = $r->post->post_title;
                    $post_article->article_thumb_width  = 277;
                    $post_article->article_thumb_height = 190;

                    $att_img_src                        = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format );
                    $post_article->article_thumb        = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

                    $menu_list .= '<div class="'. $posts_class .'">'. $post_article->formatArticleForMegaMenu() .'</div>';
                }
                wp_reset_postdata();

                $menu_list .= '</div></div></div>';
            }


            $item_output = $args->before;
            $item_output = '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $menu_list;
            $item_output .= $args->after;


            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }


        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            // check, whether there are children for the given ID and append it to the element with a (new) ID
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

    }
}


if ( ! class_exists( 'MipThemeFramework_Head_Mobile_Walker_Nav_Menu' ) ) {
    class MipThemeFramework_Head_Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {

        function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            //global $wp_query;
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
            $show_more = '';

            // depth dependent classes
            $depth_classes = array(
                ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
                ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                'menu-item-depth-' . $depth
            );
            $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

            // passed classes
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
            $cat_name       = ( is_category( esc_attr( $item->attr_title ) ) ) ? 'category' : '';

            // build html
            $output .= $indent . '<li id="mobile-nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $cat_name .'">';

            $args = isset($args) ? $args : array();

            /*if ( $args->has_children ) {
                $output .= '<a class="more" href="#"><i class="fa fa-angle-down"></i></a>';
            }*/

            // link attributes
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            //$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';



            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $show_more,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );

            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];

            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
            }

            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

    }
}
