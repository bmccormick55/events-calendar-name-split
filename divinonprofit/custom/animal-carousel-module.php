<?php
/**
 *
 * This file contains code from the Divi theme.
 * Copyright (C) Elegant Themes, Inc; Licensed under the GNU General Public License (GPL), version 2.
 *
 * Modified by Dominika Rauk;
 * Last modified 2020-09-14
 *
 */

class ET_Builder_Module_Animals_Carousel extends ET_Builder_Module_Type_PostBased {
    public $vb_support = 'off';

    function init() {
        $this->name = esc_html__('Animals Carousel', 'divi-nonprofit');
        $this->slug = 'et_pb_animals';
        $this->fb_support = true;
        $this->fullwidth = false;

        $this->whitelisted_fields = array(
            'title',
            'posts_number',
            'include_categories',
            'show_more',
            'background_layout',
            'hover_overlay_color',
            'zoom_icon_color',
            'admin_label',
            'module_id',
            'module_class',
        );

        $this->main_css_element = '%%order_class%%';

        $this->settings_modal_toggles = array(
            'general'  => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'et_builder'),
                    'elements'     => esc_html__('Elements', 'et_builder'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'layout'  => esc_html__('Layout', 'et_builder'),
                    'overlay' => esc_html__('Overlay', 'et_builder'),
                    'text'    => array(
                        'title'    => esc_html__('Text', 'et_builder'),
                        'priority' => 49,
                    ),
                ),
            ),
        );

        $this->advanced_fields = array(
            'fonts'                 => array(
                'animal_carousel_header' => array(
                    'label'        => esc_html__('Module Title', 'et_builder'),
                    'css'          => array(
                        'main'      => "{$this->main_css_element} .et_pb_animals_title",
                        'important' => 'all',
                    ),
                    'header_level' => array(
                        'default' => 'h2',
                    ),
                ),
                'title'                  => array(
                    'label'        => esc_html__('Animal Name', 'divi-nonprofit'),
                    'css'          => array(
                        'main'      => "{$this->main_css_element} h3, {$this->main_css_element} h1.et_pb_module_header, {$this->main_css_element} h2.et_pb_module_header, {$this->main_css_element} h4.et_pb_module_header, {$this->main_css_element} h5.et_pb_module_header, {$this->main_css_element} h6.et_pb_module_header",
                        'important' => 'all',
                    ),
                    'header_level' => array(
                        'default' => 'h3',
                    ),
                ),
            ),
            'background'            => array(
                'settings' => array(
                    'color' => 'alpha',
                ),
            ),
            'custom_margin_padding' => array(
                'css' => array(
                    'main' => '%%order_class%%',
                ),
            ),
            'max_width'             => array(),
            'text'                  => array(
                'css' => array(
                    'text_orientation' => '%%order_class%% .meta, %%order_class%% .et_pb_animals_title, %%order_class%% .meta .et_pb_module_header',
                ),
            ),
        );

        $this->custom_css_fields = array(
            'animal_carousel_title'   => array(
                'label'    => esc_html__('Main Title', 'et_builder'),
                'selector' => '.et_pb_animals_title',
            ),
            'animal_carousel_item'    => array(
                'label'    => esc_html__('Animal Post', 'divi-nonprofit'),
                'selector' => '.et_pb_animal_post',
            ),
            'animal_carousel_overlay' => array(
                'label'    => esc_html__('Post Overlay', 'et_builder'),
                'selector' => 'span.et_overlay',
            ),
            'animal_carousel_name'    => array(
                'label'    => esc_html__('Animal Name', 'divi-nonprofit'),
                'selector' => '.meta h3',
            ),
            'animal_carousel_meta'    => array(
                'label'    => esc_html__('Meta', 'et_builder'),
                'selector' => '.meta p',
            ),
            'read_more'               => array(
                'label'    => esc_html__('Read More Button', 'et_builder'),
                'selector' => '.more-link',
            ),
        );

        $this->fields_defaults = array(
            'posts_number'      => array(10, 'add_default_setting'),
            'background_layout' => array('light'),
        );
    }

    function get_fields() {
        $fields = array(
            'title'               => array(
                'label'           => esc_html__('Title', 'et_builder'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Title displayed above the animals.', 'divi-nonprofit'),
                'toggle_slug'     => 'main_content',
            ),
            'include_categories'  => array(
                'label'            => esc_html__('Include Categories', 'et_builder'),
                'renderer'         => 'categories',
                'option_category'  => 'basic_option',
                'renderer_options' => array(
                    'use_terms' => true,
                    'term_name' => 'animal_category',
                ),
                'description'      => esc_html__('Choose which categories you would like to include in the feed.', 'et_builder'),
                'toggle_slug'      => 'main_content',
                'computed_affects' => array(
                    '__animals',
                ),
                'taxonomy_name'    => 'animal_category',
            ),
            'posts_number'        => array(
                'label'            => esc_html__('Number of animals', 'divi-nonprofit'),
                'type'             => 'text',
                'option_category'  => 'configuration',
                'description'      => esc_html__('Control how many animals are displayed. Leave blank or use 0 to not limit the amount.', 'divi-nonprofit'),
                'computed_affects' => array(
                    '__animals',
                ),
                'toggle_slug'      => 'main_content',
            ),
            'show_more'           => array(
                'label'            => esc_html__('Show Read More Button', 'et_builder'),
                'type'             => 'yes_no_button',
                'option_category'  => 'configuration',
                'options'          => array(
                    'off' => esc_html__('No', 'et_builder'),
                    'on'  => esc_html__('Yes', 'et_builder'),
                ),
                'description'      => esc_html__('Here you can define whether to show "read more" button after the title or not.', 'et_builder'),
                'computed_affects' => array(
                    '__animals',
                ),
                'toggle_slug'      => 'elements',
            ),
            'background_layout'   => array(
                'label'           => esc_html__('Text Color', 'et_builder'),
                'type'            => 'select',
                'option_category' => 'color_option',
                'options'         => array(
                    'light' => esc_html__('Dark', 'et_builder'),
                    'dark'  => esc_html__('Light', 'et_builder'),
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'text',
                'description'     => esc_html__('Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder'),
            ),
            'zoom_icon_color'     => array(
                'label'        => esc_html__('Zoom Icon Color', 'et_builder'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'tab_slug'     => 'advanced',
                'toggle_slug'  => 'overlay',
            ),
            'hover_overlay_color' => array(
                'label'        => esc_html__('Hover Overlay Color', 'et_builder'),
                'type'         => 'color-alpha',
                'custom_color' => true,
                'tab_slug'     => 'advanced',
                'toggle_slug'  => 'overlay',
            ),
            'disabled_on'         => array(
                'label'           => esc_html__('Disable on', 'et_builder'),
                'type'            => 'multiple_checkboxes',
                'options'         => array(
                    'phone'   => esc_html__('Phone', 'et_builder'),
                    'tablet'  => esc_html__('Tablet', 'et_builder'),
                    'desktop' => esc_html__('Desktop', 'et_builder'),
                ),
                'additional_att'  => 'disable_on',
                'option_category' => 'configuration',
                'description'     => esc_html__('This will disable the module on selected devices', 'et_builder'),
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'visibility',
            ),
            'admin_label'         => array(
                'label'       => esc_html__('Admin Label', 'et_builder'),
                'type'        => 'text',
                'description' => esc_html__('This will change the label of the module in the builder for easy identification.', 'et_builder'),
                'toggle_slug' => 'admin_label',
            ),
            'module_id'           => array(
                'label'           => esc_html__('CSS ID', 'et_builder'),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'classes',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
            'module_class'        => array(
                'label'           => esc_html__('CSS Class', 'et_builder'),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'classes',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
            '__animals'           => array(
                'type'                => 'computed',
                'computed_callback'   => array('ET_Builder_Module_Animals_Carousel', 'get_carousel_item'),
                'computed_depends_on' => array(
                    'posts_number',
                    'include_categories',
                    'show_more',
                ),
            ),
        );
        return $fields;
    }

    /**
     * Get carousel objects
     */

    static function get_carousel_item($args = array(), $conditional_tags = array(), $current_page = array()) {
        $defaults = array(
            'posts_number'       => '',
            'include_categories' => '',
            'show_more'          => '',
        );

        $args = wp_parse_args($args, $defaults);

        $query_args = array(
            'post_type'   => 'animal',
            'post_status' => 'publish',
        );

        if (is_numeric($args['posts_number']) && $args['posts_number'] > 0) {
            $query_args['posts_per_page'] = $args['posts_number'];
        } else {
            $query_args['nopaging'] = true;
        }

        if ('' !== $args['include_categories']) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'animal_category',
                    'field'    => 'id',
                    'terms'    => explode(',', $args['include_categories']),
                    'operator' => 'IN'
                )
            );
        }

        // Get animal query
        $query = new WP_Query($query_args);

        // Format animal output, add supplementary data
        $width = (int)apply_filters('et_pb_animal_image_width', 510);
        $height = (int)apply_filters('et_pb_animal_image_height', 382);

        if ($query->post_count > 0) {
            $post_index = 0;
            while ($query->have_posts()) {
                $query->the_post();

                // Get thumbnail
                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width, $height));

                // Append value to query post
                $query->posts[$post_index]->post_permalink = get_permalink();
                $query->posts[$post_index]->post_thumbnail = isset($thumbnail[0]) ? $thumbnail[0] : false;
                $query->posts[$post_index]->post_date_readable = get_the_date();
                $query->posts[$post_index]->post_class_name = get_post_class('et_pb_animal_post');

                $post_index++;
            }
        } else if (wp_doing_ajax()) {
            // This is for the VB
            $posts = '<div class="et_pb_row et_pb_no_results">';
            $posts .= self::get_no_results_template();
            $posts .= '</div>';
            $query = array('posts' => $posts);
        }

        wp_reset_postdata();

        return $query;
    }

    function render($atts, $content = null, $function_name) {

        $title = $this->props['title'];
        $module_id = $this->props['module_id'];
        $module_class = $this->props['module_class'];
        $include_categories = $this->props['include_categories'];
        $posts_number = $this->props['posts_number'];
        $background_layout = $this->props['background_layout'];
        $show_more = $this->props['show_more'];
        $zoom_icon_color = $this->props['zoom_icon_color'];
        $hover_overlay_color = $this->props['hover_overlay_color'];
        $header_level = $this->props['title_level'];
        $animal_header = $this->props['animal_carousel_header_level'];

        $module_class = ET_Builder_Element::add_module_order_class($module_class, $function_name);

        $zoom_and_hover_selector = '.et_pb_animals%%order_class%% .et_pb_animal_image';

        if ('' !== $zoom_icon_color) {
            ET_Builder_Element::set_style($function_name, array(
                'selector'    => "{$zoom_and_hover_selector} .et_overlay:before",
                'declaration' => sprintf(
                    'color: %1$s !important;',
                    esc_html($zoom_icon_color)
                ),
            ));
        }

        if ('' !== $hover_overlay_color) {
            ET_Builder_Element::set_style($function_name, array(
                'selector'    => "{$zoom_and_hover_selector} .et_overlay",
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    esc_html($hover_overlay_color)
                ),
            ));
        }

        $args = array();
        if (is_numeric($posts_number) && $posts_number > 0) {
            $args['posts_per_page'] = $posts_number;
        } else {
            $args['nopaging'] = true;
        }

        if ('' !== $include_categories) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'animal_category',
                    'field'    => 'id',
                    'terms'    => explode(',', $include_categories),
                    'operator' => 'IN'
                )
            );
        }

        $animals = self::get_carousel_item(array(
            'posts_number'       => $posts_number,
            'include_categories' => $include_categories,
        ));

        ob_start();
        if ($animals->post_count > 0) {
            while ($animals->have_posts()) {
                $animals->the_post();
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('et_pb_animal_post'); ?>>
                    <?php
                    $thumb = '';

                    $width = 510;
                    $width = (int)apply_filters('et_pb_animal_image_width', $width);

                    $height = 382;
                    $height = (int)apply_filters('et_pb_animal_image_height', $height);

                    list($thumb_src, $thumb_width, $thumb_height) = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width, $height));

                    if ('' !== $thumb_src) : ?>
                        <div class="et_pb_animal_image">
                            <a href="<?php esc_url(the_permalink()); ?>">
                                <img src="<?php echo esc_url($thumb_src); ?>"
                                     alt="<?php echo esc_attr(get_the_title()); ?>"/>
                                <span class="et_overlay"></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="meta">
                        <<?php echo et_pb_process_header_level($header_level, 'h3') ?>
                        class="et_pb_module_header"><?php the_title(); ?></<?php echo et_pb_process_header_level($header_level, 'h3') ?>
                    >

                    <?php if ('on' === $show_more) {
                        $more = $show_more ? sprintf(' <a href="%1$s" class="more-link btn" >%2$s</a>', esc_url(get_permalink()), esc_html__('Read More', 'et_builder')) : '';
                        echo et_core_intentionally_unescaped($more, 'html');
                    } ?>
                </div>
                </div>
                <?php
            }
        }

        wp_reset_postdata();

        if (!$posts = ob_get_clean()) {
            $posts = '<div class="et_pb_row et_pb_no_results">';
            $posts .= self::get_no_results_template();
            $posts .= '</div>';
        }

        $video_background = $this->video_background();
        $parallax_image_background = $this->get_parallax_image_background();

        $class = " et_pb_module et_pb_bg_layout_{$background_layout}";

        $animal_title = sprintf('<%1$s class="et_pb_animals_title">%2$s</%1$s>', et_pb_process_header_level($animal_header, 'h2'), esc_html($title));

        $output = sprintf(
            '<div%4$s class="et_pb_animals %1$s%3$s%5$s%7$s%9$s">
				%10$s
				%8$s
				%6$s
				<div class="et_pb_animals_feed clearfix">
					%2$s
				</div><!-- .et_pb_animals_feed -->
			</div> <!-- .et_pb_animals -->',
            ('clearfix'),
            $posts,
            esc_attr($class),
            ('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
            ('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
            ('' !== $title ? $animal_title : ''),
            '' !== $video_background ? ' et_pb_section_video et_pb_preload' : '',
            $video_background,
            '' !== $parallax_image_background ? ' et_pb_section_parallax' : '',
            $parallax_image_background
        );

        return $output;
    }
}

new ET_Builder_Module_Animals_Carousel;
