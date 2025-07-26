<?php
/*
Plugin Name: Tribe First/Last Fields
Description: Override attendee registration template to show first/last name fields.
Version: 1.0
Author: Your Name
*/

add_filter( 'tribe_template_path_list', function( $paths ) {
    $custom_path = plugin_dir_path( __FILE__ ) . 'tribe/';
    array_unshift( $paths, [
        'path'      => $custom_path,
        'priority'  => 11,
        'namespace' => '',
    ] );
    return $paths;
});

