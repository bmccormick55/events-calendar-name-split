<?php

define('AGS_THEME_DIRECTORY', dirname(__FILE__) . '/');
define('AGS_THEME_VERSION', isset( $_SERVER['HTTP_HOST'] ) && 1 === preg_match( '/llrs\.org$/', $_SERVER['HTTP_HOST'] ) ? wp_get_theme()->get('Version') : time() );

/* Include AGS admin functions */
include(AGS_THEME_DIRECTORY . 'admin/admin-functions.php');

/*
 *  Enqueue child theme stylesheets
 */

function AGS_theme_configuration() {
    // Stylesheets
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_deregister_style('divi-style');
    wp_enqueue_style('divi-style', get_stylesheet_uri(), array(), AGS_THEME_VERSION);

    wp_enqueue_style('animals-style', get_stylesheet_directory_uri() . '/css/animals.css');
    wp_enqueue_style('blog-style', get_stylesheet_directory_uri() . '/css/blog.css');
    wp_enqueue_style('menu-style', get_stylesheet_directory_uri() . '/css/menu.css');
    wp_enqueue_style('footer-style', get_stylesheet_directory_uri() . '/css/footer.css');
    wp_enqueue_style('projects-style', get_stylesheet_directory_uri() . '/css/projects.css');
    wp_enqueue_style('custom-da-style', get_stylesheet_directory_uri() . '/custom/custom-da-modules.css');
    wp_enqueue_style('events-style', get_stylesheet_directory_uri() . '/css/events.css');
    wp_enqueue_style('x-feed', get_stylesheet_directory_uri() . '/css/x-feed.css');

    if (class_exists('Woocommerce')) {
        wp_enqueue_style('woo-style', get_stylesheet_directory_uri() . '/css/woocommerce.css');
    }
    // Scripts
    wp_enqueue_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js', null, null, true);

    // Slick slider
    wp_enqueue_style('slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.css');
    wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css');
    wp_enqueue_script('slick-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.js', null, null, false);
    wp_enqueue_script('slick-init', get_stylesheet_directory_uri() . '/js/slick-init.min.js');
}

add_action('wp_enqueue_scripts', 'AGS_theme_configuration');

/*
 *  Add child theme color scheme
 *
 *  Create new tab in wordpress customizer
 */

@include(AGS_THEME_DIRECTORY . 'custom/customizer_colors.php');

/*
 *  Load translations
 */

add_action('after_setup_theme', function () {
    load_child_theme_textdomain('divi-nonprofit', get_stylesheet_directory() . '/languages');
});

/*
 *  Creating custom post types
 */

add_action('init', 'ags_dnonprofit_codex_animal_init');

function ags_dnonprofit_codex_animal_init() {
    $labels = array(
        'name'               => _x('Animals', 'post type general name', 'divi-nonprofit'),
        'singular_name'      => _x('Animal', 'post type singular name', 'divi-nonprofit'),
        'menu_name'          => _x('Animals', 'admin menu', 'divi-nonprofit'),
        'name_admin_bar'     => _x('Animal', 'add new on admin bar', 'divi-nonprofit'),
        'add_new'            => _x('Add New', 'animal', 'divi-nonprofit'),
        'add_new_item'       => __('Add New Animal', 'divi-nonprofit'),
        'new_item'           => __('New Animal', 'divi-nonprofit'),
        'edit_item'          => __('Edit Animal', 'divi-nonprofit'),
        'view_item'          => __('View Animal', 'divi-nonprofit'),
        'all_items'          => __('All Animals', 'divi-nonprofit'),
        'search_items'       => __('Search Animals', 'divi-nonprofit'),
        'parent_item_colon'  => __('Parent Animals:', 'divi-nonprofit'),
        'not_found'          => __('No animals found.', 'divi-nonprofit'),
        'not_found_in_trash' => __('No animals found in Trash.', 'divi-nonprofit')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'can_export'         => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'has_archive'        => true,
        'rewrite'            => apply_filters('et_animals_posttype_rewrite_args', array(
            'feeds'      => true,
            'slug'       => 'animal',
            'with_front' => false,
        )),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'author', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
    );

    register_post_type('animal', apply_filters('et_project_animal_args', $args));
}

/*
 *  Creating custom taxonomies
 */

add_action('init', 'ags_dnonprofit_create_animals_taxonomies', 0);

function ags_dnonprofit_create_animals_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('Animal Categories', 'taxonomy general name', 'divi-nonprofit'),
        'singular_name'     => _x('Animal Category', 'taxonomy singular name', 'divi-nonprofit'),
        'search_items'      => __('Search Animal Categories', 'divi-nonprofit'),
        'all_items'         => __('All Animal Categories', 'divi-nonprofit'),
        'parent_item'       => __('Parent Animal Category', 'divi-nonprofit'),
        'parent_item_colon' => __('Parent Animal Category:', 'divi-nonprofit'),
        'edit_item'         => __('Edit Animal Category', 'divi-nonprofit'),
        'update_item'       => __('Update Animal Category', 'divi-nonprofit'),
        'add_new_item'      => __('Add New Animal Category', 'divi-nonprofit'),
        'new_item_name'     => __('New Animal Category Name', 'divi-nonprofit'),
        'menu_name'         => __('Categories', 'divi-nonprofit'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'animal_category'),
    );

    register_taxonomy('animal_category', array('animal'), $args);
}

/*
 *  Include custom modules
 */

add_action('et_builder_ready', 'ags_dnonprofit_initialize_custom_modules');

function ags_dnonprofit_initialize_custom_modules() {
    // Don't attempt to load if Builder Module parent class is not available
    if (!class_exists('ET_Builder_Module')) {
        return;
    }

    include(__DIR__ . '/custom/animal-carousel-module.php');
}

/*
 *  Add meta boxes
 */

include 'metabox.php';

/*
 *  Register new sidebars
 */

function ags_dnonprofit_register_new_widget() {
    register_sidebar(array(
        'name'          => esc_html__('Animals Archive Sidebar', 'divi-nonprofit'),
        'id'            => 'ags_dnp_animals_archive_sidebar',
        'description'   => esc_html__('Widgets in this area will be shown on all animals archives.', 'divi-nonprofit'),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Single Animal Sidebar', 'divi-nonprofit'),
        'id'            => 'ags_dnp_animal_single_sidebar',
        'description'   => esc_html__('Widgets in this area will be shown on single animal page.', 'divi-nonprofit'),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Projects Archive Sidebar', 'divi-nonprofit'),
        'id'            => 'ags_dnp_projects_archive_sidebar',
        'description'   => esc_html__('Widgets in this area will be shown on all project archives.', 'divi-nonprofit'),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Single Project Sidebar', 'divi-nonprofit'),
        'id'            => 'ags_dnp_project_single_sidebar',
        'description'   => esc_html__('Widgets in this area will be shown on single project page.', 'divi-nonprofit'),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('WooCommerce Sidebar', 'divi-nonprofit'),
        'id'            => 'ags_dnp_woocommerce_sidebar',
        'description'   => esc_html__('This is the WooCommerce sidebar.', 'divi-nonprofit'),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
}

add_action('widgets_init', 'ags_dnonprofit_register_new_widget');

/*
 *  Search page for animals post type
 */

function ags_dnonprofit_template_chooser($template) {
    global $wp_query;
    $post_type = get_query_var('post_type');

    if ($wp_query->is_search && $post_type == 'animal') {
        return locate_template('animals-index.php');
    }
    return $template;
}

add_filter('template_include', 'ags_dnonprofit_template_chooser');

/*
 *  Taxonomy terms list shortcode
 *  @url: http://www.wpbeginner.com/plugins/how-to-display-custom-taxonomy-terms-in-wordpress-sidebar-widgets/
 *
 *  How to use: [ct_terms custom_taxonomy=customtaxonomyname]
 *
 *  Last modified by Dominika Rauk on 9/11/2020: eliminate use of extract()
 */

function ags_dnonprofit_list_terms_custom_taxonomy($atts) {

    $shortcode_atts = shortcode_atts(array('custom_taxonomy' => '',), $atts);

    $args = array(
        'taxonomy' => $shortcode_atts['custom_taxonomy'],
        'title_li' => __(''),
        'echo'     => 0,
    );

    $widgettext = '<ul class="widget_taxonomy_terms">' . wp_list_categories($args) . '</ul>';
    return $widgettext;

}

add_shortcode('ct_terms', 'ags_dnonprofit_list_terms_custom_taxonomy');
add_filter('widget_text', 'do_shortcode');

/*
 *  Woocommerce
 */

function ags_dnonprofit_output_content_wrapper_end() {
    echo '</div> <!-- #left-area -->';
    if (
        (is_product() && !in_array(get_post_meta(get_the_ID(), '_et_pb_page_layout', true), array('et_no_sidebar', 'et_full_width_page')))
        ||
        ((is_shop() || is_product_category() || is_product_tag()) && 'et_full_width_page' !== et_get_option('divi_shop_page_sidebar', 'et_right_sidebar'))
    ) {
        echo '<div id="sidebar">';
        dynamic_sidebar('ags_dnp_woocommerce_sidebar');
        echo '</div>';
    }
    echo '
                </div> <!-- #content-area -->
            </div> <!-- .container -->
        </div> <!-- #main-content -->';
}

function ags_dnonprofit_woo_custom_sidebar() {
    remove_action('woocommerce_after_main_content', 'et_divi_output_content_wrapper_end', 10);
    add_action('woocommerce_after_main_content', 'ags_dnonprofit_output_content_wrapper_end', 10);
}

add_action('after_setup_theme', 'ags_dnonprofit_woo_custom_sidebar', 50);

/*
 *  Events Calendar
 */

// Changes the escerpt length for events to 100 words
function ags_dnonprofit_custom_excerpt_length($length) {
    return function_exists('tribe_is_event') && tribe_is_event() && is_archive() ? 35 : $length;
}

add_filter('excerpt_length', 'ags_dnonprofit_custom_excerpt_length', 999);

/*
 *  Prevent 'rwmb_the_value' Undefined Function Error
 *  @url https://docs.metabox.io/rwmb-the-value/
 */

if (!function_exists('rwmb_the_value')) {

    function rwmb_the_value($key, $args = '', $post_id = null, $echo = true) {
        return false;
    }
}

/*
 *  Add styles to head
 */

function ags_dnonprofit_custom_styles() {
    ?>
    <style>
        #et-info-phone:before {
            content : '<?php echo esc_html__('Phone:', 'divi-nonprofit') ; ?>';
        }

        #et-info-email:before {
            content : '<?php echo esc_html__('Email:', 'divi-nonprofit') ; ?>';
        }
    </style>
    <?php
}

add_action('wp_head', 'ags_dnonprofit_custom_styles');

/**
 * Adds a custom field: "Contact page"; on the "Settings > Reading" page.
 *
 * Code based on Wordpress Codex
 * @url https://codex.wordpress.org/Settings_API
 */

// ------------------------------------------------------------------
// Add all your sections, fields and settings during admin_init
// ------------------------------------------------------------------

function ags_dnp_settings_api_init() {
    // Add the section to reading settings so we can add our
    // fields to it
    add_settings_section(
        'ags_dnp_setting_section',
        esc_html__('Divi Nonprofit Settings', 'divi-nonprofit'),
        'ags_dnp_setting_section_callback_function',
        'reading'
    );

    // Add the field with the names and function to use for our new
    // settings, put it in our new section
    add_settings_field(
        'ags_dnp_setting_name',
        esc_html__('Contact page', 'divi-nonprofit'),
        'ags_dnp_setting_callback_function',
        'reading',
        'ags_dnp_setting_section'
    );

    $id = 'ags_dnp_contact_page';

    // Register our setting so that $_POST handling is done for us and
    // our callback function just has to echo the <input>
    register_setting('reading', $id);
} // ags_dnp_settings_api_init()

add_action('admin_init', 'ags_dnp_settings_api_init');

// ------------------------------------------------------------------
// Settings section callback function
// ------------------------------------------------------------------

function ags_dnp_setting_section_callback_function() {
    esc_html_e(
        'Select your contact page. If contact page is selected, "Contact us" button will 
    appear on animal page. Leave field empty if you don\'t want to display contact button.',
        'divi-nonprofit');
}

// ------------------------------------------------------------------
// Callback function for our example setting
// ------------------------------------------------------------------

function ags_dnp_setting_callback_function($args) {
    $id = 'ags_dnp_contact_page';

    wp_dropdown_pages(array(
        'name'              => esc_html($id),
        'show_option_none'  => '&mdash; ' . esc_html__('Select', 'divi-nonprofit') . ' &mdash;',
        'option_none_value' => '0',
        'selected'          => esc_html(get_option($id)),
    ));
}

/**
 * @return string
 */
function llrs_memberships_subscriptions_history() {

    $subscription_history = llrs_memberships_get_combined_subscriptions_history();
    $membership_product_id = get_field( 'membership_product', 'option' );
	$membership_product = wc_get_product( $membership_product_id );
    $current_user = wp_get_current_user();

    ob_start();

    if ( ! empty( $subscription_history ) ): ?>
        <table>
            <thead>
            <tr>
                <th><?php _e( 'Plan', 'llrs' ); ?></th>
                <th><?php _e( 'Status', 'llrs' ); ?></th>
                <th><?php _e( 'Expires', 'llrs' ); ?></th>
                <th><?php _e( 'Actions', 'llrs' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $subscription_history as $item ): ?>
                <tr>
                    <td><?php echo $item['plan']; ?></td>
                    <td><?php echo $item['status']; ?></td>
                    <td><?php echo $item['expires']; ?></td>
                    <td>
                        <?php

                        if ( 'stripe' == $item['provider'] ) {
                            continue;
                        }

                        $user_subscription = new WC_Subscription( $item['subscription_id'] );
                        $actions = wcs_get_all_user_actions_for_subscription( $user_subscription, get_current_user_id() );

                        foreach ( $actions as $action => $action_params ) {

                            if ( 'cancel' == $action ) {
                                continue;
                            }

                            printf( '<a href="%s" class="llrs-account-button %s">%s</a>', $action_params['url'], $action, $action_params['name'] );
                        }

                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><?php _e( 'You have no subscriptions.', 'llrs' ); ?></p>
        <?php if ( $membership_product ): ?>
            <?php

		    $action_link = get_the_permalink( $membership_product->get_id() );
		    $action_message = __( 'Subscribe', 'llrs' );

		    if ( wcs_user_has_subscription(  $current_user->ID, $membership_product->get_id() ) ) {

			    $subscription_order = null;

	            foreach ( wcs_get_users_subscriptions() as $user_subscription ) {
		            foreach ( $user_subscription->get_items() as $order_item ) {

                        if ( ! $order_item instanceof WC_Order_Item_Product || $order_item->get_product_id() != $membership_product->get_id() ) {
                            continue;
                        }

                        $related_orders = $user_subscription->get_related_orders();

                        if ( ! is_array( $related_orders ) || count( $related_orders ) < 1 ) {
                            continue;
                        }

                        // Select the order with the highest id.
                        rsort( $related_orders );
                        $subscription_order = wc_get_order( reset( $related_orders ) );
		            }
                }

                if ( $subscription_order instanceof WC_Order && $subscription_order->needs_payment() ) {
                    $action_link = $subscription_order->get_checkout_payment_url();
                    $action_message = __( 'Complete payment', 'llrs' );
                }
            }
            ?>
            <p style="color: #600;"><?php printf( __( '%s now <a href="%s">here</a>.'), esc_html( $action_message ), esc_url( $action_link ) ); ?></p>
        <?php endif; ?>
    <?php endif;

    return ob_get_clean();
}
add_shortcode( 'llrs_subscriptions_history', 'llrs_memberships_subscriptions_history' );

/**
 * @return string
 */
function llrs_memberships_invoices_history( $atts ) {

    $atts = shortcode_atts( array(
        'period' => 'past',
    ), $atts, 'llrs_invoices_history' );

    $invoice_history = llrs_memberships_get_combined_invoices_history();

    $period = $atts['period'] ?? 'past';

    $invoices = $invoice_history[ $period ] ?? array();

    ob_start();

    if ( ! empty( $invoices ) ): ?>
        <table>
            <thead>
            <tr>
                <th><?php _e( 'Description', 'llrs' ); ?></th>
                <th><?php _e( 'Status', 'llrs' ); ?></th>
                <th><?php _e( 'Date', 'llrs' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $invoices as $item ): ?>
                <tr>
                    <td><?php echo $item['description']; ?></td>
                    <td><?php echo $item['status']; ?></td>
                    <td><?php echo $item['date']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><?php _e( sprintf( 'You have no %s payments.', $period ), 'llrs' ); ?></p>
    <?php endif;

    return ob_get_clean();
}
add_shortcode( 'llrs_invoices_history', 'llrs_memberships_invoices_history' );

/**
 * @param $atts
 *
 * @return string
 */
function llrs_memberships_registrations_history( $atts ) {

    $atts = shortcode_atts( array(
        'period' => 'past',
    ), $atts, 'llrs_registrations_history' );

    $registration_history = llrs_memberships_get_combined_registrations_history();

    $period = $atts['period'] ?? 'past';

    $events = $registration_history[ $period ] ?? array();

    ob_start();

    if ( ! empty( $events ) ): ?>
        <table>
            <thead>
            <tr>
                <th><?php _e( 'Event', 'llrs' ); ?></th>
                <th><?php _e( 'Date', 'llrs' ); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $events as $item ): ?>
                <tr>
                    <td><a href="<?php echo $item['permalink']; ?>"><?php echo $item['title']; ?></a></td>
                    <td><a href="<?php echo $item['permalink']; ?>"><?php echo $item['date']; ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
      <p><?php _e( sprintf( 'You have no %s events.', $period ), 'llrs' ); ?></p>
    <?php endif;

    return ob_get_clean();
}
add_shortcode( 'llrs_registrations_history', 'llrs_memberships_registrations_history' );

function llrs_memberships_subscription_status() {

    $membership_product = get_field( 'membership_product', 'option' );

    if ( ! is_user_logged_in() ): ?>
        <p style="color: #900;"><?php printf( __( '<a href="%s">Login now</a> to access members-only discounts and benefits. Not a member? <a href="%s">Register now!<a/>', 'llrs' ), wp_login_url(), get_the_permalink( 11206 ) ); ?></p>
    <?php elseif ( ! llrs_memberships_is_subscribed( get_currentuserinfo() ) ): ?>
        <p style="color: #900;"><?php printf( __( 'You do not have an active subscription. <a href="%s">Register now</a> to access members-only discounts and benefits!', 'llrs'), get_the_permalink( $membership_product ) ); ?></p>
    <?php endif;
}
add_shortcode( 'lles_subscription_status', 'llrs_memberships_subscription_status' );

/**
 * Adds the navigation links from the 'cog' menu into immediate view.
 *
 * @author warwick@sitecare.com
 *
 * @return void
 */
function llrs_memberships_profile_navigation() {

    echo '<a href="' . esc_url( um_edit_profile_url() ) . '" class="real_url">' . __( 'Edit Profile', 'ultimate-member' ) . '</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a href="' . esc_url( um_get_core_page( 'account' ) ) . '" class="real_url">' . __( 'My Account', 'ultimate-member' ) . '</a>';
    echo ' &nbsp;|&nbsp; ';
    echo '<a href="' . esc_url( um_get_core_page( 'logout' ) ) . '" class="real_url">' . __( 'Logout', 'ultimate-member' ) . '</a>';
}
add_action( 'um_after_profile_header_name', 'llrs_memberships_profile_navigation' );

/**
 * Allow future pricing changes to be viewed in the admin panel.
 * 
 * Fixes a bug in the WooCommerce Advanced Pricing plugin that prevents
 * scheduled pricing changes from showing on the WooCommerce -> Settings ->
 * Pricing screen.
 */
add_action( 'pre_get_posts', function( $query ) {
	if (
		! is_admin()
		|| empty( $_GET['tab'] )
		|| 'pricing' !== $_GET['tab']
		|| 'advanced_pricing' !== $query->get( 'post_type' )
	) {
		return;
	}

	$status   = $query->get( 'post_status' );
	$status[] = 'future';

	$query->set( 'post_status', array_unique( $status ) );
} );

/**
 * Function to log PHP vars to the console
 */
 
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }

    echo $js_code;
}

function llrs_get_active_subscriptions() {
    if ( ! class_exists( 'WC_Subscriptions' ) ) {
        return array();
    }

    $args = array(
        'post_type'      => 'shop_subscription',
        'post_status'    => 'wc-active',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    );

    $query = new WP_Query( $args );
    $subscriptions = array();

    if ( ! empty( $query->posts ) ) {
        foreach ( $query->posts as $sub_id ) {
            $subscription = wcs_get_subscription( $sub_id );
            if ( $subscription ) {
                $subscriptions[] = $subscription;
            }
        }
    }

    return $subscriptions;
}


function update_subscription_next_payment_date( $subscription_ids ) {

    if( !is_page('16499') ){
        return;
    }


    $subscription_ids = llrs_get_active_subscriptions();
    // date to update Next Payment
    $new_date = strtotime('2026-05-02 00:09:00');



    foreach ( $subscription_ids as $sub_id ) {
        $subscription = wcs_get_subscription( $sub_id );
            if($subscription) {
                $subscription->update_dates( 
                    array( 
                        'end' => '',
                        'next_payment' => gmdate( 'Y-m-d H:i:s', $new_date ),
                        
                    )
                );
                $subscription->save();
            } else {
                console_log( 'Error updating subscription: ' . $sub_id );
            }
        }

}


add_action('wp_footer', function() {
    if (!is_singular('tribe_events')) return;
    ?>
    <script>
    function hideAndFillTribeNameField() {

      document.querySelectorAll('.tribe-tickets__iac-field--name').forEach(function(el){
        el.remove(); 
      });


      document.querySelectorAll('.tribe-tickets__attendee-tickets-container').forEach(function(container){
        var first = container.querySelector('input[name*="first_name"]');
        var last = container.querySelector('input[name*="last_name"]');

        var name = container.querySelector('input[name*="iac-name"], input[name^="attendee_name"]');
        if(first && last && name) {
          name.value = (first.value + ' ' + last.value).trim();
        }
      });
    }


    document.addEventListener('DOMContentLoaded', hideAndFillTribeNameField);

    new MutationObserver(hideAndFillTribeNameField).observe(document.body, {childList:true,subtree:true});

    document.addEventListener('input', hideAndFillTribeNameField);
    </script>
    <?php
});
