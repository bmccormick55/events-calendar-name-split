<?php
/**
 * Plugin Name: Tribe Custom Attendee Fields
 * Description: Adds First and Last Name fields to the registration modal.
 * Version: 1.0
 * Author: Britt DeVivo
 */

// Register First & Last Name fields
add_filter( 'tribe_tickets_attendee_registration_fields', function( $fields, $ticket ) {
	return array_merge( $fields, [
		'first_name' => [
			'type'     => 'text',
			'label'    => 'First Name',
			'required' => true,
		],
		'last_name'  => [
			'type'     => 'text',
			'label'    => 'Last Name',
			'required' => true,
		],
	] );
}, 10, 2 );

// Save First & Last Name to attendee meta
add_action( 'tribe_tickets_attendee_created', function( $attendee_id, $attendee ) {
	if ( ! empty( $attendee['first_name'] ) ) {
		update_post_meta( $attendee_id, 'first_name', sanitize_text_field( $attendee['first_name'] ) );
	}
	if ( ! empty( $attendee['last_name'] ) ) {
		update_post_meta( $attendee_id, 'last_name', sanitize_text_field( $attendee['last_name'] ) );
	}
}, 10, 2 );
