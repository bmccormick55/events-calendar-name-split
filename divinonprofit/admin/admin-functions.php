<?php
/*
 * Enqueue admin stylesheet
 */
add_action('admin_enqueue_scripts', 'AGS_theme_load_wp_admin_style_theme');

function AGS_theme_load_wp_admin_style_theme() {
    wp_enqueue_style('theme_wp_admin_css', get_stylesheet_directory_uri() . '/admin/css/admin.css', '', '1.1', '');
    wp_enqueue_style('da_admin_style', get_stylesheet_directory_uri() . '/custom/custom-da-admin.css');
    wp_enqueue_style('ags-theme-addons-admin', get_stylesheet_directory_uri() . '/admin/addons/css/admin.css');
}

/*
 *  WP Dashboard Menu Items
 */

add_action('admin_menu', 'AGS_theme_admin_menu');

function AGS_theme_admin_menu() {
    add_menu_page(
        esc_html__('Divi Nonprofit', 'divi-nonprofit'),
        esc_html__('Divi Nonprofit', 'divi-nonprofit'),
        'switch_themes',
        'AGS_child_theme',
        'AGS_theme_index'
    );
    add_submenu_page(
        'ags_divipodcast',
        esc_html__('Divi Nonprofit', 'divi-nonprofit'),
        esc_html__('Theme Options', 'divi-nonprofit'),
        'switch_themes',
        'AGS_child_theme',
        'AGS_theme_index'
    );
}

/*
 * Include AGS Theme Updates
 */


add_action('after_setup_theme', 'AGS_THEME_updater');

function AGS_THEME_updater() {
    if (is_admin()) {
		
            @include(dirname(__FILE__) . '/aspen-plugin-installer/class-tgm-plugin-activation.php');
            
    }
}


/*
 * Demo importer
 */

add_filter('ags_layouts_theme_demo_data', function () {
    
    return array(
        'layouts'    =>
            array(
                10221 =>
                    array (
                        'name' => 'Divi Nonprofit 1.1.2',
                        'key' => 'lG6irMeQrVpKcKOSgBVFwjKvgzGIwYTm8rCXJzm278k9oUcNUE',
                    ),
            ),
        'editor'     => 'SiteImporter',
        'wplVersion' => '0.6.8',
    );
});


/*
 *  Admin Page, Demo Data Importer, Required Plugins
 */

function AGS_theme_index() {
    
    ?>
    <div id="ags-settings-container">
        <?php settings_errors(); ?>
        <div id="ags-settings">

            <div id="ags-settings-header">
                <div class="ags-settings-logo">
                    <h1><?php esc_html_e('Divi Nonprofit Child Theme', 'divi-nonprofit') ?> </h1>
                </div>
                <div id="ags-settings-header-links">
                    <a id="ags-settings-header-link-support"
                       href="https://support.aspengrovestudios.com/article/426-divi-nonprofit"
                       target="_blank"><?php esc_html_e('Documentation', 'divi-nonprofit') ?></a>
                </div>
            </div>
            <ul id="ags-settings-tabs">
                <li class="ags-settings-active"><a href="#demo-content"><?php esc_html_e('Demo Content', 'divi-nonprofit') ?></a></li>
                <li><a href="#addons"><?php esc_html_e('Add-ons', 'divi-nonprofit') ?></a></li>
                
            </ul>
            <div id="ags-settings-tabs-content">
                <div id="ags-settings-demo-content" class="ags-settings-active">
                    <div class="ags-settings-box">
                        <p>
                            <?php
                            $demo_url = 'https://divinonprofit.aspengrovestudio.com/';
                            $anchor = esc_html__('This Demo', 'divi-nonprofit');
                            $link = sprintf('<a href="%s" target="_blank" class="ags-import-demo-button button-primary">%s</a>', $demo_url, $anchor);
                            echo et_core_intentionally_unescaped(sprintf(esc_html__('Use  our built-in demo content tool. This will install the content and the design structure as shown in %1$s', 'divi-nonprofit'), $link), 'html');
                            ?>

                        </p>
                        <h3><?php esc_html_e('The items that will be imported are:', 'divi-nonprofit') ?></h3>
                        <ol>
                            <li><?php esc_html_e('Demo text content', 'divi-nonprofit') ?></li>
                            <li><?php esc_html_e('Placeholder media files', 'divi-nonprofit') ?></li>
                            <li><?php esc_html_e('Navigation Menu ', 'divi-nonprofit') ?></li>
                            <li><?php esc_html_e('Demo posts, pages and products ', 'divi-nonprofit') ?></li>
                            <li><?php esc_html_e('Site widgets (if applicable)', 'divi-nonprofit') ?></li>
                        </ol>

                        <h3><?php esc_html_e('Please note: ', 'divi-nonprofit') ?></h3>
                        <ol>
                            <li><?php esc_html_e('No WordPress settings will be imported.', 'divi-nonprofit') ?></li>
                            <li><?php esc_html_e('No existing posts, pages, products, images, categories or any data will be modified or deleted.', 'divi-nonprofit') ?>  </li>
                            <li><?php esc_html_e('The importer will install only placeholder images showing their usage dimension. You can refer to our demo site and replace the placeholder with your own images.', 'divi-nonprofit') ?></li>
                        </ol>

                        <?php
                        // Check if WP Layouts plugin is active
                        // returns true if active
                        $wpl_status = in_array('wp-layouts/ags-layouts.php', apply_filters('active_plugins', get_option('active_plugins')));

                        if (!$wpl_status) {
                            echo '<div class="ags-settings-notice"> <p>';
                            // Translators: %s - links tag
                            printf(esc_html__('To import demo data, install and activate the latest version of the %sWP Layouts%s plugin', 'divi-nonprofit'),
                                '<a href="themes.php?page=tgmpa-install-plugins&plugin_status=activate">',
                                '</a>'
                            );
                            echo '</p></div>';
                        }
                        ?>

                        <button class="button-primary ags-import-demo-button" onclick="location.href='admin.php?page=ags-layouts-demo-import'" type="button" <?php echo $wpl_status ? '' : 'disabled' ?>><?php esc_html_e('Import Demo Data', 'divi-nonprofit') ?></button>
                    </div>
                </div>

                <!-- ADDONS -->
                <div id="ags-settings-addons">
                    <?php
                    define('AGS_THEME_ADDONS_URL', 'https://divi.space/wp-content/uploads/product-addons/divinonprofit.json');
                    require_once(dirname(__FILE__) . '/addons/addons.php');
                    AGS_Theme_Addons::outputList();
                    ?>
                </div>

                

            </div> <!-- close ags-settings-tabs-content -->
            <script>
                var ags_tabs_navigate = function () {
                    jQuery('#ags-settings-tabs-content > div, #ags-settings-tabs > li').removeClass('ags-settings-active');
                    jQuery('#ags-settings-' + location.hash.substr(1)).addClass('ags-settings-active');
                    jQuery('#ags-settings-tabs > li:has(a[href="' + location.hash + '"])').addClass('ags-settings-active');
                };
                if (location.hash) {
                    ags_tabs_navigate();
                }
                jQuery(window).on('hashchange', ags_tabs_navigate);
            </script>
        </div> <!-- close ags-settings -->
    </div> <!-- close ags-settings-container -->
    <?php
}

add_action('admin_init', 'AGS_theme_options');

function AGS_theme_options() {
    register_setting(
        'AGS_theme_front_page_option',
        'AGS_theme_front_page_option'
    );
    add_settings_section(
        'AGS_theme_front_page',
        esc_html__('Import Demo Data', 'divi-nonprofit'),
        '',
        'AGS_theme_front_page_option'
    );
}


// List of required plugins
add_action('tgmpa_register', 'AGS_theme_require_plugins');

function AGS_theme_require_plugins() {
    

    $plugins = array(
        array(
            'name'               => 'GiveWP – Donation Plugin and Fundraising Platform',
            'slug'               => 'give',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'WooCommerce',
            'slug'               => 'woocommerce',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'Breadcrumb NavXT',
            'slug'               => 'breadcrumb-navxt',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'WP-PageNavi',
            'slug'               => 'wp-pagenavi',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'The Events Calendar',
            'slug'               => 'the-events-calendar',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'The Events Calendar Shortcode',
            'slug'               => 'the-events-calendar-shortcode',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'Shortcodes for Divi',
            'slug'               => 'shortcodes-for-divi',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false
        ),
        array(
            'name'               => 'WP Layouts',
            'slug'               => 'wp-layouts',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false
        )
    );
    tgmpa($plugins);
}