<?php
/*
 * Add new section to customizer
 */

function ags_dnonprofit_customize_register($wp_customize) {

    $wp_customize->add_section('divi_child_theme_colors', array(
        'title'       => __('Divi Nonprofit Colors', 'divi-nonprofit'),
        'priority'    => 1,
        'description' => __('Color settings set below will be applied to your Divi Child Theme color scheme.', 'divi-nonprofit'),
    ));

    $wp_customize->add_setting('divi_main_accent_color', array(
        'default' => '#F13E4B', // Give it a default
    ));

    $wp_customize->add_setting('divi_second_accent_color', array(
        'default' => '#2a2f36 ', // Give it a default
    ));

    $wp_customize->add_setting('divi_active_font_color', array(
        'default' => '#f13e4b ', // Give it a default
    ));

    $wp_customize->add_setting('divi_hover_font_color', array(
        'default' => '#fff ', // Give it a default
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'divi_custom_accent_color', //give it an ID
        array(
            'label'    => __('Main Accent Color', 'divi-nonprofit'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_colors', //select the section for it to appear under
            'settings' => 'divi_main_accent_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'divi_second_custom_accent_color', //give it an ID
        array(
            'label'    => __('Second Accent Color', 'divi-nonprofit'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_colors', //select the section for it to appear under
            'settings' => 'divi_second_accent_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'divi_third_custom_accent_color', //give it an ID
        array(
            'label'    => __('Active Font Color', 'divi-nonprofit'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_colors', //select the section for it to appear under
            'settings' => 'divi_active_font_color' //pick the setting it applies to
        )
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'divi_fourth_custom_accent_color', //give it an ID
        array(
            'label'    => __('Hover Font Color', 'divi-nonprofit'), //set the label to appear in the Customizer
            'section'  => 'divi_child_theme_colors', //select the section for it to appear under
            'settings' => 'divi_hover_font_color' //pick the setting it applies to
        )
    ));

}

add_action('customize_register', 'ags_dnonprofit_customize_register');

/*
 * Output  custom Accent Colors setting CSS Style
 */

function ags_dnonprofit_customize_css() {
    ?>
    <style type="text/css">
        /* Pricing Page */
        .pricing-section .et_pb_button_wrapper, .pricing-section .et_pb_pricing_content_top,
            /* Projects */
        .single-project .nav-single a:hover,
            /* Event Calendar */
        .ecs-all-events a, #tribe-mobile-container .type-tribe_events .tribe-events-read-more:hover, #tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-event-featured, .tribe-events-calendar th, #tribe-bar-form .tribe-bar-submit input[type=submit]:hover, .tribe-events-list .tribe-events-read-more:hover, .tribe-events-nav-next a:hover, .tribe-events-nav-right a:hover, .tribe-events-nav-previous a:hover, .tribe-events-nav-left a:hover,
            /* Events Calendar 5+ */
        .tribe-events .tribe-events-calendar-list__event-row--featured .tribe-events-calendar-list__event-date-tag-datetime:after, .tribe-events .tribe-events-c-ical__link:active, .tribe-events .tribe-events-c-ical__link:focus, .tribe-events .tribe-events-c-ical__link:hover, .tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn, .tribe-events .datepicker .day.active, .tribe-events .datepicker .day.active.focused, .tribe-events .datepicker .day.active:focus, .tribe-events .datepicker .day.active:hover, .tribe-events .datepicker .month.active, .tribe-events .datepicker .month.active.focused, .tribe-events .datepicker .month.active:focus, .tribe-events .datepicker .month.active:hover, .tribe-events .datepicker .year.active, .tribe-events .datepicker .year.active.focused, .tribe-events .datepicker .year.active:focus, .tribe-events .datepicker .year.active:hover, .tribe-events .tribe-events-c-events-bar__search-button:before, .tribe-events .tribe-events-calendar-month__day-cell--selected, .tribe-events .tribe-events-calendar-month__day-cell--selected:focus, .tribe-events .tribe-events-calendar-month__day-cell--selected:hover, .tribe-events .tribe-events-calendar-month__calendar-event--featured:before, .tribe-events .tribe-events-calendar-day__event--featured:after, .tribe-events .tribe-events-c-view-selector__button:before,
            /* Woocommerce */
        .woocommerce .woocommerce-pagination ul.page-numbers span.current, .woocommerce-page .woocommerce-pagination ul.page-numbers span.current, .wp-pagenavi span.current, .woocommerce .woocommerce-pagination ul.page-numbers a:hover, .woocommerce-page .woocommerce-pagination ul.page-numbers a:hover, .woocommerce-cart p.cart-empty:before, .woocommerce-MyAccount-navigation ul li.is-active a, body.woocommerce #content-area div.product .woocommerce-tabs ul.tabs li.active, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-product-search button[type=submit], .woocommerce span.onsale, .woocommerce-page span.onsale,
            /* Sidebar */
        .widget_search input#searchsubmit,
            /* Divi modules */
        .et_pb_tabs ul.et_pb_tabs_controls li.et_pb_tab_active, .et_pb_fullwidth_portfolio .et-pb-arrow-next, .et_pb_fullwidth_portfolio .et-pb-arrow-prev, .et_pb_filterable_portfolio .et_pb_portfolio_filters li a.active, .et_pb_gallery_pagination ul li a.active, .et_pb_gallery_pagination ul li a:hover, .et_pb_portofolio_pagination li a.active, .et_pb_portofolio_pagination li a:hover,
            /* Footer */
        #footer-bottom .et-social-icon a:hover, form#divinonprofit_searchform input[type=submit],
            /* Blog */
        .single .comment_area .comment-reply-link:hover, .tag-line a:hover, .tagcloud a:hover,
            /* Caldera Forms */
        .caldera-grid .btn:hover,
            /* Give WP */
        .slider-donation .give-btn:hover, .give-submit-button-wrap .give-btn:hover, .give-btn.give-btn-modal:hover,
            /* Menu */
        #top-header .et-social-icon a:hover, #et-secondary-nav li > ul li a:hover, #top-menu li li a:hover, .et_mobile_menu li a:hover, #mobile_menu li a:hover, .da-menu-phone a,
            /* Other */
        .bank-account, .home-slider .et-pb-arrow-next, .home-slider .et-pb-arrow-prev, .wp-pagenavi a:hover, .more-link:hover, .slider-donation .give-btn:hover {
            background-color : <?php echo esc_html(get_theme_mod( 'divi_main_accent_color', '#F13E4B')); ?> !important;
        }

        .tribe-events .tribe-events-calendar-month__mobile-events-icon--event {
            background-color : <?php echo esc_html(get_theme_mod( 'divi_main_accent_color', '#F13E4B')); ?>;
        }

        /* Projects */
        .single-project .et_project_categories a,
            /* Event Calendar */
        ul.tribe-bar-views-list .tribe-bar-active a, .tribe-events-day .tribe-events-day-time-slot h5:before, .tribe-events-list-separator-month:before, .tribe-events-list .tribe-events-event-meta .tribe-event-schedule-details:before, .tribe-events-list .tribe-events-event-meta .tribe-events-venue-details:before, .tribe-events-list .tribe-events-event-cost:before,
            /* Events Calendar 5+ */
        .tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-list__event-datetime-featured-text, .tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link, .single-tribe_events a.tribe-events-gcal, .single-tribe_events a.tribe-events-gcal:hover, .single-tribe_events a.tribe-events-ical, .single-tribe_events a.tribe-events-ical:hover, .tribe-common .tribe-common-anchor-thin-alt:active, .tribe-common .tribe-common-anchor-thin-alt:focus, .tribe-common .tribe-common-anchor-thin-alt:hover, .tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date, .tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link, .tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-datetime-featured-text, .tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-day__event-datetime-featured-text, .tribe-common .tribe-common-c-svgicon, .tribe-events-event-meta a, .tribe-events-event-meta a:visited,
            /* Woocommerce */
        table.shop_table tr.order-total .amount, .woocommerce-MyAccount-navigation ul li:not(.is-active) a:hover,
            /* Sidebar */
        #sidebar ul.widget_taxonomy_terms li:before, #sidebar .widget_archive ul li:before, #sidebar .widget_product_categories ul li:before, #sidebar .widget_categories ul li:before,
            /* Divi modules */
        .et_pb_filterable_portfolio .et_pb_portfolio_filters li a:not(.active):hover,
            /* Footer */
        #footer-widgets .footer-widget li:before,
            /* Blog */
        .single-post .entry-content blockquote:before, .post-meta, .post-meta a, .breadcrumbs a:hover,
            /* Animal CPT */
        #animal-detailed .col li:before, .slick-slider .slick-arrow:before {
            color : <?php echo esc_html(get_theme_mod( 'divi_active_font_color', '#f13e4b')); ?> !important;
        }

        .tribe-events .tribe-events-calendar-month__day--current button:not(.tribe-events-calendar-month__day-cell--selected) .tribe-events-calendar-month__day-date {
            color : <?php echo esc_html(get_theme_mod( 'divi_active_font_color', '#f13e4b')); ?>;
        }

        /* Projects */
        .single-project .nav-single a:hover,
            /* Events Calendar */
        .ecs-all-events a, #tribe-mobile-container .type-tribe_events .tribe-events-read-more, .tribe-events-list .tribe-events-read-more, .tribe-events-nav-next a:hover, .tribe-events-nav-right a:hover, .tribe-events-nav-previous a:hover, .tribe-events-nav-left a:hover,
            /* Events Calendar 5+ */
        .tribe-events .tribe-events-c-ical__link, .tribe-common .tribe-common-anchor-thin-alt,
            /* Divi Modules */
        .et_pb_tabs ul.et_pb_tabs_controls li:not(.et_pb_tab_active):hover, .et_pb_tabs ul.et_pb_tabs_controls li.active, .et_pb_filterable_portfolio .et_pb_portfolio_filters li a.active, .et_pb_filterable_portfolio .et_pb_portfolio_filters li a:hover, .et_pb_gallery_pagination ul li a, .et_pb_portofolio_pagination li a, .et_pb_accordion .et_pb_toggle_open,
            /* Woocommerce */
        form.woocommerce-cart-form img:hover, body.woocommerce #content-area div.product .woocommerce-tabs ul.tabs li:hover, body.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, body.woocommerce #content-area div.product .woocommerce-tabs ul.tabs li.active, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-product-gallery .flex-control-thumbs img:hover, .woocommerce-product-gallery .flex-control-thumbs img.flex-active, .help-col:hover, .woocommerce-page .woocommerce-pagination ul.page-numbers span.current, .wp-pagenavi span.current, .woocommerce .woocommerce-pagination ul.page-numbers a, .woocommerce-page .woocommerce-pagination ul.page-numbers a, .woocommerce .woocommerce-pagination ul.page-numbers span.current,
            /* Footer */
        #footer-bottom .et-social-icon a, .et_pb_accordion .et_pb_toggle:hover,
            /* Give WP */
        .give-submit-button-wrap .give-btn, .give-btn.give-btn-modal, .slider-donation .give-btn:hover,
            /* Blog */
        .comment.bypostauthor > article, .single .comment_area .comment-reply-link, .tag-line a, .tagcloud a,
            /* Menu */
        #top-header .et-social-icon a,
            /* Others */
        .wp-pagenavi a, .more-link {
            border-color : <?php echo esc_html(get_theme_mod( 'divi_main_accent_color', '#F13E4B')); ?> !important;
        }

        /* Other*/
        .pricing-icon-section:before,
            /* Menu */
        .interior-header, .et_mobile_menu,
            /* Animal CPT */
        #animal-contact, .animal_single .hero-image, .animal-col .et_pb_animal-image {
            background-color : <?php echo esc_html(get_theme_mod( 'divi_second_accent_color', '#2a2f36 ')); ?> !important;
        }

        .toggle-section .et_pb_toggle {
            border-color : <?php echo esc_html(get_theme_mod( 'divi_second_accent_color', '#2a2f36 ')); ?> !important;
        }

        /* Projects */
        .single-project .nav-single a:hover,
            /* Events Calendar */
        .ecs-all-events a, #tribe-mobile-container .type-tribe_events .tribe-events-read-more:hover, #tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-event-featured, .tribe-events-calendar th, .tribe-events-list .tribe-events-read-more:hover, .tribe-events-nav-next a:hover, .tribe-events-nav-right a:hover, .tribe-events-nav-previous a:hover, .tribe-events-nav-left a:hover,
            /* Divi Modules */
        .et_pb_tabs ul.et_pb_tabs_controls li.et_pb_tab_active a, .et_pb_filterable_portfolio .et_pb_portfolio_filters li a.active,
            /* Woocommerce */
        .woocommerce a.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-MyAccount-navigation ul li.is-active a, body.woocommerce #content-area div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce #review_form #respond .form-submit input, .woocommerce div.product form.cart .button:hover,
            /* Blog */
        .comment-respond .form-submit .et_pb_button:hover,
            /* Give WP */
        .slider-donation .give-btn:hover, .give-submit-button-wrap .give-btn:hover, .give-btn.give-btn-modal:hover,
            /* Others */
        .bank-account, .more-link:hover, .et_mobile_menu li a, .slider-donation .give-btn:hover {
            color : <?php echo esc_html(get_theme_mod( 'divi_hover_font_color', '#FFF')); ?> !important;
        }

        ::selection {
            background-color : <?php echo esc_html(get_theme_mod( 'divi_main_accent_color', '#F13E4B')); ?> !important;
            color            : <?php echo esc_html(get_theme_mod( 'divi_hover_font_color', '#FFF')); ?> !important;
        }

        .tribe-common .tribe-common-c-loader__dot {
            animation-name : dnp-tribe-loader;
        }

        @keyframes dnp-tribe-loader {
            50% {
                background-color : <?php echo esc_html(get_theme_mod( 'divi_main_accent_color', '#F13E4B')); ?>;
            }
        }

        /* Events Calendar 5+ */
        .tribe-events-single-event-title, .tribe-events-content h2, .tribe-events-content h3, .tribe-events-content h4, .tribe-events-content h5, .tribe-events-content h6, .tribe-events-schedule .recurringinfo, .tribe-events-schedule h2, .tribe-related-event-info .recurringinfo, .tribe-common h1, .tribe-common h2, .tribe-common h3, .tribe-common h4, .tribe-common h5, .tribe-common h6 {
            font-family : <?php esc_html_e(et_get_option('heading_font', 'Lora')); ?>;
        }

        .tribe-events-content, .tribe-events-back a, .tribe-events-back a:visited, .tribe-events-event-meta, .tribe-common p {
            font-family : <?php esc_html_e(et_get_option('body_font', 'Nunito')); ?>;
        }

        /* Buttons */
        .dnp-button-primary, .dnp-button-secondary, .caldera-grid .btn, .dnp-module-button-primary .et_pb_button, .dnp-module-button-secondary .et_pb_button, .give-submit-button-wrap .give-btn, .give-btn.give-btn-reveal, .give-btn.give-btn-modal, .not-found-404 .buttons-container a.et_pb_button, .form-submit .et_pb_button, .ecs-all-events a {
            padding        : 11px 25px !important;
            font-weight    : 600;
            line-height    : 1.25 !important;
            font-size      : <?php esc_html_e(et_get_option('all_buttons_font_size', '18')); ?>px;
            border-width   : <?php esc_html_e(et_get_option('all_buttons_border_width', '2')); ?>px;
            border-style   : solid;
            border-radius  : <?php esc_html_e(et_get_option('all_buttons_border_radius', '25')); ?>px;
            letter-spacing : <?php esc_html_e(et_get_option('all_buttons_spacing', '0')); ?>px;
            font-family    : <?php esc_html_e(et_get_option('all_buttons_font', 'Nunito')); ?>;
        <?php echo esc_html( et_pb_print_font_style(et_get_option( 'all_buttons_font_style', '', '', true )));?>

        }

        .dnp-button-primary:hover, .dnp-button-secondary:hover, .dnp-module-button-primary .et_pb_button:hover, .dnp-module-button-secondary .et_pb_button:hover, .give-submit-button-wrap .give-btn:hover, .give-btn.give-btn-reveal:hover, .give-btn.give-btn-modal:hover, .not-found-404 .buttons-container a.et_pb_button:hover, .form-submit .et_pb_button:hover {
            padding      : 11px 25px !important;
            border-width : <?php esc_html_e(et_get_option('all_buttons_border_width', '2')); ?>px;
        }

        /* Primary Button */
        .dnp-button-primary, .dnp-module-button-primary .et_pb_button, .not-found-404 .buttons-container a.et_pb_button, .caldera-grid .btn, .form-submit .et_pb_button {
            border-color     : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_border_color', '#f13e4b')); ?> !important;
            color            : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_text_color', '#333333')); ?> !important;
            background-color : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_background_color', 'rgba(0,0,0,0)')); ?> !important;
        }

        .dnp-button-primary:hover, .dnp-module-button-primary .et_pb_button:hover, .not-found-404 .buttons-container a.et_pb_button:hover, .caldera-grid .btn:hover, .form-submit .et_pb_button:hover {
            border-color     : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_hover_border_color', '#f13e4b')); ?> !important;
            color            : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_hover_text_color', 'rgba(255,255,255,0.99)')); ?> !important;
            background-color : <?php esc_html_e(get_theme_mod('ags_child_theme_primary_button_hover_background_color', '#f13e4b')); ?> !important;
        }

        /* Secondary button */
        .dnp-button-secondary, .dnp-module-button-secondary .et_pb_button, .da-newsletter .caldera-grid .btn {
            background-color : transparent;
            border-color     : <?php echo esc_html(get_theme_mod( 'divi_second_accent_color', '#2a2f36 ')); ?> !important;
        }

        .dnp-button-secondary:hover, .dnp-module-button-secondary .et_pb_button:hover, .da-newsletter .caldera-grid .btn:hover {
            color            : <?php echo esc_html(get_theme_mod( 'divi_hover_font_color', '#FFF')); ?> !important;
            border-color     : <?php echo esc_html(get_theme_mod( 'divi_second_accent_color', '#2a2f36 ')); ?> !important;
            background-color : <?php echo esc_html(get_theme_mod( 'divi_second_accent_color', '#2a2f36 ')); ?> !important;
        }


    </style>
    <?php
}

add_action('wp_head', 'ags_dnonprofit_customize_css');

