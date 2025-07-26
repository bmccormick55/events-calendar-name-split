<?php
/**
 * Registering meta boxes
 * @link http://metabox.io/docs/registering-meta-boxes/
 */

add_filter('rwmb_meta_boxes', 'ags_dnonprofit_register_meta_boxes');

function ags_dnonprofit_register_meta_boxes($meta_boxes) {

    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */

    $prefix = 'da_';

    $meta_boxes[] = array(
        'id'         => 'meta_box',
        'title'      => esc_html__('Informations about animal', 'divi-nonprofit'),
        'post_types' => array('animal'),
        'context'    => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
        'priority'   => 'high', // Order of meta box: high (default), low. Optional.
        'autosave'   => true,
        'fields'     => array(

            /*
            * Podstawowe informacje
            */
            array(
                'id'   => 'heading',
                'type' => 'heading',
                'name' => esc_html__('Basic information', 'divi-nonprofit'),
            ),
            // TEXT
            array(
                'id'          => $prefix . 'age',
                'name'        => esc_html__('Age', 'divi-nonprofit'),
                'placeholder' => esc_html__('Enter the age of animal', 'divi-nonprofit'),
                'type'        => 'text',
            ),
            // SELECT ADVANCED BOX
            array(
                'name'        => esc_html__('Gender', 'divi-nonprofit'),
                'id'          => $prefix . 'gender',
                'type'        => 'select_advanced',
                'options'     => array(
                    'option-1' => esc_html__('Male', 'divi-nonprofit'),
                    'option-2' => esc_html__('Female', 'divi-nonprofit'),
                    'option-3' => esc_html__('Not identified', 'divi-nonprofit'),
                ),
                'multiple'    => false,
                'placeholder' => esc_html__('Choose gender', 'divi-nonprofit'),
                'desc'        => esc_html__('You can leave this field empty', 'divi-nonprofit'),
            ),
            // SELECT ADVANCED BOX
            array(
                'name'        => esc_html__('Pet Size', 'divi-nonprofit'),
                'id'          => $prefix . 'size',
                'type'        => 'select_advanced',
                'options'     => array(
                    'option-1' => esc_html__('Small', 'divi-nonprofit'),
                    'option-2' => esc_html__('Medium', 'divi-nonprofit'),
                    'option-3' => esc_html__('Large', 'divi-nonprofit'),
                    'option-4' => esc_html__('Not identified', 'divi-nonprofit')
                ),
                'multiple'    => false,
                'placeholder' => esc_html__('Choose pet size.', 'divi-nonprofit'),
                'desc'        => esc_html__('You can leave this field empty', 'divi-nonprofit'),
            ),
            // SELECT ADVANCED BOX
            array(
                'name'        => esc_html__('Breed', 'divi-nonprofit'),
                'id'          => $prefix . 'breed',
                'placeholder' => esc_html__('Enter animal breed here', 'divi-nonprofit'),
                'type'        => 'text',
            ),
            // MAP
            array(
                'id'   => 'address',
                'name' => esc_html__('Address', 'divi-nonprofit'),
                'type' => 'text',
            ),
            // Map field.
            array(
                'id'            => $prefix . 'map',
                'name'          => esc_html__('Location', 'divi-nonprofit'),
                'type'          => 'map',
                // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
                //'std'           => '39.8281648,-98.5793385,15', /* Default: USA */
                // Address field ID
                'address_field' => 'address',
                // Google API key
                'api_key'       => 'AIzaSyCH1lcRpEwllgJfqmN4sduNCe9qDRdTOUE',
            ),

            /*
            * Characteristics
            */
            array(
                'id'   => 'heading',
                'type' => 'heading',
                'name' => esc_html__('Additional Informations'),
            ),
            // CHECKBOX LIST
            array(
                'name'            => esc_html__('Characteristics', 'divi-nonprofit'),
                'id'              => $prefix . 'characteristisc',
                'type'            => 'checkbox_list',
                // Options of checkboxes, in format 'value' => 'Label'
                'options'         => array(
                    'option-1'  => esc_html__('House trained', 'divi-nonprofit'),
                    'option-2'  => esc_html__('Easy To Groom', 'divi-nonprofit'),
                    'option-3'  => esc_html__('Vaccinated', 'divi-nonprofit'),
                    'option-4'  => esc_html__('Neutered', 'divi-nonprofit'),
                    'option-5'  => esc_html__('Spayed', 'divi-nonprofit'),
                    'option-6'  => esc_html__('Friendly Toward Strangers', 'divi-nonprofit'),
                    'option-7'  => esc_html__('Tolerates being alone', 'divi-nonprofit'),
                    'option-8'  => esc_html__('Requires high level of exercise', 'divi-nonprofit'),
                    'option-9'  => esc_html__('Requires moderate level of exercise', 'divi-nonprofit'),
                    'option-10' => esc_html__('Good for first time pet owners', 'divi-nonprofit'),
                    'option-11' => esc_html__('Adapts well to apartment living', 'divi-nonprofit'),
                    'option-12' => esc_html__('Needs a house with a garden', 'divi-nonprofit')
                ),
                // Display options in a single row?
                // 'inline' => true,
                // Display 'Select All / None' button?
                'select_all_none' => false,
            ),
            // CHECKBOX LIST
            array(
                'name'            => esc_html__('Compatible With', 'divi-nonprofit'),
                'id'              => $prefix . 'compatible',
                'type'            => 'checkbox_list',
                // Options of checkboxes, in format 'value' => 'Label'
                'options'         => array(
                    'dogs'     => esc_html__('Dogs', 'divi-nonprofit'),
                    'cats'     => esc_html__('Cats', 'divi-nonprofit'),
                    'children' => esc_html__('Children', 'divi-nonprofit')
                ),
                // Display options in a single row?
                // 'inline' => true,
                // Display 'Select All / None' button?
                'select_all_none' => false,
            ),

            /*
             *  Contact info
             */
            array(
                'id'   => 'heading',
                'type' => 'heading',
                'name' => esc_html__('Contact info', 'divi-nonprofit'),
            ),
            // TEXTAREA
            array(
                'name' => esc_html__('Phone number', 'divi-nonprofit'),
                'id'   => $prefix . 'phone',
                'type' => 'text',
            ),
            // EMAIL
            array(
                'name' => esc_html__('Email address', 'divi-nonprofit'),
                'id'   => $prefix . 'email',
                'type' => 'email',
            ),

            /*
            * Gallery
            */
            array(
                'id'   => 'heading',
                'type' => 'heading',
                'name' => esc_html__('Photo gallery', 'divi-nonprofit'),
            ),
            // IMAGE ADVANCED (WP 3.5+)
            array(
                'name' => esc_html__('File upload', 'divi-nonprofit'),
                'id'   => $prefix . 'gallery',
                'type' => 'image_advanced',
            ),

        ));

    return $meta_boxes;
}