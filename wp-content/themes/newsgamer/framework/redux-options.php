<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }



    // This is your option name where all the Redux data is stored.
    $opt_name           = "mipthemeoptions_framework";
    $mp_post_options    = get_option('miptheme');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => 'Theme Options',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'Newsgamer' ),
        //'page_title'           => esc_html__( 'Theme Options', 'Newsgamer' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        //'google'               => true,
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        'disable_tracking'     => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        //'page_parent'          => 'miptheme_welcome',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
    );

    Redux::setArgs( $opt_name, $args );

    if ( function_exists( 'MipThemeFramework_extensions_path' ) ) {
        $ext_path = MipThemeFramework_extensions_path();
        Redux::setExtensions($opt_name, $ext_path);
    }

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

     // -> START General Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'General Settings', 'Newsgamer' ),
         'id'               => '_mp_general_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-icon-cogs',
         'fields'           => array(
             array(
     			'id' => '_mp_grid_width',
     			'type' => 'button_set',
     			'title' => esc_html__('Grid Layout', 'Newsgamer'),
     			'subtitle' => esc_html__('Select grid width layout', 'Newsgamer'),
     			'options'   => array(
     			    'grid-1340'   => '1340px',
                    'grid-1200'   => '1170px',
                    'grid-992'   => '970px',
     			),
     			'default' => 'grid-1340',
 		    ),
             /*array(
                 'id' => '_mp_enable_1340_grid',
                 'type' => 'switch',
                 'title' => esc_html__('Enable 1340px Grid', 'Newsgamer'),
                 'subtitle' => esc_html__('By disabling this option you revert to standard Bootstrap 1200px grid!', 'Newsgamer'),
                 'default' => 1,
             ),*/
            array(
                'id' => '_mp_enable_ajax_post_views',
                'type' => 'switch',
                'title' => esc_html__('Enable Ajax Post Views', 'Newsgamer'),
                'subtitle' => esc_html__('Enable this if you are using a cache plugin!', 'Newsgamer'),
                'default' => 1,
            ),
            array(
    			'id' => '_mp_theme_smooth_scrolling',
    			'type' => 'switch',
    			'title' => esc_html__('Enable Smooth Scrolling', 'Newsgamer'),
                'subtitle' => esc_html__('Works only on Chrome browser', 'Newsgamer'),
    			'default' => 1,
		    ),
            array(
                'id' => '_mp_posts_enable_lazy_load',
                'type' => 'switch',
                'title' => esc_html__('Enable Lazy Load for images', 'Newsgamer'),
                'subtitle' => esc_html__('Lazy Load is delays loading of images in long web pages', 'Newsgamer'),
                'default' => 0,
            ),
            array(
    			'id' => '_mp_theme_google_fonts',
    			'type' => 'switch',
    			'title' => esc_html__('Enable Google Fonts', 'Newsgamer'),
                'subtitle' => esc_html__('Enable Google Fonts on Theme Typography', 'Newsgamer'),
    			'default' => false,
		    ),
            array(
    			'id' => '_mp_theme_fullscreen_login_plugin',
    			'type' => 'switch',
    			'title' => esc_html__('Enable Fullscreen Login', 'Newsgamer'),
                'subtitle' => esc_html__('Works only if you install "PressApps Fullscreen Login" plugin', 'Newsgamer'),
    			'default' => false,
		    ),
            array(
    			'id' => '_mp_theme_yoastseo_primary_category',
    			'type' => 'switch',
    			'title' => __('Enable Yoast SEO Primary Category selection', 'weeklynews'),
                'subtitle' => __('Works only if Yoast SEO plugin is installed', 'weeklynews'),
                'description' => __('This option will override all "Root/sub Categories" selection in Theme Options (except widgets - has to be set manually)', 'weeklynews'),
    			'default' => 0,
		    ),

         )
     ) );


     // -> START Homepage Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Homepage Settings', 'Newsgamer' ),
         'id'               => '_mp_homepage_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-home',
         'fields'           => array(
             array(
    			'id' => '_mp_homepage_info',
    			'type' => 'info',
    			'notice' => true,
    			'style' => 'success',
    			'desc' => esc_html__('Only if "Front page display" is set to "Your latest posts".', 'Newsgamer'),
            ),
            array(
    			'id' => '_mpgl_homepage_template',
    			'type' => 'image_select',
    			'title' => esc_html__('Posts Layout', 'Newsgamer'),
    			'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
    			'options' => array(
    			    'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
    			    'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
    			    'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
    			    'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
    			    'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
    			    'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
    			    'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
    			    'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                    'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                    'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                    'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                    'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
    			),
                'default' => 'loop-cat-1'
            ),
            array(
    			'id'=>'_mpgl_homepage_template_chars',
    			'type' => 'slider',
    			'title' => esc_html__('Limit text characters', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "1000",
    			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                'required'  => array('_mpgl_homepage_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
		    ),
            array(
    			'id' => '_mpgl_homepage_grid_width',
    			'type' => 'button_set',
    			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
    			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
    			'options'   => array(
    			    'standard'   => 'Standard',
    			    'full-width' => 'Full Width'
    			),
    			'default' => 'standard',
                'required'  => array('_mpgl_homepage_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
		    ),
            array(
                'id'       => '_mpgl_homepage_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
            ),
            array(
    			'id' => '_mpgl_homepage_unique_posts',
    			'type' => 'switch',
    			'title' => esc_html__('Enable Unique Articles', 'Newsgamer'),
    			'subtitle' => esc_html__('Do not display duplicate articles in main area.', 'Newsgamer'),
    			'default' => 1,
		    ),
            array(
    			'id' => '_mpgl_homepage_sidebar_template',
    			'type' => 'image_select',
    			'title' => esc_html__('Sidebar position', 'Newsgamer'),
    			'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
    			'options' => array(
    			    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
    			    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
    			    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
    			    ),
    			'default' => 'right-sidebar'
		    ),
            array(
    			'id' => '_mpgl_homepage_sidebar_source',
    			'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
    			'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
    			'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
    			'type' => 'select',
    			'data' => 'sidebars',
    			'default' => 'None',
    			'required'  => array('_mpgl_homepage_sidebar_template', "!=", 'hide-sidebar'),
		    ),
            array(
    			'id'=>'_mpgl_homepage_posts_number',
    			'type' => 'slider',
    			'title' => esc_html__('Posts per page', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "50",
    			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
		    ),
		    array(
    			'id' => '_mpgl_homepage_pagination',
    			'type' => 'button_set',
    			'title' => esc_html__('Pagination template', 'Newsgamer'),
    			'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
    			'options'   => array(
    			    'post-pagination-1' => 'Pager with numbers',
    			    'post-pagination-2' => 'Prev/next pager'
    			),
    			'default' => 'post-pagination-1',
		    ),
         )
     ) );


     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Top Grid Settings', 'Newsgamer' ),
         'id'               => '_mp_homepage_topgrid_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
    			'id' => '_mp_homepage_info',
    			'type' => 'info',
    			'notice' => true,
    			'style' => 'success',
    			'desc' => esc_html__('Only if "Front page display" is set to "<a href="options-reading.php">Your latest posts</a>".', 'Newsgamer'),
            ),
            array(
                'id' => '_mpgl_homepage_top_grid_enable',
                'type' => 'button_set',
                'title' => esc_html__('Enable Top Grid', 'Newsgamer'),
                'options' => array(
                    0 => 'Disable',
                    1 => 'Enable',
                    2 => 'Shortcode'
                 ),
                'default' => 0
            ),
            array(
                'id' => '_mpgl_homepage_top_grid_shortcode',
                'type' => 'text',
                'title' => esc_html__('Top Grid Shortcode', 'Newsgamer'),
                'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 2)
            ),
            array(
    			'id'        => '_mpgl_homepage_top_grid_layout',
    			'type'      => 'image_select',
    			'title'     => esc_html__('Grid layout', 'Newsgamer'),
    			'subtitle'  => esc_html__('Select layout for your grid', 'Newsgamer'),
    			'options' => array(
    			    'top-grid-layout-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-1.png'),
                    'top-grid-layout-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-2.png'),
                    'top-grid-layout-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-3.png'),
                    'top-grid-layout-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-4.png'),
                    'top-grid-layout-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-5.png'),
                    'top-grid-layout-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-6.png'),
                    'top-grid-layout-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-7.png'),
                    'top-grid-layout-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-8.png'),
                    'top-grid-layout-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-9.png'),
                    'top-grid-layout-10' => array('alt' => 'Layout 10', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-10.png'),
                    'top-grid-layout-11' => array('alt' => 'Layout 11', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-11.png'),
                    'top-grid-layout-12' => array('alt' => 'Layout 12', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-12.png'),
    			),
    			'default'   => 'top-grid-layout-1',
    			'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
		    ),
            array(
                'id' => '_mpgl_homepage_top_grid_full_width',
                'type' => 'switch',
                'title' => esc_html__('Enable Full width layout', 'Newsgamer'),
                'subtitle'  => esc_html__('Full width container', 'Newsgamer'),
                'default' => 1,
                'required'  => array(array('_mpgl_homepage_top_grid_enable', "equals", 1), array('_mpgl_homepage_top_grid_layout', "!=", 'top-grid-layout-9'))
            ),
            array(
                'id' => '_mpgl_homepage_top_grid_verge_style',
                'type' => 'switch',
                'title' => esc_html__('Enable "Verge" styling', 'Newsgamer'),
                'subtitle'  => esc_html__('Colourful backgrounds', 'Newsgamer'),
                'default' => 0,
                'required'  => array(array('_mpgl_homepage_top_grid_enable', "equals", 1), array('_mpgl_homepage_top_grid_layout', "!=", 'top-grid-layout-9'))
            ),
            array(
                'id'       => '_mpgl_homepage_top_grid_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
                'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
            ),
            array(
    			'id'        => '_mpgl_homepage_top_grid_sort',
    			'type'      => 'select',
    			'title'     => esc_html__('Sort order', 'Newsgamer'),
    			'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
    			'options'   => array(
    			    'date' => 'Latest',
    			    'rand' => 'Random posts',
    			    'name' => 'By name',
    			    'type' => 'By Post Type',
    			    'modified' => 'Last Modified',
    			    'comment_count' => 'Most Commented',
    			),
    			'default'   => 'date',
    			'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
		    ),
		    array(
    			'id' => '_mpgl_homepage_top_grid_categories',
    			'type' => 'select',
    			'data'      => 'categories',
    			'multi'     => true,
    			'sortable'   => true,
    			'title' => esc_html__('Show categories', 'Newsgamer'),
    			'subtitle'  => esc_html__('If none is selected, all categories are included by default', 'Newsgamer'),
    			'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
		    ),
		    array(
    			'id' => '_mpgl_homepage_top_grid_tags',
    			'type' => 'select',
    			'data'      => 'tags',
    			'multi'     => true,
    			'sortable'   => true,
    			'title' => esc_html__('Filter by tag slug', 'Newsgamer'),
    			'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
		    ),
            array(
                'id' => '_mpgl_homepage_top_grid_posttype',
                'type' => 'select',
                'data'      => 'post_type',
                'multi'     => true,
                'sortable'   => true,
                'title' => esc_html__('Filter by post type', 'Newsgamer'),
                'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
            ),
		    array(
    			'id' => '_mpgl_homepage_top_grid_category_display',
    			'type' => 'button_set',
    			'title' => esc_html__('Display Category labels as', 'Newsgamer'),
    			'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
    			'options'   => array(
    			    'root' => 'Root Categories',
    			    'sub' => 'Sub Categories'
    			),
    			'default' => 'root',
    			'required'  => array('_mpgl_homepage_top_grid_enable', "equals", 1)
		    ),
         ),
     ) );



     // -> START Header Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Header Settings', 'Newsgamer' ),
         'id'               => '_mp_header_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-icon-eject',
         'fields'           => array(
            array(
                'id' => '_mp_header_type',
                'type' => 'button_set',
                'title' => esc_html__('Header type', 'Newsgamer'),
                'subtitle' => esc_html__('Type of header to display', 'Newsgamer'),
                'options'   => array(
                    '0' => 'Full width',
                    '2' => 'Full Width Background Only',
                    '1' => 'Boxed',
                ),
                'default' => '1',
            ),
            array(
                'id' => '_mp_enable_header_widgets',
                'type' => 'switch',
                'title' => esc_html__('Enable widgetized area', 'Newsgamer'),
                'on' => 'Enable',
                'off' => 'Disable',
                'default' => false,
            ),
            array(
                'id' => '_mp_header_widget_layout',
                'type' => 'image_select',
                'title' => esc_html__('Area layout', 'Newsgamer'),
                'subtitle' => esc_html__('Select header layout.', 'Newsgamer'),
                'options' => array(
                    'header-layout-widget-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-1.png'),
                    'header-layout-widget-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-2.png'),
                    'header-layout-widget-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-3.png'),
                ),
                'required'  => array('_mp_enable_header_widgets', "equals", '1'),
            ),
            array(
                'id' => '_mp_header_widget_column_1_source',
                'title' => esc_html__( 'Select sidebar for first column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on first column.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'None',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-1', 'header-layout-widget-2', 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),
            array(
                'id' => '_mp_header_widget_column_1_align',
                'type' => 'select',
                'title' => esc_html__('Select alignment for first column', 'Newsgamer'),
                'options' => array(
                'text-left' => 'Left',
                'text-center' => 'Center',
                'text-right' => 'Right',
                ),
                'default' => 'text-left',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-1', 'header-layout-widget-2', 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),

            array(
                'id' => '_mp_header_widget_column_2_source',
                'title' => esc_html__( 'Select sidebar for second column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on second column.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'None',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-2', 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),
            array(
                'id' => '_mp_header_widget_column_2_align',
                'type' => 'select',
                'title' => esc_html__('Select alignment for second column', 'Newsgamer'),
                'options' => array(
                'text-left' => 'Left',
                'text-center' => 'Center',
                'text-right' => 'Right',
                ),
                'default' => 'text-left',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-2', 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),

            array(
                'id' => '_mp_header_widget_column_3_source',
                'title' => esc_html__( 'Select sidebar for third column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on third column.',
                'type' => 'select',
                'data' => 'sidebars',
                'default' => 'None',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),
            array(
                'id' => '_mp_header_widget_column_3_align',
                'type' => 'select',
                'title' => esc_html__('Select alignment for third column', 'Newsgamer'),
                'options' => array(
                'text-left' => 'Left',
                'text-center' => 'Center',
                'text-right' => 'Right',
                ),
                'default' => 'text-left',
                'required'  => array(
                    array('_mp_header_widget_layout', "=", array( 'header-layout-widget-3' )),
                    array('_mp_enable_header_widgets', "equals", '1'),
                ),
            ),

            array(
                'id' => '_mp_header_layout',
                'type' => 'image_select',
                'title' => esc_html__('Header layout', 'Newsgamer'),
                'subtitle' => esc_html__('Select header layout.', 'Newsgamer'),
                'options' => array(
                    'header-layout-1' => array('alt' => 'Header Layout 3', 'img' => get_template_directory_uri(). '/images/redux/header-layout-3.png'),
                    'header-layout-2' => array('alt' => 'Header Layout 1', 'img' => get_template_directory_uri(). '/images/redux/header-layout-1.png'),
                    'header-layout-3' => array('alt' => 'Header Layout 2', 'img' => get_template_directory_uri(). '/images/redux/header-layout-2.png'),
                    'header-layout-6' => array('alt' => 'Header Layout 6', 'img' => get_template_directory_uri(). '/images/redux/header-layout-6.png'),
                    'header-layout-4' => array('alt' => 'Header Layout 4', 'img' => get_template_directory_uri(). '/images/redux/header-layout-4.png'),
                    'header-layout-5' => array('alt' => 'Header Layout 5', 'img' => get_template_directory_uri(). '/images/redux/header-layout-5.png'),
                    'header-layout-7' => array('alt' => 'Header Layout 7', 'img' => get_template_directory_uri(). '/images/redux/header-layout-7.png'),
                    'header-layout-8' => array('alt' => 'Header Layout 8', 'img' => get_template_directory_uri(). '/images/redux/header-layout-8.png'),
                    'header-layout-none' => array('alt' => 'Header Layout None', 'img' => get_template_directory_uri(). '/images/redux/header-layout-none.png'),
                    //'header-layout-7' => array('alt' => 'Header Layout 7', 'img' => get_template_directory_uri(). '/images/redux/header-layout-7.png'),
                ),
                'default' => 'header-layout-3',
                'required'  => array('_mp_enable_header_widgets', "equals", false),
            ),
            array(
                'id' 	=> '_mp_header_banner',
                'type' 	=> 'select',
                'title' => esc_html__('Banner (728x90 or 468x60)', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                'required'  => array('_mp_header_layout', "=", array('header-layout-1', 'header-layout-7', 'header-layout-8')),
            ),
            array(
    			'id' 	=> '_mp_header_banner_left',
    			'type' 	=> 'select',
    			'title' => esc_html__('Banner left', 'Newsgamer'),
    			'data'  => 'posts',
    			'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
    			'required'  => array('_mp_header_layout', "=", array('header-layout-5')),
		    ),

		    array(
    			'id' 	=> '_mp_header_banner_right',
    			'type' 	=> 'select',
    			'title' => esc_html__('Banner right', 'Newsgamer'),
    			'data'  => 'posts',
    			'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
    			'required'  => array('_mp_header_layout', "=", array('header-layout-5')),
		    ),
            array(
                'id' => '_mp_header_height',
                'type' => 'slider',
                'title' => esc_html__('Header Height', 'Newsgamer'),
                'subtitle' => esc_html__('Set header height', 'redux-framework-demo'),
                "default" => 115,
                "min" => 0,
                "step" => 1,
                "max" => 500,
                'display_value' => 'text',
                'required'  => array('_mp_header_layout', "!=", 'header-layout-none'),
            ),
            array(
                'id' => '_mp_header_logo_desktop',
                'type' => 'media',
                'title' => esc_html__('Desktop logo', 'Newsgamer'),
                'subtitle' => esc_html__('Logo for desktop version', 'Newsgamer'),
                'default'  => array(
                    'url'=> get_template_directory_uri() . '/images/logo_head.png',
                    'width'=> 292,
                    'height'=> 57,
                ),
                'required'  => array('_mp_enable_header_widgets', "equals", false),
            ),
            array(
                'id' => '_mp_header_logo_desktop_retina',
                'type' => 'media',
                'title' => esc_html__('Desktop Retina logo', 'Newsgamer'),
                'subtitle' => esc_html__('Retina Logo for desktop version', 'Newsgamer'),
                'required'  => array('_mp_enable_header_widgets', "equals", false),
            ),
            array(
                'id' => '_mp_header_weather_location',
                'type' => 'text',
                'title' => esc_html__('Weather location', 'Newsgamer'),
                'subtitle' => esc_html__('Enter city and contry', 'Newsgamer'),
                'desc' => esc_html__('e.g. Paris, France', 'Newsgamer'),
                'default'  => '',
                'required'  => array('_mp_header_layout', "=", array('header-layout-2', 'header-layout-6', 'header-layout-7') ),
            ),
            array(
                'id' => '_mp_header_weather_temperature',
                'type' => 'button_set',
                'title' => esc_html__('Display temperature in', 'Newsgamer'),
                'options'   => array(
                'c' => 'Celsius',
                'f' => 'Fahrenheit'
                ),
                'default' => 'c',
                'required'  => array('_mp_header_layout', "=", array('header-layout-2', 'header-layout-6', 'header-layout-7') ),
            ),
            array(
                'id' => '_mp_header_weather_show_date',
                'type' => 'switch',
                'title' => esc_html__('Display date', 'Newsgamer'),
                'default' => '1',
                'required'  => array('_mp_header_layout', "=", array('header-layout-2', 'header-layout-6', 'header-layout-7') ),
            ),
            array(
                'id' => '_mp_header_weather_show_desc',
                'type' => 'switch',
                'title' => esc_html__('Display weather description', 'Newsgamer'),
                'default' => '1',
                'required'  => array('_mp_header_layout', "=", array('header-layout-2', 'header-layout-6', 'header-layout-7') ),
            ),
            array(
                'id' => '_mp_header_weather_lang',
                'type' => 'select',
                'title' => esc_html__('Language for description', 'Newsgamer'),
                'options'   => array(
                    'bg' => 'Bulgarian',
                    'zh_tw' => 'Chinese Traditional',
                    'zh_cn' => 'Chinese Simplified',
                    'nl' => 'Dutch',
                    'en' => 'English',
                    'fi' => 'Finnish',
                    'fr' => 'French',
                    'de' => 'German',
                    'it' => 'Italian',
                    'pl' => 'Polish',
                    'pt' => 'Portuguese',
                    'ro' => 'Romanian',
                    'ru' => 'Russian',
                    'sp' => 'Spanish',
                    'se' => 'Swedish',
                    'tr' => 'Turkish',
                    'ua' => 'Ukrainian',
                ),
                'default' => 'en',
                'required'  => array(
                    array('_mp_header_layout', "=", array('header-layout-2', 'header-layout-6', 'header-layout-7') ),
                    array('_mp_header_weather_show_desc', "=", 1 ),
                )
            ),

         )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Social Networking', 'Newsgamer' ),
         'id'               => '_mp_header_settings_social',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id'        => '_mp_social_facebook',
                'type'      => 'text',
                'title'     => esc_html__('Facebook URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_twitter',
                'type'      => 'text',
                'title'     => esc_html__('Twitter URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_google',
                'type'      => 'text',
                'title'     => esc_html__('Google+ URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_linkedin',
                'type'      => 'text',
                'title'     => esc_html__('LinkedIn URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_pinterest',
                'type'      => 'text',
                'title'     => esc_html__('Pinterest URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_flickr',
                'type'      => 'text',
                'title'     => esc_html__('Flickr URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_youtube',
                'type'      => 'text',
                'title'     => esc_html__('Youtube URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_vimeo',
                'type'      => 'text',
                'title'     => esc_html__('Vimeo URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_instagram',
                'type'      => 'text',
                'title'     => esc_html__('Instagram URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_dribbble',
                'type'      => 'text',
                'title'     => esc_html__('Dribbble URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_behance',
                'type'      => 'text',
                'title'     => esc_html__('Behance URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_tumblr',
                'type'      => 'text',
                'title'     => esc_html__('Tumblr URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_reddit',
                'type'      => 'text',
                'title'     => esc_html__('Reddit URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_vkontakte',
                'type'      => 'text',
                'title'     => esc_html__('VKontakte URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_weibo',
                'type'      => 'text',
                'title'     => esc_html__('Weibo URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_wechat',
                'type'      => 'text',
                'title'     => esc_html__('WeChat URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_qq',
                'type'      => 'text',
                'title'     => esc_html__('QQ URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_twitch',
                'type'      => 'text',
                'title'     => esc_html__('Twitch URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_steam',
                'type'      => 'text',
                'title'     => esc_html__('Steam URL', 'Newsgamer'),
            ),
            array(
                'id'        => '_mp_social_rss',
                'type'      => 'text',
                'title'     => esc_html__('RSS URL', 'Newsgamer'),
            ),
         ),
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Top Navigation', 'Newsgamer' ),
         'id'               => '_mp_header_settings_topnav',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id' => '_mpgl_header_topmenu_enable',
                'type' => 'switch',
                'title' => esc_html__('Enable Top Menu', 'Newsgamer'),
                'subtitle' => esc_html__('Enable top navigation', 'Newsgamer'),
                'default' => '0',
                'on' => 'Enable',
                'off' => 'Disable',
            ),
            array(
                'id' => '_mpgl_header_topmenu_type',
                'type' => 'button_set',
                'title' => esc_html__('Top Menu Type', 'Newsgamer'),
                'subtitle' => esc_html__('Type of Top menu to display', 'Newsgamer'),
                'options'   => array(
                    'full' => 'Full width',
                    'container' => 'Boxed'
                ),
                'default' => 'container',
                'required'  => array('_mpgl_header_topmenu_enable', "=", '1'),
            ),
            array(
                'id'       => '_mpgl_header_topmenu_show_options',
                'type'     => 'checkbox',
                'title' => esc_html__('Display login/register', 'Newsgamer'),
                'subtitle' => esc_html__('Display login/register links in top navigation', 'Newsgamer'),
                'options'  => array(
                    'login' => 'Display login',
                    'register' => 'Display register',
                ),
                'default' => array(
                    'login' => '0',
                    'register' => '0',
                ),
                'required'  => array('_mpgl_header_topmenu_enable', "=", '1'),
            ),
            array(
                'id' => '_mpgl_header_topmenu_show_date',
                'type' => 'button_set',
                'title' => esc_html__('Display date', 'Newsgamer'),
                'subtitle' => esc_html__('Do you want to display date in top menu', 'Newsgamer'),
                'options'   => array(
                    'none' => 'No date',
                    'first' => 'On left, before everything',
                    'last' => 'On right, after everything',
                ),
                'default' => 'none',
                'required'  => array('_mpgl_header_topmenu_enable', "=", '1'),
            ),

            array(
                'id' => '_mpgl_header_top_show_social_networking',
                'type' => 'switch',
                'title' => esc_html__('Display social icons', 'Newsgamer'),
                'subtitle' => esc_html__('Display social icons in top navigation (if enabled)', 'Newsgamer'),
                'desc' => esc_html__('This will show links you selected under "Social Networking"', 'Newsgamer'),
                'default' => '0',
                'required'  => array('_mpgl_header_topmenu_enable', "=", '1'),
            ),
         ),
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Main Navigation', 'Newsgamer' ),
         'id'               => '_mp_header_settings_mainnav',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mpgl_header_nav_type',
                 'type' => 'button_set',
                 'title' => esc_html__('Main Navigation Type', 'Newsgamer'),
                 'subtitle' => esc_html__('Type of navigation to display', 'Newsgamer'),
                 'options'   => array(
                     '0' => 'Full width',
                     '2' => 'Full Width Background Only',
                     '1' => 'Boxed',
                 ),
                 'default' => '1',
             ),
             array(
                'id' => '_mpgl_header_nav_logo',
                'type' => 'switch',
                'title' => esc_html__('Enable image/logo in navigation', 'Newsgamer'),
                'default' => '0'
            ),
            array(
                'id' => '_mpgl_header_nav_logo_media',
                'type' => 'media',
                'title' => esc_html__('Navigation menu logo', 'Newsgamer'),
                'subtitle' => esc_html__('Put logo in main navigation', 'Newsgamer'),
                'required'  => array('_mpgl_header_nav_logo', "equals", '1'),
            ),
            array(
                'id' => '_mpgl_header_nav_logo_media_retina',
                'type' => 'media',
                'title' => esc_html__('Navigation menu Retina logo', 'Newsgamer'),
                'subtitle' => esc_html__('Put Retina logo in main navigation', 'Newsgamer'),
                'required'  => array('_mpgl_header_nav_logo', "equals", '1'),
            ),
            array(
               'id' => '_mpgl_header_nav_sticky_menu',
               'type' => 'switch',
               'title' => esc_html__('Sticky menu', 'Newsgamer'),
               'subtitle' => esc_html__('Use navigation as sticky menu', 'Newsgamer'),
               'default' => '0'
           ),
            array(
                'id' => '_mpgl_header_nav_sticky_menu_show_first',
                'type' => 'switch',
                'title' => esc_html__('Hide first item on sticky menu', 'Newsgamer'),
                'subtitle' => esc_html__('Hide first navigation item when used as sticky', 'Newsgamer'),
                'default' => 0,
                'required'  => array('_mpgl_header_nav_sticky_menu', "equals", '1'),
            ),
             array(
                'id' => '_mpgl_header_nav_show_search',
                'type' => 'switch',
                'title' => esc_html__('Display search icon', 'Newsgamer'),
                'subtitle' => esc_html__('Display search icon in main navigation', 'Newsgamer'),
                'desc' => esc_html__('Do not display this if you have long menu', 'Newsgamer'),
                'default' => '0',
            ),
            array(
                'id' => '_mpgl_header_nav_show_social_networking',
                'type' => 'switch',
                'title' => esc_html__('Display social icons', 'Newsgamer'),
                'subtitle' => esc_html__('Display social icons in top navigation (if enabled)', 'Newsgamer'),
                'desc' => esc_html__('This will show links you selected under "Social Networking"', 'Newsgamer'),
                'default' => '0',
            ),
            array(
                'id'       => '_mpgl_header_nav_show_options',
                'type'     => 'checkbox',
                'title' => esc_html__('Display login/register', 'Newsgamer'),
                'subtitle' => esc_html__('Display login/register links in main navigation', 'Newsgamer'),
                'options'  => array(
                    'login' => 'Display login',
                    'register' => 'Display register',
                ),
                'default' => array(
                    'login' => '0',
                    'register' => '0',
                ),
            ),
            array(
                'id' => '_mpgl_header_nav_category_colors',
                'type' => 'switch',
                'title' => esc_html__('Use Category Colors', 'Newsgamer'),
                'subtitle' => esc_html__('Use Category Colors for Main Navigation Styling', 'Newsgamer'),
                'default' => '0',
            ),
         ),
     ) );


     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Mobile Navigation', 'Newsgamer' ),
         'id'               => '_mp_header_settings_mobilenav',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mp_header_logo_mobile',
                 'type' => 'media',
                 'title' => esc_html__('Mobile logo', 'Newsgamer'),
                 'subtitle' => esc_html__('Logo for mobile version', 'Newsgamer'),
                 'default'  => array(
                 'url'=> get_template_directory_uri() . '/images/logo_mobile.png',
                     'width'=> 190,
                     'height'=> 34,
                 ),
                 'required'  => array('_mp_enable_header_widgets', "equals", false),
             ),
             array(
                 'id' => '_mp_header_logo_mobile_retina',
                 'type' => 'media',
                 'title' => esc_html__('Mobile Retina logo', 'Newsgamer'),
                 'subtitle' => esc_html__('Retina Logo for mobile version', 'Newsgamer'),
                 'required'  => array('_mp_enable_header_widgets', "equals", false),
             ),
             array(
                 'id' => '_mpgl_header_sticky_menu_mobile',
                 'type' => 'switch',
                 'title' => esc_html__('Sticky Menu', 'Newsgamer'),
                 'subtitle' => esc_html__('Use navigation as sticky menu', 'Newsgamer'),
                 'default' => '0',
             ),
             array(
                 'id'       => '_mpgl_header_mobilemenu_show_options',
                 'type'     => 'checkbox',
                 'title' => esc_html__('Display login/register', 'Newsgamer'),
                 'subtitle' => esc_html__('Display login/register links in top navigation', 'Newsgamer'),
                 'options'  => array(
                     'login' => 'Display login',
                     'register' => 'Display register',
                 ),
                 'default' => array(
                     'login' => '0',
                     'register' => '0',
                 ),
             ),
             array(
                 'id' => '_mpgl_header_mobilemenu_show_social_networking',
                 'type' => 'switch',
                 'title' => esc_html__('Display social icons', 'Newsgamer'),
                 'subtitle' => esc_html__('Display social icons in top navigation (if enabled)', 'Newsgamer'),
                 'desc' => esc_html__('This will show links you selected under "Social Networking"', 'Newsgamer'),
                 'default' => '0',
             ),
         ),
     ) );


     // -> START Category Settings

     $cats[] = array(
         'id' => '_mpgl_cat_top_grid_enable',
         'type' => 'button_set',
         'title' => esc_html__('Enable Top Grid', 'Newsgamer'),
         'options' => array(
             0 => 'Disable',
             1 => 'Enable',
             2 => 'Shortcode'
          ),
         'default' => 0
     );

     $cats[] = array(
         'id' => '_mpgl_cat_top_grid_shortcode',
         'type' => 'text',
         'title' => esc_html__('Top Grid Shortcode', 'Newsgamer'),
         'required'  => array('_mpgl_cat_top_grid_enable', "equals", 2)
     );

     $cats[] = array(
         'id'        => '_mpgl_cat_top_grid_layout',
         'type'      => 'image_select',
         'title'     => esc_html__('Grid layout', 'Newsgamer'),
         'subtitle'  => esc_html__('Select layout for your grid', 'Newsgamer'),
         'options' => array(
             'top-grid-layout-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-1.png'),
             'top-grid-layout-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-2.png'),
             'top-grid-layout-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-3.png'),
             'top-grid-layout-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-4.png'),
             'top-grid-layout-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-5.png'),
             'top-grid-layout-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-6.png'),
             'top-grid-layout-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-7.png'),
             'top-grid-layout-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-8.png'),
             'top-grid-layout-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-9.png'),
             'top-grid-layout-10' => array('alt' => 'Layout 10', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-10.png'),
             'top-grid-layout-11' => array('alt' => 'Layout 11', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-11.png'),
             'top-grid-layout-12' => array('alt' => 'Layout 12', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-12.png'),
         ),
         'default'   => 'top-grid-layout-1',
         'required'  => array('_mpgl_cat_top_grid_enable', "equals", 1)
     );

     $cats[] = array(
         'id' => '_mpgl_cat_top_grid_verge_style',
         'type' => 'switch',
         'title' => esc_html__('Enable "Verge" styling', 'Newsgamer'),
         'subtitle'  => esc_html__('Colourful backgrounds', 'Newsgamer'),
         'default' => 0,
         'required'  => array('_mpgl_cat_top_grid_enable', "equals", 1)
     );

     $cats[] = array(
         'id'       => '_mpgl_cat_top_grid_postmeta_elements',
         'type'     => 'checkbox',
         'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
         'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
         'options'  => array(
             'date' => 'Post Date',
             'author' => 'Author',
             'category' => 'Categories',
             'comments' => 'Comments',
             'views' => 'Views',
         ),
         'default'  => array(
             'date' => '1',
             'author' => '0',
             'category' => '1',
             'comments' => '1',
             'views' => '0',
         ),
         'required'  => array('_mpgl_cat_top_grid_enable', "equals", 1)
     );

     $cats[] = array(
        'id' => '_mpgl_cat_template',
        'type' => 'image_select',
        'title' => esc_html__('Category Layout', 'Newsgamer'),
        'subtitle' => esc_html__('Select layout for all categories', 'Newsgamer'),
        'options' => array(
            'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
            'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
            'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
            'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
            'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
            'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
            'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
            'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
            'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
            'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
            'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
            'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
        ),
         'default' => 'loop-cat-1'
     );
     $cats[] = array(
         'id'=>'_mpgl_cat_template_chars',
         'type' => 'slider',
         'title' => esc_html__('Limit text characters', 'Newsgamer'),
         "default" => "0",
         "min" 	=> "0",
         "step"	=> "1",
         "max" 	=> "1000",
         'subtitle' => esc_html__('0 - default, set by theme, 1 - no excerpt', 'Newsgamer'),
         'required'  => array('_mpgl_cat_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
     );
     $cats[] = array(
        'id' => '_mpgl_cat_grid_width',
        'type' => 'button_set',
        'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
        'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
        'options'   => array(
            'standard'   => 'Standard',
            'full-width' => 'Full Width'
        ),
        'default' => 'standard',
         'required'  => array('_mpgl_cat_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
    );
    $cats[] = array(
        'id'       => '_mpgl_cat_postmeta_elements',
        'type'     => 'checkbox',
        'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
        'options'  => array(
            'date' => 'Post Date',
            'author' => 'Author',
            'category' => 'Categories',
            'comments' => 'Comments',
            'views' => 'Views',
        ),
        'default'  => array(
            'date' => '1',
            'author' => '0',
            'category' => '1',
            'comments' => '1',
            'views' => '0',
        ),
    );
    $cats[] = array(
        'id' => '_mpgl_cat_sidebar_template',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar position', 'Newsgamer'),
        'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
        'options' => array(
            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
            'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
            ),
        'default' => 'right-sidebar'
    );
    $cats[] = array(
        'id' => '_mpgl_cat_sidebar_source',
        'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
        'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
        'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
        'type' => 'select',
        'data' => 'sidebars',
        'default' => 'None',
        'required'  => array('_mpgl_cat_sidebar_template', "!=", 'hide-sidebar'),
    );

    $cats[] = array(
		'id' => '_mpgl_cat_show_title',
		'type' => 'button_set',
		'title' => esc_html__('Show category title on top', 'Newsgamer'),
		'options'   => array(
		    '0' => 'Don\'t Display Title',
		    '1' => 'Display Title',
		    '2' => 'Display  Image'
		),
		'default' => '0',
	);

    $cats[] = array(
		'id' => '_mpgl_cat_show_title_image',
		'type' => 'media',
		'title' => esc_html__('Category image', 'Newsgamer'),
		'required'  => array('_mpgl_cat_show_title', "=", '2'),
	);

    $cats[] = array(
        'id'=>'_mpgl_cat_posts_number',
        'type' => 'slider',
        'title' => esc_html__('Posts per page', 'Newsgamer'),
        "default" => "0",
        "min" 	=> "0",
        "step"	=> "1",
        "max" 	=> "50",
        'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
    );
    $cats[] = array(
        'id' => '_mpgl_cat_pagination',
        'type' => 'button_set',
        'title' => esc_html__('Pagination template', 'Newsgamer'),
        'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
        'options'   => array(
            'post-pagination-1' => 'Pager with numbers',
            'post-pagination-2' => 'Prev/next pager'
        ),
        'default' => 'post-pagination-1',
    );

    /* ads for categories */
    $banner_cats[] = array(
    	'id'   => 'info_ads_cat_normal',
    	'type' => 'info',
    	'style' => 'success',
    	//'notice' => true,
    	'icon'      => 'el-icon-info-sign',
    	'title' => 'Default settings',
    	'desc' => esc_html__('This are default setting for all categories. If you want to override this, please select custom settings for desired category below.', 'Newsgamer')
    );

    $banner_cats[] = array(
    	'id' 	=> '_mp_ads_cat_top',
    	'type' 	=> 'select',
    	'title' => esc_html__('Top banner', 'Newsgamer'),
    	'data'  => 'posts',
    	'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
    );

    $banner_cats[] = array(
    	'id' 	=> '_mp_ads_cat_bottom',
    	'type' 	=> 'select',
    	'title' => esc_html__('Bottom banner', 'Newsgamer'),
    	'data'  => 'posts',
    	'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
    );

    $banner_cats[] = array(
    	'id' 	=> '_mp_ads_cat_wall',
    	'type' 	=> 'select',
    	'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
    	'data'  => 'posts',
    	'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
    );

    $banner_cats[] = array(
    	'id' 	=> '_mp_ads_cat_layout_banner',
    	'type' 	=> 'select',
    	'title' => esc_html__('Banner in Layout', 'Newsgamer'),
    	'subtitle' => esc_html__('Do you want to divide layout with an ad?', 'Newsgamer'),
    	'data'  => 'posts',
    	'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
    );

    $banner_cats[] = array(
    	'id' => '_mp_ads_cat_layout_banner_count',
    	'type' => 'slider',
    	'title' => esc_html__('Show banner after row:', 'Newsgamer'),
    	"default" => "0",
    	"min" 	=> "0",
    	"step"	=> "1",
    	"max" 	=> "10",
    	'desc' => esc_html__('0 for showing banner on top of category', 'Newsgamer'),
    	'required'  => array('_mp_ads_cat_layout_banner', "not", ''),
    );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Category Settings', 'Newsgamer' ),
        'id'               => '_mp_category_settings',
        'customizer_width' => '400px',
        'icon'             => 'el el-icon-folder-open',
        'fields'           => $cats
    ) );

    $subcats[]          = array();
    $cats[]             = array();
    $banner_cats[]      = array();
    $categories		    = 0;
    $category_args	    = array();
    $category_notice	= '';
    $categories_all 	= get_categories();
    $categories_parent 	= get_categories( array('parent' => 0) );

    if($categories_all && (count($categories_all) < 50)){
	    $categories	   = $categories_all;
    } else if($categories_parent && (count($categories_parent) < 50)){
    	$categories	       = $categories_parent;
    	$category_args	   = array('parent' => 0);
    	$category_notice   = ' (Only root categories because you have more than 50 categories in database)';
    }

    // Limit to 50 categories
    if($categories && (count($categories) < 50)) {

        /*$cats[] = array(
		    'id'   => '_mpgl_cat_info_selection',
		    'type'     => 'info',
		    'desc' => 'Custom settings for categories' . $category_notice,
		);*/

		$subcats[] = array(
		    'id'   => '_mpgl_cat_selection',
		    'title' => esc_html__( 'Select Category', 'Newsgamer' ),
		    'type'     => 'select',
		    'data'     => 'categories',
            'args'     => $category_args,
		);

		$banner_cats[] = array(
		    'id'   => '_mpgl_cat_ads_info_selection',
		    'type' => 'info',
		    'notice' => true,
		    'style' => 'success',
		    'title' => esc_html__('Custom settings for top categories', 'Newsgamer'),
		);

		$banner_cats[] = array(
		    'id'   => '_mp_ads_cat_selection',
		    'title' => esc_html__( 'Select Category', 'Newsgamer' ),
		    'type'     => 'select',
		    'data'     => 'categories',
            'args'     => $category_args,
		);

        // Loop trought selected categories
        foreach($categories as $category) {

            $subcats[] = array(
                'id'        => '_mp_cat_'. $category->term_id .'_section_start',
                'type'      => 'section',
	            'title'      => $category->name,
                'indent'    => true, // Indent all options below until the next 'section' option is set.
                'required'  => array('_mpgl_cat_selection', "=", $category->term_id),
            );

            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_template',
                'type' => 'image_select',
                'title' => esc_html__('Category Layout', 'Newsgamer'),
                //'subtitle' => esc_html__('Select layout for all categories', 'Newsgamer'),
                'options' => array(
                    'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                    'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                    'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                    'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                    'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                    'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                    'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                    'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                    'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                    'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                    'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                    'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                ),
                //'default' => 'loop-cat-1'
            );
            $subcats[] = array(
                'id'=>'_mpgl_cat_'. $category->term_id .'_template_chars',
                'type' => 'slider',
                'title' => esc_html__('Limit text characters', 'Newsgamer'),
                //"default" => "0",
                "min" 	=> "0",
                "step"	=> "1",
                "max" 	=> "1000",
                'subtitle' => esc_html__('0 - default, set by theme, 1 - no excerpt (enter manually)', 'Newsgamer'),
                'required'  => array('_mpgl_cat_'. $category->term_id .'_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
            );
            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_grid_width',
                'type' => 'button_set',
                'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
                'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
                'options'   => array(
                    'standard'   => 'Standard',
                    'full-width' => 'Full Width'
                ),
                'required'  => array('_mpgl_cat_'. $category->term_id .'_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
            );
            $subcats[] = array(
                'id'       => '_mpgl_cat_'. $category->term_id .'_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
            );
            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                //'default' => 'right-sidebar'
            );
            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_cat_'. $category->term_id .'_sidebar_template', "!=", 'hide-sidebar'),
            );
            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_show_title',
                'type' => 'button_set',
                'title' => esc_html__('Show category title on top', 'Newsgamer'),
                'options'   => array(
                    '0' => 'Don\'t Display Title',
                    '1' => 'Display Title',
                    '2' => 'Display  Image'
                ),
                //'default' => '0',
            );
            $subcats[] = array(
        		'id' => '_mpgl_cat_'. $category->term_id .'_show_title_image',
        		'type' => 'media',
        		'title' => esc_html__('Category image', 'Newsgamer'),
        		'required'  => array('_mpgl_cat_'. $category->term_id .'_show_title', "=", '2'),
        	);
            $subcats[] = array(
                'id'=>'_mpgl_cat_'. $category->term_id .'_posts_number',
                'type' => 'slider',
                'title' => esc_html__('Posts per page', 'Newsgamer'),
                "default" => "0",
                "min" 	=> "0",
                "step"	=> "1",
                "max" 	=> "50",
                'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
            );
            $subcats[] = array(
                'id' => '_mpgl_cat_'. $category->term_id .'_pagination',
                'type' => 'button_set',
                'title' => esc_html__('Pagination template', 'Newsgamer'),
                'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
                'options'   => array(
                    'post-pagination-1' => 'Pager with numbers',
                    'post-pagination-2' => 'Prev/next pager'
                ),
                //'default' => 'post-pagination-1',
            );

            $subcats[] = array(
    			'id' => '_mpgl_cat_'. $category->term_id .'_set_for_children',
    			'type' => 'switch',
    			'title' => esc_html__('Use this setting for child categories', 'Newsgamer')
		    );

            $subcats[] = array(
                'id'        => '_mpgl_cat_'. $category->term_id .'_section_end',
                'type'      => 'section',
                'indent'    => false, // Indent all options below until the next 'section' option is set.
                'required'  => array('_mp_cat_selection', "=", $category->term_id),
            );


            $banner_cats[] = array(
                'id'        => '_mp_ads_cat_'. $category->term_id .'_section_start',
                'title'      => $category->name,
                'type'      => 'section',
                'indent'    => true, // Indent all options below until the next 'section' option is set.
                'required'  => array('_mp_ads_cat_selection', "=", $category->term_id),
            );

		    $banner_cats[] = array(
    			'id' 	=> '_mp_ads_cat_'. $category->term_id .'_top',
    			'type' 	=> 'select',
    			'title' => esc_html__('Top banner', 'Newsgamer'),
    			'data'  => 'posts',
    			'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
		    );

            $banner_cats[] = array(
    			'id' 	=> '_mp_ads_cat_'. $category->term_id .'_bottom',
    			'type' 	=> 'select',
    			'title' => esc_html__('Bottom banner', 'Newsgamer'),
    			'data'  => 'posts',
    			'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
		    );

		    $banner_cats[] = array(
                'id' 	=> '_mp_ads_cat_'. $category->term_id .'_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            );


		    $banner_cats[] = array(
    			'id' 	=> '_mp_ads_cat_'. $category->term_id .'_layout_banner',
    			'type' 	=> 'select',
    			'title' => esc_html__('Banner in Layout', 'Newsgamer'),
    			'data'  => 'posts',
    			'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
		    );

		    $banner_cats[] = array(
    			'id' => '_mp_ads_cat_'. $category->term_id .'_layout_banner_count',
    			'type' => 'slider',
    			'title' => esc_html__('Show banner after row:', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "10",
    			'desc' => esc_html__('0 for showing banner on top of category', 'Newsgamer'),
    			'required'  => array('_mp_ads_cat_'. $category->term_id .'_layout_banner', "not", ''),
		    );


		    $banner_cats[] = array(
                'id'        => '_mp_ads_cat_'. $category->term_id .'_section_end',
                'type'      => 'section',
                'indent'    => false, // Indent all options below until the next 'section' option is set.
                'required'  => array('_mp_ads_cat_selection', "=", $category->term_id),
            );


        }

        Redux::setSection( $opt_name, array(
            'title'            => esc_html__( 'Customize Categories', 'Newsgamer' ),
            'id'               => '_mp_subcategory_settings',
            'customizer_width' => '450px',
            'subsection'       => true,
            'fields'           => $subcats
        ) );

    }


     // -> START Posts Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Posts Settings', 'Newsgamer' ),
         'id'               => '_mp_posts_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-icon-file-edit',
         'fields'           => array(
             array(
                 'id' => '_mpgl_post_layout',
                 'type' => 'image_select',
                 'title' => esc_html__('Post Layout', 'Newsgamer'),
                 'options' => array(
                     'loop-page-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/page-layout-1.png'),
                     'loop-page-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/page-layout-2.png'),
                     'loop-page-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/page-layout-3.png'),
                     'loop-page-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/page-layout-4.png'),
                     'loop-page-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/page-layout-5.png'),
                     'loop-page-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/page-layout-6.png'),
                     'loop-page-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/page-layout-7.png'),
                     'loop-page-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/page-layout-8.png'),
                     'loop-page-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/page-layout-9.png'),
                 ),
                 'default' => 'loop-page-2'
             ),
             array(
                'id'        => '_mpgl_post_layout_image_parallax_height',
                'type'      => 'slider',
                'title'     => __('Image Height', 'Newsgamer'),
                'subtitle'  => __('Select percentage of the screen.', 'Newsgamer'),
                "default"   => 60,
                "min"       => 10,
                "step"      => 1,
                "max"       => 100,
                'display_value' => 'input',
                'required'  => array (
      			    array('_mpgl_post_layout', "=", array('loop-page-5', 'loop-page-6', 'loop-page-7') ),
      			)
             ),
             array(
      			'id' => '_mpgl_post_layout_image_format',
      			'type' => 'select',
      			'title' => esc_html__('Image size', 'Newsgamer'),
      			'subtitle' => esc_html__('Set dimensions via "Settings > Media"', 'Newsgamer'),
                'options'  => array(
                    'thumbnail' => 'Thumbnail size',
                    'medium' => 'Medium size',
                    'large' => 'Large size'
                ),
                'default'  => 'medium',
      			'required'  => array (
      			    array('_mpgl_post_layout', "=", array('loop-page-8', 'loop-page-9') ),
      			)
	        ),
             array(
      			'id' => '_mpgl_post_layout_image_height',
      			'type' => 'switch',
      			'title' => esc_html__('Show full image height', 'Newsgamer'),
      			'subtitle' => esc_html__('Fit only horizontally', 'Newsgamer'),
      			'default' => 0,
      			'required'  => array (
      			    array('_mpgl_post_layout', "=", array('loop-page-2', 'loop-page-3', 'loop-page-4') ),
      			)
	        ),
            array(
               'id' => '_mpgl_post_layout_review_poster',
               'type' => 'media',
               'title' => esc_html__('Review Poster', 'Newsgamer'),
               'subtitle' => esc_html__('Upload default poster for this layout', 'Newsgamer'),
               'description' => esc_html__('The image will be scaled to 310px in width', 'Newsgamer'),
               'required'  => array (
                   array('_mpgl_post_layout', "=", array('loop-page-7') ),
               )
            ),
            array(
                'id' => '_mpgl_post_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'id' => '_mpgl_post_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_post_sidebar_template', "!=", 'hide-sidebar'),
            ),
            array(
                'id' => '_mpgl_post_display_author_postmeta',
                'type' => 'switch',
                'title' => esc_html__('Display Author Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('Display description and social links in left column', 'Newsgamer'),
                'default' => '0',
                'required'  => array('_mpgl_post_layout', "equals", 'loop-page-7'),
            ),
            array(
                'id' => '_mpgl_post_enable_post_info_bar',
                'type' => 'switch',
                'title' => esc_html__('Enable Post Info Bar', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '0',
            ),
            array(
                'id' => '_mpgl_post_enable_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Enable Breadcrumbs', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),
            array(
                'id' => '_mpgl_post_enable_postmeta',
                'type' => 'switch',
                'title' => esc_html__('Enable Post Meta after Title', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),
            array(
                'id'       => '_mpgl_post_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'categories' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '1',
                    'categories' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
                'required'  => array('_mpgl_post_enable_postmeta', "=", '1'),
            ),
            array(
                'id' => '_mpgl_post_enable_tags',
                'type' => 'switch',
                'title' => esc_html__('Enable Tags after Content', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),
            array(
                'id' => '_mpgl_post_enable_author',
                'type' => 'switch',
                'title' => esc_html__('Enable Author Information', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),
            array(
                'id' => '_mpgl_post_enable_prevnext',
                'type' => 'switch',
                'title' => esc_html__('Enable Prev/Next Posts', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),

         )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Related posts', 'Newsgamer' ),
         'id'               => '_mp_posts_related_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id'        => 'related-notice-info-1',
                'type'  => 'info',
                'style' => 'success',
                'title'     => esc_html__('Related posts box at the bottom', 'Newsgamer'),
                'desc'      => esc_html__('This box will be displayed at bottom of the post, after author box (if selected).', 'Newsgamer')
            ),
            array(
                'id' => '_mp_enable_related_posts',
                'type' => 'switch',
                'title' => esc_html__('Display related posts', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => 1,
            ),
            array(
                'id'        => '_mp_filter_related_posts',
                'type'      => 'button_set',
                'title'     => esc_html__('Filter related posts by', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                'options'   => array(
                    'cat' => 'Category',
                    'tag' => 'Tag'
                ),
                'default'   => 'cat',
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id'        => '_mp_filter_related_posts_grid',
                'type'      => 'button_set',
                'title'     => esc_html__('Display Grid', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                'options'   => array(
                    'standard' => 'Standard',
                    'full-width' => 'Full Width'
                ),
                'default'   => 'standard',
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id' => '_mp_related_posts_title',
                'type' => 'text',
                'title' => esc_html__('Title for related posts', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"Related Posts"</i>', 'Newsgamer'),
                'default'   => esc_html__('Related Posts', 'Newsgamer'),
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id'=>'_mp_related_posts_count',
                'type' => 'slider',
                'title' => esc_html__('Posts Count', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"3"</i>', 'Newsgamer'),
                "default" => "3",
                "min" 	=> "3",
                "step"	=> "3",
                "max" 	=> "30",
                'desc' => esc_html__('Number of related posts to display', 'Newsgamer'),
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id' => '_mp_related_posts_offset',
                'type' => 'text',
                'title' => esc_html__('Posts offset', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"0"</i> (No offset)', 'Newsgamer'),
                'desc' => esc_html__('Number of post to displace or pass over', 'Newsgamer'),
                'default'   => 0,
                'validate'  => 'numeric',
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id'        => '_mp_related_posts_sort',
                'type'      => 'select',
                'title'     => esc_html__('Sort order', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                'options'   => array(
                    'date' => 'Latest',
                    'rand' => 'Random posts',
                    'name' => 'By name',
                    'modified' => 'Last Modified',
                    'comment_count' => 'Most Commented',
                    'meta_value_num' => 'Most Viewed',
                ),
                'default'   => 'date',
                'required'  => array('_mp_enable_related_posts', "=", '1'),
            ),
            array(
                'id'        => 'related-notice-info-2',
                'type'  => 'info',
                'style' => 'warning',
                'title'     => esc_html__('Related posts box on the side', 'Newsgamer'),
                'desc'      => esc_html__('This box will be displayed after post title.', 'Newsgamer')
            ),
            array(
                'id' => '_mp_enable_related_box',
                'type' => 'switch',
                'title' => esc_html__('Display related box', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => 0,
            ),
            array(
                'id'        => '_mp_enable_related_box_count',
                'type'      => 'button_set',
                'title'     => esc_html__('Number of sections', 'Newsgamer'),
                'subtitle'  => esc_html__('Number of sections in related box', 'Newsgamer'),
                'desc'  => esc_html__('How many sections you want to have in related box', 'Newsgamer'),
                'options'   => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
                'default'   => '1',
                'required'  => array('_mp_enable_related_box', "=", '1'),
            ),
            array(
                'id'        => '_mp_enable_related_box_float',
                'type'      => 'button_set',
                'title'     => esc_html__('Show box on', 'Newsgamer'),
                'subtitle'  => esc_html__('Where to display related box', 'Newsgamer'),
                'options'   => array(
                    'pull-left' => 'On left side',
                    'pull-right' => 'On right side',
                ),
                'default'   => 'pull-right',
                'required'  => array('_mp_enable_related_box', "=", '1'),
            ),

            // First section
            array(
                'id'        => 'related-box-info-1',
                'type'  => 'info',
                'title'     => esc_html__('First section data', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_title_1',
                'type' => 'text',
                'title' => esc_html__('Section title', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_format_1',
                'type'      => 'checkbox',
                'title'     => esc_html__('Section format', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                'options'   => array(
                    'image' => 'Image',
                    'date' => 'Date'
                ),
                'default'   => 'related-box-3',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_filter_1',
                'type'      => 'button_set',
                'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                'options'   => array(
                    'cat' => 'Category',
                    'tag' => 'Tag'
                ),
                'default'   => 'cat',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_count_1',
                'type' => 'text',
                'title' => esc_html__('Posts count', 'Newsgamer'),
                'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                'default'   => 3,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", 'enable'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_offset_1',
                'type' => 'text',
                'title' => esc_html__('Posts offset', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"0"</i> (No offset)', 'Newsgamer'),
                'desc' => esc_html__('Number of post to displace or pass over', 'Newsgamer'),
                'default'   => 0,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_sort_1',
                'type'      => 'select',
                'title'     => esc_html__('Sort order', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                'options'   => array(
                    'date' => 'Latest',
                    'rand' => 'Random posts',
                    'name' => 'By name',
                    'modified' => 'Last Modified',
                    'comment_count' => 'Most Commented',
                ),
                'default'   => 'date',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '1', '2', '3' )),
                )
            ),

            // Second section
            array(
                'id'        => 'related-box-info-2',
                'type'  => 'info',
                'title'     => esc_html__('Second section data', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", 'enable'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_title_2',
                'type' => 'text',
                'title' => esc_html__('Second Section title', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", 'enable'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_format_2',
                'type'      => 'checkbox',
                'title'     => esc_html__('Section format', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                'options'   => array(
                    'image' => 'Image',
                    'date' => 'Date'
                ),
                'default'   => 'related-box-3',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_filter_2',
                'type'      => 'button_set',
                'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                'options'   => array(
                    'cat' => 'Category',
                    'tag' => 'Tag'
                ),
                'default'   => 'cat',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_count_2',
                'type' => 'text',
                'title' => esc_html__('Posts count', 'Newsgamer'),
                'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                'default'   => 3,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_offset_2',
                'type' => 'text',
                'title' => esc_html__('Posts offset', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"0"</i> (No offset)', 'Newsgamer'),
                'desc' => esc_html__('Number of post to displace or pass over', 'Newsgamer'),
                'default'   => 0,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_sort_2',
                'type'      => 'select',
                'title'     => esc_html__('Sort order', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                'options'   => array(
                    'date' => 'Latest',
                    'rand' => 'Random posts',
                    'name' => 'By name',
                    'modified' => 'Last Modified',
                    'comment_count' => 'Most Commented',
                ),
                'default'   => 'date',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", array( '2', '3' )),
                )
            ),

            // Third section
            array(
                'id'        => 'related-box-info-3',
                'type'  => 'info',
                'title'     => esc_html__('Third section data', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_title_3',
                'type' => 'text',
                'title' => esc_html__('Third Section title', 'Newsgamer'),
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_format_3',
                'type'      => 'checkbox',
                'title'     => esc_html__('Section format', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                'options'   => array(
                    'image' => 'Image',
                    'date' => 'Date'
                ),
                'default'   => 'related-box-3',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_filter_3',
                'type'      => 'button_set',
                'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                'options'   => array(
                    'cat' => 'Category',
                    'tag' => 'Tag'
                ),
                'default'   => 'cat',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_count_3',
                'type' => 'text',
                'title' => esc_html__('Posts count', 'Newsgamer'),
                'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                'default'   => 3,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3'),
                )
            ),
            array(
                'id' => '_mp_enable_related_box_offset_3',
                'type' => 'text',
                'title' => esc_html__('Posts offset', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>"0"</i> (No offset)', 'Newsgamer'),
                'desc' => esc_html__('Number of post to displace or pass over', 'Newsgamer'),
                'default'   => 0,
                'validate'  => 'numeric',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
            array(
                'id'        => '_mp_enable_related_box_sort_3',
                'type'      => 'select',
                'title'     => esc_html__('Sort order', 'Newsgamer'),
                'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                'options'   => array(
                    'date' => 'Latest',
                    'rand' => 'Random posts',
                    'name' => 'By name',
                    'modified' => 'Last Modified',
                    'comment_count' => 'Most Commented',
                ),
                'default'   => 'date',
                'required'  => array (
                    array('_mp_enable_related_box', "=", '1'),
                    array('_mp_enable_related_box_count', "=", '3' ),
                )
            ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Review posts', 'Newsgamer' ),
         'id'               => '_mp_posts_review_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id' => '_mp_review_post_position_global',
                'type' => 'button_set',
                'title' => esc_html__('Review box position', 'Newsgamer'),
                'desc' => esc_html__('If you are using custom position then please use <strong>[review]</strong> shortcode to place the review box in any place within post content', 'Newsgamer'),
                'options'   => array(
                    'top' => 'Top of the post',
                    'bottom' => 'Bottom of the post',
                    'custom' => 'Custom position'
                ),
                'default' => 'bottom',
            ),
            array(
                'id'        => '_mp_review_post_style_global',
                'type'      => 'button_set',
                'title'     => esc_html__('Review style', 'Newsgamer'),
                'options'   => array(
                    'percentage' => 'Percentage',
                    'points' => 'Points',
                ),
                'default' => 'percentage',
            ),

            array(
                'id'        => '_mp_review_post_summary_type_global',
                'type'      => 'button_set',
                'title'     => esc_html__('Review summary type', 'Newsgamer'),
                'subtitle'  => esc_html__('How to display review summary', 'Newsgamer'),
                'options'   => array(
                    'summ' => 'Summary box',
                    'good-bad' => 'The Good / The Bad boxes',
                ),
                'default' => 'summary',
            ),

            array(
                'id'        => '_mp_review_post_criteria_count_global',
                'type'      => 'button_set',
                'title'     => esc_html__('Number of criterias', 'Newsgamer'),
                'subtitle'  => esc_html__('Size of a review', 'Newsgamer'),
                'desc'  => esc_html__('How many criteria fields you want to have. Selecting 0 will display only result.', 'Newsgamer'),
                'options'   => array(
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ),
                'default' => '0',
            ),

            array(
                'id'            => '_mp_review_post_criteria_1_global',
                'type'          => 'text',
                'title'         => esc_html__('#1 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('1', '2', '3', '4', '5', '6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_2_global',
                'type'          => 'text',
                'title'         => esc_html__('#2 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('2', '3', '4', '5', '6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_3_global',
                'type'          => 'text',
                'title'         => esc_html__('#3 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('3', '4', '5', '6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_4_global',
                'type'          => 'text',
                'title'         => esc_html__('#4 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('4', '5', '6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_5_global',
                'type'          => 'text',
                'title'         => esc_html__('#5 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('5', '6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_6_global',
                'type'          => 'text',
                'title'         => esc_html__('#6 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('6', '7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_7_global',
                'type'          => 'text',
                'title'         => esc_html__('#7 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('7', '8') ),
                )
            ),

            array(
                'id'            => '_mp_review_post_criteria_8_global',
                'type'          => 'text',
                'title'         => esc_html__('#8 - Criteria name', 'Newsgamer'),
                'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                'required'  => array (
                    array('_mp_review_post_criteria_count_global', "=", array('8') ),
                )
            ),

            array(
                'id' => '_mp_review_post_enable_user_review_global',
                'type' => 'switch',
                'title' => esc_html__('Enable User Review', 'Newsgamer'),
                'subtitle' => esc_html__('This will enable user reviews', 'Newsgamer'),
                'default'  => 0,
            ),

            array(
                'id' => '_mp_review_post_enable_user_review_role_global',
                'type' => 'button_set',
                'title' => esc_html__('Who can add the review?', 'Newsgamer'),
                'subtitle' => esc_html__('Select roles for this action', 'Newsgamer'),
                'options'   => array(
                    'users' => 'Registered Users',
                    'guests' => 'Guests',
                    'both' => 'Both',
                ),
                'default' => 'users',
                'required'  => array (
                    array('_mp_review_post_enable_user_review_global', "=", 1 ),
                )
            ),

            /*array(
                'id'       => '_mp_review_post_progress_background',
                'type'     => 'background',
                'title'    => esc_html__('Background color for progress bar', 'Newsgamer'),
                'default'  => array(
                    'background-color' => '#f5f5f5',
                ),
                'compiler'    => array('.article-post .progress'),
                'background-repeat' => false,
                'background-attachment' => false,
                'background-position' => false,
                'background-image' => false,
                'background-clip' => false,
                'background-origin' => false,
                'background-size' => false,
                'background-repeat' => false,
                'preview_media' => false,
                'preview' => false,
            ),
            array(
                'id'   => '_mp_info_review',
                'type' => 'info',
                'style' => 'success',
                //'notice' => true,
                'icon'      => 'el-icon-info-sign',
                'title' => 'Block Review Settings',
                'desc' => esc_html__('These are default settings for <strong>Block Review Template</strong> under Visual Composer', 'Newsgamer')
            ),
            array(
                'id'       => '_mp_review_block_vc_background',
                'type'     => 'background',
                'title'    => esc_html__('Background color', 'Newsgamer'),
                'default'  => array(
                    'background-color' => '#444444',
                ),
                'compiler'    => array('.cat-reviews'),
                'background-repeat' => false,
                'background-attachment' => false,
                'background-position' => false,
                'background-image' => false,
                'background-clip' => false,
                'background-origin' => false,
                'background-size' => false,
                'background-repeat' => false,
                'preview_media' => false,
                'preview' => false,
            ),
            array(
                'id'       => '_mp_review_block_vc_font-color',
                'type'     => 'color',
                'title'    => esc_html__('Font color', 'Newsgamer'),
                'default'  => '#fff',
                'compiler'    => array('.cat-reviews article a h3'),
            )*/
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Social Sharing', 'Newsgamer' ),
         'id'               => '_mp_posts_social_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id' => '_mp_show_social_sharing',
                'type' => 'button_set',
                'title' => esc_html__('Display social sharing buttons', 'Newsgamer'),
                'subtitle' => esc_html__('Where to display buttons', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display buttons',
                    'bottom' => 'Bottom of the post',
                    'top' => 'Top of the post',
                    'both' => 'Top and bottom'
                ),
                'default' => 'bottom',
            ),
            array(
                'id' => '_mp_social_sharing_title',
                'type' => 'text',
                'title' => esc_html__('Title Social Sharing', 'Newsgamer'),
                'subtitle' => esc_html__('Default: <i>""</i>', 'Newsgamer'),
                'default'   => '',
                'required'  => array('_mp_show_social_sharing', "!=", 'none'),
            ),
            array(
                'id' => '_mp_social_sharing_theme',
                'type' => 'image_select',
                'title' => esc_html__('Social Sharing Styles', 'Newsgamer'),
                'subtitle' => esc_html__('Select theme for buttons.', 'Newsgamer'),
                'options' => array(
                    'default' => array('alt' => 'Default', 'img' => get_template_directory_uri(). '/images/redux/socmedia_layout_1.png'),
                    'soc-style-two' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/socmedia_layout_2.png'),
                    'soc-style-three' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/socmedia_layout_3.png'),
                ),
                'default' => 'default',
                'required'  => array('_mp_show_social_sharing', "!=", 'none'),
            ),
            array(
                'id' => '_mp_social_sharing_facebook',
                'type' => 'button_set',
                'title' => esc_html__('Display Facebook button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display Facebook button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                    'btn-icon-title btn-icon-counter' => 'Icon & Counter'
                ),
                'default' => 'btn-icon-title',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_twitter',
                'type' => 'button_set',
                'title' => esc_html__('Display Twitter button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display Twitter button', 'Newsgamer'),
                    'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                    'btn-icon-title btn-icon-counter' => 'Icon & Counter'
                ),
                'default' => 'btn-icon-title',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_google',
                'type' => 'button_set',
                'title' => esc_html__('Display Google button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display Google button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                    //'btn-icon-title btn-icon-counter' => 'Icon & Counter'
                ),
                'default' => 'btn-icon-title',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_linkedin',
                'type' => 'button_set',
                'title' => esc_html__('Display LinkedIn button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display LinkedIn button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                    'btn-icon-title btn-icon-counter' => 'Icon & Counter'
                ),
                'default' => 'btn-icon-title',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_pinterest',
                'type' => 'button_set',
                'title' => esc_html__('Display Pinterest button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display Pinterest button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                ),
                'default' => 'btn-icon-title',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_tumblr',
                'type' => 'button_set',
                'title' => esc_html__('Display Tumblr button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display Tumblr button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                ),
                'default' => 'none',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_vk',
                'type' => 'button_set',
                'title' => esc_html__('Display VKontakte button', 'Newsgamer'),
                'subtitle' => esc_html__('How to display VKontakte button', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Only Icon',
                    'btn-icon-title' => 'Icon & Title',
                ),
                'default' => 'none',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),

            array(
                'id' => '_mp_social_sharing_whatsapp',
                'type' => 'button_set',
                'title' => esc_html__('Display WhatsApp button', 'Newsgamer'),
                'subtitle' => esc_html__('This will be enabled only on mobile devices', 'Newsgamer'),
                'options'   => array(
                    'none' => 'Don\'t display button',
                    'btn-icon' => 'Display button',
                ),
                'default' => 'none',
                'required'  => array(
                    array('_mp_show_social_sharing', "!=", 'none'),
                )
            ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Comments Settings', 'Newsgamer' ),
         'id'               => '_mp_posts_comments_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
            array(
                'id' => '_mp_post_comments_location',
                'type' => 'select',
                'title' => esc_html__('Comments Location', 'Newsgamer'),
                'subtitle' => esc_html__('Where to display comments?', 'Newsgamer'),
                'options'   => array(
                    'after-related' => 'After Related Posts',
                    'before-author' => 'Before Author Box',
                    'after-author' => 'After Author Box',
                ),
                'default'  => 'after-related',
            ),
            array(
                'id' => '_mp_post_facebook_comments_enable',
                'type' => 'switch',
                'title' => esc_html__('Show Facebook Comments', 'Newsgamer'),
                'subtitle' => esc_html__('This will disable standard comments', 'Newsgamer'),
                'default'  => 0,
            ),
            array(
                'id'=>'_mp_post_facebook_comments_number',
                'type' => 'slider',
                'title' => esc_html__('Number of Comments', 'Newsgamer'),
                "default" => "5",
                "min" 	=> "1",
                "step"	=> "1",
                "max" 	=> "100",
                'desc' => esc_html__('The number of comments to show by default.', 'Newsgamer'),
                'required'  => array('_mp_post_facebook_comments_enable', "equals", 1),
            ),

            array(
                'id' => '_mp_social_facebook_local',
                'type' => 'select',
                'title' => esc_html__('Facebook localization', 'Newsgamer'),
                'subtitle' => esc_html__('Open Graph internationalization', 'Newsgamer'),
                'options'   => array(
                    'af_ZA' => 'Afrikaans (af_ZA)',
                    'ak_GH' => 'Akan (ak_GH)',
                    'am_ET' => 'Amharic (am_ET)',
                    'ar_AR' => 'Arabic (ar_AR)',
                    'as_IN' => 'Assamese (as_IN)',
                    'ay_BO' => 'Aymara (ay_BO)',
                    'az_AZ' => 'Azerbaijani (az_AZ)',
                    'be_BY' => 'Belarusian (be_BY)',
                    'bg_BG' => 'Bulgarian (bg_BG)',
                    'bn_IN' => 'Bengali (bn_IN)',
                    'br_FR' => 'Breton (br_FR)',
                    'bs_BA' => 'Bosnian (bs_BA)',
                    'ca_ES' => 'Catalan (ca_ES)',
                    'cb_IQ' => 'Sorani Kurdish (cb_IQ)',
                    'ck_US' => 'Cherokee (ck_US)',
                    'co_FR' => 'Corsican (co_FR)',
                    'cs_CZ' => 'Czech (cs_CZ)',
                    'cx_PH' => 'Cebuano (cx_PH)',
                    'cy_GB' => 'Welsh (cy_GB)',
                    'da_DK' => 'Danish (da_DK)',
                    'de_DE' => 'German (de_DE)',
                    'el_GR' => 'Greek (el_GR)',
                    'en_GB' => 'English (UK) (en_GB)',
                    'en_IN' => 'English (India) (en_IN)',
                    'en_PI' => 'English (Pirate) (en_PI)',
                    'en_UD' => 'English (Upside Down) (en_UD)',
                    'en_US' => 'English (US) (en_US)',
                    'eo_EO' => 'Esperanto (eo_EO)',
                    'es_CO' => 'Spanish (Colombia) (es_CO)',
                    'es_ES' => 'Spanish (Spain) (es_ES)',
                    'es_LA' => 'Spanish (es_LA)',
                    'et_EE' => 'Estonian (et_EE)',
                    'eu_ES' => 'Basque (eu_ES)',
                    'fa_IR' => 'Persian (fa_IR)',
                    'fb_LT' => 'Leet Speak (fb_LT)',
                    'ff_NG' => 'Fulah (ff_NG)',
                    'fi_FI' => 'Finnish (fi_FI)',
                    'fo_FO' => 'Faroese (fo_FO)',
                    'fr_CA' => 'French (Canada) (fr_CA)',
                    'fr_FR' => 'French (France) (fr_FR)',
                    'fy_NL' => 'Frisian (fy_NL)',
                    'ga_IE' => 'Irish (ga_IE)',
                    'gl_ES' => 'Galician (gl_ES)',
                    'gn_PY' => 'Guarani (gn_PY)',
                    'gu_IN' => 'Gujarati (gu_IN)',
                    'gx_GR' => 'Classical Greek (gx_GR)',
                    'ha_NG' => 'Hausa (ha_NG)',
                    'he_IL' => 'Hebrew (he_IL)',
                    'hi_IN' => 'Hindi (hi_IN)',
                    'hr_HR' => 'Croatian (hr_HR)',
                    'hu_HU' => 'Hungarian (hu_HU)',
                    'hy_AM' => 'Armenian (hy_AM)',
                    'id_ID' => 'Indonesian (id_ID)',
                    'ig_NG' => 'Igbo (ig_NG)',
                    'is_IS' => 'Icelandic (is_IS)',
                    'it_IT' => 'Italian (it_IT)',
                    'ja_JP' => 'Japanese (ja_JP)',
                    'ja_KS' => 'Japanese (Kansai) (ja_KS)',
                    'jv_ID' => 'Javanese (jv_ID)',
                    'ka_GE' => 'Georgian (ka_GE)',
                    'kk_KZ' => 'Kazakh (kk_KZ)',
                    'km_KH' => 'Khmer (km_KH)',
                    'kn_IN' => 'Kannada (kn_IN)',
                    'ko_KR' => 'Korean (ko_KR)',
                    'ku_TR' => 'Kurdish (Kurmanji) (ku_TR)',
                    'la_VA' => 'Latin (la_VA)',
                    'lg_UG' => 'Ganda (lg_UG)',
                    'li_NL' => 'Limburgish (li_NL)',
                    'ln_CD' => 'Lingala (ln_CD)',
                    'lo_LA' => 'Lao (lo_LA)',
                    'lt_LT' => 'Lithuanian (lt_LT)',
                    'lv_LV' => 'Latvian (lv_LV)',
                    'mg_MG' => 'Malagasy (mg_MG)',
                    'mk_MK' => 'Macedonian (mk_MK)',
                    'ml_IN' => 'Malayalam (ml_IN)',
                    'mn_MN' => 'Mongolian (mn_MN)',
                    'mr_IN' => 'Marathi (mr_IN)',
                    'ms_MY' => 'Malay (ms_MY)',
                    'mt_MT' => 'Maltese (mt_MT)',
                    'my_MM' => 'Burmese (my_MM)',
                    'nb_NO' => 'Norwegian (bokmal) (nb_NO)',
                    'nd_ZW' => 'Ndebele (nd_ZW)',
                    'ne_NP' => 'Nepali (ne_NP)',
                    'nl_BE' => 'Dutch (Belgi�) (nl_BE)',
                    'nl_NL' => 'Dutch (nl_NL)',
                    'nn_NO' => 'Norwegian (nynorsk) (nn_NO)',
                    'ny_MW' => 'Chewa (ny_MW)',
                    'or_IN' => 'Oriya (or_IN)',
                    'pa_IN' => 'Punjabi (pa_IN)',
                    'pl_PL' => 'Polish (pl_PL)',
                    'ps_AF' => 'Pashto (ps_AF)',
                    'pt_BR' => 'Portuguese (Brazil) (pt_BR)',
                    'pt_PT' => 'Portuguese (Portugal) (pt_PT)',
                    'qu_PE' => 'Quechua (qu_PE)',
                    'rm_CH' => 'Romansh (rm_CH)',
                    'ro_RO' => 'Romanian (ro_RO)',
                    'ru_RU' => 'Russian (ru_RU)',
                    'rw_RW' => 'Kinyarwanda (rw_RW)',
                    'sa_IN' => 'Sanskrit (sa_IN)',
                    'sc_IT' => 'Sardinian (sc_IT)',
                    'se_NO' => 'Northern S�mi (se_NO)',
                    'si_LK' => 'Sinhala (si_LK)',
                    'sk_SK' => 'Slovak (sk_SK)',
                    'sl_SI' => 'Slovenian (sl_SI)',
                    'sn_ZW' => 'Shona (sn_ZW)',
                    'so_SO' => 'Somali (so_SO)',
                    'sq_AL' => 'Albanian (sq_AL)',
                    'sr_RS' => 'Serbian (sr_RS)',
                    'sv_SE' => 'Swedish (sv_SE)',
                    'sw_KE' => 'Swahili (sw_KE)',
                    'sy_SY' => 'Syriac (sy_SY)',
                    'sz_PL' => 'Silesian (sz_PL)',
                    'ta_IN' => 'Tamil (ta_IN)',
                    'te_IN' => 'Telugu (te_IN)',
                    'tg_TJ' => 'Tajik (tg_TJ)',
                    'th_TH' => 'Thai (th_TH)',
                    'tk_TM' => 'Turkmen (tk_TM)',
                    'tl_PH' => 'Filipino (tl_PH)',
                    'tl_ST' => 'Klingon (tl_ST)',
                    'tr_TR' => 'Turkish (tr_TR)',
                    'tt_RU' => 'Tatar (tt_RU)',
                    'tz_MA' => 'Tamazight (tz_MA)',
                    'uk_UA' => 'Ukrainian (uk_UA)',
                    'ur_PK' => 'Urdu (ur_PK)',
                    'uz_UZ' => 'Uzbek (uz_UZ)',
                    'vi_VN' => 'Vietnamese (vi_VN)',
                    'wo_SN' => 'Wolof (wo_SN)',
                    'xh_ZA' => 'Xhosa (xh_ZA)',
                    'yi_DE' => 'Yiddish (yi_DE)',
                    'yo_NG' => 'Yoruba (yo_NG)',
                    'zh_CN' => 'Simplified Chinese (China) (zh_CN)',
                    'zh_HK' => 'Traditional Chinese (Hong Kong) (zh_HK)',
                    'zh_TW' => 'Traditional Chinese (Taiwan) (zh_TW)',
                    'zu_ZA' => 'Zulu (zu_ZA)',
                    'zz_TR' => 'Zazaki (zz_TR)',
                ),
                'default' => 'en_US',
                'required'  => array('_mp_post_facebook_comments_enable', "equals", 1),
            ),
            array(
                'id' => '_mp_post_facebook_app_id',
                'type' => 'text',
                'title' => esc_html__('Facebook App ID', 'Newsgamer'),
                'subtitle' => esc_html__('For Comments Moderation', 'Newsgamer'),
                'default'  => '',
            ),
        )
     ) );


     // -> START Pages Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Pages Settings', 'Newsgamer' ),
         'id'               => '_mp_pages_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-icon-file',
         'fields'           => array(
             array(
                 'id' => '_mpgl_page_layout',
                 'type' => 'image_select',
                 'title' => esc_html__('Post Layout', 'Newsgamer'),
                 'options' => array(
                     'loop-page-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/page-layout-1.png'),
                     'loop-page-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/page-layout-2.png'),
                     'loop-page-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/page-layout-3.png'),
                     'loop-page-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/page-layout-4.png'),
                     'loop-page-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/page-layout-5.png'),
                     'loop-page-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/page-layout-6.png'),
                     'loop-page-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/page-layout-8.png'),
                     'loop-page-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/page-layout-9.png'),
                     //'loop-page-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/page-layout-7.png'),
                 ),
                 'default' => 'loop-page-2'
             ),
             array(
      			'id' => '_mpgl_page_layout_image_format',
      			'type' => 'select',
      			'title' => esc_html__('Image size', 'Newsgamer'),
      			'subtitle' => esc_html__('Set dimensions via "Settings > Media"', 'Newsgamer'),
                'options'  => array(
                    'thumbnail' => 'Thumbnail size',
                    'medium' => 'Medium size',
                    'large' => 'Large size'
                ),
                'default'  => 'medium',
      			'required'  => array (
      			    array('_mpgl_page_layout', "=", array('loop-page-8', 'loop-page-9') ),
      			)
	        ),
             array(
      			'id' => '_mpgl_page_layout_image_height',
      			'type' => 'switch',
      			'title' => esc_html__('Show full image height', 'Newsgamer'),
      			'subtitle' => esc_html__('Fit only horizontally', 'Newsgamer'),
      			'default' => 0,
      			'required'  => array (
      			    array('_mpgl_page_layout', "=", array('loop-page-2', 'loop-page-3', 'loop-page-4') ),
      			)
	        ),
            array(
                'id' => '_mpgl_page_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'id' => '_mpgl_page_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_page_sidebar_template', "!=", 'hide-sidebar'),
            ),
            array(
                'id' => '_mpgl_page_enable_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Enable Breadcrumbs', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'default' => '1',
            ),
         )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( '404 Page', 'Newsgamer' ),
         'id'               => '_mp_pages_404_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                'id' => '_mpgl_404page_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_404page_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_404page_sidebar_template', "!=", 'hide-sidebar'),
             ),
            array(
                'id' => '_mpgl_404page_show_posts',
                'title' => esc_html__( 'Show latest posts', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Show latest posts below search', 'Newsgamer' ),
                'type' => 'switch',
                'default' => '1',

            ),
            array(
                'id'=>'_mpgl_404page_posts_title',
                'type' => 'text',
                'title' => esc_html__('Latest posts title', 'Newsgamer'),
                'default' => esc_html__('Our latest posts', 'Newsgamer'),
                'required'  => array('_mpgl_404page_show_posts', "=", '1'),
            ),
            array(
                'id' => '_mpgl_404page_template',
                'type' => 'image_select',
                'title' => esc_html__('Posts layout', 'Newsgamer'),
                'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
                'options' => array(
                    'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                    'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                    'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                    'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                    'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                    'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                    'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                    'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                    'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                    'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                    'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                    'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                ),
                'default' => 'loop-cat-3',
                'required'  => array('_mpgl_404page_show_posts', "=", '1'),
            ),
            array(
    			'id'=>'_mpgl_404page_template_chars',
    			'type' => 'slider',
    			'title' => esc_html__('Limit text characters', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "1000",
    			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                'required'  => array('_mpgl_404page_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6')),
		    ),
            array(
    			'id' => '_mpgl_404page_grid_width',
    			'type' => 'button_set',
    			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
    			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
    			'options'   => array(
    			    'standard'   => 'Standard',
    			    'full-width' => 'Full Width'
    			),
    			'default' => 'standard',
                'required'  => array('_mpgl_404page_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
		    ),
            array(
                'id'       => '_mpgl_404page_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
                'required'  => array('_mpgl_404page_show_posts', "=", '1'),
            ),
            array(
                'id'=>'_mpgl_404page_posts_number',
                'type' => 'slider',
                'title' => esc_html__('Posts per page', 'Newsgamer'),
                "default" => "6",
                "min" 	=> "0",
                "step"	=> "1",
                "max" 	=> "50",
                'desc' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                'required'  => array('_mpgl_404page_show_posts', "=", '1'),
            ),

        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Archive Page', 'Newsgamer' ),
         'id'               => '_mp_pages_archive_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mpgl_archivepage_template',
                 'type' => 'image_select',
                 'title' => esc_html__('Posts layout', 'Newsgamer'),
                 'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
                 'options' => array(
                     'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                     'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                     'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                     'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                     'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                     'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                     'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                     'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                     'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                     'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                     'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                     'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                 ),
                 'default' => 'loop-cat-3',
             ),
             array(
     			'id'=>'_mpgl_archivepage_template_chars',
     			'type' => 'slider',
     			'title' => esc_html__('Limit text characters', 'Newsgamer'),
     			"default" => "0",
     			"min" 	=> "0",
     			"step"	=> "1",
     			"max" 	=> "1000",
     			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                 'required'  => array('_mpgl_archivepage_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
 		    ),
             array(
     			'id' => '_mpgl_archivepage_grid_width',
     			'type' => 'button_set',
     			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
     			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'standard'   => 'Standard',
     			    'full-width' => 'Full Width'
     			),
     			'default' => 'standard',
                 'required'  => array('_mpgl_archivepage_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
 		    ),
            array(
                'id'       => '_mpgl_archivepage_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
            ),
             array(
                'id' => '_mpgl_archivepage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_archivepage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_archivepage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_archivepage_sidebar_template', "!=", 'hide-sidebar'),
             ),
             array(
                'id'=>'_mpgl_archivepage_posts_number',
                'type' => 'slider',
                'title' => esc_html__('Posts per page', 'Newsgamer'),
                "default" => "0",
                "min" 	=> "0",
                "step"	=> "1",
                "max" 	=> "50",
                'desc' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
            ),
            array(
    			'id' => '_mpgl_archivepage_pagination',
    			'type' => 'button_set',
    			'title' => esc_html__('Pagination template', 'Newsgamer'),
    			'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
    			'options'   => array(
    			    'post-pagination-1' => 'Pager with numbers',
    			    'post-pagination-2' => 'Prev/next pager'
    			),
    			'default' => 'post-pagination-1',
		    ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Author Page', 'Newsgamer' ),
         'id'               => '_mp_pages_author_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mpgl_authorpage_template',
                 'type' => 'image_select',
                 'title' => esc_html__('Posts layout', 'Newsgamer'),
                 'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
                 'options' => array(
                     'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                     'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                     'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                     'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                     'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                     'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                     'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                     'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                     'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                     'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                     'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                     'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                 ),
                 'default' => 'loop-cat-3',
             ),
             array(
     			'id'=>'_mpgl_authorpage_template_chars',
     			'type' => 'slider',
     			'title' => esc_html__('Limit text characters', 'Newsgamer'),
     			"default" => "0",
     			"min" 	=> "0",
     			"step"	=> "1",
     			"max" 	=> "1000",
     			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                 'required'  => array('_mpgl_authorpage_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
 		    ),
             array(
     			'id' => '_mpgl_authorpage_grid_width',
     			'type' => 'button_set',
     			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
     			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'standard'   => 'Standard',
     			    'full-width' => 'Full Width'
     			),
     			'default' => 'standard',
                 'required'  => array('_mpgl_authorpage_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
 		    ),
            array(
                'id'       => '_mpgl_authorpage_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
            ),
             array(
                'id' => '_mpgl_authorpage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_authorpage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_authorpage_sidebar_template', "!=", 'hide-sidebar'),
             ),
             array(
                 'id'=>'_mpgl_authorpage_posts_title',
                 'type' => 'text',
                 'title' => esc_html__('News archive Title', 'Newsgamer'),
                 'default' => esc_html__('News archive', 'Newsgamer'),
             ),
             array(
    			'id'=>'_mpgl_authorpage_posts_number',
    			'type' => 'slider',
    			'title' => esc_html__('Posts per page', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "50",
    			'desc' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
		    ),
             array(
     			'id' => '_mpgl_authorpage_pagination',
     			'type' => 'button_set',
     			'title' => esc_html__('Pagination template', 'Newsgamer'),
     			'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'post-pagination-1' => 'Pager with numbers',
     			    'post-pagination-2' => 'Prev/next pager'
     			),
     			'default' => 'post-pagination-1',
 		    ),
            array(
                'id' => '_mpgl_authorpage_show_author_actions',
                'type' => 'switch',
                'title' => esc_html__('Enable author\'s meta', 'Newsgamer'),
                'subtitle' => esc_html__('No. of posts, comments and views', 'Newsgamer'),
                'default' => false,
		    ),

			array(
				'id'       => '_mpgl_authorpage_show_author_meta',
				'type'     => 'checkbox',
				'title' => esc_html__('Display author\'s meta', 'Newsgamer'),
				'subtitle' => esc_html__('Select what you want to display', 'Newsgamer'),
				'options'  => array(
					'posts' => 'Number of posts',
					'comments' => 'Number of  Comments',
					'views' => 'Number of Post Views'
				),
				'default' => array(
					'posts' => '0',
					'comments' => '0',
					'views' => '0'
				),
				'required'  => array('_mpgl_authorpage_show_author_actions', "equals", '1'),
			),


        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Team of Authors Page', 'Newsgamer' ),
         'id'               => '_mp_pages_team_of_authors_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
 				'id'=>'_mpgl_authorteampage_authors_per_page',
 				'type' => 'slider',
 				'title' => esc_html__('Authors per page', 'Newsgamer'),
 				'subtitle' => esc_html__('Number of authors per page', 'Newsgamer'),
 				"default" => "0",
 				"min" 	=> "0",
 				"step"	=> "1",
 				"max" 	=> "100",
 				'desc' => esc_html__('0 for displaying all authors', 'Newsgamer'),
 		    ),
 			array(
                 'id' => '_mpgl_authorteampage_authors_orderby',
                 'type' => 'select',
                 'title' => esc_html__('Order by', 'Newsgamer'),
                 'subtitle' => esc_html__('Order Authors by', 'Newsgamer'),
                 'options'   => array(
                     'ID' => 'ID',
                     'display_name' => 'User display name',
                     'user_name' => 'User name',
 					'user_email' => 'User email',
                     'url' => 'User url',
                     'post_count' => 'User post count',
                     'post_views' => 'User post views',
                 ),
                 'default' => 'post_count',
 		    ),

 			array(
                 'id' => '_mpgl_authorteampage_authors_order',
                 'type' => 'select',
                 'title' => esc_html__('Order', 'Newsgamer'),
                 'subtitle' => esc_html__('Ascending or descending', 'Newsgamer'),
                 'options'   => array(
                     'ASC' => 'Ascending',
                     'DESC' => 'Descending',
                 ),
                 'default' => 'DESC',
 		    ),

             array(
                 'id' => '_mpgl_authorteampage_show_author_actions',
                 'type' => 'switch',
                 'title' => esc_html__('Display author\'s meta', 'Newsgamer'),
                 'subtitle' => esc_html__('No. of posts, comments and views', 'Newsgamer'),
                 'default' => false,
 		    ),

 			array(
                 'id' => '_mpgl_authorteampage_authors_roles',
                 'type' => 'select',
                 'title' => esc_html__('Include Authors Roles', 'Newsgamer'),
                 'subtitle' => esc_html__('Select one or more', 'Newsgamer'),
 				'multi'	=> true,
                 'options'   => array(
                     'Administrator' => 'Administrator',
                     'Editor' => 'Editor',
 					'Author' => 'Author',
                     'Contributor' => 'Contributor',
 					'Subscriber' => 'Subscriber',
                 ),
                 'default' => 'Author',
 		    ),

 		    array(
                 'id' => '_mpgl_authorteampage_exclude',
                 'type' => 'text',
                 'title' => esc_html__('Exclude Authors', 'Newsgamer'),
                 'subtitle' => esc_html__('Don\'t display these authors', 'Newsgamer'),
                 'description' => esc_html__('List of authots id, separated by commas (e.g. 2,3,5).', 'Newsgamer'),
             ),
        )
    ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Search Page', 'Newsgamer' ),
         'id'               => '_mp_pages_search_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mpgl_searchpage_template',
                 'type' => 'image_select',
                 'title' => esc_html__('Posts layout', 'Newsgamer'),
                 'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
                 'options' => array(
                     'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                     'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                     'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                     'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                     'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                     'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                     'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                     'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                     'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                     'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                     'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                     'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                 ),
                 'default' => 'loop-cat-3',
             ),
             array(
     			'id'=>'_mpgl_searchpage_template_chars',
     			'type' => 'slider',
     			'title' => esc_html__('Limit text characters', 'Newsgamer'),
     			"default" => "0",
     			"min" 	=> "0",
     			"step"	=> "1",
     			"max" 	=> "1000",
     			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                 'required'  => array('_mpgl_searchpage_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6')),
 		    ),
             array(
     			'id' => '_mpgl_searchpage_grid_width',
     			'type' => 'button_set',
     			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
     			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'standard'   => 'Standard',
     			    'full-width' => 'Full Width'
     			),
     			'default' => 'standard',
                 'required'  => array('_mpgl_searchpage_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
 		    ),
            array(
                'id'       => '_mpgl_searchpage_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
            ),
             array(
                'id' => '_mpgl_searchpage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_searchpage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_searchpage_sidebar_template', "!=", 'hide-sidebar'),
             ),
             array(
    			'id'=>'_mpgl_searchpage_posts_number',
    			'type' => 'slider',
    			'title' => esc_html__('Posts per page', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "50",
    			'desc' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
		    ),
             array(
     			'id' => '_mpgl_searchpage_pagination',
     			'type' => 'button_set',
     			'title' => esc_html__('Pagination template', 'Newsgamer'),
     			'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'post-pagination-1' => 'Pager with numbers',
     			    'post-pagination-2' => 'Prev/next pager'
     			),
     			'default' => 'post-pagination-1',
 		    ),
            /*array(
                'id' => '_mpgl_searchpage_advanced',
                'type' => 'button_set',
                'title' => esc_html__('Enable Advanced Search', 'Newsgamer'),
                'options'   => array(
                    'search-advanced' => 'Enable',
                    'search-basic' => 'Disable'
                ),
                'default' => 'search-basic',
            ),
            array(
                'id' => '_mpgl_searchpage_exclude_pages',
                'type' => 'button_set',
                'title' => esc_html__('Exclude Pages in results', 'Newsgamer'),
                'options'   => array(
                    '1' => 'Exclude',
                    '0' => 'Don\'t exclude'
                ),
                'default' => '1',
            ),*/

        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Tag Page', 'Newsgamer' ),
         'id'               => '_mp_pages_tag_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mpgl_tagpage_template',
                 'type' => 'image_select',
                 'title' => esc_html__('Posts layout', 'Newsgamer'),
                 'subtitle' => esc_html__('Select layout for posts.', 'Newsgamer'),
                 'options' => array(
                     'loop-cat-1' => array('alt' => 'Category layout 1', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-1.png'),
                     'loop-cat-2' => array('alt' => 'Category layout 2', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-2.png'),
                     'loop-cat-3' => array('alt' => 'Category layout 3', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-3.png'),
                     'loop-cat-4' => array('alt' => 'Category layout 4', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-4.png'),
                     'loop-cat-5' => array('alt' => 'Category layout 5', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-5.png'),
                     'loop-cat-6' => array('alt' => 'Category layout 6', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-6.png'),
                     'loop-cat-7' => array('alt' => 'Category layout 7', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-7.png'),
                     'loop-cat-8' => array('alt' => 'Category layout 8', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-8.png'),
                     'loop-cat-9' => array('alt' => 'Category layout 9', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-9.png'),
                     'loop-cat-10' => array('alt' => 'Category layout 10', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-10.png'),
                     'loop-cat-11' => array('alt' => 'Category layout 11', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-11.png'),
                     'loop-cat-12' => array('alt' => 'Category layout 12', 'img' => get_template_directory_uri(). '/images/redux/cat-layout-12.png'),
                 ),
                 'default' => 'loop-cat-3',
             ),
             array(
     			'id'=>'_mpgl_tagpage_template_chars',
     			'type' => 'slider',
     			'title' => esc_html__('Limit text characters', 'Newsgamer'),
     			"default" => "0",
     			"min" 	=> "0",
     			"step"	=> "1",
     			"max" 	=> "1000",
     			'subtitle' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
                 'required'  => array('_mpgl_tagpage_template', "=", array('loop-cat-1', 'loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-11', 'loop-cat-12')),
 		    ),
             array(
     			'id' => '_mpgl_tagpage_grid_width',
     			'type' => 'button_set',
     			'title' => esc_html__('Posts Layout Grid', 'Newsgamer'),
     			'subtitle' => esc_html__('Select  template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'standard'   => 'Standard',
     			    'full-width' => 'Full Width'
     			),
     			'default' => 'standard',
                 'required'  => array('_mpgl_tagpage_template', "=", array('loop-cat-2', 'loop-cat-3', 'loop-cat-4', 'loop-cat-5', 'loop-cat-6', 'loop-cat-7', 'loop-cat-8', 'loop-cat-9', 'loop-cat-10', 'loop-cat-12')),
 		    ),
            array(
                'id'       => '_mpgl_tagpage_postmeta_elements',
                'type'     => 'checkbox',
                'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                'options'  => array(
                    'date' => 'Post Date',
                    'author' => 'Author',
                    'category' => 'Categories',
                    'comments' => 'Comments',
                    'views' => 'Views',
                ),
                'default'  => array(
                    'date' => '1',
                    'author' => '0',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '0',
                ),
            ),
             array(
                'id' => '_mpgl_tagpage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_tagpage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_tagpage_sidebar_template', "!=", 'hide-sidebar'),
             ),
             array(
    			'id'=>'_mpgl_tagpage_posts_number',
    			'type' => 'slider',
    			'title' => esc_html__('Posts per page', 'Newsgamer'),
    			"default" => "0",
    			"min" 	=> "0",
    			"step"	=> "1",
    			"max" 	=> "50",
    			'desc' => esc_html__('0 for using default wordpress settings', 'Newsgamer'),
		    ),
             array(
     			'id' => '_mpgl_tagpage_pagination',
     			'type' => 'button_set',
     			'title' => esc_html__('Pagination template', 'Newsgamer'),
     			'subtitle' => esc_html__('Select template for pagination.', 'Newsgamer'),
     			'options'   => array(
     			    'post-pagination-1' => 'Pager with numbers',
     			    'post-pagination-2' => 'Prev/next pager'
     			),
     			'default' => 'post-pagination-1',
 		    ),

        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'bbPress Page', 'Newsgamer' ),
         'id'               => '_mp_pages_bbpress_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                'id' => '_mpgl_bbPresspage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_bbPresspage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_bbPresspage_sidebar_template', "!=", 'hide-sidebar'),
             ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'WooCommerce Page', 'Newsgamer' ),
         'id'               => '_mp_pages_woocommerce_settings',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                'id' => '_mpgl_woocommercepage_sidebar_template',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar position', 'Newsgamer'),
                'subtitle' => esc_html__('Select main sidebar position for posts.', 'Newsgamer'),
                'options' => array(
                    'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cl.png'),
                    'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => get_template_directory_uri(). '/images/redux/2cr.png'),
                    'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => get_template_directory_uri(). '/images/redux/1c.png'),
                ),
                'default' => 'right-sidebar'
             ),
             array(
                'id' => '_mpgl_woocommercepage_sidebar_source',
                'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                'subtitle' => esc_html__( 'Sidebar for left/right column', 'Newsgamer' ),
                'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                'type' => 'select',
                'data' => 'sidebars',
                //'default' => 'None',
                'required'  => array('_mpgl_woocommercepage_sidebar_template', "!=", 'hide-sidebar'),
             ),
        )
     ) );


     // -> START Sidebars
     Redux::setSection( $opt_name, array(
        'title'             => esc_html__('Sidebars', 'Newsgamer'),
        'id'                => '_mp_sidebar_settings',
        'icon'              => 'el-icon-retweet',
        'fields'            => array(
            array(
                'id'        => '_mp_sidebars',
                'type'      => 'multi_text',
                'title'     => esc_html__('My Sidebars', 'Newsgamer'),
                'subtitle'  => esc_html__('Add/remove your sidebars', 'Newsgamer'),
                'add_text'  => esc_html__('Add sidebar', 'Newsgamer'),
            ),
            array(
                'id' => '_mpgl_sidebars_enable_sticky',
                'type' => 'switch',
                'title' => esc_html__('Enable sticky sidebar', 'Newsgamer'),
                'subtitle'  => esc_html__('Set sidebar to be sticky', 'Newsgamer'),
                'default' => 0,
            ),
        )
     ) );




     // -> START Footer Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Footer Settings', 'Newsgamer' ),
         'id'               => '_mp_footer_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-icon-download-alt',
         'fields'           => array(
            array(
                'id' => '_mp_enable_footer_copy',
                'type' => 'switch',
                'title' => __('Enable copyright section', 'Newsgamer'),
                'on' => 'Enable',
                'off' => 'Disable',
                'default' => false,
            ),
            array(
                'id' => '_mp_enable_footer_copy_text',
                'title' => __( 'Copyright Text', 'Newsgamer' ),
                'type' => 'text',
                'default' => ( isset($mp_post_options['_mp_enable_footer_copy_text']) ? $mp_post_options['_mp_enable_footer_copy_text'] : '&copy; <a href="#">NewsGamer</a> 2016. All rights reserved.'),
                'required'  => array('_mp_enable_footer_copy', "equals", '1'),
            ),
            array(
                'id' => '_mp_enable_footer_copy_author_text',
                'title' => __( 'Author Text', 'Newsgamer' ),
                'type' => 'text',
                'default' => ( isset($mp_post_options['_mp_enable_footer_copy_author_text']) ? $mp_post_options['_mp_enable_footer_copy_author_text'] : 'Produced by <a href="http://themes.mipdesign.com">Mip Themes</a>'),
                'required'  => array('_mp_enable_footer_copy', "equals", '1'),
            ),

         )
     ) );


     // -> START Footer Settings
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Top Section', 'Newsgamer' ),
         'id'               => '_mp_footer_top_section',
         'customizer_width' => '450px',
         'subsection'       => true,
         'fields'           => array(
             array(
                 'id' => '_mp_enable_footer_one_widgets',
                 'type' => 'switch',
                 'title' => esc_html__('Enable widgetized area', 'Newsgamer'),
                 'on' => 'Enable',
                 'off' => 'Disable',
                 'default' => false,
             ),
             array(
                 'id' => '_mp_footer_one_widget_layout',
                 'type' => 'image_select',
                 'title' => esc_html__('Area layout', 'Newsgamer'),
                 'subtitle' => esc_html__('Select header layout.', 'Newsgamer'),
                 'options' => array(
                     'footer-top-widget-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-1.png'),
                     'footer-top-widget-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-2.png'),
                     'footer-top-widget-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-3.png'),
                 ),
                 'required'  => array('_mp_enable_footer_one_widgets', "equals", '1'),
             ),
             array(
                 'id' => '_mp_footer_one_widget_column_1_source',
                 'title' => esc_html__( 'Select sidebar for first column', 'Newsgamer' ),
                 'desc' => 'Please select the sidebar you would like to display on first column.',
                 'type' => 'select',
                 'data' => 'sidebars',
                 'default' => 'None',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-1', 'footer-top-widget-2', 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),
             array(
                 'id' => '_mp_footer_one_widget_column_1_align',
                 'type' => 'select',
                 'title' => esc_html__('Select alignment for first column', 'Newsgamer'),
                 'options' => array(
                 'text-left' => 'Left',
                 'text-center' => 'Center',
                 'text-right' => 'Right',
                 ),
                 'default' => 'text-left',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-1', 'footer-top-widget-2', 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),

             array(
                 'id' => '_mp_footer_one_widget_column_2_source',
                 'title' => esc_html__( 'Select sidebar for second column', 'Newsgamer' ),
                 'desc' => 'Please select the sidebar you would like to display on second column.',
                 'type' => 'select',
                 'data' => 'sidebars',
                 'default' => 'None',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-2', 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),
             array(
                 'id' => '_mp_footer_one_widget_column_2_align',
                 'type' => 'select',
                 'title' => esc_html__('Select alignment for second column', 'Newsgamer'),
                 'options' => array(
                 'text-left' => 'Left',
                 'text-center' => 'Center',
                 'text-right' => 'Right',
                 ),
                 'default' => 'text-left',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-2', 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),

             array(
                 'id' => '_mp_footer_one_widget_column_3_source',
                 'title' => esc_html__( 'Select sidebar for third column', 'Newsgamer' ),
                 'desc' => 'Please select the sidebar you would like to display on third column.',
                 'type' => 'select',
                 'data' => 'sidebars',
                 'default' => 'None',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),
             array(
                 'id' => '_mp_footer_one_widget_column_3_align',
                 'type' => 'select',
                 'title' => esc_html__('Select alignment for third column', 'Newsgamer'),
                 'options' => array(
                 'text-left' => 'Left',
                 'text-center' => 'Center',
                 'text-right' => 'Right',
                 ),
                 'default' => 'text-left',
                 'required'  => array(
                     array('_mp_footer_one_widget_layout', "=", array( 'footer-top-widget-3' )),
                     array('_mp_enable_footer_one_widgets', "equals", '1'),
                 ),
             ),

         )
      ) );


      // -> START Footer Settings
      Redux::setSection( $opt_name, array(
          'title'            => esc_html__( 'Bottom Section', 'Newsgamer' ),
          'id'               => '_mp_footer_bottom_section',
          'customizer_width' => '450px',
          'subsection'       => true,
          'fields'           => array(
              array(
                  'id' => '_mp_enable_footer_two_widgets',
                  'type' => 'switch',
                  'title' => esc_html__('Enable widgetized area', 'Newsgamer'),
                  'on' => 'Enable',
                  'off' => 'Disable',
                  'default' => false,
              ),
              array(
                  'id' => '_mp_footer_two_widget_layout',
                  'type' => 'image_select',
                  'title' => esc_html__('Area layout', 'Newsgamer'),
                  'subtitle' => esc_html__('Select header layout.', 'Newsgamer'),
                  'options' => array(
                      'footer-bottom-widget-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-1.png'),
                      'footer-bottom-widget-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-2.png'),
                      'footer-bottom-widget-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/header-layout-widget-3.png'),
                  ),
                  'required'  => array('_mp_enable_footer_two_widgets', "equals", '1'),
              ),
              array(
                  'id' => '_mp_footer_two_widget_column_1_source',
                  'title' => esc_html__( 'Select sidebar for first column', 'Newsgamer' ),
                  'desc' => 'Please select the sidebar you would like to display on first column.',
                  'type' => 'select',
                  'data' => 'sidebars',
                  'default' => 'None',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-1', 'footer-bottom-widget-2', 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),
              array(
                  'id' => '_mp_footer_two_widget_column_1_align',
                  'type' => 'select',
                  'title' => esc_html__('Select alignment for first column', 'Newsgamer'),
                  'options' => array(
                  'text-left' => 'Left',
                  'text-center' => 'Center',
                  'text-right' => 'Right',
                  ),
                  'default' => 'text-left',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-1', 'footer-bottom-widget-2', 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),

              array(
                  'id' => '_mp_footer_two_widget_column_2_source',
                  'title' => esc_html__( 'Select sidebar for second column', 'Newsgamer' ),
                  'desc' => 'Please select the sidebar you would like to display on second column.',
                  'type' => 'select',
                  'data' => 'sidebars',
                  'default' => 'None',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-2', 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),
              array(
                  'id' => '_mp_footer_two_widget_column_2_align',
                  'type' => 'select',
                  'title' => esc_html__('Select alignment for second column', 'Newsgamer'),
                  'options' => array(
                  'text-left' => 'Left',
                  'text-center' => 'Center',
                  'text-right' => 'Right',
                  ),
                  'default' => 'text-left',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-2', 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),

              array(
                  'id' => '_mp_footer_two_widget_column_3_source',
                  'title' => esc_html__( 'Select sidebar for third column', 'Newsgamer' ),
                  'desc' => 'Please select the sidebar you would like to display on third column.',
                  'type' => 'select',
                  'data' => 'sidebars',
                  'default' => 'None',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),
              array(
                  'id' => '_mp_footer_two_widget_column_3_align',
                  'type' => 'select',
                  'title' => esc_html__('Select alignment for third column', 'Newsgamer'),
                  'options' => array(
                  'text-left' => 'Left',
                  'text-center' => 'Center',
                  'text-right' => 'Right',
                  ),
                  'default' => 'text-left',
                  'required'  => array(
                      array('_mp_footer_two_widget_layout', "=", array( 'footer-bottom-widget-3' )),
                      array('_mp_enable_footer_two_widgets', "equals", '1'),
                  ),
              ),

          )
       ) );



     // -> START Ads System
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Ads System', 'Newsgamer' ),
         'id'               => '_mp_adssysten_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-network',
         'fields'           => array(
             array(
                 'id'   => '_mp_info_global_ads',
                 'type' => 'info',
                 'notice' => true,
                 'style' => 'success',
                 'title' => esc_html__('These are global settings', 'Newsgamer'),
             ),
             array(
                 'id' 	=> '_mp_ads_global_top',
                 'type' 	=> 'select',
                 'title' => esc_html__('Top Ad', 'Newsgamer'),
                 'data'  => 'posts',
                 'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
             ),
             array(
                 'id' 	=> '_mp_ads_global_bottom',
                 'type' 	=> 'select',
                 'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                 'data'  => 'posts',
                 'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
             ),
                 array(
                 'id' 	=> '_mp_ads_global_wall',
                 'type' 	=> 'select',
                 'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                 'data'  => 'posts',
                 'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
             ),
             array(
                 'id' 	=> '_mp_ads_global_side_left',
                 'type' 	=> 'select',
                 'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                 'data'  => 'posts',
                 'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
             ),
             array(
                 'id' 	=> '_mp_ads_global_side_right',
                 'type' 	=> 'select',
                 'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                 'data'  => 'posts',
                 'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
             ),
         )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Ads for Homepage', 'Newsgamer' ),
         'id'               => '_mp_adssysten_home_settings',
         'subsection'       => true,
         'customizer_width' => '450px',
         'fields'           => array(
            array(
                'id' 	=> '_mp_ads_home_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_home_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
                array(
                'id' 	=> '_mp_ads_home_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_home_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_home_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Ads for Pages', 'Newsgamer' ),
         'id'               => '_mp_adssysten_pages_settings',
         'subsection'       => true,
         'customizer_width' => '450px',
         'fields'           => array(
            array(
                'id'   => '_mp_info_ads_posts',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for Posts', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_posts_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_posts_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_posts_section_1',
                'type' 	=> 'select',
                'title' => esc_html__('Post Ad 1', 'Newsgamer'),
                'subtitle' => esc_html__('Before the post', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_posts_section_2',
                'type' 	=> 'select',
                'title' => esc_html__('Post Ad 2', 'Newsgamer'),
                'subtitle' => esc_html__('Before post content (after image)', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_posts_section_3',
                'type' 	=> 'select',
                'title' => esc_html__('Post Ad 3', 'Newsgamer'),
                'subtitle' => esc_html__('After the post', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id' 	=> '_mp_ads_posts_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id' 	=> '_mp_ads_posts_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_posts_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id'   => '_mp_info_ads_pages',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for Pages', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_page_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_page_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_page_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_page_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_page_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id'   => '_mp_info_ads_author',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for Author Page', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_author_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_author_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_author_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_author_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_author_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id'   => '_mp_info_ads_archive',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for Archive Page', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_archive_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_archive_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_archive_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_archive_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_archive_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id'   => '_mp_info_ads_bbPress',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for bbPress Page', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_bbpress_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_bbpress_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_bbpress_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_bbpress_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_bbpress_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),

            array(
                'id'   => '_mp_info_ads_woocommerce',
                'type' => 'info',
                'notice' => true,
                'style' => 'success',
                'title' => esc_html__('Ads for WooCommerce Page', 'Newsgamer'),
            ),
            array(
                'id' 	=> '_mp_ads_woocommerce_top',
                'type' 	=> 'select',
                'title' => esc_html__('Top Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_woocommerce_bottom',
                'type' 	=> 'select',
                'title' => esc_html__('Bottom Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_woocommerce_wall',
                'type' 	=> 'select',
                'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_woocommerce_side_left',
                'type' 	=> 'select',
                'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
            array(
                'id' 	=> '_mp_ads_woocommerce_side_right',
                'type' 	=> 'select',
                'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
            ),
        )
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Ads for Categories', 'Newsgamer' ),
         'id'               => '_mp_adssysten_category_settings',
         'subsection'       => true,
         'customizer_width' => '450px',
         'fields'           => $banner_cats
     ) );

     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Ads for Mobile', 'Newsgamer' ),
         'id'               => '_mp_adssysten_mobile_settings',
         'subsection'       => true,
         'customizer_width' => '450px',
         'fields'           => array(
            array(
                'id' 	=> '_mp_ads_mobile_header',
                'type' 	=> 'select',
                'title' => esc_html__('Header Ad', 'Newsgamer'),
                'data'  => 'posts',
                'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'mobile-display', 'posts_per_page' => -1 ),
            ),
        )
     ) );


     // -> START Advanced Settings
     Redux::setSection( $opt_name, array(
        'title' => esc_html__('Advanced Settings', 'Newsgamer'),
        'id' => '_mp_advanced_settings',
        'icon' => 'el-icon-cog',
        'fields' => array(
            array(
                'id' => '_mp_page_title_simple',
                'title' => esc_html__( 'Simple Page title', 'Newsgamer' ),
                'desc' => esc_html__('Enable this if you have problem with page titles.', 'Newsgamer'),
                'type' => 'switch',
                'default' => false,
            ),
            array(
                'id' => '_mp_page_open_graph_image',
                'title' => esc_html__( 'Enable Open Graph Featured image', 'Newsgamer' ),
                'desc' => esc_html__('Enable this if you don\'t have any SEO plugins installed.', 'Newsgamer'),
                'type' => 'switch',
                'default' => false,
            ),
            /*array(
    			'id' => '_mp_minify_css_js',
    			'title' => esc_html__( 'Use minified CSS and JS files', 'Newsgamer' ),
    			'desc' => esc_html__('Enable this if you don\'t have any minify plugins installed.', 'Newsgamer'),
    			'type' => 'switch',
    			'default' => false,
		    ),*/
            array(
    			'id' => '_mp_disable_emoji_icons',
    			'title' => esc_html__( 'Disable Emoji', 'Newsgamer' ),
    			'desc' => esc_html__('Disable this if you don\'t need them (WordPress default install).', 'Newsgamer'),
    			'type' => 'switch',
    			'default' => false,
		    ),
            array(
                'id' => '_mp_ga_code',
                'type' => 'ace_editor',
                'title' => esc_html__('Google Analytics Code', 'Newsgamer'),
                'desc' => esc_html__('Here you can paste your Google Analytics code (not your id). If you don\'t have it or you are already using one, just leave blank. Don\'t use <b>&lt;script&gt;</b> tags.', 'Newsgamer'),
                'mode' => 'javascript',
                'theme' => 'chrome'
            ),
            array(
                'id' => '_mp_css_code',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom CSS Code', 'Newsgamer'),
                'desc' => esc_html__('e.g. #header{ background: #000; }<br> Don\'t use <b>&lt;style&gt;</b> tags', 'Newsgamer'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'Newsgamer'),
                'mode' => 'css',
                'compiler'	=> true,
                'theme' => 'chrome',
                'default'  => '',
            ),
            array(
                'id' => '_mp_js_code_header',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom JS Code (Header)', 'Newsgamer'),
                'desc' => esc_html__('e.g. alert("Hello World!");<br> Don\'t use <b>&lt;script&gt;</b> tags or <strong>document.ready</strong>', 'Newsgamer'),
                'subtitle' => esc_html__('Paste your JS code here.', 'Newsgamer'),
                'mode' => 'javascript',
                'theme' => 'chrome'
            ),
            array(
                'id' => '_mp_js_code',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom JS Code (Footer)', 'Newsgamer'),
                'desc' => esc_html__('e.g. alert("Hello World!");<br> Don\'t use <b>&lt;script&gt;</b> tags or <strong>document.ready</strong>', 'Newsgamer'),
                'subtitle' => esc_html__('Paste your JS code here.', 'Newsgamer'),
                'mode' => 'javascript',
                'theme' => 'chrome'
            ),
            array(
                'id' => '_mp_js_jquery_footer',
                'title' => esc_html__( 'Register jQuery in footer', 'Newsgamer' ),
                'desc' => esc_html__('Disable this if you have problems with other plugins!', 'Newsgamer'),
                'type' => 'switch',
                'default' => '0',
            ),
            array(
                'id'=>'_mp_js_ajaxpagination_timer',
                'type' => 'slider',
                'title' => esc_html__('Ajax Pagination Timer', 'Newsgamer'),
                'desc' => esc_html__('Use higher settings if pagination is overlapping!', 'Newsgamer'),
                "default" => "1000",
                "min" 	=> "1000",
                "step"	=> "100",
                "max" 	=> "3000",
            ),
        )
     ) );


     Redux::setSection( $opt_name, array(
        'title'         => esc_html__('Datetime Settings', 'Newsgamer'),
        'desc'          => esc_html__('Please, check this tutorial on <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">how to format Date and Time</a>', 'Newsgamer'),
        'icon'          => 'el-icon-calendar-sign',
        'subsection'    => true,
        'fields'        => array(
            array(
                'id' => '_mp_dateformat_default',
                'type' => 'text',
                'title' => esc_html__('Default date format', 'Newsgamer'),
                'subtitle' => esc_html__('Main content and posts', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: November 6th, 2014)', 'Newsgamer'),
                'default' => 'F jS, Y',
            ),
            array(
                'id' => '_mp_short_dateformat_default',
                'type' => 'text',
                'title' => esc_html__('Default short date format', 'Newsgamer'),
                'subtitle' => esc_html__('Image layouts', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: Nov 6th, 2014)', 'Newsgamer'),
                'default' => 'M jS, Y',
            ),
            array(
                'id' => '_mp_timeformat_default',
                'type' => 'text',
                'title' => esc_html__('Default time format', 'Newsgamer'),
                'subtitle' => esc_html__('Main content and posts', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: 12:50 AM)', 'Newsgamer'),
                'default' => 'g:i A',
            ),
            array(
                'id' => '_mp_dateformat_header',
                'type' => 'text',
                'title' => esc_html__('Header date format', 'Newsgamer'),
                'subtitle' => esc_html__('Header widget', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: November 6th, 2014)', 'Newsgamer'),
                'default' => 'F jS, Y',
            ),
            array(
                'id' => '_mp_dateformat_sidebar',
                'type' => 'text',
                'title' => esc_html__('Sidebar date format', 'Newsgamer'),
                'subtitle' => esc_html__('Shorter date to fit', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: Nov 6th, 2014)', 'Newsgamer'),
                'default' => 'M jS, Y',
            ),
            array(
                'id' => '_mp_dateformat_timeline',
                'type' => 'text',
                'title' => esc_html__('Timeline date format', 'Newsgamer'),
                'subtitle' => esc_html__('Timeline Widget', 'Newsgamer'),
                'desc' => esc_html__('(e.g.: Nov 6th)', 'Newsgamer'),
                'default' => 'M jS',
            ),
        )
     ) );


     // -> START Basic Fields
     Redux::setSection( $opt_name, array(
         'title'            => esc_html__( 'Favicons', 'Newsgamer' ),
         'id'               => '_mp_favicons_settings',
         'customizer_width' => '400px',
         'icon'             => 'el el-star',
         'fields' => array(
            array(
                'id' => '_mp_favicon_16',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Favicon 16x16 pixels (ico)', 'Newsgamer'),
                'desc' => esc_html__('The 16x16 favicon is the most used on all browsers.', 'Newsgamer')
            ),
            array(
                'id' => '_mp_favicon_57',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Apple Touch Icon 57x57 pixels (png)', 'Newsgamer'),
                'desc' => esc_html__('For non-Retina iPhone, iPod Touch, and Android 2.1+ devices', 'Newsgamer')
            ),
            array(
                'id' => '_mp_favicon_76',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Apple Touch Icon 76x76 pixels (png)', 'Newsgamer'),
                'desc' => esc_html__('Size for iPad 2 and iPad mini (standard resolution)', 'Newsgamer')
            ),
            array(
                'id' => '_mp_favicon_120',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Apple Touch Icon 120x120 pixels (png)', 'Newsgamer'),
                'desc' => esc_html__('Size for iPhone and iPod touch (high resolution)', 'Newsgamer')
            ),
            array(
                'id' => '_mp_favicon_152',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Apple Touch Icon 152x152 pixels (png)', 'Newsgamer'),
                'desc' => esc_html__('Size for iPad and iPad mini (high resolution)', 'Newsgamer')
            )
        )
     ) );

    /*
     * <--- END SECTIONS
     */


    /*
     *
     * METABOXES
     *
     */

     if ( !function_exists( "redux_add_posts_metaboxes" ) ):
        function redux_add_posts_metaboxes($metaboxes) {
            global $mipthemeoptions_framework;
            $post_id            = isset($_GET['post']) ? $_GET['post'] : 0;

            $post_categories    = wp_get_post_categories( $post_id );
            $cats = '';
            $mp_post_options    = get_option('mipthemeoptions_framework');
            $mp_weekly_options  = get_option('miptheme');
            $redux_url          = ReduxFramework::$_url;

            foreach($post_categories as $c){
                $cat = get_category( $c );
                $cats .= $cat->cat_ID .',';
            }

            $boxsections[] = array(
                'title' => esc_html__('Posts Settings', 'Newsgamer'),
                'icon' => 'el-icon-file-edit',
                'desc' => esc_html__('This options overides your global settings.', 'Newsgamer'),
                'fields' => array(
                    array(
                        'id' => '_mpgl_post_layout_single',
                        'type' => 'image_select',
                        'title' => esc_html__('Post layout', 'Newsgamer'),
                        'desc' => esc_html__('Select layout for this post.', 'Newsgamer'),
                        'options' => array(
                            'loop-page-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/page-layout-1.png'),
                            'loop-page-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/page-layout-2.png'),
                            'loop-page-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/page-layout-3.png'),
                            'loop-page-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/page-layout-4.png'),
                            'loop-page-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/page-layout-5.png'),
                            'loop-page-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/page-layout-6.png'),
                            'loop-page-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/page-layout-7.png'),
                            'loop-page-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/page-layout-8.png'),
                            'loop-page-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/page-layout-9.png'),
                            ''            => array('alt' => 'Layout 0', 'img' => get_template_directory_uri(). '/images/redux/page-layout-0.png'),
                        ),
                        'default' => $mp_post_options['_mpgl_post_layout'],
                    ),
                    array(
                       'id'        => '_mpgl_post_layout_single_image_parallax_height',
                       'type'      => 'slider',
                       'title'     => __('Image Height', 'Newsgamer'),
                       'subtitle'  => __('Select percentage of the screen.', 'Newsgamer'),
                       "min"       => 0,
                       "step"      => 1,
                       "max"       => 100,
                       'display_value' => 'input',
                       'required'  => array (
             			    array('_mpgl_post_layout_single', "=", array('loop-page-5', 'loop-page-6', 'loop-page-7') ),
             			)
                    ),
                    array(
             			'id' => '_mpgl_post_layout_single_image_format',
             			'type' => 'select',
             			'title' => esc_html__('Image size', 'Newsgamer'),
             			'subtitle' => esc_html__('Set dimensions via "Settings > Media"', 'Newsgamer'),
                       'options'  => array(
                           'thumbnail' => 'Thumbnail size',
                           'medium' => 'Medium size',
                           'large' => 'Large size'
                       ),
                       //'default'  => 'medium',
             			'required'  => array (
             			    array('_mpgl_post_layout_single', "=", array('loop-page-8', 'loop-page-9') ),
             			)
       	            ),

                    array(
                        'id' => '_mpgl_post_layout_single_image_height',
                        'type' => 'switch',
                        'title' => esc_html__('Show full image height', 'Newsgamer'),
                        'subtitle' => esc_html__('Fit only horizontally', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        'required'  => array (
                            array('_mpgl_post_layout_single', "=", array('loop-page-2', 'loop-page-3', 'loop-page-4') ),
                        ),
                        //'default' => $mp_post_options['_mpgl_post_layout_image_height'],
                    ),

                    array(
                       'id' => '_mpgl_post_layout_review_poster_single',
                       'type' => 'media',
                       'title' => esc_html__('Review Poster', 'Newsgamer'),
                       'subtitle' => esc_html__('Upload poster for this layout', 'Newsgamer'),
                       'required'  => array (
                           array('_mpgl_post_layout_single', "=", array('loop-page-7') ),
                       ),
                       //'default' => $mp_post_options['_mpgl_post_layout_review_poster'],
                    ),

                    array(
                        'id' => '_mpgl_post_sidebar_template_single',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar position', 'Newsgamer'),
                        'subtitle' => esc_html__('Select main sidebar position for this post.', 'Newsgamer'),
                        'options' => array(
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => $redux_url.'/assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $redux_url.'/assets/img/2cr.png'),
                            'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => $redux_url.'/assets/img/1c.png'),
                            ''            => array('alt' => 'Sidebar default', 'img' => get_template_directory_uri(). '/images/redux/sidebar-layout-0.png'),
                         ),
                        //'default' => $mp_post_options['_mpgl_post_sidebar_template'],
                    ),
                    array(
                        'id' => '_mpgl_post_sidebar_source_single',
                        'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                        'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'required'  => array('_mp_sidebar_position_single', "=", array( 'left-sidebar', 'right-sidebar' )),
                        //'default' => $mp_post_options['_mpgl_post_sidebar_source'],
                        'required'  => array('_mpgl_post_sidebar_template_single', "!=", 'hide-sidebar'),
                    ),

                    array(
                        'id' => '_mpgl_post_display_author_postmeta_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Display Author Post Meta', 'Newsgamer'),
                        'subtitle' => esc_html__('Display description and social links in left column', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                         'required'  => array('_mpgl_post_layout_single', "equals", 'loop-page-7'),
                        //'default' => $mp_post_options['_mpgl_post_enable_breadcrumbs'],
                        //'default' => '1',
                    ),
                    array(
                        'id' => '_mpgl_post_enable_breadcrumbs_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Breadcrumbs', 'Newsgamer'),
                        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        //'default' => $mp_post_options['_mpgl_post_enable_breadcrumbs'],
                        //'default' => '1',
                    ),
                    array(
                        'id' => '_mpgl_post_enable_tags_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Tags after Content', 'Newsgamer'),
                        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        //'default' => '1',
                        //'default' => $mp_post_options['_mpgl_post_enable_tags'],
                    ),
                    array(
                        'id' => '_mpgl_post_enable_author_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Author Information', 'Newsgamer'),
                        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        //'default' => $mp_post_options['_mpgl_post_enable_tags'],
                        //'default' => '1',
                    ),
                    array(
                        'id' => '_mpgl_post_enable_prevnext_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Prev/Next Posts', 'Newsgamer'),
                        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        //'default' => $mp_post_options['_mpgl_post_enable_prevnext'],
                        //'default' => '1',
                    ),
                    array(
                        'id' => '_mp_post_display_via_source',
                        'type' => 'switch',
                        'title' => esc_html__('Display Via & Source', 'Newsgamer'),
                        'default' => 0,
                    ),
                    array(
                        'id' => '_mp_post_display_via_title',
                        'type' => 'text',
                        'title' => esc_html__('Via Title', 'Newsgamer'),
                        'default' => esc_html__('Via', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_post_display_via_name',
                        'type' => 'text',
                        'title' => esc_html__('Via name', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_post_display_via_link',
                        'type' => 'text',
                        'title' => esc_html__('Via URL', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_post_display_source_title',
                        'type' => 'text',
                        'title' => esc_html__('Source Title', 'Newsgamer'),
                        'default' => esc_html__('Source', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_post_display_source_name',
                        'type' => 'text',
                        'title' => esc_html__('Source name', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_post_display_source_link',
                        'type' => 'text',
                        'title' => esc_html__('Source URL', 'Newsgamer'),
                        'required'  => array('_mp_post_display_via_source', "=", '1'),
                    ),
                )
            );


            /* Post settings */
            $boxsections[] = array(
                'title' => esc_html__('Related posts boxes', 'Newsgamer'),
                'desc' => esc_html__('Your selection overrides global theme options', 'Newsgamer'),
                'icon' => 'el-icon-share',
                //'subsection' => true,
                'fields' => array(
                    array(
                        'id'        => 'related-notice-info-1',
                        'type'  => 'info',
                        'style' => 'success',
                        'title'     => esc_html__('Related posts box at the bottom', 'Newsgamer'),
                        'desc'      => esc_html__('This box will be displayed at bottom of the post, after author box (if selected).', 'Newsgamer')
                    ),
                    array(
                        'id' => '_mp_enable_related_posts_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Display related posts', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                    ),
                    array(
                        'id'        => '_mp_filter_related_posts_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Filter related posts by', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                        'options'   => array(
                            'cat' => 'Category',
                            'tag' => 'Tag',
                            ''    => 'Default'
                        ),
                        'required'  => array('_mp_enable_related_posts_single', "=", '1')
                    ),
                    array(
                        'id'        => '_mp_filter_related_posts_grid_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Display Grid', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                        'options'   => array(
                            'standard' => 'Standard',
                            'full-width' => 'Full Width',
                            ''    => 'Default'
                        ),
                        'required'  => array('_mp_enable_related_posts_single', "=", '1'),
                    ),
                    array(
                        'id' => '_mp_related_posts_title_single',
                        'type' => 'text',
                        'title' => esc_html__('Title for related posts', 'Newsgamer'),
                        'subtitle' => esc_html__('Default: "Related Posts"', 'Newsgamer'),
                        'required'  => array('_mp_enable_related_posts_single', "=", '1'),
                    ),

                    array(
                        'id'=>'_mp_related_posts_offset_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts offset', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to displace or pass over (0 for no offset)', 'Newsgamer'),
                    ),

                    array(
                        'id'        => '_mp_related_posts_sort_single',
                        'type'      => 'select',
                        'title'     => esc_html__('Sort order', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                        'options'   => array(
                            'date' => 'Latest',
                            'rand' => 'Random posts',
                            'name' => 'By name',
                            'modified' => 'Last Modified',
                            'comment_count' => 'Most Commented',
                            'meta_value_num' => 'Most Viewed',
                        ),
                        'required'  => array('_mp_enable_related_posts', "=", '1'),
                    ),
                    array(
                        'id'        => 'related-notice-info-2_single',
                        'type'  => 'info',
                        'style' => 'warning',
                        'title'     => esc_html__('Related posts box on the side', 'Newsgamer'),
                        'desc'      => esc_html__('This box will be displayed after post title.', 'Newsgamer')
                    ),
                    array(
                        'id' => '_mp_enable_related_box_single',
                        'type' => 'button_set',
                        'title' => esc_html__('Display related box', 'Newsgamer'),
                        'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_count_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Number of sections', 'Newsgamer'),
                        'subtitle'  => esc_html__('Number of sections in related box', 'Newsgamer'),
                        'desc'  => esc_html__('How many sections you want to have in related box', 'Newsgamer'),
                        'options'   => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '' => 'Default',
                            //'5' => '5',
                        ),
                        'required'  => array('_mp_enable_related_box_single', "=", '1'),
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_float_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Show box on', 'Newsgamer'),
                        'subtitle'  => esc_html__('Where to display related box', 'Newsgamer'),
                        'options'   => array(
                            'pull-left' => 'On left side',
                            'pull-right' => 'On right side',
                            '' => 'Default',
                        ),
                        'required'  => array('_mp_enable_related_box_single', "=", '1'),
                    ),

                    // First section
                    array(
                        'id'        => 'related-box-info-1_single',
                        'type'  => 'info',
                        'title'     => esc_html__('First section data', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),
                    array(
                        'id' => '_mp_enable_related_box_title_1_single',
                        'type' => 'text',
                        'title' => esc_html__('Section title', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_format_1_single',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Section format', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                        'options'   => array(
                            'image' => 'Image',
                            'date' => 'Date'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_filter_1_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                        'options'   => array(
                            'cat' => 'Category',
                            'tag' => 'Tag'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),


                     array(
                        'id'=>'_mp_enable_related_box_count_1_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts count', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),

                    array(
                        'id'=>'_mp_enable_related_box_offset_1_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts offset', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to displace or pass over (0 for no offset)', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),

                    array(
                        'id'        => '_mp_enable_related_box_sort_1_single',
                        'type'      => 'select',
                        'title'     => esc_html__('Sort order', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                        'options'   => array(
                            'date' => 'Latest',
                            'rand' => 'Random posts',
                            'name' => 'By name',
                            'modified' => 'Last Modified',
                            'comment_count' => 'Most Commented',
                            'meta_value_num' => 'Most Viewed',
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '1', '2', '3' )),
                        )
                    ),

                    // Second section
                    array(
                        'id'        => 'related-box-info-2_single',
                        'type'  => 'info',
                        'title'     => esc_html__('Second section data', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),
                    array(
                        'id' => '_mp_enable_related_box_title_2_single',
                        'type' => 'text',
                        'title' => esc_html__('Second Section title', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_format_2_single',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Section format', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                        'options'   => array(
                            'image' => 'Image',
                            'date' => 'Date'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_filter_2_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                        'options'   => array(
                            'cat' => 'Category',
                            'tag' => 'Tag'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),


                    array(
                        'id'=>'_mp_enable_related_box_count_2_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts count', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),

                    array(
                        'id'=>'_mp_enable_related_box_offset_2_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts offset', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to displace or pass over (0 for no offset)', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),

                    array(
                        'id'        => '_mp_enable_related_box_sort_2_single',
                        'type'      => 'select',
                        'title'     => esc_html__('Sort order', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                        'options'   => array(
                            'date' => 'Latest',
                            'rand' => 'Random posts',
                            'name' => 'By name',
                            'modified' => 'Last Modified',
                            'comment_count' => 'Most Commented',
                            'meta_value_num' => 'Most Viewed',
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", array( '2', '3' )),
                        )
                    ),

                    // Third section
                    array(
                        'id'        => 'related-box-info-3_single',
                        'type'  => 'info',
                        'title'     => esc_html__('Third section data', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),
                    array(
                        'id' => '_mp_enable_related_box_title_3_single',
                        'type' => 'text',
                        'title' => esc_html__('Third Section title', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_format_3_single',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Section format', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to format post layout', 'Newsgamer'),
                        'options'   => array(
                            'image' => 'Image',
                            'date' => 'Date'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),
                    array(
                        'id'        => '_mp_enable_related_box_filter_3_single',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Filter related box by', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to filter related posts', 'Newsgamer'),
                        'options'   => array(
                            'cat' => 'Category',
                            'tag' => 'Tag'
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),

                    array(
                        'id'=>'_mp_enable_related_box_count_3_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts count', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to show', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),

                    array(
                        'id'=>'_mp_enable_related_box_offset_3_single',
                        'type' => 'slider',
                        'title' => esc_html__('Posts offset', 'Newsgamer'),
                        "default" => "0",
                        "min" 	=> "0",
                        "step"	=> "1",
                        "max" 	=> "30",
                        'desc' => esc_html__('Number of post to displace or pass over (0 for no offset)', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),


                    array(
                        'id'        => '_mp_enable_related_box_sort_3_single',
                        'type'      => 'select',
                        'title'     => esc_html__('Sort order', 'Newsgamer'),
                        'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                        'options'   => array(
                            'date' => 'Latest',
                            'rand' => 'Random posts',
                            'name' => 'By name',
                            'modified' => 'Last Modified',
                            'comment_count' => 'Most Commented',
                            'meta_value_num' => 'Most Viewed',
                        ),
                        'required'  => array (
                            array('_mp_enable_related_box_single', "=", '1'),
                            array('_mp_enable_related_box_count_single', "=", '3' ),
                        )
                    ),
                )
            );


            $boxsections[] = array(
                'title' => esc_html__('Review post settings', 'Newsgamer'),
                'icon' => 'el-icon-star-empty',
                'fields' => array(
                    array(
                        'id' => '_mp_enable_review_post',
                        'type' => 'button_set',
                        'title' => esc_html__('Display review', 'Newsgamer'),
                        'options'   => array(
                            'enable' => 'Enable',
                            'disable' => 'Disable'
                        ),
                        'default' => 'disable',
                    ),
                    array(
                        'id' => '_mp_review_post_position',
                        'type' => 'button_set',
                        'title' => esc_html__('Review box position', 'Newsgamer'),
                        'desc' => esc_html__('If you are using custom position then please use <strong>[review]</strong> shortcode to place the review box in any place within post content', 'Newsgamer'),
                        'options'   => array(
                            'top' => 'Top of the post',
                            'bottom' => 'Bottom of the post',
                            'custom' => 'Custom position'
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_position_global']) ? $mp_post_options['_mp_review_post_position_global'] : '' ),
                        'required'  => array('_mp_enable_review_post', "=", 'enable'),
                    ),
                    array(
                        'id'        => '_mp_review_post_style',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Review style', 'Newsgamer'),
                        'options'   => array(
                            'percentage' => 'Percentage',
                            'points' => 'Points',
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_style_global']) ? $mp_post_options['_mp_review_post_style_global'] : '' ),
                        'required'  => array('_mp_enable_review_post', "=", 'enable'),
                    ),

                    array(
                        'id'        => '_mp_review_post_summary_type',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Review summary type', 'Newsgamer'),
                        'subtitle'  => esc_html__('How to display review summary', 'Newsgamer'),
                        'options'   => array(
                            'summ' => 'Summary box',
                            'good-bad' => 'The Good / The Bad boxes',
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_summary_type_global']) ? $mp_post_options['_mp_review_post_summary_type_global'] : '' ),
                        'required'  => array('_mp_enable_review_post', "=", 'enable'),
                    ),
                    array(
                        'id'        => '_mp_review_post_summary_text',
                        'type'      => 'editor',
                        'title'     => esc_html__('Review summary', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_summary_type', "=", 'summ' ),
                        )
                    ),
                    array(
                        'id'        => '_mp_review_post_summary_text_good',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Review summary (The Good)', 'Newsgamer'),
                        'desc'     => esc_html__('Hit enter for line breaks. It will be replaced with a list.', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_summary_type', "=", 'good-bad' ),
                        )
                    ),
                    array(
                        'id'        => '_mp_review_post_summary_text_bad',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Review summary (The Bad)', 'Newsgamer'),
                        'desc'     => esc_html__('Hit enter for line breaks. It will be replaced with a list.', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_summary_type', "=", 'good-bad' ),
                        )
                    ),
                    array(
                        'id'        => '_mp_review_post_total_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Text appears under the total score', 'Newsgamer'),
                        'required'  => array('_mp_enable_review_post', "=", 'enable'),
                    ),

                    array(
                        'id'        => '_mp_review_post_criteria_count',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Number of criterias', 'Newsgamer'),
                        'subtitle'  => esc_html__('Size of a review', 'Newsgamer'),
                        'desc'  => esc_html__('How many criteria fields you want to have', 'Newsgamer'),
                        'options'   => array(
                            '0' => '0',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_count_global']) ? $mp_post_options['_mp_review_post_criteria_count_global'] : 0),
                        'required'  => array('_mp_enable_review_post', "=", 'enable'),
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_value_0',
                        'type'          => 'slider',
                        'title'         => esc_html__('#0 - Review value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('0') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_1',
                        'type'          => 'text',
                        'title'         => esc_html__('#1 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('1', '2', '3', '4', '5', '6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_1_global']) ? $mp_post_options['_mp_review_post_criteria_1_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_1',
                        'type'          => 'slider',
                        'title'         => esc_html__('#1 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('1', '2', '3', '4', '5', '6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_2',
                        'type'          => 'text',
                        'title'         => esc_html__('#2 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('2', '3', '4', '5', '6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_2_global']) ? $mp_post_options['_mp_review_post_criteria_2_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_2',
                        'type'          => 'slider',
                        'title'         => esc_html__('#2 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('2', '3', '4', '5', '6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_3',
                        'type'          => 'text',
                        'title'         => esc_html__('#3 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('3', '4', '5', '6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_3_global']) ? $mp_post_options['_mp_review_post_criteria_3_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_3',
                        'type'          => 'slider',
                        'title'         => esc_html__('#3 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('3', '4', '5', '6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_4',
                        'type'          => 'text',
                        'title'         => esc_html__('#4 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('4', '5', '6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_4_global']) ? $mp_post_options['_mp_review_post_criteria_4_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_4',
                        'type'          => 'slider',
                        'title'         => esc_html__('#4 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('4', '5', '6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_5',
                        'type'          => 'text',
                        'title'         => esc_html__('#5 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('5', '6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_5_global']) ? $mp_post_options['_mp_review_post_criteria_5_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_5',
                        'type'          => 'slider',
                        'title'         => esc_html__('#5 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('5', '6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_6',
                        'type'          => 'text',
                        'title'         => esc_html__('#6 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('6', '7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_6_global']) ? $mp_post_options['_mp_review_post_criteria_6_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_6',
                        'type'          => 'slider',
                        'title'         => esc_html__('#6 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('6', '7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_7',
                        'type'          => 'text',
                        'title'         => esc_html__('#7 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('7', '8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_7_global']) ? $mp_post_options['_mp_review_post_criteria_7_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_7',
                        'type'          => 'slider',
                        'title'         => esc_html__('#7 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('7', '8') ),
                        )
                    ),

                    array(
                        'id'            => '_mp_review_post_criteria_8',
                        'type'          => 'text',
                        'title'         => esc_html__('#8 - Criteria name', 'Newsgamer'),
                        'desc'          => esc_html__('Name of the review criteria', 'Newsgamer'),
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('8') ),
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_criteria_8_global']) ? $mp_post_options['_mp_review_post_criteria_8_global'] : '' ),
                    ),
                    array(
                        'id'            => '_mp_review_post_criteria_value_8',
                        'type'          => 'slider',
                        'title'         => esc_html__('#8 - Criteria value', 'Newsgamer'),
                        'desc'          => esc_html__('Min: 0, max: 100, step: 1, default value: 75', 'Newsgamer'),
                        'default'       => 75,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text',
                        'required'  => array (
                            array('_mp_enable_review_post', "=", 'enable'),
                            array('_mp_review_post_criteria_count', "=", array('8') ),
                        )
                    ),
                    array(
                        'id' => '_mp_review_post_enable_user_review',
                        'type' => 'switch',
                        'title' => esc_html__('Enable User Review', 'Newsgamer'),
                        'subtitle' => esc_html__('This will enable user reviews', 'Newsgamer'),
                        //'default'  => 0,
                        'default' => ( isset($mp_post_options['_mp_review_post_enable_user_review_global']) ? $mp_post_options['_mp_review_post_enable_user_review_global'] : '' ),
                    ),
                    array(
                        'id' => '_mp_review_post_enable_user_review_role',
                        'type' => 'button_set',
                        'title' => esc_html__('Who can add the review?', 'Newsgamer'),
                        'subtitle' => esc_html__('Select roles for this action', 'Newsgamer'),
                        'options'   => array(
                            'users' => 'Registered Users',
                            'guests' => 'Guests',
                            'both' => 'Both',
                        ),
                        'default' => ( isset($mp_post_options['_mp_review_post_enable_user_review_role_global']) ? $mp_post_options['_mp_review_post_enable_user_review_role_global'] : '' ),
                        'required'  => array (
                            array('_mp_review_post_enable_user_review', "=", 1 ),
                        )
                    ),


                )
            );


            $boxsections[] = array(
                'title' => esc_html__('Audio post settings', 'Newsgamer'),
                'icon' => 'el-icon-music',
                'fields' => array(
                    array(
                        'id' => '_mp_featured_audio_embed',
                        'type' => 'textarea',
                        'title' => esc_html__('Audio embed', 'Newsgamer'),
                        'desc' => esc_html__('Paste an embed link and it will be embeded in the post instead of featured image', 'Newsgamer')
                    ),
                    array(
                        'id' => '_mp_featured_audio_title',
                        'type' => 'text',
                        'title' => esc_html__('Audio title', 'Newsgamer')
                    ),
                    array(
                        'id' => '_mp_featured_audio_author',
                        'type' => 'text',
                        'title' => esc_html__('Audio author', 'Newsgamer')
                    ),
                )
            );

            $boxsections[] = array(
                'title' => esc_html__('Video post settings', 'Newsgamer'),
                'icon' => 'el-icon-video',
                'fields' => array(
                    array(
                        'id' => '_mp_featured_video',
                        'type' => 'text',
                        'title' => esc_html__('Video URL', 'Newsgamer'),
                        'desc' => esc_html__('Paste a link from Youtube, Vimeo or Dailymotion and it will be embeded in the post instead of featured image. This has higher prioriry than embed code.', 'Newsgamer')
                    ),
                    array(
                        'id'       => '_mp_featured_video_overwrite_thumbnail',
                        'type'     => 'switch',
                        'title'    => esc_html__('Overwrite thumbnail', 'Newsgamer'),
                        'subtitle' => esc_html__('Do you want to overwrite thumbnail if exist with video thumbnail?', 'Newsgamer'),
                        'default'  => false,
                    ),
                    array(
                        'id' => '_mp_featured_video_embed',
                        'type' => 'textarea',
                        'title' => esc_html__('Video embed', 'Newsgamer'),
                        'desc' => esc_html__('Paste an embed link and it will be embeded in the post instead of featured image', 'Newsgamer')
                    )
                )
            );

            $boxsections[] = array(
                'title' => esc_html__('Ads System', 'Newsgamer'),
                'icon' => 'el-icon-network',
                'fields' => array(
                    array(
                        'id' 	=> '_mp_ads_posts_top_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Top Ad', 'Newsgamer'),
                        'subtitle' => esc_html__('Below the header', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_top']) ? $mp_post_options['_mp_ads_posts_top'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_section_1_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Post Ad 1', 'Newsgamer'),
                        'subtitle' => esc_html__('Before the post', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_section_1']) ? $mp_post_options['_mp_ads_posts_section_1'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_section_2_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Post Ad 2', 'Newsgamer'),
                        'subtitle' => esc_html__('Before post content (after image)', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_section_2']) ? $mp_post_options['_mp_ads_posts_section_2'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_section_3_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Post Ad 3', 'Newsgamer'),
                        'subtitle' => esc_html__('After the post', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_section_3']) ? $mp_post_options['_mp_ads_posts_section_3'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_wall_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_wall']) ? $mp_post_options['_mp_ads_posts_wall'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_side_left_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_side_left']) ? $mp_post_options['_mp_ads_page_side_left'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_posts_side_right_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mp_post_options['_mp_ads_posts_side_right']) ? $mp_post_options['_mp_ads_posts_side_right'] : '' ),
                    ),
                )
            );




            $metaboxes[] = array(
                'id' => 'post_options',
                'title' => esc_html__('Post Options', 'Newsgamer'),
                'post_types' => array('post'),
                'position' => 'normal', // normal, advanced, side
                'priority' => 'high', // high, core, default, low
                'sections' => $boxsections
            );

            return $metaboxes;
      }
      add_action('redux/metaboxes/'.$opt_name.'/boxes', 'redux_add_posts_metaboxes');
    endif;


    if ( !function_exists( "redux_add_pages_metaboxes" ) ):
        function redux_add_pages_metaboxes($metaboxes) {

            $mp_post_options    = get_option('mipthemeoptions_framework');
            $redux_url          = ReduxFramework::$_url;

            $boxsections[] = array(
                'title' => esc_html__('Page Settings', 'Newsgamer'),
                'icon' => 'el-icon-file-edit',
                'desc' => esc_html__('This options overides your global settings.', 'Newsgamer'),
                'fields' => array(
                        array(
                        'id' => '_mpgl_page_layout_single',
                        'type' => 'image_select',
                        'title' => esc_html__('Page layout', 'Newsgamer'),
                        'subtitle' => esc_html__('Select layout for this page.', 'Newsgamer'),
                        'options' => array(
                            'loop-page-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/page-layout-1.png'),
                            'loop-page-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/page-layout-2.png'),
                            'loop-page-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/page-layout-3.png'),
                            'loop-page-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/page-layout-4.png'),
                            'loop-page-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/page-layout-5.png'),
                            'loop-page-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/page-layout-6.png'),
                            'loop-page-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/page-layout-8.png'),
                            'loop-page-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/page-layout-9.png'),
                            ''            => array('alt' => 'Layout 0', 'img' => get_template_directory_uri(). '/images/redux/page-layout-0.png'),
                            //'loop-page-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/page-layout-7.png'),
                        ),
                        'default' => $mp_post_options['_mpgl_page_layout'],
                    ),
                    array(
             			'id' => '_mpgl_page_layout_single_image_format',
             			'type' => 'select',
             			'title' => esc_html__('Image size', 'Newsgamer'),
             			'subtitle' => esc_html__('Set dimensions via "Settings > Media"', 'Newsgamer'),
                       'options'  => array(
                           'thumbnail' => 'Thumbnail size',
                           'medium' => 'Medium size',
                           'large' => 'Large size'
                       ),
                       'default'  => 'medium',
             			'required'  => array (
             			    array('_mpgl_page_layout_single', "=", array('loop-page-8', 'loop-page-9') ),
             			)
       	            ),
                    array(
                        'id' => '_mpgl_page_layout_single_image_height',
                        'type' => 'button_set',
                        'title' => esc_html__('Show full image height', 'Newsgamer'),
                        'subtitle' => esc_html__('Fit only horizontally', 'Newsgamer'),
                        'options' => array(
                            '1' => 'On',
                            '0' => 'Off',
                            '' => 'Default'
                         ),
                        'required'  => array (
                            array('_mpgl_page_layout_single', "=", array('loop-page-2', 'loop-page-3', 'loop-page-4') ),
                        )
                    ),
                    array(
                        'id' => '_mpgl_page_sidebar_template_single',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar position', 'Newsgamer'),
                        'subtitle' => esc_html__('Select main sidebar position for this page.', 'Newsgamer'),
                        'options' => array(
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => $redux_url.'/assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => $redux_url.'/assets/img/2cr.png'),
                            'hide-sidebar' => array('alt' => 'No Sidebar', 'img' => $redux_url.'/assets/img/1c.png'),
                            ''            => array('alt' => 'Sidebar default', 'img' => get_template_directory_uri(). '/images/redux/sidebar-layout-0.png'),
                         ),
                        'default' => $mp_post_options['_mpgl_page_sidebar_template'],
                    ),

                    /*array(
                        'id' => '_mpgl_page_sidebar_source_single_middle',
                        'title' => esc_html__( 'Choose default middle/left sidebar', 'Newsgamer' ),
                        'desc' => 'Please select the sidebar you would like to display on this page (max 160px content).',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'default' => $mipthemeoptions_framework['_mp_page_sidebar_source_middle'],
                        'required'  => array('_mp_page_sidebar_position_single', "=", array('multi-sidebar', 'multi-sidebar mid-left')),
                    ),*/

                    array(
                        'id' => '_mpgl_page_sidebar_source_single',
                        'title' => esc_html__( 'Select default sidebar', 'Newsgamer' ),
                        'desc' => 'Please select the sidebar you would like to display on this page (max 300px content).',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'default' => ( isset($mp_post_options['_mpgl_page_sidebar_source']) ? $mp_post_options['_mpgl_page_sidebar_source'] : '' ),
                        'required'  => array('_mpgl_page_sidebar_template_single', "!=", 'hide-sidebar'),
                    ),

                    array(
                        'id' => '_mpgl_page_unique_articles',
                        'type' => 'switch',
                        'title' => esc_html__('Enable unique posts', 'Newsgamer'),
                        'default' => 0,
                    ),

                    /*array(
                        'id' => '_mp_page_breakingnews_enable',
                        'type' => 'switch',
                        'title' => esc_html__('Display News Scroller', 'Newsgamer'),
                        'default' => 0,
                    ),
                    (
                        ( (bool)$mipthemeoptions_framework['_mp_header_show_quicklinks'] ) ?
                            array(
                                'id' => '_mp_page_header_quicklinks_menu',
                                'type' => 'select',
                                'title' => esc_html__('Select Quicklinks Menu', 'Newsgamer'),
                                'subtitle' => esc_html__('Select what menu to display as quicklinks', 'Newsgamer'),
                                'desc' => esc_html__('', 'Newsgamer'),
                                'data' => 'menus',
                            )
                        :
                            array(
                                'id' => '_mp_divider_page',
                                'type' => 'divide',
                            )
                    )*/
                )
            );

            $boxsections[] = array(
                'title'            => esc_html__( 'Top Grid', 'Newsgamer' ),
                'id'               => '_mp_page_topgrid_settings',
                'fields'           => array(
                   array(
                       'id' => '_mpgl_page_top_grid_enable',
                       'type' => 'button_set',
                       'title' => esc_html__('Enable Top Grid', 'Newsgamer'),
                       'options' => array(
                           0 => 'Disable',
                           1 => 'Enable',
                           2 => 'Shortcode'
                        ),
                       'default' => 0
                   ),
                   array(
                       'id' => '_mpgl_page_top_grid_shortcode',
                       'type' => 'text',
                       'title' => esc_html__('Top Grid Shortcode', 'Newsgamer'),
                       'required'  => array('_mpgl_page_top_grid_enable', "equals", 2)
                   ),
                   array(
                        'id'        => '_mpgl_page_top_grid_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Grid layout', 'Newsgamer'),
                        'subtitle'  => esc_html__('Select layout for your grid', 'Newsgamer'),
                        'options' => array(
                           'top-grid-layout-1' => array('alt' => 'Layout 1', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-1.png'),
                           'top-grid-layout-2' => array('alt' => 'Layout 2', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-2.png'),
                           'top-grid-layout-3' => array('alt' => 'Layout 3', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-3.png'),
                           'top-grid-layout-4' => array('alt' => 'Layout 4', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-4.png'),
                           'top-grid-layout-5' => array('alt' => 'Layout 5', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-5.png'),
                           'top-grid-layout-6' => array('alt' => 'Layout 6', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-6.png'),
                           'top-grid-layout-7' => array('alt' => 'Layout 7', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-7.png'),
                           'top-grid-layout-8' => array('alt' => 'Layout 8', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-8.png'),
                           'top-grid-layout-9' => array('alt' => 'Layout 9', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-9.png'),
                           'top-grid-layout-10' => array('alt' => 'Layout 10', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-10.png'),
                           'top-grid-layout-11' => array('alt' => 'Layout 11', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-11.png'),
                           'top-grid-layout-12' => array('alt' => 'Layout 12', 'img' => get_template_directory_uri(). '/images/redux/grid-layout-12.png'),
                        ),
                        'default'   => 'top-grid-layout-1',
                        'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                   ),
                   array(
                       'id' => '_mpgl_page_top_grid_full_width',
                       'type' => 'button_set',
                       'title' => esc_html__('Enable Full width layout', 'Newsgamer'),
                       'subtitle'  => esc_html__('Full width container', 'Newsgamer'),
                       'options' => array(
                            'on' => 'On',
                            'off' => 'Off',
                         ),
                        //'default' => 'on',
                       'required'  => array(array('_mpgl_page_top_grid_enable', "equals", 1), array('_mpgl_page_top_grid_layout', "!=", 'top-grid-layout-9'))
                   ),
                   array(
                       'id' => '_mpgl_page_top_grid_verge_style',
                       'type' => 'button_set',
                       'title' => esc_html__('Enable "Verge" styling', 'Newsgamer'),
                       'subtitle'  => esc_html__('Colourful backgrounds', 'Newsgamer'),
                       'options' => array(
                            'on' => 'On',
                            'off' => 'Off',
                        ),
                       'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                   ),
                   array(
                       'id'       => '_mpgl_page_top_grid_postmeta_elements',
                       'type'     => 'checkbox',
                       'title'    => esc_html__('What to display in Post Meta', 'Newsgamer'),
                       'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                       'options'  => array(
                           'date' => 'Post Date',
                           'author' => 'Author',
                           'category' => 'Categories',
                           'comments' => 'Comments',
                           'views' => 'Views',
                       ),
                       'default'  => array(
                           'date' => '1',
                           'author' => '0',
                           'category' => '1',
                           'comments' => '1',
                           'views' => '0',
                       ),
                       'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                   ),
                   array(
                    'id'        => '_mpgl_page_top_grid_sort',
                    'type'      => 'select',
                    'title'     => esc_html__('Sort order', 'Newsgamer'),
                    'subtitle'  => esc_html__('Choose how to sort your posts', 'Newsgamer'),
                    'options'   => array(
                        'date' => 'Latest',
                        'rand' => 'Random posts',
                        'name' => 'By name',
                        'type' => 'By Post Type',
                        'modified' => 'Last Modified',
                        'comment_count' => 'Most Commented',
                    ),
                    'default'   => 'date',
                    'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                ),
                array(
                    'id' => '_mpgl_page_top_grid_categories',
                    'type' => 'select',
                    'data'      => 'categories',
                    'multi'     => true,
                    'sortable'   => true,
                    'title' => esc_html__('Show categories', 'Newsgamer'),
                    'subtitle'  => esc_html__('If none is selected, all categories are included by default', 'Newsgamer'),
                    'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                ),
                array(
                    'id' => '_mpgl_page_top_grid_tags',
                    'type' => 'select',
                    'data'      => 'tags',
                    'multi'     => true,
                    'sortable'   => true,
                    'title' => esc_html__('Filter by tag slug', 'Newsgamer'),
                    'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                ),
                array(
                    'id' => '_mpgl_page_top_grid_posttype',
                    'type' => 'select',
                    'data'      => 'post_type',
                    'multi'     => true,
                    'sortable'   => true,
                    'title' => esc_html__('Filter by post type', 'Newsgamer'),
                    'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                ),
                array(
                    'id' => '_mpgl_page_top_grid_category_display',
                    'type' => 'button_set',
                    'title' => esc_html__('Display Category labels as', 'Newsgamer'),
                    'subtitle' => esc_html__('This option only affects posts.', 'Newsgamer'),
                    'options'   => array(
                        'root' => 'Root Categories',
                        'sub' => 'Sub Categories'
                    ),
                    'default' => 'root',
                    'required'  => array('_mpgl_page_top_grid_enable', "equals", 1)
                ),
            ),
            );

            $boxsections[] = array(
                'title' => esc_html__('Video page settings', 'Newsgamer'),
                'icon' => 'el-icon-video',
                'fields' => array(
                    array(
                        'id' => '_mp_page_featured_video',
                        'type' => 'text',
                        'title' => esc_html__('Video URL', 'Newsgamer'),
                        'desc' => esc_html__('Paste a link from Youtube, Vimeo or Dailymotion and it will be embeded in the post instead of featured image. This has higher prioriry than embed code.', 'Newsgamer')
                    ),
                    array(
                        'id'       => '_mp_featured_video_overwrite_thumbnail',
                        'type'     => 'switch',
                        'title'    => esc_html__('Overwrite thumbnail', 'Newsgamer'),
                        'subtitle' => esc_html__('Do you want to overwrite thumbnail if exist with video thumbnail?', 'Newsgamer'),
                        'default'  => false,
                    ),
                    array(
                        'id' => '_mp_page_featured_video_embed',
                        'type' => 'textarea',
                        'title' => esc_html__('Video embed', 'Newsgamer'),
                        'desc' => esc_html__('Paste an embed link and it will be embeded in the post instead of featured image.', 'Newsgamer')
                    ),
                )
            );


            $boxsections[] = array(
                'title' => __('Menu settings', 'Newsgamer'),
                'icon' => 'el-icon-hand-up',
                'fields' => array(
                    array(
                        'id' => '_mp_page_menu_header_top',
                        'title' => __('Top Menu location', 'Newsgamer'),
                        'type' => 'select',
            			'data' => 'menus',
                        'subtitle' => __('Above logo', 'Newsgamer'),
                    ),
                    array(
                        'id' => '_mp_page_menu_header_main',
                        'title' => __('Main Menu location', 'Newsgamer'),
                        'type' => 'select',
            			'data' => 'menus',
                        'subtitle' => __('Below logo', 'Newsgamer'),
                    ),
                )
            );


            $boxsections[] = array(
                'title' => esc_html__('Ads System', 'Newsgamer'),
                'icon' => 'el-icon-network',
                'fields' => array(
                    array(
                        'id' 	=> '_mp_ads_page_top_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Top Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mipthemeoptions_framework['_mp_ads_page_top']) ? $mipthemeoptions_framework['_mp_ads_page_top'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_page_wall_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Wallpaper Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'wall-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mipthemeoptions_framework['_mp_ads_page_wall']) ? $mipthemeoptions_framework['_mp_ads_page_wall'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_page_side_left_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Left Side Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mipthemeoptions_framework['_mp_ads_page_side_left']) ? $mipthemeoptions_framework['_mp_ads_page_side_left'] : '' ),
                    ),
                    array(
                        'id' 	=> '_mp_ads_page_side_right_single',
                        'type' 	=> 'select',
                        'title' => esc_html__('Right Side Ad', 'Newsgamer'),
                        'data'  => 'posts',
                        'args'	=> array( 'post_type' => 'mp_ads', 'meta_value' => 'side-display', 'posts_per_page' => -1 ),
                        'default' => ( isset($mipthemeoptions_framework['_mp_ads_page_side_right']) ? $mipthemeoptions_framework['_mp_ads_page_side_right'] : '' ),
                    ),
                )
            );

            $metaboxes[] = array(
                'id' => 'post_options',
                'title' => esc_html__('Page Options', 'Newsgamer'),
                'post_types' => array('page'),
                'position' => 'normal', // normal, advanced, side
                'priority' => 'high', // high, core, default, low
                'sections' => $boxsections
            );

            return $metaboxes;
      }
      add_action('redux/metaboxes/'.$opt_name.'/boxes', 'redux_add_pages_metaboxes');
    endif;



     if ( !function_exists( "redux_add_ads_metaboxes" ) ):
        function redux_add_ads_metaboxes($metaboxes) {

            $boxsections[] = array(
                'title' => esc_html__('Edit Your Ad', 'Newsgamer'),
                'icon' => 'el-icon-file-edit',
                //'desc' => esc_html__('This options overides your global settings.', 'Newsgamer'),
                'fields' => array(
                    array(
                        'id' => '_mp_ads_ad_display',
                        'type' => 'button_set',
                        'title' => esc_html__('Ad Display', 'Newsgamer'),
                        'options'   => array(
                            'standard-display' => 'Standard Ad',
                            'mobile-display' => 'Mobile Ad',
                            'wall-display' => 'Wallpaper Ad',
                            'side-display' => 'Side Ad'
                        ),
                    ),
                    array(
                        'id' => '_mp_ads_ad_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Ad Type', 'Newsgamer'),
                        'options'   => array(
                            'image' => 'Image',
                            'code' => 'Code'
                        ),
                    ),
                    array(
                        'id' => '_mp_ads_ad_size',
                        'type' => 'select',
                        'title' => esc_html__('Ad Size', 'Newsgamer'),
                        'subtitle' => esc_html__('Select your ad size', 'Newsgamer'),
                        'options'   => array(
                            '300x250' => '300 x 250 - Medium Rectangle',
                            '336x280' => '336 x 280 - Large Rectangle',
                            '728x90' => '728 x 90 - Leaderboard',
                            '160x600' => '160 x 600 - Wide Skyscraper',
                            '320x50' => '320 x 50 - Mobile Banner',
                            '234x60' => '234 x 60 - Half Banner',
                            '320x100' => '320 x 100 - Large Mobile Banner',
                            '468x60' => '468 x 60 - Banner',
                            '970x90' => '970 x 90 - Large Leaderboard',
                            '120x600' => '120 x 600 - Skyscraper',
                            '120x240' => '120 x 240 - Vertical Banner',
                            '300x600' => '300 x 600 - Large Skyscraper',
                            '250x250' => '250 x 250 - Square',
                            '200x200' => '200 x 200 - Small Square',
                            '180x150' => '180 x 150 - Small Rectangle',
                            '125x125' => '125 x 125 - Button',
                            'responsive' => 'Responsive ad unit (for google AdSence)',
                            'custom-size' => 'Custom ad size',
                        ),
                        'required'  => array('_mp_ads_ad_display', "=", 'standard-display'),
                        'default' => '',
                    ),
                    array(
                        'id' => '_mp_ads_ad_side_size',
                        'type' => 'select',
                        'title' => esc_html__('Ad Size', 'Newsgamer'),
                        'subtitle' => esc_html__('Select your ad size', 'Newsgamer'),
                        'options'   => array(
                            '160' => '160 x 600 - Wide Skyscraper',
                            '120' => '120 x 600 - Skyscraper',
                            '300' => '300 x 600 - Large Skyscraper',
                        ),
                        'required'  => array('_mp_ads_ad_display', "=", 'side-display'),
                        'default' => '',
                    ),
                    array(
                        'id' => '_mp_ads_ad_image',
                        'type' => 'media',
                        'title' => esc_html__('Top Banner image', 'Newsgamer'),
                        'required'  => array(
                            array('_mp_ads_ad_type', "=", 'image'),
                        ),
                    ),
                    array(
                        'id' => '_mp_ads_ad_url',
                        'type' => 'text',
                        'title' => esc_html__('Banner URL', 'Newsgamer'),
                        'desc' => esc_html__('Link target for image banner (e.g. http://themes.mipdesign.com)', 'Newsgamer'),
                        'required'  => array('_mp_ads_ad_type', "=", 'image'),
                    ),
                    array(
                        'id' => '_mp_ads_ad_url_target',
                        'type' => 'button_set',
                        'title' => esc_html__('URL Behaviour', 'Newsgamer'),
                        'options'   => array(
                            '_blank' => 'Open in new window',
                            '_self' => 'Open in same window'
                        ),
                        //'default' => '_blank',
                        'required'  => array('_mp_ads_ad_type', "=", 'image'),
                    ),
                    array(
                        'id' => '_mp_ads_ad_click',
                        'type' => 'text',
                        'title' => esc_html__('Banner Click Event', 'Newsgamer'),
                        'desc' => '',
                        'required'  => array('_mp_ads_ad_type', "=", 'image'),
                    ),
                    array(
                        'id' => '_mp_ads_ad_code',
                        'type' => 'textarea',
                        'title' => esc_html__('Banner Embed Code', 'Newsgamer'),
                        'required'  => array(
                            array('_mp_ads_ad_type', "=", 'code'),
                        )
                    ),
                )
            );

            $metaboxes[] = array(
                'id' => 'post_options',
                'title' => esc_html__('Ads Settings', 'Newsgamer'),
                'post_types' => array('mp_ads'),
                'position' => 'normal', // normal, advanced, side
                'priority' => 'high', // high, core, default, low
                'sections' => $boxsections
            );

            return $metaboxes;
      }
      add_action('redux/metaboxes/'.$opt_name.'/boxes', 'redux_add_ads_metaboxes');
    endif;



    if ( !function_exists( "redux_add_photo_caption_metaboxes" ) ):
        function redux_add_photo_caption_metaboxes($metaboxes) {

            $boxsections[] = array(
                'title' => '',
                'fields' => array(
                    array(
                        'id' => '_mp_featured_image_caption',
                        'type' => 'text',
                        'title' => esc_html__('Image Caption', 'Newsgamer'),
                    ),
                )
            );

            $metaboxes[] = array(
                'id' => 'caption_options',
                'title' => esc_html__('Featured Image Caption', 'Newsgamer'),
                'post_types' => array('post', 'page'),
                'position' => 'side', // normal, advanced, side
                'priority' => 'default', // high, core, default, low
                'sections' => $boxsections
            );
            return $metaboxes;
        }
        add_action('redux/metaboxes/'.$opt_name.'/boxes', 'redux_add_photo_caption_metaboxes');
    endif;

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */


    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            $args['dev_mode'] = false;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }


    function save_post_review_meta( $post_id ) {

        // Check if our nonce is set.
        if ( ! isset( $_POST['redux_metaboxes_meta_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['redux_metaboxes_meta_nonce'];
        // Verify that the nonce is valid.
        // Validate fields (if needed)
        //$plugin_options = $this->_validate_values( $plugin_options, $this->options );

        if ( ! wp_verify_nonce( $nonce, 'redux_metaboxes_meta_nonce' ) ) {
            return $post_id;
        }

        if ( isset( $_POST['mipthemeoptions_framework'] ) ) {
            $form_values    = $_POST['mipthemeoptions_framework'];
            if ( isset($form_values['_mp_enable_review_post']) ) {
                $review_enabled = $form_values['_mp_enable_review_post'];
                $criteria_count = isset($form_values['_mp_review_post_criteria_count']) ? $form_values['_mp_review_post_criteria_count'] : '';
                if ( ($review_enabled == 'enable') && $criteria_count ) {
                    $total_score = 0;
                    for ( $i = 1; $i <= $criteria_count; $i++ ) {
                        $total_score += $form_values['_mp_review_post_criteria_value_'. $i .''];
                    }
                    update_post_meta( $post_id, '_mp_review_post_total_score', sanitize_text_field( round($total_score/$criteria_count, 1) ) );
                } elseif ( ($review_enabled == 'enable') && ($criteria_count == '0') ) {
                    update_post_meta( $post_id, '_mp_review_post_total_score', sanitize_text_field( round($form_values['_mp_review_post_criteria_value_0'], 1) ) );
                }
            }
        }

    }
    add_action( 'save_post', 'save_post_review_meta' );
