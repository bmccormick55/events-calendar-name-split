<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class TECS_Element extends \Bricks\Element {

    public $category = 'general';
    public $name = 'the-events-calendar-shortcode';
    public $icon = 'bricks-icon-ecs';
    public $css_selector = '.ecs-wrapper';
    public $scripts = [];
    public $nestable = false;

    public function get_label() {
        return esc_html__( 'The Events Calendar Shortcode', 'the-events-calendar-shortcode' );
    }

    public function set_control_groups() {
    }

    public function set_controls() {
        $this->controls['design'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Design', 'the-events-calendar-shortcode' ),
            'type' => 'select',
            'options' => apply_filters( 'ecs_bricks_designs', [
                'free' => esc_html__( 'Standard', 'the-events-calendar-shortcode' ),
            ] ),
            'inline' => true,
            'clearable' => false,
            'pasteStyles' => false,
            'default' => 'free',
        ];

        if ( ! defined( 'TECS_VERSION' ) ) {
            $this->controls['design_notice_pro'] = [
                'tab' => 'content',
                'content' => '<div class="ecs-pro-notice">' . '<h5>' . esc_html__( 'Want more designs?', 'the-events-calendar-shortcode' ) . '</h5>' .
                             '<p>' .
                             sprintf( esc_html__( '%sUpgrade to Pro%s for more designs (including a full calendar view), pagination and a filter bar!', 'the-events-calendar-shortcode' ), '<a target="_blank" href="https://eventcalendarnewsletter.com/the-events-calendar-shortcode/?utm_source=plugin&utm_medium=link&utm_campaign=elementor-block&utm_content=elementor">', '</a>' ) . '<p><a target="_blank" class="ecs-button" href="https://demo.eventcalendarnewsletter.com/the-events-calendar-shortcode/?utm_source=plugin&utm_medium=link&utm_campaign=elementor-block&utm_content=elementor">' . esc_html__( 'View the demo', 'the-events-calendar-shortcode' ) . '</a></p>' .
                             '</p></div>',
                'type' => 'info',
            ];
        }

        $this->controls['limit'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Number of Events', 'the-events-calendar-shortcode' ),
            'type' => 'number',
            'min' => 1,
            'inline' => true,
            'default' => 5,
        ];

        $this->controls['order'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Order', 'the-events-calendar-shortcode' ),
            'type' => 'select',
            'options' => apply_filters( 'ecs_bricks_designs', [
                'ASC' => esc_html__( 'Ascending', 'the-events-calendar-shortcode' ),
                'DESC' => esc_html__( 'Descending', 'the-events-calendar-shortcode' ),
            ] ),
            'inline' => true,
            'clearable' => false,
            'pasteStyles' => false,
            'default' => 'ASC',
        ];

        $this->controls['thumbnail'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Show thumbnail image', 'the-events-calendar-shortcode' ),
            'type' => 'checkbox',
            'inline' => true,
            'default' => true,
            'required' => apply_filters( 'ecs_bricks_thumbnail_condition', null ),
        ];

        $this->controls['thumbnail_dimensions_choice'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Thumbnail Size', 'the-events-calendar-shortcode' ),
            'type' => 'select',
            'options' => [
                'default' => esc_html__( 'Default', 'the-events-calendar-shortcode' ),
                'width_and_height' => esc_html__( 'Width & Height', 'the-events-calendar-shortcode' ),
                'size' => esc_html__( 'Size', 'the-events-calendar-shortcode' ),
            ],
            'inline' => true,
            'clearable' => false,
            'pasteStyles' => false,
            'default' => 'default',
            'required' => [['thumbnail', '=', true], ['design', '!=', 'grouped']],
        ];

        $this->controls['thumbnail_width'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Thumbnail Width', 'the-events-calendar-shortcode' ),
            'type' => 'number',
            'min' => 1,
            'inline' => true,
            'default' => 150,
            'required' => [['thumbnail', '=', true], ['thumbnail_dimensions_choice', '=', 'width_and_height']],
        ];

        $this->controls['thumbnail_height'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Thumbnail Height', 'the-events-calendar-shortcode' ),
            'type' => 'number',
            'min' => 1,
            'inline' => true,
            'default' => 150,
            'required' => [['thumbnail', '=', true], ['thumbnail_dimensions_choice', '=', 'width_and_height']],
        ];

        $this->controls['thumbnail_size'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Thumbnail Size', 'the-events-calendar-shortcode' ),
            'type' => 'text',
            'inline' => true,
            'required' => [['thumbnail', '=', true], ['thumbnail_dimensions_choice', '=', 'size']],
        ];

        $category_terms = get_terms( [
            'taxonomy' => 'tribe_events_cat',
            'hide_empty' => false,
        ] );
        $categories = [];

        foreach ( $category_terms as $cat_term ) {
            $categories[$cat_term->slug] = $cat_term->name;
        }

        $this->controls['venue'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Show venue information', 'the-events-calendar-shortcode' ),
            'type' => 'checkbox',
            'inline' => true,
            'default' => true,
        ];

        $this->controls['excerpt'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Show excerpt of events', 'the-events-calendar-shortcode' ),
            'type' => 'checkbox',
            'inline' => true,
            'default' => true,
        ];

        $this->controls['excerpt_length'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Excerpt Length', 'the-events-calendar-shortcode' ),
            'type' => 'number',
            'min' => 1,
            'inline' => true,
            'default' => 100,
            'required' => ['excerpt', '=', true],
        ];

        if ( ! defined( 'TECS_VERSION' ) ) {
            $this->controls['excerpt_notice_pro'] = [
                'tab' => 'content',
                'content' => '<div class="ecs-pro-notice">' . esc_html__( 'Want more control over the excerpt?', 'the-events-calendar-shortcode' ) .
                             '<p>' .
                             sprintf( esc_html__( '%sUpgrade to Pro%s to show the full description, HTML in your excerpts, and more!', 'the-events-calendar-shortcode' ), '<a target="_blank" href="https://eventcalendarnewsletter.com/the-events-calendar-shortcode/?utm_source=plugin&utm_medium=link&utm_campaign=elementor-block&utm_content=elementor">', '</a>' ) .
                             '</p></div>',
                'type' => 'info',
            ];
        }

        $this->controls['cat'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Category', 'the-events-calendar-shortcode' ),
            'type' => 'select',
            'multiple' => true,
            'searchable' => true,
            'options' => apply_filters( 'ecs_bricks_categories', $categories ),
        ];

        $this->controls['past'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Show only past events?', 'the-events-calendar-shortcode' ),
            'type' => 'checkbox',
            'inline' => true,
            'default' => false,
        ];

        if ( ! defined( 'TECS_VERSION' ) ) {
            $this->controls['past_notice_pro'] = [
                'tab' => 'content',
                'content' => '<div class="ecs-pro-notice">' .
                             '<p>' .
                             sprintf( esc_html__( '%sGet more date-related options%s to show events from a specific year, number of days, and even a specific date range.', 'the-events-calendar-shortcode' ), '<a target="_blank" href="https://eventcalendarnewsletter.com/the-events-calendar-shortcode/?utm_source=plugin&utm_medium=link&utm_campaign=elementor-block&utm_content=elementor">', '</a>' ) .
                             '</p></div>',
                'type' => 'info',
            ];
        }

        $this->controls['advanced'] = [
            'tab' => 'content',
            'label' => esc_html__( 'Advanced/Other', 'the-events-calendar-shortcode' ),
            'type' => 'repeater',
            'fields' => [
                'key' => [
                    'label' => esc_html__( 'Key', 'the-events-calendar-shortcode' ),
                    'type' => 'text',
                ],
                'value' => [
                    'label' => esc_html__( 'Value', 'the-events-calendar-shortcode' ),
                    'type' => 'text',
                ],
            ],
            'description' => sprintf( esc_html__( '%sView documentation on available options%s where key="value" in the shortcode can be entered in the boxes above.', 'the-events-calendar-shortcode' ), '<a target="_blank" href="https://eventcalendarnewsletter.com/events-calendar-shortcode-pro-options/?utm_source=plugin&utm_medium=link&utm_campaign=block-advanced-help&utm_content=elementor' . ( ! defined( 'TECS_VERSION' ) ? '&free=1' : '' ) . '">', '</a>' ),
            'default' => [],
        ];
    }

    public function enqueue_scripts() {
    }

    public function render() {
        $root_classes[] = 'ecs-bricks-wrapper';

        $atts = [
            'design' => 'free' === $this->settings['design'] ? '' : $this->settings['design'],
            'thumb' => ( isset( $this->settings['thumbnail'] ) && $this->settings['thumbnail'] ) ? 'true' : 'false',
            'venue' => ( isset( $this->settings['venue'] ) && $this->settings['venue'] ) ? 'true' : 'false',
            'excerpt' => ( isset( $this->settings['excerpt'] ) && $this->settings['excerpt'] ) ? $this->settings['excerpt_length'] : 'false',
            'past' => ( isset( $this->settings['past'] ) && $this->settings['past'] ) ? 'yes' : null,
            'order' => 'DESC' === $this->settings['order'] ? 'DESC' : 'ASC',
        ];

        if ( 'calendar' !== $this->settings['design'] ) {
            $atts['limit'] = intval( is_numeric( $this->settings['limit'] ) ? $this->settings['limit'] : 5 );
        }

        if ( $this->settings['thumbnail'] ) {
            if ( 'width_and_height' === $this->settings['thumbnail_dimensions_choice'] ) {
                $atts['thumbwidth'] = intval( is_numeric( $this->settings['thumbnail_width'] ) ? $this->settings['thumbnail_width'] : 150 );
                $atts['thumbheight'] = intval( is_numeric( $this->settings['thumbnail_height'] ) ? $this->settings['thumbnail_height'] : 150 );
            } elseif ( isset( $this->settings['thumbnail_size'] ) ) {
                $atts['thumbsize'] = $this->settings['thumbnail_size'];
            }
        }

        if ( isset( $this->settings['advanced'] ) && is_array( $this->settings['advanced'] ) ) {
            foreach ( $this->settings['advanced'] as $advanced ) {
                $atts[ $advanced['key'] ] = $advanced['value'];
            }
        }

        if ( isset( $this->settings['cat'] ) && is_array( $this->settings['cat'] ) ) {
            $atts['cat'] = implode( ',', $this->settings['cat'] );
        }

        $atts = apply_filters( 'ecs_bricks_atts', $atts, $this->settings );

        $this->set_attribute( '_root', 'class', $root_classes );

        echo "<div {$this->render_attributes( '_root' )}>"; // Element root attributes

        echo do_shortcode(
            '[ecs-list-events ' . implode( ' ', array_map( function ( $key, $value ) {
                return esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
            }, array_keys( $atts ), $atts ) ) . ']'
        );

        echo '</div>';
    }
}
